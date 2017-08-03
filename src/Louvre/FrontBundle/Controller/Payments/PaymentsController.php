<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/17
 * Time: 18:30
 */

namespace Louvre\FrontBundle\Controller\Payments;

use Louvre\FrontBundle\Form\OrderType;
use Louvre\FrontBundle\Form\PayementModel;
use Louvre\FrontBundle\Form\PayementType;
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

        $orderForm = $this->createForm(OrderType::class);
        $orderForm->handleRequest($request);
        $orderModel = $orderForm->getData();

        $payementModel = new PayementModel();
        $payementModel->order = $orderModel;

        $order = $this->get('louvre.front_bundle.entity.order_factory')->createFromModel($orderModel);
        $payementModel->totalAmount = $order->getTotalAmount() / $order->getTicketType();
        $payementModel->price = $order->getAmount();
        $payementModel->numberCommand = $order->getNumberCommand();
        $payementForm = $this->createForm(PayementType::class, $payementModel);

        return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $payementForm->getData()
        ));
    }
}