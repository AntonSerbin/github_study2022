<?php

namespace Framework\Mail;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\Transport\SendmailTransport;
use Symfony\Component\Mime\Email;

use Symfony\Component\Mailer\Transport;
//use Symfony\Component\Mailer\Mailer;
//use Symfony\Component\Mime\Email;


//use Symfony\Bundle\FramewoІrkBundle\Controller\AbstractController;
//use Symfony\Component\HttpFoundation\Response;
//use Symfony\Component\Mailer\MailerInterface;
//use Symfony\Component\Mime\Email;

class MailerController
{

    public function __constructor(): void
    {
    }

    /**
     * @throws \Symfony\Component\Mailer\Exception\TransportExceptionInterface
     */
    public function sendEmail(): void
    {
        echo "<br>-----------1-------------<br>";
        echo "<br>Framework\Mail\sendEmail - started <br> ";

        $transport = Transport::fromDsn('gmail+smtp://boel.com.ua@gmail.com:xpinycgjamjtyliw@default');
        $mailer = new Mailer($transport);


        $email = (new Email())
            ->from('boel.com.ua@gmail.com')
            ->to('antons.zn@gmail.com')
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject('Time for Symfony Mailer!')
            ->text('Sending emails is fun again!')
            ->html('<p>See Twig integration for better HTML integration!</p>');


        try {
            $mailer->send($email);
            echo "<br> sent good <br>";
        } catch (TransportExceptionInterface $e) {
        echo "error!!<br> $e";
        }

        echo "<br>---------------2------------<br>";

    }

}