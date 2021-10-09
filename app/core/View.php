<?php
namespace App\Core;
use App\Core\Router;

class View
{
    public $path;
    public $layout = 'default';

    public function render($path, $layout = null, $args = [])
    {
        $view = new View();
        if($layout!=null) {
            
            ob_start();
            extract($args);
            require realpath(dirname(__FILE__) . '/../views/' . $path . '.php');
            $layoutContent = ob_get_clean();
            require realpath(dirname(__FILE__) . '/../views/' . $layout . '.php');
        }
        else {
            extract($args);
            require realpath(dirname(__FILE__) . '/../views/' . $path . '.php');
        }

        
    }

    public function redirect($name, $slugs = []) 
    {
        $router = new Router();
        $names = $router->getNamed();
        $redirectUrl = $names[$name];
        if(preg_match_all('!\{([^}]*)\}!', $redirectUrl, $matches))
        {
            $i = 0;
            foreach($matches[0] as $key => $value)
            {
                $redirectUrl = preg_replace("!\{([". trim($value, '{}') ."}]*)\}!", $slugs[$i], $redirectUrl);
                $i++;
            }
            header('Location: ' . $redirectUrl);
        }
        else
        {
            header('Location: ' . $redirectUrl);
        }
    }

    public function name($name, $slugs = [])
    {
        $router = new Router();
        $names = $router->getNamed();
        $redirectUrl = $names[$name];
        if(preg_match_all('!\{([^}]*)\}!', $redirectUrl, $matches))
        {
            $i = 0;
            foreach($matches[0] as $key => $value)
            {
                $redirectUrl = preg_replace("!\{([". trim($value, '{}') ."}]*)\}!", $slugs[$i], $redirectUrl);
                $i++;
            }
            return $_ENV['protocol'] . '://' . $_ENV['domain']. '/' . trim($redirectUrl, '/');
        }
        else
        {
            return $_ENV['protocol'] . '://' . $_ENV['domain']. '/' . trim($redirectUrl, '/');
        }
    }

    public static function errorView($type)
    {
        http_response_code($type);
        require realpath(dirname(__FILE__) . '/../views/errors/' . $type . '.php');
        exit;
    }
}