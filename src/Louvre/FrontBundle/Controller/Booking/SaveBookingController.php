<?php

namespace Louvre\FrontBundle\Controller\Booking;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;


class SaveBookingController extends BookinController
{
    public function saveOrderAction(Request $request)
    {
        $formOrder = $this->buildOrderForm();

        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid())
        {

            $model = $formOrder->getData();

            $order = $this->get('louvre.front_bundle.entity.order_factory')->createFromModel($model);
           // $ticket = $this->get('louvre.front_bundle.entity.ticket_factory')->createFromTicketModel($model);

            $em = $this->getDoctrine()->getManager();

            $em->persist($order);
            $em->flush();

            $this->get('session')->getFlashBag()->add('error', 'Merci pour votre réservation');


           // $this->get('session')->setFlash('notice', 'Merci pour votre réservation');
            return $this->redirect($this->generateUrl('louvre_front_showorder'));



            //return new Response('Achat validé');
        }

        return $this->renderOrderForm($formOrder);
    }

}