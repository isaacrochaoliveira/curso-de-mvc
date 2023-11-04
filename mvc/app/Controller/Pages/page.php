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
     * Método Responsável por renderizar o rodapé da página
     * @return string
     */
    private static function getFooter() {
        return View::render("pages/footer");
    }

    /**
     * Método Responsável por Renderizar o layout de paginação
     * @param Request
     * @param Pagination
     * @return string
     */
    public static function getPagination($request, $obPagination) {
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

        //Renderiza os LInks
        foreach ($pages as $page) {
            // Altera a página
            $queryParams['page'] = $page['page'];

            //LINK
            $link = $url.'?'.http_build_query($queryParams);

            // VIEW
            $link .= View::render("pages/pagination/link", 
            ["page"=> $page['page'], "link" => $link]);

        }

        // Renderiza BOX de Paginação
        return View::render("pages/pagination/box", 
        ["links" => $link]);
    }

    /**
     * Método Responsavel por retornar o conteúdo da nossa página genérica
     * @return string
     */
    public static function getPage($title, $content) {
         return View::render("pages/page", 
         ["title"=> $title, "header" => self::getHeader(), "content"=> $content, "footer" => self::getFooter()]);
    }
}

