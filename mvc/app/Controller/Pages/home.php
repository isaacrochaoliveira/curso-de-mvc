<?php 

namespace App\Controller\Pages;

class Home {
    /**
     * Responsável por retornar o conteúdo da nossa home (view)
     * @return string
     */
    public static function getHome() {
        return "Olá, Mundo!";
    }
}