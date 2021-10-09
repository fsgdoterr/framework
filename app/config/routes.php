<?php
use App\Core\Router;
use App\Controllers\MainController;


Router::add('GET', '/', [MainController::class, 'main'])->name('main');
Router::add('GET', '/id{id}', [MainController::class, 'page'])->name('page');
Router::add('GET', '/testpost', [MainController::class, 'test_post'])->name('test_post');
Router::add('POST', '/testpost2', [MainController::class, 'test_post2'])->name('test_post2');
