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

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');
HTMLHelper::_('bootstrap.tooltip');
?>

<form
	action="<?php echo Route::_('index.php?option=com_acervosalesiano&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="item-form" class="form-validate form-horizontal">

	<div class="row title-alias form-vertical mb-3">
		<div class="col-12 col-md-6">
			<?php echo $this->form->renderField('title'); ?>
		</div>
		<div class="col-12 col-md-6">
			<?php echo $this->form->renderField('alias'); ?>
		</div>
	</div>	
	<div class="main-card">
	<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'descricao')); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'descricao', Text::_('Descrição', true)); ?>
	<div class="row">
		<div class="col-12 col-lg-10">
			<?php echo $this->form->getInput('descricao');?>
		</div>
		<div class="col-12 col-lg-2 form-vertical">
		<?= $this->form->renderFieldset('lateral');?>
		</div>
	</div>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>

	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'item', Text::_('Item', true)); ?>
	<div class="row">
		<div class="col-12 col-lg-6">
		<fieldset id="fieldset-editor" class="options-form">
			<legend><?php echo Text::_('Item'); ?></legend>
			<div class="form-grid">
				<?= $this->form->renderFieldset('aba1');?>
			</div>
        </fieldset>
			
		</div>
		<div class="col-12 col-lg-6">
		<fieldset id="fieldset-editor" class="options-form">
			<legend><?php echo Text::_('Datas'); ?></legend>
			<div class="form-grid">
				<?= $this->form->renderFieldset('aba2');?>
			</div>
        </fieldset>
		</div>
	</div>
	<div class="row-fluid">
		<div class="col-md-12 form-horizontal">
			<fieldset class="adminform">
				<legend><?php echo Text::_('COM_ACERVOSALESIANO_FIELDSET_ITEM'); ?></legend>
				
				
				
				
				<?php if ($this->state->params->get('save_history', 1)) : ?>
					<div class="control-group">
						<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
						<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
					</div>
				<?php endif; ?>
			</fieldset>
		</div>
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

</form>
