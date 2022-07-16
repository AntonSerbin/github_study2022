<?php

namespace Framework\Session;

class SessionControl
{

    public function __construct()
    {
        echo "SessionControl started<br> ";
        if (!isset($_SESSION['timeOfCreate'])) $_SESSION['timeOfCreate'] = date("Y-m-d h:i:sa");
        print_r($_SESSION);
    }

    public static function getSession()
    {
        return $_SESSION;
    }

    public static function writeDataToSession($id, $data)
    {
        echo "LoginController -> writeDataToSession(id)<br>";
        if ($id && $data) {
            $_SESSION["user"][$id] = $data;
        }
        return true;
    }

    public static function unsetSession($title)
    {
        unset($_SESSION[$title]);
    }

}