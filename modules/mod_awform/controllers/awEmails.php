
<?php

/**
 * @package     
 * @subpackage  mod AwForm
 **/

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Database\DatabaseFactory;
use Joomla\CMS\Mail\Mail;

/********
 Classe Aw Captcha.
 Desenvolvido por Carlos (IBS WEB)
********/

class awEmails {

	public static function setEmail($iPosts,$iFiles,&$params,$bodyText,$subject,$recipient)
	{
		$mail = Factory::getMailer();
		$user = Factory::getUser();

		//Recuperando dados do corpo do e-mail.
		$emailData = $bodyText;

		//Recipiente
		$recipient = explode(',',$recipient);
		$recipient = count($recipient) == 1 ? $recipient[0] : $recipient;

		//BCC
		$bcc = $params->get('mailbcc');
		$bcc = explode(',',$bcc);
		$bcc = count($bcc) == 1 ? $bcc[0] : $bcc; 

		//Vars Inputs
		$queryString = http_build_query($iPosts);
		parse_str($queryString, $queryArray);
		extract($queryArray); //Vars
		
		$awModalDbCondValue = $params->get('awModalDbCondValue');
	
		//Vars awModalDb
		$awModalDb = array();
		if($params->get('awModalDb') && $params->get('awModalDbCond') && $params->get('awModalDbCondValue')){
			$awModalDb = (array)awDbController::awModalDb($params,$$awModalDbCondValue);
			extract($awModalDb);
		}

		//Vars Files
		parse_str(http_build_query($iFiles),$queryFilesArray);
		extract($queryFilesArray);

		$subject = awUtilitario::gerarVarText($subject,$queryArray,$awModalDb);

		/********************
		 *Var Globais
		********************/
		$globModId = explode('-',$moduleId);
		$globModId = $globModId[1];

		$userName = $user->name;
		$userEmail = $user->email;

		$awToken 	= $_SESSION['awToken'];
		$urlParametro = count(explode('?',$awCurrent)) > 1 ? '&' : '?';
		//Cofnirmar
		$awConfirm = $awCurrent.$urlParametro.'awConfirm&formId='.$globModId.'&awToken='.$awToken;

		$awTokenAdm = $awCurrent.'?awEdit&awId='.$globModId.'&awToken='.$awToken;
		$awGPdf 	= $awCurrent.'?pdf&awId='.$globModId.'&awToken='.$awToken;
		$awToken 	= '<a style="width: auto!important;
		color: #fff;
		padding: 10px 14px;
		display: inline-block;
		line-height: 1;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none;
		background: #2196f3;
		border: 0 solid silver;
		cursor: pointer;
		border-radius: 4px;" href="'.$awTokenAdm.'" target="_blank">Editar os Dados</a>';

		$awPdf 	= '<a style="width: auto!important;
		color: #fff;
		padding: 10px 14px;
		display: inline-block;
		line-height: 1;
		font-size: 13px;
		font-weight: 700;
		text-decoration: none;
		background: #4ba55f;
		border: 0 solid silver;
		cursor: pointer;
		border-radius: 4px;" href="'.$awGPdf.'" target="_blank">Gerar PDF</a>';

		//Carregando texto do body.
		preg_match_all("/{(.+)}/U", $emailData, $text);

		/********************
		 * Capturando as imagens e alterando o caminho para o caminho real.
		********************/
		preg_match_all("/src=\"(.+?)\"/", $emailData, $imgsData);
		$setImgs = array();

		foreach($imgsData[1] as $img)
		{
			array_push($setImgs,JUri::base().$img);
		}

		//Vars Body email
		$varBody = array();
		$varText = array();
		foreach($text[1] as $k=> $var)
		{
			//Capturando o type da variavel, separando por |
			//extract(awUtilitario::getVarType($var,$$var));
			$bodyVars = $$var;

			if(is_array($bodyVars))
			{
				if(awUtilitario::is_multi_array($bodyVars)){
					$bodyVars = json_encode($bodyVars);

					/*echo awUtilitario::awMessages(modawformHelper::variosDados(json_decode($bodyVars,true)));
					return;*/
					
					if(is_array(json_decode($bodyVars,true))){
						$bodyVars = awUtilitario::variosDados(json_decode($bodyVars,true));
					}
				}else{
					$bodyVars = implode(', ',$bodyVars);
				}
			}
			else
			{
				$bodyVars = $bodyVars;
			}
			array_push($varBody,$bodyVars);
		}


		$bodyEmail = str_replace($text[0],$varBody,$emailData);

		//Debugar body e-mail
		if($params->get('debugarEmail')){
			echo $bodyEmail;
			exit();
		}
		
		
		//Alterando as imagens.
		if(!empty(count(array_filter($imgsData))))
		{
			$bodyEmail = str_replace($imgsData[1],$setImgs,$bodyEmail);
		}
		
		$message = self::bodyEmail($subject,$bodyEmail);
		
		// Configurações do servidor SMTP
        $config = Factory::getConfig();
		$mailer = $config->get('mailer');

		if($mailer == 'smtp'){
			$mail = Mail::getInstance($mailer);
			$sender = array($config->get('mailfrom'), $config->get('fromname'));
		}else{
			$sender = array($params->get('emailsender'), $params->get('namesender'));
		}

		
		$mail->setSender($sender);
		
		if(empty($recipient)){
			echo awUtilitario::awMessages('Campo recipiente não pode estar vázio','danger');
			return false;
		}
		
		if($bcc)
			$mail->AddBCC($bcc);
		$mail->addRecipient($recipient);
		$mail->setSubject($subject);
		$mail->isHTML(true);
		$mail->Encoding = 'base64';
		$mail->setBody($message);

		
		
		//files
		if($params->get('exAtta'))
		{
			foreach($iFiles as $fk=> $file){
				$mail->addAttachment($file['tmp_name'],$file['name']);
			}
		}
			
		
		if($mail->Send())
		{
			return true;
		}
		else
		{
			echo awUtilitario::awMessages('Falha ao enviar e-mail','danger');
			return false;
		}
	}

	public static function emailConfirmacao($sDb,$token,$params,$variaveisGlobais = array())
	{

		$mail = Factory::getMailer();

		//Recuperando dados do corpo do e-mail.
		$emailData = $params->get('bodyuserconfirm');

		//Variáveis do banco de dados pelo token.
		$variaveisDB = (array) awDbController::getConfirmDados($sDb,$token)[0];
		//removendo variaveis do array
		unset($variaveisDB['params']);
		extract($variaveisDB);

		//Variáveis Globais
		extract($variaveisGlobais);

		if(!$params->get('confirmDadosCampo')){
			return false;
		}

		$subject = $params->get('confirmDadosSubject') ?? 'Confirmação de E-mail';

		//texto {var} exemplo {outravar}
		$subject = awUtilitario::gerarVarText($subject,$variaveisGlobais,$variaveisDB);

		$dadoRecipiente = $params->get('confirmDadosCampo');

		//Recipiente
		$recipient = $$dadoRecipiente;

		//Carregando texto do body.
		preg_match_all("/{(.+)}/U", $emailData, $text);

		/********************
		 * Capturando as imagens e alterando o caminho para o caminho real.
		********************/
		preg_match_all("/src=\"(.+?)\"/", $emailData, $imgsData);
		$setImgs = array();

		foreach($imgsData[1] as $img)
		{
			array_push($setImgs,JUri::base().$img);
		}

		//Vars Body email
		$varBody = array();
		$varText = array();
		foreach($text[1] as $k=> $var)
		{

			$bodyVars = $$var;

			if(is_array($bodyVars))
			{
				if(awUtilitario::is_multi_array($bodyVars)){
					$bodyVars = json_encode($bodyVars);
					
					if(is_array(json_decode($bodyVars,true))){
						$bodyVars = awUtilitario::variosDados(json_decode($bodyVars,true));
					}
				}else{
					$bodyVars = implode(', ',$bodyVars);
				}
			}
			else
			{
				$bodyVars = $bodyVars;
			}
			array_push($varBody,$bodyVars);
		}


		$bodyEmail = str_replace($text[0],$varBody,$emailData);
		
		//Alterando as imagens.
		if(!empty(count(array_filter($imgsData))))
		{
			$bodyEmail = str_replace($imgsData[1],$setImgs,$bodyEmail);
		}
		
		$message = self::bodyEmail($subject,$bodyEmail);
		
		// Configurações do servidor SMTP
        $config = Factory::getConfig();
        $mail = Mail::getInstance('smtp');

		//$sender = array($params->get('emailsender'), $params->get('namesender'));
		$sender = array($config->get('mailfrom'), $config->get('fromname'));
		$mail->setSender($sender);
		if($bcc)
			$mail->AddBCC($bcc);
		$mail->addRecipient($recipient);
		$mail->setSubject($subject);
		$mail->isHTML(true);
		$mail->Encoding = 'base64';
		$mail->setBody($message);
		

		if($mail->Send())
		{	
			return true;
		}
		else
		{
			echo awUtilitario::awMessages('Falha ao enviar e-mail','danger');
			return false;
		}
	}

		public static function bodyEmail($subject,$bodyEmail){

			$message = 	'<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">';
			$message .= '<html xmlns="http://www.w3.org/1999/xhtml">';
			$message .= '<head>';
			$message .= '<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />';
			$message .= '<title>'.$subject.'</title>';
			$message .= '</head>';
			$message .= '<body>';
			$message .= $bodyEmail;
			$message .= '</body>';
			$message .= '</html>';

			return $message;
		}
		
}