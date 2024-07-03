<?php

/**
 * @subpackage  mod_wkcontact
 * @copyright   Copyright (C) 2017 - Web Keys.
 * @license     GNU/GPL
 */


// Acesso ao Joomla
defined('_JEXEC') or die;



echo '<div class="aw-confirm">';
$moduleId = 'awForm-'.$module->id;
$siteUrl = '<a href="'.Juri::base().'" target="_blank">'.Juri::base().'</a>';

if(!$params->get('exConfirmarDados')){
	echo 'Não ativo';
	exit();
}


if(!awDbController::atualizarDados($params->get('db'),$_GET['awToken'],$params)){
	echo 'Token Inválido';
}else{
	echo $params->get('confirmDadosMensagem');

	//Notificação após concluir a confirmação
	if($params->get('exConfirmDadosNotificacao')){
		awEmails::emailConfirmacao($params->get('db'),$_GET['awToken'],$params,['siteUrl' => $siteUrl]);
	}

	//Removendo token
	awDbController::removeToken($params->get('db'),$_GET['awToken'],$params);
}

echo '</div>';