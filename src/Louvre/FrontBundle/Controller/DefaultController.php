<?php

namespace Louvre\FrontBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('LouvreFrontBundle:Default:index.html.twig');
    }

    public function reservationAction()
    {
        return $this->render('LouvreFrontBundle::reservation.html.twig');
    }
}
