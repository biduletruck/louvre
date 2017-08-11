<?php

namespace Louvre\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Validator\Constraints\DateTime;


/**
 * Ticket
 *
 * @ORM\Table(name="tickets")
 * @ORM\Entity(repositoryClass="\Louvre\FrontBundle\Repository\TicketRepository")
 */
class Ticket
{
    /**
     * @ORM\ManyToOne(targetEntity="\Louvre\FrontBundle\Entity\Order", inversedBy="tickets")
     * @ORM\JoinColumn(nullable=false)
     * @var Order
     *
     */
    protected $order;

    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @var string
     *
     * @ORM\Column(name="visitorFullName", type="string", length=255)
     *
     */
    protected $visitorFullName;

    /**
     * @var
     *
     * @ORM\Column(name="visitorCountry", type="string", length=2555)
     */
    protected $visitorCountry;

    /**
     * @var
     *
     * @ORM\Column(name="visitorBirthDate", type="date")
     */
    protected $visitorBirthDate;

    /**
     * @var
     *
     * @ORM\Column(name="reducedPrices", type="boolean")
     */
    protected $reducedPrices;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    protected  $price = 0;


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
     * @return Ticket
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
     * @param \Louvre\FrontBundle\Entity\Order $order
     *
     * @return Ticket
     */
    public function setOrder(\Louvre\FrontBundle\Entity\Order $order)
    {
        $this->order = $order;

        return $this;
    }

    /**
     * Get order
     *
     * @return \Louvre\FrontBundle\Entity\Order
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
     * @return Ticket
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
     * @return Ticket
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
     * @return Ticket
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


    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {

        $diff = date_diff($this->getOrder()->getVisitDate(),$this->getVisitorBirthDate());

        switch (true) {
            case $diff->y < 4:
                $price = 0;
                break;
            case $diff->y < 12:
                $price = 8;
                break;
            case $this->getReducedPrices() == true:
                $price = 10;
                break;
            case $diff->y >= 60:
                $price = 12;
                break;
            default:
                $price = 16;
        }

        return $price;
    }

}
