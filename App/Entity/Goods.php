<?php

namespace App\Entity;

use Framework\Database\ModelDB;

class Goods extends ModelDB
{
    protected string $table = "goods";
    public $id;
    public $title;
    public $image_name;
    public $price;
    public $quantity_on_stock;
    public $period_of_productoin_hours;
    public $shelf_life_hours;
    public $category;
    public $description;
}
