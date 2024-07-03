<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_noticias
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\Ondeestamos\Site\Helper;

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
class OndeestamosHelper
{
    /**
     * Retrieve feed information
     *
     * @param   \Joomla\Registry\Registry  $params  module parameters
     *
     * @return  \Joomla\CMS\Feed\Feed|string
     */
    public static function getItems($params)
    {
        $coTipoPresenca = is_array($params->get('coTipoPresenca')) ? $params->get('coTipoPresenca') : [$params->get('coTipoPresenca')];

        $coTipoPresenca = array_map(function($item){
            return "'".$item."'";
        },$coTipoPresenca);

        $coTipoPresenca = implode(',',$coTipoPresenca);

        $limit = $params->get('limit') ?? 2;
    
        $apiUrl = 'https://integrador.sig.rsb.org.br/api2/presenca/tipo/'.$coTipoPresenca.'/limit/'.$limit;
       
        return $apiUrl;
    }
}
