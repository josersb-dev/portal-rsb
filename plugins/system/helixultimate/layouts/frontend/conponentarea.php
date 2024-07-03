<?php
/**
 * @package Helix_Ultimate_Framework
 * @author JoomShaper <support@joomshaper.com>
 * @copyright Copyright (c) 2010 - 2021 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Menu\Menu;
$doc = Factory::getDocument();



$app   = Factory::getApplication();
$input = $app->getInput();
$view = $input->get('view','');


$data = $displayData;
?>

<main id="sp-component" class="<?php echo $data->settings->className; ?>">
	<div class="sp-column <?php echo $data->settings->custom_class; ?>">
		<jdoc:include type="message" />

		<?php if ($doc->countModules('content-top')): ?>
			<div class="sp-module-content-top clearfix">
				<jdoc:include type="modules" name="content-top" style="sp_xhtml" />
			</div>
		<?php endif ?>
		
		<?php if($doc->countModules('content-rigth') && $view == 'article'):?>
			<div class="row">
				<div class="<?= $doc->countModules('content-rigth') && $view == 'article' ? 'col-md-8' : 'col-md-12';?>">
					<jdoc:include type="component" />
				</div>
				<div class="col-md-4 content-right">
					<jdoc:include type="modules" name="content-rigth" style="sp_xhtml" />
				</div>
				<div class="content-bottom-mobile">
					<jdoc:include type="modules" name="content-bottom-mobile" style="sp_xhtml" />
				</div>
			</div>
		<?php else: ?>
			<jdoc:include type="component" />
		<?php endif;?>

		<?php if ($doc->countModules('content-bottom')): ?>
			<div class="sp-module-content-bottom clearfix">
				<jdoc:include type="modules" name="content-bottom" style="sp_xhtml" />
			</div>
		<?php endif ?>
	</div>
</main>
