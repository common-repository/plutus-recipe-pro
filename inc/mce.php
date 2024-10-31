<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! function_exists( 'plutus_refresh_mce' ) ) {
	function plutus_refresh_mce( $ver ) {
		$ver += 3;

		return $ver;
	}
}
add_filter( 'tiny_mce_version', 'plutus_refresh_mce' );

add_action( 'init', 'plutus_pre_add_shortcode_buttons' );
if ( ! function_exists( 'plutus_pre_add_shortcode_buttons' ) ) {
	function plutus_pre_add_shortcode_buttons() {
		if ( ! current_user_can( 'edit_posts' ) && ! current_user_can( 'edit_pages' ) )
			return;

		if( is_admin() || ( isset( $_GET['vc_editable'] ) && 'true' == $_GET['vc_editable'] ) ){
			if ( get_user_option( 'rich_editing' ) == 'true' ) {
				add_filter( "mce_external_plugins", "plutus_pre_add_shortcodes_tinymce_plugin" );
				add_filter( 'mce_buttons', 'plutus_pre_register_shortcode_buttons' );
			}
		}
	}
}
if ( ! function_exists( 'plutus_pre_register_shortcode_buttons' ) ) {
	function plutus_pre_register_shortcode_buttons( $buttons ) {
		array_unshift( $buttons, 'plutus_shortcodes_button', 'separator' );

		return $buttons;
	}
}
if ( ! function_exists( 'plutus_pre_add_shortcodes_tinymce_plugin' ) ) {
	function plutus_pre_add_shortcodes_tinymce_plugin( $plugin_array ) {
		$plugin_array['plutus_shortcodes_button'] = PLUTUS_RECIPE_URL . 'js/mce.js';

		return $plugin_array;
	}
}

if( ! function_exists( 'plutus_add_tinymce_buttons' ) ) {
	function plutus_add_tinymce_buttons( $buttons ) {
		array_unshift( $buttons, 'styleselect' );

		return $buttons;
	}
}
add_filter( 'mce_buttons_2', 'plutus_add_tinymce_buttons' );