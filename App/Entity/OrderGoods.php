<?php

namespace App\Entity;

use Framework\Database\ModelDB;

class OrderGoods extends ModelDB
{
    protected string $table = "order_goods";
    public $id;
    public $id_order;
    public $id_good;
    public $quantity;
}
