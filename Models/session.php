<?php
class sessionControl
{
    function __construct() {
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
        echo "<pre>";
        print_r($_SESSION);
        echo "</pre>";
    }
    public function getSession(){
        return$_SESSION;
    }
}

$sessionNew = new sessionControl;

$sessionNew->addSession("name1", "value1");
$sessionNew->addSession("name2", "value2");
$sessionNew->showSession();
print_r($sessionNew->getSession());