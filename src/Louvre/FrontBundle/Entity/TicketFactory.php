<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 06/05/17
 * Time: 07:47
 */

namespace Louvre\FrontBundle\Entity;


use Louvre\FrontBundle\Form\OrderModel;
use Louvre\FrontBundle\Form\TicketModel;

class TicketFactory
{
    /**
     * @param TicketModel $ticketModel
     * @return Ticket
     */
    private function createFromTicketModel( TicketModel $ticketModel)
    {
        $ticket = new Ticket();
        $ticket->setVisitorFullName($ticketModel->visitorFullName);
        $ticket->setVisitorBirthDate($ticketModel->visitorBirthDate);
        $ticket->setVisitorCountry($ticketModel->visitorCountry);
        $ticket->setReducedPrices($ticketModel->reducedPrices);
        //$ticket->getPrice();

        return $ticket;
    }

    /**
     * @param array $ticketModels
     * @return Ticket[]
     */
    public function createFromTicketModelCollection(array $ticketModels=array())
    {
        $data = [];
        foreach ($ticketModels as $ticketModel)
        {
            $data[] = $this->createFromTicketModel($ticketModel);
        }
        return $data;
    }
}