<?php

namespace Framework\Session;

class SessionControl
{

    public function __construct()
    {
        if (!isset($_SESSION['timeOfCreate'])) $_SESSION['timeOfCreate'] = date("Y-m-d h:i:sa");
    }

    public static function getSession()
    {
        return $_SESSION;
    }

    public static function writeDataToSession($id, $data)
    {
        if ($id && $data) {
            $_SESSION["user"][$id] = $data;
        }
        return true;
    }

    public static function clearJSONSession()
    {
        unset($_SESSION["user"]["jsonArr"]);
    }

    public static function unsetSession($title)
    {
        unset($_SESSION[$title]);
    }

}