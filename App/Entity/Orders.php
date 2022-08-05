<?php

namespace App\Entity;

use Framework\Database\ModelDB;

class Orders extends ModelDB
{
    protected string $table = "orders";
    public $id;
    public $id_user;

}
