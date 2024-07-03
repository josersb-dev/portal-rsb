<?php
/**
 * @package Helix_Ultimate_Framework
 * @author JoomShaper <support@joomshaper.com>
 * Copyright (c) 2010 - 2021 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */

defined ('_JEXEC') or die('Restricted Access');

use HelixUltimate\Framework\Platform\Helper;
use Joomla\CMS\Helper\ModuleHelper;
use Joomla\CMS\Language\Text;

$data = $displayData;
$offcanvas_position = $displayData->params->get('offcanvas_position', 'right');
$menu_type = $displayData->params->get('menu_type');

$feature_folder_path = JPATH_THEMES . '/' . $data->template->template . '/features';

include_once $feature_folder_path . '/logo.php';
include_once $feature_folder_path . '/menu.php';
include_once $feature_folder_path . '/social.php';

/**
 * Helper classes for-
 * site logo, Menu header.
 *
 */
$logo    	= new HelixUltimateFeatureLogo($data->params);
$menu    	= new HelixUltimateFeatureMenu($data->params);
$social 	= new HelixUltimateFeatureSocial($data->params);


/**
 * Get related modules
 * The modules are mod_search
 */
$searchModule = Helper::getSearchModule();
?>

<?php if( $displayData->params->get('sticky_header')) { ?>
	<div class="sticky-header-placeholder"></div>
<?php } ?>
<div id="sp-top-bar">
	<div class="container">
		<div class="container-inner">
			<div class="row">
				<div id="sp-top1" class="col-lg-2">
					<div class="sp-column text-center text-lg-start">
						<jdoc:include type="modules" name="top1" style="sp_xhtml"/>
					</div>
				</div>

				<div id="sp-top2" class="col-lg-10">
					<div class="sp-column text-end">
						<jdoc:include type="modules" name="top2" style="sp_xhtml" />
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<header id="sp-header" class="header-with-social">
	<div class="container">
		<div class="container-inner">
			<div class="row">
				<!-- Logo -->
				<div id="sp-logo" class="has-border col-auto">
					<div class="sp-column">
						<?php if (isset($logo->load_pos) && $logo->load_pos === 'before') : ?>
							<?php echo $logo->renderFeature(); ?>
							<jdoc:include type="modules" name="logo" style="sp_xhtml" />
						<?php else : ?>
							<jdoc:include type="modules" name="logo" style="sp_xhtml" />
							<?php echo $logo->renderFeature(); ?>
						<?php endif ?>
					</div>
				</div>

				<!-- Menu -->
				<div id="sp-menu" class="menu-with-social col-auto flex-auto">
					<div class="sp-column d-flex justify-content-between align-items-center">
						<div class="d-flex menu-wrap menu-with-offcanvas justify-content-between align-items-center flex-auto">
							<?php echo $menu->renderFeature(); ?>
							<jdoc:include type="modules" name="menu" style="sp_xhtml" />
						</div>

						<!-- Social icons -->
						<div class="social-wrap d-flex align-items-center">
							<?php echo $social->renderFeature(); ?>
						</div>
						
						<!-- Related Modules -->
						<div class="d-none d-lg-flex header-modules align-items-center rsb-search-menu">
							<?php if ($data->params->get('enable_search', 0)): ?>
								<?php echo ModuleHelper::renderModule($searchModule, ['style' => 'sp_xhtml']); ?>
							<?php endif ?>
	
							<?php if ($data->params->get('enable_login', 0)): ?>
								<?php echo $menu->renderLogin(); ?>
							<?php endif ?>
						</div>


						<!-- if offcanvas position right -->
						<?php if($offcanvas_position === 'right') : ?>
							<a id="offcanvas-toggler"  aria-label="<?php echo Text::_('HELIX_ULTIMATE_NAVIGATION'); ?>" title="<?php echo Text::_('HELIX_ULTIMATE_NAVIGATION'); ?>"  class="<?php echo $menu_type; ?> offcanvas-toggler-secondary offcanvas-toggler-right d-flex align-items-center" href="#">
							<div class="burger-icon"><span></span><span></span><span></span></div>
							</a>
						<?php endif; ?>
					</div>
				</div>
			</div>
		</div>
	</div>
</header>