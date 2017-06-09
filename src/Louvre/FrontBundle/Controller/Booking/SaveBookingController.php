<?php

namespace Louvre\FrontBundle\Controller\Booking;

use Symfony\Component\HttpFoundation\Request;


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

            $em = $this->getDoctrine()->getManager();

            $em->persist($order);
            $em->flush();

            $this->get('session')->getFlashBag()->add('error', 'Merci pour votre réservation');

            return $this->redirect($this->generateUrl('louvre_front_showorder'));

            //return new Response('Achat validé');
        }

        return $this->renderOrderForm($formOrder);
    }

}