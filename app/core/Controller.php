<?php
namespace App\Core;

use App\Core\View;

abstract class Controller
{
    public $route = [];

    protected $view;

    public function __construct($route)
    {
        $this->route = $route;
        $this->view = new View();
    }
}