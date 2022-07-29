<?php

namespace Framework\Router;

class Router
{
    public function __construct()
    {
        $routePath = ROOT . '/App/config/routes.php';
        $this->routes = include($routePath);
    }

    private mixed $routes;

    /**
     * return Url string from browser
     */
    private function getUri()
    {
        if ($_SERVER['REQUEST_URI'] === '/') {
            return "/index";
        }
        if (!empty($_SERVER['REQUEST_URI'])) {
            $arrUri = (trim($_SERVER['REQUEST_URI'], "/"));
            return $arrUri;
        };
        return "";
    }

    private function isUriMatch($uri, $uriInCnfg)
    {
        $arrUri = explode("/", $uri);
        $arrUriInCnfg = explode("/", $uriInCnfg);
        if (count($arrUri) !== count($arrUriInCnfg)) {
            return false;
        }
        for ($i = 0; $i < count($arrUri); $i++) {
            $isParam = str_starts_with($arrUriInCnfg[$i], ":");
            if ($arrUri[$i] !== $arrUriInCnfg[$i] && !$isParam) {
                return false;
            }
        }
        return true;
    }

    private function extractParamUri($uri, $uriInCnfg)
    {
        $arrUri = explode("/", $uri);
        $arrUriInCnfg = explode("/", $uriInCnfg);
        if (count($arrUri) !== count($arrUriInCnfg)) {
            return false;
        }
        $params = [];
        for ($i = 0; $i < count($arrUri); $i++) {
            $isParam = str_starts_with($arrUriInCnfg[$i], ":");
            if ($isParam) {
                $key = substr($arrUriInCnfg[$i], 1);
                $value = $arrUri[$i];
                $params[$key] =$value;
            }
        }
        return $params;
    }


    public function run()
    {
        //получаем текущую броузер-строку
        $uri = $this->getUri();

        //проверяем, есть ли в ней совпадения с routes.php
        foreach ($this->routes as $uriInCnfg => $middlewaresArr) {
            foreach ($middlewaresArr as $patternControllerAction) {

                //сравниваем содержимое слева routes.php со строкой

                if ($this->isUriMatch($uri, $uriInCnfg)) {
                   $params =  $this->extractParamUri($uri, $uriInCnfg);
//                if (preg_match("/$uriInCnfg/", "$uri")
//                    && $patternControllerAction[0]) {

                    //определяем какой экшен и контроллер
                    $arr = explode("/", $patternControllerAction);
                    $controllerName = array_shift($arr) . 'Controller';
                    $controllerName = ucfirst($controllerName);
                    $actionName = "action" . ucfirst(array_shift($arr));

                    //нужна ли проверка Middleware
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

                    //создаём объект и вызываем экшен в подключенном классе
                    $str = "App\Controller\\$controllerName";

                    $controllerObj = new $str();
                    $result = $controllerObj->$actionName($params);
                    if ($result != null) {
                        break;
                    }
                }
            }
        }
        return true;
    }
}
