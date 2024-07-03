<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Acervosalesiano
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

 namespace Acervosalesiano\Component\Acervosalesiano\Administrator\Field;

 defined('JPATH_BASE') or die;
 
 use \Joomla\CMS\Factory;
 use \Joomla\CMS\Form\FormField;
 use \Joomla\CMS\User\UserFactoryInterface;

/**
 * Supports an HTML select list of categories
 *
 * @since  1.0.0
 */
class DownloadsField extends FormField
{
	/**
	 * The form field type.
	 *
	 * @var        string
	 * @since  1.0.0
	 */
	protected $type = 'downloads';

	/**
	 * Method to get the field input markup.
	 *
	 * @return  string  The field input markup.
	 *
	 * @since   1.0.0
	 */
	protected function getInput()
	{
		// Initialize variables.
		$html = array();

		$doc = Factory::getDocument();
		$doc->addScript('https://code.jquery.com/ui/1.12.1/jquery-ui.js');

		/*$doc->addScriptDeclaration("
		
		$(document).ready(function(){
			$('#addButton').click(function(event){
			event.preventDefault();
				$('#sortable').append('<li><span class=\"ui-icon ui-icon-arrowthick-2-n-s\"></span><input type=\"text\" name=\"myfield[]\" /><input type=\"text\" name=\"downloads[link]\" class=\"form-control inputbox valid form-control-success\" /></li>');
			});
	
			$('#sortable').sortable();
			$('#sortable').disableSelection();
		});
		
		");

		$doc->addStyleDeclaration('
		.sortable-list {
			list-style-type: none;
			margin: 0;
			padding: 0;
			width: 60%;
		}
		.sortable-list li {
			margin: 0 3px 3px 3px;
			padding: 0.4em;
			padding-left: 1.5em;
		}
		.sortable-list li span {
			cursor: move;
		
		');*/

		// Load user
		$user_id = $this->value;

		echo '
		<h2>Adicionar Campos Dinamicamente</h2>
		<form id="myForm">
			<ul id="sortable" class="sortable-list">
				<li>
					<span class="ui-icon ui-icon-arrowthick-2-n-s"></span>
					<input type="text" name="downloads[title]" />
					<input type="text" name="downloads[link]" />
				</li>
			</ul>
			<button id="addButton">Adicionar Campo</button>
		</form>
		';
	}
}
