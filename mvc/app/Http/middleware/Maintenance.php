<?php 

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;

class Maintenance {

    /**
     * Método Responsável por executar o middleware
     * @param Request
     * @param Closure
     * @return Response
     */
    public function handle($request, \Closure $next) {
        //Verifica o Estamo de Manutençãoi da Página
        if (getenv("MAINTENANCE") == 'true') {
            throw new \Exception('Página em Manutenção. Tente novamente mais tarde', 200);
        }

        // Executa a próximo nível do middlware
        return $next($request);
    }

}