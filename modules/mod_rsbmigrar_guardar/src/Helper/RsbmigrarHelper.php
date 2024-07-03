<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_finder
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\Rsbmigrar\Site\Helper;

\defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Table\Content;
use Joomla\CMS\Table\Asset;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Workflow\Workflow;
use Joomla\CMS\MVC\Model\WorkflowBehaviorTrait;

/**
 * Finder module helper.
 *
 * @since  2.5
 */
class RsbmigrarHelper
{
    use WorkflowBehaviorTrait;
	/**
	 * Method to get hidden input fields for a get form so that control variables
	 * are not lost upon form submission.
	 *
	 * @param   string   $route      The route to the page. [optional]
	 * @param   integer  $paramItem  The menu item ID. (@since 3.1) [optional]
	 *
	 * @return  string  A string of hidden input form fields
	 *
	 * @since   2.5
	 */
    public static function migrarDados($title, $catid, $fulltext)
    {
        // Crie uma instância da tabela de conteúdo
        $artigoTable = new Content(Factory::getDbo());
    
        // Preencha os dados do artigo
        $artigoData = array(
            'title' => $title,
            'catid' => $catid,
            'fulltext' => $fulltext,
            'introtext' => 'introdução mano',
            'language' => 'bb',
            'state' => 1
            // Adicione outros campos necessários aqui
        );
    
        $artigoTable->reset(); // Reset para garantir que os dados anteriores sejam limpos
        $artigoTable->bind($artigoData);
       
    
        // Salve o artigo
        if (!$artigoTable->save($artigoData)) {
            echo 'Erro ao inserir na tabela de conteúdo: ' . $artigoTable->getError();
        } else {
            echo 'Artigo inserido com sucesso! ID: ' . $artigoTable->id . '<br>';

            // Agora, obtemos o ID do artigo recém-inserido
            $novoArtigoId = $artigoTable->id;
    
            // Agora, lidamos com os assets usando a tabela de assets
            $assetTable = new Asset(Factory::getDbo());
            
            // Salvar o workflow--------------------------------------------------
            $artigoTable->type = 'com_content.article';
            $workflowAssetStageId = new Asset(Factory::getDbo());
            $workflowAssetStageId->load(['name' => 'com_content.stage.1']);

            $workflowStageId = self::getWorkflowStageId($workflowAssetStageId->get('id'));

            //Se não existir uma associação de fluxo então cria.
            if(!self::getWorkflowAssociation($novoArtigoId))
            {
                if(!self::setWorkflowAssociation($novoArtigoId,$workflowStageId)){
                    echo 'Erro ao criar fluxo de trabalho para o id '.$novoArtigoId;
                }
            }
    
            // Carregue o asset associado ao artigo
            if ($assetTable->load(array('name' => 'com_content.article.' . $novoArtigoId))) {
                // Se não existir, crie um novo
                if (!$assetTable->id) {
                    $assetTable->id = 0;
                    $assetTable->name = 'com_content.article.' . $novoArtigoId;
                    $assetTable->title = $title;
                    $assetTable->parent_id = 1; // Altere conforme necessário
    
                    // Salve o asset
                    if (!$assetTable->save()) {
                        echo 'Erro ao inserir no sistema de controle de acesso: ' . $assetTable->getError();
                    } else {
                        echo 'Asset do artigo inserido com sucesso!<br>';
                    }
                }
            }

        }
    }

    protected static function getWorkflowStageId($assetId)
    {
        $db = Factory::getDbo();
        $query = $db
            ->getQuery(true)
            ->select('id')
            ->from($db->quoteName('#__workflow_stages'))
            ->where($db->quoteName('asset_id') . " = " . $db->quote($assetId));

        $db->setQuery($query);
        $result = $db->loadResult();

        return $result;
    }

    protected static function getWorkflowAssociation($itemId)
    {
        $db = Factory::getDbo();
        $query = $db
            ->getQuery(true)
            ->select('item_id')
            ->from($db->quoteName('#__workflow_associations'))
            ->where($db->quoteName('item_id') . " = " . $db->quote($itemId));

        $db->setQuery($query);
        $result = $db->loadResult();

        return $result;
    }

    protected static function setWorkflowAssociation($itemId,$stageId)
    {
        // Create and populate an object.
        $association = [];
        $association['item_id'] = $itemId;
        $association['stage_id'] = $stageId;
        $association['extension'] = 'com_content.article';

        $association = (object) $association;

        // Insert the object into the user profile table.
        $insert = Factory::getDbo()->insertObject('#__workflow_associations', $association);

        if(!$insert){
            return false;
        }

        return true;
    }
}