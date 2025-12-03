<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/imovel/(:num)', 'Home::detalhe/$1');

$routes->get('/visitas', 'Visitas::index');

$routes->group('', ['filter' => 'auth:usuario'], function($routes) {
    $routes->match(['GET','POST'], '/visitas/formulario', 'Visitas::formulario');
    $routes->match(['GET','POST'], '/visitas/formulario/(:num)', 'Visitas::formulario/$1');
    $routes->get('visitas/excluir/(:num)', 'Visitas::excluir/$1');
    $routes->get('/perfil', 'Perfil::index');
    $routes->match(['POST','PUT'], '/perfil/editar', 'Perfil::editar');
});

$routes->match(['GET', 'POST'], '/login', 'Login::index');
$routes->match(['GET', 'POST'], '/registrar', 'Registrar::index');
$routes->get('/logout', 'Logout::index');

$routes->group('admin', ['filter' => 'auth:admin'], function($routes) {
    $routes->get('', 'Admin\Home::index');
    $routes->get('logout', 'Admin\Logout::index');
    $routes->get('usuarios', 'Admin\Usuarios::index');
    $routes->get('imoveis', 'Imoveis::index');
    $routes->match(['GET','POST'], 'imoveis/adicionar', 'Imoveis::adicionar');
    $routes->match(['GET','POST'], 'imoveis/editar/(:num)', 'Imoveis::editar/$1');
    $routes->get('imoveis/excluir/(:num)', 'Imoveis::excluir/$1');
    $routes->get('clientes', 'Clientes::index');
    $routes->match(['GET','POST'], 'clientes/adicionar', 'Clientes::adicionar');
    $routes->match(['GET','POST'], 'clientes/editar/(:num)', 'Clientes::editar/$1');
    $routes->get('clientes/excluir/(:num)', 'Clientes::excluir/$1');
    $routes->get('visitas', 'Visitas::index');
    $routes->get('visitas/excluir/(:num)', 'Visitas::excluir/$1');
});

$routes->group('', ['filter' => 'auth:usuario'], function($routes){
    $routes->get('visitas', 'Visitas::index');
    $routes->get('visitas/formulario', 'Visitas::formulario');
    $routes->match(['get','post'],'visitas/editar/(:num)', 'Visitas::editar/$1');
    $routes->get('visitas/excluir/(:num)', 'Visitas::excluir/$1');
});