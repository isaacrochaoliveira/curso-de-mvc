<?php

use App\Controller\Admin\Home;
use \App\Http\Response;


//Rota Admin
$obRouter->get('/admin', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function($request) {
        return new Response(200, Home::getHome($request));
    }
]);