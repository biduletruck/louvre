<?php

namespace Louvre\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;


/**
 * Tickets
 *
 * @ORM\Table(name="tickets")
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
     * @ORM\Column(name="visitorFullName", type="string", length=255)
     *
     */
    private $visitorFullName;

    /**
     * @var
     *
     * @ORM\Column(name="visitorCountry", type="string", length=2555)
     */
    private $visitorCountry;

    /**
     * @var
     *
     * @ORM\Column(name="visitorBirthDate", type="date")
     */
    private $visitorBirthDate;

    /**
     * @var
     *
     * @ORM\Column(name="reducedPrices", type="boolean")
     */
    private $reducedPrices;

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
     * Set visitorFullName
     *
     * @param string $visitorFullName
     *
     * @return Tickets
     */
    public function setVisitorFullName($visitorFullName)
    {
        $this->visitorFullName = $visitorFullName;

        return $this;
    }

    /**
     * Get visitorFullName
     *
     * @return string
     */
    public function getVisitorFullName()
    {
        return $this->visitorFullName;
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
     * @return boolean
     */
    public function getReducedPrices()
    {
        return $this->reducedPrices;
    }
}
