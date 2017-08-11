<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 28/04/2017
 * Time: 21:29
 */

namespace Louvre\FrontBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class TicketModel
{

    /**
     * @var string
     *
     * @Assert\NotBlank(message="Le nom complet est obligatoire")
     */
    public $visitorFullName;

    /**
     * @Assert\NotBlank()
     */
    public $visitorCountry;

    /**
     * @var \DateTime
     *
     * @Assert\NotNull(message="Une date de naissance est obligatoire")
     */
    public $visitorBirthDate;

    /**
     * @var boolean
     */
    public $reducedPrices;

    /**
     * @var int
     */
    public $price;


}