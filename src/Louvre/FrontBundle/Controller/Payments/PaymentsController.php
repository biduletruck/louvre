<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 01/05/17
 * Time: 18:30
 */

namespace Louvre\FrontBundle\Controller\Payments;


use Louvre\FrontBundle\Form\PayementType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class PaymentsController extends Controller
{

    /**
     * @return \Symfony\Component\HttpFoundation\Response
     */
    public function paymentOrderAction(Request $request)
    {


        $command = [
            "buyerFirstName" => "clement",
            "buyerLastName" => "yann",
            "buyerEmail" => "clemntyann@free.fr",
            "numberCommand" => "LPC597efec839f91",
            "ticketType" => "Billet journée",
            "visitDate" =>  "2017-07-31 00:00:00.000000",
            "totalPrice" => 62,
            "tickets" => [
                [
                    "prix" => 16,
                    "nom" => "yann clement",
                    "reduction" => false
                ],[
                    "prix" => 16,
                    "nom" => "hanane clement",
                    "reduction" => false
                ],[
                    "prix" => 8,
                    "nom" => "lilia clement",
                    "reduction" => false
                ], [
                    "prix" => 0,
                    "nom" => "sofia clement",
                    "reduction" => false
                ],[
                    "prix" => 12,
                    "nom" => "alain clemeent",
                    "reduction" => false
                ],[
                    "prix" => 10,
                    "nom" => "rose noelle clement",
                    "reduction" => true
                    ]
                ]
            ];
        $formUser =
            [
                "firstname" => "clement",
                "lastname" => "yann",
                "email" => "clemntyann@free.fr"
            ];

        $form = $this->createForm('Louvre\FrontBundle\Form\PayementType', $formUser);
        $form->handleRequest($request);
        return $this->render('@LouvreFront/prepare.html.twig', array(
            'form' => $form->createView(),
            'command' => $command
        ));
    }
}