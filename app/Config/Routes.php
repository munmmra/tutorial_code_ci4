<?php

use CodeIgniter\Router\RouteCollection;

use App\Controllers\News;
use App\Controllers\Pages;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Home::index');

#  #
##############################################################################
# Se definen las rutas para el controlador News, estas seran accesebles en   #
# la las url:                                                                #
#     http://localhost/instituciones/public/news/                            #
#     http://localhost/instituciones/public/news/slag_de_la_noticia          #
#     http://localhost/instituciones/public/news/new                         #
#     http://localhost/instituciones/public/news/  (post)                    #
##############################################################################
$routes->get('news', [News::class, 'index']);           // Add this line
$routes->get('news/new', [News::class, 'new']); // Add this line
$routes->post('news', [News::class, 'create']); // Add this line
$routes->get('news/(:segment)', [News::class, 'show']); // Add this line

#  #
##############################################################################
# Se definen las rutas para el controlador Pages, estas seran accesebles en  #
# la url http://localhost/instituciones/public/pages/' y                     #
##############################################################################
$routes->get('pages', [Pages::class, 'index']);       #la ruta hace referencia un controlador 
$routes->get('(:segment)', [Pages::class, 'view']);   #la ruta hace referencia un controlador con parametros
