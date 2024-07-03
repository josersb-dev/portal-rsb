<?php

/**
 * @package SP Page Builder
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2023 JoomShaper
 * @license https://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */
//no direct access
defined('_JEXEC') or die('Restricted access');

use Joomla\CMS\Language\Text;

SpAddonsConfig::addonConfig([
	'type'       => 'repeatable',
	'addon_name' => 'rsb_categorias',
	'category'   => 'RSB',
	'title'      => Text::_('RSB Categorias'),
	'desc'       => Text::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_DESC'),
	'icon'       => '<svg viewBox="0 0 32 32" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" clip-rule="evenodd" d="M23 5H9v22h14V5zM9 3c-1.1 0-2 .9-2 2v22c0 1.1.9 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2H9z" fill="currentColor"/><path d="M27.9 19.5v-6.9c0-.5.5-.7.8-.4l3.1 3.5c.2.2.2.6 0 .8L28.7 20c-.2.2-.8-.1-.8-.5zM4.1 12.5v6.9c0 .5-.5.7-.8.4L.2 16.3c-.2-.2-.2-.6 0-.8L3.3 12c.3-.2.8.1.8.5z" fill="currentColor"/><g opacity=".5" fill-rule="evenodd" clip-rule="evenodd" fill="currentColor"><path d="M25 16.2L20.9 20c-1.8 1.7-5 1.5-6.5-.4-.8-1-2.4-1.1-3.4-.2L8.6 22 7 20.8l2.5-2.5c1.8-1.8 5.1-1.7 6.6.3.8 1 2.4 1.1 3.3.2l4.1-3.8 1.5 1.2zM17.5 9c-.8 0-1.5.7-1.5 1.5s.7 1.5 1.5 1.5 1.5-.7 1.5-1.5S18.3 9 17.5 9zM14 10.5C14 8.6 15.6 7 17.5 7S21 8.6 21 10.5 19.4 14 17.5 14 14 12.4 14 10.5z"/></g></svg>',
	'settings' => [
		'carousel_items' => [
			'title' => Text::_('Categorias Itens'),
			'fields' => [
				'sp_carousel_item' => [
					'type' => 'repeatable',
					'title' => Text::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEMS'),
					'attr'  => [
						'title' => [
							'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_TITLE'),
							'fields' => [
								'title' => [
									'type'  => 'text',
									'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_TITLE'),
									'std'   => 'Where Art and Technology Collide',
								],

								/*'title_padding' => [
									'type'       => 'padding',
									'title'      => Text::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_PADDING'),
									'std'        => ['xl' => '0px 0px 0px 0px', 'lg' => '', 'md' => '', 'sm' => '', 'xs' => ''],
									'responsive' => true
								],

								'title_margin' => [
									'type'       => 'margin',
									'title'      => Text::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_TITLE_MARGIN'),
									'std'        => ['xl' => '0px 0px 0px 0px', 'lg' => '', 'md' => '', 'sm' => '', 'xs' => ''],
									'responsive' => true
								],*/
							],
						],
						'url' => [
							'type'  => 'link',
							'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
							'mediaType' => 'attachment'
						],

						'content' => [
							'title' => Text::_('COM_SPPAGEBUILDER_GLOBAL_CONTENT'),
							'fields' => [
								'bg' => [
									'type'   => 'media',
									'title'  => Text::_('Background Image'),
									'desc'   => Text::_('COM_SPPAGEBUILDER_ADDON_CAROUSEL_ITEM_IMAGE_DESC'),
									'format' => 'image',
									'std'    => ['src' => 'https://sppagebuilder.com/addons/carousel/carousel-bg.jpg']
								],
								'bg_color' => [
									'type'   => 'color',
									'title'	 => Text::_('Cor do Background')
								]
							],
						],

						'icone' => [
							'title' => Text::_('Ícone'),
							'fields' => [
								'icone' => [
									'type'  => 'textarea',
									'title' => Text::_('Ícone'),
									'desc'  => Text::_('Ícone que vai ficar no hover do card.'),
									'std'   => '<csv...',
								],

								'icone_width' => [
									'type'  => 'slider',
									'title' => Text::_('Largura'),
									'max' 	=> 500,
									'std' 	=> 300
								],

								'icone_height' => [
									'type'  => 'slider',
									'title' => Text::_('Altura'),
									'max' 	=> 500,
									'std' 	=> 300
								],
								'icone_alignment' => [
									'type'   => 'alignment',
									'title'  => Text::_('COM_SPPAGEBUILDER_GLOBAL_ALIGNMENT'),
									'std' 	 => 'center',
								]
							],
						],
						'numeros' => [
							'title' => Text::_('Números'),
							'fields' => [
								'numeros_legenda' => [
									'type'  => 'text',
									'title' => Text::_('Legenda')
								],

								'numeros_numero' => [
									'type'  => 'slider',
									'title' => Text::_('Número'),
									'max' 	=> 5000
								],
								'numeros_bordercolor' => [
									'type'   => 'color',
									'title'	 => Text::_('Cor da Borda')
								]
							],
						],
					],
				],

				'alignment_separator' => [
					'type'   => 'separator',
				]
			],
		],
	],
]);
