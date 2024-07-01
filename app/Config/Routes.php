<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
// Grupo de rutas para modulos
$routes->post('auth/login','AuthController::login');
$routes->group('modulos', function($routes) {
    $routes->post('/', 'ModuloController::listarModuloID');
    $routes->post('autorizados', 'ModuloController::listarModulosAutorizados');
});

// Grupo de rutas para componentes
$routes->group('componentes', ['filter' => 'jwt-auth'], function($routes) {
    $routes->post('/', 'ComponenteController::listarComponentes');
    $routes->post('autorizados', 'ComponenteController::listarComponentesAutorizados');
});

// Grupo de rutas para usuarios
$routes->group('usuarios', ['filter' => 'jwt-auth'], function($routes) {
    $routes->get('/', 'UsuarioController::listarUsuarios');
    $routes->post('listar', 'UsuarioController::listarUsuarioId');
    $routes->get('pass', 'UsuarioController::generarClave');
});
