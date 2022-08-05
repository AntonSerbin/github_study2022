<?php

namespace App\Entity;

use Framework\Database\ModelDB;

class User extends ModelDB
{
    protected string $table = "users";
    public $id;
    public $login;
    public $email;
    public $password;
    public $firstname;
    public $secondname;
    public $phone;
    public $hash;
}


