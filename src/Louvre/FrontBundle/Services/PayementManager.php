<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 30/07/17
 * Time: 15:43
 */

namespace Louvre\FrontBundle\Services;


use Stripe\Charge;
use Stripe\Stripe;
use Symfony\Component\DependencyInjection\Container;
use Symfony\Component\HttpFoundation\RequestStack;

class PayementManager
{

    protected $command;
    protected $container;
    protected $request;

    public function __construct($order, Container $container, RequestStack $request)
    {
        $this->command = $order;
        $this->container = $container;
        $this->request = $request;
    }

    public function stripe() {
        $request = $this->request->getCurrentRequest();
        $secret_key = $this->container->getParameter('stripe_secret_key');
        Stripe::setApiKey($secret_key);
        $total = 100;
        $token = $request->get('stripe_public_key');
        try {
            Charge::create(array(
                "amount" =>  $total . "00",
                "currency" => "eur",
                "description" => "Billeterie du Louvre",
                "source" => $token,
            ));
            //$session_command->setCommandedAt(new \DateTime());
          //  $session_command->setCommandNumber();
            return true;
        }catch (\Exception $e) {
            return false;
        }
    }

}