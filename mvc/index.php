<?php 
require(__DIR__ . "/vendor/autoload.php");


use \App\Http\Router;
use \App\Http\Response;
use \App\Controller\Pages\Home;

define('URL', 'http://localhost/learn/curso-de-mvc/mvc');

$obRouter = new Router(URL);

//INCLUI AS ROTAS DE PÁGINAS
include(__DIR__ . '/routes/pages.php');

//Imprimi o Response da Rota
$obRouter->run()->sendResponse();

?>