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

$wa = $this->document->getWebAssetManager();
$wa->useScript('keepalive')
	->useScript('form.validate');
HTMLHelper::_('bootstrap.tooltip');
?>

<form
	action="<?php echo Route::_('index.php?option=com_noticias&layout=edit&id=' . (int) $this->item->id); ?>"
	method="post" enctype="multipart/form-data" name="adminForm" id="item-form" class="form-validate form-horizontal">

	<div class="row title-alias form-vertical mb-3">
		<div class="col-12 col-md-6"><?php echo $this->form->renderField('titulo'); ?></div>
		<div class="col-12 col-md-6"><?php echo $this->form->renderField('slug'); ?></div>
	</div>

	
	<?php echo HTMLHelper::_('uitab.startTabSet', 'myTab', array('active' => 'item')); ?>
	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'item', Text::_('COM_NOTICIAS_TAB_ITEM', true)); ?>
	<div class="row form-vertical">
		<div class="col-lg-9">
			<?php echo $this->form->renderField('texto'); ?>
		</div>
		<div class="col-lg-3">
			<?php echo $this->form->renderField('state'); ?>
			<?php echo $this->form->renderField('id_segmento'); ?>
			<?php echo $this->form->renderField('destaque'); ?>
			<?php if ($this->state->params->get('save_history', 1)) : ?>
				<div class="control-group">
					<div class="control-label"><?php echo $this->form->getLabel('version_note'); ?></div>
					<div class="controls"><?php echo $this->form->getInput('version_note'); ?></div>
				</div>
			<?php endif; ?>
		</div>
	</div>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>

	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'imagem', Text::_('Imagem', true)); ?>
	<div class="row form-vertical">
		<div class="col-lg-6">
			<fieldset id="fieldset-publishingdata" class="options-form">
				<legend>Imagem de Introdução</legend>
				<div>
					<?php echo $this->form->renderField('imagem'); ?>
				</div>
			</fieldset>
		</div>
		<div class="col-lg-6">
			<fieldset id="fieldset-publishingdata" class="options-form">
				<legend>Resumo</legend>
				<div>
					<?php echo $this->form->renderField('resumo'); ?>
					<?php echo $this->form->renderField('legenda'); ?>
				</div>
			</fieldset>
		</div>

		
	</div>
	<?php echo HTMLHelper::_('uitab.endTab'); ?>

	<?php echo HTMLHelper::_('uitab.addTab', 'myTab', 'publicacao', Text::_('Publicação', true)); ?>
	<div class="row form-vertical">
		<div class="col-lg-12">
		<fieldset id="fieldset-publishingdata" class="options-form">
			<legend>Publicação</legend>
			<div>
				<?php echo $this->form->renderField('data'); ?>
				<?php echo $this->form->renderField('publicar_em'); ?>
			</div>
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

</form>
