<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 28/04/2017
 * Time: 22:13
 */

namespace Louvre\FrontBundle\Controller\Booking;


use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Louvre\FrontBundle\Form\OrderModel;
use Louvre\FrontBundle\Form\OrderType;
use Symfony\Component\Form\FormInterface;

abstract class BookinController extends Controller
{
    /**
     * @return \Symfony\Component\Form\Form
     */
    protected function buildOrderForm()
    {
        return $this->createForm(OrderType::class, new OrderModel());
    }

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    protected function renderOrderForm(FormInterface $formOrder)
    {
        return $this->render('@LouvreFront/reservation.html.twig', array(
            'form' => $formOrder->createView()
        ));
    }
}