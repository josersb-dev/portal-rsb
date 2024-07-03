<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_noticias
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

$doc = JFactory::getDocument();
$doc->addScript(Juri::base(true).'/media/templates/site/cassiopeia/js/jquery.lazy.min.js');
$doc->addStyleSheet(Juri::base(true).'/media/mod_noticias/styles.css?'.uniqid());

$doc->addScriptDeclaration("
    jQuery(function($){
        $('.rsb-lazy').lazy({
            effect: \"fadeIn\",
          effectTime: 500,
          threshold: 0
        })
    })
");
?>


<div class="rsb-noticias-recentes">
    <?php foreach($items as $item):?>
        <?php 
            $img = json_decode($item->images)->image_intro;
        ?>
        <div class="rsb-noticias-recentes-inner">
            <div class="recentes-inner-img">
                <a href="<?= JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid, $item->language));?>" title="<?= $item->title;?>">
                    <img src="<?= Juri::base(true).'/media/mod_noticias/placeholder.jpg'; ?>" class="rsb-lazy" data-src="<?= $img;?>" alt="Mais Recentes" />
                </a>
            </div>
            <div class="recentes-inner-descricao">
                <p class="recentes-title">
                <a href="<?= JRoute::_(ContentHelperRoute::getArticleRoute($item->id, $item->catid, $item->language));?>" title="<?= $item->title;?>">
                    <?= $item->title;?></p>
                </a>
                <span class="recentes-descricao"><?= strip_tags($item->introtext);?></span>
            </div>
        </div>
    <?php endforeach;?>
</div>