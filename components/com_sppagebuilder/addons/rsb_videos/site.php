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
class SppagebuilderAddonRSB_videos extends SppagebuilderAddons
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


		/*$output = '
		<div class="div-imagens">
		<div class="owl-carousel owl-theme rsb-videos owl-loaded owl-drag" id="nav-card-scroll">
			
		
		
		
		
		
		
		
		<div class="owl-stage-outer">
		<div class="owl-stage" style="transform: translate3d(-2712px, 0px, 0px); transition: all 0s ease 0s; width: 5464px; padding-left: 20px; padding-right: 20px;">
		<div class="owl-item" style="width: 1256px; margin-right: 100px;"><div class="nav-card shadow" style="background-color: var(--social-light-6) ">
			<div class="row">
		
				<div class="col-lg-5 div-texto">
					<span class="icone" style="background-color: var(--social-light-5)">
						<i class="icon icon-donate"  icon-fill="var(--social-dark-2)" style="width: 41.49px; height: 41.49px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" width="41.49px" height="26.38px" viewBox="0 0 86.284 70.113">    <g id="Grupo_1374" data-name="Grupo 1374" transform="translate(1.001 1.004)">      <path id="Caminho_490" data-name="Caminho 490" d="M1375.519,179.915h-8.11a3.478,3.478,0,0,1-2.46-1.019l-12.167-12.167a3.479,3.479,0,0,0-4.775-.136h0a3.479,3.479,0,0,0-.28,4.912S1359.1,184.3,1362.4,187.6s12.238,13.125,36.154,13.125l3.286,0,13.769-.7" transform="translate(-1346.843 -132.615)" fill="none" stroke="var(--social-dark-2)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_491" data-name="Caminho 491" d="M1416.971,130.2c-4.6-4.7-8.675-9.655-9.931-13.518-2.874-7.383,0-18.581,10.476-19.809s16.369,12.426,16.369,12.426,5.892-13.654,16.368-12.426,13.351,12.426,10.477,19.809c-2.751,8.461-22.322,23.215-28.115,27.9" transform="translate(-1377.588 -96.791)" fill="none" stroke="var(--social-dark-2)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_492" data-name="Caminho 492" d="M1435.658,188.634a57.566,57.566,0,0,0-7.605-.39c-6.841,0-7.923-2.151-9.749-3.639-3.171-2.583-6.976-5.08-14.88-5.08h-11.495c-3.767,0-4.956,2.586-4.956,3.775a3.886,3.886,0,0,0,4.109,3.758h12.543" transform="translate(-1367.703 -139.796)" fill="none" stroke="var(--social-dark-2)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>   </g>  </svg>  </i> 
					</span>
					<h4>Faça sua doação</h4>
					<p class="p-body" style="margin-bottom: 56px;">No Dia de Doar UPV 2023, estamos unindo forças para criar um mundo mais justo, sustentável e acolhedor para todos. 
					Junte-se a nós nesta jornada extraordinária e seja parte da transformação. </p>
		
					<!-- btn -->
					<div class="btn-nav-card" style="display: flex; align-items: center !important;">
						<a href="https://upv.org.br/" target="_blank" class="btn btn-azul-outline">FAÇA SUA DOAÇÃO</a>
					</div>
				</div>
		
				
				<div class="col-lg-7 div-video">
					<div class="capa-video">
						<span class="btn-play">
							<i class="icon icon-play"></i>
						</span>
						<img id="capa-video-upv" class="owl-lazy" data-src="https://imagehandler.rsb.org.br/WHptPo4NYO9gEDU7In-FvhGb4PE=/953x536/http://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_social.png" alt="imagem-capa-video-rede" src="https://imagehandler.rsb.org.br/WHptPo4NYO9gEDU7In-FvhGb4PE=/953x536/http://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_social.png" style="opacity: 1;">
					</div>
				</div>
		
			</div>
		</div>
	</div>
		
		<div class="owl-item" style="width: 1256px; margin-right: 100px;"><div class="nav-card shadow" style="">
			<div class="row">
				<div class="col-xxl-5 col-xs-12 div-texto">
					<span class="icone">
						<i class="icon icon-brain" icon-width="41.49" icon-height="26.38" icon-fill="var(--btn-azul)" style="width: 41.49px; height: 41.49px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" width="41.49px" height="26.38px" viewBox="0 0 78.005 50.272">    <g id="Grupo_1376" data-name="Grupo 1376" transform="translate(1.066 1.001)">      <path id="Caminho_493" data-name="Caminho 493" d="M1033.888,165.719h50.254a15.944,15.944,0,0,0,15.931-13.972c1.256-11.129-6.515-20.048-14.213-17.927,2.4-10.9-11.054-16.374-15.858-11.864-3.379-5.9-14.653-6-18.517-.342-8.33-4.721-17.755,2.024-15.02,11.787-10.141,1.316-13.5,11.974-11.725,18.73.931,3.548,3.276,6.02,6.8,5.5l19.8.014h.641c3.145-3.154-.4-7.96-3.809-9.018-4.011-1.248-7.279,2.546-11.184,1.211a4.23,4.23,0,0,1-3.022-5.058" transform="translate(-1024.289 -117.447)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_494" data-name="Caminho 494" d="M1147.361,150.848c-4.793.812-8.506,5.032-9.37,9.848" transform="translate(-1083.391 -134.809)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_495" data-name="Caminho 495" d="M1146.544,171.277c-7.014-1.091-10.042,10.411-5.8,13.958a.123.123,0,0,1-.081.216h-11.17" transform="translate(-1078.971 -145.39)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_496" data-name="Caminho 496" d="M1135.973,153.13c-2.513-.019-5.734-3.384-6.485-5.284" transform="translate(-1078.971 -133.248)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_497" data-name="Caminho 497" d="M1104.116,143.346c-1.5,2.962-5.807,3.028-6.761,6.235-1,3.36,2.712,5.189,5.288,6.539,3.931,2.056,5.524,5.112,4.824,9.561l-.007.044a5.748,5.748,0,0,1-5.692,4.764h-5.38" transform="translate(-1061.766 -130.909)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_498" data-name="Caminho 498" d="M1112.98,136.34" transform="translate(-1070.39 -127.268)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_499" data-name="Caminho 499" d="M1050.345,150.634c6.991-.1,5.941,14.038,19.269,6.827" transform="translate(-1037.833 -134.698)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_500" data-name="Caminho 500" d="M1079.966,125.835c2.152,1.315,2.312,4.456,2.171,6.743-.13,2.07-1.687,4.395-1.93,5.268" transform="translate(-1053.229 -121.807)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>    </g></svg></i>
					</span>
					<h4>Matrículas Abertas</h4>
					<p class="p-body" style="margin-bottom: 56px;">A Rede Salesiana Brasil de Escolas é a maior rede de educação católica do mundo, reunindo, só no Brasil, 100 escolas, cerca de 5 mil educadores e mais de 60 mil estudantes, da educação Infantil ao Ensino Médio.</p>
		
					<!-- btn -->
					<div class="btn-nav-card" style="display: flex; align-items: center !important;">
						<a href="https://matriculas.rsb.org.br/" target="_blank" class="btn btn-azul-outline">Matricule-se</a>
					</div>
				</div>
		
				
				<div class="col-xxl-7 col-xs-12 div-video">
					<div class="bg-video" id="bg-matriculas">
						<span class="btn-play" >
							<i class="icon icon-play" icon-width="97" icon-height="83" icon-fill="#fff" style="width: 97px; height: 97px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" width="97px" height="83px" viewBox="0 0 83 97"> <path id="Polígono_1" data-name="Polígono 1" d="M41.593,11.821a8,8,0,0,1,13.814,0l34.56,59.143A8,8,0,0,1,83.06,83H13.94A8,8,0,0,1,7.033,70.964Z" transform="translate(83) rotate(90)" fill="#fff"></path> </svg></i>
						</span>
					</div>
					<div class="capa-video">
						<img id="capa-video-matriculas" class="owl-lazy" data-src="https://imagehandler.rsb.org.br/M6eWSoJfnQv22Ea6OjYKiFJidi4=/953x536/http://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_escolas.png" alt="imagem-capa-video-matriculas" src="https://imagehandler.rsb.org.br/M6eWSoJfnQv22Ea6OjYKiFJidi4=/953x536/http://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_escolas.png" style="opacity: 1;">
					</div>
				</div>
			</div>
		</div></div><div class="owl-item active" style="width: 1256px; margin-right: 100px;"><div class="nav-card shadow" style="background-color: var(--social-light-6) ">
			<div class="row">
				<div class="col-xxl-5 col-xs-12 div-texto">
					<span class="icone" style="background-color: var(--social-light-5)">
						<i class="icon icon-donate" icon-width="41.49" icon-height="26.38" icon-fill="var(--social-dark-2)" style="width: 41.49px; height: 41.49px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" width="41.49px" height="26.38px" viewBox="0 0 86.284 70.113">    <g id="Grupo_1374" data-name="Grupo 1374" transform="translate(1.001 1.004)">      <path id="Caminho_490" data-name="Caminho 490" d="M1375.519,179.915h-8.11a3.478,3.478,0,0,1-2.46-1.019l-12.167-12.167a3.479,3.479,0,0,0-4.775-.136h0a3.479,3.479,0,0,0-.28,4.912S1359.1,184.3,1362.4,187.6s12.238,13.125,36.154,13.125l3.286,0,13.769-.7" transform="translate(-1346.843 -132.615)" fill="none" stroke="var(--social-dark-2)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_491" data-name="Caminho 491" d="M1416.971,130.2c-4.6-4.7-8.675-9.655-9.931-13.518-2.874-7.383,0-18.581,10.476-19.809s16.369,12.426,16.369,12.426,5.892-13.654,16.368-12.426,13.351,12.426,10.477,19.809c-2.751,8.461-22.322,23.215-28.115,27.9" transform="translate(-1377.588 -96.791)" fill="none" stroke="var(--social-dark-2)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>      <path id="Caminho_492" data-name="Caminho 492" d="M1435.658,188.634a57.566,57.566,0,0,0-7.605-.39c-6.841,0-7.923-2.151-9.749-3.639-3.171-2.583-6.976-5.08-14.88-5.08h-11.495c-3.767,0-4.956,2.586-4.956,3.775a3.886,3.886,0,0,0,4.109,3.758h12.543" transform="translate(-1367.703 -139.796)" fill="none" stroke="var(--social-dark-2)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>   </g>  </svg>  </i> 
					</span>
					<h4>Faça sua doação</h4>
					<p class="p-body" style="margin-bottom: 56px;">A União pela Vida (UPV) é um vasto movimento em favor
						da juventude iniciado pelos Salesianos e Salesianas para captação de doações destinadas às obras sociais
						da Congregação em todo o Brasil.</p>
		
					<!-- btn -->
					<div class="btn-nav-card" style="display: flex; align-items: center !important;">
						<a href="https://upv.org.br/" target="_blank" class="btn btn-azul-outline">FAÇA SUA DOAÇÃO</a>
					</div>
				</div>
		
				
				<div class="col-xxl-7 col-xs-12 div-video">
					<div class="bg-video" id="bg-social">
						<span class="btn-play">
							<i class="icon icon-play" icon-width="97" icon-height="83" icon-fill="#fff" style="width: 97px; height: 97px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" width="97px" height="83px" viewBox="0 0 83 97"> <path id="Polígono_1" data-name="Polígono 1" d="M41.593,11.821a8,8,0,0,1,13.814,0l34.56,59.143A8,8,0,0,1,83.06,83H13.94A8,8,0,0,1,7.033,70.964Z" transform="translate(83) rotate(90)" fill="#fff"></path> </svg></i>
						</span>
					</div>
					<div class="capa-video">
							<img id="capa-video-social" class="owl-lazy" data-src="https://imagehandler.rsb.org.br/A9qI3IDXpJhtWXc4FNVdwqESmVM=/953x536/https://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_social2.png" alt="imagem-capa-video-rede" src="https://imagehandler.rsb.org.br/A9qI3IDXpJhtWXc4FNVdwqESmVM=/953x536/https://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_social2.png" style="opacity: 1;">
					</div>
				</div>
			</div>
		</div></div><div class="owl-item" style="width: 1256px; margin-right: 100px;"><div class="nav-card shadow" style="background-color: var(--cinza-8) ">
			<div class="row">
				<div class="col-xxl-5 col-xs-12 div-texto">
					<span class="icone">
						<i class="icon icon-heart" icon-width="41.49" icon-height="26.38" icon-fill="var(--btn-azul)" style="width: 41.49px; height: 41.49px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" width="41.49px" height="26.38px" viewBox="0 0 69.772 63.561">    <path id="Caminho_476" data-name="Caminho 476" d="M1404.749,407.954c-4.324,0-8.742-2.285-12.014-5.113l-.095-.082c-8.432-7.294-24.247-21.913-27.2-31.337-3.481-9.273,0-23.336,12.685-24.878s19.82,9.706,19.82,9.706,7.135-11.247,19.82-9.706,16.166,15.606,12.685,24.878c-2.7,8.63-16.194,21.616-24.924,29.345l-2.563,2.157" transform="translate(-1363.059 -345.393)" fill="none" stroke="var(--btn-azul)" stroke-linecap="round" stroke-linejoin="round" stroke-width="2"></path>  </svg>  </i>
					</span>
					<h5 style="font-weight: 500; 
					font-size: 33px;
					letter-spacing: -1.5px;">Em Rede as Ideias Acontecem</h5>
					<p class="p-body" style="margin-bottom: 56px;">
						Atuando há mais de 135 anos no país, a Rede Salesiana Brasil conta com mais de 100 escolas, 
						mais de 100 obras sociais e 15 centros universitários, além de editora, rádios, museus e grupos jovens.
					</p>
		
					<!-- btn -->
					<div class="btn-nav-card" style="display: flex; align-items: center !important;">
						<a href="https://www.rsb.org.br/quem-somos" class="btn btn-azul-outline">CONHEÇA</a>
					</div>
				</div>
		
				
				<div class="col-xxl-7 col-xs-12 div-video">
					<div class="bg-video" id="bg-rede" style="display: none;">
						<span class="btn-play" >
							<i class="icon icon-play" icon-width="97" icon-height="83" icon-fill="#fff" style="width: 97px; height: 97px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" width="97px" height="83px"  viewBox="0 0 83 97"> <path id="Polígono_1" data-name="Polígono 1" d="M41.593,11.821a8,8,0,0,1,13.814,0l34.56,59.143A8,8,0,0,1,83.06,83H13.94A8,8,0,0,1,7.033,70.964Z" transform="translate(83) rotate(90)" fill="#fff"></path> </svg></i>
						</span>
					</div>
					<div class="capa-video">
							<iframe id="player-rede" frameborder="0" src="https://www.youtube.com/embed/oHps5mHRcN0?autoplay=1" title="YouTube video" allowfullscreen="" allow="autoplay; encrypted-media" class="player-video" style=""></iframe><img id="capa-video-rede" class="owl-lazy" data-src="https://imagehandler.rsb.org.br/0hd4WUX-XUP4LZev8NEA7ACVbsg=/953x536/https://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_institucioanl.jpg" alt="imagem-capa-video-rede" src="https://imagehandler.rsb.org.br/0hd4WUX-XUP4LZev8NEA7ACVbsg=/953x536/https://rsborgbr.s3.sa-east-1.amazonaws.com/comunicacao/campanhas/2023_02_01/capa_video_institucioanl.jpg" style="opacity: 1; display: none;">
					</div>
				</div>
			</div>
		</div></div></div></div>
		
		</div>
		';

		return $output;*/

		$settings = $this->addon->settings;
		$class = (isset($settings->class) && $settings->class) ? ' ' . $settings->class : '';

		$items = $settings->rsb_items;

		$output = '
		<div class="div-imagens">
			<div class="owl-carousel owl-theme rsb-videos owl-loaded owl-drag" id="nav-card-scroll">
				<div class="owl-stage-outer">
					<div class="owl-stage" style="transform: translate3d(-2712px, 0px, 0px); transition: all 0s ease 0s; width: 5464px; padding-left: 20px; padding-right: 20px;">
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
			$newtab = $item->btn_url->new_tab ? '_blank' : 'bb';
			$iconeA = $item->icone_alignment;
			$icone_alignment = $iconeA == 'left' ? 'left: 0' : ( $iconeA == 'right' ? 'right: 0; left: inherit' : 'left:0; right:0');
			list($link, $new_tab) = AddonHelper::parseLink($item, 'url', ['url' => 'link', 'new_tab' => 'target']);

			$hrefTag = !empty($link) ? 'href="' . $link .'"' : '';
			

			$out[] = '
				<div class="owl-item" style="width: 1256px; margin-right: 100px;">
					<div class="nav-card shadow" style="background-color:'.$item->background_color.'">
						<div class="row">
							<div class="col-lg-5 div-texto">
								<span class="icone" style="background-color:'.$item->icone_background_color.'">
									<i class="icon icon-donate">
										' . $item->icone . '
									</i> 
								</span>
								<h4>'.$item->title.'</h4>
								<p class="p-body" style="margin-bottom: 56px;">'.$item->descricao.'</p>
								<!-- btn -->
								<div class="btn-nav-card" style="display: flex; align-items: center !important;">
									<a href="'.$item->btn_url->url.'" target="' .$newtab. '" class="btn btn-azul-outline">'.$item->btn_texto.'</a>
								</div>
							</div>
					
							<div class="col-lg-7 div-video">
								<a class="rsb-video-modal" href="'.$item->video_link.'">
									<div class="capa-video rsb-video">
										<span class="btn-play">
											<i class="icon icon-play"></i>
										</span>
										<img id="capa-video-upv" class="owl-lazy" data-src="'.$item->bg_video->src.'" style="opacity: 1;">
									</div>
								</a>
							</div>
						</div>
					</div>
				</div>
			';
			
		}

		return implode('',$out);
	}


	public function stylesheets() {
		return array(
			JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_videos/assets/css/style.css?8',
			'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/assets/owl.carousel.min.css',
			'https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js',
			JUri::base(true) . '/components/com_sppagebuilder/assets/css/magnific-popup.css'
		);
	}

	public function scripts(){
		return array(
			'https://cdnjs.cloudflare.com/ajax/libs/OwlCarousel2/2.3.4/owl.carousel.min.js',
			JUri::base(true) . '/components/com_sppagebuilder/assets/js/jquery.magnific-popup.min.js'
		);
	}

	public function js(){
		$js = '
	jQuery(function($){
		$(document).ready(function(){
			$(\'#nav-card-scroll\').owlCarousel({
                lazyLoad:true,
                loop:false,
                margin:100,
                stagePadding:20,
                nav:0,
                dots:1,
                rewind:false,
                animateOut: \'fadeOut\',
                animateIn: \'\',
                navText: [\'<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="31px" viewBox="0 0 18 18" style="transform-origin: center;transform: rotate(180deg);">        <defs>          <clipPath id="clip-path">            <rect id="Retângulo_2543" data-name="Retângulo 2543" width="100" height="100" transform="translate(0.467 0.467)" fill="none"></rect>          </clipPath>        </defs>        <g id="Grupo_2605" data-name="Grupo 2605" transform="translate(-0.467 -0.467)" clip-path="url(#clip-path)">          <path id="Caminho_1005" data-name="Caminho 1005" d="M7.234,13.7a.753.753,0,0,0,1.067,0L13.31,8.693a.6.6,0,0,0,0-.85L8.3,2.834A.754.754,0,0,0,7.234,3.9L11.6,8.271l-4.37,4.37A.751.751,0,0,0,7.234,13.7" transform="translate(-2.785 -1.038)" fill="var(--btn-azul)"></path>        </g>      </svg>\',
                \'<i class="icon icon-arrow" icon-width="31" icon-height="31" icon-fill="var(--btn-azul)" style="width: 31px; height: 31px; margin: auto"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="31px" height="31px" viewBox="0 0 18 18">        <defs>          <clipPath id="clip-path">            <rect id="Retângulo_2543" data-name="Retângulo 2543" width="100" height="100" transform="translate(0.467 0.467)" fill="none"></rect>          </clipPath>        </defs>        <g id="Grupo_2605" data-name="Grupo 2605" transform="translate(-0.467 -0.467)" clip-path="url(#clip-path)">          <path id="Caminho_1005" data-name="Caminho 1005" d="M7.234,13.7a.753.753,0,0,0,1.067,0L13.31,8.693a.6.6,0,0,0,0-.85L8.3,2.834A.754.754,0,0,0,7.234,3.9L11.6,8.271l-4.37,4.37A.751.751,0,0,0,7.234,13.7" transform="translate(-2.785 -1.038)" fill="var(--btn-azul)"></path>        </g>      </svg></i>\'],
                responsive:{
        0:{
                            items: 1,
                //center:true,
                //URLhashListener:true,
                //autoplayHoverPause:true,
                //startPosition: \'URLHash\',
                nav:false,
                dots:true
                       
        },
        767:{
            items:1,
            slideBy:1
        },
        992:{
            items:1,
            slideBy:1
        },
    }
            })

			$(\'.rsb-video-modal\').magnificPopup({
				disableOn: 700,
				type: \'iframe\',
				mainClass: \'mfp-fade\',
				removalDelay: 160,
				preloader: false,
				fixedContentPos: false,
				gallery:{
					enabled:true
				  }
			});
})
})
';

return $js;
	}

}
