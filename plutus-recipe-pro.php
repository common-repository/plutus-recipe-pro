<?php
/**
 * Plugin Name: Plutus Recipe Pro
 * Description: Everything a Food Blog needs. The plugin  is a user friendly plugin for adding recipes to any of your posts and pages. Beautiful SEO friendly recipes, print versions, rating
 * Version: 1.0
 * Plugin URI: http://plutusdesign.com/plutus-recipe-pro
 * Author: PlutusDesign
 * Author URI: http://plutusdesign.com
 * Text Domain: plutus-recipe-pro
 * Domain Path: /languages/
 * License: GPL v2 or later
 *
 * @package Plutus Recipe Pro
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

define( 'PLUTUS_RECIPE_VERSION', '1.0.0' );
define( 'PLUTUS_RECIPE_DIR', plugin_dir_path( __FILE__ ) );
define( 'PLUTUS_RECIPE_URL', plugin_dir_url( __FILE__ ) );
define( 'PLUTUS_RECIPE_PRO', 'plutus-recipe-pro' );

require plugin_dir_path( __FILE__ ) . 'inc/class-plutus-recipe-pro.php';
Class_Plutus_Recipe_Pro::instance();
