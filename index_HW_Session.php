﻿<?php
error_reporting(E_ALL);
ini_set("display_errors", 1);
require_once 'Models/Session.php';
?>

<form action="src/Controllers/login.php" method="post">
    Name: <input type="text" name="name"><br>
    E-mail: <input type="text" name="email"><br>
    Password: <input type="password" name="pswd"><br>
<input type="submit">
</form>
