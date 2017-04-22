<?php

namespace Louvre\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Tickets
 *
 * @ORM\Table(name="Tickets")
 * @ORM\Entity(repositoryClass="Louvre\FrontBundle\Repository\TicketsRepository")
 */
class Tickets
{

    /**
     * @ORM\ManyToOne(targetEntity="Louvre\FrontBundle\Entity\Orders")
     * @ORM\JoinColumn(nullable=false)
     */
    private $order;


    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var string
     *
     * @ORM\Column(name="visitorLastName", type="string", length=50)
     */
    private $visitorLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="visitorFirstName", type="string", length=50)
     */
    private $visitorFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="visitorCountry", type="string", length=100)
     */
    private $visitorCountry;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visitorBirthDate", type="date")
     */
    private $visitorBirthDate;

    /**
     * @var bool
     *
     * @ORM\Column(name="reducedPrices", type="boolean")
     */
    private $reducedPrices;

    /**
     * @var string
     *
     * @ORM\Column(name="ticketPrices", type="decimal", precision=10, scale=2)
     */
    private $ticketPrices;


    /**
     * Get id
     *
     * @return int
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * Set visitorLastName
     *
     * @param string $visitorLastName
     *
     * @return Tickets
     */
    public function setVisitorLastName($visitorLastName)
    {
        $this->visitorLastName = $visitorLastName;

        return $this;
    }

    /**
     * Get visitorLastName
     *
     * @return string
     */
    public function getVisitorLastName()
    {
        return $this->visitorLastName;
    }

    /**
     * Set visitorFirstName
     *
     * @param string $visitorFirstName
     *
     * @return Tickets
     */
    public function setVisitorFirstName($visitorFirstName)
    {
        $this->visitorFirstName = $visitorFirstName;

        return $this;
    }

    /**
     * Get visitorFirstName
     *
     * @return string
     */
    public function getVisitorFirstName()
    {
        return $this->visitorFirstName;
    }

    /**
     * Set visitorCountry
     *
     * @param string $visitorCountry
     *
     * @return Tickets
     */
    public function setVisitorCountry($visitorCountry)
    {
        $this->visitorCountry = $visitorCountry;

        return $this;
    }

    /**
     * Get visitorCountry
     *
     * @return string
     */
    public function getVisitorCountry()
    {
        return $this->visitorCountry;
    }

    /**
     * Set visitorBirthDate
     *
     * @param \DateTime $visitorBirthDate
     *
     * @return Tickets
     */
    public function setVisitorBirthDate($visitorBirthDate)
    {
        $this->visitorBirthDate = $visitorBirthDate;

        return $this;
    }

    /**
     * Get visitorBirthDate
     *
     * @return \DateTime
     */
    public function getVisitorBirthDate()
    {
        return $this->visitorBirthDate;
    }

    /**
     * Set reducedPrices
     *
     * @param boolean $reducedPrices
     *
     * @return Tickets
     */
    public function setReducedPrices($reducedPrices)
    {
        $this->reducedPrices = $reducedPrices;

        return $this;
    }

    /**
     * Get reducedPrices
     *
     * @return bool
     */
    public function getReducedPrices()
    {
        return $this->reducedPrices;
    }

    /**
     * Set ticketPrices
     *
     * @param string $ticketPrices
     *
     * @return Tickets
     */
    public function setTicketPrices($ticketPrices)
    {
        $this->ticketPrices = $ticketPrices;

        return $this;
    }

    /**
     * Get ticketPrices
     *
     * @return string
     */
    public function getTicketPrices()
    {
        return $this->ticketPrices;
    }

    /**
     * Set order
     *
     * @param \Louvre\FrontBundle\Entity\Orders $order
     *
     * @return Tickets
     */
    public function setOrder(\Louvre\FrontBundle\Entity\Orders $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Louvre\FrontBundle\Entity\Orders
     */
    public function getOrder()
    {
        return $this->order;
    }
}
