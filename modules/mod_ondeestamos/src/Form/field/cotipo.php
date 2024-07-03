<?php
defined('_JEXEC') or die;

use Joomla\CMS\Form\FormField;

class JFormFieldCoTipo extends FormField
{
    protected $type = 'CoTipo';

    public function getInput()
    {
        // Aqui você pode renderizar o HTML do seu campo personalizado
        $tipos = json_decode(self::getTipoPresenca());

        $value = is_array($this->value) ? $this->value : [$this->value];
        $select = [];
        $select[] = '<select name="'.$this->name.'" class="form-select" multiple="multiple">';

        foreach($tipos as $tipo){

            $selected = in_array($tipo->coTipoPresenca,$value) ? ' selected' : '';
            $select[] = '<option value="'.$tipo->coTipoPresenca.'" '.$selected.'>'.$tipo->txTipoPresenca.'</option>';
        }
        $select[] = '</select>';

        return implode('',$select);
    }


    public function getTipoPresenca(){

        $apiUrl = 'https://integrador.sig.rsb.org.br/api2/tipoPresenca';

        $response = file_get_contents($apiUrl);

      
        if ($response === false) {
            $data = array('error' => 'Erro ao chamar a API');
        } else {
            $data = json_decode($response, true);
        }

        header('Content-Type: application/json');

        return json_encode($data);
    }
}
