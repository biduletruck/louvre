<?php

namespace Louvre\FrontBundle\Controller\Booking;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;

class SaveBookingController extends BookinController
{
    public function saveOrderAction(Request $request)
    {
        $formOrder = $this->buildOrderForm();

        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid())
        {
            /*
            $em = $this->getDoctrine()->getManager();

            $em->persist($order);
            $em->flush();
            */

            return new Response('Achat validé');
        }

        return $this->renderOrderForm($formOrder);
    }

}