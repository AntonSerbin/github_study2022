<?php

namespace App\Controller;

use Framework\Database\ModelDB;
use App\Entity\Login;
use Framework\Mail\MailerController;
use Framework\Session\SessionControl;
use App\Controller\MakeJSONController;

class DataController
{
    public function actionPlacedOrder()
    {
        echo "Вызван DataController->actionPlacedOrder<br>";
        echo "POST:<br>";
        var_dump($_POST);

    }

    public function actionCart()
    {
        echo "Вызван DataController->actionCart<br>";
        require_once(ROOT . '/App/View/cart/cart.html');
        return true;
    }

    public function actionShowPageGoods($param)
    {
//        $arrListItems = $this->actionRequestDataGoods("goods", "category", $param['category']);
        require_once(ROOT . '/App/View/goods/goods.php');
        return true;
    }

    public function actionRequestDataGoods($table, $column, $elem)
    {
        if (!$column || $elem === "all") {
            $listOfGoods = ModelDB::showTable($table);
        } else {
            $listOfGoods = ModelDB::read($table, $column, $elem);
        }
        return $listOfGoods;
    }

    public function actionShowPageItem($params)
    {
        echo "Вызван DataController->actionShowPageItem<br>";
        var_dump($params);
        echo "<br>";
        $itemInfo = ModelDB::read("goods", "id_good", $params["id"]);
        var_dump($itemInfo);
        require_once(ROOT . '/App/View/goods/item.html');

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
