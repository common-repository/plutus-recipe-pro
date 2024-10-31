<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Check if Elementor installed and activated
if ( ! did_action( 'elementor/loaded' ) ) {
	return;
}

// Add Plugin actions
add_action( 'elementor/widgets/widgets_registered', 'plutus_recipe_el_init_widgets' );
add_action( 'elementor/controls/controls_registered', 'plutus_recipe_el_init_widgets' );

/**
 * Init Widgets
 *
 * Include widgets files and register them
 *
 * @since 1.0.0
 *
 * @access public
 */
if( ! function_exists( 'plutus_recipe_el_init_widgets' ) ):
function plutus_recipe_el_init_widgets() {

	// Include Widget files
	require_once PLUTUS_RECIPE_DIR . 'page-builder/elementor-recipe.php';

	// Register widget
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Plutus_El_Recipe_Widget() );
	\Elementor\Plugin::instance()->widgets_manager->register_widget_type( new \Plutus_El_Recipe_Index_Widget() );

}
endif;