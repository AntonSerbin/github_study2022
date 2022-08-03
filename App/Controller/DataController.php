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
//        echo "Вызван DataController->actionPlacedOrder<br>";

        $arrUserFromJSON = json_decode($_POST['cart'], true);
        $arrUser = [];
        ModelDB::truncate("receiver");
        ModelDB::truncate("cart");


        if ($_POST) {

            $userLogged = SessionControl::getSession()['user']['id_user'];

            $arrUser = array(
                "id_user" => $userLogged,
                "firstName" => $arrUserFromJSON["firstName"],
                "lastName" => $arrUserFromJSON["lastName"],
                "city" => $arrUserFromJSON["city"],
                "address" => $arrUserFromJSON["address"],
                "email" => $arrUserFromJSON["email"],
                "phone" => $arrUserFromJSON["phone"]
            );
            $arrCartGoods = [];
            $index = 0;

            foreach ($arrUserFromJSON['cartGoods'] as $item) {
                array_push($arrCartGoods, [
                    "id_user" => $userLogged,
                    'id_good' => $item['id_good'],
                    'title' => $item['title'],
                    'price' => $item['price'],
                    'amount' => $item['amount']
                ]);
                ModelDB::writeStr('cart', $arrCartGoods[$index]);
                $index++;
            };
            echo "--arrCartGoods--<br>";
            dd($arrCartGoods);
        }
        echo "----<br>";
        if ($_POST) {
            ModelDB::writeStr('receiver', $arrUser);
        }
        $this->actionShowOrder();
    }

    public function actionShowOrder()
    {
//        echo "Вызван DataController->actionShowOrder<br>";


        $userOrder = ModelDB::showTable("receiver")[0];
        $userCart = ModelDB::showTable("cart");

        date_default_timezone_set('Europe/Kiev');
        $date = date('Y/m/d H:i:s');

        $subject = " Order Cakes from website ". $_ENV['WEB_SITE']." ".$date;

        $res = (new MailerController())->sendEmail(
            $userOrder['email'],
            $subject,
            "<h4>Thank you for your order. Within 24 hour you will have a call from our manager</h4>");

        require_once(ROOT . '/App/View/order/placedOrder.html');

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
