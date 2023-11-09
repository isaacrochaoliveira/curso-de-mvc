<?php 

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;
use App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminLogout {

    /**
     * Método Responsável por executar o middleware
     * @param Request
     * @param Closure
     * @return Response
     */
    public function handle($request, \Closure $next) {
        // Verifica se o usuario está logado
        if (SessionAdminLogin::isLogged()) {
            $request->getRoute()->redirect('/admin');
        }

        //Continua a conexão
        return $next($request);
    }
}