<?php 
include(__DIR__."/includes/app.php");

use \App\Http\Router;

//Inicia o Roteador
$obRouter = new Router(URL);

//INCLUI AS ROTAS DE PÁGINAS
include(__DIR__ . '/routes/pages.php');

//Inclui as rotas do Painel
include(__DIR__.'/routes/admin.php');

//Imprimi o Response da Rota
$obRouter->run()->sendResponse();

?>