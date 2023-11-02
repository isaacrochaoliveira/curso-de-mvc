<?php 
require(__DIR__ . "/vendor/autoload.php");


use \App\Http\Router;
use \App\Utils\View;

define('URL', 'http://localhost/learn/curso-de-mvc/mvc');

// Define o valor padrão das variáveis
View::init([
    'URL' => URL
]);

//Inicia o Roteador
$obRouter = new Router(URL);

//INCLUI AS ROTAS DE PÁGINAS
include(__DIR__ . '/routes/pages.php');

//Imprimi o Response da Rota
$obRouter->run()->sendResponse();

?>