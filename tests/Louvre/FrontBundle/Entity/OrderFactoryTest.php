<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 05/05/17
 * Time: 21:37
 */

namespace Louvre\FrontBundle\Entity;

use Louvre\FrontBundle\Form\OrderModel;
use PHPUnit\Framework\TestCase;

class OrderFactoryTest extends TestCase
{
    use OrderTestCase;

    /**
     * @test
     *
     */
    public function emptyModelReturnEmptyEntity()
    {
        $orderFactory = new OrderFactory();
        $actualOrder = $orderFactory->createFromModel(new OrderModel());

       $this->assertOrder(new Order(), $actualOrder);
    }

    /**
     * @test
     *
     */
    public function withOrderModelReturnOrderEntity()
    {
        $orderModel = new OrderModel();
        $orderModel->visitDate = new \DateTime(OrderStub::VISITEDATE);
        $orderModel->buyerEmail = OrderStub::BUYEREMAIL;
        $orderModel->buyerFirstName = OrderStub::BUYER_FIRST_NAME;
        $orderModel->buyerLastName = OrderStub::BUYER_LAST_NAME;
        $orderModel->ticketType = OrderStub::TICKET_TYPE;
        $orderModel->tickets = [];

        $orderFactory = $this->getOrderFactoryService();
        $actualOrder = $orderFactory->createFromModel($orderModel);

        $this->assertOrder(new OrderStub(), $actualOrder);
    }

    /**
     * @return OrderFactory
     */
    protected function getOrderFactoryService()
    {
        $orderFactory = new OrderFactory();
        $orderFactory->setTicketFactory($this->getTicketFactoryService());
        return $orderFactory;
    }

    /**
     * @return TicketFactory
     */
    protected function getTicketFactoryService()
    {
        return new TicketFactory();
    }

}
