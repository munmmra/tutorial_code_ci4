<?php

namespace App\Controllers;

Use App\Models\NewsModel;
use CodeIgniter\Exceptions\PageNotFoundException; // Add this line

# #
##############################################################################
# Definicion de la clase para el controlador News.                           #
# Esta clase manejará las solicitudes que se realicen a                      #
# http://localhost/instituciones/public/news/ por medio de la ruta           #
# $routes->get('news', [News::class, 'index']); usando el método index().    #
#                                                                            # 
# Esta clase manejará las solicitudes que se realicen a una pagina dinamica  #
# que se realicen al servido usando el comodin (:segment), dirigidas a       # 
# http://localhost/instituciones/public/news/nombre_de_la_pagina pormedio    #
# de laruta $routes->get('(/news/:segment)', [Pages::class, 'view']); usando #
# el método show(nombre_de_la_página)                                        #
##############################################################################
class News extends BaseController
{
    public function index()
    {
        #return("<h1> New Controler News->index()</h1>");
        $model = model(NewsModel::class);

        // $data['news'] = $model->getNews();
        
        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        $data = [
            'news' => $model->getNews(),
            'title' => 'New Archive',
        ];

        // echo "<pre>";
        // print_r($data);
        // echo "</pre>";

        return view('templates/header', $data)
            . view('news/index')
            . view('templates/footer');
    }

    public function show($slug = null)
    {
        #return("<h1> New Controler News->show(\$slag)</h1>");
        $model = model(NewsModel::class);

        $data['news'] = $model->getNews($slug);

        if (empty($data['news'])) {
            throw new PageNotFoundException('Can not find the new item: '. $slag);
        }

        $data['title'] = $data['news']['title'];

        // echo("<pre>");
        // print_r($data);
        // echo("</pre>");

        return view('templates/header', $data)
            . view('news/view')
            . view('templates/footer');
    }

    public function new()
    {
        helper('form');

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/create')
            . view('templates/footer');
    }

    public function create()
    {
        helper('form');

        // Checks whether the submitted data passed the validation rules.
        if (! $this->validate([
            'title' => 'required|max_length[255]|min_length[3]',
            'body'  => 'required|max_length[5000]|min_length[10]',
        ])) {
            // The validation fails, so returns the form.
            return $this->new();
        }

        // Gets the validated data.
        $post = $this->validator->getValidated();

        $model = model(NewsModel::class);

        $model->save([
            'title' => $post['title'],
            'slug'  => url_title($post['title'], '-', true),
            'body'  => $post['body'],
        ]);

        return view('templates/header', ['title' => 'Create a news item'])
            . view('news/success')
            . view('templates/footer');
    }
}