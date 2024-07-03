<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_noticias
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\Noticias\Site\Helper;

use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

// phpcs:disable PSR1.Files.SideEffects
\defined('_JEXEC') or die;
// phpcs:enable PSR1.Files.SideEffects

/**
 * Helper for mod_feed
 *
 * @since  1.5
 */
class NoticiasHelper
{
    /**
     * Retrieve feed information
     *
     * @param   \Joomla\Registry\Registry  $params  module parameters
     *
     * @return  \Joomla\CMS\Feed\Feed|string
     */
    public static function getItems($params,$catid,$itemid)
    {
        // Get a db connection.
        $db = Factory::getDbo();

        $date = Factory::getDate();

        $query = $db->getQuery(true);
		$nowDate = $db->quote($date->toSql());

        // Create a new query object.
        $query = $db->getQuery(true);

        // Select all records from the user profile table where key begins with "custom.".
        // Order it by the ordering field.
        $query->select(array('*'));
        $query->from($db->quoteName('#__content'));

        $query->where($db->quoteName('catid') . ' = ' . $db->quote($catid));
        $query->where($db->quoteName('id') . ' != ' . $db->quote($itemid));
        $query->where($db->quoteName('publish_up') . ' <= ' . $nowDate);
        $query->order('created DESC');

        // Reset the query using our newly populated query object.
        $db->setQuery($query,0,3);

        // Load the results as a list of stdClass objects (see later for more options on retrieving data).
        $results = $db->loadObjectList();

        return $results;
    }
}
