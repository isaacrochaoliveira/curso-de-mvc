<?php 

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;

class Login extends Page {
    /**
     * Método Responsável por retornar a renderização da página de Login
     * @param Request
     * @return string
     */
    public static function getLogin($request) {
        // O Conteúdo da página de Login
        $content = View::render('admin/login', []);

        // Retorna a página completo
        return parent::getPage('Login > IsDEV', $content);
    }
}