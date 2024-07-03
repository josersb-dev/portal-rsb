<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonRsb_carouselconteudo extends SppagebuilderAddons {

	function createSVG() {
		// Inicia o elemento SVG
		$svg = '<svg xmlns="http://www.w3.org/2000/svg" width="100" height="100" viewBox="0 0 100 100">';
	
		// Adiciona um círculo vermelho
		$svg .= '<circle cx="50" cy="50" r="40" fill="red" />';
	
		// Fecha o elemento SVG
		$svg .= '</svg>';
	
		// Retorna o SVG
		return $svg;
	}

	public function render() {

		$items = $this->addon->settings;

		$out = array();
		//pagination-type="progressbar" 
		/*$out[] = '<swiper-container 
		class="rsbCarouselConteudo" 
		pagination="false"
		navigation="true"
		style="--swiper-navigation-color: #fff; --swiper-pagination-color: #fff">';*/

		$out[] = '<div class="swiper rsbCarouselConteudo">';
		$out[] = '<div class="swiper-wrapper">';

		foreach($items->rsb_items as $item)
		{
			$out[] = '<div class="swiper-slide" lazy="true">';
			$imagem = $item->url ? '<img src="'.$item->imagem->src.'" width="36" alt="" />' : '';
			$textoColor = !empty($item->textocolor) ? $item->textocolor : '#fff';
			$out[] = '<div class="rsb-carousel-conteudo w-inline-block" style="background-color:'.$item->temacolor.'; color:'.$textoColor.'">';

			if($item->imagem->src){
				$out[] = '<div class="rsb-carousel-imagem no-margin">'.$imagem.'</div>';
			}
			
			$out[] = '<div class="rsb-carousel-content">';
			$out[] = 	'<h4>'.$item->title.'</h4>';
			$out[] = 	'<div class="rsb-carousel-descricao">'.trim($item->descricao).'</div>';
			$out[] = '</div>';
			$out[] = '</div>';
			$out[] = '</div>';
		}

		$out[] = '</div>';
		$out[] = '<div class="swiper-button-next swnavigation"></div>';
		$out[] = '<div class="swiper-button-prev swnavigation"></div>';
		$out[] = '<div class="swiper-pagination"></div>';
		$out[] = '</div>';
		return implode('',$out);
	}

	public function js() {
		return '
			jQuery(function($){
				$( document ).ready(function(){
				var swiper = new Swiper(".rsbCarouselConteudo", {
					cssMode: false,
					navigation: {
						nextEl: ".swiper-button-next",
						prevEl: ".swiper-button-prev",
						color: \'red\'
					},
					pagination: {
					  el: ".swiper-pagination",
					  dynamicBullets: true,
					},
				  });
				})
			})
		';
	}

	public function scripts() {
		return array('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_carouselconteudo/assets/css/style.css?9',JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_acessorapido/assets/css/animate.min.css','https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
	}
	
	    
}

  /*<script>
        jQuery(function($){
            $( document ).ready(function(event){
                $('.sliderPresencas').fadeIn();
            })
        })
  </script>*/
