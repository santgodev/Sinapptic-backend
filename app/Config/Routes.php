<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->post('auth/login','AuthController::login');
// Grupo de rutas para modulos
$routes->group('modulos',['filter' => 'jwt-auth'], function($routes) {
    $routes->get('/', 'ModuloController::listarModulos');
    $routes->post('autorizados', 'ModuloController::listarModulosAutorizados');
});

// Grupo de rutas para componentes
$routes->group('componentes', ['filter' => 'jwt-auth'], function($routes) {
    $routes->get('/', 'ComponenteController::listarComponentes');
    $routes->post('autorizados', 'ComponenteController::listarcomponentesAutorizados');
});

// Grupo de rutas para usuarios
$routes->group('usuarios', ['filter' => 'jwt-auth'], function($routes) {
    $routes->get('/', 'UsuarioController::listarUsuarios');
    $routes->post('listar', 'UsuarioController::listarUsuarioId');
    $routes->post('insertar', 'UsuarioController::insertarUsuario');
    $routes->put('actualizar', 'UsuarioController::actualizarUsuario');
    $routes->delete('eliminar', 'UsuarioController::eliminarUsuario');
});
