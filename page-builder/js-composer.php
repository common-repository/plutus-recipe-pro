<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! defined( 'WPB_VC_VERSION' ) ) {
	return;
}

add_action( 'vc_before_init', 'plutus_recipe_vc_before_init' );
if ( ! function_exists( 'plutus_recipe_vc_before_init' ) ) :
	function plutus_recipe_vc_before_init() {

		// Shortcode recipe
		vc_map( array(
			'name'        => esc_html__( 'Plutus Recipe', 'plutus-recipe-pro' ),
			'description' => '',
			'base'        => 'plutus_recipe',
			'class'       => '',
			'category'    => 'Plutus Recipe Pro',
			'controls'    => 'full',
			'weight'      => '800',
			'icon'          => PLUTUS_RECIPE_URL . "images/plutus.png",
			'params'      => array(
				array(
					'type'        => 'textfield',
					'heading'     => esc_html__( 'Post ID', 'plutus-recipe-pro' ),
					'param_name'  => 'post_id',
					'description' => esc_html__( 'Leave blank to use the ID of the current post', 'plutus-recipe-pro' ),
				)
			),
		) );

		vc_map( array(
			'name'        => esc_html__( 'Plutus Recipe Index', 'plutus-recipe-pro' ),
			'description' => '',
			'base'        => 'plutus_recipe_index',
			'class'       => '',
			'category'    => 'Plutus Recipe Pro',
			'controls'    => 'full',
			'weight'      => '800',
			'icon'          => PLUTUS_RECIPE_URL . "images/plutus.png",
			'params'      => array(
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Choose Skin', 'plutus-recipe-pro' ),
					'param_name' => 'style',
					'std'        => 's1',
					'value'      => array(
						__( 'Style 1', 'plutus-recipe-pro' ) => 's1',
						__( 'Style 2', 'plutus-recipe-pro' ) => 's2',
						__( 'Style 3', 'plutus-recipe-pro' ) => 's3',
						__( 'Style 4', 'plutus-recipe-pro' ) => 's4',
					),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Recipe Index Title', 'plutus-recipe-pro' ),
					'param_name' => 'title',
					'std'        => esc_html__( 'Recipe Index', 'plutus-recipe-pro' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Category Slug', 'plutus-recipe-pro' ),
					'param_name' => 'cat',
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Numbers Posts to Show', 'plutus-recipe-pro' ),
					'param_name' => 'ppp',
					'std'        => 6
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Choose layout', 'plutus-recipe-pro' ),
					'param_name' => 'columns',
					'std'        => '2col',
					'value'      => array(
						__( '2 Columms', 'plutus-recipe-pro' ) => '2cols',
						__( '3 Columms', 'plutus-recipe-pro' ) => '3cols',
						__( '4 Columms', 'plutus-recipe-pro' ) => '4cols',
					),
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Title of Items', 'plutus-recipe-pro' ),
					'param_name' => 'hide_ptitle',
					'value'      => array( __( 'Yes', 'plutus-recipe-pro' ) => 'yes' ),
					'std'        => ''
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Show Category of Items', 'plutus-recipe-pro' ),
					'param_name' => 'show_pcat',
					'value'      => array( __( 'Yes', 'plutus-recipe-pro' ) => 'yes' ),
					'std'      => '',
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Author of Items', 'plutus-recipe-pro' ),
					'param_name' => 'hide_pauthor',
					'value'      => array( __( 'Yes', 'plutus-recipe-pro' ) => 'yes' ),
					'std'      => '',
				),array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Date of Items', 'plutus-recipe-pro' ),
					'param_name' => 'hide_pdate',
					'value'      => array( __( 'Yes', 'plutus-recipe-pro' ) => 'yes' ),
					'std'      => '',
				),array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Turn off Uppercase for Title Items', 'plutus-recipe-pro' ),
					'param_name' => 'titleofupper',
					'value'      => array( __( 'Yes', 'plutus-recipe-pro' ) => 'yes' ),
					'std'      => '',
				),
				array(
					'type'       => 'checkbox',
					'heading'    => esc_html__( 'Hide Featured Image of Items', 'plutus-recipe-pro' ),
					'param_name' => 'hide_pimg',
					'value'      => array( __( 'Yes', 'plutus-recipe-pro' ) => 'yes' ),
					'std'      => '',
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Image Type', 'plutus-recipe-pro' ),
					'param_name' => 'image_type',
					'std'        => 'square',
					'value'      => array(
						__( 'Square', 'plutus-recipe-pro' )    => 'square',
						__( 'Landscape', 'plutus-recipe-pro' ) => 'landscape',
						__( 'Vertical', 'plutus-recipe-pro' )  => 'vertical',

					),
				),
				array(
					'type'       => 'dropdown',
					'heading'    => __( 'Choose Type Size for Featured Image', 'plutus-recipe-pro' ),
					'param_name' => 'Image Size',
					'std'        => '',
					'value'      => plutus_recipe_choices_image_sizes_vc( true ),
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Custom Link "View All" button', 'plutus-recipe-pro' ),
					'param_name' => 'view_more_link',
					'std'        => ''
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Custom "View All" button text', 'plutus-recipe-pro' ),
					'param_name' => 'view_more_text',
					'std'        => plutus_recipe_default_option( 'plutus_recipe_viewall_label' )
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Rows Gap', 'plutus-recipe-pro' ),
					'param_name' => 'row_gap'
				),
				array(
					'type'       => 'textfield',
					'heading'    => esc_html__( 'Columns Gap', 'plutus-recipe-pro' ),
					'param_name' => 'col_gap'
				),
			),
		) );
	}
endif;