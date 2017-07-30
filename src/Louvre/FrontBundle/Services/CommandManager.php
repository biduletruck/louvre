<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 30/07/17
 * Time: 15:07
 */

namespace Louvre\FrontBundle\Services;


use Louvre\FrontBundle\Entity\Order;

class CommandManager
{

    public $Command = [];
    private $reducePrice = 10;

    /**
     * @param $order
     * @return array
     */
    public function addNewCommand(Order $order)
    {
        $newCommand = [];

        $newCommand['buyerFirstName'] = $order->getBuyerFirstName();
        $newCommand['buyerLastName'] = $order->getBuyerLastName();
        $newCommand['buyerEmail'] = $order->getBuyerEmail();
        $newCommand['numberCommand'] = $order->getNumberCommand();
        $newCommand['ticketType'] = $order->getTicketType() === 1 ? "Billet journée" : "Billet demi-journée";
        $newCommand['visitDate'] = $order->getVisitDate();
        $newCommand['totalPrice'] = 0;
        $newCommand['ticket'] = [];
        $tickets = $order->getTickets();
        $i = 0;
        foreach ($tickets as $ticket) {
            $ticketPrices = ($ticket->getReducedPrices() == false ? $ticket->getPrice() : $this->reducePrice) / $order->getTicketType();
            $newCommand['ticket'][$i]['prix'] = $ticketPrices;
            $newCommand['totalPrice'] += $ticketPrices;
            $newCommand['ticket'][$i]['nom'] = $ticket->getVisitorFullName();
            $newCommand['ticket'][$i]['reduction'] = $ticket->getReducedPrices();
            $i++;
        }

        return $this->Command = $newCommand;
    }

}