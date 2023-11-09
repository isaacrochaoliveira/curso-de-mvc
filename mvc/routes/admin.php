<?php 

use \App\Http\Response;
use \App\Controller\Admin;

//Rota Admin
$obRouter->get('/admin', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function() {
        return new Response(200, 'admin :)');
    }
]);

// Rota Login
$obRouter->get('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);

// Rota Login (POST)
$obRouter->post('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, Admin\Login::setLogin($request));
    }
]);

// Rota Login (LOGOUT)
$obRouter->get('/admin/logout', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function($request) {
        return new Response(200, Admin\Login::getLogout($request));
    }
]);