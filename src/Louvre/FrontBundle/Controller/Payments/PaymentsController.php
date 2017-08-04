<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/17
 * Time: 18:30
 */

namespace Louvre\FrontBundle\Controller\Payments;

use Louvre\FrontBundle\Controller\Booking\BookinController;
use Louvre\FrontBundle\Form\OrderType;
use Louvre\FrontBundle\Form\PayementModel;
use Louvre\FrontBundle\Form\PayementType;
use Symfony\Component\HttpFoundation\Request;

class PaymentsController extends BookinController
{
    const MAXVISITORS = 3; //nombre de visiteurs maximum par jour

    public function paymentPrepareOrderAction(Request $request)
    {
        $formOrder = $this->buildOrderForm();
        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid()) {
            $model = $formOrder->getData();
            $orderFactory = $this->get('louvre.front_bundle.entity.order_factory');
            $order = $orderFactory->createFromModel($model);
            $numberOfVisitors = $this->get('louvre.front_bundle.repository.order_repository')->countTicketsByDay($order->getVisitDate()) + count($order->getTickets());

            if ($numberOfVisitors < self::MAXVISITORS )
            {
                return $this->paymentOrderAction($request);
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Désolé plus de place pour cette date');
            }

        }

        return $this->renderOrderForm($formOrder);
    }



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
        $payementModel->totalAmount = $order->getTotalAmount($order->getVisitDate());
        $payementModel->price = $order->getAmount($order->getVisitDate());
        $payementModel->numberCommand = $order->getNumberCommand();
        $payementForm = $this->createForm(PayementType::class, $payementModel);

        return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $payementForm->getData()
        ));
    }
}