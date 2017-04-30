<?php

namespace Louvre\FrontBundle\Validator;

use Symfony\Component\Validator\Constraint;

/**
 * @Annotation
 */

class checkTypeTicket extends Constraint
{

    public $message = "Il n'est pas possible de commander un billet journée après 14H00";
}