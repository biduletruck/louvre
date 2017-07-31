<?php

namespace Louvre\FrontBundle\Validator;

use Symfony\Component\Validator\Constraint;
use Symfony\Component\Validator\ConstraintValidator;

class checkTypeTicketValidator extends ConstraintValidator
{
    public function validate($value, Constraint $constraint)
    {

        $dateValidator = new \DateTime("NOW");

        if ( ($value === '1') && ($dateValidator > date("Y-m-d 14:00:00")) ) {
            $this->context->addViolation($constraint->message);
        }
    }
}
