<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Grupo de rutas para modulos

$routes->group('modulos', function($routes) {
    $routes->post('/', 'ModuloController::listarModuloID');
    $routes->post('autorizados', 'ModuloController::listarModulosAutorizados');
});

// Grupo de rutas para componentes
$routes->group('componentes', function($routes) {
    $routes->post('/', 'ComponenteController::listarComponentes');
    $routes->post('autorizados', 'ComponenteController::listarComponentesAutorizados');
});

// Grupo de rutas para usuarios
$routes->group('usuarios', function($routes) {
    $routes->get('/', 'UsuarioController::listarUsuarios');
    $routes->post('listar', 'UsuarioController::listarUsuarioId');
});