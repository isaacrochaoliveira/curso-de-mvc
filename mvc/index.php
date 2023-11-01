<?php 
require(__DIR__ . "/vendor/autoload.php");

use \App\Controller\Pages\Home;


$obRequest = new \App\Http\Request();
var_dump($obRequest);

exit();

echo Home::getHome();

?>