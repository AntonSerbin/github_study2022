<?php

namespace App\Service;

use App\Entity\User;
use Framework\Database\ConnectionDB;
use Framework\Database\ModelDB;

//use controllers\LoginController;
//use frameworkVendor\ConnectionDB;


class Login
{

    public function checkLogin($name, $password)
    {

        echo "LoginModel -> запустили checkLogin<br>";

        $user = new User();
        $elementsDB = $user->showTable();

        foreach ($elementsDB as $user) {
            if ($user['login'] == $name && $user['password'] == $password) {
                echo "password correct - " . $password . "<br>";
                return $user;
            }
        }
        return false;
    }

    public function checkEmail($email)
    {
        echo "Entity->Login-> checkEmail<br>";
        $user = new User();
        $elementsDB = $user->read("email", $email);
//      $str = "select * from users WHERE email='$email'";
        if ($elementsDB) {
            return $elementsDB[0];
        } else {
            return false;
        }
    }


    /**
     * @param $email - email to check Data Base
     * @return true [array of values in string in DB] / false if there is no such email
     */

    public function checkHash($hash)
    {
//        $pdo = ConnectionDB::getInstance()->getPdo();
//        $str = "select * from users WHERE hash='$hash'";
        $user = new User();
        $elementsDB = $user->read("hash",$hash);
//        $elementsDB = $pdo->query($str)->fetch();
        return $elementsDB[0];
    }

    public function readDataConnectionById($id)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "select * from dbconnect where iduser=$id";
        $elementsDB = $pdo->query($sqlStr)->fetchAll();
        return $elementsDB;
    }

    public function deleteDataConnectionById($id)
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
        $user = new User();
        $user->writeStr($userData);
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


    public function writeUserSettingDb($userId, $DBHost, $DBName, $DBUser, $DBPwd, $DBTable, $DBColumn)
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