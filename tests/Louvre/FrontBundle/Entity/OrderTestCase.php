<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 05/05/17
 * Time: 22:32
 */

namespace Louvre\FrontBundle\Entity;

use PHPUnit\Framework\Assert as Assert;

trait OrderTestCase
{

    public function assertOrder(Order $expectedOrder, Order $actualOrder )
    {
        Assert::assertEquals($expectedOrder->getId(), $actualOrder->getId());
        Assert::assertEquals($expectedOrder->getVisitDate(), $actualOrder->getVisitDate());
        Assert::assertEquals($expectedOrder->getTicketType(), $actualOrder->getTicketType());
        Assert::assertEquals($expectedOrder->getBuyerEmail(), $actualOrder->getBuyerEmail());
        Assert::assertEquals($expectedOrder->getBuyerFirstName(), $actualOrder->getBuyerFirstName());
        Assert::assertEquals($expectedOrder->getBuyerLastName(), $actualOrder->getBuyerLastName());
        Assert::assertEquals($expectedOrder->getOrderStatus(), $actualOrder->getOrderStatus());
        Assert::assertEquals($expectedOrder->getPurchaseDate()->format(DATE_ISO8601), $actualOrder->getPurchaseDate()->format(DATE_ISO8601));
        Assert::assertEquals($expectedOrder->getTickets(), $actualOrder->getTickets());

    }

}