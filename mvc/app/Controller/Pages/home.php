<?php 

namespace App\Controller\Pages;

use \App\Controller\Pages\Page;
use \App\Utils\View;

class Home extends Page{
    /**
     * Responsável por retornar o conteúdo da nossa home (view)
     * @return string
     */
    public static function getHome() {
        // View Da Home
        $content =  View::render("pages/home", [
            "name" => "IDEV",
            "description" => "Fala Negão!",
            "param" => "Lorem, ipsum dolor sit amet consectetur adipisicing elit. Nobis hic placeat accusantium nemo, sequi praesentium vero dolores eius modi nihil quasi alias culpa error ducimus id molestiae odio quo eaque!"
        ]);

        return parent::getPage("Welcome", $content);
    }
}