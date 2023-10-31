<?php 

namespace App\Controller\Pages;

use \App\Utils\View;

class Page {
    /**
     * Método Responsável por renderizar o topo da página
     * @return string
     */
    private static function getHeader() {
        return View::render("pages/header");
    }

    /**
     * Método Responsavel por retornar o conteúdo da nossa página genérica
     * @return string
     */
    public static function getPage($title, $content) {
         return View::render("pages/page", 
         ["title"=> $title, "header" => self::getHeader(), "content"=> $content]);
    }
}

