<?php
header('Cache-Control: no cache'); //no cache
session_cache_limiter('private_no_expire'); // works
session_start();
//session_destroy();
//session_start();

use Framework\Router\Router;
use Framework\Session\SessionControl;
use Monolog\Logger;
use Monolog\Handler\StreamHandler;

//1. Общие настройки
ini_set('display_errors', 1);
error_reporting(E_ALL);

//2. Подключение файлов

define("ROOT", dirname(__FILE__));
require_once "vendor/autoload.php";
echo " <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3' crossorigin='anonymous'>
    <link href='https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css' rel='stylesheet'
          integrity='sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC' crossorigin='anonymous'>";

//3. Подключаем базу данных
// Looking for .env at the root directory
$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();
$MAILER_DSN = $_ENV['MAILER_DSN'];

//4 Создаем канал журнала
$log = new Logger('php_nix_logger ');
$log->pushHandler(handler: new StreamHandler(ROOT.'/monolog.log', level: Logger::DEBUG));
$log->addRecord(\Monolog\Level::Info, "start index.php");

//5. Включаем фреймворк сессии
$sessionControl = new SessionControl();

//6 Вызов Роутер
$router = new Router();
$router->run();
