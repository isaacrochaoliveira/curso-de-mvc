<?php 

namespace App\Controller\Pages;

use \App\Utils\View;

class Home {
    /**
     * Responsável por retornar o conteúdo da nossa home (view)
     * @return string
     */
    public static function getHome() {
        return View::render("pages/home");
    }
}