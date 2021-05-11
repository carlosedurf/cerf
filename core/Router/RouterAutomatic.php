<?php

namespace CERF\Router;

class RouterAutomatic
{
    protected static string $uri;
    protected static string $controller;
    protected static string $action;
    protected static array $params = [];
    protected static string $controllerNF;
    protected static string $actionNF;
    protected static string $namespace;

    public static function run()
    {
        $routes = config('routes');

        self::$uri          =   $_SERVER['REQUEST_URI'];
        self::$controller   =   $routes['home'];
        self::$action       =   $routes['action'];
        self::$controllerNF =   $routes['404'];
        self::$actionNF     =   $routes['action'];
        self::$namespace    =   $routes['namespace'];

        if (self::$uri !== "/") {

            $uri = explode('/', self::$uri);
            array_shift($uri);

            self::checkController($uri);
            self::checkAction($uri);
            self::checkArgs($uri);
        }

        $controller = self::$namespace . self::$controller;

        $dir = config('dir');

        if (!file_exists($dir['controllers_path'] . self::$controller . ".php")) {
            self::$controller = self::$controllerNF;
            self::$action = self::$actionNF;
        }

        if (!method_exists($controller, self::$action)) {
            self::$controller = self::$controllerNF;
            self::$action = self::$actionNF;
        }

        $controller = self::$namespace . self::$controller;
        $c = new $controller();

        print call_user_func_array([$c, self::$action], self::$params);
    }

    private static function checkController(&$controller): void
    {
        if (isset($controller[0]) && !empty($controller[0])) {
            self::$controller = ucfirst($controller[0]) . "Controller";
            array_shift($controller);
        }
    }

    private static function checkAction(&$action): void
    {
        if (isset($action[0]) && !empty($action[0])) {
            self::$action = $action[0];
            array_shift($action);
        }
    }

    private static function checkArgs(&$params): void
    {
        if (count($params)) {
            self::$params = $params;
        }
    }
}
