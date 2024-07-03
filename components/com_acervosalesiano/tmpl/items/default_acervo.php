<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Acervosalesiano
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Session\Session;
use Joomla\Utilities\ArrayHelper;
use Joomla\CMS\Menu\Menu;

use Acervosalesiano\Component\Acervosalesiano\Site\View\Item\HtmlView;

$viewItem = new HtmlView();


$input = JFactory::getApplication()->input;
$doc = JFactory::getDocument();

$doc->addStyleSheet(Juri::base('true').'/media/com_acervosalesiano/css/list.css?'.uniqid());
$doc->addScript(Juri::base('true').'/media/com_acervosalesiano/js/menuMobile.js?'.uniqid());

$menu = Factory::getApplication()->getMenu();
$active = $menu->getActive();

//Parametros do menu
$params = $active->getParams();

$type = $params->get('tipo');
$tratamento = $params->get('tratamento');

$alias = $input->get('alias');
$catid = $input->get('catid');

$catidDownloads = $viewItem->getCatDownloadsId($input->get('catid'),$alias)[0]->id;

$salesianosNav = $type === 'download' ? $viewItem->getCategoryDownload($catid) : $viewItem->getSelesianos($catid);
$acervo =   $type === 'download' ? $viewItem->getSelesianos($catidDownloads) : $viewItem->getSelesiano($alias,$catid);

$totalItems = count($acervo);
$classNoItem = $totalItems === 0 ? ' no-items ' : '';
?>

<div class="acervo-salesiano">
	<div class="acervo-nav <?= $classNoItem; ?>">
		<ul>
			<?php foreach ($salesianosNav as $nav) : ?>
				<?php 
					$link = $type === 'download' ? 
						JRoute::_("index.php?option=com_acervosalesiano&view=items&catid=$nav->parent_id")."/$nav->alias":
						JRoute::_("index.php?option=com_acervosalesiano&view=items&catid=$nav->categoria")."/$nav->alias";

					$linkActive = $nav->alias === $alias ? 'active' : '';
				?>
				<li class="<?=$linkActive;?>">
					<a href="<?=$link;?>?open" class="<?=$linkActive;?>">
						<span><?= $nav->title;?></span>
						<span class="tag-icon"><i class="fas fa-chevron-right"></i></span>
					</a>
				</li>
			<?php endforeach; ?>
		</ul>
	</div>
	<div class="acervo-content">
		<div class="acervo-content-inner">
			<div class="menu-acervo-mobile">
				
			</div>
			<?php 
				$type === 'santidade' ? require_once('default_santidade.php') : (
				$type === 'download' ? require_once('default_downloads.php')  :
				require_once('default_frases.php')
				);
			?>
		</div>
	</div>
</div>

<?php 

$doc->addScriptDeclaration("
jQuery(function($){
	$( document ).ready( function() {
		let dataCor = $('#rsb-padrao-category').find('a.active').data('color')
		$('.acervo-nav').find('a').addClass(dataCor)

		let backColorHover = dataCor.replace('color','background')

		criarNavResponsivo('.acervo-nav ul', '.menu-acervo-mobile')
		$('.menu-acervo-mobile').find('.itemInicio').addClass(dataCor)
		$('.menu-acervo-mobile').find('ul li a').addClass(backColorHover).removeClass(dataCor)
	})

	const animeScroll = function(el, tmp, offTop) {
        const \$doc = $('html, body');
        const \$el = $(el);
  
        if (\$el.length === 0) {
          console.error('Element not found:', el);
          return;
        }
  
        const elTop = \$el.offset().top;
  
        if (isNaN(elTop)) {
          console.error('Invalid element position:', el);
          return;
        }
  
        \$doc.animate(
          {
            scrollTop: elTop - offTop,
          },
          tmp
        );
      };

      animeScroll('#acervo-salesiano',500,500)
})
");