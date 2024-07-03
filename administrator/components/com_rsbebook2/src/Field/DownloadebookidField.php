<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Rsbebook
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

namespace Rsbebook\Component\Rsbebook\Administrator\Field;

defined('JPATH_BASE') or die;

use Joomla\CMS\Factory;
use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Language\Text;

jimport('joomla.form.formfield');

/**
 * Supports a value from an external table
 *
 * @since  1.0.0
 */
class DownloadebookidField extends \Joomla\CMS\Form\FormField
{
	/**
	 * The form field custom type.
	 *
	 * @var    string
	 * @since  1.0.0
	 */
	protected $type = 'downloadebookid';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   1.0.0
	 */
	protected function getInput()
	{
		$value = $this->value;

		$db    = Factory::getContainer()->get('DatabaseDriver');

		$db->setQuery("select id, title from #__rsbebook_");

		$results = $db->loadObjectList();

		$input_options = 'class="form-select ' . $this->getAttribute('class') . '"';

		$options = array();

		
		// Iterate through all the results
		foreach ($results as $result)
		{
			$options[] = HTMLHelper::_('select.option', $result->ebook_id, Text::_($result->title));
		}


		// If the value is a string -> Only one result
		if (is_string($value))
		{
			$value = array($value);
		}
		elseif (is_object($value))
		{
			// If the value is an object, let's get its properties.
			$value = get_object_vars($value);
		}

		// If the select is multiple
		if ($this->multiple)
		{
			$input_options .= 'multiple="multiple"';
		}
		else
		{
			array_unshift($options, HTMLHelper::_('select.option', '', ''));
		}

		$html = HTMLHelper::_('select.genericlist', $options, $this->name, $input_options, 'value', 'text', $value, $this->id);

		return $html;
	}

	/**
	 * Wrapper method for getting attributes from the form element
	 *
	 * @param   string  $attr_name  Attribute name
	 * @param   mixed   $default    Optional value to return if attribute not found
	 *
	 * @return  mixed The value of the attribute if it exists, null otherwise
	 */
	public function getAttribute($attr_name, $default = null)
	{
		if (!empty($this->element[$attr_name]))
		{
			return $this->element[$attr_name];
		}
		else
		{
			return $default;
		}
	}
}
