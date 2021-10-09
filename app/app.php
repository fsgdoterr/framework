<?php
namespace App;
use App\Core\Router;

class App
{
    

    public function __construct()
    {
        $this->scan();
        include 'config/routes.php';
        $router = new Router();
        $router->run();
    }

    private function scan()
    {
        $dir = __DIR__ . "\\config\\";
        $skip = [
            '.', '..', 'routes.php', 'slugs.php',
        ];
        $files = scandir($dir);
        for($i = 0;$i < count($skip);$i++)
        {
            unset($files[array_search($skip[$i], $files)]);
        }
        $files = array_values($files);
        foreach($files as $value)
        {
            $arr = require $dir . $value;
            foreach($arr as $key => $params)
            {
                $_ENV[$key] = $params;
            }
        }
    }
}