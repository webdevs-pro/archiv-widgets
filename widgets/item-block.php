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



class Archiv_Item_Block_Widget extends \Elementor\Widget_Base {

	public function get_name() {
		return 'archiv-item-block';
	}

	public function get_title() {
		return __( 'Item', 'archiv-widgets' );
	}

	public function get_icon() {
		return 'eicon-single-page';
	}

	public function get_categories() {
		return [ 'archiv-page-widgets' ];
	}

	protected function _register_controls() {

		// SECTION CONTENT
		$this->start_controls_section( 'section_content', [
         'label' => __( 'Content', 'archiv-widgets' ),
         'tab' => Controls_Manager::TAB_CONTENT,
      ]);


      $this->add_control(
         'post_id', [
            'label' => __( 'Select Item', 'archiv-widgets' ),
            'type' => ElementorPro\Modules\QueryControl\Module::QUERY_CONTROL_ID,
            'options' => [],
            'label_block' => true,
            'multiple' => false,
            'autocomplete' => [
               'object' => ElementorPro\Modules\QueryControl\Module::QUERY_OBJECT_POST,
               'query' => [
                  'post_type' => ARCHIVE_POST_TYPE,
                  'post_status' => 'publish',
               ],
            ],
         ]
      );


		$this->end_controls_section(); 



	}


	protected function render() { // php template
		$settings = $this->get_settings_for_display();

      if ( $settings['post_id'] && get_option( 'archiv_item_block_template' ) && is_numeric( get_option( 'archiv_item_block_template' ) ) ) {
         \Elementor\Plugin::$instance->db->switch_to_post( $settings['post_id'] );
         echo \Elementor\Plugin::instance()->frontend->get_builder_content_for_display( esc_attr( get_option( 'archiv_item_block_template' ) ), true );
         \Elementor\Plugin::$instance->db->restore_current_post();
      } else {
         if ( ! $settings['post_id'] ) {
            echo '<p class="elementor-alert elementor-alert-warning">Select item to display</p>';
         }
         if ( ! get_option( 'archiv_item_block_template' ) || ! is_numeric( get_option( 'archiv_item_block_template' ) ) ) {
            echo '<p class="elementor-alert elementor-alert-warning">Select AE template to display item</p>';
         }
      }
	}
	
}