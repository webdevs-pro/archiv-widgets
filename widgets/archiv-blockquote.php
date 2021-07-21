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



class Archiv_Blockquote extends ElementorPro\Modules\Blockquote\Widgets\Blockquote {

	public function get_name() {
		return 'archiv-blockquote';
	}

	public function get_title() {
		return __( 'Archiv Blockquote', 'archiv-widgets' );
	}

	public function get_icon() {
		return 'eicon-blockquote';
	}

	public function get_categories() {
		return [ 'archiv-page-widgets' ];
	}

	protected function register_controls() {
		parent::register_controls();

		// hide controls
		archiv_hide_element_controls( $this, [
			'tweet_button',
			'tweet_button_view',
			'tweet_button_skin',
			'tweet_button_label',
			'user_name',
			'url_type',
			'section_button_style',
			'button_size',
			'button_border_radius',
			'button_color_source',
			'tabs_button_style',
			'button_background_color',
			'button_text_color',
			'button_typography_typography',
		] );

		// update blockquote editor
		$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $this->get_name(), 'blockquote_content' );
		$control_data['type'] = Controls_Manager::WYSIWYG;
		$control_data['tweet_button']['default'] = '';
		$this->update_control( 'blockquote_content', $control_data );

		// disable tweet button
		$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $this->get_name(), 'tweet_button' );
		$control_data['default'] = '';
		$this->update_control( 'tweet_button', $control_data );


	}

	
}

