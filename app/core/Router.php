<?php
namespace App\Core;

class Router
{
    private static $routes = [];
    private static $named = [];
    private static $currentRoute;
    private $params = [];
    private $matches;
    private $slugs;

    public static function add(string $method, string $uri, array $controllerAndAction = []): Router
    {
        $method = mb_strtoupper($method);

        $preparedUri = '#^' . trim($uri, '/') . '$#';
        self::$routes[$method][$preparedUri] = [
            'controller' => $controllerAndAction[0],
            'action'     => $controllerAndAction[1],
        ];
        self::$currentRoute = $uri;
        return new self;
    }

    public function handlingUri($uri)
    {
        if(preg_match('', $uri, $matches))
        {

        }
    }

    public function name(string $name)
    {
        self::$named[$name] = self::$currentRoute;
    }

    public function getNamed()
    {
        return self::$named;
    }

    public function match()
    {
        $url = trim($_SERVER['REQUEST_URI'],'/');
        $method = $_SERVER['REQUEST_METHOD'];
        $this->slugs = require __DIR__ . '/../config/slugs.php';
        if($method == 'GET')
        {
            foreach(self::$routes['GET'] as $route => $params)
            {
                if(preg_match_all('!\{([^}]*)\}!', $route, $matches))
                {
                    foreach($matches[0] as $key => $value)
                    {
                        if(array_key_exists(trim($value, '{}'), $this->slugs))
                        {
                            $route = preg_replace("!\{([". trim($value, '{}') ."}]*)\}!", $this->slugs[trim($value, '{}')], $route);
                            $this->matches[trim($value, '{}')] = '';
                        }
                        else
                        {
                            $route = preg_replace("!\{([". trim($value, '{}') ."}]*)\}!", "([a-zA-Z0-9_-]+)", $route);
                            $this->matches[trim($value, '{}')] = '';
                        }
                    }
                }
                if(preg_match($route, $url, $matches))
                {
                    unset($matches[0]);
                    $matches = array_values($matches);
                    $this->params = $params;
                    if(isset($this->matches)){
                        $i = 0;
                        foreach($this->matches as $key => $value)
                        {
                            $this->matches[$key] = $matches[$i];
                            $i++;
                        }
                        unset($i);
                    }
                    
                    return true;
                }
                else {
                    $this->matches = [];
                }
            }
            return false;
        }
        else if($method == 'POST')
        {
            foreach(self::$routes['POST'] as $route => $params)
            {
                if(preg_match_all('!\{([^}]*)\}!', $route, $matches))
                {
                    foreach($matches[0] as $key => $value)
                    {
                        if(array_key_exists(trim($value, '{}'), $this->slugs))
                        {
                            $route = preg_replace("!\{([". trim($value, '{}') ."}]*)\}!", $this->slugs[trim($value, '{}')], $route);
                            $this->matches[trim($value, '{}')] = '';
                        }
                        else
                        {
                            $route = preg_replace("!\{([". trim($value, '{}') ."}]*)\}!", "([a-zA-Z0-9_-]+)", $route);
                            $this->matches[trim($value, '{}')] = '';
                        }
                    }
                }
                if(preg_match($route, $url, $matches))
                {
                    unset($matches[0]);
                    $matches = array_values($matches);
                    $this->params = $params;
                    if(isset($this->matches)){
                        $i = 0;
                        foreach($this->matches as $key => $value)
                        {
                            $this->matches[$key] = $matches[$i];
                            $i++;
                        }
                        unset($i);
                    }
                    $this->matches['request'] = new Request($_POST);
                    return true;
                }
                else {
                    $this->matches = [];
                }
            }
            return false;
        }

    }
    public function run() 
    {
        if($this->match())
        {
            $path = $this->params['controller'];
            if(class_exists($path))
            {
                $controller = new $path($this->params);
                $action = $this->params['action'];
                if(method_exists($controller, $action))
                {
                    call_user_func_array([$controller, $action] , [$this->matches]);
                }
                else
                {
                    View::errorView(404);
                }
            }
            else
            {
                View::errorView(404);
            }
        }
        else 
        {
            View::errorView(404);
        }
        
    }
}