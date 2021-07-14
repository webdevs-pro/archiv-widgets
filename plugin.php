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
		require __DIR__ . '/widgets/item-block.php';
	}
	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Item_Block_Widget() );
	}
}
new Archiv_Register_Widgets();