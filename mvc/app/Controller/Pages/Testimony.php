<?php 

namespace App\Controller\Pages;

use \App\Controller\Pages\Page;
use \App\Model\Entity\Organization;
use \App\Model\Entity\Testimony as EntityTestimony;
use \App\Utils\View;
use \WilliamCosta\DatabaseManager\Pagination;

class Testimony extends Page{

    /**
     * Método Responsável por obter a renderização dos items de depoimentos para a página
     * @return string
     * @param Request
     * @param string
     */
    private static function getTestimonyItems($request, &$obPagination) {
        // Depoimentos
        $itens = '';

        // Definir a quantidade total de registro
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        // Página Atutal
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1; 

        //Instância de Páginação
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 3);

        // Resultados da Página 
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        //Rederiza o Item
        while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
            $itens .=  View::render("pages/testimony/item", [
                'nome' => $obTestimony->nome,
                'mensagem' => $obTestimony->mensagem,
                'data' => Date('d/m/Y H:i:s', strtotime($obTestimony->data))
            ]);
        }

        // Retorna os Depoimentos
        return $itens;
    }

    /**
     * Responsável por retornar o conteúdo da nossa home (view)
     * @param Request
     * @return string
     */
    public static function getTestimonies($request) {
        $objectOrganization = new Organization;

        // View Da Depoimentos
        $content =  View::render("pages/testimonies", [
            'itens' => self::getTestimonyItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        return parent::getPage("Depoimentos > IsDEV", $content);
    }

    /**
     * Método Responsável por cadastrar um depoimento
     * @param Request
     * @return string
     */
    public static function insertTestimony($request) {
        // Dados do POST
        $postVars = $request->getPostVars();

        // Nova Instância de Depoimento
        $obTestimony = new EntityTestimony();
        $obTestimony->nome = $postVars['nome'];
        $obTestimony->mensagem = $postVars['mensagem'];
        
        $obTestimony->cadastrar();

        //Retorna a Página de Listagem de depoimentos
        return self::getTestimonies($request);
    }
}