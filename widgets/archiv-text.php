<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}



class Archiv_Text_Widget extends \Elementor\Widget_Text_Editor {

	public function get_name() {
		return 'archiv-text';
	}

	public function get_title() {
		return __( 'Archiv Text', 'archiv-widgets' );
	}

	public function get_icon() {
		return 'eicon-text';
	}

	public function get_categories() {
		return [ 'archiv-page-widgets' ];
	}

	protected function register_controls() {
		parent::register_controls();

		archiv_hide_element_controls( $this, [
			'drop_cap',
			'text_columns',
			'column_gap',
			'text_shadow_text_shadow_type',
		] );
	}

}

