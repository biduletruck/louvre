<?php

namespace Louvre\FrontBundle\Controller\Booking;


class ShowBookingController extends BookinController
{
    public function showOrderAction()
    {
        $formOrder = $this->buildOrderForm();

        return $this->renderOrderForm($formOrder);
    }




}