<?php

namespace App\Models;

class Session
{
    public function __construct()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public function addSession($index, $value)
    {
        $_SESSION[$index] = $value;
        return $_SESSION[$index];
    }

    public function showSession()
    {
        echo "<pre> <b>Information in current session</b><br><br>";
        echo "ID of session:" . session_id() . "<br/>";
        print_r($_SESSION);
        echo "</pre>";
    }

    public function getSession()
    {
        return $_SESSION;
    }

    public function resetSession()
    {
        $_SESSION = [];
    }
}

