<?php

namespace Louvre\FrontBundle\Controller\Booking;

use Symfony\Component\HttpFoundation\Request;


class SaveBookingController extends BookinController
{

    const MAXVISITORS = 1000; //nombre de visiteurs maximum par jour

    public function saveOrderAction(Request $request)
    {
        $formOrder = $this->buildOrderForm();
        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid())
        {
            $model = $formOrder->getData();
            $orderFactory = $this->get('louvre.front_bundle.entity.order_factory');
            $order = $orderFactory->createFromModel($model);

            $newCommand = $this->addCommandOnSession($order);


            dump($this->get('session')->get('command'));

/*
            if ($this->checkSumOfVisitors($order))
            {
                return $this->saveOrderInBase($order);
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Désolé plus de place pour cette date');
            }
*/
        }

        return $this->renderOrderForm($formOrder);
    }

    /**
     * @param $order
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveOrderInBase($order)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Merci pour votre réservation.');

        return $this->redirect($this->generateUrl('louvre_front_showorder'));
    }

    /**
     * @param $order
     * @return bool
     */
    public function checkSumOfVisitors($order)
    {
        return $this->container->get('louvre_front.repository.order_repository.count_visitors', $order->getVisitDate()) < self::MAXVISITORS;
    }

    /**
     * @param Request $request
     * @return null|\Symfony\Component\HttpFoundation\Session\SessionInterface
     */
    public function ifExistSessionCommand()
    {
        $session = $this->get('session');
        if (!$session->has('command')) {
            $session->set('command', array());
        }
        return $session;
    }

    /**
     * @param $order
     * @return mixed
     */
    public function addCommandOnSession($order)
    {
        $this->ifExistSessionCommand();

        $newCommand = $this->get('session')->get('command');

        $newCommand['buyerFirstName'] = $order->getBuyerFirstName();
        $newCommand['buyerLastName'] = $order->getBuyerLastName();
        $newCommand['buyerEmail'] = $order->getBuyerEmail();
        $newCommand['numberCommand'] = $order->getNumberCommand();
        $newCommand['ticketType'] = $order->getTicketType() === 1 ? "Billet journée" : "Billet demi-journée";
        $newCommand['visitDate'] = $order->getVisitDate();
        $newCommand['totalPrice'] = 0;
        $newCommand['ticket'] = [];
        $tickets = $order->getTickets();
        $i = 0;
        foreach ($tickets as $ticket) {
            $ticketPrices = ($ticket->getReducedPrices() == false ? $ticket->getPrice() : $ticket->getPrice() / 2) / $order->getTicketType();
            $newCommand['ticket'][$i]['prix'] = $ticketPrices;
            $newCommand['totalPrice'] += $ticketPrices;
            $newCommand['ticket'][$i]['nom'] = $ticket->getVisitorFullName();
            $newCommand['ticket'][$i]['reduction'] = $ticket->getReducedPrices();
            $i++;
        }
        $this->get('session')->set('command', $newCommand);
        return $newCommand;
    }

    /**
     * @param Request $request
     * @param $name
     */
    public function removeCommandSession(Request $request, $name)
    {
        $session = $request->getSession();
        $session->remove($name);
    }


}