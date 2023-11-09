<?php 

namespace App\Controller\Admin;

use App\Http\Request;
use App\Model\Entity\User;
use App\Utils\View;
use \App\Session\Admin\Login as SessionAdminLogin;

class Login extends Page {
    /**
     * Método Responsável por retornar a renderização da página de Login
     * @param Request
     * @param string
     * @return string
     */
    public static function getLogin($request, $errorMenssage = null) {
        //STATUS
        $status = !is_null($errorMenssage) ? View::render("admin/login/status", [
            'mensagem' => $errorMenssage
        ]) : '';

        // O Conteúdo da página de Login
        $content = View::render('admin/login', [
            'status' => $status
        ]);

        // Retorna a página completo
        return parent::getPage('Login > IsDEV', $content);
    }

    /**
     * Método Responsável por definir o login do usuario
     * @param Request
     */
    public static function setLogin($request) {
        // POST VARS
        $postVars = $request->getPostVars();


        $email = $postVars['email'] ?? '';
        $password = $postVars['senha'] ?? '';

        if (!($email == "")) {
            if (!(filter_var($email, FILTER_VALIDATE_EMAIL))) {
                return self::getLogin($request, 'E-mail Não Válido!');
            }
        }

        //Busca usuário pelo E-mail
        $obUser = User::getUserByEmail($email);
        if (!$obUser instanceof User) {
            return self::getLogin($request, 'Email Incorreto!');
        }

        //Verifica a senha do Usuário
        if (!(password_verify($password, $obUser->senha))) {
            return self::getLogin($request, 'Senha Incorreta! Tente Novamente mais tarde!');
        }

        //Criar Session Login
        SessionAdminLogin::login($obUser);

        //Redireciona o usuário para a HOME DO ADMIN
        $request->getRoute()->redirect('/admin');
    }

    /**
     * Método Responsável por deslogar o usuario
     * @param Request
     */
    public static function getLogout($request) {
        //Destroi a Session Está Ativada
        SessionAdminLogin::logout();

        // Redireciona para tela de login
        $request->getRoute()->redirect('/admin/login');
    }
}