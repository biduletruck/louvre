<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 30/07/17
 * Time: 15:07
 */

namespace Louvre\FrontBundle\Services;


use Symfony\Component\DependencyInjection\Container;
use Louvre\FrontBundle\Form\PayementModel;

class CommandService
{
    protected $container;
    protected $order;

    public function __construct(Container $container, $order)
    {
        $this->container = $container;
        $this->order = $order;
    }

    public function prepareCommand($orderModel)
    {
        $payementModel = new PayementModel();
        $payementModel->order = $orderModel;

        $order = $container->get('louvre.front_bundle.entity.order_factory')->createFromModel($orderModel);
        $payementModel->totalAmount = $order->getTotalAmount($order->getVisitDate());
        $payementModel->price = $order->getAmount($order->getVisitDate());
        $payementModel->numberCommand = $order->getNumberCommand();
        $payementForm = $this->createForm(PayementType::class, $payementModel);

        $session = $this->get('session');
        $session->remove('tempOrder');
        $session->set('tempOrder', $payementForm->getData());
    }

}