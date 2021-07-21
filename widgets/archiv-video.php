<?php

use Elementor\Widget_Base;
use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Elementor\Group_Control_Background;
use Elementor\Group_Control_Border;
use Elementor\Scheme_Typography;
use Elementor\Group_Control_Text_Shadow;

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



class Archiv_Video extends \Elementor\Widget_Video {

	public function get_name() {
		return 'archiv-video';
	}

	public function get_title() {
		return __( 'Archiv Video', 'archiv-widgets' );
	}

	public function get_icon() {
		return 'eicon-youtube';
	}

	public function get_categories() {
		return [ 'archiv-page-widgets' ];
	}

	protected function register_controls() {
		parent::register_controls();

		// // hide controls
		// archiv_hide_element_controls( $this, [
		// 	'link_to',
		// 	'link',
		// 	'open_lightbox',
		// 	'image_effects',
		// 	'opacity',
		// 	'css_filters_css_filter',
		// 	'image_border_border',
		// 	'image_box_shadow_box_shadow_type',
		// 	'caption_background_color',
		// 	'caption_text_shadow_text_shadow_type',
		// 	'caption_space',
		// ] );


		// remove caption image source
		$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $this->get_name(), 'video_type' );
		unset( $control_data['options']['hosted'] );
		$this->update_control( 'video_type', $control_data );


	}

	
}

