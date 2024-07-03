
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

class awNewsletter {

	public static function setNewsletter($iPosts,&$params)
	{
        //Vars Inputs
        $queryString = http_build_query($iPosts);
        parse_str($queryString, $queryArray);

        if(!self::cadastrarEmail($params, $queryArray)){
            exit();
            return false;
        }

        return true;
	}
        
    public static function cadastrarEmail($params, $inputs) {

        extract($inputs);
        $apiKey = $params->get('newsletter_api_key');
        $listId = explode(',',$params->get('newsletter_list'));
        $apiUrl = $params->get('newsletter_url');

        $contactEmail = $params->get('newsletter_email');
        $contactName = $params->get('newsletter_first_name');
        $contactLast = $params->get('newsletter_last_name');

        $contacts = [
            'email' => $$contactEmail ?? '',
            'first_name' => $$contactName ?? '',
            'last_name' => $$contactLast ?? ''
        ];

        $contacts = array_filter($contacts);

        //global $apiKey, $apiUrl, $listId;
        
        // Dados do contato a ser adicionado
        $data = array(
            'list_ids' => $listId,
            'contacts' => array(
                $contacts
            ),
        );
    
        // Inicializa o cURL para fazer a requisição à API do SendGrid
        //var_dump($data);
        $ch = curl_init();
        
        // Define as opções da requisição
        curl_setopt_array($ch, array(
            CURLOPT_URL => $apiUrl, 
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 30,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'PUT',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Authorization: Bearer ' . $apiKey,
                'Content-Type: application/json'
            ),
        ));
        
        
        // Executa a requisição
    
        //var_dump($ch);
        $response = curl_exec($ch);
        
        $http_code = curl_getinfo($ch, CURLINFO_HTTP_CODE);
        
        if($http_code === 0){
            echo awUtilitario::awMessages('URL da API Newsletter é Inválida'.$apiUrl,'danger');
            exit();
        }

        $erros = json_decode($response)->errors;

        if($erros){
            echo awUtilitario::awMessages($erros[0]->message.' <b>'.$http_code.'</b>','danger');
            exit();
        }

        // Fecha a sessão cURL
        curl_close($ch);

        return true;
    
        
    }
		
}