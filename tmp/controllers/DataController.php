<?php

namespace controllers;

use models\data;
use controllers\FileController;

class DataController
{

    public function actionShowData()
    {
        $idUser = (int)$_SESSION['user']['id'];
//        echo "Вызван DataController->actionShowData<br>";
        $elementsDB = Data::showDataTable($idUser);
        $elementsFiles = FileController::actionFileData($idUser);
        require_once(ROOT . '/view/data/showData.php');
        return true;
    }

    public function actionAddStringToDb()
    {
        $idUser = (int)$_SESSION['user']['id'];

//        echo "<br>Вызван DataController->actionAddStringToDb<br>";

        $elementsDB = Data::addString($idUser);
        $this->actionShowData($idUser);
        return true;
    }


}