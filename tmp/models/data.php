<?php

namespace models;

use frameworkVendor\ConnectionDBDataFromUser;
use frameworkVendor\ConnectionDBUsers;
use PHPMailer\PHPMailer\Exception;


class Data

{
    public static function showDataTable()
    {
//        echo "class Data Model -> showDataTable<br>";
        $idUser = (int)$_SESSION['user']['id'];
        //check the creds for users DB, if absent => show sample of the DataBase
        if (login::readDataConnectionById($idUser)) {
            $dataConnection = login::readDataConnectionById($idUser)[0];
            $tableNameDB = $dataConnection["dbtable"];
            $columnNameDB = $dataConnection["dbcolumn"];
            $pdo = ConnectionDBDataFromUser::getInstance()->getPdo($idUser);
        } else {
            $dataConnection = require(ROOT . "/config/dbDataFromUser_cnfg.php");
            $tableNameDB = $dataConnection['providedTableName'];
            $columnNameDB = $dataConnection['providedColumnName'];
            $pdo = ConnectionDBUsers::getInstance()->getPdo();
        }

        $elementsDB = $pdo->query("SELECT * FROM $tableNameDB")->fetchAll();

        $returnArray = [];
        foreach ($elementsDB as $item) {
            array_push($returnArray, $item[$columnNameDB]);
        }
        return $returnArray;
    }

    public static function addString($idUser)
    {
//        echo "class DataModel -> addString<br>";
//        print_r($_POST['srtingToDb']);

        if (login::readDataConnectionById($idUser)[0]) {
            $dataConnection = login::readDataConnectionById($idUser)[0];
            $tableNameDB = $dataConnection["dbtable"];
            $columnNameDB = $dataConnection["dbcolumn"];
            $pdo = ConnectionDBDataFromUser::getInstance()->getPdo();
        } else {
            $dataConnection = require(ROOT . "/config/dbDataFromUser_cnfg.php");
            $tableNameDB = $dataConnection['providedTableName'];
            $columnNameDB = $dataConnection['providedColumnName'];
            $pdo = ConnectionDBUsers::getInstance()->getPdo();
        }

        $newString = $_POST['srtingToDb'];
        $sqlStr = "INSERT INTO  $tableNameDB ( $columnNameDB ) VALUES ( " . "'" . $newString . "');";
        $insertStatement = $pdo->prepare($sqlStr);
        if ($insertStatement->execute()) {
            echo "New record created successfully";
            unset($sqlStr);
        } else {
            echo "Unable to create record";
            die();
        }
    }
}