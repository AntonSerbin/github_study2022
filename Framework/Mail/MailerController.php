<?php

namespace Framework\Mail;

use Symfony\Component\Mailer\Exception\TransportExceptionInterface;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mime\Email;

use Symfony\Component\Mailer\Transport;

class MailerController
{
    public function sendEmail($to,$subject,$text): bool
    {
        $transport = Transport::fromDsn($_ENV['MAILER_DSN']);
        $mailer = new Mailer($transport);

        $email = (new Email())
            ->from('boel.com.ua@gmail.com')
            ->to($to)
            //->cc('cc@example.com')
            //->bcc('bcc@example.com')
            //->replyTo('fabien@example.com')
            //->priority(Email::PRIORITY_HIGH)
            ->subject($subject)
//            ->text($text)
            ->html($text);
        $headers = $email->getHeaders();
        $headers->addHeader('X-Auto-Response-Suppress', 'OOF, DR, RN, NRN, AutoReply');
        $email->setHeaders($headers);

        try {
            $mailer->send($email);
            echo "<br> sent good. <br>";
            return true;
        } catch (TransportExceptionInterface $e) {
            echo "error!!<br> $e";
            return "false error!";
        }

        echo "<br>---------------2------------<br>";

    }

}