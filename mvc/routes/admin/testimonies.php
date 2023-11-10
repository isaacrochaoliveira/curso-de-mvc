<?php 

use \App\Http\Response;
use \App\Controller\Admin;

//Rota de Listagem de Depoimentos
$obRouter->get('/admin/testimonies', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function($request) {
        return new Response(200, Admin\Testimony::getTestimonies($request));
    }
]);