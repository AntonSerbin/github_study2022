<?php

namespace App\Controller;

use Framework\Database\ModelDB;
use App\Entity\Login;
use Framework\Mail\MailerController;
use Framework\Session\SessionControl;

class DataController
{
    public function actionShowPageGoods($param)
    {
//        echo "<br>Action actionShowPageGoods started<br>";
        require_once(ROOT . '/App/View/goods/goods.php');
        return true;
    }

    public function actionRequestDataGoods()
    {
        $listOfGoods = ModelDB::showTable("goods");
        echo json_encode($listOfGoods);
    }

    public function actionShowPageItem($params)
    {

        echo "Вызван DataController->actionShowPageItem<br>";
        var_dump($params);

        return true;
    }

    public function actionShowData()
    {
//        $idUser = (int)$_SESSION['user']['id'];
        ////        echo "Вызван DataController->actionShowData<br>";
//        $elementsDB = Data::showDataTable($idUser);
//        $elementsFiles = FileController::actionFileData($idUser);
//        require_once(ROOT . '/view/data/showData.php');
//        return true;
    }

    public function actionAddStringToDb()
    {
//        $idUser = (int)$_SESSION['user']['id'];
//
        ////        echo "<br>Вызван DataController->actionAddStringToDb<br>";
//
//        $elementsDB = Data::addString($idUser);
//        $this->actionShowData($idUser);
//        return true;
    }
}
