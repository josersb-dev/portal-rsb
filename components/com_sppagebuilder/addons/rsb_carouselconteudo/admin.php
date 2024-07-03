<?php
/**
* @package SP Page Builder
* @author JoomShaper http://www.joomshaper.com
* @copyright Copyright (c) 2010 - 2016 JoomShaper
* @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
*/
//no direct accees
defined ('_JEXEC') or die ('restricted aceess');

SpAddonsConfig::addonConfig(
	array(
		'type'=>'repeatable',
		'addon_name'=>'rsb_carouselconteudo',
		'category'=>'RSB',
		'title'=>JText::_('RSB Carousel Conteúdo'),
		'desc'=>JText::_('-'),
		'attr'=>array(
			'general' => array(

				'title'=>array(
					'type'=>'text',
					'title'=>JText::_('Título'),
					'desc'=>JText::_(''),
					'std'=> 'Título'
				),
				//repeatable
				'rsb_items'=>array(
					'title'=> JText::_('Items'),
					'attr'=>  array(

						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('Título'),
							'desc'=>JText::_(''),
							'std'=>'Título',
						),

						'imagem'=>array(
							'type'=>'media',
							'title'=>JText::_('Imagem'),
							'desc'=>JText::_(''),
							'std'=> 'aaaaa'
						),
						'descricao' => array(
							'type' => 'editor',
							'title' => 'Descrição'
						),
						'temacolor' => array(
							'type' => 'color',
							'title' => 'Cor do fundo'
						),
						'textocolor' => array(
							'type' => 'color',
							'title' => 'Cor do texto'
						),
						'url' => array(
							'type'  => 'link',
							'title' => JText::_('COM_SPPAGEBUILDER_GLOBAL_LINK'),
							'mediaType' => 'attachment'
						),

					),
				),
			),
		),
	)
);
