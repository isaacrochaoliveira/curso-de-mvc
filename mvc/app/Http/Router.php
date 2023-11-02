<?php

namespace App\Http;

use \Closure;
use Exception;

class Router
{
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
    public function __construct($url)
    {
        $this->request = new Request();

        $this->url = $url;
        $this->setPrefix();
    }

    /**
     * Método Responsável por definir os prefixo das rotas
     */
    private function setPrefix()
    {
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
    private function addRoute($method, $route, $params = [])
    {
        //Validação dos parâmetros
        foreach ($params as $key => $value) {
            if ($value instanceof Closure) {
                $param['controller'] = $value;
                unset($params[$key]);
                continue;
            }
        }

        //Padrão de Validação da URL
        $patternRoute = '/^' . str_replace('/', '\/', $route) . '$/';

        //ADD a rota dentro da classe

        $this->routes[$patternRoute][$method] = $params;
    }

    /**
     * Método Responsável por executar a rota atual
     * @return Response
     */
    public function run()
    {
        try {
            // Obtem a Rota atual
            $route = $this->getRoute();

            // Verifica o Controlador 
            if (!(isset($route['controller']))) {
                throw new Exception('URL não pôde ser processada', 500);
            }

            //Argumentos da função
            $args = [];

            // Retorna execução da função
            return call_user_func_array($route['controller'], $args);
        } catch (Exception $e) {
            return new Response($e->getCode(), $e->getMessage());
        }
    }

    /**
     * Método Responsável por definir uma rota de GET
     * @param string
     * @param array
     */
    public function get($route, $params = [])
    {
        return $this->addRoute('GET', $route, $params);
    }

    /**
     * Método Responsável por definir uma rota de POST
     * @param string
     * @param array
     */
    public function post($route, $params = []) {
        return $this->addRoute('POST', $route, $params);
    }

    /**
     * Método Responsável por definir uma rota de PUT
     * @param string
     * @param array
     */
    public function put($route, $params = []) {
        return $this->addRoute('PUT', $route, $params);
    }

    /**
     * Método Responsável por definir uma rota DELETE
     * @param string
     * @param array
     */
    public function delete($route, $params = []) {
        return $this->addRoute('DELETE', $route, $params);
    }

    /**
     * Método Responsável por Retornar a Uri desconsiderando o prefixo
     * 
     */
    private function getUri()
    {
        // URI da Request
        $uri = $this->request->getUri();


        //Fatia Uri com Prefixo
        $xUri = strlen($this->prefix) ? explode($this->prefix, $uri) : [$uri];

        // Retorn a Uri sem prefixo
        return end($xUri);
    }

    /**
     * Método Responsável por retornar os dados da rota atual
     *
     */
    private function getRoute()
    {
        // URI
        $uri = $this->getUri();

        // Method 
        $httpMethod = $this->request->getHttpMethod();

        // Valida Rotas
        foreach ($this->routes as $patternRoute => $methods) {
            // Verifica Se a URI bate o o padrão
            if (preg_match($patternRoute, $uri)) {
                // Verifica o método
                if ($methods[$httpMethod]) {
                    // Retorno das parâmetros da rota
                    return $methods[$httpMethod];
                } 

                // Método Não Permitido Definido
                throw new Exception('Método Não Permitido!', 405);
            }
        }
        // URL não encontrada
        throw new Exception('URL não encontrada', 404);
    }
}
