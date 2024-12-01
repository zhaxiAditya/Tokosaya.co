<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'landpage');
$routes->get('/harga', 'landpage::harga');
$routes->get('/kebijakan', 'landpage::kebijakan');
$routes->get('/kontak', 'landpage::kontak');


$routes->get('/user/login', 'Home::login');
$routes->get('/user', 'Home::regis');

$routes->post('/save', 'Home::save');
$routes->post('/masuk', 'Home::loginProses');
$routes->get('/logout', 'Home::logout');

$routes->get('/dashboard', 'dashboard');
$routes->get('/dashboard/add', 'dashboard::formadd');
$routes->post('/dashboard/save', 'dashboard::save');
