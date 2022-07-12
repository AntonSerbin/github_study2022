<?php

namespace Framework\Router;

//use \LoginController;

class Router
{
    public function __construct()
    {
        $routePath = ROOT . '/App/config/routes.php';
        echo $routePath;
        $this->routes = include($routePath);
    }

    private $routes;

    /**
     * return Url string from browser
     */
    private function getUri()
    {
        print_r(trim($_SERVER['REQUEST_URI']));

        if ($_SERVER['REQUEST_URI'] === '/') {
            return "/index";
        }
        if (!empty($_SERVER['REQUEST_URI'])) {
            return (trim($_SERVER['REQUEST_URI'], "/"));
        };
        return "";
    }

    public function run()
    {
        //получаем текущую броузер-строку
        $uri = $this->getUri();

        //проверяем, есть ли в ней совпадения с routes.php
        foreach ($this->routes as $uriInCnfg => $middlewaresArr) {
            foreach ($middlewaresArr as $patternControllerAction) {

                //сравниваем содержимое слева routes.php со строкой
                if (preg_match("/$uriInCnfg/", "$uri") && $patternControllerAction[0]) {

                    //определяем какой экшен и контроллер
                    $arr = explode("/", $patternControllerAction);
                    $controllerName = array_shift($arr) . 'Controller';
                    $controllerName = ucfirst($controllerName);
                    $actionName = "action" . ucfirst(array_shift($arr));
                    echo "<br>".$actionName."<br>";
                    echo "<br>".$controllerName."<br>";

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
                    $result = $controllerObj->$actionName();
                    if ($result != null) {
                        break;
                    }
                }
            }
        }
        return true;
    }
}
