<?php

/**
 * @package     Joomla.Site
 * @subpackage  mod_presencas
 *
 * @copyright   (C) 2006 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Filter\OutputFilter;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Factory;

$doc = JFactory::getDocument();
$doc->addStyleSheet(Juri::base(true).'/modules/mod_ondeestamos/src/assets/style.css?'.uniqid());

$doc->addScript(Juri::base(true).'/modules/mod_ondeestamos/src/assets/onde-estamos.js?'.uniqid());
$doc->addScript(Juri::base(true).'/modules/mod_ondeestamos/src/assets/onde-estamos-segmento.js?'.uniqid());
$doc->addScript(Juri::base(true).'/modules/mod_ondeestamos/src/assets/mapa.js?'.uniqid());

$doc->addStyleDeclaration("
    .ondeEstamos-div.form {
        background: ".$params->get('cor').";
    }
    .ondeEstamos-div.form select {
        background-color:transparent;
        color:#fff
    }
    .ondeEstamos-div.form select option {
         background: ".$params->get('cor').";
         color:#fff
    }
    .ondeEstamos-div.form select option:disabled {
        color: rgba(228,228,228, 0.4)
    }

");

?>


<div class="container-fluid container">
        <div class="ondeEstamos-row">
            <div class="col-12 col-lg-4 ondeEstamos-div form order-5 order-lg-1">
                <div class="ondeEstamos-formulario">
                    <form action="">
                        <select class="form-select ondeEstamos-select" id="select-estado" onchange="selecionaEstado(this.value)" ufanterior="amazonas" aria-label="Default select example">
                            <option selected="" value="">Escolha um estado</option>
                            <option value="acre" >Acre (AC)</option>
                            <option value="alagoas" >Alagoas (AL)</option>
                            <option value="amapa" >Amapá (AP)</option>
                            <option value="amazonas">Amazonas (AM)</option>
                            <option value="bahia" >Bahia (BA)</option>
                            <option value="ceara">Ceará (CE)</option>
                            <option value="distrito_federal">Distrito Federal (DF)</option>
                            <option value="espirito_santo" >Espírito Santo (ES)</option>
                            <option value="goias" >Goiás (GO)</option>
                            <option value="maranhao" >Maranhão (MA)</option>
                            <option value="mato_grosso" >Mato Grosso (MT)</option>
                            <option value="mato_grosso_do_sul">Mato Grosso do Sul (MS)</option>
                            <option value="minas_gerais" >Minas Gerais (MG)</option>
                            <option value="para" >Pará (PA)</option>
                            <option value="paraiba" >Paraíba (PB)</option>
                            <option value="parana" >Paraná (PR)</option>
                            <option value="pernambuco" >Pernambuco (PE)</option>
                            <option value="piaui" >Piauí (PI)</option>
                            <option value="rio_de_janeiro" >Rio de Janeiro (RJ)</option>
                            <option value="rio_grande_do_norte" >Rio Grande do Norte (RN)</option>
                            <option value="rio_grande_do_sul">Rio Grande do Sul (RS)</option>
                            <option value="rondonia" >Rondônia (RO)</option>
                            <option value="Caminho_208" >Roraima (RR)</option>
                            <option value="santa_catarina" >Santa Catarina (SC)</option>
                            <option value="sao_paulo">São Paulo (SP)</option>
                            <option value="sergipe" >Sergipe (SE)</option>
                            <option value="tocantins" >Tocantins (TO)</option>
                        </select>

                        <select class="form-select ondeEstamos-select" id="select-unidades" onchange="changeUnidades(this.value)" aria-label="Default select example">
                            <option selected="" value=""><?= $params->get('titleselect');?></option>
                        </select>
                    </form>

                    <div class="ondeEstamos-clear" onclick="limpaBusca()" style="display:none">
                        <span>Limpar Busca</span>
                    </div>

                </div>

                <div class="ondeEstamosInfo" style="display:none"></div>
            </div>
            <div class="col-12 col-lg-8 ondeEstamos-div col-mapa order-1 order-lg-5">
                <div class="div-mapa" 
                    data-color="<?= $params->get('cor');?>"
                    data-segmento="<?= implode(',',$params->get('coTipoPresenca'));?>"
                    data-titleselect="<?= $params->get('titleselect');?>"
                >
                    <div 
                        class="mapa mapa-brasil"
                        mapa-width="600"
                        mapa-height="500"
                        color-fill="#F1F1F1"
                    ></div>
                    </div>
                </div>
            </div>
    </div>


