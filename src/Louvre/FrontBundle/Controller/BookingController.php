<?php

namespace Louvre\FrontBundle\Controller;


use Louvre\FrontBundle\Entity\Orders;
use Louvre\FrontBundle\Form\OrdersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;


class BookingController extends Controller
{
    public function addBookingAction(Request $request)
    {
        $order = new Orders();
        $formOrder = $this->createForm(OrdersType::class, $order);

        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid())
        {
            $em = $this->getDoctrine()->getManager();

            $em->persist($order);
            $em->flush();

            return new Response('Achat validé');
        }

        return $this->render('@LouvreFront/reservation.html.twig', array(
            'form' => $formOrder->createView(),
        ));
    }


}