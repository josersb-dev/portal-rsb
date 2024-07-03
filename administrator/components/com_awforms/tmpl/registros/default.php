<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Awforms
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
use \Joomla\CMS\Layout\LayoutHelper;
use \Joomla\CMS\Language\Text;
use Joomla\CMS\Session\Session;

HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('behavior.multiselect');

// Import CSS
$wa =  $this->document->getWebAssetManager();
$wa->useStyle('com_awforms.admin')
    ->useScript('com_awforms.admin');

$user      = Factory::getApplication()->getIdentity();
$userId    = $user->get('id');
$listOrder = $this->state->get('list.ordering');
$listDirn  = $this->state->get('list.direction');
$canOrder  = $user->authorise('core.edit.state', 'com_awforms');

$saveOrder = $listOrder == 'a.ordering';

if (!empty($saveOrder))
{
	$saveOrderingUrl = 'index.php?option=com_awforms&task=registros.saveOrderAjax&tmpl=component&' . Session::getFormToken() . '=1';
	HTMLHelper::_('draggablelist.draggable');
}

$dados = json_decode($this->getDados())->fields;
//usort($dados);
?>

<script>
	jQuery(function($){
		$('[aria-label="Componentes"]').parents('ul').addClass('child-open')
		$('[aria-label="Componentes"]').parent('li').addClass('mm-active').addClass('open')
		$('[aria-label="Componentes"]').parent('li').find('ul.collapse-level-1').addClass('mm-show')
		$('[aria-label="Componentes"]').parent('li').find('[href="index.php?option=com_awforms"]').parent('li').addClass('mm-active').find('ul').addClass('mm-show')
	})
</script>

<form action="<?php echo Route::_('index.php?option=com_awforms&view=registros'); ?>" method="post"
	  name="adminForm" id="adminForm">
	<div class="row">
		<div class="col-md-12">
			<div id="j-main-container" class="j-main-container">
			<?php echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); ?>

				<div class="clearfix"></div>
				<table class="table table-striped" id="registroList">
					<thead>
					<tr>
						<th scope="col" class="w-1 text-center">
							<input type="checkbox" autocomplete="off" class="form-check-input" name="checkall-toggle" value=""
								   title="<?php echo Text::_('JGLOBAL_CHECK_ALL'); ?>" onclick="Joomla.checkAll(this)"/>
						</th>
						
					<?php if (isset($this->items[0]->ordering)): ?>
					<th scope="col" class="w-1 text-center d-none d-md-table-cell">

					<?php echo HTMLHelper::_('searchtools.sort', '', 'a.ordering', $listDirn, $listOrder, null, 'asc', 'JGRID_HEADING_ORDERING', 'icon-menu-2'); ?>

					</th>
					<?php endif; ?>

						
					<th  scope="col" class="w-1 text-center">
						<?php echo HTMLHelper::_('searchtools.sort', 'JSTATUS', 'a.state', $listDirn, $listOrder); ?>
					</th>
						
					
					<?php $k = 0;?>
					<?php foreach($dados as $v):?>
						<?php if(!preg_match('/\[[^\]]*\]/', $v->attrs->name) and !$v->config->hideLabel): ?>
						<th  scope="col" class="<?= $k === 0 ? '' : 'w-10';?>">
								<?= $v->config->hideLabel;?>
							<?php echo JHtml::_('searchtools.sort', $v->config->label, 'a.'.$v->attrs->name, $listDirn, $listOrder); ?>
						
						</th>
					<?php endif;?>
					<?php $k++;?>
					<?php endforeach; ?>

					<th scope="col" class="w-3 d-none d-lg-table-cell" >
						<?php echo HTMLHelper::_('searchtools.sort',  'JGRID_HEADING_ID', 'a.id', $listDirn, $listOrder); ?>
					</th>
					</tr>

					</thead>
					<tfoot>
					<tr>
						<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
							<?php echo $this->pagination->getListFooter(); ?>
						</td>
					</tr>
					</tfoot>
					<tbody <?php if (!empty($saveOrder)) :?> class="js-draggable" data-url="<?php echo $saveOrderingUrl; ?>" data-direction="<?php echo strtolower($listDirn); ?>" <?php endif; ?>>
					<?php foreach ($this->items as $i => $item) :
						$ordering   = ($listOrder == 'a.ordering');
						$canCreate  = $user->authorise('core.create', 'com_awforms');
						$canEdit    = $user->authorise('core.edit', 'com_awforms');
						$canCheckin = $user->authorise('core.manage', 'com_awforms');
						$canChange  = $user->authorise('core.edit.state', 'com_awforms');
						?>
						<tr class="row<?php echo $i % 2; ?>" data-draggable-group='1' data-transition>
							<td class="text-center">
								<?php echo HTMLHelper::_('grid.id', $i, $item->id); ?>
							</td>
							
							<?php if (isset($this->items[0]->ordering)) : ?>

							<td class="text-center d-none d-md-table-cell">

							<?php

							$iconClass = '';

							if (!$canChange)

							{
								$iconClass = ' inactive';

							}
							elseif (!$saveOrder)

							{
								$iconClass = ' inactive" title="' . Text::_('JORDERINGDISABLED');

							}							?>							<span class="sortable-handler<?php echo $iconClass ?>">
							<span class="icon-ellipsis-v" aria-hidden="true"></span>
							</span>
							<?php if ($canChange && $saveOrder) : ?>
							<input type="text" name="order[]" size="5" value="<?php echo $item->ordering; ?>" class="width-20 text-area-order hidden">
								<?php endif; ?>
							</td>
							<?php endif; ?>

							
							<td class="text-center">
								<?php echo HTMLHelper::_('jgrid.published', $item->state, $i, 'registros.', $canChange, 'cb'); ?>
							</td>
							
					
							<?php foreach($dados as $v):?>
								<?php if(!preg_match('/\[[^\]]*\]/', $v->attrs->name) and !$v->config->hideLabel): ?>
								<td>
									<?php echo $item->{$v->attrs->name}; ?>
								</td>
							<?php endif; ?>
							<?php endforeach; ?>
							<td class="w-5">
							<?php echo $item->id; ?>

							</td>

						</tr>
					<?php endforeach; ?>
					</tbody>
				</table>

				<input type="hidden" name="task" value=""/>
				<input type="hidden" name="boxchecked" value="0"/>
				<input type="hidden" name="list[fullorder]" value="<?php echo $listOrder; ?> <?php echo $listDirn; ?>"/>
				<?php echo HTMLHelper::_('form.token'); ?>
			</div>
		</div>
	</div>
</form>