<?php

namespace App\Service;

use Framework\Mail\MailerController;

class MailService
{

    public function createContentOrderPlaced($orderData)
    {
        $strContent = "<main>";
        $strContent .= "<div style='margin: 40px;'>";
        $strContent .= "<h1 style='margin-bottom:20px '> Thank you for your order № " . $orderData[0]['id_order'] . "</h1>";
        $strContent .= "<h2>Information about receiver:</h2>";
        $strContent .= "<h4>First name: " . $orderData[0]['firstName'] . "</h4>";
        $strContent .= "<h4>Last name: " . $orderData[0]['lastName'] . "</h4>";
        $strContent .= "<h4>City: " . $orderData[0]['city'] . "</h4>";
        $strContent .= "<h4>Address: " . $orderData[0]['address'] . "</h4>";
        $strContent .= "<h4>Email: " . $orderData[0]['email'] . "</h4>";
        $strContent .= "<h4>Phone: " . $orderData[0]['phone'] . "</h4>";
        $strContent .= "</div>";

        $strContent .= "<table style='width:50 %; margin:50px; border: 1px solid black'>";
        $strContent .= "<thead>";
        $strContent .= "<th scope='col'>#</th>";
        $strContent .= "<th scope='col'>Code</th>";
        $strContent .= "<th scope='col'>Title</th>";
        $strContent .= "<th scope='col'>Amount</th>";
        $strContent .= "<th scope='col'>Price,usd</th>";
        $strContent .= "<th scope='col'>Sum,usd</th>";
        $strContent .= "</thead>";
        $strContent .= "<tbody>";

        $sumCart = 0;
        for ($i = 0; $i < count($orderData); $i++) {

            $strContent .= "<tr> ";
            $strContent .= "<th scope='row'>" . ($i + 1) . "</th>";
            $strContent .= "<td>" . $orderData[$i]['id_good'] . "</td>";
            $strContent .= "<td>" . $orderData[$i]['title'] . "</td>";
            $strContent .= "<td>" . $orderData[$i]['quantity'] . "</td>";
            $strContent .= "<td>" . $orderData[$i]['price'] . "</td>";
            $strContent .= "<td>" . $orderData[$i]['price'] * $orderData[$i]['quantity'] . "</td>";
            $strContent .= "<tr>";
            $sumCart += $orderData[$i]['price'] * $orderData[$i]['quantity'];
        };

        $strContent .= "<th scope = 'row'  ></th > ";
        $strContent .= "<td ></td > ";
        $strContent .= "<td ></td > ";
        $strContent .= "<td ></td > ";
        $strContent .= "<th > Sum of order:</th > ";
        $strContent .= "<th > " . $sumCart . "</th > ";
        $strContent .= "</tr > ";
        $strContent .= "</tbody > ";
        $strContent .= "</table > ";
        $strContent .= "</main>";

        $strContent .= "<h4> Our manager will get in touch with you in 12 hours by number "
            . $orderData[0]['phone'] . "</h4>";
        $strContent .= "<h4> Thank you for thr order and 
                        <strong style='background-image:linear-gradient(to left,SteelBlue, yellow);'>
                        #StandWithUkaine.</strong> </h4>";
        return $strContent;
    }


    public function sendOrderCreated($email, $orderData)
    {
        date_default_timezone_set('Europe/Kiev');
        $date = date('Y/m/d H:i:s');
        $subject = " Order Cakes from website " . $_ENV['WEB_SITE'] . " " . $date;
        $res = (new MailerController())->sendEmail(
            $email,
            $subject,
            $this->createContentOrderPlaced($orderData)
        );
        logMonolog("EMail sent , $email");
    }
}

