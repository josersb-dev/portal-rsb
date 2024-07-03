<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Rsbebook
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

namespace Rsbebook\Component\Rsbebook\Site\Field;

// Check to ensure this file is included in Joomla!
defined('_JEXEC') or die('Restricted access');

use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Form\FormField;

/**
 * Class SubmitField
 *
 * @since  1.0.0
 */
class SubmitField extends FormField
{
	protected $type = 'submit';

	protected $value;

	protected $for;

	/**
	 * Get a form field markup for the input
	 *
	 * @return string
	 */
	public function getInput()
	{
		$this->value = $this->getAttribute('value');

		return '<button id="' . $this->id . '"'
		. ' name="submit_' . $this->for . '"'
		. ' value="' . $this->value . '"'
		. ' title="' . Text::_('JSEARCH_FILTER_SUBMIT') . '"'
		. ' class="btn" style="margin-top: -10px;">'
		. Text::_('JSEARCH_FILTER_SUBMIT')
		. ' </button>';
	}
}
