<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 11/08/17
 * Time: 16:38
 */

namespace Louvre\FrontBundle\Entity;


class BillingFactory
{

    public function createFromBilling($customer, $session)
    {
        $billing = new Billing();
        $billing->setTransactionId($customer->id);
        $billing->setTransactionAmount($customer->amount / 100);
        $billing->setTransactionCreated($customer->created);
        $billing->setTransactionStatus($customer->status);
        $billing->setNumCommand($session->numberCommand);
        $billing->setDateCommand(new \DateTime("NOW"));
        return $billing;
    }

}