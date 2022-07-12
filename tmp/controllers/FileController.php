<?php

namespace controllers;
use models\file;

class FileController
{
    public static function actionFileData($idUser)
    {
//        echo "Вызван FileController->actionFileData<br>";

        $arrLinesTxt = File::showFileTable($idUser, 'fileUser.txt');
        $arrLinesCsv = File::showFileTable($idUser, 'fileUser.csv');
        $arrLinesTwoFiles = ['txt'=>$arrLinesTxt,'csv'=> $arrLinesCsv];

        return $arrLinesTwoFiles;
    }

    public function actionAddStringToFile()
    {
//        echo "Вызван FileController->actionAddStringToFile<br>";
        $idUser= $_SESSION['user']['id'];
        File::writeStringToFile($idUser, "fileUser.".$_POST['extType'], $_POST['stringToFile']);
        (new DataController)->actionShowData();
        return true;
    }


}


