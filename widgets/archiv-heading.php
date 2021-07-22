<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



class Archiv_Heading extends \Elementor\Widget_Heading {

	public function get_name() {
		return 'archiv-heading';
	}

	public function get_title() {
		return __( 'Archiv Heading', 'archiv-widgets' );
	}

	public function get_icon() {
		return 'eicon-t-letter';
	}

	public function get_categories() {
		return [ 'archiv-page-widgets' ];
	}

	protected function register_controls() {
		parent::register_controls();

		archiv_hide_element_controls( $this, [
			'size',
			'link',
			'text_shadow_text_shadow_type',
			'blend_mode',
		] );
	}

}

