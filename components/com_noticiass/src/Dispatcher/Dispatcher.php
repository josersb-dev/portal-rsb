<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Noticias
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2022 José Carlos Ferreira
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Rsbnoticias\Component\Noticias\Site\Dispatcher;

defined('JPATH_PLATFORM') or die;

use Joomla\CMS\Dispatcher\ComponentDispatcher;
use Joomla\CMS\Language\Text;

/**
 * ComponentDispatcher class for Com_Noticias
 *
 * @since  1.0.0
 */
class Dispatcher extends ComponentDispatcher
{
	/**
	 * Dispatch a controller task. Redirecting the user if appropriate.
	 *
	 * @return  void
	 *
	 * @since   1.0.0
	 */
	public function dispatch()
	{
		parent::dispatch();
	}
}
