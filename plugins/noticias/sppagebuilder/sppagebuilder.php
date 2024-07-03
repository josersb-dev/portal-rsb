<?php
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Plugin\PluginHelper;

class PlgNoticiasSppagenoticias extends CMSPlugin
{
    protected $autoloadLanguage = true;

    public function __construct(&$subject, $config)
    {
        parent::__construct($subject, $config);
    }

    public function onContentPrepare($context, $article, $params, $page)
    {
        echo 'kkk';
        return;
        echo '<script>alert(123)</script>';
        if ($context !== 'com_sppagebuilder.article') {
            return;
        }

        // Verifique se o SP Page Builder está disponível
        if (!class_exists('SppagebuilderHelper')) {
            return;
        }

        // Verifique se o artigo contém a tag de substituição
        if (strpos($article->text, '{sppagenoticias}') === false) {
            return;
        }

        // Obtenha o ID do artigo
        $articleId = $article->id;

        // Obtenha o status da integração do SP Page Builder
        $sppagebuilder_active = $this->getSppagebuilderStatus($articleId);

        // Verifique se a integração está ativada
        if ($sppagebuilder_active) {
            // Seu código para buscar os itens do componente "noticias"
            $items = $this->getNoticiasItems();

            // Gere o HTML dos itens no formato desejado
            $html = '';
            foreach ($items as $item) {
                $html .= '<div class="noticias-item">';
                $html .= '<h2>' . $item->titulo . '</h2>';
                $html .= '<p>' . $item->resumo . '</p>';
                // ... Outros campos ...
                $html .= '</div>';
            }

            // Substitua a tag de substituição no conteúdo do artigo com o HTML gerado
            $article->text = str_replace('{sppagenoticias}', $html, $article->text);
        }
    }

}
