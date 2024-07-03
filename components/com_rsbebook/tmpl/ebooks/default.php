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

use Joomla\CMS\MVC\Controller\BaseController;
use Joomla\CMS\MVC\Model\BaseDatabaseModel;
use Joomla\CMS\Mailer\Mailer;
use Joomla\CMS\Mailer\MailerHelper;
use Joomla\CMS\Table\Table;
use Joomla\CMS\Log\Log;

HTMLHelper::_('bootstrap.tooltip');
//HTMLHelper::_('behavior.multiselect');
//HTMLHelper::_('formbehavior.chosen', 'select');

$user       = Factory::getApplication()->getIdentity();
$userId     = $user->get('id');
$listOrder  = $this->state->get('list.ordering');
$listDirn   = $this->state->get('list.direction');
$canCreate  = $user->authorise('core.create', 'com_rsbebook') && file_exists(JPATH_COMPONENT . DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'ebookform.xml');
$canEdit    = $user->authorise('core.edit', 'com_rsbebook') && file_exists(JPATH_COMPONENT .  DIRECTORY_SEPARATOR . 'forms' . DIRECTORY_SEPARATOR . 'ebookform.xml');
$canCheckin = $user->authorise('core.manage', 'com_rsbebook');
$canChange  = $user->authorise('core.edit.state', 'com_rsbebook');
$canDelete  = $user->authorise('core.delete', 'com_rsbebook');


/*$concentimentoUso = EbooksController::getTermos(8563);
echo $concentimentoUso->title;*/

// Defina o destinatário, assunto, corpo do e-mail e o caminho do anexo
$recipient = 'jose.paula@rsb.org.br';
$subject = 'Assunto do e-mail';
$body = 'Corpo do e-mail';
$attachmentPath = '/caminho/para/seu/arquivo.pdf';

// Chame a função para enviar o e-mail com o anexo
//EbooksController::enviarEmailSMTP($recipient, $subject, $body);


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
                        <!--a class="btn btn-azul ebookDownload" data-bs-target="#formEbook" data-bs-toggle="modal" data-title="//$item->title" data-ebookid="$item->id">Download</a-->
						<a 
							class="btn btn-azul awFormModal"
							data-title="<?= $item->title;?>" 
							data-subtitle="Preencha os dados abaixo e receba o e-book em seu e-mail!" 
							data-id="<?= $item->id;?>" 
							href="136">
								Download
							</a>
                    </div>
				</div>
			<?php endforeach; ?>


			<?php 

				if(!count($this->items)){
					echo '<div class="alert alert-info">Nenhum item encontrado.</div>';
				}
				
			?>
		</div>
		<div class="pagination">
			<?php echo $this->pagination->getPagesLinks(); ?>
		</div>
			

	<input type="hidden" name="task" value=""/>
	<input type="hidden" name="boxchecked" value="0"/>
	<input type="hidden" name="filter_order" value=""/>
	<input type="hidden" name="filter_order_Dir" value=""/>
	<?php echo HTMLHelper::_('form.token'); ?>
</form>

<?php require 'defaultModal.php'; ?> 