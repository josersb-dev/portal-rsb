<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Noticias
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2022 José Carlos Ferreira
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Rsbnoticias\Component\Noticias\Administrator\Model;
// No direct access.
defined('_JEXEC') or die;

use \Joomla\CMS\MVC\Model\ListModel;
use \Joomla\Component\Fields\Administrator\Helper\FieldsHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Helper\TagsHelper;
use \Joomla\Database\ParameterType;
use \Joomla\Utilities\ArrayHelper;
use Rsbnoticias\Component\Noticias\Administrator\Helper\NoticiasHelper;

/**
 * Methods supporting a list of Items records.
 *
 * @since  1.0.0
 */
class ItemsModel extends ListModel
{
	/**
	* Constructor.
	*
	* @param   array  $config  An optional associative array of configuration settings.
	*
	* @see        JController
	* @since      1.6
	*/
	public function __construct($config = array())
	{
		if (empty($config['filter_fields']))
		{
			$config['filter_fields'] = array(
				'id', 'a.id',
				'state', 'a.state',
				'ordering', 'a.ordering',
				'created_by', 'a.created_by',
				'modified_by', 'a.modified_by',
				'destaque', 'a.destaque',
				'data', 'a.data',
		'data.from', 'data.to',
				'imagem', 'a.imagem',
				'legenda', 'a.legenda',
				'slug', 'a.slug',
				'resumo', 'a.resumo',
				'texto', 'a.texto',
				'id_segmento', 'a.id_segmento',
				'publicar_em', 'a.publicar_em',
				'titulo', 'a.titulo',
			);
		}

		parent::__construct($config);
	}


	

	

	

	/**
	 * Method to auto-populate the model state.
	 *
	 * Note. Calling getState in this method will result in recursion.
	 *
	 * @param   string  $ordering   Elements order
	 * @param   string  $direction  Order direction
	 *
	 * @return void
	 *
	 * @throws Exception
	 */
	protected function populateState($ordering = null, $direction = null)
	{
		// List state information.
		parent::populateState('id', 'ASC');

		$context = $this->getUserStateFromRequest($this->context.'.filter.search', 'filter_search');
		$this->setState('filter.search', $context);

		// Split context into component and optional section
		if (!empty($context))
		{
			$parts = FieldsHelper::extract($context);

			if ($parts)
			{
				$this->setState('filter.component', $parts[0]);
				$this->setState('filter.section', $parts[1]);
			}
		}
	}

	/**
	 * Method to get a store id based on model configuration state.
	 *
	 * This is necessary because the model is used by the component and
	 * different modules that might need different sets of data or different
	 * ordering requirements.
	 *
	 * @param   string  $id  A prefix for the store id.
	 *
	 * @return  string A store id.
	 *
	 * @since   1.0.0
	 */
	protected function getStoreId($id = '')
	{
		// Compile the store id.
		$id .= ':' . $this->getState('filter.search');
		$id .= ':' . $this->getState('filter.state');

		
		return parent::getStoreId($id);
		
	}

	/**
	 * Build an SQL query to load the list data.
	 *
	 * @return  DatabaseQuery
	 *
	 * @since   1.0.0
	 */
	protected function getListQuery()
	{
		// Create a new query object.
		$db    = $this->getDbo();
		$query = $db->getQuery(true);

		// Select the required fields from the table.
		$query->select(
			$this->getState(
				'list.select', 'DISTINCT a.*'
			)
		);
		$query->from('`#__noticias_items` AS a');
		
		// Join over the users for the checked out user
		$query->select("uc.name AS uEditor");
		$query->join("LEFT", "#__users AS uc ON uc.id=a.checked_out");

		// Join over the user field 'created_by'
		$query->select('`created_by`.name AS `created_by`');
		$query->join('LEFT', '#__users AS `created_by` ON `created_by`.id = a.`created_by`');

		// Join over the user field 'modified_by'
		$query->select('`modified_by`.name AS `modified_by`');
		$query->join('LEFT', '#__users AS `modified_by` ON `modified_by`.id = a.`modified_by`');
		

		// Filter by published state
		$published = $this->getState('filter.state');

		if (is_numeric($published))
		{
			$query->where('a.state = ' . (int) $published);
		}
		elseif (empty($published))
		{
			$query->where('(a.state IN (0, 1))');
		}

		// Filter by search in title
		$search = $this->getState('filter.search');

		if (!empty($search))
		{
			if (stripos($search, 'id:') === 0)
			{
				$query->where('a.id = ' . (int) substr($search, 3));
			}
			else
			{
				$search = $db->Quote('%' . $db->escape($search, true) . '%');
				$query->where('( a.destaque LIKE ' . $search . '  OR  a.data LIKE ' . $search . '  OR  a.resumo LIKE ' . $search . '  OR  a.id_segmento LIKE ' . $search . '  OR  a.publicar_em LIKE ' . $search . '  OR  a.titulo LIKE ' . $search . ' )');
			}
		}
		

		// Filtering destaque
		$filter_destaque = $this->state->get("filter.destaque");

		if ($filter_destaque !== null && (is_numeric($filter_destaque) || !empty($filter_destaque)))
		{
			$query->where("a.`destaque` = '".$db->escape($filter_destaque)."'");
		}

		// Filtering data
		$filter_data_from = $this->state->get("filter.data.from");

		if ($filter_data_from !== null && !empty($filter_data_from))
		{
			$query->where("a.`data` >= '".$db->escape($filter_data_from)."'");
		}
		$filter_data_to = $this->state->get("filter.data.to");

		if ($filter_data_to !== null  && !empty($filter_data_to))
		{
			$query->where("a.`data` <= '".$db->escape($filter_data_to)."'");
		}

		// Filtering id_segmento
		$filter_id_segmento = $this->state->get("filter.id_segmento");

		if ($filter_id_segmento !== null && !empty($filter_id_segmento))
		{
			$query->where("a.`id_segmento` = '".$db->escape($filter_id_segmento)."'");
		}
		// Add the list ordering clause.
		$orderCol  = $this->state->get('list.ordering', 'id');
		$orderDirn = $this->state->get('list.direction', 'ASC');

		if ($orderCol && $orderDirn)
		{
			$query->order($db->escape($orderCol . ' ' . $orderDirn));
		}

		return $query;
	}

	/**
	 * Get an array of data items
	 *
	 * @return mixed Array of data items on success, false on failure.
	 */
	public function getItems()
	{
		$items = parent::getItems();
		
		foreach ($items as $oneItem)
		{
					$oneItem->destaque = ($oneItem->destaque == '') ? '' : Text::_('COM_NOTICIAS_ITEMS_DESTAQUE_OPTION_' . strtoupper(str_replace(' ', '_',$oneItem->destaque)));

			if (isset($oneItem->id_segmento))
			{
				$db    = $this->getDbo();
				$query = $db->getQuery(true);

				$query
					->select($db->quoteName('title'))
					->from($db->quoteName('#__categories'))
					->where('FIND_IN_SET(' . $db->quoteName('id') . ', ' . $db->quote($oneItem->id_segmento) . ')');

				$db->setQuery($query);
				$result = $db->loadColumn();

				$oneItem->id_segmento = !empty($result) ? implode(', ', $result) : '';
			}
		}

		return $items;
	}
}
