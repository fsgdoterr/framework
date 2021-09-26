<?php
namespace App\Core;

class Router
{
    private static $routes = [];
    private $params = [];
    private $args;

    public static function add(string $method, string $uri, array $controllerAndAction = [])
    {
        $method = mb_strtoupper($method);
        $uri = '#^' . trim($uri, '/') . '$#';
        self::$routes[$method][$uri] = [
            'controller' => $controllerAndAction[0],
            'action'     => $controllerAndAction[1],
        ];
        return new self;
    }

    public function name(string $uri = 's')
    {
        echo $uri;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'],'/');
        $method = $_SERVER['REQUEST_METHOD'];
        if($method == 'GET')
        {
            foreach(self::$routes['GET'] as $route => $params)
            {
                if(preg_match($route, $url, $matches))
                {
                    unset($matches[0]);
                    $matches = array_values($matches);
                    $this->params = $params;
                    $this->args = $matches;
                    return true;
                }
            }
            return false;
        }
        else if($method == 'POST')
        {
            
        }

    }
    public function run() 
    {
        if($this->match())
        {
            $controller = '\\App\\controllers\\'. $this->params['controller'];
            if(class_exists($controller))
            {
                $action = $this->params['action'];
                if(method_exists($controller, $action))
                {
                    call_user_func_array([$controller, $action] , $this->args);
                }
                else
                {
                    echo 'Метод не найден';
                }
            }
            else
            {
                echo 'Контроллер не найден';
            }
        }
        else 
        {
            echo 'Маршрут не найден';
        }
        
    }
}