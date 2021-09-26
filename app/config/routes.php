<?php
use App\Core\Router;

Router::add('GET', 'main', [MainController::class, 'show']);
Router::add('GET', 'main/([a-zA-Z0-9]+)/([a-zA-Z0-9]+)', [MainController::class, 'show']);
Router::add('GET', 'main/login', [MainController::class, 'show']);