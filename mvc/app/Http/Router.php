<?php 

namespace App\Http;

use \Closure;
use Exception;

class Router {
    /**
     * Url Completa do Projeto (raiz)
     * @var string
     */
    private $url = '';

    /**
     * Prefixo de todas as rotas
     * @var string
     */
    private $prefix = '';

    /**
     * Índice de rotas
     * @var array
     */
    private $routes = [];

    /**
     * Intância de Request
     * @var Request
     */
    private $request;

    /**
     * Método Responsável por iniciar a classe
     * @param string
     */
    public function __construct($url) {
        $this->request = new Request();

        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Método Responsável por definir os prefixo das rotas
     */
    private function setPrefix() {
        //Informações da URL atual
        $parseUrl = parse_url($this->url);

        //Define o Prefixo
        $this->prefix = $parseUrl['path'] ?? '';
    } 

    /**
     * Método Responsável por adicionar uma rota na classe
     * @param string
     * @param string
     * @param array
     */
    private function addRoute($method, $route, $params = []) {
        //Validação dos parâmetros
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $param['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Padrão de Validação da URL
        $patternRoute = '/^'. str_replace('/', '\/', $route).'$/';
        
        //ADD a rota dentro da classe

        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Método Responsável por Retornar a Uri desconsiderando o prefixo
     * @return string
     */
    private function getUri() {
        // URI da Request
        $uri = $this->request->getUri();

        var_dump($uri);
    }

    /**
     * Método Responsável por retornar os dados da rota atual
     * @return array
     */
    private function getRoute() {
        // URI
        $uri = $this->getUri();
    }

    /**
     * Método Responsável por executar a rota atual
     * @return Response
     */
    public function run() {
        try {
            // Obtem a Rota atual
            $route = $this->getRoute();

        } catch (Exception $e) {
            return new Response($e->getCode(),$e->getMessage());
        }
    }

    /**
     * Método Responsável por definir uma rota de GET
     * @param string
     * @param array
     */
    public function get($route, $params = []) {
        return $this->addRoute('GET', $route, $params);
    }
}