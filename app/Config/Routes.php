<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::listarModulos', ['filter' => 'cors']);
$routes->post('modulos', 'Home::index', ['filter' => 'cors']);



