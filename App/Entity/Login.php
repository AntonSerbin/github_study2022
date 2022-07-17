<?php

namespace App\Entity;

use Framework\Database\ConnectionDB;
use Framework\Database\ModelDB;
use frameworkVendor\ConnectionDBUsers;

//use controllers\LoginController;
//use frameworkVendor\ConnectionDB;
//use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

class Login
{
    public static function checkLogin($name, $password)
    {

        echo "LoginModel -> запустили checkLogin<br>";

        $elementsDB = ModelDB::showTable("users");

        foreach ($elementsDB as $user) {
            if ($user['login'] == $name && $user['password'] == $password) {
                echo "password correct - " . $password . "<br>";
                return $user;
            }
        }
        return false;
    }

    public static function checkEmail($email)
    {
        echo "Entity->Login-> checkEmail<br>";
        $elementsDB = ModelDB::read('users', "email", $email);
//      $str = "select * from users WHERE email='$email'";
        return $elementsDB[0];
    }


    /**
     * @param $email - email to check Data Base
     * @return true [array of values in string in DB] / false if there is no such email
     */

    public static function checkHash($hash)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $str = "select * from users WHERE hash='$hash'";
        $elementsDB = $pdo->query($str)->fetch();
        return $elementsDB;
    }

    public static function sendEmail($email, $subject, $content)
    {
//        require(ROOT . '/PHPMailer/src/Exception.php');
//        require(ROOT . '/PHPMailer/src/PHPMailer.php');
//        require(ROOT . '/PHPMailer/src/SMTP.php');
//
//        $smtpData = require(ROOT . '/config/emailSMTP_cnfg.php');
//        $smtpHost = $smtpData['smtpHost'];
//        $smtpUsername = $smtpData['smtpUsername'];
//        $smtpPassword = $smtpData['smtpPassword'];
//        $smtpPort = $smtpData['smtpPort'];
//        $setFromName = $smtpData['setFromName'];
//
//        $mail = new PHPMailer(true);
//
//        try {
//            //Server settings
//            $mail->SMTPDebug = SMTP::DEBUG_SERVER;             //Enable verbose debug output
//            $mail->isSMTP();                                   //Send using SMTP
//            $mail->Host = $smtpHost;              //Set the SMTP server to send through
//            $mail->SMTPAuth = true;                            //Enable SMTP authentication
//            $mail->Username = $smtpUsername;                  //SMTP username
//            $mail->Password = $smtpPassword;              //SMTP password!! NOT EMAIL!!
//            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;   //Enable implicit TLS encryption
//            $mail->Port = $smtpPort;                                 //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
//
//            //Recipients
//            $mail->setFrom($email, $setFromName);
//            $mail->addAddress($email);     //Add a recipient
//
//            //Content
//            $mail->isHTML(true);                 //Set email format to HTML
//            $mail->Subject = $subject;
//            $mail->Body = $content;
//
//            $mail->send();
//
//            echo 'Mail has been sent<br>';
//            return true;
//        } catch
//        (Exception $e) {
//            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo} <br>";
//            return false;
//        }
    }

    public static function readDataConnectionById($id)
    {

        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "select * from dbconnect where iduser=$id";
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        return $elementsDB;
    }

    public static function deleteDataConnectionById($id)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "delete from dbconnect where iduser=$id";
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "Record has been deleted successfully";
        } else {
            echo "Unable to delete record";
            die();
        }
        return true;
    }

    public static function addUserIntoDb($userData)
    {
        echo "models->addUserIntoDb<br>";
        print_r($userData);
        echo "models->addUserIntoDb END<br><br>";

        ModelDB::writeStr("users", $userData);
    }

    public static function modifyUserInDb($idUser, $nameOfColumn, $newVolume)
    {
        echo "models->modifyUserIntoDb<br>";

        $pdo = ConnectionDB::getInstance()->getPdo();

        $sqlStr = "UPDATE users SET $nameOfColumn = '$newVolume' WHERE id = '$idUser'";

        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "Modified $nameOfColumn from User ID $idUser to $newVolume<br>";
            return true;
        } else {
            echo "Unable to modify user record";
            return false;
        }
    }


    public static function writeUserSettingDb($userId, $DBHost, $DBName, $DBUser, $DBPwd, $DBTable, $DBColumn)
    {
        $sqlStr = "INSERT INTO dbconnect VALUES ( $userId, " .
            "'" . $DBHost . "', " .
            "'" . $DBName . "', " .
            "'" . $DBUser . "', " .
            "'" . $DBPwd . "', " .
            "'" . $DBTable . "', " .
            "'" . $DBColumn . "' " .
            ");";
        $pdo = ConnectionDB::getInstance()->getPdo();
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "New record created successfully";
            unset($sqlStr);
            return true;
        } else {
            echo "Unable to create record";
            die();
        }
    }
}