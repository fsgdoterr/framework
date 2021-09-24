<?php
namespace App\Core;

class Router
{
    private static $routes = [];
    private $params = [];

    public static function add(string $method, string $uri, array $controllerAndAction = [])
    {
        $method = mb_strtoupper($method);
        //$uri = '#^' . trim($uri, '/') . '$#';
        $uri = '/'. trim($uri, '/') . '/';
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
            var_dump(self::$routes);
                echo '<br>';
            foreach(self::$routes['GET'] as $route => $params)
            {
                
                var_dump($route);
                if(preg_match($route, $url, $matches))
                {
                    $this->params = $params;
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
            echo 'маршрут найден';
        }
        else {
            echo 'Маршрут не найден';
        }
        
    }
}