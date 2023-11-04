<?php 

namespace App\Http\Middleware;

use App\Http\Request;
use App\Http\Response;

class Maintenance {

    /**
     * Método Responsável por executar o middleware
     * @param Request
     * @param Closure
     * @param Response
     * @return
     */
    public function handle($request, \Closure $next) {
        var_dump($request);
        exit();
    }

}