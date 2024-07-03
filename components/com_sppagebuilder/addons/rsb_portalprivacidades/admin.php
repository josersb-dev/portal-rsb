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
		'addon_name'=>'rsb_portalprivacidades',
		'category'=>'RSB',
		'title'=>JText::_('Portal Privacidades'),
		'desc'=>JText::_('-'),
		'attr'=>array(
			'general' => array(
				'title' => 'Introdução',

				'intro_title'=>array(
					'type'=>'text',
					'title'=>JText::_('Título'),
					'desc'=>JText::_(''),
					'std'=> ''
				),
				'intro_descricao' => array(
					'type' => 'editor',
					'title' => 'Descrição'
				),
			),
			'menu' => array(
				//repeatable
				'rsb_items_menu'=>array(
					'title'=> JText::_('Items'),
					'attr'=>  array(

						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('Título'),
							'desc'=>JText::_(''),
							'std'=>'Título',
						),
						'url' => array(
							'type'  => 'text',
							'title' => JText::_('Ancora'),
							'mediaType' => 'attachment'
						),

					),
				),
			),
			'items' => array(
				//repeatable
				'rsb_items'=>array(
					'title'=> JText::_('Items'),
					'attr'=>  array(

						'header'=>array(
							'type'=>'text',
							'title'=>JText::_('Header'),
							'desc'=>JText::_(''),
							'std'=>'',
						),
						'imagem'=>array(
							'type'=>'media',
							'title'=>JText::_('Imagem'),
							'desc'=>JText::_(''),
							'std'=> ''
						),
						'title'=>array(
							'type'=>'text',
							'title'=>JText::_('Título'),
							'desc'=>JText::_(''),
							'std'=>'Título',
						),
						'resumo'=>array(
							'type'=>'editor',
							'title'=>JText::_('Resumo'),
							'desc'=>JText::_(''),
							'std'=>'',
						),
						'descricao' => array(
							'type' => 'editor',
							'title' => 'Descrição'
						),
						'id'=>array(
							'type'=>'text',
							'title'=>JText::_('ID'),
							'desc'=>JText::_(''),
							'std'=>'',
						),
					),
				),
			),
			'footer' => array(
				'title' => 'Introdução',

				'footer_title'=>array(
					'type'=>'text',
					'title'=>JText::_('Título'),
					'desc'=>JText::_(''),
					'std'=> ''
				),
				'footer_descricao' => array(
					'type' => 'editor',
					'title' => 'Descrição'
				),
			),
		),
	)
);
