<?php
/**
 * @package SP Page Builder
 * @author JoomShaper http://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2016 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

class SppagebuilderAddonRsb_portalprivacidades extends SppagebuilderAddons {

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

	
        $out[] = '<div class="conteudo">';
        $out[] =    '<div class="navegacao">';
        $out[] =        '<div class="navegacao-inner">';
        $out[] =            '<ul>';
                                foreach($items->rsb_items_menu as $menu):
        $out[] =                '<li><a href="'.$menu->url.'">'.$menu->title.'</a></li>';
                                endforeach;
        $out[] =            '</ul>';
        $out[] =        '</div>';
        $out[] =    '</div>';

        $out[] = '
        <div class="conteudo-dados" id="topo">
            <div class="cd-intro cd-item">
                <h2>'.$items->intro_title.'</h2>
                <div class="cd-content">
                    '.$items->intro_descricao.'
                </div>
            </div>
            <span class="cd-separador"></span>
        ';

            foreach($items->rsb_items as $item):
                $out[] = '
                    <div class="cd-item drop" id="'.$item->id.'">';
                        $out[] =  $item->header ? '<h2>'.$item->header.'</h2>' : '';

                        $out[] = '
                        <div class="cd-content">
                            <div class="cd-content-drop-content">
                                <div class="cd-content-drop-intro">
                                <div class="cd-content-icon">
                                    <img src="'.$item->imagem->src.'" alt="'.$item->header.'" />
                                </div>
                                <div class="cd-content-drop-inner">
                                    <p><span style="font-weight: bold;">'.$item->title.'</span></p>
                                    '.$item->resumo.'
                                    <p> <span class="leiamais"><span style="display: none;">
                                </div>
                                <span class="icon-drop"><i class="fa fa-angle-down" aria-hidden="true"></i></span>
                                </div>
                                <div class="cd-content-drop-open">
                                <div class="esconder-no-desktop">
                                    <p><span style="font-weight: bold;">'.$item->title.'</span></p>
                                    '.$item->resumo.'
                                    <p> <span class="leiamais"><span style="display: none;">
                                </div>
                                </span></span></p>
                                    '.$item->descricao.'
                                </div>
                            </div>
                        </div>
                        <span class="cd-separador"></span>
                    </div>';
            endforeach;
            $out[] = '
                <div class="cd-fina cd-item">
                    <h2>'.$items->footer_title.'</h2>
                    <div class="cd-content">
                        '.$items->footer_descricao.'
                    </div>
                </div>
            </div>
        </div>';

        return implode('',$out);
	}

	public function js() {
		return "jQuery(function($){
            $(document).ready(function() {
                var sections = $('.cd-item');
                var navLinks = $('.navegacao a');

                $(window).scroll(function() {
                    var currentPosition = $(this).scrollTop() + 60; // Adiciona 60 para compensar a altura da barra de navegação
                    var currentSection;

                    sections.each(function() {
                    var sectionTop = $(this).offset().top

                    if (currentPosition >= sectionTop) {
                        currentSection = $(this).attr('id');
                    } else {
                        return false;
                    }
                    });

                    navLinks.removeClass('active');
                    $('.navegacao a[href=\"#' + currentSection + '\"]').addClass('active');
                });

                navLinks.click(function(event) {
                    event.preventDefault();

                    var targetSection = $(this).attr('href');
                    var targetPosition = $(targetSection).offset().top - $('#sp-header').outerHeight();

                    $('html, body').animate({ scrollTop: targetPosition }, 10);
                });
                
            });

            $(document).ready(function() {
                var \$nav = $('.navegacao ul');
                var stickyOffset = \$nav.offset().top;
                var footerOffset = $('#sp-bottom').offset().top;
                var headerOut = $('#sp-header').outerHeight();
                var navHeight = \$nav.outerHeight();
          
                $(window).scroll(function() {
                  var scroll = $(window).scrollTop();
                  var bottomScrollPosition = scroll + navHeight;
          
                  if (scroll >= stickyOffset && bottomScrollPosition < footerOffset) {
                    \$nav.addClass('sticky');
                    \$nav.css('top', 90); // Reset 'top' to ensure correct positioning when sticky
                  } else {
                    \$nav.removeClass('sticky');
                    \$nav.css('top', ''); // Reset 'top' to default when not sticky
                  }
          
                  if (bottomScrollPosition >= footerOffset) {
                    \$nav.removeClass('sticky'); // Ensure sticky is removed
                    var offsetTop = footerOffset - navHeight;
                    \$nav.css('top', offsetTop - stickyOffset); // Position above footer
                  }
                });
              });

            $( \".cd-content-drop-intro\" ).on( \"click\", function(){

                let \$this = $(this);
                let \$drop = \$this.next('.cd-content-drop-open');

                if (!\$this.hasClass('desativado')) {
                    \$this.addClass('desativado');
                    \$this.toggleClass('open', !\$drop.is(':visible')); // adiciona ou remove a classe imediatamente
                    \$drop.slideToggle(\"slow\", function() {
                        \$this.removeClass('desativado');
                    });
                }
            });

            let scrollTop = (el) => {
                if (el.scrollTop() > $('#coleta-de-dados').offset().top - ($('#sp-header').outerHeight() + 30)) {
                        $('.voltar').fadeIn();
                    } else {
                        $('.voltar').fadeOut();
                    }
            }

            $(document).ready(function() {
                $(window).scroll(function() {
                    scrollTop($(this))
                });

                $('.voltar').click(function() {
                    $('html, body').animate({scrollTop : 0},800);
                    return false;
                });

                scrollTop($( document ))
            });

            //Removendo o item leiamais
            $('.leiamais').remove();
        })";
	}

	public function scripts() {
		return array('https://cdn.jsdelivr.net/npm/swiper@11/swiper-bundle.min.js');
	}

	public function stylesheets() {
		return array(JURI::base(true) . '/components/com_sppagebuilder/addons/rsb_portalprivacidades/assets/css/portal-privacidades.css?9');
	}
	
	    
}
