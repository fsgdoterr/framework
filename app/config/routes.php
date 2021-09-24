<?php
use App\Core\Router;

Router::add('GET', 'main', [MainController::class, 'show']);