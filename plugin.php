<?php

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly


// register widgets
class Archiv_Register_Widgets {

	public function __construct() {
		$this->add_actions();
	}

	private function add_actions() {
		add_action( 'elementor/widgets/widgets_registered', [ $this, 'on_widgets_registered' ] );
		add_action( 'elementor/frontend/after_enqueue_styles', function() {
			wp_enqueue_style( 'archiv-widgets', plugins_url( '/assets/archiv-widgets.css', __FILE__ ), array() ); 
		});
	}

	public function on_widgets_registered() {
		$this->includes();
		$this->register_widget();
	}

	private function includes() {
		require __DIR__ . '/widgets/archiv-item-block.php';
		require __DIR__ . '/widgets/archiv-text.php';
		require __DIR__ . '/widgets/archiv-heading.php';
		require __DIR__ . '/widgets/archiv-image.php';
		require __DIR__ . '/widgets/archiv-blockquote.php';
	}

	private function register_widget() {
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Item_Block_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Text_Widget() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Heading() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Image() );
		\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new Archiv_Blockquote() );
	}

}
new Archiv_Register_Widgets();


// enqueue script and styles to hide widgets controls
add_action( 'elementor/editor/after_enqueue_scripts', function() {
	ob_start(); ?>
		<script id="archiv-panel-element-attr">
			document.addEventListener( 'DOMContentLoaded', function () {
				elementor.hooks.addAction( 'panel/open_editor/widget', function( panel, model, view ) { 
					jQuery( '#elementor-panel-inner').attr( 'element', model.attributes.widgetType );
				} );
			})
		</script>
	<?php echo ob_get_clean();

}, 100 );


// print styles to footer
function archiv_hide_element_controls( $widget, $controls ) {
	if ( ! array_intersect( ['archiv_basic', 'archiv_basic' ], wp_get_current_user()->roles ) ) return;
	add_action( 'wp_footer', function() use ( $widget, $controls ) {

		// hide controls
		$widget_name = $widget->get_name();
		echo '<style id="archiv-panel-' . $widget_name . '-hide-controls">';
			foreach ( $controls as $control_name ) {
				echo '#elementor-panel-inner[element="' . $widget_name . '"] .elementor-control-' . $control_name . ' { display: none !important; }';
			}
		echo '</style>';

		// panel styles for editor
		echo '<style id="archiv-panel-styles">
			.elementor-panel-category-title {
				display: none;
			}
			.elementor-panel-category {
				margin-bottom: 10px;
			}
		</style>';
	} );
}


// remove all sections from advanced tab but motion effects
add_action( 'elementor/element/after_section_start', function( $element, $section_id, $args ) {
	if ( ! array_intersect( ['archiv_basic', 'archiv_basic' ], wp_get_current_user()->roles ) ) return;
	if ( $element->get_name() == 'common' ) {
		if ( $section_id != 'section_effects' ) {
			$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $element->get_name(), $section_id );
			$control_data['condition'] = [
				'some_control' => 'some_value', // something unexisting
			];
			$element->update_control( $section_id, $control_data );
		}
	}
}, 10, 3 );


// remove sticky from motion effects tab
add_action( 'elementor/element/common/section_effects/before_section_end', function( $element, $args ) {
	if ( ! array_intersect( ['archiv_basic', 'archiv_basic' ], wp_get_current_user()->roles ) ) return;
	$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $element->get_name(), 'sticky' );
	$control_data['condition'] = [
		'some_control' => 'some_value', // something unexisting
	];
	$element->update_control( 'sticky', $control_data );
}, 10, 2);


// remove selfhosted option from video widget
add_action( 'elementor/element/video/section_video/before_section_end', function( $element, $args ) {
	if ( ! array_intersect( ['archiv_basic', 'archiv_basic' ], wp_get_current_user()->roles ) ) return;
	$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $element->get_name(), 'video_type' );
	unset( $control_data['options']['hosted'] );
	$element->update_control( 'video_type', $control_data );
}, 10, 2);


// remove scc filters from video widget
add_action( 'elementor/element/video/section_video_style/before_section_end', function( $element, $args ) {
	if ( ! array_intersect( ['archiv_basic', 'archiv_basic' ], wp_get_current_user()->roles ) ) return;
	$control_data = \Elementor\Plugin::instance()->controls_manager->get_control_from_stack( $element->get_name(), 'css_filters_css_filter' );
	$control_data['condition'] = [
		'some_control' => 'some_value', // something unexisting
	];
	$element->update_control( 'css_filters_css_filter', $control_data );
}, 10, 2);
