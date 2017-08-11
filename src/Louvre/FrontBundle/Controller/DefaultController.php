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

    public function horairesAction()
    {
        return $this->render('@LouvreFront/ressources/horaires.html.twig');
    }

    public function mentionsLegalesAction()
    {
        return $this->render('@LouvreFront/ressources/mentions_legales.html.twig');
    }

    public function contactAction()
    {
        return $this->render('@LouvreFront/ressources/contact.html.twig');
    }
}
