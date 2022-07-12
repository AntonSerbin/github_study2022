<?php

use App\Models\Session;
use frameworkVendor\Router;

error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once "vendor/autoload.php";

echo "Login Page<br>";

echo "<pre> <b>Posted information from login page</b><br><br>";
print_r($_POST);
echo "</pre>";


$sessionNew = new Session();

if ($_POST["name"] != "" || $_POST["email"] != "") {
    $sessionNew->resetSession();
    $sessionNew->addSession("name", $_POST["name"]);
    $sessionNew->addSession("email", $_POST["email"]);
    $hashed_password = password_hash($_POST["pswd"], PASSWORD_DEFAULT);
    $sessionNew->addSession("pswd", $hashed_password);
} else
    echo "<br/>There is not enough information to change Session";

$sessionNew->showSession();

echo "<button onclick='window.location.href=`../index_HW_Session.php`'>Return</button>";

//require_once 'Model/Session.php';
//<form action="src/Controllers/Login.php" method="post">
//    Name: <input type="text" name="name"><br>
//    E-mail: <input type="text" name="email"><br>
//    Password: <input type="password" name="pswd"><br>
//<input type="submit">
//</form>


