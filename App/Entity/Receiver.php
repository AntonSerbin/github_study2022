<?php

namespace App\Entity;

use Framework\Database\ModelDB;

class Receiver extends ModelDB
{
    protected string $table = "receiver";
    public $id_order;
    public $firstName;
    public $lastName;
    public $city;
    public $address;
    public $email;
    public $phone;
}
