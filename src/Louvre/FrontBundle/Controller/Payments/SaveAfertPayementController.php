<?php

namespace Louvre\FrontBundle\Controller\Payments;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class SaveAfertPayementController extends Controller
{
    /**
     * @param  Request $request
     *
     */
    public function saveOrderInBaseAction( Request $request)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($request);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Merci pour votre réservation.');

       // return $this->redirect($this->generateUrl('louvre_front_showorder'));
    }

}
