<?php
// imagecropper.php

defined('_JEXEC') or die;

use Joomla\CMS\Plugin\CMSPlugin;
use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Filesystem\Folder;
use Joomla\CMS\Image\Image;

class PlgContentWkImageCropper extends CMSPlugin
{
    public function onContentBeforeDisplay($context, &$article, &$params, $limitstart)
    {
        /*if ($context === 'com_content.article')
        {
            if (!empty($article->images->image_intro))
            {
                $imagePath = JPATH_SITE . '/' . $article->images->image_intro;
                
                // Use a classe Image do Joomla para manipular a imagem
                $image = new Image($imagePath);
                $image->crop(100, 100); // Exemplo: corta a imagem para 100x100 pixels
                
                // Crie uma pasta para armazenar imagens cortadas, se necessário
                $outputPath = JPATH_SITE . '/images/cropped/';
                Folder::create($outputPath);
                
                // Salve a imagem cortada
                $croppedImagePath = $outputPath . 'cropped_' . basename($imagePath);
                $image->toFile($croppedImagePath);
                
                // Atualize o caminho da imagem de introdução no artigo
                $article->images->image_intro = 'images/cropped/cropped_' . basename($imagePath);
            }
        }

        $document = JFactory::getDocument();
        $document->addScriptDeclaration('
            jQuery(document).ready(function($) {
                // Inicialize o Jcrop
                $("#image-preview").Jcrop({
                    aspectRatio: 1,
                    onSelect: function(c) {
                        // Envia os dados de recorte via AJAX
                        $.ajax({
                            type: "POST",
                            url: "index.php?option=com_ajax&plugin=yourpluginname&format=raw&task=cropimage",
                            data: {
                                x: c.x,
                                y: c.y,
                                width: c.w,
                                height: c.h
                            },
                            success: function(response) {
                                // Atualiza a imagem de introdução no artigo com a imagem recortada
                                $("#image-preview").attr("src", response);
                            }
                        });
                    }
                });
            });
        ');
        
        // ...
        
        return true;*/
    }
}
