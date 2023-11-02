<?php 

namespace App\Utils;

class View {

    /**
     * Variáveis padrôes da Viwe
     * @var array
     */
    private static $vars;

    /**
     * Método Responsável por definir as dados iniciais da classe
     * @param array
     */
    public static function init($vars = []) {
        self::$vars = $vars;
    }

    /**
     * Método responsável por retornar o conteúdo de uma view
     * @param string $view
     * @return string
     * 
     */
    public static function getContentView($view) {
        $file = __DIR__."/../../resorces/view/".$view.".html";
        return file_exists($file) ? file_get_contents($file) : "";
    }

    /**
     * Método responsável por retornar o conteúdo renderizado de uma view
     * @param string $view
     * @param array $data (string/numeric);
     * @return string
     */
    public static function render($view, $data = []) {
        // Conteúdo da View
        $contentView = self::getContentView($view);

        // Merde de Variáveis da View
        $data = array_merge(self::$vars, $data);

        //Find it out the array's keys
        $keys = array_keys($data);
        $keys = array_map(function($item) {
           return  '{{'.$item.'}}';
        }, $keys);



        return str_replace($keys, array_values($data), $contentView);
    }
}

?>