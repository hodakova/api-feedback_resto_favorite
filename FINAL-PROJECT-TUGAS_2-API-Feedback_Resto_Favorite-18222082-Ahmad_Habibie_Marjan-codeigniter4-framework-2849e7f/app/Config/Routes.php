<?php

use App\Controllers\GiveFeedbackController;
use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');
$routes->get('/resto_branches', 'BranchDetailsController::resto_branches');
$routes->get('/give_feedback', 'GiveFeedbackController::index');
$routes->get('/give_feedback/getMenuItems/(:num)', 'GiveFeedbackController::getMenuItems/$1');
$routes->post('/give_feedback/submitFeedback', 'GiveFeedbackController::submitFeedback');
$routes->get('/my_feedbacks', 'MyFeedbackController::index');
$routes->get('/login', 'LoginController::index');
$routes->get('/logout', 'LoginController::logout');
$routes->post('/login_action', 'LoginController::login_action');

$routes->group('feedback', function ($routes) {
    $routes->get('/', 'FeedbackController::index');
    $routes->get('(:num)', 'FeedbackController::show/$1');
    $routes->post('/', 'FeedbackController::create');
    $routes->delete('(:num)', 'FeedbackController::delete/$1');
});

$routes->group('user', function ($routes) {
    $routes->get('/', 'UserController::index');
    $routes->get('(:num)', 'UserController::show/$1');
    $routes->post('/', 'UserController::create');
    $routes->delete('(:num)', 'UserController::delete/$1');
});

$routes->group('branch', function ($routes) {
    $routes->get('/', 'BranchController::index');
    $routes->get('(:num)', 'BranchController::show/$1');
    $routes->post('/', 'BranchController::create');
    $routes->delete('(:num)', 'BranchController::delete/$1');
});

$routes->group('menuItem', function ($routes) {
    $routes->get('/', 'MenuItemController::index');
    $routes->get('(:num)', 'MenuItemController::show/$1');
    $routes->post('/', 'MenuItemController::create');
    $routes->delete('(:num)', 'MenuItemController::delete/$1');
});