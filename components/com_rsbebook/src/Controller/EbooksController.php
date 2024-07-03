<?php
/**
 * @version    CVS: 1.0.0
 * @package    Com_Rsbebook
 * @author     José Carlos Ferreira <jcarloswk@gmail.com>
 * @copyright  2024 José Carlos Ferreira
 * @license    GNU General Public License versão 2 ou posterior; consulte o arquivo License. txt
 */

namespace Rsbebook\Component\Rsbebook\Site\Controller;

\defined('_JEXEC') or die;

use Joomla\CMS\Application\SiteApplication;
use Joomla\CMS\Factory;
use Joomla\CMS\Language\Multilanguage;
use Joomla\CMS\Language\Text;
use Joomla\CMS\MVC\Controller\FormController;
use Joomla\CMS\Router\Route;
use Joomla\CMS\Uri\Uri;
use Joomla\Utilities\ArrayHelper;

use Joomla\CMS\Mail\Mail;


/**
 * Ebooks class.
 *
 * @since  1.0.0
 */
class EbooksController extends FormController
{
	/**
	 * Proxy for getModel.
	 *
	 * @param   string  $name    The model name. Optional.
	 * @param   string  $prefix  The class prefix. Optional
	 * @param   array   $config  Configuration array for model. Optional
	 *
	 * @return  object	The model
	 *
	 * @since   1.0.0
	 */
	public function getModel($name = 'Ebooks', $prefix = 'Site', $config = array())
	{
		return parent::getModel($name, $prefix, array('ignore_request' => true));
	}

	// Método para buscar termos
    public static function getTermos($id) {
        $db = Factory::getDbo();

        $query = $db->getQuery(true);

        // Selecionando os dados dos artigos referentes a categoria de termos. id 32
        $query->select(array('*'));
        $query->from($db->quoteName('#__content'));
        $query->where($db->quoteName('catid') . ' = '.$db->quote(32));
        $query->where($db->quoteName('id') . ' = '.$db->quote($id));
        $query->order($db->quoteName('ordering') . ' ASC');

        $db->setQuery($query);

        // Trazendo os dados do banco.
        try {
            $results = $db->loadObjectList();
            return $results[0];
        } catch (Exception $e) {
            return $e->getMessage(); // Retorna a mensagem de erro
        }
    }

    public function ajaxAction(){
        
        $dados = array();
        $erros = array();
        
        /// Obtenha os dados POST enviados pelo fetch
        $inputJSON = file_get_contents('php://input');
        $input = json_decode($inputJSON, true);

        /*$dados['consentimentoDeUso'] = self::getTermos(8563)[0];
        $dados['licencaDeUso'] = self::getTermos(8562)[0];*/
        $camposObrigatorios = ['ebookId','nome','email'];
        $arrayCamposObrigatorios = array();
        foreach($input as $n=> $v){
            if( in_array($n,$camposObrigatorios) && !self::validarCampo($v) ){
                array_push($arrayCamposObrigatorios,$n);
            }
        }
        
        if(count($arrayCamposObrigatorios)){
            $dados['camposObrigatorios'] = $arrayCamposObrigatorios;
            $dados['campos'] = $input;
            echo json_encode($dados);
            exit();
        }

        //self::setEbook($input);
        
        $dados[] = $input;
        
    }

    public function validarCampo($campo) {
        $campo = trim($campo);
        if(empty($campo) && strlen($campo) === 0){
            return false;
        }

        return true;
    }

    //função para enviar e-mail

    public static function enviarEmailSMTP($destinatario, $assunto, $mensagem, $attachmentPath = '') {
        // Configurações do servidor SMTP
        $config = Factory::getConfig();
        $mailer = Mail::getInstance('smtp');
    
       /* $smtpSettings = array(
            'host' => $config->get('smtpsecure') . '://' . $config->get('smtphost'),
            'port' => $config->get('smtpport'),
            'username' => $config->get('smtpuser'),
            'password' => $config->get('smtppass'),
            'secure' => $config->get('smtpsecure'),
            'auth' => $config->get('smtpauth')
        );*/
    
        $mailer->setSender(array($config->get('mailfrom'), $config->get('fromname')));
        $mailer->addRecipient($destinatario);
        $mailer->setSubject($assunto);
        $mailer->isHtml(true);
        $mailer->setBody($mensagem);

        // Add attachment
        if (file_exists($attachmentPath)) {
            $mailer->addAttachment($attachmentPath);
        } else {
            echo "Attachment file not found";
        }
    
        // Tenta enviar o e-mail
        try {
            $enviado = $mailer->send();
            if ($enviado !== true) {
                echo 'Erro ao enviar e-mail.';
            }
            return true;
        } catch (Exception $e) {
  
            return false;
        }
    }


    public static function setEbook(...$vars){

        extract($vars);

       // Initialiase variables.
        $db    = Factory::getDbo();

        $date = date('Y-m-d H:m:s');

        $query = $db->getQuery(true);

        $cols = ['ebookId','email','nome','termo_licenca_uso','termo_consentimento_uso','data'];
        $vls = [$db->quoteName($ebookId),$db->quoteName($email),$db->quoteName($nome),$db->quoteName($termo_licenca_uso),$db->quoteName($termo_consentimento_uso),$date];

        // Create the base insert statement.
        $query->insert($db->quoteName($tableRelated))
            ->columns(array(implode(',',$cols)))
            ->values(implode(',',$vls));
        
        // Set the query and execute the insert.
        $db->setQuery($query);
        
        try
        {
            $db->execute();
        }
        catch (RuntimeException $e)
        {
            echo awUtilitario::awMessages(JError::raiseWarning(500, $e->getMessage()),'danger');
            return false;
        }

        return true;
    }
}


