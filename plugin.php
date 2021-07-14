<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// register widgets
class Archiv_Register_Widgets {
	public function __construct() {
		$this->add_actions();
	}
	private function add_actions() {
		
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		
		add_action( 'elementor/frontend/after_register_scripts', function() {
			// to do replace time() with plugin version
			wp_register_script( 'archiv-widgets', plugins_url( '/assets/archiv-widgets.js', __FILE__ ), array( 'jquery' ), time(), true );
		});
		
		add_action( 'elementor/frontend/after_enqueue_styles', function() {
			// to do replace time() with plugin version
			wp_enqueue_style( 'archiv-widgets', plugins_url( '/assets/archiv-widgets.css', __FILE__ ), array(), time() ); 
			// wp_enqueue_style( 'dh-icons', plugins_url( '/assets/dh-icons-font/style.css', __FILE__ ), array(), time() ); 
		});

	}
	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}
	private function includes() {
		require __DIR__ . '/widgets/archiv-item-block.php';
		require __DIR__ . '/widgets/archiv-text.php';
	}
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Item_Block_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Text_Widget() );
	}
}
new Archiv_Register_Widgets();


add_action( 'elementor/editor/after_enqueue_scripts', function() {
   wp_register_script( 'archiv-editor', ARCHIVE_PLUGIN_DIR_URL . 'assets/editor.js', array( 'jquery' ), time() );
   wp_enqueue_script( 'archiv-editor' );
   // wp_enqueue_style( 'archiv-editor', ARCHIVE_PLUGIN_DIR_URL . 'assets/editor.css', array(), time() ); 
});


// add_action( 'elementor/element/common/_section_style/after_section_start', function($element) {
// 	// $element->remove_control( '_section_style' ); // work

// 	$element->add_control(
// 		'important_note',
// 		[
// 			'type' => \Elementor\Controls_Manager::RAW_HTML,
// 			'raw' => '
// 				<style> 
// 				#elementor-controls {
// 					display: none;
// 				</style>
// 				<#
// 				setTimeout(function() {
// 					jQuery(`.elementor-control-section_effects`).click();
// 					jQuery(`.elementor-control-type-section:not(.elementor-control-section_effects)`).remove();
// 					jQuery(`#elementor-controls`).show();
// 					jQuery(`.elementor-control-section_effects`).unbind(`click`);
// 				}, 100);
// 				#>
// 			',
// 		]
// 	);


// }, 100);








// add_action( 'elementor/element/after_section_start', function( $element, $args ) {

// add_action( 'elementor/element/common/_section_style/after_section_start', function( $element, $args ) {
// 	$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $element->get_name(), '_section_style' );
// 	$control_data['condition'] = [
// 		'some_control' => 'some_value',
// 	];
// 	$element->update_control( '_section_style', $control_data );
// }, 10, 2);