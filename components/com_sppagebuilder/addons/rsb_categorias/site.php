<?php

/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2023 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;
use Joomla\CMS\Layout\FileLayout;

/**
 * Carousel addon class
 * 
 * @since 1.0.0
 */
class SppagebuilderAddonRSB_categorias extends SppagebuilderAddons
{
	/**
	 * The addon frontend render method.
	 * The returned HTML string will render to the frontend page.
	 *
	 * @return  string  The HTML string.
	 * @since   1.0.0
	 */
	public function render()
	{
		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' ' . $settings->class : '';

		$items = $settings->sp_carousel_item;

		$output = '
		<div class="rsb-segmentos">
		   <div class="owl-carousel owl-theme rsb-slides owl-loaded owl-drag" id="rsb-segmentos">
				<div class="owl-stage-outer">
					<div class="owl-stage">
						'.self::getItems($items).'
		   			</div>
				</div>
			</div>
		</div>';
		return $output;
	}

	/**
	 * Generate the CSS string for the frontend page.
	 *
	 * @return 	string 	The CSS string for the page.
	 * @since 	1.0.0
	 */
	public function css()
	{
		return '';
		
	}

	public function getItems(Array $items){
		
		$out = array();
		foreach($items as $item){
			
			$iconeA = $item->icone_alignment;
			$icone_alignment = $iconeA == 'left' ? 'left: 0' : ( $iconeA == 'right' ? 'right: 0; left: inherit' : 'left:0; right:0');
			list($link, $new_tab) = AddonHelper::parseLink($item, 'url', ['url' => 'link', 'new_tab' => 'target']);

			$hrefTag = !empty($link) ? 'href="' . $link .'"' : '';

			$out[] = '
				<div class="owl-item active" style="width: 475px;">
					<div class="rsb-segmentos-item rsb-segmentos-escolas">
						<a '. $hrefTag  . ' ' . $new_tab . ' class="rsb-segmentos-item-imagem owl-lazy" data-src="'.$item->bg->src.'" style="background-size: cover !important; opacity: 1;">
							<h3>'.$item->title.'</h3>
							<span class="rsb-segmentos-item-imagem-overlay" style="background: '.$item->bg_color.' !important;"></span>
							<div class="rsb-segmentos-item-imagem-icon" style="'.$icone_alignment.'">
								<i class="icon icon-brainiac" icon-width="300" icon-height="280" icon-fill="#fff" style="width: '.$item->icone_width.'px; height: '.$item->icone_height.'px; margin: auto">
									'.$item->icone.'
								</i>
							</div>
						</a>
						<div class="rsb-segmentos-item-numeros" style="border-color:'.$item->numeros_bordercolor.'">
							<span class="rsb-segmentos-item-numeros-title">
								'.$item->numeros_legenda.'
							</span>
							<h3 class="sppb-animated-number" data-format="0" data-digit="'.$item->numeros_numero.'" data-duration="1000">0</h3>
						</div>
		  			</div>
		   		</div>';
		}

		return implode('',$out);
	}


	public function stylesheets() {
		return array(
			JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_categorias/assets/css/style.css?8',
			'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css',
			'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js'
		);
	}

	public function scripts(){
		return array(
			'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js'
		);
	}

	public function js(){
		$js = '
	jQuery(function($){
		$(document).ready(function(){
    $(\'#rsb-segmentos\').owlCarousel({
        lazyLoad:true,
        loop:false,
        margin:0,
        stagePadding:0,
        dots:0,
        rewind:false,
        animateOut: \'\',
        animateIn: \'\',
        navText: [\'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="31px" viewBox="0 0 18 18" style="transform-origin: center;transform: rotate(180deg);">        <defs>          <clipPath id="clip-path">            <rect id="Retângulo_2543" data-name="Retângulo 2543" width="100" height="100" transform="translate(0.467 0.467)" fill="none"></rect>          </clipPath>        </defs>        <g id="Grupo_2605" data-name="Grupo 2605" transform="translate(-0.467 -0.467)" clip-path="url(#clip-path)">          <path id="Caminho_1005" data-name="Caminho 1005" d="M7.234,13.7a.753.753,0,0,0,1.067,0L13.31,8.693a.6.6,0,0,0,0-.85L8.3,2.834A.754.754,0,0,0,7.234,3.9L11.6,8.271l-4.37,4.37A.751.751,0,0,0,7.234,13.7" transform="translate(-2.785 -1.038)" fill="var(--btn-azul)"></path>        </g>      </svg>\',
        \'<i class="icon icon-arrow" icon-width="31" icon-height="31" icon-fill="var(--btn-azul)" style="width: 31px; height: 31px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="31px" viewBox="0 0 18 18">        <defs>          <clipPath id="clip-path">            <rect id="Retângulo_2543" data-name="Retângulo 2543" width="100" height="100" transform="translate(0.467 0.467)" fill="none"></rect>          </clipPath>        </defs>        <g id="Grupo_2605" data-name="Grupo 2605" transform="translate(-0.467 -0.467)" clip-path="url(#clip-path)">          <path id="Caminho_1005" data-name="Caminho 1005" d="M7.234,13.7a.753.753,0,0,0,1.067,0L13.31,8.693a.6.6,0,0,0,0-.85L8.3,2.834A.754.754,0,0,0,7.234,3.9L11.6,8.271l-4.37,4.37A.751.751,0,0,0,7.234,13.7" transform="translate(-2.785 -1.038)" fill="var(--btn-azul)"></path>        </g>      </svg></i>\'],
        responsive:{
            0:{
                items:2,
                dots:0,
				nav:false,
                margin:0,
                stagePadding:0
            },
            767:{
                items:2,
                slideBy:2,
				nav:true
            },
            992:{
                items:4,
                slideBy:4,
				nav:true
            },
        }
    })
})
})
';

return $js;
	}

}
