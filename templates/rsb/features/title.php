<?php
/**
 * @package Helix_Ultimate_Framework
 * @author JoomShaper <support@joomshaper.com>
 * Copyright (c) 2010 - 2021 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or Later
 */


defined ('_JEXEC') or die();

use Joomla\CMS\Factory;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Categories\Categories;
use Joomla\CMS\Categories\Category\Category;
use Joomla\CMS\Router\Route;


/**
 * Helix Ultimate Site Title.
 *
 * @since	1.0.0
 */
class HelixUltimateFeatureTitle
{
	/**
	 * Template parameters
	 *
	 * @var		object	$params		The parameters object
	 * @since	1.0.0
	 */
	private $params;

	/**
	 * Constructor function
	 *
	 * @param	object	$params		The template parameters
	 *
	 * @since	1.0.0
	 */
	public function __construct($params)
	{
		$this->position = 'title';
	}

	/**
	 * Render the logo features.
	 *
	 * @return	string
	 * @since	1.0.0
	 */
	public function renderFeature()
	{

		$app = Factory::getApplication();
		$menu = $app->getMenu();
		$menuitem   = $app->getMenu()->getActive();
		$doc = $app->getDocument();

		//Pegando dados da cagtegoria.
		$input = $app->getInput();
		
		$itemId = $input->get('id','');
		$itemCatid = $input->get('catid','') ? $input->get('catid','') : $input->get('id','') ;

		if($menuitem)
		{

			$params = $menuitem->getParams();
			$paramsItem = $params;

			if($params->get('helixultimate_enable_page_title', 0))
			{

				$page_title 		 = $menuitem->title;
				$page_heading 	 	 = $params->get('helixultimate_page_title_heading', 'h2');
				$page_title_alt 	 = $params->get('helixultimate_page_title_alt');
				$page_subtitle 		 = $params->get('helixultimate_page_subtitle');
				$page_title_bg_color = $params->get('helixultimate_page_title_bg_color');
				$page_title_bg_image = $params->get('helixultimate_page_title_bg_image');

				if($page_heading == 'h1')
				{
					$page_sub_heading = 'h2';
				}
				else
				{
					$page_sub_heading = 'h3';
				}

				$style = '';

				if($page_title_bg_color)
				{
					$style .= 'background-color: ' . $page_title_bg_color . ';';
				}

				if($page_title_bg_image)
				{
					$style .= 'background-image: url(' . Uri::root(true) . '/' . $page_title_bg_image . ');';
				}

				if($style)
				{
					$style = 'style="' . $style . '"';
				}

				if($page_title_alt)
				{
					$page_title 	 = $page_title_alt;
				}

				$output = '';

				$output .= '<div class="sp-page-title"'. $style .'>';
				$output .= '<div class="container">';

				$output .= '<'. $page_heading .' class="sp-page-title-heading">'. $page_title .'</'. $page_heading .'>';

				if($page_subtitle)
				{
					$output .= '<'. $page_sub_heading .' class="sp-page-title-sub-heading">'. $page_subtitle .'</'. $page_sub_heading .'>';
				}

				$output .= '<jdoc:include type="modules" name="breadcrumb" style="none" />';

				$output .= '</div>';
				$output .= '</div>';

				return $output;

			}

				if($params->get('toposegmento')){

					self::getScripts();
					
					$parent = $menu->getItem($menuitem->parent_id);
			
					$parents = $parent ? $menu->getItems('parent_id', $menuitem->parent_id) : $menu->getItems('parent_id', $menuitem->id);

					//Navegação Category do item de menu principal
					$navegacaoCategoryItem = $params->get('navegacaoCategory');
					
					//Parametros do Pai principal desse item de menu
					$desativarHeranca = $params->get('desativarHeranca') ?? 0;
					
			
					$params = $parent ? $parent->getParams() : $params;
					
					if (JFactory::getApplication()->input->get('view') != 'article') {

						$imagem = is_array(getimagesize($params->get('imagemrsb'))) ? $params->get('imagemrsb') : juri::base(true).'/templates/rsb/images/placeholder-segmentos.png';
						
	
						$class = $params->get('rsb-padrao-background');
						$out  = '<div class="rsb-padrao-title">';
						$out .= '<img src="'.juri::base(true).'/templates/rsb/images/placeholder-segmentos.png'.'" data-src="'.$imagem.'"/>';
						$out .= '</div>';
						
						//Padronizado para segmento
						$out .= self::getPadraoNav($parents,$class,'','rsb-padrao-menu',$itemId,$menuitem,$params);
						
						$out .= self::getPageTitle($paramsItem,$itemId);
						
					/***
					 * Padronizado para segmento, porém precisa ativar a navegação de categoria para exibir
					 * Aqui no segemnto ele herda as configuraçõs do pai.
					****/
			
						if(self::getParentCatId($itemId) && $params->get('navegacaoCategory') && $navegacaoCategoryItem) {

							if($desativarHeranca){
								$params = $paramsItem;
								$out .= self::getPadraoNav(self::getCategories($params->get('navegacaoCategoryComponente'),$params->get('itemsDoParent'),$itemCatid),'bg-padrao-cats','category','rsb-padrao-category',$itemId,$menuitem,$params);
							}else{
								$out .= self::getPadraoNav(self::getParentCatId($itemId),'bg-padrao-cats','category','rsb-padrao-category',$itemId,$menuitem,$params);
							}
						}
					}
	
					return $out;
				}

				

				//$url = file_get_contents('https://www.rsb.org.br/gimg?url='.$url.'&resize=4000x834&eximage=1');

				if($params->get('topopadrao')){

					self::getScripts();

					$url = trim($params->get('imagemTopoPadrao'));
					$titulo = explode("\n", $params->get('tituloTopoPadrao'));
					$titulo = array_map(function($item) {return '<span>'.$item.'</span>';},$titulo);

					$titulo = implode('',$titulo);
					//$class = $params->get('');
					$out = '<div class="rsb-padrao-banner">';
					//$out .= '<div class="rsb-padrao-inner">';
					$out .= '<div class="banner-title"><h3>'.$titulo.'</h3></div>';
					//$out .= '</div>';
					$out .= '<img src="'.$url.'"/>';
					$out .= '</div>';
					$out .= self::getPageTitle($paramsItem);
					
					if($doc->countModules('downloads-destaques')):
						
					$out .= '<div class="row">
							<div class="downloads-destaques container">
								<jdoc:include type="modules" name="downloads-destaques" style="sp_xhtml" />
							</div>
						</div>';
					endif;

					if($params->get('navegacaoCategory')){
						/**
						 * Aqui se ativarmos a opção de items do parent, iremos pegar as categorias que são filhas do parent do item
						 */

						$out .= self::getPadraoNav(self::getCategories($params->get('navegacaoCategoryComponente'),$params->get('itemsDoParent'),$itemCatid),'bg-padrao-cats','category','rsb-padrao-category',$itemId,$menuitem,$params);
					}
					
					return $out;
				}
		}

	}

	public function getScripts(){
		$doc = Factory::getDocument();
		$doc->addStyleSheet('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css');
		$doc->addScript('https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js');
	}

	public function getConfig($id,$inicial){
		$doc = Factory::getDocument();
		$doc->addScriptDeclaration("
		jQuery(function($){
			$(document).ready(function(){
				$('#$id').owlCarousel({
					items:$inicial,
					lazyLoad:true,
					loop:false,
					margin:10,
					stagePadding:20,
					nav:1,
					dots:0,
					rewind:false,
					animateIn: '',
					responsive: {
					0: {
						items:1,
						slideBy:1,
						margin:0,
						stagePadding:0
					},
						767:{
						items:2,
						slideBy:2
					},
						992:{
							items:3
						},
						1200: {
							items:$inicial
						}
					}
					
				})
			})
		})
		");
	}

	public function getParentCatId($itemId,$parent = true){

		// Carrega a classe das categorias
		$categories = Categories::getInstance('Content');

		// Obtém o objeto da categoria atual
		$category = $categories->get($itemId);
		
		

		if ($category) {
			
			// Obtém o parent_id da categoria atual
			$parentId = $parent ? $category->getParent()->id : $category->id;

			// Obtém os itens irmãos (com o mesmo parent_id)
			$siblings = $categories->get($parentId)->getChildren();
			
			//Adicioando os items do parent 
			if($parent == false) {
				//Adicionando os items do Pai
				array_unshift($siblings,$category);
			}else{
				//Adicionando os items dos items do pai
				array_unshift($siblings,$category->getParent());
			}
			
			return $siblings;
		}

		return $false;
	}

	public function getPageTitle($params,$catid = ''){

		$estilo = $params->get('estilo') == 'ebook' ? 'ebook' : '';

			$out = '<div class="rsb-titulo-pagina container '.$estilo.'">';
			$out .= '<div class="rtp-left"></div>';

			$out .= '<div class="rtp-center">';
			if($params->get('icone')){
				$out .= '<div class="rsb-padrao-icone d-flex justify-content-center align-items-center '.$params->get('iconebackground').'">';
				$out .= '<i class="rsb-icone-segmentos">';
				$out .= $params->get('icone');
				$out .= '</i>';
				$out .= '</div>';
			}

			$out .= '<div class="rsb-padrao-titulo d-flex justify-content-center align-items-center text-center	flex-column">';
			$out .= '<h2>'.$params->get('rsbpaginatitulo').'</h2>';
			$out .= '<p class="cinza-5">'.$params->get('rsbpaginasubtitulo').'</p>';
			$out .= '</div>';
			$out .= '</div>';
			$out .= '<div class="rtp-right">';


			if($params->get('pesquisar')){
				$formAction = $params->get('pesquisar-action') ? $params->get('pesquisar-action') :  JRoute::_('index.php?option=com_finder&view=search');
				$formName = $params->get('pesquisar-name') ? $params->get('pesquisar-name') :  'q';
				$formMethod = $params->get('pesquisar-method') ? $params->get('pesquisar-method') :  'get';

				$out .= '
				<div class="noticias-search">
					<form action="'.$formAction.'" method="'.$formMethod.'">
						<div class="input-group div-input-txt-busca">
							<input type="text" name="'.$formName.'" class="input-txt-busca form-control js-stools-search-string active" placeholder="Pesquisar conteúdo" aria-describedby="button-addon2" value="">
							<button class="btn-group-busca" type="submit">
								<span class="icone">
									<i class="icon icon-search"></i>
								</span>
							</button>
						</div>
						<input type="hidden" name="t" value="'.$catid.'">
					</form>
				</div>';
			
			}
			$out .= '</div>';
			$out .= '</div>';

			return $out;
	}

	public function getPadraoNav($menus,$class, $linkContent = 'menu',$id,$itemId,$menuitem,$params){

		$app = Factory::getApplication();

		//Pegando dados da cagtegoria.
		$input = $app->getInput();
		//Item de categoria.
		$itemId = $input->get($params->get('navegacaoCategoryCampo'),'');
		

		$inicial = count($menus);
		$out = '';
		$out .= '<div class="rsb-padrao-nav container">';
		$out .= '<ul class="nav-cats owl-carousel owl-theme '.$class.'" data-inicial="'.$inicial.'" id="'.$id.'">';

		foreach($menus as $k=> $item){
			$title = $item->title;

			/****
			 * Aqui será onde iremos separar o link da url do item de menu, usaremos o parametro navegacaoCategoryCampo para fazer essa separação
			 * exemplo de uso: explode($params->get('navegacaoCategoryCampo'),$menu->link)
			****/
			/*if($params->get('navegacaoCategoryCampo')){
				$linkCategorias = explode($params->get('navegacaoCategoryCampo'),$menuitem->link)[0].$params->get('navegacaoCategoryCampo').'=';
			}*/

			$query = (object) $menuitem->query;
			
			
			$campoCategoria = $query->option == 'com_content' ? 'id' : 'catid';
			$linkCategorias = 'index.php?option='.$query->option.'&view='.$query->view.'&'.$campoCategoria.'=';
			$flink = $item->flink ? $item->flink : $item->route;
			$link = $linkContent == 'category' ? JRoute::_($linkCategorias.$item->id) : $flink; //atnes $item->flink

			//validarecho $linkCategorias.$item->id.'<br>';
		
			$linkAtivo = $item->id == $query->{$campoCategoria} ? 'active' : '';
			
			$out .= '<li class="item '.trim($item->alias).'-principal-color-hover"><a data-color="'.trim($item->alias).'-principal-color-hover" class="zoom '.trim($item->alias).'-principal-color-hover '.$linkAtivo.'" href="'.$link.'"><span>'. $title.'</span></a></li>';

			self::getConfig($id,$inicial);
		}

		$out .= '</ul>';
		$out .= '</div>';


		return $out;
	}


	public function getPadraoCustomNav($menuitem,$params){

		$menus = $params->get('exCustomLinks') ? explode("\n",$params->get('customLinks')) : [];
 
		$id = 'CustomNav';
		$out = '';
		$out .= '<div class="rsb-padrao-nav container">';
		$out .= '<ul class="nav-cats owl-carousel owl-theme '.$class.'" data-inicial="'.$inicial.'" id="'.$id.'">';

		$inicial = count($menus);

		foreach($menus as $k=> $item)
		{
			list($title,$link) = explode('|',$item);
			$linkAtivo = '0'; 
			$out .= '<li class="item '.$title.'-principal-color-hover"><a class="zoom '.$title.'-principal-color-hover '.$linkAtivo.'" href="'.$link.'"><span>'. $title.'</span></a></li>';
			self::getConfig($id,$inicial);
		}

		$out .= '</ul>';
		$out .= '</div>';

		return $out;
	}

	public function getCategories($extension,$parent = false, $itemId)
	{
			$itemParentId = self::getCategoriesDb($extension,false, $itemId,true);

			//Verificando se o itemparente é do tipo level 1
			$itemParentId = $itemParentId[0]->level === 2 ? $itemParentId[0]->parent_id : $itemParentId[0]->id;

		if($parent){
			$resultsParent = self::getCategoriesDb($extension,true, $itemParentId);
			$resultsItem   = self::getCategoriesDb($extension,false, $itemId, true);

			$results = array_merge($resultsItem,$resultsParent);

			return $results;
		}else{
			return self::getCategoriesDb($extension,true, $itemParentId);
		}
	}

	public static function getCategoriesDb($extension,$parent = true, $itemId, $itemDoParent = false)
	{
		// Get a db connection.
		$db = JFactory::getDbo();

		// Create a new query object.
		$query = $db->getQuery(true);

		// Select all records from the user profile table where key begins with "custom.".
		// Order it by the ordering field.
		$query->select(array('*'));
		$query->from($db->quoteName('#__categories'));
		$query->where($db->quoteName('extension') . ' = ' . $db->quote($extension));

		if($parent){
			$query->where($db->quoteName('parent_id') .' = '. $db->quote($itemId) );
		}

		if($itemDoParent){
			$query->where($db->quoteName('id') .' = '. $db->quote($itemId) );
		}
		
		$query->where($db->quoteName('published') . ' = ' . $db->quote(1));
		$query->order('lft ASC');

		// Reset the query using our newly populated query object.
		$db->setQuery($query);

		try {
			// Load the results as a list of stdClass objects (see later for more options on retrieving data).
			$results = $db->loadObjectList();

		} catch (Exception $e) {

		}

		return $results;
	}
}
