<?php

namespace Framework\Database;

use Framework\Database\ConnectionDB;

//use controllers\LoginController;
//use frameworkVendor\ConnectionDBUsers;
//use PHPMailer\PHPMailer\Exception;
//use PHPMailer\PHPMailer\PHPMailer;
//use PHPMailer\PHPMailer\SMTP;

class ModelDB
{
    public static function showTable($name)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $elementsDB = $pdo->query("select * from $name")->fetchAll();
        return $elementsDB;
    }

    public static function read($table,$column,$id)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $elementsDB = $pdo->query("select * from $table where $column=$id")->fetchAll();
        return $elementsDB;
    }



//    /**
//     * @param $email - email to check Data Base
//     * @return true [array of values in string in DB] / false if there is no such email
//     */
//    public static function checkEmail($email)
//    {
//        $pdo = ConnectionDBUsers::getInstance()->getPdo();
//        $str = "select * from users WHERE email='$email'";
//        $elementsDB = $pdo->query($str)->fetch();
//        return $elementsDB;
//    }
//
//    public static function checkHash($hash)
//    {
//        $pdo = ConnectionDBUsers::getInstance()->getPdo();
//        $str = "select * from users WHERE hash='$hash'";
//        $elementsDB = $pdo->query($str)->fetch();
//        return $elementsDB;
//    }
//
//    public static function sendEmail($email, $subject, $content)
//    {
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
//    }
//
//    public static function readDataConnectionById($id)
//    {
//
//        $pdo = ConnectionDBUsers::getInstance()->getPdo();
//        $sqlStr = "select * from dbconnect where iduser=$id";
//        $elementsDB = $pdo->query($sqlStr)->fetchAll();
//        return $elementsDB;
//    }
//
//    public static function deleteDataConnectionById($id)
//    {
//        $pdo = ConnectionDBUsers::getInstance()->getPdo();
//        $sqlStr = "delete from dbconnect where iduser=$id";
//        $insertStatement = $pdo->prepare($sqlStr);
//        if ($insertStatement->execute()) {
//            echo "Record has been deleted successfully";
//        } else {
//            echo "Unable to delete record";
//            die();
//        }
//        return true;
//    }
//
//    public static function addUserIntoDb($userData)
//    {
//        echo "models->addUserIntoDb<br>";
//        $credentials = require(ROOT . '/config/dbLogin_cnfg.php');
//
//        $columnLogin = $credentials['columnUser'];
//        $columnPassword = $credentials['columnPassword'];
//        $columnEmail = $credentials['columnEmail'];
//        $pdo = ConnectionDBUsers::getInstance()->getPdo();
//        $sqlStr = "INSERT INTO users ($columnLogin,$columnPassword,$columnEmail) VALUES (" .
//            "'" . $userData['login'] . "', " .
//            "'" . $userData['psw'] . "', " .
//            "'" . $userData['email'] . "');";
//        $insertStatement = $pdo->prepare($sqlStr);
//        if ($insertStatement->execute()) {
//            echo "New user " . $userData['login'] . " created successfully";
//            return true;
//        } else {
//            echo "Unable to create user record";
//            die();
//        }
//    }
//
//    public static function modifyUserInDb($idUser, $nameOfColumn, $newVolume)
//    {
//        echo "models->modifyUserIntoDb<br>";
//
//        $pdo = ConnectionDBUsers::getInstance()->getPdo();
//
//        $sqlStr = "UPDATE users SET $nameOfColumn = '$newVolume' WHERE id = '$idUser'";
//
//        $insertStatement = $pdo->prepare($sqlStr);
//        if ($insertStatement->execute()) {
//            echo "Modified $nameOfColumn from User ID $idUser to $newVolume<br>";
//            return true;
//        } else {
//            echo "Unable to modify user record";
//            return false;
//        }
//    }
//
//
//    public static function writeUserSettingDb($userId, $DBHost, $DBName, $DBUser, $DBPwd, $DBTable, $DBColumn)
//    {
//        $sqlStr = "INSERT INTO dbconnect VALUES ( $userId, " .
//            "'" . $DBHost . "', " .
//            "'" . $DBName . "', " .
//            "'" . $DBUser . "', " .
//            "'" . $DBPwd . "', " .
//            "'" . $DBTable . "', " .
//            "'" . $DBColumn . "' " .
//            ");";
//        $pdo = ConnectionDBUsers::getInstance()->getPdo();
//        $insertStatement = $pdo->prepare($sqlStr);
//        if ($insertStatement->execute()) {
//            echo "New record created successfully";
//            unset($sqlStr);
//            return true;
//        } else {
//            echo "Unable to create record";
//            die();
//        }
//    }
}