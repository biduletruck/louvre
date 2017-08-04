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

    const MAXVISITORS = 1; //nombre de visiteurs maximum par jour

    /**
     * @param $order
     * @return bool
     */
    public function checkSumOfVisitors(Request $request, $visitDate, $countTicket)
    {
        $numberTicketsInBase = $request->get('louvre_front.repository.order_repository.count_visitors', $visitDate );
        $numberTickets = $countTicket;

        dump($numberTicketsInBase);
        dump($numberTickets);

        return ( $numberTicketsInBase + $numberTickets ) < self::MAXVISITORS;
    }

}