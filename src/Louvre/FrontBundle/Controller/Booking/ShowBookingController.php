<?php

namespace Louvre\FrontBundle\Controller\Booking;


class ShowBookingController extends BookinController
{
    public function showOrderAction()

    {
        $this->get('louvre.front_bundle.entity.order_factory');
        $formOrder = $this->buildOrderForm();

        return $this->renderOrderForm($formOrder);
    }
}