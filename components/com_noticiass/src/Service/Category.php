<?php

/**
 * @version    CVS: 1.0.0
 * @package    Com_Noticias
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2022 José Carlos Ferreira
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Rsbnoticias\Component\Noticias\Site\Service;
// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\Categories\Categories;
/**
 * Content Component Category Tree
 *
 * @since  1.0.0
 */

class Category extends Categories
{
	/**
	 * Class constructor
	 *
	 * @param   array  $options  Array of options
	 *
	 * @since   11.1
	 */
	public function __construct($options = array())
	{
		$options['table'] = '#__noticias_items';
		$options['extension'] = 'com_noticias.items';
		parent::__construct($options);
	}
}
