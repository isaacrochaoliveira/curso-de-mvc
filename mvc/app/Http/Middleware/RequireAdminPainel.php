<?php 

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;

use App\Session\Admin\Login as SessionAdminLogin;

class RequireAdminPainel {

    /**
     * Método Responsável por verificar se ele está apto a acessar o painel
     * @param Request
     * @param Closure
     * @return Response
     */
    public function handle($request, \Closure $next) {
        if (!SessionAdminLogin::isLogged()) {
            return $request->getRoute()->redirect('/admin/login');
        }
        return $next($request);
    }
}