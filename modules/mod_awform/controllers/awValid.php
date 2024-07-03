
<?php

/**
 * @package     
 * @subpackage  mod AwForm
 **/

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\User\User;

/********
 Classe Aw Valid.
 Desenvolvido por Carlos (IBS WEB)
********/

class awValid {
    public static function nada(){
        echo 'kkk';
        exit();
    }

	public static function awV($validar,$value,$campo,$name)
	{
        
		switch ($validar) {
			case 'cpf':
				if(self::validCPF($value,$campo,$name))
				{
					return true;
				}
				break;
			case 'email':
				if(self::validEmail($value,$campo,$name)){
					return true;
				}
				break;
            case 'obrigatorio':
                if(self::validarCampoObrigatorio($value,$campo,$name)){
                    return true;
                }
                break;
            case 'file':
                if(self::validarArquivoUpload($value,$campo,$name)){
                    return true;
                }
			default:
					return false;
				break;
		}
	}

	public static function validEmail($email,$campo,$name){
        $valid = "/^([a-zA-Z0-9_\.\-])+\@(([a-zA-Z0-9\-])+\.)+([a-zA-Z0-9]{2,4})+$/";
        if(!preg_match($valid,$email))
        {
             //echo awUtilitario::awMessages('O campo <b>'.$campo.'</b> não é um E-mail válido','danger');

             $dados = [];
            //$dados[$name] = 'O campo '.$campo.' é Obrigatório';
            $dados[$name] = 'E-mail inválido';

            echo json_encode($dados).',';
            return false;
        }else{
            return true;
        }
    }

    public static function validCPF($cpf,$campo,$name) 
    {
        $status = true;
        $dados = [];
        $dados[$name] = 'Este campo não é um CPF válido';
        $menError = json_encode($dados).',';


        // Extrai somente os números
        $cpf = preg_replace( '/[^0-9]/is', '', $cpf );
   
        // Verifica se foi informado todos os digitos corretamente
        if (strlen($cpf) != 11) {
                echo $menError;
            return false;
        }
        // Verifica se foi informada uma sequência de digitos repetidos. Ex: 111.111.111-11
        if (preg_match('/(\d)\1{10}/', $cpf)) {
                echo $menError;
            return false;
        }

   
    // Faz o calculo para validar o CPF
    for ($t = 9; $t < 11; $t++) {
        for ($d = 0, $c = 0; $c < $t; $c++) {
            $d += $cpf[$c] * (($t + 1) - $c);
        }
        $d = ((10 * $d) % 11) % 10;
        if ($cpf[$t] != $d) {
            $status = false;
            break; // Se o dígito verificador não corresponder, não há necessidade de continuar o loop
        }
    }

    if(!$status){
            echo $menError;
        return false;

    }

    return $status;
    }

    public static function validJoomla($vt,$val)
    {


        switch ($vt) {
            case 'password':
                // Gerar um salt aleatório de 32 bytes
                //$salt = random_bytes(12);

                // Criar a senha criptografada com o salt
               // $crypt = password_hash($val . base64_encode($salt), PASSWORD_DEFAULT);

                // Concatenar a senha criptografada com o salt
                //$report = $crypt . ':' . base64_encode($salt);
                $report = md5($val);

                break;
            
            default:
                $report = $val;
                break;
        }

        return $report;
    }

    public static function validarCampoObrigatorio($valor,$campo,$name)
    {
        if(empty(trim($valor))){
            $dados = [];
            //$dados['erro_campo'] = true;
            //$dados[$name] = 'O campo '.$campo.' é Obrigatório';
            $dados[$name] = 'Campo obrigatório <br>';

            echo json_encode($dados).',';
            //echo awUtilitario::awMessages('O campo <b>'.$campo.'</b> é Obrigatório','danger');
            return false;
        }

        return true;
    }

    public static function validarArquivoUpload($arquivo,$campo,$name) {

        $status = false;
        $files = array();
        if(is_array($_FILES[$arquivo])){

            foreach($_FILES[$arquivo] as $file)
            {
                if(!isset($file['tmp_name']) && !is_uploaded_file($file['tmp_name'])){
                    array_push($files, $file['name']);
                }
            }
        }

        $status = count($files) == 0 ? false : true;

        if ($status) {
            return true; // É um arquivo de upload válido
        } else {
            $dados = [];
            //$dados[$name] = 'O campo '.$campo.' é Obrigatório';
            $dados[$name] = 'Não é um arquivo de upload válido';

            echo json_encode($dados).',';
            return false; // Não é um arquivo de upload válido
        }
    }
}