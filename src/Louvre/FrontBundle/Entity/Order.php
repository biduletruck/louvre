<?php

namespace Louvre\FrontBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;


/**
 * Order
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Louvre\FrontBundle\Repository\OrderRepository")
 *
 */

class Order
{

    /**
     * @var int
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     *
     */
    protected $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchaseDate", type="datetime")
     *
     */
    protected $purchaseDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visitDate", type="date")
     *
     */
    protected $visitDate;

    /**
     * @var int
     *
     * @ORM\Column(name="ticketType", type="integer")
     *
     *
     */
    protected $ticketType;

    /**
     * @var string
     *
     * @ORM\Column(name="buyerLastName", type="string", length=255)
     *
     *
     */
    protected $buyerLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="buyerFirstName", type="string", length=255)
     *
     *
     */
    protected $buyerFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="buyerEmail", type="string", length=255)
     *
     *
     */
    protected $buyerEmail;


    /**
     * @var integer
     * @ORM\Column(name="orderStatus", type="integer")
     */
    protected $orderStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="numberCommand", type="string", length=255)
     */
    protected $numberCommand;


    /**
     *
     * @ORM\OneToMany(targetEntity="\Louvre\FrontBundle\Entity\Ticket" , mappedBy="order" , cascade={"persist"})
     * @var Ticket[] | ArrayCollection
     */
    protected $tickets;

    public function __construct()
    {
        $this->purchaseDate = new \DateTime("NOW");
        $this->orderStatus = OrderStatus::PENDING;
        $this->tickets = new ArrayCollection();
    }

    /**
     * Get id
     *
     * @return integer
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set purchaseDate
     *
     * @param \DateTime $purchaseDate
     *
     * @return Order
     */
    public function setPurchaseDate($purchaseDate)
    {
        $this->purchaseDate = $purchaseDate;

        return $this;
    }

    /**
     * Get purchaseDate
     *
     * @return \DateTime
     */
    public function getPurchaseDate()
    {
        return $this->purchaseDate;
    }

    /**
     * Set visitDate
     *
     * @param \DateTime $visitDate
     *
     * @return Order
     */
    public function setVisitDate($visitDate)
    {
        $this->visitDate = $visitDate;

        return $this;
    }

    /**
     * Get visitDate
     *
     * @return \DateTime
     */
    public function getVisitDate()
    {
        return $this->visitDate;
    }

    /**
     * Set buyerLastName
     *
     * @param string $buyerLastName
     *
     * @return Order
     */
    public function setBuyerLastName($buyerLastName)
    {
        $this->buyerLastName = $buyerLastName;

        return $this;
    }

    /**
     * Get buyerLastName
     *
     * @return string
     */
    public function getBuyerLastName()
    {
        return $this->buyerLastName;
    }

    /**
     * Set buyerFirstName
     *
     * @param string $buyerFirstName
     *
     * @return Order
     */
    public function setBuyerFirstName($buyerFirstName)
    {
        $this->buyerFirstName = $buyerFirstName;

        return $this;
    }

    /**
     * Get buyerFirstName
     *
     * @return string
     */
    public function getBuyerFirstName()
    {
        return $this->buyerFirstName;
    }

    /**
     * Set buyerEmail
     *
     * @param string $buyerEmail
     *
     * @return Order
     */
    public function setBuyerEmail($buyerEmail)
    {
        $this->buyerEmail = $buyerEmail;

        return $this;
    }

    /**
     * Get buyerEmail
     *
     * @return string
     */
    public function getBuyerEmail()
    {
        return $this->buyerEmail;
    }

    /**
     * Set ticketType
     *
     * @param integer $ticketType
     *
     * @return Order
     */
    public function setTicketType($ticketType)
    {
        $this->ticketType = $ticketType;

        return $this;
    }

    /**
     * Get ticketType
     *
     * @return integer
     */
    public function getTicketType()
    {
        return $this->ticketType;
    }

    /**
     * Set tickets
     *
     * @param \Louvre\FrontBundle\Entity\Ticket[] $tickets
     *
     */
    public function setTickets(array $tickets)
    {
        foreach ($tickets as $ticket)
        {
            $ticket->setOrder($this);
            $this->tickets->add($ticket);
        }
    }

    /**
     * Get tickets
     *
     * @return ArrayCollection | Ticket[]
     */
    public function getTickets()
    {
        return $this->tickets;
    }

    /**
     * Set orderStatus
     *
     * @param integer $orderStatus
     *
     * @return Order
     */
    public function setOrderStatus($orderStatus)
    {
        $this->orderStatus = $orderStatus;

        return $this;
    }

    /**
     * Get orderStatus
     *
     * @return integer
     */
    public function getOrderStatus()
    {
        return $this->orderStatus;
    }

    /**
     * Set numberCommand
     *
     *
     * @return Order
     */
    public function setNumberCommand()
    {
        $this->numberCommand = $this->generateNumberCommand();

        return $this;
    }

    /**
     * Get numberCommand
     *
     * @return string
     */
    public function getNumberCommand()
    {
        return $this->numberCommand;
    }

    /**
     * Add ticket
     *
     * @param \Louvre\FrontBundle\Entity\Ticket $ticket
     *
     * @return Order
     */
    public function addTicket(\Louvre\FrontBundle\Entity\Ticket $ticket)
    {
        $this->tickets[] = $ticket;

        return $this;
    }

    /**
     * Remove ticket
     *
     * @param \Louvre\FrontBundle\Entity\Ticket $ticket
     */
    public function removeTicket(\Louvre\FrontBundle\Entity\Ticket $ticket)
    {
        $this->tickets->removeElement($ticket);
    }


    public function generateNumberCommand()
    {
        return uniqid('LPC');
    }


    public function getTotalAmount()
    {
        $amount = 0;

        foreach ($this->getTickets() as $ticket)
        {
            $amount += $ticket->getPrice();
        }

        return $amount / $this->getTicketType();
    }

    public function getAmount()
    {

        $price = [];


        foreach ($this->getTickets() as $ticket)
        {
            $price[] = $ticket->getPrice() / $this->getTicketType();
        }

        return $price;


    }

}
