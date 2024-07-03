<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_presencas
 *
 * @copyright   (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\Presencas\Site\Helper\PresencasHelper;
use Joomla\CMS\Factory;


//#Pegando dados do input
$app   = Factory::getApplication();
$input = $app->getInput();
$catid = $input->get('catid','');
$itemid = $input->get('id','');


$rssurl = $params->get('rssurl', '');
$rssrtl = $params->get('rssrtl', 0);

$items = PresencasHelper::getItems($params);

require ModuleHelper::getLayoutPath('mod_presencas', $params->get('layout', 'default'));
