<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/17
 * Time: 18:30
 */

namespace Louvre\FrontBundle\Controller\Payments;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class PaymentsController extends Controller
{
    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paymentOrderAction()
    {
        return $this->render('@LouvreFront/prepare.html.twig');
    }
}