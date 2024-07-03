<?php

/**
 * @package SP Page Builder
 * @author JoomShaper https://www.joomshaper.com
 * @copyright Copyright (c) 2010 - 2022 JoomShaper
 * @license http://www.gnu.org/licenses/gpl-2.0.html GNU/GPLv2 or later
 */

//no direct accees
defined('_JEXEC') or die('restricted access');

use Joomla\CMS\Uri\Uri;
use Joomla\CMS\Layout\FileLayout;

class SppagebuilderAddonRSB_slideshow extends SppagebuilderAddons
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
		$class = (isset($settings->class) && $settings->class) ? '' . $settings->class : '';
		$slide_vertically = (isset($settings->slide_vertically) && $settings->slide_vertically) ? $settings->slide_vertically : 0;
		$three_d_rotate = (isset($settings->three_d_rotate) && gettype($settings->three_d_rotate) == 'string') ? $settings->three_d_rotate : '';
		$autoplay = (isset($settings->autoplay) && $settings->autoplay) ? $settings->autoplay : '';
		$pause_on_hover = (isset($settings->pause_on_hover) && $settings->pause_on_hover) ? $settings->pause_on_hover : '';
		$interval = (isset($settings->interval) && $settings->interval) ? $settings->interval : 5;
		$speed = (isset($settings->speed) && $settings->speed) ? $settings->speed : '';
		$content_container_option = (isset($settings->content_container_option) && $settings->content_container_option) ? $settings->content_container_option : '';
		//Height
		$height = (isset($settings->height) && $settings->height) ? $settings->height : '';
		$custom_height_xxl = (isset($settings->custom_height_xxl) && $settings->custom_height_xxl) ? $settings->custom_height_xxl . 'px' : '';
		$custom_height_xl = (isset($settings->custom_height_xl) && $settings->custom_height_xl) ? $settings->custom_height_xl . 'px' : '';
		$custom_height_lg = (isset($settings->custom_height_lg) && $settings->custom_height_lg) ? $settings->custom_height_lg . 'px' : '';
		$custom_height_md = (isset($settings->custom_height_md) && $settings->custom_height_md) ? $settings->custom_height_md . 'px' : '';
		$custom_height_sm = (isset($settings->custom_height_sm) && $settings->custom_height_sm) ? $settings->custom_height_sm . 'px' : '';
		$custom_height_xs = (isset($settings->custom_height_xs) && $settings->custom_height_xs) ? $settings->custom_height_xs . 'px' : '';
		$slider_animation = (isset($settings->slider_animation) && $settings->slider_animation) ? $settings->slider_animation : '';

		//Verticle slide
		$dataVerticleSlide = '';
		if ($slider_animation === 'stack') {
			$dataVerticleSlide = 'data-slide-vertically="' . ($slide_vertically ? 'true' : 'false') . '"';
		}
		//3D rotate
		$data_three_d_rotate = '';
		if ($slider_animation === '3D') {
			$data_three_d_rotate = 'data-3d-rotate="' . ($three_d_rotate ? $three_d_rotate : '15') . '"';
		}
		//Timer
		$timer = (isset($settings->timer) && $settings->timer) ? $settings->timer : '';
		//Slide counter
		$slide_counter = (isset($settings->slide_counter) && $settings->slide_counter) ? $settings->slide_counter : '';
		//Dot
		$dot_controllers = (isset($settings->dot_controllers) && $settings->dot_controllers) ? $settings->dot_controllers : '';
		$dot_controllers_style = (isset($settings->dot_controllers_style) && $settings->dot_controllers_style) ? $settings->dot_controllers_style : '';
		$dot_controllers_position = (isset($settings->dot_controllers_position) && $settings->dot_controllers_position) ? $settings->dot_controllers_position : '';
		//Arrow
		$arrow_controllers = (isset($settings->arrow_controllers) && $settings->arrow_controllers) ? $settings->arrow_controllers : '';
		$arrow_controllers_content = (isset($settings->arrow_controllers_content) && $settings->arrow_controllers_content) ? $settings->arrow_controllers_content : '';
		$arrow_controllers_style = (isset($settings->arrow_controllers_style) && $settings->arrow_controllers_style) ? $settings->arrow_controllers_style : '';
		$arrow_controllers_position = (isset($settings->arrow_controllers_position) && $settings->arrow_controllers_position) ? $settings->arrow_controllers_position : '';
		$arrow_on_hover = (isset($settings->arrow_on_hover) && $settings->arrow_on_hover) ? $settings->arrow_on_hover : '';
		//Line
		$line_indecator = (isset($settings->line_indecator) && $settings->line_indecator) ? $settings->line_indecator : '';

		//Height calculate
		$slider_height_xxl = '';
		$slider_height_xl = '';
		$slider_height_lg = '';
		$slider_height_md = '';
		$slider_height_sm = '';
		$slider_height_xs = '';
		if ($height == 'full') {
			$slider_height_xxl = 'full';
			$slider_height_xl = 'full';
			$slider_height_lg = 'full';
			$slider_height_md = 'full';
			$slider_height_sm = 'full';
			$slider_height_xs = 'full';
		} else {
			$slider_height_xxl = $custom_height_xxl;
			$slider_height_xl = $custom_height_xl;
			$slider_height_lg = $custom_height_lg;
			$slider_height_md = $custom_height_md;
			$slider_height_sm = $custom_height_sm;
			$slider_height_xs = $custom_height_xs;
		}

		//Dot classes
		$dot_style_class = '';
		$dot_position_class = '';
		if ($dot_controllers) {
			if ($dot_controllers_style) {
				$dot_style_class = 'dot-controller-' . $dot_controllers_style;
			}
			if ($dot_controllers_position) {
				$dot_position_class = 'dot-controller-position-' . $dot_controllers_position;
			}
		}
		//Arrow Classes
		$arrow_position_class = '';
		if ($arrow_controllers_style == "along" &&  $arrow_controllers_position) {
			$arrow_position_class = 'arrow-position-' . $arrow_controllers_position;
		}
		$arrow_hover_class = '';
		if ($arrow_on_hover) {
			$arrow_hover_class = 'arrow-show-on-hover';
		}
		//Content
		$content_vertical_alignment = (isset($settings->content_vertical_alignment) && $settings->content_vertical_alignment) ? $settings->content_vertical_alignment : '';

		//Output
		$dots = '';
		$output = '';
		$output .= '<div id="sppb-sp-slider-' . $this->addon->id . '" data-id="sppb-sp-slider-' . $this->addon->id . '" class="sppb-addon-sp-slider rsb-slider sp-slider ' . $class . ' ' . $dot_style_class . ' ' . $dot_position_class . ' ' . $arrow_position_class . ' ' . $arrow_hover_class . '" data-height-xxl="' . $slider_height_xxl . '" data-height-xl="' . $slider_height_xl . '" data-height-lg="' . $slider_height_lg . '" data-height-md="' . $slider_height_md . '" data-height-sm="' . $slider_height_sm . '" data-height-xs="' . $slider_height_xs . '" data-slider-animation="' . $slider_animation . '" ' . $dataVerticleSlide . ' ' . $data_three_d_rotate . ' data-autoplay="' . ($autoplay ? 'true' : 'false') . '" data-interval="' . ($interval ? $interval * 1000 : '4000') . '" data-timer="' . ($timer ? 'true' : 'false') . '" data-speed="' . ($speed ? $speed : 800) . '" data-dot-control="' . ($dot_controllers ? 'true' : 'false') . '" data-arrow-control="' . ($arrow_controllers ? 'true' : 'false') . '" data-indecator="' . ($line_indecator ? 'true' : 'false') . '" data-arrow-content="' . ($arrow_controllers_content ? $arrow_controllers_content : 'text_only') . '" data-slide-count="' . ($slide_counter ? 'true' : 'false') . '" data-dot-style="' . $dot_controllers_style . '" data-pause-hover="' . ($pause_on_hover && $autoplay ? 'true' : 'false') . '">';

		if (isset($settings->slideshow_items) && is_array($settings->slideshow_items)) {
			$increasing_addon_id = $this->addon->id;
			foreach ($settings->slideshow_items as $item_key => $item_value) {
				if ($increasing_addon_id === $increasing_addon_id) {
					$increasing_addon_id++;
				}
				$uniqid = 'sp-slider-item-' . $this->addon->id . '-num-' . $item_key . '-key';

				$output .= '<div id="' . $uniqid . '" class="sp-item ' . (($item_key == 0) ? ' active' : '') . ' ' . ($content_vertical_alignment ? 'slider-content-vercally-center' : '') . '">';
				if ($content_container_option === 'bootstrap') {
					$output .= '<div class="sppb-container">';
					$output .= '<div class="sppb-row">';
					$output .= '<div class="sppb-col-sm-12">';
				} else {
					$output .= '<div class="sp-slider-content-wrap">';
				}

				$image_in_column = (isset($item_value->image_in_column) && $item_value->image_in_column) ? $item_value->image_in_column : '';

				$image_column_width = (isset($item_value->image_column_width->md) && $item_value->image_column_width->md) ? $item_value->image_column_width->md : 6;
				$image_column_width_sm = (isset($item_value->image_column_width->sm) && $item_value->image_column_width->sm) ? $item_value->image_column_width->sm : 6;
				$image_column_width_xs = (isset($item_value->image_column_width->xs) && $item_value->image_column_width->xs) ? $item_value->image_column_width->xs : 6;

				$image_column_reverse = (isset($item_value->image_column_reverse) && $item_value->image_column_reverse) ? $item_value->image_column_reverse : '';
				$icon_display_block = (isset($item_value->icon_display_block) && $item_value->icon_display_block) ? $item_value->icon_display_block : '';
				$content_alignment = (isset($item_value->content_alignment) && $item_value->content_alignment) ? $item_value->content_alignment : '';
				$image_content_alignment = (isset($item_value->image_content_alignment) && $item_value->image_content_alignment) ? $item_value->image_content_alignment : '';

				if (!$image_in_column) {
					$output .= '<div class="sp-slider-content-align-' . $content_alignment . '">';
					if (isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)) {
						foreach ($item_value->slideshow_inner_items as $inner_item_key => $inner_value) {
							$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id . '-num-' . $inner_item_key . '-key';
							$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' ' . $inner_value->content_class : '';

							//Common animation options for settings
							$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
							$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
							$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
							$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
							if ($animation_timing_function == 'cubic-bezier') {
								$animation_timing_function = 'cubic-bezier(' . $animation_cubic_bezier_value . ')';
							}
							//Slide animation options
							$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
							$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
							$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

							//Rotate animation options
							$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
							$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

							//animation settings
							$animation_settings = '';
							if ($content_animation_type == 'rotate') {
								$animation_settings = '"type":"rotate","from":"' . $animation_rotate_from . 'deg", "to":"' . $animation_rotate_to . 'deg","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
							} elseif ($content_animation_type == 'text-animate') {
								$animation_settings = '"type":"text-animate","direction":"' . $animation_slide_direction . '","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
							} elseif ($content_animation_type == 'zoom') {
								$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
							} else {
								$animation_settings = '"type":"slide","direction":"' . $animation_slide_direction . '","from":"' . $animation_slide_from . '%", "to":"0%","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
							}

							//Content type
							$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
							//Title
							$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
							$title_heading_selector = (isset($inner_value->title_heading_selector) && $inner_value->title_heading_selector) ? $inner_value->title_heading_selector : 'h2';
							//Text
							$content_text = (isset($inner_value->content_text) && $inner_value->content_text) ? $inner_value->content_text : '';
							//Image
							$image_content = (isset($inner_value->image_content) && $inner_value->image_content) ? $inner_value->image_content : '';
							$image_content_src = isset($image_content->src) ? $image_content->src : $image_content;
							//Button
							$btn_content = (isset($inner_value->btn_content) && $inner_value->btn_content) ? $inner_value->btn_content : '';
							$button_url = (isset($inner_value->button_url) && $inner_value->button_url) ? $inner_value->button_url : '';
							$button_target = (isset($inner_value->button_target) && $inner_value->button_target) ? $inner_value->button_target : '';
							$button_icon = (isset($inner_value->button_icon) && $inner_value->button_icon) ? $inner_value->button_icon : '';
							$button_icon_position = (isset($inner_value->button_icon_position) && $inner_value->button_icon_position) ? $inner_value->button_icon_position : '';

							$icon_arr = array_filter(explode(' ', $button_icon));
							if (count($icon_arr) === 1) {
								$button_icon = 'fa ' . $button_icon;
							}

							if ($button_icon_position == 'left') {
								$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"><i class="' . $button_icon . '"></i></span> ' . $btn_content . '</span>' : '<span class="sp-slider-btn-text">' . $btn_content . '</span>';
							} else {
								$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text">' . $btn_content . ' <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span></span>' : '<span class="sp-slider-btn-text">' . $btn_content . '</span>';
							}

							//Icon
							$icon_content = (isset($inner_value->icon_content) && $inner_value->icon_content) ? $inner_value->icon_content : '';

							$icon_content_arr = array_filter(explode(' ', $icon_content));
							if (count($icon_content_arr) === 1) {
								$icon_content = 'fa ' . $icon_content;
							}

							if ($content_type == 'text_content') {
								$output .= '<div id="' . $inner_uniqid . '" class="sppb-sp-slider-text' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
								$output .= $content_text;
								$output .= '</div>';
							} elseif ($content_type == 'image_content') {
								$output .= '<div id="' . $inner_uniqid . '" class="sppb-sp-slider-image' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
								$output .= '<img src="' . $image_content_src . '" alt="' . $title_content_title . '"/>';
								$output .= '</div>';
							} elseif ($content_type == 'btn_content') {
								$output .= '<a id="' . $inner_uniqid . '" ' . ($button_target == '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '') . ' class="sppb-sp-slider-button' . $content_class . '" href="' . $button_url . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
								$output .= $btn_content;
								$output .= '</a>';
							} elseif ($content_type == 'icon_content') {
								$output .= '<span id="' . $inner_uniqid . '" class="sppb-sp-slider-icon' . $content_class . ' ' . ($icon_display_block ? 'sp-slider-icon-block' : '') . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
								$output .= '<span class="' . $icon_content . '" aria-hidden="true"></span>';
								$output .= '</span>';
							} elseif ($content_type == 'title_content') {
								$output .= '<' . $title_heading_selector . ' id="' . $inner_uniqid . '" class="sppb-sp-slider-title' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
								$output .= $title_content_title;
								$output .= '</' . $title_heading_selector . '>';
							}
						}
					}
					$output .= '</div>'; //.sp-slider-content-align
				} else {
					$output .= '<div class="sppb-row">';
					if (!$image_column_reverse) {
						$output .= '<div class="sppb-col-xs-' . ($image_column_width_xs == 12 ? 12 : (12 - $image_column_width_xs)) . ' sppb-col-sm-' . ($image_column_width_sm == 12 ? 12 : (12 - $image_column_width_sm)) . ' sppb-col-md-' . ($image_column_width == 12 ? 12 : (12 - $image_column_width)) . '">';
						$output .= '<div class="sp-slider-content-align-' . $content_alignment . '">';
						if (isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)) {
							foreach ($item_value->slideshow_inner_items as $inner_item_key => $inner_value) {
								$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id . '-num-' . $inner_item_key . '-key';
								$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' ' . $inner_value->content_class : '';

								//Common animation options for settings
								$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
								$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
								$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
								$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
								if ($animation_timing_function == 'cubic-bezier') {
									$animation_timing_function = 'cubic-bezier(' . $animation_cubic_bezier_value . ')';
								}

								//Slide animation options
								$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
								$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
								$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

								//Rotate animation options
								$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
								$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

								//animation settings
								$animation_settings = '';
								if ($content_animation_type == 'rotate') {
									$animation_settings = '"type":"rotate","from":"' . $animation_rotate_from . 'deg", "to":"' . $animation_rotate_to . 'deg","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'text-animate') {
									$animation_settings = '"type":"text-animate","direction":"' . $animation_slide_direction . '","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'zoom') {
									$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} else {
									$animation_settings = '"type":"slide","direction":"' . $animation_slide_direction . '","from":"' . $animation_slide_from . '%", "to":"0%","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								}

								//Content type
								$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
								//Title
								$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
								$title_heading_selector = (isset($inner_value->title_heading_selector) && $inner_value->title_heading_selector) ? $inner_value->title_heading_selector : 'h2';
								//Text
								$content_text = (isset($inner_value->content_text) && $inner_value->content_text) ? $inner_value->content_text : '';
								//Button
								$btn_content = (isset($inner_value->btn_content) && $inner_value->btn_content) ? $inner_value->btn_content : '';
								$button_url = (isset($inner_value->button_url) && $inner_value->button_url) ? $inner_value->button_url : '';
								$button_target = (isset($inner_value->button_target) && $inner_value->button_target) ? $inner_value->button_target : '';
								$button_icon = (isset($inner_value->button_icon) && $inner_value->button_icon) ? $inner_value->button_icon : '';
								$button_icon_position = (isset($inner_value->button_icon_position) && $inner_value->button_icon_position) ? $inner_value->button_icon_position : '';

								$icon_arr = array_filter(explode(' ', $button_icon));
								if (count($icon_arr) === 1) {
									$button_icon = 'fa ' . $button_icon;
								}
								if ($button_icon_position == 'left') {
									$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span> ' . $btn_content . '</span>' : '<span class="sp-slider-btn-text">' . $btn_content . '</span>';
								} else {
									$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text">' . $btn_content . ' <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span></span>' : '<span class="sp-slider-btn-text">' . $btn_content . '</span>';
								}

								//Icon
								$icon_content = (isset($inner_value->icon_content) && $inner_value->icon_content) ? $inner_value->icon_content : '';

								$icon_content_arr = array_filter(explode(' ', $icon_content));
								if (count($icon_content_arr) === 1) {
									$icon_content = 'fa ' . $icon_content;
								}

								if ($content_type == 'text_content') {
									$output .= '<div id="' . $inner_uniqid . '" class="sppb-sp-slider-text' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= $content_text;
									$output .= '</div>';
								} elseif ($content_type == 'btn_content') {
									$output .= '<a id="' . $inner_uniqid . '" ' . ($button_target == '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '') . ' class="sppb-sp-slider-button' . $content_class . '" href="' . $button_url . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= $btn_content;
									$output .= '</a>';
								} elseif ($content_type == 'icon_content') {
									$output .= '<span id="' . $inner_uniqid . '" class="sppb-sp-slider-icon' . $content_class . ' ' . ($icon_display_block ? 'sp-slider-icon-block' : '') . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= '<span class="' . $icon_content . '" aria-hidden="true"></span>';
									$output .= '</span>';
								} elseif ($content_type == 'title_content') {
									$output .= '<' . $title_heading_selector . ' id="' . $inner_uniqid . '" class="sppb-sp-slider-title' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= $title_content_title;
									$output .= '</' . $title_heading_selector . '>';
								}
							}
						}
						$output .= '</div>'; //.sp-slider-content-align
						$output .= '</div>'; //sppb-column

						$output .= '<div class="sppb-col-xs-' . $image_column_width_xs . ' sppb-col-sm-' . $image_column_width_sm . ' sppb-col-md-' . $image_column_width . ' image-align-' . $image_content_alignment . '">';
						$output .= '<div class="sp-slider-image-align-' . $image_content_alignment . '">';
						if (isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)) {
							foreach ($item_value->slideshow_inner_items as $inner_item_key => $inner_value) {
								$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id . '-num-' . $inner_item_key . '-key';
								$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' ' . $inner_value->content_class : '';

								//Common animation options for settings
								$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
								$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
								$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
								$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
								if ($animation_timing_function == 'cubic-bezier') {
									$animation_timing_function = 'cubic-bezier(' . $animation_cubic_bezier_value . ')';
								}

								//Slide animation options
								$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
								$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
								$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

								//Rotate animation options
								$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
								$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

								//animation settings
								$animation_settings = '';
								if ($content_animation_type == 'rotate') {
									$animation_settings = '"type":"rotate","from":"' . $animation_rotate_from . 'deg", "to":"' . $animation_rotate_to . 'deg","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'text-animate') {
									$animation_settings = '"type":"text-animate","direction":"' . $animation_slide_direction . '","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'zoom') {
									$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} else {
									$animation_settings = '"type":"slide","direction":"' . $animation_slide_direction . '","from":"' . $animation_slide_from . '%", "to":"0%","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								}

								//Content type
								$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
								//Image
								$image_content = (isset($inner_value->image_content) && $inner_value->image_content) ? $inner_value->image_content : '';
								$image_content_src = isset($image_content->src) ? $image_content->src : $image_content;
								$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';

								if ($content_type == 'image_content') {
									$output .= '<div id="' . $inner_uniqid . '" class="sppb-sp-slider-image' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= '<img src="' . $image_content_src . '" alt="' . $title_content_title . '">';
									$output .= '</div>';
								}
							}
						}
						$output .= '</div>'; //.sp-slider-content-align
						$output .= '</div>'; //sppb-column

					} else {
						$output .= '<div class="sppb-col-xs-' . $image_column_width_xs . ' sppb-col-sm-' . $image_column_width_sm . ' sppb-col-md-' . $image_column_width . '  image-align-' . $image_content_alignment . '">';
						$output .= '<div class="sp-slider-image-align-' . $image_content_alignment . '">';
						if (isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)) {
							foreach ($item_value->slideshow_inner_items as $inner_item_key => $inner_value) {
								$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id . '-num-' . $inner_item_key . '-key';
								$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' ' . $inner_value->content_class : '';

								//Common animation options for settings
								$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
								$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
								$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
								$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
								if ($animation_timing_function == 'cubic-bezier') {
									$animation_timing_function = 'cubic-bezier(' . $animation_cubic_bezier_value . ')';
								}

								//Slide animation options
								$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
								$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
								$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

								//Rotate animation options
								$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
								$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

								//animation settings
								$animation_settings = '';
								if ($content_animation_type == 'rotate') {
									$animation_settings = '"type":"rotate","from":"' . $animation_rotate_from . 'deg", "to":"' . $animation_rotate_to . 'deg","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'text-animate') {
									$animation_settings = '"type":"text-animate","direction":"' . $animation_slide_direction . '","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'zoom') {
									$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} else {
									$animation_settings = '"type":"slide","direction":"' . $animation_slide_direction . '","from":"' . $animation_slide_from . '%", "to":"0%","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								}

								//Content type
								$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
								//Image
								$image_content = (isset($inner_value->image_content) && $inner_value->image_content) ? $inner_value->image_content : '';
								$image_content_src = isset($image_content->src) ? $image_content->src : $image_content;
								$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';

								if ($content_type == 'image_content') {
									$output .= '<div id="' . $inner_uniqid . '" class="sppb-sp-slider-image' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= '<img src="' . $image_content_src . '" alt="' . $title_content_title . '">';
									$output .= '</div>'; //.sppb-sp-slider-image
								}
							}
						}
						$output .= '</div>'; //.sp-slider-content-align
						$output .= '</div>'; //sppb-column

						$output .= '<div class="sppb-col-xs-' . ($image_column_width_xs == 12 ? 12 : (12 - $image_column_width_xs)) . ' sppb-col-sm-' . ($image_column_width_sm == 12 ? 12 : (12 - $image_column_width_sm)) . ' sppb-col-md-' . ($image_column_width == 12 ? 12 : (12 - $image_column_width)) . '">';
						$output .= '<div class="sp-slider-content-align-' . $content_alignment . '">';
						if (isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)) {
							foreach ($item_value->slideshow_inner_items as $inner_item_key => $inner_value) {
								$inner_uniqid = 'sp-slider-inner-item-' . $increasing_addon_id . '-num-' . $inner_item_key . '-key';
								$content_class = (isset($inner_value->content_class) && $inner_value->content_class) ? ' ' . $inner_value->content_class : '';

								//Common animation options for settings
								$animation_duration = (isset($inner_value->animation_duration) && $inner_value->animation_duration != '') ? $inner_value->animation_duration : 800;
								$animation_delay = (isset($inner_value->animation_delay) && $inner_value->animation_delay != '') ? $inner_value->animation_delay : 1000;
								$animation_timing_function = (isset($inner_value->animation_timing_function) && $inner_value->animation_timing_function) ? $inner_value->animation_timing_function : 'ease';
								$animation_cubic_bezier_value = (isset($inner_value->animation_cubic_bezier_value) && $inner_value->animation_cubic_bezier_value) ? $inner_value->animation_cubic_bezier_value : '';
								if ($animation_timing_function == 'cubic-bezier') {
									$animation_timing_function = 'cubic-bezier(' . $animation_cubic_bezier_value . ')';
								}

								//Slide animation options
								$content_animation_type = (isset($inner_value->content_animation_type) && $inner_value->content_animation_type) ? $inner_value->content_animation_type : 'slide';
								$animation_slide_direction = (isset($inner_value->animation_slide_direction) && $inner_value->animation_slide_direction) ? $inner_value->animation_slide_direction : 'top';
								$animation_slide_from = (isset($inner_value->animation_slide_from) && gettype($inner_value->animation_slide_from) == 'string') ? $inner_value->animation_slide_from : 100;

								//Rotate animation options
								$animation_rotate_from = (isset($inner_value->animation_rotate_from) && gettype($inner_value->animation_rotate_from) == 'string') ? $inner_value->animation_rotate_from : '';
								$animation_rotate_to = (isset($inner_value->animation_rotate_to) && gettype($inner_value->animation_rotate_to) == 'string') ? $inner_value->animation_rotate_to : '';

								//animation settings
								$animation_settings = '';
								if ($content_animation_type == 'rotate') {
									$animation_settings = '"type":"rotate","from":"' . $animation_rotate_from . 'deg", "to":"' . $animation_rotate_to . 'deg","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'text-animate') {
									$animation_settings = '"type":"text-animate","direction":"' . $animation_slide_direction . '","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} elseif ($content_animation_type == 'zoom') {
									$animation_settings = '"type":"zoom","direction":"zoomIn","from":"0", "to":"1","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								} else {
									$animation_settings = '"type":"slide","direction":"' . $animation_slide_direction . '","from":"' . $animation_slide_from . '%", "to":"0%","duration":"' . $animation_duration . '","after":"' . $animation_delay . '", "timing_function":"' . $animation_timing_function . '"';
								}

								//Content type
								$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
								//Title
								$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
								$title_heading_selector = (isset($inner_value->title_heading_selector) && $inner_value->title_heading_selector) ? $inner_value->title_heading_selector : 'h2';
								//Text
								$content_text = (isset($inner_value->content_text) && $inner_value->content_text) ? $inner_value->content_text : '';
								//Button
								$btn_content = (isset($inner_value->btn_content) && $inner_value->btn_content) ? $inner_value->btn_content : '';
								$button_url = (isset($inner_value->button_url) && $inner_value->button_url) ? $inner_value->button_url : '';
								$button_target = (isset($inner_value->button_target) && $inner_value->button_target) ? $inner_value->button_target : '';
								$button_icon = (isset($inner_value->button_icon) && $inner_value->button_icon) ? $inner_value->button_icon : '';
								$button_icon_position = (isset($inner_value->button_icon_position) && $inner_value->button_icon_position) ? $inner_value->button_icon_position : '';

								$icon_arr = array_filter(explode(' ', $button_icon));
								if (count($icon_arr) === 1) {
									$button_icon = 'fa ' . $button_icon;
								}

								if ($button_icon_position == 'left') {
									$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span> ' . $btn_content . '</span>' : '<span class="sp-slider-btn-text">' . $btn_content . '</span>';
								} else {
									$btn_content = ($button_icon) ? '<span class="sp-slider-btn-text">' . $btn_content . ' <span class="sp-slider-btn-icon"><i class="' . $button_icon . '" aria-hidden="true"></i></span></span>' : '<span class="sp-slider-btn-text">' . $btn_content . '</span>';
								}

								//Icon
								$icon_content = (isset($inner_value->icon_content) && $inner_value->icon_content) ? $inner_value->icon_content : '';

								$icon_content_arr = array_filter(explode(' ', $icon_content));
								if (count($icon_content_arr) === 1) {
									$icon_content = 'fa ' . $icon_content;
								}

								if ($content_type == 'text_content') {
									$output .= '<div id="' . $inner_uniqid . '" class="sppb-sp-slider-text' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= $content_text;
									$output .= '</div>';
								} elseif ($content_type == 'btn_content') {
									$output .= '<a id="' . $inner_uniqid . '" ' . ($button_target == '_blank' ? 'target="_blank" rel="noopener noreferrer"' : '') . ' class="sppb-sp-slider-button' . $content_class . '" href="' . $button_url . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= $btn_content;
									$output .= '</a>';
								} elseif ($content_type == 'icon_content') {
									$output .= '<span id="' . $inner_uniqid . '" class="sppb-sp-slider-icon' . $content_class . ' ' . ($icon_display_block ? 'sp-slider-icon-block' : '') . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= '<span class="' . $icon_content . '" aria-hidden="true"></span>';
									$output .= '</span>';
								} elseif ($content_type == 'title_content') {
									$output .= '<' . $title_heading_selector . ' id="' . $inner_uniqid . '" class="sppb-sp-slider-title' . $content_class . '" data-layer="true" data-animation=\'{' . $animation_settings . '}\'>';
									$output .= $title_content_title;
									$output .= '</' . $title_heading_selector . '>';
								}
							}
						}
						$output .= '</div>'; //.sp-slider-content-align
						$output .= '</div>'; //sppb-column
					}
					$output .= '</div>'; //sppb-row
				}
				if ($content_container_option === 'bootstrap') {
					$output .= '</div>'; //.sppb-col-sm-12
					$output .= '</div>'; //.sppb-row
					$output .= '</div>'; //.sppb-container
				} else {
					$output .= '</div>'; //.sp-slider-content-wrap
				}
				$slider_img = (isset($item_value->slider_img) && $item_value->slider_img) ? $item_value->slider_img : '';
				$slider_img_src = isset($slider_img->src) ? $slider_img->src : $slider_img;
				if ($slider_img_src) {
					if (strpos($slider_img_src, "http://") !== false || strpos($slider_img_src, "https://") !== false) {
                        $output .= $item_value->link ? '<a href="'.$item_value->link.'" target="_blank">' : '';
						$output .= '<div class="sp-background" style="background-image: url(' . $slider_img_src . ');"></div>';
                        $output .= $item_value->link ? '</a>' : '';
					} else {
                        $output .= $item_value->link ? '<a href="'.$item_value->link.'" target="_blank" >' : '';
						$output .= '<div class="sp-background" style="background-image: url(' . Uri::base() . $slider_img_src . ');"></div>';
                        $output .= $item_value->link ? '</a>' : '';
					}
				}
				if ($slider_animation != '3D') {
					$slider_video = (isset($item_value->slider_video) && $item_value->slider_video) ? $item_value->slider_video : '';
					$slider_video_src = isset($slider_video->src) ? $slider_video->src : $slider_video;
					if (($slider_video_src) && !$item_value->enable_youtube_vimeo) {
						if (strpos($slider_video_src, "http://") !== false || strpos($slider_video_src, "https://") !== false) {
							$output .= '<div class="sp-video-background" data-video_src="' . $slider_video_src . '"></div>';
						} else {
							$output .= '<div class="sp-video-background" data-video_src="' . Uri::base() . $slider_video_src . '"></div>';
						}
					} else if (isset($item_value->youtube_vimeo_url) && $item_value->youtube_vimeo_url && $item_value->enable_youtube_vimeo) {
						if (strpos($item_value->youtube_vimeo_url, "http://") !== false || strpos($item_value->youtube_vimeo_url, "https://") !== false) {
							$output .= '<div class="sp-video-background" data-video_src="' . $item_value->youtube_vimeo_url . '"></div>';
						} else {
							$output .= '<div class="sp-video-background" data-video_src="' . Uri::base() . $item_value->youtube_vimeo_url . '"></div>';
						}
					}
				}

				if ($dot_controllers_style == 'with_text') {
					$captionItem = [];
					if (isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)) {
						$dot_item = 0;
						foreach ($item_value->slideshow_inner_items as $inner_item_key => $inner_value) {
							$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
							if ($content_type == 'title_content' && $dot_item < 2) {
								array_unshift($captionItem, $inner_value);
							}
							$dot_item++;
						}
					}
					$dots .= '<li class="' . ($item_key == 0 ? 'active sp-text-thumbnail-list' : 'sp-text-thumbnail-list') . '">';
					$dots .= '<div class="sp-slider-text-thumb-number">' . ($item_key > 8 ? ($item_key + 1) : '0' . ($item_key + 1) . '') . '</div>'; //.sp-slider-text-thumb-number
					$dots .= '<div class="sp-dot-indicator-wrap">';
					$dots .= '<span class="dot-indicator"></span>';
					$dots .= '</div>'; //.sp-dot-indicator-wrap
					$dots .= '<div class="sp-slider-text-thumb-caption">';
					if (count($captionItem) > 0) {
						foreach ($captionItem as $dot_key => $inner_value) {
							//Content type
							$title_content_title = (isset($inner_value->title_content_title) && $inner_value->title_content_title) ? $inner_value->title_content_title : '';
							$dots .= '<div class="sp-slider-dot-indecator-text sp-dot-text-key-' . ($dot_key + 1) . '">';
							$dots .= $title_content_title;
							$dots .= '</div>'; //.sp-slider-dot-indecator-text
						}
					}
					$dots .= '</div>'; //.sp-slider-text-thumb-caption
					$dots .= '</li>';
				}

				$output .= '</div>';
			}
		}
		if ($dot_controllers_style == 'with_text' && $dot_controllers) {
			$output .= '<div class="sp-slider-custom-dot-indecators">
						<ul>
							' . $dots . '
						</ul>';
			$output .= '</div>'; //.sp-slider-custom-dot-indecators
		}

		$output .= '</div>'; //.sppb-addon-sp-slider

		return $output;
	}
	/**
	 * Add scripts to the document.
	 *
	 * @return	array 	The list of scripts.
	 * @since 	1.0.0
	 */
	public function scripts()
	{
		return array(Uri::base(true) . '/components/com_sppagebuilder/assets/js/js_slider.js');
	}
	/**
	 * Add stylesheets to the document.
	 *
	 * @return	array 	The list of stylesheets.
	 * @since 	1.0.0
	 */
	public function stylesheets()
	{
		return array(Uri::base(true) . '/components/com_sppagebuilder/assets/css/js_slider.css');
	}
	/**
	 * Generate the CSS string for the frontend page.
	 *
	 * @return 	string 	The CSS string for the page.
	 * @since 	1.0.0
	 */
	public function css()
	{
		$addon_id = '#sppb-addon-' . $this->addon->id;
		$settings = $this->addon->settings;

		$cssHelper = new CSSHelper($addon_id);

		$layout_path = JPATH_ROOT . '/components/com_sppagebuilder/layouts';
		$content_container_option = (isset($settings->content_container_option) && $settings->content_container_option) ? $settings->content_container_option : '';

		//Css output start
		$css = '';

		//Timer style
		$css .= $cssHelper->generateStyle('.sp-dot-indicator-wrap .dot-indicator, .sp-indicator.line-indicator', $settings, ['timer_color' => 'background'], false);
		$css .= $cssHelper->generateStyle('.sp-dot-indicator-wrap', $settings, ['timer_bg_color' => 'background'], false);
		$css .= $cssHelper->generateStyle('.sp-indicator-container', $settings, ['timer_bg_color' => 'background', 'timer_width' => 'width', 'timer_top_gap' => 'top', 'timer_left_gap' => 'left'], ['timer_bg_color' => false, 'timer_width' => '%']);
		//Dot/line style
		$dot_controllers_position = (isset($settings->dot_controllers_position) && $settings->dot_controllers_position) ? $settings->dot_controllers_position : '';
		$dot_controllers_style = (isset($settings->dot_controllers_style) && $settings->dot_controllers_style) ? $settings->dot_controllers_style : '';

		if ($dot_controllers_position == 'vertical_left' || $dot_controllers_position == 'vertical_right') {
			$css .= $cssHelper->generateStyle('.sp-slider .sp-dots', $settings, ['dot_ctlr_width' => 'height:100%;max-width']);
			$css .= $cssHelper->generateStyle('.sp-slider .sp-dots ul', $settings, ['dot_ctlr_width' => 'width']);
		}

		$dotsPros  = [
			'dot_ctlr_bg'            => 'background-color',
			'dot_ctlr_border_color'  => 'border-color',
			'dot_ctlr_border_width'  => 'border-style:solid;border-width',
			'dot_ctlr_border_radius' => 'border-radius',
			'dot_ctlr_height'        => 'height',
			'dot_ctlr_width'         => 'width',
			'dot_ctlr_margin'        => 'margin'
		];

		$dotsUnits  = [
			'dot_ctlr_bg'            => false,
			'dot_ctlr_border_color'  => false,
			'dot_ctlr_margin'        => false
		];

		$css .= $cssHelper->generateStyle('.sp-slider .sp-dots ul li', $settings, $dotsPros, $dotsUnits, ['dot_ctlr_margin' => 'spacing']);
		//Active style options
		$css .= $cssHelper->generateStyle('.sp-slider.dot-controller-line .sp-dots ul li.active span', $settings, ['dot_ctlr_hover_height' => 'height', 'dot_ctlr_center_bg' => 'background-color', 'dot_ctlr_border_radius' => 'border-radius'], ['dot_ctlr_center_bg' => false]);
		$css .= $cssHelper->generateStyle('.sp-slider.dot-controller-line .sp-dots ul li.active', $settings, ['dot_ctlr_border_radius' => 'border-radius', 'dot_ctlr_hover_width' => 'width', 'dot_ctlr_hover_border_color' => 'border-color'], ['dot_ctlr_hover_border_color' => false]);

		if ($dot_controllers_style !== 'line') {
			$dosSpanProps = [
				'dot_controllers_style' => ($dot_controllers_style !== 'with_image') ? 'background-color' : null,
				'dot_ctlr_border_radius' => 'border-radius',
				'dot_ctlr_hover_height' => 'height',
				'dot_ctlr_hover_width' => 'width'
			];
			$css .= $cssHelper->generateStyle('.sp-slider .sp-dots ul li span, .sp-slider .sp-dots ul li:hover span, .sp-slider .sp-dots ul li:hover:after, .sp-slider .sp-dots ul li:after', $settings, $dosSpanProps, ['dot_controllers_style' => ($dot_controllers_style !== 'with_image') ? false : null]);
			$css .= $cssHelper->generateStyle('.sp-slider .sp-dots ul li.active', $settings, ['dot_ctlr_hover_border_color' => 'color'], false);
		}

		//Dot/line gap
		if ($dot_controllers_position === 'bottom_center') {
			$css .= $cssHelper->generateStyle('.sp-slider .sp-dots', $settings, ['dot_controllers_bottom_gap' => 'bottom']);
		}

		if ($dot_controllers_position === 'bottom_left') {
			$css .= $cssHelper->generateStyle('.sp-slider .sp-dots', $settings, ['dot_controllers_bottom_gap' => 'bottom']);
			$css .= $cssHelper->generateStyle('.dot-controller-position-bottom_left.sp-slider .sp-dots', $settings, ['dot_controllers_left_gap' => 'left']);
		}

		if ($dot_controllers_position === 'bottom_right') {
			$css .= $cssHelper->generateStyle('.sp-slider .sp-dots', $settings, ['dot_controllers_bottom_gap' => 'bottom']);
			$css .= $cssHelper->generateStyle('.dot-controller-position-bottom_right.sp-slider .sp-dots', $settings, ['dot_controllers_right_gap' => 'right']);
		}

		if ($dot_controllers_position === 'vertical_left') {
			$css .= $cssHelper->generateStyle('.dot-controller-position-vertical_left.sp-slider .sp-dots',  $settings, ['dot_controllers_left_gap' => 'left']);
		}

		if ($dot_controllers_position === 'vertical_right') {
			$css .= $cssHelper->generateStyle('.dot-controller-position-vertical_right.sp-slider .sp-dots', $settings, ['dot_controllers_right_gap' => 'right']);
		}

		//Text thumbnail style
		$css .= $cssHelper->generateStyle('.sp-slider-custom-dot-indecators', $settings, ['text_thumb_ctlr_wrap_bg' => 'background', 'text_thumb_ctlr_wrap_padding' => 'padding', 'text_thumb_ctlr_wrap_width' => 'width'], ['text_thumb_ctlr_wrap_bg' => false, 'text_thumb_ctlr_wrap_padding' => false, 'text_thumb_ctlr_wrap_width' => '%'], ['text_thumb_ctlr_wrap_padding' => 'spacing']);
		$css .= $cssHelper->generateStyle('.sp-slider-custom-dot-indecators ul li', $settings, ['text_thumb_ctlr_individual_width' => 'width']);
		//thumb number style
		$css .= $cssHelper->generateStyle('.sp-slider-text-thumb-number', $settings, ['text_thumb_number_color' => 'color', 'text_thumb_number_font_size' => 'font-size', 'text_thumb_number_font_weight' => 'font-weight'], ['text_thumb_number_font_weight' => false, 'text_thumb_number_color' => false]);
		//thumb title style
		$css .= $cssHelper->generateStyle('.sp-slider-dot-indecator-text.sp-dot-text-key-1', $settings, ['text_thumb_title_color' => 'color', 'text_thumb_title_font_size' => 'font-size', 'text_thumb_title_font_weight' => 'font-weight', 'text_thumb_title_lineheight' => 'line-height'], ['text_thumb_title_color' => false, 'text_thumb_title_font_weight' => false]);
		//thumb subtitle style
		$css .= $cssHelper->generateStyle('.sp-slider-dot-indecator-text.sp-dot-text-key-2',  $settings, ['text_thumb_subtitle_color' => 'color', 'text_thumb_subtitle_font_size' => 'font-size', 'text_thumb_subtitle_font_weight' => 'font-weight'], ['text_thumb_subtitle_color' => false, 'text_thumb_subtitle_font_weight' => false]);

		//Arrow style
		$arrow_controllers_style = (isset($settings->arrow_controllers_style) && $settings->arrow_controllers_style) ? $settings->arrow_controllers_style : '';
		$arrow_controllers_position = (isset($settings->arrow_controllers_position) && $settings->arrow_controllers_position) ? $settings->arrow_controllers_position : '';
		$arrow_ctlr_border_width = (isset($settings->arrow_ctlr_border_width) && $settings->arrow_ctlr_border_width != '') ? $settings->arrow_ctlr_border_width : 1;

		if ($arrow_controllers_style !== 'spread') {
			$css .= $cssHelper->generateStyle('.sp-slider .sp-nav-control', $settings, ['arrow_ctlr_height' => 'height']);
		}

		$controlProps = [
			'arrow_ctlr_background' => 'background',
			'arrow_ctlr_border_color' => 'border-color',
			'arrow_ctlr_border_radius' => 'border-radius',
			'arrow_ctlr_border_width' => 'border-width',
			'arrow_ctlr_color' => 'color',
			'arrow_ctlr_width' => 'width',
			'arrow_ctlr_height' => 'height',
			'arrow_ctlr_font_size' => 'font-size'
		];

		$controlPropsUnits = [
			'arrow_ctlr_background' => false,
			'arrow_ctlr_border_color' => false,
			'arrow_ctlr_color' => false,
		];
		$css .= $cssHelper->generateStyle('.sp-slider .sp-nav-control .nav-control', $settings, $controlProps, $controlPropsUnits);

		$settings->dummy_arrow_ctlr_width = null;

		if (!empty($settings->arrow_ctlr_width_original)) {
			if (\is_object($settings->arrow_ctlr_width_original)) {
				$settings->dummy_arrow_ctlr_width = AddonHelper::initDeviceObject();

				foreach ($settings->arrow_ctlr_width_original as $key => $value) {
					$settings->dummy_arrow_ctlr_width->$key = (int) ((int)$value * 2) + 20;
				}
			} else {
				$settings->dummy_arrow_ctlr_width = (int) ((int)$settings->arrow_ctlr_width_original * 20) + 20;
			}
		}

		$css .= $cssHelper->generateStyle('div[class*="arrow-position-bottom"].sp-slider .sp-nav-control', $settings, ['dummy_arrow_ctlr_width' => 'width']);
		if ($arrow_controllers_style == 'spread') {
			$css .= $cssHelper->generateStyle('.sp-slider .sp-nav-control', $settings, ['arrow_ctlr_height' => 'top: -%s']);
		}
		$settings->arrow_ctlr_border_width =  !$arrow_ctlr_border_width ? 1 : $arrow_ctlr_border_width;

		$settings->dummy_arrow_ctlr_height = null;

		if (!empty($settings->arrow_ctlr_height_original)) {
			if (\is_object($settings->arrow_ctlr_height_original)) {
				$settings->dummy_arrow_ctlr_height = AddonHelper::initDeviceObject();

				foreach ($settings->arrow_ctlr_height_original as $key => $value) {
					$settings->dummy_arrow_ctlr_height->$key = ((int)$value - ((int)$settings->arrow_ctlr_border_width * 2));
				}
			} else {
				$settings->dummy_arrow_ctlr_height = ((int)$settings->arrow_ctlr_height_original - ((int)$settings->arrow_ctlr_border_width * 2));
			}
		}

		$css .= $cssHelper->generateStyle('.sp-slider .sp-nav-control .nav-control', $settings, ['dummy_arrow_ctlr_height' => 'line-height']);
		$css .= $cssHelper->generateStyle('.sp-slider .sp-nav-control .nav-control i', $settings, ['dummy_arrow_ctlr_height' => 'line-height']);

		//Arrow gap
		if ($arrow_controllers_position == 'bottom_center') {
			$css .= $cssHelper->generateStyle('.sp-slider.arrow-position-bottom_center .sp-nav-control', $settings, ['arrow_controllers_bottom_gap' => 'bottom', 'arrow_controllers_left_gap' => 'left', 'arrow_controllers_right_gap' => 'right']);
		}

		if ($arrow_controllers_position == 'bottom_left') {
			$css .= $cssHelper->generateStyle('.sp-slider.arrow-position-bottom_left .sp-nav-control', $settings, ['arrow_controllers_bottom_gap' => 'bottom', 'arrow_controllers_left_gap' => 'left']);
		}

		if ($arrow_controllers_position == 'bottom_right') {
			$css .= $cssHelper->generateStyle('.sp-slider.arrow-position-bottom_right .sp-nav-control', $settings, ['arrow_controllers_bottom_gap' => 'bottom', 'arrow_controllers_right_gap' => 'right']);
		}
		//Spread arrow gap
		if ($arrow_controllers_style === 'spread') {
			$css .= $cssHelper->generateStyle('div.sp-slider .sp-nav-control', $settings, ['arrow_spread_controllers_left_gap' => 'left', 'arrow_spread_controllers_right_gap' => 'right']);
		}

		//Arrow hover
		$css .= $cssHelper->generateStyle('.sp-slider .sp-nav-control .nav-control:hover', $settings, ['arrow_ctlr_hover_background' => 'background', 'arrow_ctlr_hover_border_color' => 'border-color', 'arrow_ctlr_hover_color' => 'color'], false);
		//Slide Counter Style
		$slide_counter = (isset($settings->slide_counter) && $settings->slide_counter) ? $settings->slide_counter : 0;
		if ($slide_counter) {
			$sliderNumberProps = [
				'slide_counter_color'      => 'color',
				'slide_counter_fontsize'   => 'font-size',
				'slide_counter_fontfamily' => 'font-family',
				'slide_counter_bg_color'   => 'background',
				'slide_counter_padding'    => 'padding',
				'slide_counter_gap_bottom' => 'bottom',
				'slide_counter_gap_left'   => 'left'
			];

			$sliderNumberUnits = [
				'slide_counter_color'      => false,
				'slide_counter_fontfamily' => false,
				'slide_counter_bg_color'   => false,
				'slide_counter_padding'    => false,
			];

			$css .= $cssHelper->generateStyle('.sp-slider .sp-slider_number', $settings, $sliderNumberProps, $sliderNumberUnits, ['slide_counter_padding' => 'spacing']);
		}

		// Item content style
		if (isset($settings->slideshow_items) && is_array($settings->slideshow_items)) {
			$increasing_addon_id = $this->addon->id;
			foreach ($settings->slideshow_items as $item_key => $item_value) {
				$uniqid = '#sp-slider-item-' . $this->addon->id . '-num-' . $item_key . '-key';
				if ($increasing_addon_id === $increasing_addon_id) {
					$increasing_addon_id++;
				}
				//Image dot style
				$slider_img = (isset($item_value->slider_img) && $item_value->slider_img) ? $item_value->slider_img : '';
				$slider_img_src = isset($slider_img->src) ? $slider_img->src : $slider_img;
				$css .= $addon_id . ' .dot-controller-with_image.sp-slider .sp-dots ul li.sp-dot-' . $item_key . ' {';
				if (strpos($slider_img_src, "http://") !== false || strpos($slider_img_src, "https://") !== false) {
					$css .= 'background: url(\'' . $slider_img_src . '\') no-repeat scroll center center / cover;';
				} else {
					$css .= 'background: url(\'' . Uri::base() . '/' . $slider_img_src . '\') no-repeat scroll center center / cover;';
				}
				$css .= '}';

				if (isset($item_value->video_volume_btn) && $item_value->video_volume_btn) {
					$css .= $addon_id . ' ' . $uniqid . '.sp-item .sp-video-control {';
					$css .= 'display:block;';
					$css .= '}';
				} else {
					$css .= $addon_id . ' ' . $uniqid . '.sp-item .sp-video-control {';
					$css .= 'display:none;';
					$css .= '}';
				}
				if (isset($item_value->slider_overlay_options) && $item_value->slider_overlay_options == 'color_overlay') {
					if (isset($item_value->slider_bg_overlay) && $item_value->slider_bg_overlay) {
						$css .= $cssHelper->generateStyle($uniqid . '.sp-item .sp-background:after,' . $uniqid . '.sp-item .sp-video-background-mask', $item_value, ['slider_bg_overlay' => 'background'], false);
					}
				}

				if (isset($item_value->slider_bg_gradient_overlay) && $item_value->slider_bg_gradient_overlay) {
					$slider_bg_gradient_overlay = (isset($item_value->slider_bg_gradient_overlay) && $item_value->slider_bg_gradient_overlay) ? $item_value->slider_bg_gradient_overlay : '';

					$overlay_gradient_color1 = (isset($slider_bg_gradient_overlay->color) && $slider_bg_gradient_overlay->color) ? $slider_bg_gradient_overlay->color : '';
					$overlay_gradient_color2 = (isset($slider_bg_gradient_overlay->color2) && $slider_bg_gradient_overlay->color2) ? $slider_bg_gradient_overlay->color2 : '';
					$overlay_degree = (isset($slider_bg_gradient_overlay->deg) && $slider_bg_gradient_overlay->deg) ? $slider_bg_gradient_overlay->deg : '45';
					$overlay_type = (isset($slider_bg_gradient_overlay->type) && $slider_bg_gradient_overlay->type) ? $slider_bg_gradient_overlay->type : 'linear';
					$overlay_radialPos = (isset($slider_bg_gradient_overlay->radialPos) && $slider_bg_gradient_overlay->radialPos) ? $slider_bg_gradient_overlay->radialPos : '';
					$overlay_radial_angle1 = (isset($slider_bg_gradient_overlay->pos) && $slider_bg_gradient_overlay->pos) ? $slider_bg_gradient_overlay->pos : '10';
					$overlay_radial_angle2 = (isset($slider_bg_gradient_overlay->pos2) && $slider_bg_gradient_overlay->pos2) ? $slider_bg_gradient_overlay->pos2 : '100';

					$css .= $addon_id . ' ' . $uniqid . '.sp-item .sp-background:after,';
					$css .= $addon_id . ' ' . $uniqid . '.sp-item .sp-video-background-mask{';
					if ($overlay_type !== 'radial') {
						$css .= 'background: -webkit-linear-gradient(' . $overlay_degree . 'deg, ' . $overlay_gradient_color1 . ' ' . $overlay_radial_angle1 . '%, ' . $overlay_gradient_color2 . ' ' . $overlay_radial_angle2 . '%) transparent;';
						$css .= 'background: linear-gradient(' . $overlay_degree . 'deg, ' . $overlay_gradient_color1 . ' ' . $overlay_radial_angle1 . '%, ' . $overlay_gradient_color2 . ' ' . $overlay_radial_angle2 . '%) transparent;';
					} else {
						$css .= 'background: -webkit-radial-gradient(at ' . $overlay_radialPos . ', ' . $overlay_gradient_color1 . ' ' . $overlay_radial_angle1 . '%, ' . $overlay_gradient_color2 . ' ' . $overlay_radial_angle2 . '%) transparent;';
						$css .= 'background: radial-gradient(at ' . $overlay_radialPos . ', ' . $overlay_gradient_color1 . ' ' . $overlay_radial_angle1 . '%, ' . $overlay_gradient_color2 . ' ' . $overlay_radial_angle2 . '%) transparent;';
					}
					$css .= '}';
				}

				if (isset($item_value->slideshow_inner_items) && is_array($item_value->slideshow_inner_items)) {
					foreach ($item_value->slideshow_inner_items as $inner_item_key => $inner_value) {
						$inner_uniqid = '#sp-slider-inner-item-' . $increasing_addon_id . '-num-' . $inner_item_key . '-key';

						//Content type
						$content_type = (isset($inner_value->content_type) && $inner_value->content_type) ? $inner_value->content_type : '';
						//Content style
						$content_style = '';
						$content_style_sm = '';
						$content_style_xs = '';
						if ($content_type !== 'image_content') {
							$content_style .= (isset($inner_value->content_color) && $inner_value->content_color) ? 'color: ' . $inner_value->content_color . ';' : '';
							$content_style .= (isset($inner_value->content_fontsize) && $inner_value->content_fontsize->md) ? 'font-size: ' . $inner_value->content_fontsize->md . 'px;' : '';
							$content_style .= (isset($inner_value->content_lineheight) && $inner_value->content_lineheight->md) ? 'line-height: ' . $inner_value->content_lineheight->md . 'px;' : '';
							if (isset($inner_value->content_letterspacing) && $inner_value->content_letterspacing) {
								$content_style .= ($inner_value->content_letterspacing != 'custom') ? 'letter-spacing: ' . $inner_value->content_letterspacing . ';' : '';
								$content_style .= (isset($inner_value->custom_letterspacing) && $inner_value->content_letterspacing == 'custom') ? 'letter-spacing: ' . $inner_value->custom_letterspacing . ';' : '';
							}
							//Tablet style
							$content_style_sm .= (isset($inner_value->content_fontsize) && $inner_value->content_fontsize->sm) ? 'font-size: ' . $inner_value->content_fontsize->sm . 'px;' : '';
							$content_style_sm .= (isset($inner_value->content_lineheight) && $inner_value->content_lineheight->sm) ? 'line-height: ' . $inner_value->content_lineheight->sm . 'px;' : '';
							//Mobile style
							$content_style_xs .= (isset($inner_value->content_fontsize) && $inner_value->content_fontsize->xs) ? 'font-size: ' . $inner_value->content_fontsize->xs . 'px;' : '';
							$content_style_xs .= (isset($inner_value->content_lineheight) && $inner_value->content_lineheight->xs) ? 'line-height: ' . $inner_value->content_lineheight->xs . 'px;' : '';

							if (isset($inner_value->content_text_shadow) && is_object($inner_value->content_text_shadow)) {
								$ho = (isset($inner_value->content_text_shadow->ho) && $inner_value->content_text_shadow->ho != '') ? $inner_value->content_text_shadow->ho . 'px' : '0px';
								$vo = (isset($inner_value->content_text_shadow->vo) && $inner_value->content_text_shadow->vo != '') ? $inner_value->content_text_shadow->vo . 'px' : '0px';
								$blur = (isset($inner_value->content_text_shadow->blur) && $inner_value->content_text_shadow->blur != '') ? $inner_value->content_text_shadow->blur . 'px' : '0px';
								$color = (isset($inner_value->content_text_shadow->color) && $inner_value->content_text_shadow->color != '') ? $inner_value->content_text_shadow->color : '';

								if (!empty($color)) {
									$content_style .= "text-shadow: ${ho} ${vo} ${blur} ${color};";
								}
							}
						}
						if ($content_type !== 'btn_content') {
							$content_style .= (isset($inner_value->content_background) && $inner_value->content_background) ? 'background: ' . $inner_value->content_background . ';' : '';
							$content_style .= (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->md)) ? 'margin: ' . $inner_value->content_margin->md . ';' : '';
							//Tablet style
							$content_style_sm .= (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->sm)) ? 'margin: ' . $inner_value->content_margin->sm . ';' : '';
							//Mobile
							$content_style_xs .= (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->xs)) ? 'margin: ' . $inner_value->content_margin->xs . ';' : '';
						}
						if ($content_type == 'btn_content' || $content_type == 'image_content') {
							$btn_box_shadow = (isset($inner_value->btn_box_shadow) && $inner_value->btn_box_shadow) ? $inner_value->btn_box_shadow : '';
							if (is_object($btn_box_shadow)) {
								$ho = (isset($btn_box_shadow->ho) && $btn_box_shadow->ho != '') ? $btn_box_shadow->ho . 'px' : '0px';
								$vo = (isset($btn_box_shadow->vo) && $btn_box_shadow->vo != '') ? $btn_box_shadow->vo . 'px' : '0px';
								$blur = (isset($btn_box_shadow->blur) && $btn_box_shadow->blur != '') ? $btn_box_shadow->blur . 'px' : '0px';
								$spread = (isset($btn_box_shadow->spread) && $btn_box_shadow->spread != '') ? $btn_box_shadow->spread . 'px' : '0px';
								$color = (isset($btn_box_shadow->color) && $btn_box_shadow->color != '') ? $btn_box_shadow->color : '#fff';
								$content_style .= "box-shadow: ${ho} ${vo} ${blur} ${spread} ${color};";
							}
						}
						$content_style .= (isset($inner_value->content_border) && trim($inner_value->content_border)) ? 'border-width: ' . $inner_value->content_border . ';border-style: solid;' : '';
						$content_style .= (isset($inner_value->content_border_color) && $inner_value->content_border_color) ? 'border-color: ' . $inner_value->content_border_color . ';' : '';
						$content_style .= (isset($inner_value->content_border_radius) && $inner_value->content_border_radius != '') ? 'border-radius: ' . $inner_value->content_border_radius . 'px;' : '';

						$content_style .= (isset($inner_value->content_padding) && $inner_value->content_padding && trim($inner_value->content_padding->md)) ? 'padding: ' . $inner_value->content_padding->md . ';' : '';
						$content_style_sm .= (isset($inner_value->content_padding) && $inner_value->content_padding && trim($inner_value->content_padding->sm)) ? 'padding: ' . $inner_value->content_padding->sm . ';' : '';
						$content_style_xs .= (isset($inner_value->content_padding) && $inner_value->content_padding && trim($inner_value->content_padding->xs)) ? 'padding: ' . $inner_value->content_padding->xs . ';' : '';

						if ($content_type !== 'icon_content') {
							if (isset($inner_value->content_font_family) && $inner_value->content_font_family) {
								$font_path = new FileLayout('addon.css.fontfamily', $layout_path);
								$font_path->render(array('font' => $inner_value->content_font_family));
								$content_style .= 'font-family: ' . $inner_value->content_font_family . ';';
							}

							$content_font_style = (isset($inner_value->content_font_style) && $inner_value->content_font_style) ? $inner_value->content_font_style : '';
							if (isset($content_font_style->underline) && $content_font_style->underline) {
								$content_style .= 'text-decoration:underline;';
							}
							if (isset($content_font_style->italic) && $content_font_style->italic) {
								$content_style .= 'font-style:italic;';
							}
							if (isset($content_font_style->uppercase) && $content_font_style->uppercase) {
								$content_style .= 'text-transform:uppercase;';
							}
							if (isset($content_font_style->weight) && $content_font_style->weight) {
								$content_style .= 'font-weight:' . $content_font_style->weight . ';';
							}
						}

						//Content css
						if ($content_type !== 'btn_content') {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . ' {';
							$css .= $content_style;
							$css .= '}';
						}

						//Image content style
						$image_content_style = '';
						$image_content_style_sm = '';
						$image_content_style_xs = '';
						$image_content_style .= (isset($inner_value->image_content_height) && $inner_value->image_content_height->md) ? 'height: ' . $inner_value->image_content_height->md . 'px;' : 'height: 385px;';
						$image_content_style .= (isset($inner_value->image_content_width) && $inner_value->image_content_width->md) ? 'width: ' . $inner_value->image_content_width->md . 'px;' : 'width:400px;';

						//Tablet image style
						$image_content_style_sm .= (isset($inner_value->image_content_height) && $inner_value->image_content_height && $inner_value->image_content_height->sm) ? 'height: ' . $inner_value->image_content_height->sm . 'px;' : '';
						$image_content_style_sm .= (isset($inner_value->image_content_width) && $inner_value->image_content_width->sm) ? 'width: ' . $inner_value->image_content_width->sm . 'px;' : '';
						//Mobile image style
						$image_content_style_xs .= (isset($inner_value->image_content_height) && $inner_value->image_content_height && $inner_value->image_content_height->xs) ? 'height: ' . $inner_value->image_content_height->xs . 'px;' : '';
						$image_content_style_xs .= (isset($inner_value->image_content_width) && $inner_value->image_content_width->xs) ? 'width: ' . $inner_value->image_content_width->xs . 'px;' : '';

						//Image content css
						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . ' img {';
						$css .= $image_content_style;
						$css .= '}';

						//Button content style
						$btn_content_style = '';
						$btn_hover_content_style = '';

						$button_background_options = (isset($inner_value->button_background_options) && $inner_value->button_background_options) ? $inner_value->button_background_options : '';
						$btn_margin = (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->md)) ? 'margin: ' . $inner_value->content_margin->md . ';' : '';
						$btn_margin_sm = (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->sm)) ? 'margin: ' . $inner_value->content_margin->sm . ';' : '';
						$btn_margin_xs = (isset($inner_value->content_margin) && $inner_value->content_margin && trim($inner_value->content_margin->xs)) ? 'margin: ' . $inner_value->content_margin->xs . ';' : '';

						if ($button_background_options === 'color_bg') {
							$btn_content_style .= (isset($inner_value->button_background_color) && $inner_value->button_background_color) ? 'background: ' . $inner_value->button_background_color . ';' : '';
							//Button hover bg
							$btn_hover_content_style .= (isset($inner_value->button_background_color_hover) && $inner_value->button_background_color_hover) ? 'background: ' . $inner_value->button_background_color_hover . ';' : '';
						} else {
							//Button Normal gradient
							$button_background_gradient = (isset($inner_value->button_background_gradient) && $inner_value->button_background_gradient) ? $inner_value->button_background_gradient : '';

							$gradient_color1 = (isset($button_background_gradient->color) && $button_background_gradient->color) ? $button_background_gradient->color : '';
							$gradient_color2 = (isset($button_background_gradient->color2) && $button_background_gradient->color2) ? $button_background_gradient->color2 : '';
							$degree = (isset($button_background_gradient->deg) && $button_background_gradient->deg) ? $button_background_gradient->deg : '0';
							$type = (isset($button_background_gradient->type) && $button_background_gradient->type) ? $button_background_gradient->type : '';
							$radialPos = (isset($button_background_gradient->radialPos) && $button_background_gradient->radialPos) ? $button_background_gradient->radialPos : '';
							$radial_angle1 = (isset($button_background_gradient->pos) && $button_background_gradient->pos) ? $button_background_gradient->pos : '0';
							$radial_angle2 = (isset($button_background_gradient->pos2) && $button_background_gradient->pos2) ? $button_background_gradient->pos2 : '100';

							if ($type !== 'radial') {
								$btn_content_style .= 'background: -webkit-linear-gradient(' . $degree . 'deg, ' . $gradient_color1 . ' ' . $radial_angle1 . '%, ' . $gradient_color2 . ' ' . $radial_angle2 . '%) transparent;';
								$btn_content_style .= 'background: linear-gradient(' . $degree . 'deg, ' . $gradient_color1 . ' ' . $radial_angle1 . '%, ' . $gradient_color2 . ' ' . $radial_angle2 . '%) transparent;';
							} else {
								$btn_content_style .= 'background: -webkit-radial-gradient(at ' . $radialPos . ', ' . $gradient_color1 . ' ' . $radial_angle1 . '%, ' . $gradient_color2 . ' ' . $radial_angle2 . '%) transparent;';
								$btn_content_style .= 'background: radial-gradient(at ' . $radialPos . ', ' . $gradient_color1 . ' ' . $radial_angle1 . '%, ' . $gradient_color2 . ' ' . $radial_angle2 . '%) transparent;';
							}
							//Button hover gradient
							$button_background_gradient_hover = (isset($inner_value->button_background_gradient_hover) && $inner_value->button_background_gradient_hover) ? $inner_value->button_background_gradient_hover : '';

							$gradient_hover_color1 = (isset($button_background_gradient_hover->color) && $button_background_gradient_hover->color) ? $button_background_gradient_hover->color : '';
							$gradient_hover_color2 = (isset($button_background_gradient_hover->color2) && $button_background_gradient_hover->color2) ? $button_background_gradient_hover->color2 : '';
							$hover_degree = (isset($button_background_gradient_hover->deg) && $button_background_gradient_hover->deg) ? $button_background_gradient_hover->deg : '0';
							$hover_type = (isset($button_background_gradient_hover->type) && $button_background_gradient_hover->type) ? $button_background_gradient_hover->type : '';
							$hover_radialPos = (isset($button_background_gradient_hover->radialPos) && $button_background_gradient_hover->radialPos) ? $button_background_gradient_hover->radialPos : '';
							$hover_radial_angle1 = (isset($button_background_gradient_hover->pos) && $button_background_gradient_hover->pos) ? $button_background_gradient_hover->pos : '0';
							$hover_radial_angle2 = (isset($button_background_gradient_hover->pos2) && $button_background_gradient_hover->pos2) ? $button_background_gradient_hover->pos2 : '100';

							if ($hover_type !== 'radial') {
								$btn_hover_content_style .= 'background: -webkit-linear-gradient(' . $hover_degree . 'deg, ' . $gradient_hover_color1 . ' ' . $hover_radial_angle1 . '%, ' . $gradient_hover_color2 . ' ' . $hover_radial_angle2 . '%) transparent;';
								$btn_hover_content_style .= 'background: linear-gradient(' . $hover_degree . 'deg, ' . $gradient_hover_color1 . ' ' . $hover_radial_angle1 . '%, ' . $gradient_hover_color2 . ' ' . $hover_radial_angle2 . '%) transparent;';
							} else {
								$btn_hover_content_style .= 'background: -webkit-radial-gradient(at ' . $hover_radialPos . ', ' . $gradient_hover_color1 . ' ' . $hover_radial_angle1 . '%, ' . $gradient_hover_color2 . ' ' . $hover_radial_angle2 . '%) transparent;';
								$btn_hover_content_style .= 'background: radial-gradient(at ' . $hover_radialPos . ', ' . $gradient_hover_color1 . ' ' . $hover_radial_angle1 . '%, ' . $gradient_hover_color2 . ' ' . $hover_radial_angle2 . '%) transparent;';
							}
						}

						//Button content css
						if ($btn_margin) {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button {';
							$css .= $btn_margin;
							$css .= '}';
						}
						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text{';
						$css .= $content_style;
						$css .= $btn_content_style;
						$css .= '}';
						//Button Icon style 
						$button_icon_margin = (isset($inner_value->button_icon_margin) && $inner_value->button_icon_margin && trim($inner_value->button_icon_margin->md)) ? 'margin: ' . $inner_value->button_icon_margin->md . ';' : '';
						$button_icon_margin_sm = (isset($inner_value->button_icon_margin) && $inner_value->button_icon_margin && trim($inner_value->button_icon_margin->sm)) ? 'margin: ' . $inner_value->button_icon_margin->sm . ';' : '';
						$button_icon_margin_xs = (isset($inner_value->button_icon_margin) && $inner_value->button_icon_margin && trim($inner_value->button_icon_margin->xs)) ? 'margin: ' . $inner_value->button_icon_margin->xs . ';' : '';

						//Button Icon css
						if ($button_icon_margin) {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-icon{';
							$css .= $button_icon_margin;
							$css .= '}';
						}

						//Button hover style
						$btn_hover_content_style .= (isset($inner_value->button_hover_color) && $inner_value->button_hover_color) ? 'color: ' . $inner_value->button_hover_color . ';' : '';
						$btn_hover_content_style .= (isset($inner_value->button_hover_border_color) && $inner_value->button_hover_border_color) ? 'border-color: ' . $inner_value->button_hover_border_color . ';' : '';

						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text:hover,';
						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text:focus {';
						$css .= $btn_hover_content_style;
						$css .= '}';

						//Table style
						$css .= '@media (min-width: 768px) and (max-width: 991px) {';
						//tablet content style
						if ($content_type !== 'btn_content') {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . ' {';
							$css .= $content_style_sm;
							$css .= '}';
						}
						//Image content css
						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . ' img {';
						$css .= $image_content_style_sm;
						$css .= '}';
						//Button content css
						if ($btn_margin_sm) {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button {';
							$css .= $btn_margin_sm;
							$css .= '}';
						}
						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text{';
						$css .= $content_style_sm;
						$css .= '}';
						if ($button_icon_margin_sm) {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-icon{';
							$css .= $button_icon_margin_sm;
							$css .= '}';
						}

						$css .= '}';
						//Mobile style
						$css .= '@media (max-width: 767px) {';
						//tablet content style
						if ($content_type !== 'btn_content') {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . ' {';
							$css .= $content_style_xs;
							$css .= '}';
						}
						//Image content css
						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . ' img {';
						$css .= $image_content_style_xs;
						$css .= '}';
						//Button content css
						if ($btn_margin_xs) {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button {';
							$css .= $btn_margin_xs;
							$css .= '}';
						}
						$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-text{';
						$css .= $content_style_xs;
						$css .= '}';
						if ($button_icon_margin_xs) {
							$css .= '.sp-slider ' . $uniqid . ' ' . $inner_uniqid . '.sppb-sp-slider-button .sp-slider-btn-icon{';
							$css .= $button_icon_margin_xs;
							$css .= '}';
						}
						$css .= '}';
					}
				}
			}
		}

		//Content container style
		$content_container_width = (isset($settings->content_container_width) && $settings->content_container_width) ? $settings->content_container_width : '100';
		$css .= $content_container_width;
		if ($content_container_option !== 'bootstrap') {
			$css .= $cssHelper->generateStyle('.sp-slider .sp-slider-content-wrap', $settings, ['content_container_width' => 'margin: 0 auto;width'], ['content_container_width' => '%']);
		}



		return $css;
	}
	/**
	 * Generate the lodash template string for the frontend editor.
	 *
	 * @return 	string 	The lodash template string.
	 * @since 	1.0.0
	 */
	public static function getTemplate()
	{
		$lodash = new Lodash('#sppb-addon-{{ data.id }}');
		$output = '
		 <style type="text/css">
			<# _.each (data.slideshow_items, function(item_value, item_key) { 
				var slider_img = {}
				if (typeof item_value.slider_img !== "undefined" && typeof item_value.slider_img.src !== "undefined") {
					slider_img = item_value.slider_img
				} else {
					slider_img = {src: item_value.slider_img}
				}
				if(slider_img.src){
			#>
					#sppb-addon-{{ data.id }} #sp-slider-item-{{ data.id }}-num-{{ item_key }}-key .sp-background {
					<# if(slider_img.src.indexOf("http://") == 0 || slider_img.src.indexOf("https://") == 0){ #>
						background-image: url({{ slider_img.src }});
					<# } else { #>
						background-image: url({{ pagebuilder_base + slider_img.src }});
					<# } #>
					}
			<# }
		}) #>';

		$output .= $lodash->unit('background', '.sp-dot-indicator-wrap .dot-indicator,.sp-indicator.line-indicator', 'data.timer_color');
		$output .= $lodash->unit('background', '.sp-dot-indicator-wrap', 'data.timer_bg_color');
		$output .= $lodash->unit('background', '.sp-indicator-container', 'data.timer_bg_color');
		$output .= $lodash->unit('width', '.sp-indicator-container', 'data.timer_width', '%');
		$output .= $lodash->unit('top', '.sp-indicator-container', 'data.timer_top_gap', 'px');
		$output .= $lodash->unit('left', '.sp-indicator-container', 'data.timer_left_gap', 'px');

		$output .= ' <# if (data.dot_controllers_position == "vertical_left" || data.dot_controllers_position == "vertical_right") { #> ';
		$output .= $lodash->unit('max-width', '.sp-slider .sp-dots', 'data.dot_ctlr_width', 'px', true, '', 'height:100%;');
		$output .= $lodash->unit('width', '.sp-slider .sp-dots ul', 'data.dot_ctlr_width');
		$output .= '<# } #>';

		// Dots style
		$output .= $lodash->color('background-color', '.sp-slider .sp-dots ul li', 'data.dot_ctlr_bg');
		$output .= $lodash->border('border-color', '.sp-slider .sp-dots ul li', 'data.dot_ctlr_border_color');
		$output .= '<# if (!_.isEmpty(data.dot_ctlr_border_width)) { #>';
		$output .= $lodash->unit('border-width', '.sp-slider .sp-dots ul li', 'data.dot_ctlr_border_width', 'px', false, '', 'border-style:solid;');
		$output .= '<# } #>';
		$output .= $lodash->unit('border-radius', '.sp-slider .sp-dots ul li', 'data.dot_ctlr_border_radius', 'px', false);
		$output .= $lodash->unit('height', '.sp-slider .sp-dots ul li', 'data.dot_ctlr_height', 'px', false);
		$output .= $lodash->unit('width', '.sp-slider .sp-dots ul li', 'data.dot_ctlr_width', 'px', false);
		$output .= $lodash->spacing('margin', '.sp-slider .sp-dots ul li', 'data.dot_ctlr_margin');

		// Dots Active Style
		$output .= $lodash->unit('height', '.sp-slider.dot-controller-line .sp-dots ul li.active span', 'data.dot_ctlr_hover_height', 'px', false);
		$output .= $lodash->unit('border-radius', '.sp-slider.dot-controller-line .sp-dots ul li.active span', 'data.dot_ctlr_border_radius', 'px', false);
		$output .= $lodash->color('background-color', '.sp-slider.dot-controller-line .sp-dots ul li.active span', 'data.dot_ctlr_center_bg');

		$output .= $lodash->unit('width', '.sp-slider.dot-controller-line .sp-dots ul li.active', 'data.dot_ctlr_hover_width', 'px', false);
		$output .= $lodash->unit('border-radius', '.sp-slider.dot-controller-line .sp-dots ul li.active', 'data.dot_ctlr_border_radius', 'px', false);
		$output .= $lodash->border('border-color', '.sp-slider.dot-controller-line .sp-dots ul li.active', 'data.dot_ctlr_hover_border_color');

		$output .= '<# if (data.dot_controllers_style !== "line") { #>';
		$output .= '<# if (data.dot_controllers_style !== "with_image") { #>';
		$output .= $lodash->color('background-color', '.sp-slider .sp-dots ul li span,.sp-slider .sp-dots ul li:hover span,.sp-slider .sp-dots ul li:hover:after,.sp-slider .sp-dots ul li:after', 'data.dot_ctlr_center_bg');
		$output .= '<# } #>';
		$output .= $lodash->unit('height', '.sp-slider .sp-dots ul li span,.sp-slider .sp-dots ul li:hover span,.sp-slider .sp-dots ul li:hover:after,.sp-slider .sp-dots ul li:after', 'data.dot_ctlr_hover_height', 'px', false);
		$output .= $lodash->unit('width', '.sp-slider .sp-dots ul li span,.sp-slider .sp-dots ul li:hover span,.sp-slider .sp-dots ul li:hover:after,.sp-slider .sp-dots ul li:after', 'data.dot_ctlr_hover_width', 'px', false);
		$output .= $lodash->unit('border-radius', '.sp-slider .sp-dots ul li span,.sp-slider .sp-dots ul li:hover span,.sp-slider .sp-dots ul li:hover:after,.sp-slider .sp-dots ul li:after', 'data.dot_ctlr_border_radius', 'px', false);
		$output .= $lodash->border('border-color', '.sp-slider .sp-dots ul li.active', 'data.dot_ctlr_hover_border_color');
		$output .= '<# } #>';

		$output .= '<# if (data.dot_controllers_position === "bottom_center") { #>';
		$output .= $lodash->unit('bottom', '.sp-slider .sp-dots', 'data.dot_controllers_bottom_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.dot_controllers_position === "bottom_left") { #>';
		$output .= $lodash->unit('bottom', '.sp-slider .sp-dots', 'data.dot_controllers_bottom_gap', 'px');
		$output .= $lodash->unit('left', '.sp-slider .sp-dots', 'data.dot_controllers_left_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.dot_controllers_position === "bottom_right") { #>';
		$output .= $lodash->unit('bottom', '.sp-slider .sp-dots', 'data.dot_controllers_bottom_gap', 'px');
		$output .= $lodash->unit('left', '.sp-slider .sp-dots', 'data.dot_controllers_right_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.dot_controllers_position === "vertical_left") { #>';
		$output .= $lodash->unit('left', '.dot-controller-position-vertical_left.sp-slider .sp-dots', 'data.dot_controllers_left_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.dot_controllers_position === "vertical_right") { #>';
		$output .= $lodash->unit('right', '.dot-controller-position-vertical_right.sp-slider .sp-dots', 'data.dot_controllers_right_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.dot_controllers_position === "spread") { #>';
		$output .= $lodash->unit('height', '.sp-slider .sp-nav-control', 'data.arrow_ctlr_height', 'px');
		$output .= '<# } #>';

		$output .= $lodash->color('background', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_background');
		$output .= $lodash->color('color', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_color');
		$output .= $lodash->border('border-color', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_border_color');
		$output .= $lodash->unit('border-radius', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_border_radius', 'px', false);
		$output .= $lodash->unit('border-width', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_border_width', 'px', false);
		$output .= $lodash->unit('width', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_width', 'px');
		$output .= $lodash->unit('height', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_height', 'px');
		$output .= $lodash->unit('font-size', '.sp-slider .sp-nav-control .nav-control', 'data.arrow_ctlr_font_size', 'px');
		$output .= '<# let arrow_width = ((data.arrow_ctlr_width * 2) + 20); #>';
		$output .= $lodash->unit('width', 'div[class*="arrow-position-bottom"].sp-slider .sp-nav-control', 'arrow_width');
		$output .= '<# if (data.arrow_controllers_style == "spread") { #>';
		$output .= $lodash->unit('top', '.sp-slider .sp-nav-control', 'data.arrow_ctlr_height', 'px', true, '-');
		$output .= '<# } #>';

		$output .= '<# if (_.isEmpty(data.arrow_ctlr_border_width)) {data.arrow_ctlr_border_width = 1; }  #>';

		$output .= '<# let dummy_arrow_ctlr = {}; if (_.isObject(data.arrow_ctlr_height)) {#>';
		$output .= '<# _.each(data.arrow_ctlr_height,(ctlr_height_value, ctlr_height_key) => dummy_arrow_ctlr[ctlr_height_key] = ctlr_height_value - (data.arrow_ctlr_border_width * 2))#>';
		$output .= '<# } #>';

		$output .= $lodash->unit('line-height', '.sp-slider .sp-nav-control .nav-control', 'dummy_arrow_ctlr', 'px');
		$output .= $lodash->unit('line-height', '.sp-slider .sp-nav-control .nav-control i', 'dummy_arrow_ctlr', 'px');

		$output .= '<# if (data.arrow_controllers_position=="bottom_center") { #>';
		$output .= $lodash->unit('bottom', '.sp-slider.arrow-position-bottom_center .sp-nav-control', 'data.arrow_controllers_bottom_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.arrow_controllers_position=="bottom_left") { #>';
		$output .= $lodash->unit('bottom', '.sp-slider.arrow-position-bottom_left .sp-nav-control', 'data.arrow_controllers_bottom_gap', 'px');
		$output .= $lodash->unit('left', '.sp-slider.arrow-position-bottom_left .sp-nav-control', 'data.arrow_controllers_left_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.arrow_controllers_position=="bottom_right") { #>';
		$output .= $lodash->unit('bottom', '.sp-slider.arrow-position-bottom_right .sp-nav-control', 'data.arrow_controllers_bottom_gap', 'px');
		$output .= $lodash->unit('right', '.sp-slider.arrow-position-bottom_right .sp-nav-control', 'data.arrow_controllers_right_gap', 'px');
		$output .= '<# } #>';

		$output .= '<# if (data.arrow_controllers_position=="spread") { #>';
		$output .= $lodash->unit('left', 'div.sp-slider .sp-nav-control', 'data.arrow_spread_controllers_left_gap', 'px');
		$output .= $lodash->unit('right', 'div.sp-slider .sp-nav-control', 'data.arrow_spread_controllers_right_gap', 'px');
		$output .= '<# } #>';

		$output .= $lodash->color('background', '.sp-slider .sp-nav-control .nav-control:hover', 'data.arrow_ctlr_hover_background');
		$output .= $lodash->color('color', '.sp-slider .sp-nav-control .nav-control:hover', 'data.arrow_ctlr_hover_color');
		$output .= $lodash->border('border-color', '.sp-slider .sp-nav-control .nav-control:hover', 'data.arrow_ctlr_hover_border_color');

		$output .= $lodash->color('color', '.sp-slider .sp-slider_number', 'data.slide_counter_color');
		$output .= $lodash->color('background', '.sp-slider .sp-slider_number', 'data.slide_counter_bg_color');
		$output .= $lodash->unit('font-size', '.sp-slider .sp-slider_number', 'data.slide_counter_fontsize', 'px');
		$output .= $lodash->unit('font-family', '.sp-slider .sp-slider_number', 'data.slide_counter_fontfamily', '', false);
		$output .= $lodash->unit('bottom', '.sp-slider .sp-slider_number', 'data.slide_counter_gap_bottom', 'px');
		$output .= $lodash->unit('left', '.sp-slider .sp-slider_number', 'data.slide_counter_gap_left', 'px');
		$output .= $lodash->spacing('padding', '.sp-slider .sp-slider_number', 'data.slide_counter_padding');

		$output .= ' <# if (!_.isEmpty(data.slideshow_items) && data.slideshow_items) {
			_.each (data.slideshow_items, function(item_value, item_key) {
			let uniqid = `#sp-slider-item-${data.id}-num-${item_key}-key`; 
		#>';

		$output .= '
				#sppb-addon-{{ data.id }} .dot-controller-with_image.sp-slider .sp-dots ul li.sp-dot-{{item_key}}{
					<#
					var slider_img = {}
					if (typeof item_value.slider_img !== "undefined" && typeof item_value.slider_img.src !== "undefined") {
						slider_img = item_value.slider_img
					} else {
						slider_img = {src: item_value.slider_img}
					}
					if(slider_img.src){
						if(slider_img.src.indexOf("http://") == 0 || slider_img.src.indexOf("https://") == 0){
					#>
							background: url({{slider_img.src}}) no-repeat scroll center center / cover;
						<# } else { #>
							background: url({{pagebuilder_base + slider_img.src}}) no-repeat scroll center center / cover;
						<# }
					} #>
				}';
		$output .= '<# if (item_value.slider_overlay_options !== "undefined" && item_value.slider_overlay_options === "color_overlay"){ #>';
		$output .= $lodash->color('background', '{{uniqid}}.sp-item .sp-background:after, {{uniqid}}.sp-item .sp-video-background-mask', 'item_value.slider_bg_overlay');
		$output .= '<# } #>';
		$output .= $lodash->color('background', '{{uniqid}}.sp-item .sp-background:after,{{uniqid}}.sp-item .sp-video-background-mask', 'item_value.slider_bg_gradient_overlay');
		$output .= '	
				<# if(item_value.video_volume_btn !== "undefined" && item_value.video_volume_btn){ #>
					#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-video-control {
						display:block;
					}
				<# } else { #>
					#sppb-addon-{{ data.id }} {{uniqid}}.sp-item .sp-video-control {
						display:none;
					}
				<# } #>

				<# if (!_.isEmpty(item_value.slideshow_inner_items)) {
					_.each (item_value.slideshow_inner_items, function(inner_value, inner_item_key) {
						let inner_uniqid = `#sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
				#>';
		$output .= '<# if (inner_value.content_type !== "image_content") { #>';
		$output .= $lodash->color('color', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_color');
		// $output .= $lodash->unit('font-size', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_fontsize', 'px');
		// $output .= $lodash->unit('line-height', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_lineheight', 'px');
		$output .= $lodash->textShadow('.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_text_shadow');
		$output .= $lodash->typography('.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_typography', [
			'font'           => 'inner_value.content_font_family',
			'size'           => 'inner_value.content_fontsize',
			'line_height'    => 'inner_value.content_lineheight',
			'letter_spacing' => 'inner_value.content_letterspacing',
			'uppercase'      => 'inner_value.content_font_style?.uppercase',
			'italic'         => 'inner_value.content_font_style?.italic',
			'underline'      => 'inner_value.content_font_style?.underline',
			'weight'         => 'inner_value.content_font_style?.weight',
		]);
		// $output .= $lodash->unit('letter-spacing', '.sp-slider {{uniqid}} {{inner_uniqid}}', ('inner_value.content_letterspacing' !== "custom") ? 'inner_value.content_letterspacing' : 'inner_value.custom_letterspacing');
		$output .= '<# } #>';

		$output .= '<# if (inner_value.content_type !== "btn_content") { #>';
		$output .= $lodash->color('background', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_background');
		$output .= $lodash->spacing('margin', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_margin');
		$output .= $lodash->spacing('padding', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_padding');
		$output .= '<# if (!_.isEmpty(inner_value.content_border) && _.trim(inner_value.content_border)) { #>';
		$output .= '<# inner_value.border_style = "solid"#>';
		$output .= $lodash->border('border-style', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.border_style');
		$output .= '<# } #>';
		$output .= $lodash->border('border-width', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_border');
		$output .= $lodash->border('border-color', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_border_color');
		$output .= $lodash->unit('border-radius', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_border_radius', 'px', false);
		$output .= '<# } #>';
		$output .= '<# if (inner_value.content_type == "btn_content" || inner_value.content_type == "image_content") { #>';
		$output .= $lodash->boxShadow('.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.btn_box_shadow');
		$output .= '<# } #>';

		$output .= '<# if (inner_value.content_type !== "icon_content") { #>';
		$output .= $lodash->unit('font-family', '.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_font_family');
		$output .= $lodash->typography('.sp-slider {{uniqid}} {{inner_uniqid}}', 'inner_value.content_typography', [
			'font'           => 'inner_value.content_font_family',
			'size'           => 'inner_value.content_fontsize',
			'line_height'    => 'inner_value.content_lineheight',
			'letter_spacing' => 'inner_value.content_letterspacing',
			'uppercase'      => 'inner_value.content_font_style?.uppercase',
			'italic'         => 'inner_value.content_font_style?.italic',
			'underline'      => 'inner_value.content_font_style?.underline',
			'weight'         => 'inner_value.content_font_style?.weight',
		]);
		$output .= '<# } #>';

		$output .= '<#
						let image_content_style = "";

						var image_content = {}
						if(!_.isEmpty(inner_value.image_content) && inner_value.image_content){
							if (typeof inner_value.image_content !== "undefined" && typeof inner_value.image_content.src !== "undefined") {
								image_content = inner_value.image_content
							} else {
								image_content = {src: inner_value.image_content}
							}
						}

						if(image_content.src){
							if(image_content.src.indexOf("http://") == 0 || image_content.src.indexOf("https://") == 0){
								image_content_style += `background-image:url(${image_content.src});background-size:100% 100%;background-position:center center;background-attachment:scroll;background-repeat: no-repeat;`;
							} else {
								image_content_style += `background-image:url(${image_content.src});background-size:100% 100%;background-position:center center;background-attachment:scroll;background-repeat: no-repeat;`;
							}
						}
						#>

						.sp-slider {{uniqid}} {{inner_uniqid}} .sp-slider-caption-image {
							{{image_content_style}}
						} #>';

		$output .= '<#
			if (_.isEmpty(inner_value.image_content_height)) {
				inner_value.image_content_height = {xl: 385, xxl: 385, md: "", sm: "", xs: ""};
			}

			inner_value.inner_content_min_height = 385;
		#>';

		$output .= $lodash->unit('min-height', '.sp-slider {{uniqid}} {{inner_uniqid}} .sp-slider-caption-image', 'inner_value.inner_content_min_height', 'px');
		$output .= $lodash->unit('height', '.sp-slider {{uniqid}} {{inner_uniqid}} .sp-slider-caption-image', 'inner_value.image_content_height', 'px');
		$output .= $lodash->unit('width', '.sp-slider {{uniqid}} {{inner_uniqid}} .sp-slider-caption-image', ('!_.isEmpty(inner_value.image_content_width)') ? 'inner_value.image_content_width' : '400', 'px');

		$output .= '<# if (inner_value.button_background_options === "color_bg") { #>';
		$output .= $lodash->color('background', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text', 'inner_value.button_background_color');
		$output .= '<# inner_value.border_style = "solid"#>';
		$output .= $lodash->border('border-style', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text', 'inner_value.border_style');
		$output .= $lodash->color('background', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text:hover', 'inner_value.button_background_color_hover');
		$output .= $lodash->color('color', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text:hover, .sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text:focus', 'inner_value.button_hover_color');
		$output .= $lodash->border('border-color', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text:hover, .sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text:focus', 'inner_value.button_hover_border_color');

		$output .= '<# } else { #>';
		$output .= $lodash->color('background', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text', 'inner_value.button_background_gradient');
		$output .= $lodash->color('background', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-text', 'inner_value.button_background_gradient_hover');
		$output .= '<# } #>';
		$output .= $lodash->spacing('margin', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button', 'inner_value.content_margin');
		$output .= $lodash->spacing('margin', '.sp-slider {{uniqid}} {{inner_uniqid}}.sppb-sp-slider-button .sp-slider-btn-icon', 'inner_value.button_icon_margin');

		$output .= '<# })
				}
			})
		} #>';

		$output .= $lodash->spacing('padding', '.sp-slider-custom-dot-indecators', 'data.text_thumb_ctlr_wrap_padding');
		$output .= $lodash->color('background', '.sp-slider-custom-dot-indecators', 'data.text_thumb_ctlr_wrap_bg');
		$output .= $lodash->unit('width', '.sp-slider-custom-dot-indecators', 'data.text_thumb_ctlr_wrap_width', '%');

		$output .= $lodash->unit('width', '.sp-slider-custom-dot-indecators ul li', 'data.text_thumb_ctlr_individual_width', 'px');

		$output .= $lodash->color('color', '.sp-slider-text-thumb-number', 'data.text_thumb_number_color');
		$output .= $lodash->unit('font-weight', '.sp-slider-text-thumb-number', 'data.text_thumb_number_font_weight', '', false);
		$output .= $lodash->unit('font-size', '.sp-slider-text-thumb-number', 'data.text_thumb_number_font_size', 'px');

		$output .= $lodash->color('color', '.sp-slider-dot-indecator-text.sp-dot-text-key-1', 'data.text_thumb_title_color');
		$output .= $lodash->unit('font-weight', '.sp-slider-dot-indecator-text.sp-dot-text-key-1', 'data.text_thumb_title_font_weight', '', false);
		$output .= $lodash->unit('font-size', '.sp-slider-dot-indecator-text.sp-dot-text-key-1', 'data.text_thumb_title_font_size', 'px');
		$output .= $lodash->unit('line-height', '.sp-slider-dot-indecator-text.sp-dot-text-key-1', 'data.text_thumb_title_lineheight', 'px');

		$output .= $lodash->color('color', '.sp-slider-dot-indecator-text.sp-dot-text-key-2', 'data.text_thumb_subtitle_color');
		$output .= $lodash->unit('font-weight', '.sp-slider-dot-indecator-text.sp-dot-text-key-2', 'data.text_thumb_subtitle_font_weight', '', false);
		$output .= $lodash->unit('font-size', '.sp-slider-dot-indecator-text.sp-dot-text-key-2', 'data.text_thumb_subtitle_font_size', 'px');

		$output .= $lodash->unit('width', '.sp-slider .sp-slider-content-wrap', 'data.content_container_width', '%', true, '', 'margin: 0 auto;');
		$output .= '
		</style>
			
			<# 

			let content_class = (!_.isEmpty(data.class) && data.class) ?  data.class : "";
			let slide_vertically = (typeof data.slide_vertically !== "undefined" && data.slide_vertically) ? true : false;
			let autoplay = (typeof data.autoplay !== "undefined" && data.autoplay) ? true : false;
			let pause_on_hover = (typeof data.pause_on_hover !== "undefined" && data.pause_on_hover) ? true : false;
			let interval = (!_.isEmpty(data.interval) && data.interval) ? data.interval : 5;
			let speed = (!_.isEmpty(data.speed) && data.speed) ? data.speed : 800;

			let height = (!_.isEmpty(data.height) && data.height) ? data.height : "";
			let custom_height_xxl = (!_.isEmpty(data.custom_height.xxl)) ? data.custom_height.xxl + "px" : "";
			let custom_height_xl = (!_.isEmpty(data.custom_height.xl)) ? data.custom_height.xl + "px" : "";
			let custom_height_lg = (!_.isEmpty(data.custom_height.lg)) ? data.custom_height.lg + "px" : "";
			let custom_height_md = (!_.isEmpty(data.custom_height.md)) ? data.custom_height.md + "px" : "";
			let custom_height_sm = (!_.isEmpty(data.custom_height.sm)) ? data.custom_height.sm + "px" : "";
			let custom_height_xs = (!_.isEmpty(data.custom_height.xs)) ? data.custom_height.xs + "px" : "";
			let slider_animation = (!_.isEmpty(data.slider_animation) && data.slider_animation) ? data.slider_animation : "";

			let dataVerticleSlide = "";
			if(slider_animation === "stack"){
				dataVerticleSlide = \'data-slide-vertically="\'+(slide_vertically ? "true" : "false")+\'"\';
			}
			let data_three_d_rotate = "";
			if(slider_animation === "3D"){
				data_three_d_rotate = \'data-3d-rotate="\'+(data.three_d_rotate ? data.three_d_rotate : "15")+\'"\';
			}
			let timer = (typeof data.timer !== "undefined" && data.timer) ? true : false;

			let dot_controllers = (typeof data.dot_controllers !== "undefined" && data.dot_controllers) ? true : false;
			let dot_controllers_style = (!_.isEmpty(data.dot_controllers_style) && data.dot_controllers_style) ? data.dot_controllers_style : "";
			let dot_controllers_position = (!_.isEmpty(data.dot_controllers_position) && data.dot_controllers_position) ? data.dot_controllers_position : "";

			let arrow_controllers = (typeof data.arrow_controllers!=="undefined" && data.arrow_controllers) ? true : false;
			let arrow_controllers_content = (!_.isEmpty(data.arrow_controllers_content) && data.arrow_controllers_content) ? data.arrow_controllers_content : "text_only";
			let arrow_controllers_style = (!_.isEmpty(data.arrow_controllers_style) && data.arrow_controllers_style) ? data.arrow_controllers_style : "";
			let arrow_controllers_position = (!_.isEmpty(data.arrow_controllers_position) && data.arrow_controllers_position) ? data.arrow_controllers_position : "";
			let arrow_on_hover = (typeof data.arrow_on_hover!=="undefined" && data.arrow_on_hover) ? true : false;
			
			let line_indecator = (typeof data.line_indecator!=="undefined" && data.line_indecator) ? true : false;

			let slide_counter = (typeof data.slide_counter!=="undefined" && data.slide_counter) ? true : false;
			
			let slider_height_xxl = "";
			let slider_height_xl = "";
			let slider_height_lg = "";
			let slider_height_md = "";
			let slider_height_sm = "";
			let slider_height_xs = "";
			if(height=="full"){
				slider_height_xxl = "full";
				slider_height_xl = "full";
				slider_height_lg = "full";
				slider_height_md = "full";
				slider_height_sm = "full";
				slider_height_xs = "full";
			} else {
				slider_height_xxl = custom_height_xxl;
				slider_height_xl = custom_height_xl;
				slider_height_lg = custom_height_lg;
				slider_height_md = custom_height_md;
				slider_height_sm = custom_height_sm;
				slider_height_xs = custom_height_xs;
			}

			let dot_style_class = "";
			let dot_position_class ="";
			if(dot_controllers){
				if(dot_controllers_style){
					dot_style_class = "dot-controller-" + dot_controllers_style;
				}
				if(dot_controllers_position){
					dot_position_class = "dot-controller-position-" + dot_controllers_position;
				}
			}
			
			let arrow_position_class = "";
			if(arrow_controllers_style == "along" &&  arrow_controllers_position){
				arrow_position_class = "arrow-position-" + arrow_controllers_position;
			}
			let arrow_hover_class = "";
			if(arrow_on_hover){
				arrow_hover_class = "arrow-show-on-hover";
			}
			
			let content_vertical_alignment = (typeof data.content_vertical_alignment !== "undefined" && data.content_vertical_alignment) ? "slider-content-vercally-center" : "";
			var dots = "";
			#>
			<div id="sppb-sp-slider-{{data.id}}" data-id="sppb-sp-slider-{{data.id}}" class="sppb-addon-sp-slider sp-slider {{content_class}} {{dot_style_class}} {{dot_position_class}} {{arrow_position_class}} {{arrow_hover_class}}" data-height-xxl="{{slider_height_xxl}}" data-height-xl="{{slider_height_xl}}"  data-height-lg="{{slider_height_lg}}" data-height-md="{{slider_height_md}}" data-height-sm="{{slider_height_sm}}" data-height-xs="{{slider_height_xs}}" data-slider-animation="{{slider_animation}}" {{{dataVerticleSlide}}} {{{data_three_d_rotate}}} data-autoplay="{{autoplay}}" data-interval="{{interval * 1000}}" data-timer="{{timer}}" data-speed="{{speed}}" data-dot-control="{{dot_controllers}}" data-arrow-control="{{arrow_controllers}}" data-indecator="{{line_indecator}}" data-arrow-content="{{arrow_controllers_content}}" data-slide-count="{{slide_counter}}" data-dot-style="{{data.dot_controllers_style}}" data-pause-hover="{{(pause_on_hover && autoplay ? \'true\' : \'false\')}}">
			<#
				if(!_.isEmpty(data.slideshow_items)){
					_.each (data.slideshow_items, function(item_value, item_key) {
						let uniqid = `sp-slider-item-${data.id}-num-${item_key}-key`;
						let last_field_key = item_key;
						let activeClass = "";
						if(item_key==0){
							activeClass = "active";
						}
			#>

					<div id="{{uniqid}}" class="sp-item {{activeClass}} {{content_vertical_alignment}}">
					<# if(data.content_container_option==="bootstrap"){ #>
						<div class="sppb-container">
						<div class="sppb-row">
						<div class="sppb-col-sm-12">
					<# } else { #>
						<div class="sp-slider-content-wrap">
					<# }
						var image_in_column = (typeof item_value.image_in_column !== "undefined" && item_value.image_in_column) ? true : false;
						var image_column_width = (_.isObject(item_value.image_column_width) && item_value.image_column_width.md) ? item_value.image_column_width.md : 6;
						var image_column_width_sm = (_.isObject(item_value.image_column_width) && item_value.image_column_width.sm) ? item_value.image_column_width.sm : 6;
						var image_column_width_xs = (_.isObject(item_value.image_column_width) && item_value.image_column_width.xs) ? item_value.image_column_width.xs : 6;
						var image_column_reverse = (typeof item_value.image_column_reverse!=="undefined" && item_value.image_column_reverse) ? true : false;
						var icon_display_block = (typeof item_value.icon_display_block!=="undefined" && item_value.icon_display_block) ? "sp-slider-icon-block" : "";
						var content_alignment = (!_.isEmpty(item_value.content_alignment) && item_value.content_alignment) ? item_value.content_alignment : "";
						var image_content_alignment = (!_.isEmpty(item_value.image_content_alignment) && item_value.image_content_alignment) ? item_value.image_content_alignment : "";

							if(!image_in_column){
					#>
								<div class="sp-slider-content-align-{{content_alignment}}">
								<#
								_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
									let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
									let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
									let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
									let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
									if(animation_timing_function == "cubic-bezier"){
										animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
									}
									let animation_settings = {};
									if(inner_value.content_animation_type == "rotate"){
										animation_settings = {
											"type":"rotate",
											"from":inner_value.animation_rotate_from + "deg",
											"to":inner_value.animation_rotate_to + "deg",
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										};
									} else if(inner_value.content_animation_type == "text-animate"){
										animation_settings = {
											"type":"text-animate",
											"direction":inner_value.animation_slide_direction,
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										}
									} else if(inner_value.content_animation_type == "zoom"){
										animation_settings = {
											"type":"zoom",
											"direction":"zoomIn",
											"from":0,
											"to":1,
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										};
									} else {
										animation_settings = {
											"type":"slide",
											"direction":inner_value.animation_slide_direction,
											"from":inner_value.animation_slide_from+"%",
											"to":"0%",
											"duration":inner_value.animation_duration,
											"after":inner_value.animation_delay,
											"timing_function":animation_timing_function,
										};
									}

									let animationJson = JSON.stringify(animation_settings);

									let btn_content = "";
									let btn_icon_arr = (typeof inner_value.button_icon !== "undefined" && inner_value.button_icon) ? inner_value.button_icon.split(" ") : "";
									let btn_icon_name = btn_icon_arr.length === 1 ? "fa "+inner_value.button_icon : inner_value.button_icon;
									
									if (inner_value.button_icon_position == "left") {
										if(inner_value.button_icon) {
											btn_content = \'<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"> <i class="\' + btn_icon_name + \'"></i></span> \' + inner_value.btn_content + \'</span>\';
										} else {
											btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \'</span>\';
										} 
									} else {
										if(inner_value.button_icon){
											btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \' <span class="sp-slider-btn-icon"><i class="\' + btn_icon_name + \'"></i></span></span>\';
										} else {
											btn_content = \'<span class="sp-slider-btn-text">\'+ inner_value.btn_content + \'</span>\';
										}
									}
									let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

									if(inner_value.content_type == "text_content"){
								#>
										<div id="{{inner_uniqid}}" class="sppb-sp-slider-text sp-editable-content {{content_class}}" data-id={{data.id}} data-fieldName="{{last_field_key}}-{{last_field_inner_key}}-content_text" data-layer="true" data-animation={{animationJson}}>
											{{{inner_value.content_text}}}
										</div>
									<# } else if(inner_value.content_type == "image_content"){ #>
										<div id="{{inner_uniqid}}" class="sppb-sp-slider-image {{content_class}}" data-layer="true" data-animation={{animationJson}}>
											<div class="sp-slider-caption-image"></div>
										</div>
									<# } else if(inner_value.content_type == "btn_content"){ #>
										<a id="{{inner_uniqid}}" <# if(inner_value.button_target == "_blank"){ #> target="_blank" <# } #> class="sppb-sp-slider-button {{content_class}}" href="{{inner_value.button_url}}" data-layer="true" data-animation={{animationJson}}>
										{{{btn_content}}}
										</a>
									<# } else if(inner_value.content_type == "icon_content"){ 
									let content_icon_arr = !_.isEmpty(inner_value.icon_content) ? inner_value.icon_content.split(" ") : "";
									let content_icon_name = content_icon_arr.length === 1 ? "fa "+inner_value.icon_content : faIconList.version === 4 ? "fa " +content_icon_arr[1] : inner_value.icon_content;	
									#>
										<span id="{{inner_uniqid}}" class="sppb-sp-slider-icon {{content_class}} {{icon_display_block}}" data-layer="true" data-animation={{animationJson}}>
											<span class="{{content_icon_name}}"></span>
										</span>
									<# } else if(inner_value.content_type == "title_content") { 
										if(!inner_value.title_heading_selector){
											inner_value.title_heading_selector = "h2";
										}
									#>
										<{{inner_value.title_heading_selector}} id="{{inner_uniqid}}" class="sppb-sp-slider-title sp-inline-editable-element {{content_class}}" data-id={{data.id}} data-fieldName="title_content_title" contenteditable="true" data-layer="true" data-animation={{animationJson}}>
											{{{inner_value.title_content_title}}}
										</{{inner_value.title_heading_selector}}>
									<# }

								}) #>
								</div>
							<# } else { #>
								<div class="sppb-row">
									<# if(!image_column_reverse){ #>
										<div class="sppb-col-xs-{{12-image_column_width_xs}} sppb-col-sm-{{12-image_column_width_sm}} sppb-col-md-{{12-image_column_width}}">
											<div class="sp-slider-content-align-{{content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
													let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}
				
													let animationJson = JSON.stringify(animation_settings);
				
													let btn_content = "";
													let btn_icon_arr = (typeof inner_value.button_icon !== "undefined" && inner_value.button_icon) ? inner_value.button_icon.split(" ") : "";
													let btn_icon_name = btn_icon_arr.length === 1 ? "fa "+inner_value.button_icon : inner_value.button_icon;
													
													if (inner_value.button_icon_position == "left") {
														if(inner_value.button_icon) {
															btn_content = \'<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"> <i class="\' + btn_icon_name + \'"></i></span> \' + inner_value.btn_content + \'</span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \'</span>\';
														} 
													} else {
														if(inner_value.button_icon){
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \' <span class="sp-slider-btn-icon"><i class="\' + btn_icon_name + \'"></i></span></span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\'+ inner_value.btn_content + \'</span>\';
														}
													}
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";
				
													if(inner_value.content_type == "text_content"){
												#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-text sp-editable-content {{content_class}}" data-id={{data.id}} data-fieldName="{{last_field_key}}-{{last_field_inner_key}}-content_text" data-layer="true" data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.content_text}}}
														</div>
													<# } else if(inner_value.content_type == "btn_content"){ #>
														<a id="{{inner_uniqid}}" <# if(inner_value.button_target == "_blank"){ #> target="_blank" <# } #> class="sppb-sp-slider-button {{content_class}}" href="{{inner_value.button_url}}" data-layer="true" data-animation={{animationJson}}>
														{{{btn_content}}}
														</a>
													<# } else if(inner_value.content_type == "icon_content"){
														let content_icon_arr = !_.isEmpty(inner_value.icon_content) ? inner_value.icon_content.split(" ") : "";
														let content_icon_name = content_icon_arr.length === 1 ? "fa "+inner_value.icon_content : faIconList.version === 4 ? "fa " +content_icon_arr[1] : inner_value.icon_content;
													#>
														<span id="{{inner_uniqid}}" class="sppb-sp-slider-icon {{content_class}} {{icon_display_block}}" data-layer="true" data-animation={{animationJson}}>
															<span class="{{content_icon_name}}"></span>
														</span>
													<# } else if(inner_value.content_type == "title_content") { 
														if(!inner_value.title_heading_selector){
															inner_value.title_heading_selector = "h2";
														}
													#>
														<{{inner_value.title_heading_selector}} id="{{inner_uniqid}}" class="sppb-sp-slider-title sp-inline-editable-element {{content_class}}" data-id={{data.id}} data-fieldName="title_content_title" contenteditable="true" data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.title_content_title}}}
														</{{inner_value.title_heading_selector}}>
													<# }
				
												}) #>
											</div>
										</div>
										<div class="sppb-col-xs-{{image_column_width_xs}} sppb-col-sm-{{image_column_width_sm}} sppb-col-md-{{image_column_width}} image-align-{{image_content_alignment}}">
											<div class="sp-slider-image-align-{{image_content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
                          let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}
				
													let animationJson = JSON.stringify(animation_settings);
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

													if(inner_value.content_type == "image_content"){
													#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-image {{content_class}}" data-layer="true" data-animation={{animationJson}}>
															<div class="sp-slider-caption-image"></div>
														</div>
													<# }
												}) #>
											</div>
										</div>
									<# } else { #>
										<div class="sppb-col-xs-{{image_column_width_xs}} sppb-col-sm-{{image_column_width_sm}} sppb-col-md-{{image_column_width}} image-align-{{image_content_alignment}}">
											<div class="sp-slider-image-align-{{image_content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
                          let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}
				
													let animationJson = JSON.stringify(animation_settings);
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";

													if(inner_value.content_type == "image_content"){
													#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-image {{content_class}}" data-layer="true" data-animation={{animationJson}}>
															<div class="sp-slider-caption-image"></div>
														</div>
													<# }
												}) #>
											</div>
										</div>
										<div class="sppb-col-xs-{{12-image_column_width_xs}} sppb-col-sm-{{12-image_column_width_sm}} sppb-col-md-{{12-image_column_width}}">
											<div class="sp-slider-content-align-{{content_alignment}}">
												<#
												_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
                          let last_field_inner_key = `slideshow_inner_items-${inner_item_key}`;
													let inner_uniqid = `sp-slider-inner-item-${data.id}-num-${inner_item_key}-key`;
													let animation_timing_function = (!_.isEmpty(inner_value.animation_timing_function) && inner_value.animation_timing_function) ? inner_value.animation_timing_function : "";
													let animation_cubic_bezier_value = (!_.isEmpty(inner_value.animation_cubic_bezier_value) && inner_value.animation_cubic_bezier_value) ? inner_value.animation_cubic_bezier_value.replace(/\s/g,"") : "";
													if(animation_timing_function == "cubic-bezier"){
														animation_timing_function = `cubic-bezier(${animation_cubic_bezier_value})`;
													}
													let animation_settings = {};
													if(inner_value.content_animation_type == "rotate"){
														animation_settings = {
															"type":"rotate",
															"from":inner_value.animation_rotate_from + "deg",
															"to":inner_value.animation_rotate_to + "deg",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else if(inner_value.content_animation_type == "text-animate"){
														animation_settings = {
															"type":"text-animate",
															"direction":inner_value.animation_slide_direction,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														}
													} else if(inner_value.content_animation_type == "zoom"){
														animation_settings = {
															"type":"zoom",
															"direction":"zoomIn",
															"from":0,
															"to":1,
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													} else {
														animation_settings = {
															"type":"slide",
															"direction":inner_value.animation_slide_direction,
															"from":inner_value.animation_slide_from+"%",
															"to":"0%",
															"duration":inner_value.animation_duration,
															"after":inner_value.animation_delay,
															"timing_function":animation_timing_function,
														};
													}
				
													let animationJson = JSON.stringify(animation_settings);
				
													let btn_content = "";
													let btn_icon_arr = (typeof inner_value.button_icon !== "undefined" && inner_value.button_icon) ? inner_value.button_icon.split(" ") : "";
													let btn_icon_name = btn_icon_arr.length === 1 ? "fa "+inner_value.button_icon : inner_value.button_icon;
													
													if (inner_value.button_icon_position == "left") {
														if(inner_value.button_icon) {
															btn_content = \'<span class="sp-slider-btn-text"> <span class="sp-slider-btn-icon"> <i class="\' + btn_icon_name + \'"></i></span> \' + inner_value.btn_content + \'</span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \'</span>\';
														} 
													} else {
														if(inner_value.button_icon){
															btn_content = \'<span class="sp-slider-btn-text">\' + inner_value.btn_content + \' <span class="sp-slider-btn-icon"><i class="\' + btn_icon_name + \'"></i></span></span>\';
														} else {
															btn_content = \'<span class="sp-slider-btn-text">\'+ inner_value.btn_content + \'</span>\';
														}
													}
													let content_class = typeof inner_value.content_class !== "undefined" && inner_value.content_class ? inner_value.content_class : "";
				
													if(inner_value.content_type == "text_content"){
												#>
														<div id="{{inner_uniqid}}" class="sppb-sp-slider-text sp-editable-content {{content_class}}" data-id={{data.id}} data-fieldName="{{last_field_key}}-{{last_field_inner_key}}-content_text" data-layer="true" data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.content_text}}}
														</div>
													<# } else if(inner_value.content_type == "btn_content"){ #>
														<a id="{{inner_uniqid}}" <# if(inner_value.button_target == "_blank"){ #> target="_blank" <# } #> class="sppb-sp-slider-button {{content_class}}" href="{{inner_value.button_url}}" data-layer="true" data-animation={{animationJson}}>
														{{{btn_content}}}
														</a>
													<# } else if(inner_value.content_type == "icon_content"){
														let content_icon_arr = !_.isEmpty(inner_value.icon_content) ? inner_value.icon_content.split(" ") : "";
														let content_icon_name = content_icon_arr.length === 1 ? "fa "+inner_value.icon_content : faIconList.version === 4 ? "fa " +content_icon_arr[1] : inner_value.icon_content;	
													#>
														<span id="{{inner_uniqid}}" class="sppb-sp-slider-icon {{content_class}} {{icon_display_block}}" data-layer="true" data-animation={{animationJson}}>
															<span class="{{content_icon_name}}"></span>
														</span>
													<# } else if(inner_value.content_type == "title_content") { 
														if(!inner_value.title_heading_selector){
															inner_value.title_heading_selector = "h2";
														}
													#>
														<{{inner_value.title_heading_selector}} id="{{inner_uniqid}}" class="sppb-sp-slider-title sp-inline-editable-element {{content_class}}" data-id={{data.id}} data-fieldName="title_content_title" contenteditable="true"  data-layer="true" data-animation={{animationJson}}>
															{{{inner_value.title_content_title}}}
														</{{inner_value.title_heading_selector}}>
													<# }

												}) #>
											</div>
										</div>

									<# } #>

								</div>

							<# }
							if(data.content_container_option === "bootstrap"){
							#>
								</div>
								</div>
								</div>
							<# } else { #>
						</div>
						<# }
						if(!_.isEmpty(item_value.slider_img)){
						#>
							<div class="sp-background"></div>
						<# }
						if(data.slider_animation !== "3D"){
							var slider_video = {}
							if(!_.isEmpty(item_value.slider_video) && item_value.slider_video){
								if (typeof item_value.slider_video !== "undefined" && typeof item_value.slider_video.src !== "undefined") {
									slider_video = item_value.slider_video
								} else {
									slider_video = {src: item_value.slider_video}
								}
							}
							if(slider_video.src && !item_value.enable_youtube_vimeo){
								if(slider_video.src.indexOf("http://") == 0 || slider_video.src.indexOf("https://") == 0){
						#>
									<div class="sp-video-background" data-video_src="{{slider_video.src}}"></div>
								<# } else { #>
									<div class="sp-video-background" data-video_src="{{pagebuilder_base +  slider_video.src }}"></div>
								<# }
							} else if(!_.isEmpty(item_value.youtube_vimeo_url) && item_value.youtube_vimeo_url && item_value.enable_youtube_vimeo) {
								if(item_value.youtube_vimeo_url.indexOf("http://") == 0 || item_value.youtube_vimeo_url.indexOf("https://") == 0){
								#>
									<div class="sp-video-background" data-video_src="{{item_value.youtube_vimeo_url}}"></div>
								<# } else { #>
									<div class="sp-video-background" data-video_src="{{ pagebuilder_base + item_value.youtube_vimeo_url }}"></div>
								<# }
							}
						} #>

						<#
						if(data.dot_controllers_style == "with_text"){
							let captionItem = []; 
							if(_.isArray(item_value.slideshow_inner_items)){
								let dot_item = 0;
								_.each(item_value.slideshow_inner_items, function(inner_value, inner_item_key){
									if(inner_value.content_type == "title_content" && dot_item < 2 ) {
										captionItem.unshift(inner_value);
									}
									dot_item++;
								})
							}
							dots += `<li class="${item_key == 0 ? "active sp-text-thumbnail-list" : "sp-text-thumbnail-list"}">`;
								dots += `<div class="sp-slider-text-thumb-number">${(item_key > 8 ? (item_key + 1) : "0"+(item_key + 1))}</div>`;
								dots += `<div class="sp-dot-indicator-wrap">`;
									dots += `<span class="dot-indicator"></span>`;
								dots += `</div>`;
								dots += `<div class="sp-slider-text-thumb-caption">`;
									if(_.isArray(captionItem)){
										_.each(captionItem, function(inner_value, dot_key){
											dots += `<div class="sp-slider-dot-indecator-text sp-dot-text-key-${dot_key + 1}">`;
												dots += inner_value.title_content_title;
											dots +=`</div>`;
										})
									}
								dots += `</div>`;
							dots += `</li>`;
						}
						#>
					</div>
				<# }) 

			} #>

			<# if(data.dot_controllers_style == "with_text" && data.dot_controllers){ #>
				<div class="sp-slider-custom-dot-indecators">
					<ul>
						{{{dots}}}
					</ul>
				</div>
			<# } #>

			</div>
		 ';

		return $output;
	}
}
