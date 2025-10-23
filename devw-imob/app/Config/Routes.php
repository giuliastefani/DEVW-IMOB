<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */

$routes->get('/', 'Home::index');
$routes->get('/imovel/(:num)', 'Home::detalhe/$1');

$routes->get('/clientes', 'Clientes::index');
$routes->match(
    ['GET', 'POST'],
    '/clientes/adicionar',
    'Clientes::adicionar'
);
$routes->match(
    ['GET', 'POST'],
    '/clientes/editar/(:num)',
    'Clientes::editar/$1'
);
$routes->get('/clientes/excluir/(:num)', 'Clientes::excluir/$1');

$routes->get('/imoveis', 'Imoveis::index');
$routes->match(
    ['GET', 'POST'],
    '/imoveis/adicionar',
    'Imoveis::adicionar'
);
$routes->match(
    ['GET', 'POST'],
    '/imoveis/editar/(:num)',
    'Imoveis::editar/$1'
);
$routes->get('/imoveis/excluir/(:num)', 'Imoveis::excluir/$1');

$routes->get('/visitas', 'Visitas::index');
$routes->match(
    ['GET', 'POST'],
    '/visitas/formulario',
    'Visitas::formulario'
);
$routes->match(
    ['GET', 'POST'],
    '/visitas/formulario/(:num)',
    'Visitas::formulario/$1'
);
$routes->get('/visitas/excluir/(:num)', 'Visitas::excluir/$1');