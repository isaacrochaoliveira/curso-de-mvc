<?php 

namespace APP\Http\middleware;

use App\Http\Request;
use App\Http\Response;

class Queue {
    /**
     * Fila de Middlawares a seres executados
     * @var array
     */
    private $middlewares = [];

    /**
     * Função de Execução do Controlador
     * @var Closure
     */
    private $controller;

    /**
     * Argumentos da função do controlador
     * @var array
     */
    private $controllerArgs = [];

    /**
     * Método Responsável por contruir a classe  de fila de Middlawares
     * @param array
     * @param Closure
     * @param array
     */
    public function __construct($middlewares, $controller, $controllerArgs) {
        $this->middlewares = $middlewares;
        $this->controller = $controller;
        $this->controllerArgs = $controllerArgs;
    }

    /** 
     * Método Responsável por executar o próximo nível da fila de middlewares
     * @param Request
     * @return Response
    */
    public function next($request) {
        var_dump($this);
        exit();
    }
}