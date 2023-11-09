<?php

namespace App\Model\Entity;

use \WilliamCosta\DatabaseManager\Database;

class User {
    /**
     * ID do usuário
     * @var integer
     */
    public $id;

    /**
     * Nome do Usuário
     * @var string
     */
    public $nome;

    /**
     * Email do Usuário
     * @var string
     */
    public $email;

    /**
     * Senha do Usuário
     * @var string
     */
    public $password;

    /**
     * Método Responsável por retornar um usuário com base em seu email
     * @param string
     * @return User
     */
    public static function getUserByEmail($email) {
        return (new Database("usuario"))->select("email = '$email'")->fetchObject(self::class);
    }
}
