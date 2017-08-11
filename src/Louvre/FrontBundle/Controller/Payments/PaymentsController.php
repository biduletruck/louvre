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
                "amount" => ($order->totalAmount * 100),
                "currency" => "eur",
                "source" => $token,
                "description" => "Le Louvre - Visite du musée"
            ));
            $this->addFlash("success", "Félicitation, votre commande à été validée.");
            return $charge;
        } catch (\Stripe\Error\Card $e) {
            $this->addFlash("error", "Votre commande n'a pas été validée, nous vous invitons à refaire votre demande.");
            return false;
        }
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

        $payementForm = false;

        if($order->getVisitDate() != null)
        {
            foreach ($payementModel->order->tickets as $ticket)
            {
                $actualTicket = array_shift($tickets);
                $ticket->price = $actualTicket->getPrice();
            }

            $payementModel->totalAmount = $order->getTotalAmount();
            $payementModel->numberCommand = $order->getNumberCommand();
            $payementForm = $this->createForm(PayementType::class, $payementModel);

            $this->addInSession($payementForm);
        }

        return $payementForm;
    }

    /**
     * @param Request $request
     */
    public function confirmPayementAction(Request $request)
    {

        $session = $this->get('session')->get('tempOrder');
        $payementForm = $this->createForm(PayementType::class,$session);
        $payementForm->handleRequest($request);
        $order = $this->get('louvre.front_bundle.entity.order_factory')->createFromModel($session->order);

        if ($this->thereIsEnoughSeats($order)) //on vérifie une nouvelle fois le nombre place dispo
        {
            $charge = $this->checkoutAction(); //on initialise le paiement

            $customer = \Stripe\Charge::retrieve( //on vériifie le retour du paiement
                "$charge->id",
                array('api_key' => $this->container->getParameter('stripe_secret'))
            );

            //Si le formulaire est retourné et confirmer on envoi le mail et on sauve le résultat
            if ($charge->status == "succeeded" && ($charge->amount == $customer->amount) && ($charge->created == $customer->created) )
            {
                $this->get('louvre_front.services.send_tickets_by_email')->sendCommandMail($session);

                return $this->saveOrderInBase($session);
            }

            $this->addFlash("error", "Une érreur est survenue, merci de faire un nouvel éssai");
            return $this->render('@LouvreFront/prepare.html.twig', array(
                'form' => $payementForm->createView()));
        }

        $this->get('session')->getFlashBag()->add('error', 'Désolé plus de place pour cette date');

        return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $payementForm->createView()));

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

    /**
     * @param $session
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveOrderInBase($session)
    {
        $order = $this->get('louvre.front_bundle.entity.order_factory')->createFromModel($session->order);

        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Merci pour votre réservation.');

        return $this->redirect($this->generateUrl('louvre_front_showorder'));
    }

    /**
     * @param $payementForm
     */
    public function addInSession($payementForm)
    {
        $session = $this->get('session');
        $session->remove('tempOrder');
        $session->set('tempOrder', $payementForm->getData());
    }
}