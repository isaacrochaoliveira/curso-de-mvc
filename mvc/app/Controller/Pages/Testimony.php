<?php 

namespace App\Controller\Pages;

use \App\Controller\Pages\Page;
use \App\Model\Entity\Organization;
use \App\Model\Entity\Testimony as EntityTestimony;
use \App\Utils\View;

class Testimony extends Page{

    /**
     * Método Responsável por obter a renderização dos items de depoimentos para a página
     * @return string
     */
    private static function getTestimonyItems() {
        // Depoimentos
        $itens = '';

        // Resultados da Página
        $results = EntityTestimony::getTestimonies(null, 'id DESC');

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
     * @return string
     */
    public static function getTestimonies() {
        $objectOrganization = new Organization;

        // View Da Depoimentos
        $content =  View::render("pages/testimonies", [
            'itens' => self::getTestimonyItems()
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
        return self::getTestimonies();
    }
}