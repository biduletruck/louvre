<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/17
 * Time: 18:30
 */

namespace Louvre\FrontBundle\Controller\Payments;

use Louvre\FrontBundle\Controller\Booking\BookinController;
use Louvre\FrontBundle\Entity\Order;
use Louvre\FrontBundle\Form\OrderType;
use Louvre\FrontBundle\Form\PayementModel;
use Louvre\FrontBundle\Form\PayementType;
use Symfony\Component\HttpFoundation\Request;

class PaymentsController extends BookinController
{
    const MAXVISITORS = 1000; //nombre de visiteurs maximum par jour



    public function confirmOrderFormAction(Request $request)

    {
        $formOrder = $this->buildOrderForm();
        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid()) {
            $order = $this->createOrderFromData($formOrder);
            if ($this->thereIsEnoughSeats($order))
            {
                return $this->showPaymentFormAction($request);
            }
            $this->get('session')->getFlashBag()->add('error', 'Désolé plus de place pour cette date');
        }

        return $this->render('@LouvreFront/reservation.html.twig', array(
            'form' => $formOrder->createView()
        ));
    }



    /**

     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function showPaymentFormAction(Request $request)
    {

        $orderForm = $this->createForm(OrderType::class);
        $orderForm->handleRequest($request);
        $orderModel = $orderForm->getData();
        $payementForm = $this->preparePayement($orderModel);
        return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $payementForm->createView()
        ));

    }

    public function checkoutAction()
    {

        \Stripe\Stripe::setApiKey($this->container->getParameter('stripe_secret'));
        $token = $_POST['stripeToken'];
        $session = $this->get('session');
        $order = $session->get('tempOrder');

        try {
            $charge = \Stripe\Charge::create(array(
                "amount" => $order->totalAmount . "00",
                "currency" => "eur",
                "source" => $token,
                "description" => "Paiement Stripe - OpenClassrooms Exemple"
            ));
            $this->addFlash("success", "Félicitation, votre commande à été validée.");


            return $this->redirectToRoute("louvre_front_showorder");
        } catch (\Stripe\Error\Card $e) {

            $this->addFlash("error", "Votre commande n'a pas été validée, nous vous invitons à refaire votre demande.");
            return $this->redirectToRoute("louvre_front_prepare_order");
            // The card has been declined
        }
    }

    /**
     * @Param Order $order
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveOrderInBaseAction(Order $order)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Merci pour votre réservation.');

       return $this->redirect($this->generateUrl('louvre_front_confirmed_order'));
    }

    /**
     * @param $orderModel
     * @return \Symfony\Component\Form\Form
     */
    private function preparePayement($orderModel)
    {
        $payementModel = new PayementModel();
        $payementModel->order = $orderModel;

        $order = $this->get('louvre.front_bundle.entity.order_factory')->createFromModel($orderModel);
        $tickets = $order->getTickets()->toArray();

        foreach ($payementModel->order->tickets as $ticket)
        {
            $actualTicket = array_shift($tickets);
            $ticket->price = $actualTicket->getPrice();
        }

        $payementModel->totalAmount = $order->getTotalAmount();
        $payementModel->numberCommand = $order->getNumberCommand();
        $payementForm = $this->createForm(PayementType::class, $payementModel);

        return $payementForm;
    }

    /**
     * @param Request $request
     */
    public function confirmPayementAction(Request $request)
    {

        /*
         * si formulaire erreur
         *  rendu du template et afficher formulaire comme avant
         *
         * return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $payementForm->createView()
         *
         * si formulaire = OK
         *  vérifier token stripe
         *  si ok
         *      envoir en base
         *  si nok
         *      retour vers paiement + message erreur
         * return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $payementForm->createView()
         */

    }

    /**
     * @param Order $order
     * @return bool
     */
    private function thereIsEnoughSeats(Order $order)
    {
        return ($this->get('louvre.front_bundle.repository.order_repository')->countTicketsByDay($order->getVisitDate()) + count($order->getTickets())) < self::MAXVISITORS;
    }

    /**
     * @param $formOrder
     * @return Order
     */
    private function createOrderFromData($formOrder)
    {
        $model = $formOrder->getData();
        $orderFactory = $this->get('louvre.front_bundle.entity.order_factory');
        $order = $orderFactory->createFromModel($model);
        return $order;
    }
}