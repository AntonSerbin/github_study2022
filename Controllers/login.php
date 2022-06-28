<?php
require_once '../Models/session.php';
echo "Login Page<br>";

echo "<pre> <b>Posted information from login page</b><br><br>";
print_r($_POST);
echo "</pre>";


$sessionNew = new sessionControl;
if ($_POST["name"] != "" || $_POST["email"] != "") {
    $sessionNew->resetSession();
    $sessionNew->addSession("name", $_POST["name"]);
    $sessionNew->addSession("email", $_POST["email"]);
    $hashed_password = password_hash($_POST["pswd"], PASSWORD_DEFAULT);
    $sessionNew->addSession("pswd", $hashed_password);

}
else
    echo "<br/>There is not enough information to change Session";

$sessionNew->showSession();

echo "<button onclick='window.location.href=`../index.php`'>Return</button>";



