<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! class_exists( 'Plutus_MetaBox' ) ):
	class Plutus_MetaBox {

		private static $_instance = null;

		public static function instance() {
			if ( is_null( self::$_instance ) ) {
				self::$_instance = new self();
			}

			return self::$_instance;
		}

		public function __construct() {

			// Uses priority 20 to support custom port types registered using the default priority.
			add_action( 'init', array( $this, 'register_meta_boxes' ), 20 );

			add_action( 'admin_enqueue_scripts', array( $this, 'add_admin_scripts' ), 10, 1 );

			$this->load_files();
		}

		/**
		 * Load files
		 */
		public function load_files() {
			require_once PLUTUS_RECIPE_DIR . 'inc/meta-box/class-plutus-add-metabox.php';
			require_once PLUTUS_RECIPE_DIR . 'inc/meta-box/class-plutus-metabox-fields.php';
			require_once PLUTUS_RECIPE_DIR . 'inc/meta-box/register-recipe-data.php';
		}

		/**
		 * Register meta boxes.
		 */
		public function register_meta_boxes() {
			$configs = apply_filters( 'plutus_meta_boxes', array() );

			foreach ( $configs as $config ) {
				new Plutus_Add_MetaBox( $config );
			}
		}

		/**
		 * Enqueue scripts on custom post add/edit pages
		 *
		 * @param $hook
		 */
		function add_admin_scripts( $hook ) {
			if ( in_array( $hook, array( 'post-new.php', 'post.php', 'edit-tags.php', 'term.php' ) ) ) {

				wp_enqueue_style( 'wp-color-picker' );
				wp_enqueue_script( 'wp-color-picker' );
				wp_enqueue_media();

				wp_enqueue_script( 'plutus-admin-post', PLUTUS_RECIPE_URL . 'js/admin-post.js', array( 'jquery', 'wp-color-picker' ), PLUTUS_RECIPE_VERSION, true );
				wp_enqueue_style( 'plutus-admin-post', PLUTUS_RECIPE_URL . 'css/admin-post.css', '', PLUTUS_RECIPE_VERSION );

				wp_localize_script( 'plutus-admin-post', 'PlutusObject', array(
					'WidgetImageTitle'  => esc_html__( 'Select an image', 'plutus-recipe-pro' ),
					'WidgetImageButton' => esc_html__( 'Insert into widget', 'plutus-recipe-pro' ),
					'ajaxUrl'           => admin_url( 'admin-ajax.php' ),
					'nonce'             => wp_create_nonce( 'ajax-nonce' ),
				) );
			}
		}
	}
endif;
