<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonRsb_slidediferencial extends SppagebuilderAddons {

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
		$titleNav = array();

		$out[] = '<div class="swiper rsbSlideDiferencial">';
		$out[] = '<div class="swiper-wrapper">';

		foreach($items->rsb_items as $k=> $item)
		{
			array_push($titleNav,["title"=> $item->title,"color" => $item->temacolor]);
			$out[] = '<div class="swiper-slide" lazy="true" data-color="'.$item->temacolor.'">';
			$imagem = $item->url ? '<img src="'.$item->imagem->src.'" width="36" alt="" />' : '';
			$textoColor = !empty($item->textocolor) ? $item->textocolor : '#fff';
			$out[] = '<div class="rsb-slide-diferencial w-inline-block" style="color:'.$textoColor.'">';

			if($item->imagem->src){
				$out[] = '<div class="rsb-diferencial-imagem no-margin">'.$imagem.'</div>';
			}
			
			$out[] = '<div class="rsb-diferencial-content">';
			$out[] = 	'<h4>'.$item->title.'</h4>';
			$out[] = 	'<div class="rsb-diferencial-descricao">'.trim($item->descricao).'</div>';
			$out[] = '</div>';
			$out[] = '</div>';
			$out[] = '</div>';
		}
		$titleNav = json_encode($titleNav);
		$out[] = '</div>';
		$out[] = '<div class="rsb-diferencial-nav" data-navs=\''.$titleNav.'\' data-color="'.$items->navcolor.'"></div>';
		$out[] = '</div>';

		return implode('',$out);
	}

	public function js() {
		return '
			jQuery(function($){
				$( document ).ready(function(){
				var swiper = new Swiper(".rsbSlideDiferencial", {
					direction:"horizontal",
					cssMode: false,
					pagination: {
					  el: ".rsb-diferencial-nav",
					  clickable: true,
					},
					breakpoints: {
						992: {
						  direction:"vertical"
						}
					  },
					  on: {
						slideChange: function(event) {
							//Bora adicionar a cor na section no passar do slide
							let dataColor = this.slides[this.activeIndex].getAttribute("data-color");
							let slideSection = $(this.slides[this.activeIndex]).closest("section")
							slideSection.css("background",dataColor)
					  }
					}
				  });

				  let dataNav = $(".rsb-diferencial-nav");

				  if($(".styleSlideDiferncial").length == 0 ){
				  	$("head").append(`<style class="styleSlideDiferencial">
						.rsbSlideDiferencial .swiper-slide {height: inherit !important}
						.rsb-diferencial-nav > span {color:${dataNav.data("color")}!important}
						.rsb-diferencial-nav > span.swiper-pagination-bullet-active, .rsb-diferencial-nav > span.swiper-pagination-bullet:hover {background: ${dataNav.data("color")}!important}
					</style>`)
					.addClass("styleSlideDiferncial")
				  }

				  function slideAutoHeight() {
					let heightSlide = [];
					$(".rsbSlideDiferencial .swiper-slide").each(function(){
						heightSlide.push($(this).innerHeight())
					})

				  	$(".rsbSlideDiferencial").css("height",Math.max(...heightSlide))
				  }

				  slideAutoHeight();

				  $( window ).on("resize",function(){
					$(".rsbSlideDiferencial").css("height","auto")
					slideAutoHeight();
				  })

				  let titleNav =$(".rsb-diferencial-nav").data("navs");
				  let section = $(".rsb-slide-diferencial").closest("section")
				  	section.css("background",titleNav[0].color)
				  $(".rsb-diferencial-nav span").each(function(ind){
					$(this).html(`<span>${titleNav[ind].title}</span><span class="icone"><i class="fa-solid fa-chevron-right"></i></span>`)
					let color = titleNav[ind].color
					$(this).on("click",function(){
						let section = $(this).closest("section")
						section.css("background",color)
					})
				  })
				})
			})
		';
	}

	public function scripts() {
		return array('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_slidediferencial/assets/css/style.css?9',JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_acessorapido/assets/css/animate.min.css','https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.css');
	}
	
	    
}

  /*<script>
        jQuery(function($){
            $( document ).ready(function(event){
                $('.sliderPresencas').fadeIn();
            })
        })
  </script>*/
