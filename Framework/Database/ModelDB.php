<?php

namespace Framework\Database;

use Framework\Database\ConnectionDB;
use Symfony\Component\Console\Helper\Table;
use function Symfony\Component\String\s;


abstract class ModelDB
{
    protected string $table;
    private array $where;
    private array $join;
    private string $sqlStr = "";
    private bool $whereAdded = false;

    public function join($table2, $column1, $column2)
    {

        $this->sqlStr .= "INNER JOIN " . $table2 . " ON " . $column1 . "=" . $column2." ";

        return $this;
    }
//SELECT Orders.OrderID, Customers.CustomerName, Shippers.ShipperName
//FROM ((Orders
//INNER JOIN Customers ON Orders.CustomerID = Customers.CustomerID)
//INNER JOIN Shippers ON Orders.ShipperID = Shippers.ShipperID);

    public function where($key, $value)
    {
        if (!$this->whereAdded) {
            $this->sqlStr .= " WHERE " . $key . " = '" . $value . "'";
        }
        if ($this->whereAdded) {
            $this->sqlStr .= " AND " . $key . " = '" . $value . "'";
        }

        $this->whereAdded = true;
        return $this;
    }

    public function select($value = "*")
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "SELECT " . $value . " FROM " . $this->table . " " . $this->sqlStr;
        dd($sqlStr);
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        return $elementsDB;
    }

    public function showTable()
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        dd("select * from $name");
        $elementsDB = $pdo->query("select * from $this->table")->fetchAll();
        return $elementsDB;
    }

    public function read($column, $elem)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        dd("select * from $table where $column = '$elem';");
        $elementsDB = $pdo->query("select * from " . $this->table . " where $column = '$elem';")->fetchAll();
        return $elementsDB;
    }

    public function write($column, $elem)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        echo $this->table, $column, $elem . '<br>';
//        $sqlStr = "INSERT INTO '"."$table' ('"."$column') VALUE ('"."$elem');";
        $sqlStr = "INSERT INTO " . $this->table . " $column VALUES (" . "'" . $elem . "');";

        echo($sqlStr);
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "New data  added to DB successfully";
            return true;
        } else {
            echo "Unable to create user record";
            die();
        }
        return true;
    }


    public function find($column, $elem, $requestColumn)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "select " . $requestColumn . " from " . $this->table . " where $column ='" . $elem . "';";
//        echo $sqlStr;
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        return $elementsDB;
    }


    public function readLastString()
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "select * from $this->table ORDER BY ID DESC LIMIT 1";
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        return $elementsDB;
    }


    public function update($column, $elem, $whereColumn, $whereElem)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
//        echo $table, $column, $elem , $whereColumn, $whereElem,'<br>';
        $sqlStr = "UPDATE " . $this->table . " SET $column = '" . $elem . "' WHERE ($whereColumn='" . $whereElem . "');";
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "New data  added to DB successfully";
            return true;
        } else {
            echo "Unable to create user record";
            die();
        }
        return true;
    }

    public function truncate()
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "TRUNCATE TABLE " . $this->table;
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "Table truncated ";
            return true;
        } else {
            echo "Unable to create user record";
            die();
        }
        return true;
    }

    public function delete($column, $el)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "TRUNCATE TABLE " . $this->table;
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "Table truncated ";
            return true;
        } else {
            echo "Unable to create user record";
            die();
        }
        return true;
    }

    public function writeStr($arr)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "INSERT INTO $this->table (";
        foreach ($arr as $key => $value) {
            $sqlStr .= "$key" . ", ";
        };
        $sqlStr = substr($sqlStr, 0, -2) . ") VALUES (";
        foreach ($arr as $key => $value) {
            $sqlStr .= "'$value" . "',";
        };
        $sqlStr = substr($sqlStr, 0, -1) . ");";
        echo $sqlStr;

        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "New data  added to DB successfully";
            return true;
        } else {
            echo "Unable to create user record";
            die();
        }
        return true;
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