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

// Rota de Cadastro de um novo depoimento
$obRouter->get('/admin/testimonies/new', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function($request) {
        return new Response(200, Admin\Testimony::getNewTestimony($request));
    }
]);

$obRouter->post('/admin/testimonies/new', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function($request) {
        return new Response(200, Admin\Testimony::setNewTestimony($request));
    }
]);

$obRouter->get('/admin/testimonies/{id}/edit', [
    'middlewares' => [
        'required-admin-painel'
    ],
    function ($request, $id) {
        return new Response(200, Admin\Testimony::getEditTestimony($request, $id));
    }
]);