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
$doc->addStyleSheet(Juri::base(true).'/modules/mod_presencas/src/assets/style.css?'.uniqid());
//JHtml::_('formbehavior.chosen', 'select');


$coTipo = $params->get('coTipoPresenca');
$classInspetoria = $coTipo === 'INS' ? ' nossasInpetorias' : '';
$cor = $coTipo === 'INS' ? '#FFFFFF' : $params->get('cor');
?>


<swiper-container 
    class="sliderPresencas <?= $params->get('class');?> <?= $classInspetoria;?>" 
    pagination="true" 
    pagination-type="progressbar" 
    navigation="true" 
    style="--swiper-navigation-color: <?= $cor; ?>; --swiper-pagination-color: <?= $params->get('cor'); ?>;">
<?php foreach(json_decode($items) as $item):?>
    <?php 
        $url = $item->txSiteURL ? 'href="'.$item->txSiteURL.'" target="_blank"' : '';
    ?>
        <swiper-slide lazy="true">
            <div class="slideInner">
            <div class="slidePresencaImg col-md-6 col-sm-12">
                <img loading="lazy" src="https://imagem.rsb.org.br/bucket/presenca/<?= $item->idPresenca;?>/<?= $item->txEnderecoImagem;?>" />
            </div>
            <div class="sliderPresencaContent col-md-6 col-sm-12">
            <span class="badge-rsb text-uppercase"><?= $item->txUnidadeGestora;?></span>        
                <span class="title"><?= $item->noPresenca;?></span>
                <span class="sub-title"><?= $item->txNomeCidade;?></span>
                <?php if($coTipo !== 'INS'):?>
                    <span class="sub-title">Endereço: <?= $item->txLogradouro;?>, - <?= $item->txNumeroLogradouro;?> - <?= $item->txNomeCidade;?><br> CEP: <?= $item->txNumeroCEP;?><br> Telefone: <?= $item->nuTelefone;?></span>
                <?php endif;?>
                <a <?= $url;?> >
                    <button class="btn btn-azul">Saiba mais</button>
                </a>
            </div>
</div>
        </swiper-slide>
    <?php endforeach;?>
  </swiper-container>

  <script src="https://cdn.jsdelivr.net/npm/swiper@11/swiper-element-bundle.min.js"></script>
  <script>
        jQuery(function($){
            $( document ).ready(function(event){
                $('.sliderPresencas').fadeIn();
            })
        })
  </script>


