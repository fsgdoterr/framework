<?php
namespace App;
use App\Core\Router;


class App
{
    

    public function __construct()
    {
        include 'config/routes.php';
        $router = new Router();
        $router->run();
    }
}