<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_noticias
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

namespace Joomla\Module\Presencas\Site\Helper;

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
class PresencasHelper
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
        $response = file_get_contents($apiUrl);
      
        if ($response === false) {
            $data = array('error' => 'Erro ao chamar a API');
        } else {
            $data = json_decode($response, true);
        }

        header('Content-Type: application/json');

        $data = array_map(function($item){
            
            $item['txSiteUrl'] = $item['txSiteUrl'] ? self::adicionar_https($item['txSiteUrl']) : '';

            return $item;
        },$data);

        return json_encode($data);
    }

    public static function adicionar_https($url):string {
        if (!preg_match('/^https?:\/\//', $url)) {
            $url = 'https://' . $url;
        }
        return $url;
    }
}
