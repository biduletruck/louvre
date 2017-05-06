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
     * @param OrderModel $orderModel
     * @return Orders
     */
    public function createFromModel(OrderModel $orderModel)
    {
        $order = new Orders();
        $order->setVisitDate($orderModel->visitDate);
        $order->setTicketType($orderModel->ticketType);
        $order->setBuyerEmail($orderModel->buyerEmail);
        $order->setBuyerFirstName($orderModel->buyerFirstName);
        $order->setBuyerLastName($orderModel->buyerLastName);

        return $order;
    }

}