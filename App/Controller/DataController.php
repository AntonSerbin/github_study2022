<?php

namespace App\Controller;

use App\Entity\Goods;
use App\Entity\OrderGoods;
use App\Entity\Orders;
use App\Entity\Receiver;
use App\Entity\User;
use App\Service\MailService;
use Framework\Mail\MailerController;
use Framework\Session\SessionControl;

class DataController
{
    public function actionPlacedOrder()
    {
        $arrUserFromJSON = json_decode($_POST['cart'], true);

        if (!isset($_SESSION['user'])) {
            echo json_encode(["error" => "Unauthorized"]);
            die();
            return;
        }

        if ($arrUserFromJSON && isset($_SESSION['user'])) {
            $userId = SessionControl::getSession()['user']['id'];

            $orders = new Orders();
            $orders->id_user = $userId;
            $orders->save();
            $orderId = $orders->id;

            $receiver = new Receiver();
            $receiver->id_order = $orderId;
            $receiver->firstName = $arrUserFromJSON["firstName"];
            $receiver->lastName = $arrUserFromJSON["lastName"];
            $receiver->city = $arrUserFromJSON["city"];
            $receiver->address = $arrUserFromJSON["address"];
            $receiver->email = $arrUserFromJSON["email"];
            $receiver->phone = $arrUserFromJSON["phone"];
            $receiver->save();


            foreach ($arrUserFromJSON['cartGoods'] as $item) {
                $orderGoods = new OrderGoods();
                $orderGoods->id_order = $orderId;
                $orderGoods->id_good = $item['id'];
                $orderGoods->quantity = $item['amount'];
                $orderGoods->save();
            };
        }
        $orderData = $orders->join("order_goods", "orders.id", "order_goods.id_order")
            ->join("goods", "order_goods.id_good", "goods.id")
            ->join("receiver", "orders.id", "receiver.id_order")
            ->where("orders.id", $orderId)
            ->select();

        $mailService = new MailService();
        $mailService->sendOrderCreated($arrUserFromJSON["email"], $orderData);

        echo json_encode(["orderId" => $orderId]);
    }

    public function actionShowOrder($params)
    {
        $id = $params['id'];
        $order = new Orders();

        $orderData = $order->join("order_goods", "orders.id", "order_goods.id_order")
            ->join("goods", "order_goods.id_good", "goods.id")
            ->join("receiver", "orders.id", "receiver.id_order")
            ->where("orders.id", $id)
            ->select();
        require_once(ROOT . '/App/View/order/placedOrder.html');
    }

    public function actionCart()
    {
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
            $obj = new $table;
            $listOfGoods = $obj->showTable($table);
        } else {
            $obj = new $table;
            $listOfGoods = $obj->read($table, $column, $elem);
        }
        return $listOfGoods;
    }

    public function actionShowPageItem($params)
    {
        echo "Вызван DataController->actionShowPageItem<br>";
        echo "<br>";
        $goods = new Goods();
        $itemInfo = $goods->read("id_good", $params["id"]);
        require_once(ROOT . '/App/View/goods/item.html');

        return true;
    }
}
