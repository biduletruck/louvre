<?php

namespace Louvre\FrontBundle\Controller;


use Louvre\FrontBundle\Entity\Orders;
use Louvre\FrontBundle\Entity\Tickets;
use Louvre\FrontBundle\Form\OrdersType;
use Louvre\FrontBundle\Form\TicketsType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class BookingController extends Controller
{
    public function addBookingAction()
    {

    }

    public function addOrderAction()
    {
        $order = new Orders();
        $formOrder = $this->createForm(OrdersType::class, $order);
        $formOrderView = $formOrder->createView();
    }

    public function addTicketAction()
    {
        $ticket = new Tickets();
        $formTicket = $this->createForm(TicketsType::class, $ticket);
        $formTicketView = $formTicket->createView();
    }


}