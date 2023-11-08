<?php 

namespace App\Controller\Admin;

use App\Utils\View;

class Page {

    /**
     * Método Responsável por retornar o conteúdo da estrutura generica do ppainel
     * @param string
     * @param string
     * @return string
     */
    public static function getPage($title, $content) {
        return View::render("admin/page", 
        [
            "title"=> $title,
            "content"=> $content
        ]);
    }
}