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
use \Rsbebook\Component\Rsbebook\Site\Controller\EbooksController;
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
$canCreate  = $user->authorise('core.create', 'com_rsbebook') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'ebookform.xml');
$canEdit    = $user->authorise('core.edit', 'com_rsbebook') && file_exists(JPATH_COMPONENT .  DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'ebookform.xml');
$canCheckin = $user->authorise('core.manage', 'com_rsbebook');
$canChange  = $user->authorise('core.edit.state', 'com_rsbebook');
$canDelete  = $user->authorise('core.delete', 'com_rsbebook');


// Import CSS
$wa = $this->document->getWebAssetManager();
$wa->useStyle('com_rsbebook.list');
$wa->useScript('com_rsbebook.ebooks');
?>

<form action="<?php echo htmlspecialchars(Uri::getInstance()->toString()); ?>" method="post"
	  name="adminForm" id="adminForm">
	<?php if(!empty($this->filterForm)) { echo LayoutHelper::render('joomla.searchtools.default', array('view' => $this)); } ?>
	
		<div class="rsb-ebooks d-flex">
			<?php foreach ($this->items as $i => $item) : ?>
				<div class="ebook">
					<div class="ebook-inner">
						<div class="ebook-side ebook-front">
							<div class="ebook-image">
								<img src="<?php Juri::base(true);?>/media/com_rsbebook/img/fundo_ebook.png" data-src="<?= $item->capa;?>" />
							</div>
							<div class="ebook-title"><?= $item->title;?></div>
						</div>
					</div>
					<div class="btn-submit-ebook">
                        <a class="btn btn-azul ebookDownload" data-bs-target="#formEbook" data-bs-toggle="modal" data-title="<?= $item->title;?>" data-ebookid="<?= $item->id;?>">Download</a>
                    </div>
				</div>
			<?php endforeach; ?>
		</div>
			

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value=""/>
	<input type="hidden" name="filter_order_Dir" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>

<?php require 'defaultModal.php'; ?>

<?php

		$wa->addInlineScript("


			jQuery(document).ready(function () {

				$(document).on('click','.ebookDownload',function(event){
					event.preventDefault()
					$('#formEbook').modal('show')
					let ebookTitle = $(this).data('title');
					let ebookId = $(this).data('ebookid')
					
					$('.form-ebooks').each (function(){
						this.reset();
					  });

					$('#formEbook').find('.modal-title').text(ebookTitle)
					$('#formEbook').find('[name=\"ebookid\"]').val(ebookId)

					
				})

				$('#formEbook').on('show.bs.modal',function(event){
					let ebookId = $(this).find('[name=\"ebookid\"]').val()
					let ebookIdTarget = event.relatedTarget.getAttribute('data-ebookid')

				})

				let ebooks = $('.rsb-ebooks').find('.ebook');
				let tempo = 500
				ebooks.each(function(i){
					let ebookImage = $(this).find('img').data('src');
					let ebookSrc = $(this).find('img')
					ebookSrc.attr('src',ebookImage)

						ebookSrc.addClass('animate__animated animate__fadeIn')
				})

				$( document ).on('mouseover','.ebook',function(){
					$(this).find('.ebook-back').show().addClass('animate__animated animate__fadeInUpBig').removeClass('animate__fadeOutLeft')
				})

				/*$( document ).on('mouseleave','.ebook',function(){
					$(this).find('.ebook-content').addClass('animate__animated animate__fadeOutLeft').removeClass('animate__fadeInLeft')
				})*/


				function modalCheck(sel,selOk,selModal,tggle){
					$(document).on('change',sel,function(event){
					
					if(!$(this).is(':checked')){
					  $(this).val('')
						return false;
					}
				  
					let selInput = $(this)
					/*$(selModal).modal({
					  fadeDuration: 100
					});*/
					  $(selModal).modal('show')
					  $(tggle).modal('hide')
					  $(this).filter(':checkbox').prop('checked',false)	
					})
				  
					 $(document).on('click',selOk,function(event,tggle){
						event.preventDefault()
						$(selModal).modal('hide')
						$(tggle).modal('show')
						$(sel).filter(':checkbox').prop('checked',true)
						$(sel).val('termo')
					 })
				  }

				  modalCheck('[name=\"aceitar-termos-licenca\"]','.aceiteOk','#exampleModalToggle2','#formEbook')
				
			});
		");

?>