<?php

use CodeIgniter\Router\RouteCollection;
use App\Controllers\Pages;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

#  #
##############################################################################
# Se definen las rutas para el controladore Pages, estas seran aacesebles en #
# la url http://localhost/instituciones/public/pages/' y                     #
##############################################################################
$routes->get('pages', [Pages::class, 'index']);       #la ruta hace referencia un controlador 
$routes->get('(:segment)', [Pages::class, 'view']);   #la ruta hace referencia un controlador con parametros
