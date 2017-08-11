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
     * @ORM\Column(name="transactionId", type="string", length=255, unique=true)
     */
    private $transactionId;

    /**
     * @var int
     *
     * @ORM\Column(name="transactionAmount", type="integer")
     */
    private $transactionAmount;

    /**
     * @var int
     *
     * @ORM\Column(name="transactionCreated", type="integer")
     */
    private $transactionCreated;

    /**
     * @var string
     *
     * @ORM\Column(name="transactionStatus", type="string", length=255)
     */
    private $transactionStatus;

    /**
     * @var string
     *
     * @ORM\Column(name="numCommand", type="string", length=255)
     */
    private $numCommand;

    /**
     * @var \DateTime
     *
     * @ORM\Column(name="dateCommand", type="datetime")
     */
    private $dateCommand;


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
     * Set transactionId
     *
     * @param string $transactionId
     *
     * @return Billing
     */
    public function setTransactionId($transactionId)
    {
        $this->transactionId = $transactionId;

        return $this;
    }

    /**
     * Get transactionId
     *
     * @return string
     */
    public function getTransactionId()
    {
        return $this->transactionId;
    }

    /**
     * Set transactionAmount
     *
     * @param integer $transactionAmount
     *
     * @return Billing
     */
    public function setTransactionAmount($transactionAmount)
    {
        $this->transactionAmount = $transactionAmount;

        return $this;
    }

    /**
     * Get transactionAmount
     *
     * @return int
     */
    public function getTransactionAmount()
    {
        return $this->transactionAmount;
    }

    /**
     * Set transactionCreated
     *
     * @param integer $transactionCreated
     *
     * @return Billing
     */
    public function setTransactionCreated($transactionCreated)
    {
        $this->transactionCreated = $transactionCreated;

        return $this;
    }

    /**
     * Get transactionCreated
     *
     * @return int
     */
    public function getTransactionCreated()
    {
        return $this->transactionCreated;
    }

    /**
     * Set transactionStatus
     *
     * @param string $transactionStatus
     *
     * @return Billing
     */
    public function setTransactionStatus($transactionStatus)
    {
        $this->transactionStatus = $transactionStatus;

        return $this;
    }

    /**
     * Get transactionStatus
     *
     * @return string
     */
    public function getTransactionStatus()
    {
        return $this->transactionStatus;
    }

    /**
     * Set numCommand
     *
     * @param string $numCommand
     *
     * @return Billing
     */
    public function setNumCommand($numCommand)
    {
        $this->numCommand = $numCommand;

        return $this;
    }

    /**
     * Get numCommand
     *
     * @return string
     */
    public function getNumCommand()
    {
        return $this->numCommand;
    }

    /**
     * Set dateCommand
     *
     * @param \DateTime $dateCommand
     *
     * @return Billing
     */
    public function setDateCommand($dateCommand)
    {
        $this->dateCommand = $dateCommand;

        return $this;
    }

    /**
     * Get dateCommand
     *
     * @return \DateTime
     */
    public function getDateCommand()
    {
        return $this->dateCommand;
    }
}
