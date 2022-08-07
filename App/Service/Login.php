<?php

namespace App\Service;

use App\Entity\User;
use Framework\Database\ConnectionDB;


class Login
{

    public function checkLogin($name, $password)
    {
        $user = new User();
        $elementsDB = $user->showTable();

        foreach ($elementsDB as $user) {
            if ($user['login'] == $name && $user['password'] == $password) {
//              echo "password correct - " . $password . "<br>";
                return $user;
            }
        }
        return false;
    }

    public function checkEmail($email)
    {
        $user = new User();
        $elementsDB = $user->where('email',$email)->select();
//      $str = "select * from users WHERE email='$email'";
        if ($elementsDB) {
            return $elementsDB[0];
        } else {
            return false;
        }
    }

    public function checkHash($hash)
    {
        $user = new User();
        $elementsDB = $user->where("hash", $hash)->select();
//      $str = "select * from users WHERE hash='$hash'";
        return $elementsDB[0];
    }

    public function deleteDataConnectionById($id)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "delete from dbconnect where iduser=$id";
        $insertStatement = $pdo->prepare($sqlStr);
        try {
            $insertStatement->execute();
        } catch (Exception $e) {
            return false;
        }
    }

    public static function addUserIntoDb($userData)
    {
        $user = new User();
        $user->writeStr($userData);
    }

    public static function modifyUserInDb($idUser, $nameOfColumn, $newVolume)
    {
        $pdo = ConnectionDB::getInstance()->getPdo();
        $sqlStr = "UPDATE users SET $nameOfColumn = '$newVolume' WHERE id = '$idUser'";
        $insertStatement = $pdo->prepare($sqlStr);
        try {
            $insertStatement->execute();
        } catch (Exception $e) {
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
        $insertStatement = $pdo->prepare($sqlStr);
        try {
            $insertStatement->execute();
        } catch (Exception $e) {
            return false;
        }
    }
}