<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_feed
 *
 * @copyright   (C) 2005 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Helper\ModuleHelper;
use Joomla\Module\Noticias\Site\Helper\NoticiasHelper;
use Joomla\CMS\Factory;


//#Pegando dados do input
$app   = Factory::getApplication();
$input = $app->getInput();
$catid = $input->get('catid','');
$itemid = $input->get('id','');


$rssurl = $params->get('rssurl', '');
$rssrtl = $params->get('rssrtl', 0);

$items = NoticiasHelper::getItems($params,$catid,$itemid);

require ModuleHelper::getLayoutPath('mod_noticias', $params->get('layout', 'default'));
