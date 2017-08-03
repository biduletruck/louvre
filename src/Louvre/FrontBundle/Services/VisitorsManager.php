<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 30/07/17
 * Time: 15:33
 */

namespace Louvre\FrontBundle\Services;


use Louvre\FrontBundle\Entity\Order;
use Symfony\Component\HttpFoundation\Request;



class VisitorsManager
{

    const MAXVISITORS = 1000; //nombre de visiteurs maximum par jour

    /**
     * @param $order
     * @return bool
     */
    public function checkSumOfVisitors(Request $request, Order $order)
    {
        return $request->get('louvre_front.repository.order_repository.count_visitors', $order->getVisitDate()) < self::MAXVISITORS;
    }

}