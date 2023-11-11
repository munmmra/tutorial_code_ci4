<?php

namespace App\Controllers;


use CodeIgniter\Exceptions\PageNotFoundException; // Add this line

# #
##############################################################################
# Definicion de la clase para el controlador Pages.                          #
# Esta clase manejará las solicitudes que se realicen a                      #
# http://localhost/instituciones/public/pages/ por medio de la ruta          #
# $routes->get('pages', [Pages::class, 'index']); usando el método index().  #
#                                                                            # 
# Esta clase manejará las solicitudes que se realicen a una pagina dinamica  #
# que se realicen al servido usando el comodin (:segment), dirigidas a       # 
# http://localhost/instituciones/public/nombre_de_la_pagina/ pormedio de la  #
# ruta $routes->get('(:segment)', [Pages::class, 'view']); usando el métodp  #
# view(nombre_de_la_página)                                                  #
##############################################################################
class Pages extends BaseController
{
    public function index()
    {
        return view('welcome_message');
    }

    public function view($page = 'home')
    {
        # Dado que se esta ingrtesando a una pagina de forma dinamica hay que
        # verificar wue esta exista, levantando una excepcion en caso de que 
        # la pagina no exista y regresando la página en caso de si exista

        if (! is_file(APPPATH . 'Views/pages/' . $page . '.php')) {
            // Whoops, we don't have a page for that!
            throw new PageNotFoundException("la página " . $page . " no fue encontrada");
        }

        $data['title'] = ucfirst($page); // Capitalize the first letter

        return view('templates/header', $data)
            . view('pages/' . $page)
            . view('templates/footer');
    }
}