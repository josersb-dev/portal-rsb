<?php

/**
 * @package     
 * @subpackage  mod AwForm
 **/

// No direct access.
defined('_JEXEC') or die;

/********
 Classe Aw Captcha.
 Desenvolvido por Carlos (IBS WEB)
********/

class awUtilitario {

	/*Verificar se é um array multidimicional*/
    public static function is_multi_array( $arr ) {
        rsort( $arr );
        return isset( $arr[0] ) && is_array( $arr[0] );
    }

   /*Tratando dados de um array multidimicional*/
   public static function variosDados($multiArrs) 
    {
        $multi = [];
        $l = str_split(strtolower('ABCDEFGHIJKLMNOPQRSTUVWXYZ'));
    	
    	$i = 0;
        foreach($multiArrs as $k=> $multiArr){

        	$multi[] = '<b>'.$l[$i].')</b><br>';
            foreach($multiArr as $kn => $item){
              if(!is_array($item)){
              	$multi[] = '<b>'.$kn.'</b>: '.$item.'<br>';
              }else{
                	$multi[] = '<b>'.$kn.'</b>: '.implode(', ',$item).'<br>';
             	}
            }
           	$multi[] = '<br>';
           	$i++;
        }
        return implode('',$multi);
    }

    /******************
     *Usar {var[texto qualquer]}
    ******************/
    public static function varText($varText,$textVar,$tag = array())
    {
    	$textVar = '{'.$textVar.'}';
    	$varsArr = array();
    	preg_match_all("/{ *".$varText." *\[(.+)\] *}/U", $textVar,$menS);

    	$menSs = $tag[0].$menS[1][0].$tag[1];
    	$textVar = str_replace($menS[0][0],$menSs,$textVar);

    	array_push($varsArr,$menS[0][0],$menSs);

    	return array_filter($varsArr);
    }

	public static function awMessages($msg,$alert = 'success')
	{
		$message 	= [];
		$message[] 	= '<div class="alert alert-'.$alert.'" style="text-align:center;">';
  		$message[] 	= $msg;
		$message[] 	= '</div>';

		return implode('',$message);
	}


  //substitui o campo {esse} por uma variável de uma string.
  public static function gerarVarText($texto,...$variaveis) {

    foreach($variaveis as $vars){
      extract($vars);
    }
    //carregando texto do assunto
    preg_match_all("/{(.+)}/U", $texto, $arrayTexto);

    $textoArr = [];
    foreach ($arrayTexto[1] as $text) {
      array_push($textoArr, $$text);
    }

    $textoVars = str_replace($arrayTexto[0],$textoArr, $texto);

    return $textoVars;
  }

  //Buscar um valor por um atributo

  public static function getAttr($attrName, $attr) {
    if(preg_match('/\b' . preg_quote($attrName) . '\s*=\s*"([^"]+)"/', $attr, $match)) {
        return $match[1];
    }
    return false;
  }


  //Substituir o valor da váriavel de {var}
  public static function getVarType($var,$val) {

    $vars = array();

    if (count(explode('|',$var)) > 1) {
      list($var, $type) = explode("|", $var); 
    } else {
      $type = false;
    }


    if ($type === 'img') {
        $vars[$var] = "<img src='$val' alt='Imagem'>";
    } elseif ($type === 'link') {
        $vars[$var] = "<a href='$val'>$val</a>";
    } else {
        $vars[$var] = $val;
    }

    return $vars;
  }
}