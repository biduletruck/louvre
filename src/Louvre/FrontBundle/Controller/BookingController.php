<?php

namespace Louvre\FrontBundle\Controller;


use Louvre\FrontBundle\Entity\Orders;
use Louvre\FrontBundle\Form\OrdersType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class BookingController extends Controller
{
    public function addBookingAction(Request $request)
    {
        $order = new Orders();
        $formOrder = $this->createForm(OrdersType::class, $order);

        return $this->render('@LouvreFront/reservation.html.twig', array(
            'form' => $formOrder->createView(),
        ));
    }


}