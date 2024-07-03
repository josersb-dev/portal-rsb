<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Awforms
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

namespace Awforms\Component\Awforms\Administrator\View\Formularios;
// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use \Awforms\Component\Awforms\Administrator\Helper\AwformsHelper;
use \Joomla\CMS\Toolbar\Toolbar;
use \Joomla\CMS\Toolbar\ToolbarHelper;
use \Joomla\CMS\Language\Text;
use \Joomla\Component\Content\Administrator\Extension\ContentComponent;
use \Joomla\CMS\Form\Form;
use \Joomla\CMS\HTML\Helpers\Sidebar;
use \Joomla\CMS\Factory;
/**
 * View class for a list of Formularios.
 *
 * @since  1.0.0
 */
class HtmlView extends BaseHtmlView
{
	protected $items;

	protected $pagination;

	protected $state;

	/**
	 * Display the view
	 *
	 * @param   string  $tpl  Template name
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	public function display($tpl = null)
	{

		//Criar a tabela formulários temporaria
		self::formularios();

		//Depois de criar a tabela insira os dados
        self::inserirDadosNaTabelaAwForms(self::getDados());

		$this->state = $this->get('State');
		$this->items = $this->get('Items');
		$this->pagination = $this->get('Pagination');
		$this->filterForm = $this->get('FilterForm');
		$this->activeFilters = $this->get('ActiveFilters');

		// Check for errors.
		if (count($errors = $this->get('Errors')))
		{
			throw new \Exception(implode("\n", $errors));
		}

		$this->addToolbar();

		$this->sidebar = Sidebar::render();
		parent::display($tpl);
	}

	/**
	 * Add the page title and toolbar.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	protected function addToolbar()
	{
		$state = $this->get('State');
		$canDo = AwformsHelper::getActions();

		ToolbarHelper::title(Text::_('COM_AWFORMS_TITLE_FORMULARIOS'), "generic");

		$toolbar = Toolbar::getInstance('toolbar');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/src/View/Formularios';

		/*if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				$toolbar->addNew('formulario.add');
			}
		}*/

		if ($canDo->get('core.edit.state'))
		{
			$dropdown = $toolbar->dropdownButton('status-group')
				->text('JTOOLBAR_CHANGE_STATUS')
				->toggleSplit(false)
				->icon('fas fa-ellipsis-h')
				->buttonClass('btn btn-action')
				->listCheck(true);

			$childBar = $dropdown->getChildToolbar();

			if (isset($this->items[0]->state))
			{
				$childBar->publish('formularios.publish')->listCheck(true);
				$childBar->unpublish('formularios.unpublish')->listCheck(true);
				$childBar->archive('formularios.archive')->listCheck(true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				$toolbar->delete('formularios.delete')
				->text('JTOOLBAR_EMPTY_TRASH')
				->message('JGLOBAL_CONFIRM_DELETE')
				->listCheck(true);
			}

			/*$childBar->standardButton('duplicate')
				->text('JTOOLBAR_DUPLICATE')
				->icon('fas fa-copy')
				->task('formularios.duplicate')
				->listCheck(true);*/

			if (isset($this->items[0]->checked_out))
			{
				$childBar->checkin('formularios.checkin')->listCheck(true);
			}

			if (isset($this->items[0]->state))
			{
				$childBar->trash('formularios.trash')->listCheck(true);
			}
		}

		

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{

			if ($this->state->get('filter.state') == ContentComponent::CONDITION_TRASHED && $canDo->get('core.delete'))
			{
				$toolbar->delete('formularios.delete')
					->text('JTOOLBAR_EMPTY_TRASH')
					->message('JGLOBAL_CONFIRM_DELETE')
					->listCheck(true);
			}
		}

		if ($canDo->get('core.admin'))
		{
			$toolbar->preferences('com_awforms');
		}

		// Set sidebar action
		Sidebar::setAction('index.php?option=com_awforms&view=formularios');
	}
	
	/**
	 * Method to order fields 
	 *
	 * @return void 
	 */
	protected function getSortFields()
	{
		return array(
			'a.`id`' => Text::_('JGRID_HEADING_ID'),
			'a.`state`' => Text::_('JSTATUS'),
			'a.`ordering`' => Text::_('JGRID_HEADING_ORDERING'),
		);
	}

	/**
	 * Check if state is set
	 *
	 * @param   mixed  $state  State
	 *
	 * @return bool
	 */
	public function getState($state)
	{
		return isset($this->state->{$state}) ? $this->state->{$state} : false;
	}

	function formularios()
    {
        $db = Factory::getDbo();

        // Nome da tabela temporária
        $tableName = '#__awforms_formularios';

        // Array com os campos e seus tipos
        $campos = [
            'id' => 'INT NOT NULL AUTO_INCREMENT',
            'created_by' => 'INT(11) NULL',
            'modified_by' => 'INT(11) NULL',
            'state' => 'TINYINT(1) NULL',
            'ordering' => 'INT(11)  NULL',
            'checked_out' => 'INT(11)  NULL',
            'checked_out_time' => 'datetime',
            'title' => 'VARCHAR(255)  NULL',
            'db' => 'VARCHAR(255) NULL'
        ];

        // Criação da consulta SQL para criar a tabela temporária
        $query = "CREATE TEMPORARY TABLE $tableName (";

        foreach ($campos as $campo => $tipo) {
            $query .= "$campo $tipo, ";
        }

        // Remova a vírgula extra no final
        $query = rtrim($query, ', ');

        // Adiciona a chave primária com autoincremento
        $query .= ", PRIMARY KEY (id))";

        // Executa a consulta SQL
        $db->setQuery($query);
        $db->execute();
    }


    public function getDados(){

    	$db = Factory::getDbo();
    	$query = $db->getQuery(true);

    	$query->select($db->quoteName(array(
    	    'params','title'
    	)))
    	->from($db->quoteName('#__modules'))
    	->where($db->quoteName('params') . ' IS NOT NULL')
    	->where($db->quoteName('module'). ' = '. $db->quote('mod_awform'));

    	$db->setQuery($query);
    	$results = $db->loadAssocList();

    	$items = array();

    	// Processar os resultados
    	foreach ($results as $result) {
    	    $params = json_decode($result['params'], true);

    	    if (json_last_error() == JSON_ERROR_NONE && isset($params['db']) && isset($params['dataDb']) && !empty($params['dataDb'])) {
    	        $dbValue = $params['db'];
    	        $dataDbValue = $params['s7dform'];

				if(!self::tableExists($dbValue)){
					continue;
				}

    	      	array_push($items, (object) [
    	       	'db' => $dbValue,
    	       	'title' => $result['title']
    	       ]);
    	    }
    	}

    	return $items;
    }

	public function tableExists($tabela){
		$db = Factory::getDbo();
       $tableName = $tabela;

       // Tente obter informações da tabela
       try {
           $query = $db->getQuery(true)
               ->select('1')
               ->from($db->quoteName($tableName))
               ->setLimit(1);

           $db->setQuery($query);
           $db->execute();

           // Se a execução ocorrer sem erro, a tabela existe
           $tableExists = true;
       } catch (\Exception $e) {
           // Se ocorrer um erro, a tabela não existe
           $tableExists = false;
       }

	   return $tableExists;
	}

    public static function inserirDadosNaTabelaAwForms($dadosArray)
    {
        $db = Factory::getDbo();

        foreach ($dadosArray as $item) {
            // Certifique-se de que as propriedades existem antes de usá-las
            $title = isset($item->title) ? $db->quote($item->title) : null;
            $dbValue = isset($item->db) ? $db->quote($item->db) : null;

            if ($title !== null && $dbValue !== null) {
                // Create a new query object.
                $query = $db->getQuery(true);

                // Insert columns and values.
				                // Insert columns.
				$columns = array('title', 'db', 'state');
				$values = array($title, str_replace('#__','',$dbValue),1);

                // Prepare the insert query.
                $query
                    ->insert($db->quoteName('#__awforms_formularios'))
                    ->columns($db->quoteName($columns))
                    ->values(implode(',', $values));

                // Set the query using our newly populated query object and execute it.
                $db->setQuery($query);
                $db->execute();
            } else {
                // Tratar caso algum dos valores esteja ausente
                return false;
            }
        }

        // Mova o retorno true fora do loop para garantir que seja alcançado somente se todos os itens forem processados com sucesso
        return true;
    }
}
