<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Awforms
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

namespace Awforms\Component\Awforms\Administrator\View\Registros;
// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\MVC\View\HtmlView as BaseHtmlView;
use \Awforms\Component\Awforms\Administrator\Helper\AwformsHelper;
use \Joomla\CMS\Toolbar\Toolbar;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Toolbar\ToolbarHelper;
use \Joomla\CMS\Language\Text;
use \Joomla\Component\Content\Administrator\Extension\ContentComponent;
use \Joomla\CMS\Form\Form;
use \Joomla\CMS\HTML\Helpers\Sidebar;
/**
 * View class for a list of Registros.
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

		//Nomo do formulário
		ToolbarHelper::title(self::getTitle(), "generic");

		$toolbar = Toolbar::getInstance('toolbar');

		// Check if the form exists before showing the add/edit buttons
		$formPath = JPATH_COMPONENT_ADMINISTRATOR . '/src/View/Registros';

		/*if (file_exists($formPath))
		{
			if ($canDo->get('core.create'))
			{
				$toolbar->addNew('registro.add');
			}
		}*/

		//Botão de exportar dados.
		$toolbar->standardButton('exportar')
			->text('Exportar Dados')
			->icon('fas fa-download')
			->task('registros.exportar_para_csv')
			->listCheck(false);

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
				$childBar->publish('registros.publish')->listCheck(true);
				$childBar->unpublish('registros.unpublish')->listCheck(true);
				$childBar->archive('registros.archive')->listCheck(true);
			}
			elseif (isset($this->items[0]))
			{
				// If this component does not use state then show a direct delete button as we can not trash
				$toolbar->delete('registros.delete')
				->text('JTOOLBAR_EMPTY_TRASH')
				->message('JGLOBAL_CONFIRM_DELETE')
				->listCheck(true);
			}

			/*$childBar->standardButton('duplicate')
				->text('JTOOLBAR_DUPLICATE')
				->icon('fas fa-copy')
				->task('registros.duplicate')
				->listCheck(true);*/

			if (isset($this->items[0]->checked_out))
			{
				$childBar->checkin('registros.checkin')->listCheck(true);
			}

			if (isset($this->items[0]->state))
			{
				$childBar->trash('registros.trash')->listCheck(true);
			}
		}

		

		// Show trash and delete for components that uses the state field
		if (isset($this->items[0]->state))
		{

			if ($this->state->get('filter.state') == ContentComponent::CONDITION_TRASHED && $canDo->get('core.delete'))
			{
				$toolbar->delete('registros.delete')
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
		Sidebar::setAction('index.php?option=com_awforms&view=registros');
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
	
	public function getDados(){

    	if(isset($_GET['table'])){
    		$_SESSION['table_aw'] = $_GET['table'];
    	}
    	$db = Factory::getDbo();
    	$query = $db->getQuery(true);

    	$query->select($db->quoteName(array(
    	    'params'
    	)))
    	->from($db->quoteName('#__modules'))
    	->where(
    	    $db->quoteName('params') . ' IS NOT NULL AND ' .
    	    $db->quoteName('params') . ' LIKE ' . $db->quote('%#__'.$_SESSION['table_aw'].'%')
    	);

    	$db->setQuery($query);
    	$results = $db->loadAssocList();

    	// Processar os resultados
    	foreach ($results as $result) {
    	    $params = json_decode($result['params'], true);

    	    if (json_last_error() == JSON_ERROR_NONE && isset($params['db']) && isset($params['dataDb'])) {
    	        $dbValue = $params['db'];
    	        $dataDbValue = $params['awform'];

    	        // Faça algo com os valores encontrados
    	        return $dataDbValue;
    	    }
    	}
    }


    public function getTitle(){

    	if(isset($_GET['table'])){
    		$_SESSION['table_aw'] = $_GET['table'];
    	}
    	$db = Factory::getDbo();
    	$query = $db->getQuery(true);

    	$query->select($db->quoteName(array(
    	    'title'
    	)))
    	->from($db->quoteName('#__modules'))
    	->where(
    	    $db->quoteName('params') . ' IS NOT NULL AND ' .
    	    $db->quoteName('params') . ' LIKE ' . $db->quote('%#__'.$_SESSION['table_aw'].'%')
    	);

    	$db->setQuery($query);
    	$results = $db->loadAssocList();

    	return $results[0]['title'];
    }

	
}
