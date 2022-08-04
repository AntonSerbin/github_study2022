<?php

namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Orders;
use Framework\Database\ModelDB;
use Framework\Session\SessionControl;

class DataController
{
    public function actionPlacedOrder()
    {
        echo "Вызван DataController->actionPlacedOrder<br>";
        dd($_POST);
        $arrUserFromJSON = json_decode($_POST['cart'], true);
        $arrUser = [];
        $cart = new Cart();
        $cart->truncate("cart");

        $orders = new Orders();
        $orderLastNumber = $orders->readLastString("orders");
        $orderNumber = $orderLastNumber[0]['id'] + 1;

        if ($_POST && $_SESSION) {
            $userEmail = ($_SESSION['user']['email']) ? ($_SESSION['user']['email']) : "antons.zn@gmail.com";

            $userLogged = SessionControl::getSession()['user']['id'];
            $userID = ModelDB::find("users", "email", $userEmail, "id")[0]['id'];
            $orderLastNumber = ModelDB::readLastString("orders");

            $arrOrders = array(
                "id" => $orderNumber,
                "id_user" => $userID
            );

            $arrReceiver = array(
                "id_order" => $orderNumber,
                "firstName" => $arrUserFromJSON["firstName"],
                "lastName" => $arrUserFromJSON["lastName"],
                "city" => $arrUserFromJSON["city"],
                "address" => $arrUserFromJSON["address"],
                "email" => $arrUserFromJSON["email"],
                "phone" => $arrUserFromJSON["phone"]
            );

            ModelDB::writeStr("orders", $arrOrders);
            ModelDB::writeStr('receiver', $arrReceiver);

            $arrCartGoods = [];
            $arrOrderGoods = [];

            $index = 0;
            foreach ($arrUserFromJSON['cartGoods'] as $item) {
                array_push($arrCartGoods, [
                    "id" => 0,
                    "id_user" => $userID,
                    'id_good' => $item['id'],
                    'amount' => $item['amount']
                ]);

                array_push($arrOrderGoods, [
                    "id_order" => $orderNumber,
                    'id_good' => $item['id'],
                    'id_quantity' => $item['amount']
                ]);

                ModelDB::writeStr('cart', $arrCartGoods[$index]);
                ModelDB::writeStr('order_goods', $arrOrderGoods[$index]);

                $index++;
            };
        }
        echo "--end act --<br>";
        var_dump($orderNumber);
        SessionControl::writeDataToSession("currentOrder", [$orderNumber]);
        $this->actionShowOrder();
    }

    public function actionShowOrder()
    {
//        echo "Вызван DataController->actionShowOrder<br>";

        $numberOrder = SessionControl::getSession()['user']['currentOrder'][0];
        $userOrder = ModelDB::showTable("receiver")[0];
        dd($userOrder);
        die();
        $userCart = ModelDB::showTable("cart");

        $arrOrder = array(
            "id_order"=>$userOrder['id_order'],

        );

        echo "Thank you for the order " . $userOrder['id_order'] . "<br>";
        for ($i = 0; $i < count($userCart); $i++) {
            $arrOrder['cart']['id'][] = $userCart[$i]["id_good"];
            dd($arrOrder);
            $item = ModelDB::read("goods","id",$userCart[$i]["id_good"]);
            echo "Title of the item - ".($item[0]['title'])."<br>";
            echo "Quantity of the item - ".$userCart[$i]["amount"]."<br>";
            echo "Price of the item - ".($item[0]['price'])."<br>";
        };

        for ($i = 0; $i < count($userOrder); $i++) {

        };
            dd($userOrder);
        dd($userCart);

        date_default_timezone_set('Europe/Kiev');
        $date = date('Y/m/d H:i:s');

        $arrOrder = ModelDB::read("orders", "id", $numberOrder);
//        $item = ModelDB::read("goods", "id", $arrOrder[0]);
        dd($numberOrder);
        dd($arrOrder[0]);
        dd($arrCart);
        dd($arrOrder);

        $subject = " Order Cakes from website " . $_ENV['WEB_SITE'] . " " . $date;

//        $res = (new MailerController())->sendEmail(
//            $userOrder['email'],
//            $subject,
//            "<h4>Thank you for your order. Within 24 hour you will have a call from our manager</h4>");

        require_once(ROOT . '/App/View/order/placedOrder.html');

        die();
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
