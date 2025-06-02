<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

// Halaman utama
$routes->get('/', 'Home::index', ['filter' => 'auth']);

// Auth routes
$routes->get('login', 'AuthController::login');
$routes->post('login', 'AuthController::login');
$routes->get('logout', 'AuthController::logout');

// Produk
$routes->group('produk', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'ProdukController::index');
    $routes->post('', 'ProdukController::create');
    $routes->post('edit/(:any)', 'ProdukController::edit/$1');
    $routes->get('delete/(:any)', 'ProdukController::delete/$1');
});

// Kategori
$routes->group('kategori', ['filter' => 'auth'], function ($routes) { 
    $routes->get('', 'KategoriController::index');
    $routes->post('', 'KategoriController::create'); 
    $routes->post('edit/(:num)', 'KategoriController::edit/$1');
    $routes->get('delete/(:num)', 'KategoriController::delete/$1');
});

// Keranjang
$routes->get('keranjang', 'TransaksiController::index', ['filter' => 'auth', 'as' => 'keranjang']);

// Halaman lain
$routes->get('faq', 'Home::faq', ['filter' => 'auth', 'as' => 'faq']);
$routes->get('profile', 'Home::profile', ['filter' => 'auth', 'as' => 'profile']);
$routes->get('contact', 'Home::contact', ['filter' => 'auth', 'as' => 'contact']);

