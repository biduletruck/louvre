<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/17
 * Time: 18:30
 */

namespace Louvre\FrontBundle\Controller\Payments;

use Louvre\FrontBundle\Entity\OrderFactory;
use Louvre\FrontBundle\Form\OrderModel;
use Louvre\FrontBundle\Form\OrderType;
use Louvre\FrontBundle\Form\PayementModel;
use Louvre\FrontBundle\Form\PayementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentsController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paymentOrderAction(Request $request)
    {

        $form = $this->createForm(OrderType::class, new OrderModel());
        $form->handleRequest($request);
        return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $form->getData()
        ));
    }
}