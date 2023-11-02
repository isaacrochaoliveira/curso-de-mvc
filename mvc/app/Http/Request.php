<?php 

namespace App\Http;

class Request {
    /**
     * Método HTTP da requisição
     * @var string
     */
    private $httpMethod;
    /**
     * URI da página
     * @var string
     */
    private $uri;
    /**
     * Parametros da URL
     * @var array
     */
    private $queryParams = [];
    /**
     * Variáveis recebidas no post da páginas
     * @var array;
     */
    private $postVars = [];
    /**
     * Cabeçalho da Requisição
     * @var string;
     */
    private $headers = [];

    public function __construct() {
        $this->queryParams = $_GET ?? [];
        $this->postVars = $_POST ?? [];
        $this->headers = getallheaders() ?? [];
        $this->httpMethod = $_SERVER["REQUEST_METHOD"] ?? "";
        $this->uri = $_SERVER["REQUEST_URI"] ?? "";
    }

    /**
     * Método Responsável por retornar o método HTTP da requisição
     * @return string
     */
    public function getHttpMethod() {
        return $this->httpMethod;
    }

    /**
     * Método Responsável por retornar o método da requisição
     * @return string;
     */
    public function getUri() {
        return $this->uri;
    }

    /**
     * Método Responsável por retornar os headers da requisição
     * @return array;
     */
    public function getHeaders() {
        return $this->headers;
    }

    /**
     * Método Responsável por retornar os parâmetros da URL da requisição
     * @return array
     */
    public function getQueryParams() {
        return $this->queryParams;
    }

    /**
     * Método Responsável por retornar as variáveis POST da requisição
     * @return array;
     */
    public function getPostVars() {
        return $this->postVars;
    }
    
}

?>