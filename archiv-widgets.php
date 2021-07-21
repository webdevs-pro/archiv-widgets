<?php
/**
 * Plugin Name: Archiv Widgets
 * Description: Custom Elementor widgets
 * Plugin URI:  https://magnificsoft.com/
 * Version:     0.4
 * Author:      Alex Ischenko
 * Text Domain: archiv-widgets
 */

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly

// constants
define( 'ARCHIVE_PLUGIN_DIR_PATH', dirname( __FILE__ ) ); // for php
define( 'ARCHIVE_PLUGIN_DIR_URL', plugin_dir_url( __FILE__ ) ); // for assets
define( 'ARCHIVE_POST_TYPE', 'art_item' );
// define( 'ARCHIVE_POST_TYPE', 'post' );


// includes
require_once ( ARCHIVE_PLUGIN_DIR_PATH . '/admin/admin.php' );


// main class
final class Archiv_Init {

	const MINIMUM_ELEMENTOR_VERSION = '3.0.0';
	const MINIMUM_PHP_VERSION = '7.0';

	public function __construct() {
		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );
	}

	public function i18n() {
		load_plugin_textdomain( 'archiv-widgets' );
	}

	public function init() {
		// Check if Elementor installed and activated
		if ( ! did_action( 'elementor/loaded' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_missing_main_plugin' ) );
			return;
		}
		// Check for required Elementor version
		if ( ! version_compare( ELEMENTOR_VERSION, self::MINIMUM_ELEMENTOR_VERSION, '>=' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_elementor_version' ) );
			return;
		}
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );
			return;
		}

		// Once we get here, We have passed all validation checks so we can safely include our plugin
		require_once( 'plugin.php' );



		// register dh category
		add_action( 'elementor/elements/categories_registered', function( \Elementor\Elements_Manager $elements_manager ) {
			//https://github.com/elementor/elementor/issues/7445#issuecomment-692123467
			$categories = [];
			$categories['archiv-page-widgets'] =
				[
					'title' =>  __( 'Archiv Page Widgets', 'archiv-widgets' ),
					'icon'  => 'fa fa-plug',
				];

			$old_categories = $elements_manager->get_categories();
			$categories = array_merge($categories, $old_categories);

			$set_categories = function ( $categories ) {
				$this->categories = $categories;
			};

			$set_categories->call( $elements_manager, $categories );
		} );
	}

	public function admin_notice_missing_main_plugin() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" to be installed and activated.', 'archiv-widgets' ),
			'<strong>' . esc_html__( 'Duurzaamthuis Widgets', 'archiv-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'duurzaamthuis' ) . '</strong>'
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_elementor_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'archiv-widgets' ),
			'<strong>' . esc_html__( 'archiv-widgets Widgets', 'archiv-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'Elementor', 'archiv-widgets' ) . '</strong>',
			self::MINIMUM_ELEMENTOR_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}

	public function admin_notice_minimum_php_version() {
		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}
		$message = sprintf(
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'archiv-widgets' ),
			'<strong>' . esc_html__( 'Archiv Widgets', 'archiv-widgets' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'archiv-widgets' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);
		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );
	}
}
new Archiv_Init();


// plugin updates
require 'vendor/plugin-update-checker/plugin-update-checker.php';
$myUpdateChecker = Puc_v4_Factory::buildUpdateChecker(
	'https://github.com/webdevs-pro/archiv-widgets',
	__FILE__,
	'archiv-widgets'
);
//Set the branch that contains the stable release.
$myUpdateChecker->setBranch('main');