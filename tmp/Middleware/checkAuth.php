<?php

namespace Middleware;

use controllers\LoginController;
use frameworkVendor\Router;

class checkAuth
{
    public function handle()
    {
//        echo "checkAuth -> handle()";
        $checkSession = isset($_SESSION['user']) ? true : false;
        if ($checkSession) {
//            echo "<br>There is a session User<br>";
            return true;
        } else {
            echo "<br>NO SESSION<br>";
            return false;
        }
    }
}