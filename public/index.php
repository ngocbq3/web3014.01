<?php
require_once __DIR__ . "/../vendor/autoload.php";
require_once __DIR__ . "/../config.php";

use App\Controllers\Controller;
use App\Controllers\HomeController;
use App\Controllers\ProductController;
use App\Router;

Router::get('/', function () {
    echo "HOME PAGE";
});

Router::get('/contact', function () {
    echo "Contact Page";
});

Router::get('/about-us', function () {
    echo "About page";
});

Router::post('/contact', function () {
    echo "Contact Page method post";
});

Router::get('/home', [HomeController::class, 'index']);
Router::get('/detail', [HomeController::class, 'show']);
Router::get('/product/add', [ProductController::class, 'add']);
Router::post('/product/add', [ProductController::class, 'save']);
Router::get('/product-show', [ProductController::class, 'show']);
Router::get('/product/delete', [ProductController::class, 'delete']);
Router::get('/product-edit', [ProductController::class, 'edit']);
Router::post('/product-edit', [ProductController::class, 'store']);

Router::run();
