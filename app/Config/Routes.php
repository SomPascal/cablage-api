<?php

use App\Controllers\CustomerController;
use App\Controllers\DraftController;
use App\Controllers\ErrorController;
use App\Controllers\Home;
use App\Controllers\PaymentsController;
use App\Entities\CustomerEntity;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', [Home::class, 'index']);

$routes->environment('development', static function (RouteCollection $routes)
{
    $routes->get('token', [DraftController::class, 'token']);
});

$routes->group('customers', static function (RouteCollection $routes)
{
    $routes->get('search', [CustomerController::class, 'search']);
    $routes->get('get', [CustomerController::class, 'get']);
    $routes->post('create', [CustomerController::class, 'create']);
    $routes->post('delete', [CustomerController::class, 'delete']);
});

$routes->group('payments', static function (RouteCollection $routes)
{
    $routes->post('save', [PaymentsController::class, 'save']);
    $routes->get('get', [PaymentsController::class, 'get']);
});

$routes->set404Override(sprintf('%s::notFound', ErrorController::class));
