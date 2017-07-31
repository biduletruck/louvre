<?php

namespace Louvre\FrontBundle\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Billing
 *
 * @ORM\Table(name="billing")
 * @ORM\Entity(repositoryClass="Louvre\FrontBundle\Repository\BillingRepository")
 */
class Billing
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
     * @var string
     *
     * @ORM\Column(name="email", type="string", length=255)
     */
    private $email;

    /**
     * @var string
     *
     * @ORM\Column(name="name", type="string", length=255)
     */
    private $name;

    /**
     * @var int
     *
     * @ORM\Column(name="numberOfTickets", type="integer")
     */
    private $numberOfTickets;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="visitDay", type="datetime")
     */
    private $visitDay;

    /**
     * @var string
     *
     * @ORM\Column(name="numberCommand", type="string", length=255)
     */
    private $numberCommand;

    /**
     * @var string
     *
     * @ORM\Column(name="stripeToken", type="string", length=255)
     */
    private $stripeToken;

    /**
     * @var int
     *
     * @ORM\Column(name="price", type="integer")
     */
    private $price;


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
     * Set email
     *
     * @param string $email
     *
     * @return Billing
     */
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    /**
     * Get email
     *
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * Set name
     *
     * @param string $name
     *
     * @return Billing
     */
    public function setName($name)
    {
        $this->name = $name;

        return $this;
    }

    /**
     * Get name
     *
     * @return string
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * Set numberOfTickets
     *
     * @param integer $numberOfTickets
     *
     * @return Billing
     */
    public function setNumberOfTickets($numberOfTickets)
    {
        $this->numberOfTickets = $numberOfTickets;

        return $this;
    }

    /**
     * Get numberOfTickets
     *
     * @return int
     */
    public function getNumberOfTickets()
    {
        return $this->numberOfTickets;
    }

    /**
     * Set visitDay
     *
     * @param \DateTime $visitDay
     *
     * @return Billing
     */
    public function setVisitDay($visitDay)
    {
        $this->visitDay = $visitDay;

        return $this;
    }

    /**
     * Get visitDay
     *
     * @return \DateTime
     */
    public function getVisitDay()
    {
        return $this->visitDay;
    }

    /**
     * Set numberCommand
     *
     * @param string $numberCommand
     *
     * @return Billing
     */
    public function setNumberCommand($numberCommand)
    {
        $this->numberCommand = $numberCommand;

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
     * Set stripeToken
     *
     * @param string $stripeToken
     *
     * @return Billing
     */
    public function setStripeToken($stripeToken)
    {
        $this->stripeToken = $stripeToken;

        return $this;
    }

    /**
     * Get stripeToken
     *
     * @return string
     */
    public function getStripeToken()
    {
        return $this->stripeToken;
    }

    /**
     * Set price
     *
     * @param integer $price
     *
     * @return Billing
     */
    public function setPrice($price)
    {
        $this->price = $price;

        return $this;
    }

    /**
     * Get price
     *
     * @return int
     */
    public function getPrice()
    {
        return $this->price;
    }
}
