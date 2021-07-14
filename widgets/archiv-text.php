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



class Archiv_Text_Widget extends \Elementor\Widget_Text_Editor {

	public function get_name() {
		return 'archiv-text';
	}

	public function get_title() {
		return __( 'Archiv Text', 'archiv-widgets' );
	}

	public function get_icon() {
		return 'eicon-single-page';
	}

	public function get_categories() {
		return [ 'archiv-page-widgets' ];
	}

	protected function register_controls() {
		parent::register_controls();

		// $this->remove_control( 'drop_cap' );
		// $this->remove_control( 'text_columns' );
		// $this->remove_control( 'column_gap' );



		
		// // get advanced tab controls array
      // $control_stack = $this->get_stack();
      // foreach ( $control_stack['controls'] as $key => $value ) {
		// 	if ( $value['tab'] == 'advanced' ) {
		// 		$advanced_controls[] = $key;
		// 		if ( $value['type'] == 'section' ) {
		// 			$section_name = $value['name'];
		// 		}
		// 		if ( $section_name == 'section_effects' ) {
		// 			$motion_controls[] = $key;
		// 		}
		// 	}
      // }
		// $advanced_tab_controls_to_remove = array_diff( array_merge( $advanced_controls, $motion_controls ), array_intersect( $advanced_controls, $motion_controls ) );
		
		// foreach ( $motion_controls as $control_name ) {
		// 	$this->remove_control( $control_name );
		// }


	}

	
}


// text
// style tab - shadow
// advanced - all except motion 

// heading
// content - link
// content - size
// style - shadow
// style - blend
// advanced - all except motion 


// image
// size - full by default
// caption - remove attachment option
// link - remove
// style - image - remove opacity, filter, border, box shadow
// style - caption - remove text shadow, background, spacing


// video 
// source - remove self hosted
// style - remove filter, shadow



// quote 
// content editor change to wysiwyg
// remove twett button