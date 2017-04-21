<?php

namespace Louvre\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Orders
 *
 * @ORM\Table(name="orders")
 * @ORM\Entity(repositoryClass="Louvre\FrontBundle\Repository\OrdersRepository")
 */
class Orders
{
    /**
     * @var int
     *
     * @ORM\Column(name="id", type="integer")
     * @ORM\Id
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    private $id;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="purchaseDate", type="datetime")
     */
    private $purchaseDate;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visitDate", type="date")
     */
    private $visitDate;

    /**
     * @var int
     *
     * @ORM\Column(name="ticketType", type="integer")
     */
    private $ticketType;

    /**
     * @var string
     *
     * @ORM\Column(name="buyerLastName", type="string", length=50)
     */
    private $buyerLastName;

    /**
     * @var string
     *
     * @ORM\Column(name="buyerFirstName", type="string", length=50)
     */
    private $buyerFirstName;

    /**
     * @var string
     *
     * @ORM\Column(name="buyerEmail", type="string", length=100)
     */
    private $buyerEmail;

    public function __construct()
    {
        $this->purchaseDate = new \DateTime('NOW');
    }

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
     * Set purchaseDate
     *
     * @param \DateTime $purchaseDate
     *
     * @return Orders
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
     * @return Orders
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
     * Set ticketType
     *
     * @param integer $ticketType
     *
     * @return Orders
     */
    public function setTicketType($ticketType)
    {
        $this->ticketType = $ticketType;

        return $this;
    }

    /**
     * Get ticketType
     *
     * @return int
     */
    public function getTicketType()
    {
        return $this->ticketType;
    }

    /**
     * Set buyerLastName
     *
     * @param string $buyerLastName
     *
     * @return Orders
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
     * @return Orders
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
     * @return Orders
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
}

