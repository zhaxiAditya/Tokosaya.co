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

$routes->get('/dashboard/riwayat', 'dashboard::riwayat');
$routes->get('/dashboard', 'dashboard');
$routes->post('/dashboard', 'dashboard');
$routes->get('/dashboard/add', 'dashboard::formadd');
$routes->post('/dashboard/save', 'dashboard::save');
$routes->get('/dashboard/masuk', 'dashboard::stokMasuk');
$routes->post('/dashboard/masuk', 'dashboard::stokMasuk');
$routes->get('/dashboard/keluar', 'dashboard::stokKeluar');
$routes->post('/dashboard/keluar', 'dashboard::stokKeluar');

$routes->get('/dashboard/hapus/(:num)', 'dashboard::delete/$1');
$routes->get('/dashboard/edit/(:num)', 'dashboard::formedit/$1');
$routes->post('/dashboard/update/(:num)', 'dashboard::update/$1');
$routes->post('/dashboard/masuk/(:num)', 'dashboard::tambahJumlah/$1');
$routes->post('/dashboard/keluar/(:num)', 'dashboard::kurangJumlah/$1');

