<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 28/04/2017
 * Time: 21:20
 */

namespace Louvre\FrontBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

class OrderModel
{

    /**
     * @var \DateTime
     *
     * @Assert\NotNull(message="Une date est obligatoire")
     * @Assert\GreaterThanOrEqual("today")
     */
    public $visitDate;

    /**
     * @var int
     *
     */
    public $ticketType;

    /**
     * @Assert\NotBlank(message="Un prénom est obligatoire")
     */
    public $buyerLastName;

    /**
     *@Assert\NotBlank(message="Un nom est obligatoire")
     */
    public $buyerFirstName;

    /**
     * @Assert\NotBlank(message="Le champs doit contenir un Email valide")
     * @Assert\Email()
     */
    public $buyerEmail;

    /**
     * @var TicketModel[]
     * @Assert\Valid()
     * @Assert\Type(type="Louvre\FrontBundle\Entity\Ticket")
     */
    public $tickets;


    /**
     * @Assert\Callback
     */
    public function ticketIsValid(ExecutionContextInterface $context)
    {
        $dateValidator = new \DateTime("NOW");

        if(!empty($this->visitDate) )
        {
            if ( ($this->ticketType === "1") && ($this->visitDate->format("Y-m-d") === date("Y-m-d")) )
            {
                if ( $dateValidator->format("Y-m-d H:i") > date("Y-m-d 14:00") )
                {
                    $context->buildViolation('Il n\'est pas possible de commander un billet journée après 14H00!')
                        ->atPath('ticketType')
                        ->addViolation();}
            }
        }

        if(empty($this->tickets))
        {
            // a faire $context;
        }

    }


}