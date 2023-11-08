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
        echo "<pre>";
        print_r($request);
        echo "</pre>";
    }

}