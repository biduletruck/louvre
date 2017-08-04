<?php

namespace Louvre\FrontBundle\Controller\Booking;


use Louvre\FrontBundle\Controller\Payments\PaymentsController;
use Louvre\FrontBundle\Entity\Order;
use Louvre\FrontBundle\Entity\OrderFactory;
use Louvre\FrontBundle\Form\OrderModel;
use Symfony\Component\HttpFoundation\Request;


class SaveBookingController extends BookinController
{



    public function saveOrderAction(Request $request)
    {

        $formOrder = $this->buildOrderForm();
        $formOrder->handleRequest($request);

        if ($formOrder->isSubmitted() && $formOrder->isValid())
        {
            $model = $formOrder->getData();
            $orderFactory = $this->get('louvre.front_bundle.entity.order_factory');
            $order = $orderFactory->createFromModel($model);

            return $this->container->get('louvre_front.controller.save_afert_payement_controller', $order);
            //dump($order);


         /*
            if ($this->checkSumOfVisitors($order))
            {
                return $this->saveOrderInBase($order);
            }else{
                $this->get('session')->getFlashBag()->add('error', 'Désolé plus de place pour cette date');
            }

*/
        }

        return $this->renderOrderForm($formOrder);
    }

    /**
     * @param $order
     * @return \Symfony\Component\HttpFoundation\RedirectResponse
     */
    public function saveOrderInBase($order)
    {
        $em = $this->getDoctrine()->getManager();
        $em->persist($order);
        $em->flush();

        $this->get('session')->getFlashBag()->add('success', 'Merci pour votre réservation.');

        return $this->redirect($this->generateUrl('louvre_front_showorder'));
    }





}