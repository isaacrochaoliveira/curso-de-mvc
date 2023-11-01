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
}

?>