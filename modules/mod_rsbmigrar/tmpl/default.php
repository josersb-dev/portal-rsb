<?php
/**
 * @package     Joomla.Site
 * @subpackage  mod_finder
 *
 * @copyright   (C) 2011 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Router\Route;
use Joomla\Module\Rsbmigrar\Site\Helper\RsbmigrarHelper;

echo 
'   <form enctype="multipart/form-data" action="" method="POST">
        <input type="hidden" name="" value="" />
        Enviar esse arquivo: <input name="cronofile" type="file" />
        <input type="submit" value="Enviar arquivo" />
    </form>
';


    print_r(RsbmigrarHelper::dadosCSV());

