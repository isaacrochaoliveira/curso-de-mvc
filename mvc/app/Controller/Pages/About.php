<?php 

namespace App\Controller\Pages;

use \App\Controller\Pages\Page;
use \App\Model\Entity\Organization;
use \App\Utils\View;

class About extends Page{
    /**
     * Responsável por retornar o conteúdo da nossa home (view)
     * @return string
     */
    public static function getHome() {
        $objectOrganization = new Organization;

        // View Da Home
        $content =  View::render("pages/about", [
            "name" => $objectOrganization->name
        ]);

        return parent::getPage("Sobre > IsDEV", $content);
    }
}