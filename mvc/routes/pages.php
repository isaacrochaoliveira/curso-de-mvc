<?php 

use \App\Http\Response;
use \App\Controller\Pages;

//Rota Home
$obRouter->get('/', [
    function() {
        return new Response(200, Pages\Home::getHome());
    }
]);

//Rota Sobre
$obRouter->get('/sobre', [
    function() {
        return new Response(200, Pages\About::getAbout());
    }
]);

//Rota de Depoimentos
$obRouter->get('/depoimentos', [
    function($request) {
        return new Response(200, Pages\Testimony::getTestimonies($request));
    }
]);

// Rota de Depoimentos (INSERT)
$obRouter->post('/depoimentos', [
    function($request) {
        return new Response(200, Pages\Testimony::insertTestimony($request));
    }
]);

