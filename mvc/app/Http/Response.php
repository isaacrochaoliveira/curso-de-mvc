<?php 

namespace App\Http;

class Response {
    /**
     * Código do Status HTTP
     * @var integer
     */
    private $httpCode = 200;

    /**
     * Cabeçalho do Response
     * @var array
     */
    private $header = [];

    /**
     * Tipo Conteúdo que está sendo retornado
     * @var string;
     */
    private $contentType = 'text/html';

    /**
     * Conteúdo do Response
     * @var mixed
     */
    private $content;

    /**
     * Método Responsável por iniciar a classe e defiinir os valores
     * @param integer
     * @param mixed
     * @param string
     */
    public function __construct($httpCode, $content, $contentType = 'text/html') {
        $this->httpCode = $httpCode;
        $this->content = $content; 
        $this->setContentType($contentType);
    }

    /**
     * Método Responsável por alterar o ContentType do Response
     * @param string
     */
    public function setContentType($contentType) {
        $this->contentType = $contentType;
        $this->addHeader('ContentType', $contentType);
    }

    /**
     * Método Responsável pro adicionar um registro no cabeçalho de response
     * @param string 
     * @param string
     */
    public function addHeader($key, $value) {
        $this->header[$key] = $value;
    }

    /**
     * Método Responsável por enviar os headers para o browser
     */
    private function sendHeaders() {
        // Defina Status
        http_response_code($this->httpCode);

        //Enviar todos os Headers
        foreach ($this->header as $key => $value) {
            header($key .': '. $value);
        }
    }

    /**
     * Método responsável por enviar a resposta por usuario
     */
    public function sendResponse() {
        // Enviar os Headers
        $this->sendHeaders();

        //Imprime o conteúdo
        switch ($this->contentType) {
            case 'text/html':
                echo $this->content;
                exit();
        }
    }
}

?>