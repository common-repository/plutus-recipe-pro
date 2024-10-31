<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

add_action( 'init', 'plutus_recipe_gutenberg_recipe' );
if ( ! function_exists( 'plutus_recipe_gutenberg_recipe' ) ):
	function plutus_recipe_gutenberg_recipe() {

		if ( ! function_exists( 'register_block_type' ) ) {
			// Gutenberg is not active.
			return;
		}
		wp_register_script(
			'plutus-recipegtb-block',
			PLUTUS_RECIPE_URL . 'js/block.js',
			array( 'wp-blocks', 'wp-element', 'wp-components', 'wp-editor' ),
			PLUTUS_RECIPE_VERSION
		);

		wp_register_style(
			'plutus-recipegtb-editor',
			PLUTUS_RECIPE_URL . 'css/block-editor.css',
			array( 'wp-edit-blocks' ),
			PLUTUS_RECIPE_VERSION
		);

		$post_id = isset( $_GET['post'] ) ? intval( $_GET['post'] ) : '';

		register_block_type( 'plutus-recipegtb/plutus-recipe', array(
			'editor_style'    => 'plutus-recipegtb-editor',
			'editor_script'   => 'plutus-recipegtb-block',
			'render_callback' => 'plutus_recipegtb_recipe_render_callback',
			'attributes'      => array(
				'postID' => array(
					'type'    => 'string',
					'default' => $post_id,
				)
			),
		) );

		register_block_type( 'plutus-recipegtb/plutus-recipe-index', array(
			'editor_style'    => 'plutus-recipegtb-editor',
			'editor_script'   => 'plutus-recipegtb-block',
			'render_callback' => 'plutus_recipegtb_recipe_index_render_callback',
			'attributes'      => array(
				'style'        => array(
					'type'    => 'string',
					'default' => 's1',
				),
				'title'        => array(
					'type'    => 'string',
					'default' => esc_html__( 'Recipe Index Title', 'plutus-recipe-pro' ),
				),
				'cat'          => array(
					'type'    => 'string',
					'default' => '',
				),
				'ppp'          => array(
					'type'    => 'number',
					'default' => '6',
				),
				'columns'      => array(
					'type'    => 'string',
					'default' => '2col',
				),
				'show_pcat'    => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'hide_pauthor' => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'hide_pdate'   => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'hide_pimg'    => array(
					'type'    => 'boolean',
					'default' => false,
				),
				'image_type'   => array(
					'type'    => 'string',
					'default' => 'square',
				),
				'view_more_link' => array(
					'type'    => 'string',
					'default' => '',
				),
				'view_more_text' => array(
					'type'    => 'string',
					'default' => ''
				),
				'row_gap' => array(
					'type'    => 'string',
					'default' => ''
				),
				'col_gap' => array(
					'type'    => 'string',
					'default' => ''
				),
			),
		) );
	}
endif;

if ( ! function_exists( 'plutus_recipegtb_recipe_render_callback' ) ):
	function plutus_recipegtb_recipe_render_callback( $attributes, $content ) {
		$post_ID = ( isset( $attributes['postID'] ) && $attributes['postID'] ) ? $attributes['postID'] : get_the_ID();

		return Class_Plutus_Recipe_Pro_Shortcode::plutus_recipe_func( array( 'post_id' => $post_ID ) );
	}
endif;

if ( ! function_exists( 'plutus_recipegtb_recipe_index_render_callback' ) ):
	function plutus_recipegtb_recipe_index_render_callback( $attributes, $content ) {
		if ( $attributes ) {
			$param = '';
			foreach ( (array) $attributes as $k => $v ) {
				if ( in_array( $k, array( 'show_pcat', 'hide_pauthor', 'hide_pdate', 'hide_pimg', 'hide_viewMore' ) ) ) {
					$param .= ' ' . $k . '="' . ( $v ? 'yes' : 'no' ) . '"';
				} elseif ( $v ) {
					$param .= ' ' . $k . '="' . $v . '"';
				}
			}
		}

		return do_shortcode( '[plutus_recipe_index' . $param . ']' );
	}
endif;