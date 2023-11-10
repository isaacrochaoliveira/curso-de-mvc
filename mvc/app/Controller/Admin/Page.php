<?php

namespace App\Controller\Admin;

use App\Http\Request;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;

class Page
{

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
            'label' => 'Depoimentos',
            'link' => URL . '/admin/testimonies'
        ],
        'users' => [
            'label' => 'Usuários',
            'link' => URL . '/admin/users'
        ]
    ];

    /**
     * Método Responsável por retornar o conteúdo da estrutura generica do ppainel
     * @param string
     * @param string
     * @return string
     */
    public static function getPage($title, $content)
    {
        return View::render(
            "admin/page",
            [
                "title" => $title,
                "content" => $content
            ]
        );
    }

    /**
     * Método Responsável por renderizare a view do menu do painel
     * @param string
     * @return string
     */
    private static function getMenu($currentModule)
    {
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
    public static function getPanel($title, $content, $currentModule)
    {
        //Renderiza a view do pianel
        $conetentPanel = View::render("admin/panel", [
            'menu' => self::getMenu($currentModule),
            'content' => $content
        ]);

        // Retorna a página Renderizada
        return self::getPage($title, $conetentPanel);
    }

    /**
     * Método Responsável por Renderizar o layout de paginação
     * @param Request
     * @param Pagination
     * @return string
     */
    public static function getPagination($request, $obPagination)
    {
        // Páginas
        $pages = $obPagination->getPages();

        // Veirifica aquantidade de páginas
        if (count($pages) <= 1) {
            return '';
        }

        //LINKS
        $links = '';

        //Obter a URL atual do projeto sem GETS
        $url = $request->getRoute()->getCurrentUrl();

        // GET
        $queryParams = $request->getQueryParams();

        //Renderiza os links
        foreach ($pages as $page) {
            // Altera a página
            $queryParams['page'] = $page['page'];

            //LINK
            $link = $url . '?' . http_build_query($queryParams);

            // VIEW
            $links .= View::render("admin/pagination/link", [
                "page" => $page['page'],
                "link" => $link,
                'active' => $page['current'] ? 'active' : ''
            ]);
        }

        // Renderiza BOX de Paginação
        return View::render(
            "admin/pagination/box",
            ["links" => $links]
        );
    }
}
