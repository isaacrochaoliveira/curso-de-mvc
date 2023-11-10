<?php 

use \App\Controller\Admin\Login;
use \App\Controller\Admin\Home;
use App\Http\Response;

// Rota Login
$obRouter->get('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, Login::getLogin($request));
    }
]);

// Rota Login (POST)
$obRouter->post('/admin/login', [
    'middlewares' => [
        'required-admin-logout'
    ],
    function($request) {
        return new Response(200, Login::setLogin($request));
    }
]);

// Rota Login (LOGOUT)
$obRouter->get('/admin/logout', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function($request) {
        return new Response(200, Login::getLogout($request));
    }
]);