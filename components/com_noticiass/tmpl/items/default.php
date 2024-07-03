<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Noticias
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2022 José Carlos Ferreira
 * @license    GNU General Public License version 2 or later; see LICENSE.txt
 */
// No direct access
defined('_JEXEC') or die;

use \Joomla\CMS\HTML\HTMLHelper;
use \Joomla\CMS\Factory;
use \Joomla\CMS\Uri\Uri;
use \Joomla\CMS\Router\Route;
use \Joomla\CMS\Language\Text;
use \Joomla\CMS\Layout\LayoutHelper;
use \Joomla\CMS\Session\Session;
use \Joomla\CMS\User\UserFactoryInterface;

HTMLHelper::_('bootstrap.tooltip');
HTMLHelper::_('behavior.multiselect');
HTMLHelper::_('formbehavior.chosen', 'select');

$user       = Factory::getApplication()->getIdentity();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_noticias') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'itemform.xml');
$canEdit    = $user->authorise('core.edit', 'com_noticias') && file_exists(JPATH_COMPONENT .  DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'itemform.xml');
$canCheckin = $user->authorise('core.manage', 'com_noticias');
$canChange  = $user->authorise('core.edit.state', 'com_noticias');
$canDelete  = $user->authorise('core.delete', 'com_noticias');

// Import CSS
$wa = $this->document->getWebAssetManager();
$wa->useStyle('com_noticias.list');
?>



<form action="<?php echo htmlspecialchars(Uri::getInstance()->toString()); ?>" method="post"
	  name="adminForm" id="adminForm">
	<?php if(!empty($this->filterForm)) { echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); } ?>
	<div class="table-responsive">
		<table class="table table-striped" id="itemList">
			<thead>
			<tr>
				
					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_NOTICIAS_ITEMS_ID', 'a.id', $listDirn, $listOrder); ?>
					</th>

					<th >
						<?php echo HTMLHelper::_('grid.sort', 'JPUBLISHED', 'a.state', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_NOTICIAS_ITEMS_DESTAQUE', 'a.destaque', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_NOTICIAS_ITEMS_TITULO', 'a.titulo', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_NOTICIAS_ITEMS_ID_SEGMENTO', 'a.id_segmento', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_NOTICIAS_ITEMS_RESUMO', 'a.resumo', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_NOTICIAS_ITEMS_DATA', 'a.data', $listDirn, $listOrder); ?>
					</th>

					<th class=''>
						<?php echo HTMLHelper::_('grid.sort',  'COM_NOTICIAS_ITEMS_PUBLICAR_EM', 'a.publicar_em', $listDirn, $listOrder); ?>
					</th>

						<?php if ($canEdit || $canDelete): ?>
					<th class="center">
						<?php echo Text::_('COM_NOTICIAS_ITEMS_ACTIONS'); ?>
					</th>
					<?php endif; ?>

			</tr>
			</thead>
			<tfoot>
			<tr>
				<td colspan="<?php echo isset($this->items[0]) ? count(get_object_vars($this->items[0])) : 10; ?>">
					<div class="pagination">
						<?php echo $this->pagination->getPagesLinks(); ?>
					</div>
				</td>
			</tr>
			</tfoot>
			<tbody>
			<?php foreach ($this->items as $i => $item) : ?>
				<?php $canEdit = $user->authorise('core.edit', 'com_noticias'); ?>
				
				<tr class="row<?php echo $i % 2; ?>">
					
					<td>
						<?php echo $item->id; ?>
					</td>
					<td>
						<?php $class = ($canChange) ? 'active' : 'disabled'; ?>
						<a class="btn btn-micro <?php echo $class; ?>" href="<?php echo ($canChange) ? JRoute::_('index.php?option=com_noticias&task=item.publish&id=' . $item->id . '&state=' . (($item->state + 1) % 2), false, 2) : '#'; ?>">
						<?php if ($item->state == 1): ?>
							<i class="icon-publish"></i>
						<?php else: ?>
							<i class="icon-unpublish"></i>
						<?php endif; ?>
						</a>
					</td>
					<td>
						<?php echo $item->destaque; ?>
					</td>
					<td>
						<?php echo $item->titulo; ?>
					</td>
					<td>
						<?php echo $item->id_segmento_name; ?>
					</td>
					<td>
						<?php echo $item->resumo; ?>
					</td>
					<td>
						<?php echo $item->data; ?>
					</td>
					<td>
						<?php echo $item->publicar_em; ?>
					</td>
					<?php if ($canEdit || $canDelete): ?>
						<td class="center">
						</td>
					<?php endif; ?>

				</tr>
			<?php endforeach; ?>
			</tbody>
		</table>
	</div>
	<?php if ($canCreate) : ?>
		<a href="<?php echo Route::_('index.php?option=com_noticias&task=itemform.edit&id=0', false, 0); ?>"
		   class="btn btn-success btn-small"><i
				class="icon-plus"></i>
			<?php echo Text::_('COM_NOTICIAS_ADD_ITEM'); ?></a>
	<?php endif; ?>

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value=""/>
	<input type="hidden" name="filter_order_Dir" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>

<?php
	if($canDelete) {
		$wa->addInlineScript("
			jQuery(document).ready(function () {
				jQuery('.delete-button').click(deleteItem);
			});

			function deleteItem() {

				if (!confirm(\"" . Text::_('COM_NOTICIAS_DELETE_MESSAGE') . "\")) {
					return false;
				}
			}
		", [], [], ["jquery"]);
	}
?>