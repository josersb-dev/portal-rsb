<?php

/**
 * @subpackage  mod_wkcontact
 * @copyright   Copyright (C) 2017 - Web Keys.
 * @license     GNU/GPL
 */


// Acesso ao Joomla
defined('_JEXEC') or die;

use Joomla\CMS\Uri\Uri;
$uri = Uri::getInstance();

$moduleId = 'awForm-'.$module->id;

$classHelper = new modawformHelper;
//$renderCaptcha = modawformHelper::awCaptchaAjax(null,$params->get('awcaptcha'),$module->id);
?>

<form action="" class="aw-form" method="post" id="<?= $moduleId;?>" <?= $modal == 'modal' ? 'style="display: none"': null;?> <?= $modal == 'modal' ? 'class="awModalForm"': null;?>>
	<div class="aw-form-fields">
		<?php awRender::getDados($params->get('awform'),$module->id,null,$params); ?>
	sssss
	<div class="aw-form-status" style="display:none"></div>
	<input type="hidden" name="awCurrent" value="<?= $uri->toString();?>" >
	<div class="g-recaptcha" ></div>
</div>
</form>

<script type="text/javascript">
	jQuery(function($){
		$( document ).ready(function(){
			$( '#<?= $moduleId;?>' ).valid({
				formId: '#<?= $moduleId;?>',
				idForm: '<?= $module->id;?>',
				modalForm: <?= $modal == 'modal' ? 'true' : 'false';?>,
				captAlign: '<?= $cAlign;?>',
				divParent: '.sp-module'
			})
		})
	})
</script>

<?php /*
<a class="awFormModal" data-title="Da Escola para a Universidade" data-subtitle="Preencha os dados abaixo e receba o e-book em seu e-mail!" data-id="25" href="136">Modal Form</a>


<button class="btn btn-primary awCheckModal" data-title="Como é amigo">Open first modal</button>

*/?>