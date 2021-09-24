<?php
use App\Core\Router;

Router::add('GET', '', [MainController::class, 'show']);