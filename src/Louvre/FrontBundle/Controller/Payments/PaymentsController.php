<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/17
 * Time: 18:30
 */

namespace Louvre\FrontBundle\Controller\Payments;

use Louvre\FrontBundle\Form\OrderType;
use Louvre\FrontBundle\Form\TicketType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentsController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paymentOrderAction(Request $request)
    {

        $form = $this->createForm(OrderType::class);
        $form->handleRequest($request);
        return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $form->getData()
        ));
    }
}