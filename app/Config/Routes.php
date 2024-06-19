<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::listarModulos');
$routes->get('moduloss', 'Home::listarModulos');
$routes->post('modulos', 'ModuloController::listarModuloID');
$routes->post('modulosAturorizados', 'ModuloController::listarModulosAutorizados');



