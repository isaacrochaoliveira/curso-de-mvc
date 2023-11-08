<?php 

namespace APP\Http\Middleware;

use App\Http\Request;
use App\Http\Response;

class Queue {

    /**
     * Mapeamento de Middlewares
     * @var array
     */
    private static $map = [];

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
     * Método Responsável por definir o mapeamento de middlewares
     * @param array
     */
    public static function setMap($map) {
        self::$map = $map;
    }
    
    /** 
     * Método Responsável por executar o próximo nível da fila de middlewares
     * @param Request
     * @return Response
    */
    public function next($request) {
        // Verifica se a fila está vazia
        if (empty($this->middlewares)) {
            return call_user_func_array($this->controller, $this->controllerArgs);
        }

        $middleware = array_shift($this->middlewares);

        // Verifica o mapeamento
        if (!isset(self::$map[$middleware])) {
            throw new \Exception("Problemas ao processar o middlware da Requisição", 500);
        }

        //NEXT
        $queue = $this;
        $next = function($request) use($queue) {
            return $queue->next($request);
        };

        echo "<pre>";
        print_r($next);
        echo "</pre>";

    }
}