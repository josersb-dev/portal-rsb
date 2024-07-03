<?php 
defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Plugin\CMSPlugin;

class PlgContentWkCampos extends CMSPlugin
{

    public function onAfterInitialise()
    {
        return;
        // Verifica se o usuário não está logado e se está tentando acessar o painel de administração
        if (!$this->app->isClient('administrator') && !$this->app->getIdentity()->id)
        {
            // Redireciona para a página inicial ou qualquer outra página desejada
            $this->app->redirect('/');
        }
    }

    public function onContentPrepareForm($form, $data)
    {

        // Verifique se é o formulário de edição de item de menu
        if ($form->getName() == 'com_menus.item' && is_object($data))
        {
            // Adiciona a nova aba ao formulário
            $form->loadFile(dirname(__FILE__) . '/fields/meuaba.xml');
            
        }

        // Verifique se é o formulário de edição de item de categoria
        if ($form->getName() == 'com_categories.categorycom_content' && is_object($data))
        {
            // Adiciona a nova aba ao formulário
            $form->loadFile(dirname(__FILE__) . '/fields/category.xml');
            
        }

        return true;
    }


    public function onBeforeCompileHead()
    {
        // Obtenha a instância da aplicação
        $app = jFactory::getApplication();
        // Obtenha o ID do menu ativo
        $menu = $app->getMenu()->getActive();
        $menuId = $menu->id;

        // Obtenha os parâmetros do menu
        $menuParams = $app->getMenu()->getParams($menuId);

        $doc = jFactory::getDocument();
        $doc->addScriptDeclaration($menuParams->get('customjs'));

        return true;
    }

    public function onContentBeforeSave($context, $article, $isNew)
    {

        echo $context;
        return;
        // Verifique se o contexto é a edição de um artigo e se o artigo é novo.
        if ($context === 'com_content.article' && $isNew) {

            echo 'como é amigo';
            return;
            // Obtenha as categorias selecionadas do artigo
            $selectedCategories = $article->catid;

            // Aqui você pode adicionar sua lógica para manipular as categorias.
            // Por exemplo, você pode adicionar código para adicionar categorias adicionais ao artigo antes de ser salvo.
            // Digamos que você tenha selecionado as categorias 1, 2 e 3
            $selectedCategories .= ',4,5,6'; // Adiciona as categorias 4, 5 e 6

            // Salva as categorias modificadas de volta no artigo
            $article->catid = $selectedCategories;
        }
    }

    
}
