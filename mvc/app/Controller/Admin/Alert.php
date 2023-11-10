<?php 

namespace App\Controller\Admin;

use \App\Utils\View;

class Alert {
    /**
     * Método Responsável por retornar uma msg de sucesso
     * @param string
     * @return string
     */
    public static function getSuccess($mensagem) {
        return View::render('admin/alert/status',[
            'tipo' => 'success',
            'mensagem' => $mensagem
        ]);
    }

    /**
     * Método Responsável por retornar uma msg de erro
     * @param string
     * @return string
     */
    public static function getError($mensagem) {
        return View::render('admin/alert/status', [
            'tipo' => 'danger',
            'mensagem' => $mensagem
        ]);
    }
}