<?php 

namespace App\Session\Admin;

use App\Model\Entity\User;

class Login {

    /**
     * Método Responsável por inicar a Sessão
     */
    private static function init() {
        //Verifica se a sessão não está ativa
        if (session_status() != PHP_SESSION_ACTIVE) {
            session_start();
        }
    }

    /**
     * Método responsável por criar o login do usuário
     * @param User
     * @return boolean
     */
    public static function login($obUser) {
        // INICA A SESSÃO
        self::init();

        $_SESSION['admin']['usuario'] = [
            'id' => $obUser->id,
            'nome' => $obUser->nome,
            'email' => $obUser->email
        ];

        //Sucesso
        return true;
    }

    /**
     * Método Responsável por verificar se o usuario está logado
     * @return boolean
     */
    public static function isLogged() {
        self::init();

        //Retornar a Verificação
        return isset($_SESSION['admin']['usuario']['id']);
    }
}