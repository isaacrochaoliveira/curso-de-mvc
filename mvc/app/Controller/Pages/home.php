<?php 

namespace App\Controller\Pages;

use \App\Controller\Pages\Page;
use \App\Model\Entity\Organization;
use \App\Utils\View;

class Home extends Page{
    /**
     * Responsável por retornar o conteúdo da nossa home (view)
     * @return string
     */
    public static function getHome() {
        $objectOrganization = new Organization;

        // View Da Home
        $content =  View::render("pages/home", [
            "name" => $objectOrganization->name,
            "description" => $objectOrganization->desc,
            "param" => $objectOrganization->site
        ]);

        return parent::getPage("Welcome", $content);
    }
}