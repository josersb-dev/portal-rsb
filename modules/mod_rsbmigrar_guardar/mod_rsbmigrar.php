<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_rsbmigrar
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Component\ComponentHelper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Module\Rsbmigrar\Site\Helper\RsbmigrarHelper;





echo 'opa';
return;
// Chame a função para migrar os dados
RsbmigrarHelper::migrarDados('Artigo 15', 2, 'Conteúdo do artigo 15...');
RsbmigrarHelper::migrarDados('Artigo 16', 2, 'Conteúdo do artigo 16...');
RsbmigrarHelper::migrarDados('Artigo 17', 2, 'Conteúdo do artigo 17...');

require ModuleHelper::getLayoutPath('mod_rsbmigrar', $params->get('layout', 'default'));
