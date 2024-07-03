
<?php

/**
 * @package     
 * @subpackage  mod AwForm
 **/

// No direct access.
defined('_JEXEC') or die;

use Joomla\CMS\Factory;
use Joomla\Database\DatabaseFactory;

/********
 Classe Aw Valid.
 Desenvolvido por Carlos (IBS WEB)
********/

class awLogin {

	public static function awL(&$params,$inputs)
	{
        $d = 'id,nome';
		//campos para login
        $datas = explode(',',$d);


        /********************
         *SET Vars Data
        ********************/
        parse_str(http_build_query($inputs),$queryArray);
        extract($queryArray);

        foreach($datas as $data)
        {
            $sData = $data;

            if(!self::getD($data,$params->get('db'),$data,$$sData))
            {
                return false;
                exit();
            }

            echo 'certo';


        }

	}

    public static function getD($name,$sDb,$campo,$val,$token)
    {
        // Build the query for the table list.
      /*  $db = Factory::getDbo();
        $db->setQuery(
            'SELECT '.$db->quoteName($name)
            . ' FROM '.$sDb
            . ' WHERE '.$db->quoteName($campo).' = ' . $db->quote($val) . ' AND '.$db->quoteName('awToken') ' = '.$token
        );
        
        try {
                $result = $db->loadResult();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        
        return  $result;*/
    }

    public static function setUp($sDb,$inputs,$token,&$params)
    {
        $awToken = $token;

        if(empty($awToken))
        {
            echo '<div class="alert alert-danger"><strong>SUA SESSÃO EXPIROU!</strong> Atualize sua página e tente novamente.</div>';
            return false;
            exit();
        }
        if(($params->get('awUpDex') && !$params->get('awUpDblock')))
        {
            if(self::getDado($params->get('awUpDName'),$sDb,$token) === $params->get('awUpDValue'))
            {
                echo '<div class="alert alert-danger">Acesso bloqueado!</div>';
                return false;
                exit();
            }
        }
        

        $fields = array();

        // Initialiase variables.
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);

        foreach($inputs as $names=> $values)
        {
            if(in_array($names,self::getDDb($sDb,$token)))
            {
                $value = is_array($values) ? implode(', ',$values) : $values;
                $upd = $db->quoteName($names) . ' = ' . $db->quote($value);
                array_push($fields, $upd);
            }
        }

        // Create the base update statement.
        $query->update($db->quoteName($sDb))
            ->set($fields)
            ->where($db->quoteName('awToken') . ' = ' . $db->quote($awToken));
        
        // Set the query and execute the update.
        $db->setQuery($query);
        
        try
        {
            $db->execute();
            return true;
        }
        catch (RuntimeException $e)
        {
            echo JError::raiseWarning(500, $e->getMessage());
            return false;
        }


        return true;

    }


    public static function awUpDado($sDb,$dado,$value,$token,$block,&$params = null)
    {
        $awToken = $token;

        if(!$block)
        {
            echo '<div class="alert alert-danger">Permissão negada!</div>';
            return false;
            exit();
        }

        if(self::getDado($params->get('awUpDName'),$sDb,$token) === $params->get('awUpDValue') && $params->get('awUpDblock'))
        {
            echo '<div class="alert alert-danger">Acesso bloqueado!</div>';
            return false;
            exit();
        }

        if(empty($awToken))
        {
            echo '<div class="alert alert-danger"><strong>SUA SESSÃO EXPIROU!</strong> Atualize sua página.</div>';
            return false;
            exit();
        }

        if(empty($dado) and empty($value))
        {
            echo '<div class="alert alert-danger"><strong>Campo de Dados está vazio.</div>';
            return false;
            exit();
        }

        $fields = array();

        // Initialiase variables.
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);

        // Create the base update statement.
        $query->update($db->quoteName($sDb))
            ->set($db->quoteName($dado) . ' = ' . $db->quote($value))
            ->where($db->quoteName('awToken') . ' = ' . $db->quote($awToken));
        
        // Set the query and execute the update.
        $db->setQuery($query);
        
        try
        {
            $db->execute();
            return true;
        }
        catch (RuntimeException $e)
        {
            echo JError::raiseWarning(500, $e->getMessage());
            return false;
        }

        return true;
    }

    //Buscando names do banco para comparar.
    public static function getDDb($sDb,$token)
    {
       
        $dataDb = array();

        // Initialiase variables.
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);
        
        // Create the base select statement.
        $query->select('*')
            ->from($db->quoteName($sDb))
            ->where($db->quoteName('awToken') . ' = ' . $db->quote($token));
        
        // Set the query and load the result.
        $db->setQuery($query);
        
        try
        {
            $result = $db->loadObjectList();
        }
        catch (RuntimeException $e)
        {
            JError::raiseWarning(500, $e->getMessage());
        }

        foreach($result[0] as $dat => $item)
        {
            array_push($dataDb,$dat);
        }

        return $dataDb;
    }

    //Pedar dado do banco
     public static function getDado($name,$sDb,$token)
    {
        // Build the query for the table list.
        $db = Factory::getDbo();
        $db->setQuery(
            'SELECT '.$db->quoteName($name)
            . ' FROM '.$sDb
            . ' WHERE '.$db->quoteName('awToken') . ' = ' .$db->quote($token)
        );
        
        try {
                $result = $db->loadResult();
            } catch (Exception $e) {
                echo $e->getMessage();
            }
        
        return  $result;
    }

    public static function validFields(&$params,$inputs,$token = null)
    {
       parse_str(http_build_query($inputs),$queryArray);
       extract($queryArray);

       $validFields = explode(",",$params->get('validFields'));
       preg_match_all("/(.+)?{(.+)}/U", $params->get('validFields'), $vFields);

       $vFieldsNames = array();
       //Validando 
       foreach($vFields[2] as $vField)
        {
            array_push($vFieldsNames,$vField);
        }


       // Initialiase variables.
       $db    = Factory::getDbo();
       $query = $db->getQuery(true);
       
       // Create the base select statement.
       $query->select($db->quoteName($vFieldsNames))
           ->from($db->quoteName($params->get('db')));
           
       try
       { 
            // Set the query and load the result.
            $db->setQuery($query);
           $result = $db->loadObjectList();
       }
       catch (RuntimeException $e)
       {
           echo $e->getMessage();	
           exit();
       }
        
        $status = true;
        
        foreach($result as $k=> $item)
        {
            $i = 0;
            foreach($item as $iN => $iV)
            {
                if($iV === $$iN)
                {
                    $vA .= str_replace(",","",$vFields[1][$i]). ' <strong>' .$iV.'</strong> já está em uso<br>'; 
                    $status = false;
                }
                $i++;
            }
        }

        if($status == false)
        {
            echo '<div class="alert alert-danger">'.$vA.'</div>';
            exit();
        } 

        return true;      
    }

    //Limite de items

    public static function setLimit(&$params) {
        // Initialiase variables.
        $db    = Factory::getDbo();
        $query = $db->getQuery(true);
        
        // Create the base select statement.
        $query->select('*')
            ->from($db->quoteName($params->get('db')));
        
        // Set the query and load the result.
        $db->setQuery($query);
        
        try
        {
            $result = $db->loadObjectList();

            $cou = count($result);

            if(count($result) >= $params->get('setLimit')){
                echo '<div class="alert alert-danger"><strong>'.$params->get('menSetLimit').'</div>';
                return false;
            }

            if($cou == $params->get('setLimit') - 1 && $params->get('awexnot')){
                if(!self::setEnot($params)){
                    return false;
                }   
            }
        }
        catch (RuntimeException $e)
        {
            JError::raiseWarning(500, $e->getMessage());
            return false;
        }

        return true;
    }

     public static function setEnot(&$params)
    {
        $mail = Factory::getMailer();

        //Recuperando dados do corpo do e-mail.
        $bodyEmail = $params->get('notbody');

        //Recipiente
        $recipient = explode(',',$params->get('notemail'));
        $recipient = count($recipient) == 1 ? $recipient[0] : $recipient;
        
        $message =  '<!DOCTYPE html>';
        $message .= '<html lang="en">';
        $message .= '<head>';
        $message .= '<meta http-equiv="Content-Type" content="txt/plain; charset=utf-8">';
        $message .= '<title></title>';
        $message .= '</head>';
        $message .= '<body>';
        $message .= $bodyEmail;
        $message .= '</body>';
        $message .= '</html>';
        
        $sender = array($params->get('emailsender'), $params->get('namesender'));
        $mail->setSender($sender);
        $mail->addRecipient($recipient);
        $mail->setSubject($params->get('notsubject'));
        $mail->isHTML(true);
        $mail->Encoding = 'base64';
        $mail->setBody($message);
        
        if($mail->Send())
        {   
            return true;
        }
        else
        {
            echo '<div class="alert alert-danger">Falha ao enviar email</div>';
            return false;
        }
    }

    public static function tableExists($tabela)
    {
        $db = Factory::getDbo();
        $tableName = $tabela;

       // Tente obter informações da tabela
       try {
           $query = $db->getQuery(true)
               ->select('1')
               ->from($db->quoteName($tableName))
               ->setLimit(1);

           $db->setQuery($query);
           $db->execute();

           // Se a execução ocorrer sem erro, a tabela existe
           $tableExists = true;
       } catch (\Exception $e) {
           // Se ocorrer um erro, a tabela não existe
           $tableExists = false;
       }

       return $tableExists;
    }

}