<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 05/05/17
 * Time: 22:43
 */

namespace Louvre\FrontBundle\Entity;


class OrderStub extends Order
{


    protected $purchaseDate;

    protected $visitDate;

    protected $ticketType = self::TICKET_TYPE;

    protected $buyerLastName = self::BUYER_LAST_NAME;

    protected $buyerFirstName = self::BUYER_FIRST_NAME;

    protected $buyerEmail = self::BUYEREMAIL;

    protected $orderStatus = OrderStatus::PENDING;


    const PURCASEDATE = '2017-01-01';

    const VISITEDATE = '2017-01-02';

    const BUYEREMAIL = "buyeremail@buyeremail.fr";

    const BUYER_FIRST_NAME = "buyer First Name Exemple Stub";

    const BUYER_LAST_NAME = "buyer Last Name Exemple Stub";

    const TICKET_TYPE = 1;

    public function __construct()
    {
      parent::__construct();
        $this->visitDate = new \DateTime(self::VISITEDATE);
    }


}