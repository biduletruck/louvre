<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 28/04/2017
 * Time: 21:29
 */

namespace Louvre\FrontBundle\Form;

use Symfony\Component\Validator\Constraints as Assert;

class TicketsModel
{

    /**
     *
     * @Assert\NotBlank(message="Le nom complet est obligatoire")
     */
    public $visitorFullName;

    public function isValidTicket()
    {
        // to do;
    }

}