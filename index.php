<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
//session_destroy();
//session_start();

use Framework\Router\Router;
use Framework\Session\SessionControl;
use antons_route\Logger;

//use Monolog\Logger;
//use Monolog\Handler\StreamHandler;

//1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

//2. Подключение файлов

define("ROOT", dirname(__FILE__));
require_once "vendor/autoload.php";

//3. Подключаем базу данных
// Looking for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$MAILER_DSN = $_ENV['MAILER_DSN'];

//4 Создаем канал журнала
require_once "vendor/antonserbin/serbin_logger/logserbin/LoggerModel.php";
require_once "vendor/antonserbin/serbin_logger/logserbin/LoggerInterface.php";
require_once "vendor/antonserbin/serbin_logger/logserbin/LogLevel.php";
$log = new Logger("antons", "App");
//$log->pushHandler(handler: new StreamHandler(ROOT.'/monolog.Logger', level: Logger::DEBUG));
$log->log("INFO", "start index.php");

//5. Включаем фреймворк сессии
$sessionControl = new SessionControl();

//6 Вызов Роутер
$router = new Router();
$router->run();
