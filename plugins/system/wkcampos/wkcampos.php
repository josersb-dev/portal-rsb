<?php 
defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Table\Table;

class PlgSystemWkCampos extends CMSPlugin
{
    public function onAfterRoute()
    {
        // Verifica se o menu já existe para evitar duplicatas
        $menuId = $this->getMenuId('Seu Menu');

        // Se o menu não existir, adiciona
        if (!$menuId) {
            $data = array(
                'menutype' => 'menu', // Substitua pelo seu menutype desejado
                'title' => 'Seu Menu',
                'type' => 'component',
                'component_id' => 22, // Substitua pelo ID do componente associado ao seu menu
                'link' => 'index.php?option=com_seucomponente', // Substitua pela rota desejada
                'language' => '*',
                'client_id' => 1,
                'path' => 'nada'
            );

            $table = Table::getInstance('Menu', 'JTable', array('dbo' => Factory::getDbo()));
            $table->bind($data);

            if (!$table->check() || !$table->store()) {
                // Trate erros aqui se necessário
                echo $table->getError();
            }
        }
    }

    private function getMenuId($title)
    {
        $db = Factory::getDbo();

        $query = $db->getQuery(true)
            ->select($db->quoteName('id'))
            ->from($db->quoteName('#__menu'))
            ->where($db->quoteName('title') . ' = ' . $db->quote($title));

        $db->setQuery($query);

        return $db->loadResult();
    }
    
}
