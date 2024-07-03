<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Rsbebook
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

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');
HTMLHelper::_('bootstrap.tooltip');
?>

<form
	action="<?php echo Route::_('index.php?option=com_rsbebook&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="ebook-form" class="form-validate form-horizontal">

	<div class="row title-alias form-vertical mb-3">
    <div class="col-12 col-md-6">
        <?php echo $this->form->renderField('title'); ?>
    </div>
    <div class="col-12 col-md-6">
        <?php echo $this->form->renderField('alias'); ?>
    </div>
</div>
	
<div class="main-card">
	<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'ebook')); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'ebook', Text::_('COM_RSBEBOOK_TAB_EBOOK', true)); ?>
	<div class="row-fluid">
		<div class="col-md-12 form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo Text::_('COM_RSBEBOOK_FIELDSET_EBOOK'); ?></legend>
				
				<?php echo $this->form->renderField('capa'); ?>
				<?php echo $this->form->renderField('descricao'); ?>
				<?php echo $this->form->renderField('arquivo'); ?>
				<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
				<?php endif; ?>
				<?php echo $this->form->renderField('data'); ?>
			</fieldset>
		</div>
	</div>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>
	<input type="hidden" name="jform[id]" value="<?php echo $this->item->id; ?>" />
	<input type="hidden" name="jform[state]" value="<?php echo $this->item->state; ?>" />
	<input type="hidden" name="jform[ordering]" value="<?php echo $this->item->ordering; ?>" />
	<input type="hidden" name="jform[checked_out]" value="<?php echo $this->item->checked_out; ?>" />
	<input type="hidden" name="jform[checked_out_time]" value="<?php echo $this->item->checked_out_time; ?>" />
	<?php echo $this->form->renderField('created_by'); ?>
	<?php echo $this->form->renderField('modified_by'); ?>

	
	<?php echo HTMLHelper::_('uitab.endTabSet'); ?>

	<input type="hidden" name="task" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>
				</div>

</form>
