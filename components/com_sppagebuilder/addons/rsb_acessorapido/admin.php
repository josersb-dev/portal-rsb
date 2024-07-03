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
		'addon_name'=>'rsb_acessorapido',
		'category'=>'RSB',
		'title'=>JText::_('RSB Acesso Rápido'),
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
