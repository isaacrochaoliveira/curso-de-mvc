<?php 

use \App\Http\Response;
use \App\Controller\Admin;

//Rota Admin
$obRouter->get('/admin', [
    function() {
        return new Response(200, 'admin :)');
    }
]);

// Rota Login
$obRouter->get('/admin/login', [
    function($request) {
        return new Response(200, Admin\Login::getLogin($request));
    }
]);