<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// $routes->get('/', 'Home::index');
$routes->get('/', 'Attendance::index');
$routes->post('/attendance/login', 'Attendance::login');
$routes->post('/attendance/logout', 'Attendance::logout');
$routes->get('/attendance/register', 'Attendance::register');
$routes->post('attendance/saveRegister', 'Attendance::saveRegister');

