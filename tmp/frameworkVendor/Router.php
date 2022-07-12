<?php

namespace frameworkVendor;

use controllers\LoginController;

class Router
{
    public function __construct(){
        echo "test";
    }
    public function run()
    {
        echo "run";
    }
//    private $routes;
//
//    public function __construct()
//    {
//        $routePath = ROOT . '/config/routes.php';
//        $this->routes = include($routePath);
//    }
//
//    /**
//     * return Url string from browser
//     */
//    private function getUri()
//    {
//        if ($_SERVER['REQUEST_URI']==='/') {
//            return "/index";
//        }
//        if (!empty($_SERVER['REQUEST_URI'])) {
//            return (trim($_SERVER['REQUEST_URI'], "/"));
//        };
//        return "";
//    }
//
//    public function run()
//    {
//        //получаем текущую броузер-строку
//        $uri = $this->getUri();
//
//        //проверяем, есть ли в ней совпадения с routes.php
//
//        foreach ($this->routes as $uriInCnfg => $middlewaresArr) {
//            foreach ($middlewaresArr as $patternControllerAction) {
//
//                //сравниваем содержимое слева routes.php со строкой
//                if (preg_match("/$uriInCnfg/", "$uri") && $patternControllerAction[0]) {
//
//                    //определяем какой экшен и контроллер
//                    $arr = explode("/", $patternControllerAction);
//                    $controllerName = array_shift($arr) . 'Controller';
//                    $controllerName = ucfirst($controllerName);
//                    $actionName = "action" . ucfirst(array_shift($arr));
//
//                    //нужна ли проверка Middleware
//                    foreach ($middlewaresArr[1] as $middlewareEl) {
//                        if ($middlewareEl) {
//                            $nameMiddleware = "Middleware\\$middlewareEl";
//                            $middlewareObj = new $nameMiddleware();
//                            $res = $middlewareObj->handle();
//                            if ($res == false) {
//                                (new LoginController())->actionShowUserForm();
//                                return true;
//                            }
//                        }
//                    }
//                    //создаём объект и вызываем экшен в подключенном классе
//                    $str = "controllers\\$controllerName";
//                    $controllerObj = new $str();
//                    $result = $controllerObj->$actionName();
//                    if ($result != null) {
//                        break;
//                    }
//                }
//            }
//        }
//    return true;
//    }
}
