<?php

namespace Louvre\FrontBundle\Form;



class PayementModel
{


    /**
     * @var int
     */
    public $totalAmount;

    /**
     * @var array
     */
    public $price;

    /**
     * @var string
     */
    public $numberCommand;

    /**
     * @var OrderModel
     */
    public $order;

}
