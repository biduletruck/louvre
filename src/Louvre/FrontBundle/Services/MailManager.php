<?php
/**
 * Created by PhpStorm.
 * User: yann
 * Date: 30/07/17
 * Time: 15:43
 */

namespace Louvre\FrontBundle\Services;

use Swift_Message;
use Symfony\Bundle\TwigBundle\TwigEngine;

class MailManager
{
    protected $templating;
    protected $mailer;

    public function __construct(TwigEngine $templating, \Swift_Mailer $mailer)
    {
        $this->mailer = $mailer;
        $this->templating = $templating;
    }
    public function sendCommandMail($command_number, $session)
    {
        $message = Swift_Message::newInstance();
        $message->setSubject('Confirmation de votre commande sur le site du Louvre')
            ->setFrom('louvre@mail.com')
            ->setTo('root@localhost')
            ->setBody(
                $this->templating->render('LouvreFrontBundle:Email:eticket.html.twig', array(
                        'command' => $session,
                        'command_number' => $command_number,
                    )
                )
            );
        return $this->mailer->send($message);
    }
}