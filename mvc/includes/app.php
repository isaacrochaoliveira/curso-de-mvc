<?php 



require(__DIR__ . "/../vendor/autoload.php");


use \App\Utils\View;
use \WilliamCosta\DotEnv\Environment;
use \WilliamCosta\DatabaseManager\Database;

//Carrega Variáveis de Ambiente
Environment::load(__DIR__."/../");

//Define as Configurações de Banco de Dados
Database::config(getenv('DB_HOST'), getenv('DB_NAME'), getenv('DB_USER'), getenv('DB_PASS'), getenv('DB_PASS'));

//Define a Constante de URL
define('URL', getenv('URL'));

// Define o valor padrão das variáveis
View::init([
    'URL' => URL
]);
