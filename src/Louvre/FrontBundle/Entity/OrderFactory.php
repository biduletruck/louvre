<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 05/05/17
 * Time: 21:34
 */

namespace Louvre\FrontBundle\Entity;


use Louvre\FrontBundle\Form\OrderModel;

class OrderFactory
{
    /**
     * @var TicketFactory
     */
    private $ticketFactory;

    public function setTicketFactory(TicketFactory $ticketFactory)
    {
        $this->ticketFactory = $ticketFactory;
    }

    /**
     * @param OrderModel $orderModel
     * @return Order
     */
    public function createFromModel(OrderModel $orderModel)
    {
        $order = new Order();
        $order->setVisitDate($orderModel->visitDate);
        $order->setTicketType($orderModel->ticketType);
        $order->setBuyerEmail($orderModel->buyerEmail);
        $order->setBuyerFirstName($orderModel->buyerFirstName);
        $order->setBuyerLastName($orderModel->buyerLastName);
        $order->setTickets($this->ticketFactory->createFromTicketModelCollection($orderModel->tickets));

        return $order;
    }



}