<?php

namespace Louvre\FrontBundle\Controller\Booking;

use Symfony\Component\HttpFoundation\Request;

class ShowBookingController extends BookinController
{
    public function showOrderAction(Request $request)
    {
        $formOrder = $this->buildOrderForm();

        return $this->renderOrderForm($formOrder);
    }




}