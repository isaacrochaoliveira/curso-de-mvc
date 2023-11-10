<?php 

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;

class Home extends Page {
    
    /**
     * Método Responsável por renderizar o painel dashboard
     * @param Request
     * @return string
     */
    public static function getHome($request) {
        $content = View::render('admin/modules/home/index', []);

        return parent::getPanel('Home > IsDev', $content, 'home');
    }
}