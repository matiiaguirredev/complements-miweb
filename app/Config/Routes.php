<?php

use CodeIgniter\Router\RouteCollection;

/**
 * @var RouteCollection $routes
 */
$routes->get('/', 'Web::index');
$routes->post('/', 'Web::index');
$routes->match(['get', 'post'], 'single-blog/(:segment)', 'Web::single_blog/$1');
$routes->get('pages-404', 'Web::pages_404');


// rutas administrador

$routes->group('admin', function ($routes) {

    $routes->get('pages-404', 'Admin::pages_404');
    $routes->get('pages-500', 'Admin::pages_500');
    $routes->match(['get', 'post'], 'login', 'Admin::login');
    $routes->match(['get', 'post'], 'logout', 'Admin::logout');
    $routes->match(['get', 'post'], 'register', 'Admin::register');
    $routes->match(['get', 'post'], 'recover', 'Admin::recover');
    $routes->match(['get', 'post'], 'perfil', 'Admin::perfil');
    $routes->match(['get', 'post'], 'delete/img', 'Api::delete_img');


    $routes->get('tables-basic', 'Admin::tables_basic');
    $routes->get('tables-datatables', 'Admin::tables_datatables');
    $routes->get('forms-advanced', 'Admin::forms_advanced');
    $routes->get('forms-elements', 'Admin::forms_elements');
    $routes->get('forms-file-uploads', 'Admin::forms_file_uploads');
    $routes->get('forms-quilljs', 'Admin::forms_quilljs');
    $routes->get('components-sweet-alert', 'Admin::components_sweet_alert');
    $routes->get('/', 'Admin::index');

    $entitySegments = [
        'proyect',
        'usuarios',
        'roles',
        'categorias',

        
    ];
    foreach ($entitySegments as $entitySegment) {

        // CRUD - Read All
        $routes->match(['get', 'post'], $entitySegment, "Admin::get_" . $entitySegment);
        // CRUD - Read Single
        $routes->match(['get', 'post'], $entitySegment . '/(:segment)', "Admin::get_" . $entitySegment . "/$1");

        // Grupos CRUD - Create
        $routes->match(['get', 'post'], 'create/' . $entitySegment, "Admin::create_" . $entitySegment);

        // Grupos CRUD - Update
        $routes->match(['get', 'post'], 'update/' . $entitySegment . '/(:segment)', "Admin::update_" . $entitySegment . "/$1");

        // Grupos CRUD - Delete
        $routes->match(['get', 'post'], 'delete/' . $entitySegment . '/(:segment)', "Admin::delete_" . $entitySegment . "/$1");
    }
});

$routes->group('api', function ($routes) {

        //metodos que acepta        //ruta(url navegador) //function(controlador)
    // $routes->match(['get', 'post'], 'index', 'Api::index');
    $routes->match(['get', 'post'], 'register', 'Api::register');
    $routes->match(['get', 'post'], 'login', 'Api::login');
    $routes->match(['get', 'post'], 'checktoken', 'Api::checktoken');
    $routes->match(['get', 'post'], 'mailing', 'Api::mailing');
    $routes->match(['get', 'post'], 'delete/img', 'Api::delete_img');
    $routes->match(['get', 'post'], 'delete/img/perfil', 'Api::delete_img_perfil');
    $routes->match(['get', 'post'], 'bgimg/(:segment)/(:segment)', 'Api::bgimg/$1/$2');
    $routes->get('/', 'Api::index');

    $entitySegments = [
        'proyect',
        'perfil',
        'usuarios',
        'roles',
        'categorias',


    ];

    foreach ($entitySegments as $entitySegment) {

        // CRUD - Read All
        $routes->match(['get', 'post'], $entitySegment, "Api::get_" . $entitySegment);
        // CRUD - Read Single
        $routes->match(['get', 'post'], $entitySegment . '/(:segment)', "Api::get_" . $entitySegment . "/$1");

        // Grupos CRUD - Create
        $routes->match(['get', 'post'], 'create/' . $entitySegment, "Api::create_" . $entitySegment);

        // Grupos CRUD - Update
        $routes->match(['get', 'post'], 'update/' . $entitySegment . '/(:segment)', "Api::update_" . $entitySegment . "/$1");

        // Grupos CRUD - Delete
        $routes->match(['get', 'post'], 'delete/' . $entitySegment . '/(:segment)', "Api::delete_" . $entitySegment . "/$1");
    }
});