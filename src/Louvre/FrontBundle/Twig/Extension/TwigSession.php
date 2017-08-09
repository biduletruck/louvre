<?php

namespace Louvre\FrontBundle\Twig\Extension;

use Symfony\Component\HttpFoundation\Session\Session;

class TwigSession extends \Twig_Extension
{
    public function getGlobals() {
        $session = new Session();
        return array(
            'form' => $session->all(),
        );
    }

    public function getName() {
        return 'twig_session';
    }
}