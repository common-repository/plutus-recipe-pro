<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

/**
 * Main Plutus Recipe Pro Class
 *
 * The main class that initiates and runs the plugin.
 *
 * @since 1.0.0
 */
class Class_Plutus_Recipe_Pro {

	/**
	 * Minimum PHP Version
	 *
	 * @since 1.0.0
	 *
	 * @var string Minimum PHP version required to run the plugin.
	 */
	const MINIMUM_PHP_VERSION = '6.3';

	/**
	 * Instance
	 *
	 * @since 1.0.0
	 *
	 * @access private
	 * @static
	 */
	private static $_instance = null;

	/**
	 * Instance
	 *
	 * Ensures only one instance of the class is loaded or can be loaded.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 * @static
	 *
	 */
	public static function instance() {

		if ( is_null( self::$_instance ) ) {
			self::$_instance = new self();
		}

		return self::$_instance;

	}

	/**
	 * Constructor
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function __construct() {

		add_action( 'init', array( $this, 'i18n' ) );
		add_action( 'plugins_loaded', array( $this, 'init' ) );

	}

	/**
	 * Load Textdomain
	 *
	 * Load plugin localization files.
	 *
	 * Fired by `init` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function i18n() {

		load_plugin_textdomain( 'plutus-recipe-pro' );

	}

	/**
	 * Initialize the plugin
	 *
	 * Load the plugin only after other plugins are loaded.
	 * Checks for basic plugin requirements, if one check fail don't continue,
	 * if all check have passed load the files required to run the plugin.
	 *
	 * Fired by `plugins_loaded` action hook.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function init() {
		// Check for required PHP version
		if ( version_compare( PHP_VERSION, self::MINIMUM_PHP_VERSION, '<' ) ) {
			add_action( 'admin_notices', array( $this, 'admin_notice_minimum_php_version' ) );

			return;
		}
		require_once PLUTUS_RECIPE_DIR . 'inc/plutus-recipe-pro-default.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/class-plutus-recipe-pro-icons.php';

		// Metabox
		require_once PLUTUS_RECIPE_DIR . 'inc/meta-box/class-plutus-metabox.php';
		Plutus_MetaBox::instance();


		require_once PLUTUS_RECIPE_DIR . 'inc/plutus-core-functions.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/class-plutus-recipe-pro-sc.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/class-plutus-recipe-index-sc.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/plutus-template-hooks.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/plutus-template-functions.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/plutus-customizer.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/plutus-customizer-css.php';
		require_once PLUTUS_RECIPE_DIR . 'inc/mce.php';

		// Support page builder
		require_once PLUTUS_RECIPE_DIR . 'page-builder/js-composer.php';
		require_once PLUTUS_RECIPE_DIR . 'page-builder/elementor.php';
		require_once PLUTUS_RECIPE_DIR . 'page-builder/gutenberg.php';

		// Add Plugin actions
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
	}


	/**
	 * Admin notice
	 *
	 * Warning when the site doesn't have a minimum required PHP version.
	 *
	 * @since 1.0.0
	 *
	 * @access public
	 */
	public function admin_notice_minimum_php_version() {

		if ( isset( $_GET['activate'] ) ) {
			unset( $_GET['activate'] );
		}

		$message = sprintf(
		/* translators: 1: Plugin name 2: PHP 3: Required PHP version */
			esc_html__( '"%1$s" requires "%2$s" version %3$s or greater.', 'plutus-recipe-pro' ),
			'<strong>' . esc_html__( 'Plutus Recipe Pro', 'plutus-recipe-pro' ) . '</strong>',
			'<strong>' . esc_html__( 'PHP', 'plutus-recipe-pro' ) . '</strong>',
			self::MINIMUM_PHP_VERSION
		);

		printf( '<div class="notice notice-warning is-dismissible"><p>%1$s</p></div>', $message );

	}

	public function enqueue_scripts() {
		wp_enqueue_style( 'magnific-popup', PLUTUS_RECIPE_URL . 'css/magnific-popup.css', '', '1.1.0' );
		wp_enqueue_style( 'owlcarousel', PLUTUS_RECIPE_URL . 'css/owl.carousel.css', '', '1.1.0' );
		wp_enqueue_style( 'plutus-recipe-pro', PLUTUS_RECIPE_URL . 'css/plutus-recipe-pro.css', '', PLUTUS_RECIPE_VERSION );

		$themes = array( 'twentynineteen', 'twentyseventeen', 'twentysixteen' );
		if ( plutus_is_active_theme( $themes ) ) {
			switch ( get_template() ) {
				case 'twentysixteen':
					wp_enqueue_style( 'plutus-recipe-twentysixteen', PLUTUS_RECIPE_URL . 'css/twentysixteen.css', '', PLUTUS_RECIPE_VERSION );
					break;
				case 'twentyseventeen':
					wp_enqueue_style( 'plutus-recipe-twentyseventeen', PLUTUS_RECIPE_URL . 'css/twentyseventeen.css', '', PLUTUS_RECIPE_VERSION );
					break;
			}
		}

		wp_enqueue_script( 'jquery-zoom', PLUTUS_RECIPE_URL . 'js/jquery.zoom.min.js', array( 'jquery' ), '1.7.21', true );
		wp_enqueue_script( 'magnific-popup', PLUTUS_RECIPE_URL . 'js/jquery.magnific-popup.min.js', array( 'jquery' ), '1.1.0', true );
		wp_enqueue_script( 'owlcarousel', PLUTUS_RECIPE_URL . 'js/owl.carousel.min.js', array( 'jquery' ), '1.1.0', true );

		$deps = array( 'jquery', 'jquery-zoom', 'magnific-popup', 'owlcarousel' );

		if ( ! get_theme_mod( 'plutus_recipe_hide_rating' ) ) {
			wp_enqueue_script( 'jquery-rateyo', PLUTUS_RECIPE_URL . 'js/jquery.rateyo.min.js', array( 'jquery' ), '2.3.2', true );
			$deps[] = 'jquery-rateyo';
		}

		wp_enqueue_script( 'plutus-recipe-pro', PLUTUS_RECIPE_URL . 'js/script.js', array( 'jquery', 'jquery-zoom', 'magnific-popup', 'owlcarousel' ), PLUTUS_RECIPE_VERSION, true );

		if ( ! get_theme_mod( 'plutus_recipe_hide_rating' ) ) {
			$normal_fill = get_theme_mod( 'plutus_recipe_ratingNormal_color' );
			$rated_fill  = get_theme_mod( 'plutus_recipe_ratingRated_color' );

			$localize_script = array(
				'ajaxUrl'    => admin_url( 'admin-ajax.php' ),
				'nonce'      => wp_create_nonce( 'ajax-nonce' ),
				'normalFill' => $normal_fill ? $normal_fill : '#b9b9b9',
				'ratedFill'  => $rated_fill ? $rated_fill : '#FFCA00'
			);
			wp_localize_script( 'plutus-recipe-pro', 'PlutusObj', $localize_script );
		}
	}
}
