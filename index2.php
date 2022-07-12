<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
//session_cache_limiter('public'); // works too
session_start();

use frameworkVendor\Router;


//1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

//2. Подключение файлов
define("ROOT", dirname(__FILE__));
require_once "vendor/autoload.php";

//spl_autoload_register('myAutoloader');

//function myAutoloader($class)
//{
//    $file = ROOT . '/' . str_replace('\\', '/', $class) . '.php';
////    echo "SPL_AUTOLOAD_REGISTER, $class.php  <br>";
//    if (is_file($file)) {
//        require_once $file;
//    }
//}

//3. Подключаем базу с юзерами

//4 Вызов Роутер
$router = new Router();
$router->run();
