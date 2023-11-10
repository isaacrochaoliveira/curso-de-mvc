<?php 

namespace App\Controller\Admin;

use App\Utils\View;

class Page {

    /**
     * Modulos Disponíveis no painel
     * @var array
     */
    private static $modules = [
        'home' => [
            'label' => 'Home',
            'link' => URL . '/admin'
        ],
        'testimonies' => [
            'label' => 'Depoímentos',
            'link'=> URL .'/admin/testimonies'
        ],
        'users' => [
            'label' => 'Usuarios',
            'link' => URL .'/admin/users'
        ]
    ];

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

    /**
     * Método Responsável por renderizare a view do menu do painel
     * @param string
     * @return string
     */
    private static function getMenu($currentModule) {
        // LINK DO MENU
        $links = '';

        // ITERA O MODULOS
        foreach (self::$modules as $hash => $module) {
            $links .= View::render('admin/menu/link', [
                'label' => $module['label'],
                'link' => $module['link'],
                'current' => $hash == $currentModule ? 'text-danger' : ''
            ]);
        }

        // Retorna a Renderiza do Menu
        return View::render("admin/menu/box", [
            'links' => $links
        ]);
    }

    /**
     * Método Responsável por Redenrizar a View do Painel com conteúdos dinâmicos
     * @param string
     * @param string
     * @param string
     * @return string
     */
    public static function getPanel($title, $content, $currentModule) {
        //Renderiza a view do pianel
        $conetentPanel = View::render("admin/panel", [
            'menu' => self::getMenu($currentModule),
            'content' => $content
        ]);
        
        // Retorna a página Renderizada
        return self::getPage($title, $conetentPanel);
    }
}