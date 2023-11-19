<?php

namespace App\Model\Entity;
use \WilliamCosta\DatabaseManager\Database;

class Testimony
{
    /**
     * Id do Depoimento
     * @var integer
     */
    public $id;

    /**
     * Nome do Usuário que fez o depoimentos
     * @var string
     */
    public $nome;

    /**
     * Mensagem do Depoimentos
     * @var string
     */
    public $mensagem;

    /**
     * Data de publicação do depoimentos
     * @var string
     */
    public $data;


    /**
     * Método Responsável por cadastrar a instância atual no banco de dados
     * @return boolean
     */
    public function cadastrar() {
        date_default_timezone_set('America/Sao_Paulo');
        $this->data = Date('Y-m-d H:i:s');

        // Inserir o Depoimento no Bandos de Dados
        $this->id = (new Database('depoimentos'))->insert([
            'nome' => $this->nome,
            'mensagem' => $this->mensagem,
            'data' => $this->data
        ]);

        return true;
    }

    /**
     * Método Responsável por retornar depoimentos
     * @param string
     * @param string
     * @param string
     * @param string
     * @return PDOStatement
     */
    public static function getTestimonies($where = null, $order = null, $limit = null, $fields = '*') {
        return (new Database('depoimentos'))->select($where, $order, $limit, $fields);
    }

    /**
     * Método Responsável por retornar um depoimento com base no seu Id
     * @param integer $id
     * @return Testimony
     */
    public static function getTestimoniesById($id) {
        return self::getTestimonies('id = ' . $id)->fetchObject(self::class);
    }
}
