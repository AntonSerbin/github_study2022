<?php

namespace App\Service;

use Framework\Mail\MailerController;

class MailService
{

    public function sendOrderCreated($email, $data)
    {
        $dataJson = json_encode($data);
        date_default_timezone_set('Europe/Kiev');
        $date = date('Y/m/d H:i:s');
        $subject = " Order Cakes from website " . $_ENV['WEB_SITE'] . " " . $date;
        $res = (new MailerController())->sendEmail(
            $email,
            $subject,
            $dataJson);
    }
}