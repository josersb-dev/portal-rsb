<?php
/**
 * @package Helix Ultimate Framework
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2021 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
*/

defined ('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Associations;
use Joomla\CMS\Layout\FileLayout;
use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Version;

// Create a shortcut for params.
$params = $this->item->params;
$attribs = json_decode($this->item->attribs ?? "");
HTMLHelper::addIncludePath(JPATH_COMPONENT . '/helpers/html');
$canEdit = $this->item->params->get('access-edit');
$info    = $params->get('info_block_position', 0);
$article_format = (isset($attribs->helix_ultimate_article_format) && $attribs->helix_ultimate_article_format) ? $attribs->helix_ultimate_article_format : 'standard';

$template = HelixUltimate\Framework\Platform\Helper::loadTemplateData();
$tmpl_params = $template->params;

// Check if associations are implemented. If they are, define the parameter.
$assocParam = (Associations::isEnabled() && $params->get('show_associations'));

$currentDate   = Factory::getDate()->format('Y-m-d H:i:s');
$isUnpublished = JVERSION < 4 ? ($this->item->state == 0 || strtotime($this->item->publish_up) > strtotime(Factory::getDate()) || ((strtotime($this->item->publish_down) < strtotime(Factory::getDate())) && $this->item->publish_down != Factory::getDbo()->getNullDate())) : ($this->item->state == Joomla\Component\Content\Administrator\Extension\ContentComponent::CONDITION_UNPUBLISHED || $this->item->publish_up > $currentDate)
	|| ($this->item->publish_down < $currentDate && $this->item->publish_down !== null);

$version = new Version();
$JoomlaVersion = $version->getShortVersion();

?>

<?php if($article_format == 'gallery') : ?>
	<?php echo LayoutHelper::render('joomla.content.blog.gallery', array('attribs' => $attribs, 'id'=>$this->item->id)); ?>
<?php elseif($article_format == 'video') : ?>
	<?php echo LayoutHelper::render('joomla.content.blog.video', array('attribs' => $attribs)); ?>
<?php elseif($article_format == 'audio') : ?>
	<?php echo LayoutHelper::render('joomla.content.blog.audio', array('attribs' => $attribs)); ?>
<?php else: ?>
	<?php echo LayoutHelper::render('joomla.content.intro_image', $this->item); ?>
<?php endif; ?>

<div class="article-body">
	<?php if ($isUnpublished) : ?>
		<div class="system-unpublished">
	<?php endif; ?>
	
	<?php if($params->get('show_create_date')):?>
		<span class="text-secondary rsb-date">
			<?= date('d/m/Y',strtotime($this->item->created));?>
		</span>
	<?php endif;?>
	<?php echo LayoutHelper::render('joomla.content.blog_style_default_item_title', $this->item); ?>

	<?php // Todo Not that elegant would be nice to group the params ?>

	<?php $useDefList = ($params->get('show_modify_date') || $params->get('show_publish_date') || $params->get('show_create_date')
		|| $params->get('show_hits') || $params->get('show_category') || $params->get('show_parent_category') || $params->get('show_author') || $assocParam); ?>

	<?php if ($useDefList && ($info == 0 || $info == 2)) : ?>
	  <?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'above', 'intro' => true)); ?>
	<?php endif; ?>

	<?php if ($params->get('show_tags', 1) && !$tmpl_params->get('show_list_tags',0) && !empty($this->item->tags->itemTags)) : ?>
		<?php $this->item->tagLayout = new FileLayout('joomla.content.tags'); ?>
		<?php echo $this->item->tagLayout->render($this->item->tags->itemTags); ?>
	<?php endif; ?>
	
	<?php if (!$params->get('show_intro')) : ?>
		<?php // Content is generated by content plugin event "onContentAfterTitle" ?>
		<?php echo $this->item->event->afterDisplayTitle; ?>
	<?php endif; ?>

	<?php // Content is generated by content plugin event "onContentBeforeDisplay" ?>
	<?php echo $this->item->event->beforeDisplayContent; ?>

	<div class="article-introtext">
		<?php echo $this->item->introtext; ?>
	

	<?php if ($useDefList && ($info == 1)) : ?>
		<?php echo LayoutHelper::render('joomla.content.info_block', array('item' => $this->item, 'params' => $params, 'position' => 'below', 'intro' => true)); ?>
	<?php endif; ?>

	<?php if ($params->get('show_readmore') && $this->item->readmore) :
		if ($params->get('access-view')) :
			$link = Route::_(version_compare($JoomlaVersion, '4.0.0', '>=') ? Joomla\Component\Content\Site\Helper\RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language) : ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language));
		else :
			$menu = Factory::getApplication()->getMenu();
			$active = $menu->getActive();
			$itemId = $active->id;
			$link = new Uri(Route::_('index.php?option=com_users&view=login&Itemid=' . $itemId, false));
			$link->setVar('return', base64_encode(version_compare($JoomlaVersion, '4.0.0', '>=') ? Joomla\Component\Content\Site\Helper\RouteHelper::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language) : ContentHelperRoute::getArticleRoute($this->item->slug, $this->item->catid, $this->item->language)));
		endif; ?>

		<?php echo LayoutHelper::render('joomla.content.readmore', array('item' => $this->item, 'params' => $params, 'link' => $link)); ?>

	<?php endif; ?>
	</div>

	<?php if ($isUnpublished) : ?>
		</div>
	<?php endif; ?>
</div>

<?php // Content is generated by content plugin event "onContentAfterDisplay" ?>
<?php echo $this->item->event->afterDisplayContent; ?>
