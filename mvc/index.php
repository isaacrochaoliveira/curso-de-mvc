<?php 
require(__DIR__ . "/vendor/autoload.php");


use \App\Controller\Pages\Home;
use \App\Http\Router;
use \App\Http\Response;

define('URL', 'http://localhost/learn/curso-de-mvc/mvc');

$obRouter = new Router(URL);

//Rota Home
$obRouter->get('/', [
    function() {
        return new Response(200, Home::getHome());
    }
]);

// Imprimi o Response da Rota
$obRouter->run()->sendResponse();

?>