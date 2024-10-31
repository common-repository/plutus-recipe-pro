<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Before Recipe Entry Summary Div.
 *
 * @see plutus_recipe_show_images()
 */
add_action( 'plutus_recipe_shortcode/before_summary', 'plutus_recipe_show_images', 20 );


/**
 * Recipe Summary Box.
 *
 * @see plutus_recipe_shortcode_title()
 * @see plutus_recipe_shortcode_excerpt()
 * @see plutus_recipe_shortcode_meta()
 * @see plutus_recipe_shortcode_sharing()
 */
add_action( 'plutus_recipe_shortcode/entry_summary', 'plutus_recipe_shortcode_title', 5 );
add_action( 'plutus_recipe_shortcode/entry_summary', 'plutus_recipe_shortcode_excerpt', 10 );
add_action( 'plutus_recipe_shortcode/entry_summary', 'plutus_recipe_shortcode_meta', 15 );
add_action( 'plutus_recipe_shortcode/entry_summary', 'plutus_recipe_shortcode_sharing', 20 );

/**
 * Recipe Content.
 *
 * @see plutus_recipe_shortcode_ingredients()
 * @see plutus_recipe_shortcode_instructions()
 * @see plutus_recipe_shortcode_video()
 * @see plutus_recipe_shortcode_notes()
 * @see plutus_recipe_shortcode_gallery_section()
 */
add_action( 'plutus_recipe_shortcode/entry_content', 'plutus_recipe_shortcode_ingredients', 5 );
add_action( 'plutus_recipe_shortcode/entry_content', 'plutus_recipe_shortcode_instructions', 10 );
add_action( 'plutus_recipe_shortcode/entry_content', 'plutus_recipe_shortcode_video', 15 );
add_action( 'plutus_recipe_shortcode/entry_content', 'plutus_recipe_shortcode_notes', 20 );


