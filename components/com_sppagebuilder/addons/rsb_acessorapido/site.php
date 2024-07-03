<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonRsb_acessorapido extends SppagebuilderAddons {

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
		
		$out[] = '<div class="section-rsb-acesso-rapido">';
		$out[] = '<div class="rsb-acesso-rapido-wrapper">';
		

// Chama a função para criar o SVG
$svgContent = self::createSVG();



		foreach($items->rsb_items as $item)
		{
			$imagem = $item->url ? '<img src="'.$item->imagem->src.'" width="36" alt="" />' : '';
			list($link, $new_tab) = AddonHelper::parseLink($item, 'url', ['url' => 'link', 'new_tab' => 'target']);
			$hrefTag = !empty($link) ? 'href="' . $link .'"' : '';

			$out[] = '<a '. $hrefTag  . ' ' . $new_tab . ' class="rsb-acesso-rapido-card w-inline-block">';

			if($item->imagem->src){
				$out[] = '<div class="rsb-acesso-rapido-icon border no-margin">'.$imagem.'</div>';
			}
			
			$out[] = '<div class="rsb-acesso-rapido-info"><h4 class="text-home-rsb-acesso-rapido">'.$item->title.'</h4></div>';
			$out[] = '</a>';
		}

		$out[] = '</div>';
		$out[] = '</div>';
		return implode('',$out);

	}

	public function scripts() {
		//return array(JURI::base(true) . '/components/com_sppagebuilder/addons/ibs_documents/assets/js/ibs_documents.js?1');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_acessorapido/assets/css/style.css?10',JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_acessorapido/assets/css/animate.min.css');
	}
	    
}
