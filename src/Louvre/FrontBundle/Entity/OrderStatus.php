<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 05/05/17
 * Time: 22:48
 */

namespace Louvre\FrontBundle\Entity;


final class OrderStatus
{
    const VALIDATED = 1;

    const PENDING = 0;

    private function __construct()
    {

    }

}