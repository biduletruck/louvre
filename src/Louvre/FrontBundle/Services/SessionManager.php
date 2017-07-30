<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 29/07/17
 * Time: 18:34
 */

namespace Louvre\FrontBundle\Services;


use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Session\Session;



class SessionManager
{
    protected $session;
    protected $request;

    public function __construct(Session $session, RequestStack $request)
    {
        $this->session = $session;
        $this->request = $request;
    }

    public function ifExistSessionCommand()
    {
        if (!$this->session->has('command')) {
            $this->session->set('command', array());
        }
        return $this->session;
    }

    public function addCommandOnSession($order)
    {
        $this->ifExistSessionCommand();

        $newCommand = $this->session->get('command');
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
            $ticketPrices = ($ticket->getReducedPrices() == false ? $ticket->getPrice() : $ticket->getPrice() / 2) / $order->getTicketType();
            $newCommand['ticket'][$i]['prix'] = $ticketPrices;
            $newCommand['totalPrice'] += $ticketPrices;
            $newCommand['ticket'][$i]['nom'] = $ticket->getVisitorFullName();
            $newCommand['ticket'][$i]['reduction'] = $ticket->getReducedPrices();
            $i++;
        }
        $this->session->set('command', $newCommand);
        return $newCommand;
    }

    /**
     * @param Request $request
     * @param $name
     */
    public function removeCommandSession(Request $request, $name)
    {
        $session = $request->getSession();
        $session->remove($name);
    }

}