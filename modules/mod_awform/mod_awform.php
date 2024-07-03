<?php

/**
 * @subpackage  mod_wkcontact
 * @copyright   Copyright (C) 2017 - Web Keys.
 * @license     GNU/GPL
 */


// Acesso ao Joomla
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;


// Controller
require_once dirname(__FILE__).'/helper.php';


// Get the document object.
$doc = JFactory::getDocument();
$app = JFactory::getApplication();
$item = modawformHelper::getItems($params);
$modal = $params->get('awType');
$user = JFactory::getUser();

// Obtém as configurações do plugin reCAPTCHA
$pluginCaptcha = PluginHelper::getPlugin('captcha', 'recaptcha');
$paramsCaptcha = false;
if ($pluginCaptcha) {
    // Obtém os parâmetros do plugin reCAPTCHA
    $paramsCaptcha = json_decode($pluginCaptcha->params);
}


// Load jquery.
if ($params->get('loadjquery', '1')) {
	JHTML::_("jquery.framework", true);
}
// Load bostrap.
if ($params->get('loadboostrap', '1')) {
	$doc->addStyleSheet(JUri::base(true).'/modules/mod_awform/assets/css/bootstrap.css');
}

// Desative o cache para este módulo
$module->cache = false;


$cAlign = $params->get('cAlign') == 'right' ? 'float:right' : ($params->get('cAlign') == 'center' ? 'margin:0 auto' : 'float:left');

$scriptVersion = uniqid();

$doc->addStyleSheet(JUri::base(true).'/modules/mod_awform/assets/css/font-awesome.min.css');
$doc->addStyleSheet(JUri::base(true).'/modules/mod_awform/assets/css/style.css?'.$scriptVersion);
$doc->addStyleSheet(JUri::base(true).'/modules/mod_awform/assets/css/awAnimate.css');
$doc->addStyleSheet(JUri::base(true).'/modules/mod_awform/assets/css/aw-loading.css');
$doc->addScript(JUri::base(true).'/modules/mod_awform/assets/js/jquery.mask.min.js');
$doc->addScript(JUri::base(true).'/modules/mod_awform/assets/js/jquery.validate.min.js');
$doc->addScript(JUri::base(true).'/modules/mod_awform/assets/js/dataCep.js?V='.$scriptVersion);
$doc->addScript(JUri::base(true).'/modules/mod_awform/assets/js/scripts.js?v='.$scriptVersion);
$doc->addScript(JUri::base(true).'/modules/mod_awform/assets/js/gerarMulti.js?v='.$scriptVersion);
$doc->addScript(JUri::base(true).'/modules/mod_awform/assets/js/editarUsuario.js?v=9');
$doc->addScript('https://www.google.com/recaptcha/api.js');


//Meu sufixo de classe de módulo.
$moduleclass_sfx = htmlspecialchars($params->get('moduleclass_sfx'));

//Carregando meu arquivo default.
require JModuleHelper::getLayoutPath('mod_awform', $params->get('layout', 'default'));

