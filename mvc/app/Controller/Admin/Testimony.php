<?php 

namespace App\Controller\Admin;

use App\Http\Request;
use App\Model\Entity\Organization;
use App\Utils\View;
use WilliamCosta\DatabaseManager\Pagination;
use \App\Model\Entity\Testimony as EntityTestimony;

class Testimony extends Page {

    /**
     * Método Responspavel por obter a renderização de depoimentos para renderização do siterns de depoimentos para a página
     * @param Request
     * @param string
     * @return string
     */
    private static function getTestimonyItems($request, &$obPagination) {
        // Depoimentos
        $itens = '';

        // Definir a quantidade total de registro
        $quantidadeTotal = EntityTestimony::getTestimonies(null, null, null, 'COUNT(*) as qtd')->fetchObject()->qtd;

        //Página Atual
        $queryParams = $request->getQueryParams();
        $paginaAtual = $queryParams['page'] ?? 1;

        //Instâcia de Páginação
        $obPagination = new Pagination($quantidadeTotal, $paginaAtual, 5);

        // Resultados da Páginas
        $results = EntityTestimony::getTestimonies(null, 'id DESC', $obPagination->getLimit());

        // Renderiza o Item
        while ($obTestimony = $results->fetchObject(EntityTestimony::class)) {
            $itens .= View::render('admin/modules/testimonies/item', [
                'id' => $obTestimony->id,
                'nome' => $obTestimony->nome,
                'texto' => $obTestimony->mensagem,
                'data' => Date('d/m/Y H:i:s', strtotime($obTestimony->data))
            ]);
        }

        // Retorna os depoimentos
        return $itens;
    }

    /**
     * Método Responsável por obter a página de depoimento
     * @param Request
     * @return string
     */
    public static function getTestimonies($request) {
        $content = View::render('admin/modules/testimonies/index', [
            'itens' => self::getTestimonyItems($request, $obPagination),
            'pagination' => parent::getPagination($request, $obPagination)
        ]);

        //Retorna a Página Completa
        return parent::getPanel('Depoimentos > IsDev', $content, 'testimonies');
    }

    /**
     * Método Responsável por retornar o formulário de cadastro de um novo depoimento
     * @param Request
     * @return string
     */
    public static function getNewTestimony($request) {
        // Conteúdo do Formalário
        $content = View::render('admin/modules/testimonies/form', [
            'title' => 'Cadastro de Depoimentos'
        ]);

        //Retorna a Página Completa
        return parent::getPanel('Cadastrar > IsDev', $content, 'testimonies');
    }

    /**
     * Métpdp Responsável por inserir comentários no banco de dados
     * @param Request
     * @return string
     */
    public static function setNewTestimony($request) {
        //POST VARS
        $postVars = $request->getPostVars();

        
        // Nova Instância
        $obTestimony = new EntityTestimony;
        $obTestimony->nome = $postVars['nome'] ?? '';
        $obTestimony->mensagem = $postVars['mensagem'] ?? '';
        $obTestimony->cadastrar();

        //Redireciona o Usuário
        $request->getRoute()->redirect('/admin/testimoies/'.$obTestimony->id.'/edit?status=created');
    }

    /**
     * Método Responsável por retornar o formulário de edição de um depoimento
     * @param Request $request
     * @param integer $id
     * @return string
     */
    public static function getEditTestimony($request, $id) {
        //Obtem o depoimento do banco de dados
        $obTestimony = EntityTestimony::getTestimoniesById($id);    

        var_dump($obTestimony);
        exit;

        $content = View::render('admin/modules/testimonies/form', [
            'title' => 'Editar Depoimento > IsDev'
        ]);
        return parent::getPanel('Editar Depoimento > IsDev', $content, 'testimonies');
    }
}