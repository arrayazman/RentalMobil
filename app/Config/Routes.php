<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */


// Auth Routes (Publicly accessible)
$routes->get('/login', 'Auth::login');
$routes->post('/login', 'Auth::processLogin');
$routes->get('/logout', 'Auth::logout');

// Protected Routes
$routes->group('', ['filter' => 'auth'], function ($routes) {
    $routes->get('/', 'Home::index');

    // Mobil
    $routes->get('/mobil', 'Mobil::index');
    $routes->get('/mobil/create', 'Mobil::create');
    $routes->post('/mobil/store', 'Mobil::store');
    $routes->get('/mobil/edit/(:num)', 'Mobil::edit/$1');
    $routes->post('/mobil/update/(:num)', 'Mobil::update/$1');
    $routes->delete('/mobil/delete/(:num)', 'Mobil::delete/$1');

    // Pelanggan
    $routes->get('/pelanggan', 'Pelanggan::index');
    $routes->get('/pelanggan/create', 'Pelanggan::create');
    $routes->post('/pelanggan/store', 'Pelanggan::store');
    $routes->get('/pelanggan/edit/(:num)', 'Pelanggan::edit/$1');
    $routes->post('/pelanggan/update/(:num)', 'Pelanggan::update/$1');
    $routes->delete('/pelanggan/delete/(:num)', 'Pelanggan::delete/$1');
    $routes->get('/pelanggan/cetak', 'Pelanggan::cetak');

    // Sewa
    $routes->get('/sewa', 'Sewa::index');
    $routes->get('/sewa/create', 'Sewa::create');
    $routes->post('/sewa/store', 'Sewa::store');
    $routes->get('/sewa/edit/(:num)', 'Sewa::edit/$1');
    $routes->post('/sewa/update/(:num)', 'Sewa::update/$1');
    $routes->delete('/sewa/delete/(:num)', 'Sewa::delete/$1');
    $routes->get('/sewa/kwitansi/(:num)', 'Sewa::kwitansi/$1');

    // Pengembalian
    $routes->get('/pengembalian', 'Pengembalian::index');
    $routes->get('/pengembalian/create', 'Pengembalian::create');
    $routes->post('/pengembalian/store', 'Pengembalian::store');
    $routes->get('/pengembalian/edit/(:num)', 'Pengembalian::edit/$1');
    $routes->post('/pengembalian/update/(:num)', 'Pengembalian::update/$1');
    $routes->delete('/pengembalian/delete/(:num)', 'Pengembalian::delete/$1');
    $routes->get('/pengembalian/kwitansi/(:num)', 'Pengembalian::kwitansi/$1');

    // Laporan
    $routes->get('/laporan', 'Laporan::index');
    $routes->post('/laporan/cetak', 'Laporan::cetak');
});