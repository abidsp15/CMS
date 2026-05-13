<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'ProductController::index');

$routes->get('/dashboard', 'DashboardController::index');

$routes->get('/products', 'ProductController::index');
$routes->get('/products/create', 'ProductController::create');
$routes->post('/products/store', 'ProductController::store');
$routes->get('/products/edit/(:num)', 'ProductController::edit/$1');
$routes->post('/products/update/(:num)', 'ProductController::update/$1');
$routes->get('/products/delete/(:num)', 'ProductController::delete/$1');

$routes->get('/buy/(:num)', 'OrderController::buy/$1');
$routes->get('/invoice/(:num)', 'OrderController::invoice/$1');

// API Endpoints
$routes->group('api', function($routes) {
    $routes->get('products', 'ApiController::products');
    $routes->get('products/(:num)', 'ApiController::product/$1');
    $routes->post('orders', 'ApiController::createOrder');
});
