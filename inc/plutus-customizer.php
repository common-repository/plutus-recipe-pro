<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}
/**
 * Add postMessage support for site title and description for the Theme Customizer.
 *
 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
 */
if ( ! function_exists( 'plutus_recipe_customize_register' ) ):
	function plutus_recipe_customize_register( $wp_customize ) {
		$wp_customize->add_panel( 'plutus_recipe_panel', array(
			'priority'    => 10,
			'title'       => __( 'Plutus Recipe Pro Options', 'plutus-recipe-pro' ),
			'description' => '',
		) );

		// General options
		$wp_customize->add_section( 'plutus_recipe_general', array(
			'title' => __( 'General Options For Recipe Shortcode', 'plutus-recipe-pro' ),
			'panel' => 'plutus_recipe_panel'
		) );

		$wp_customize->add_setting( 'plutus_recipe_scStyle', array(
			'default'           => 's1',
			'sanitize_callback' => 'plutus_recipe_sanitize_text',

		) );
		$wp_customize->add_control( 'plutus_recipe_scStyle', array(
			'settings' => 'plutus_recipe_scStyle',
			'label'    => __( 'Recipe shortcode style', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipe_general',
			'type'     => 'select',
			'choices'  => array(
				's1' => __( 'Style 1', 'plutus-recipe-pro' ),
				's2' => __( 'Style 2', 'plutus-recipe-pro' ),
				's3' => __( 'Style 3', 'plutus-recipe-pro' ),
			),
		) );

		$wp_customize->add_setting( 'plutus_recipe_imgsize', array(
			'default'           => 'medium_large',
			'sanitize_callback' => 'plutus_recipe_sanitize_text',

		) );
		$wp_customize->add_control( 'plutus_recipe_imgsize', array(
			'settings' => 'plutus_recipe_imgsize',
			'label'    => __( 'Choose Image Size', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipe_general',
			'type'     => 'select',
			'choices'  => plutus_recipe_choices_image_sizes(),
		) );

		$general_checkboxs = array(
			'plutus_recipe_hide_fimg'    => __( 'Hide Featured Image', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_gallery' => __( 'Hide Gallery Image', 'plutus-recipe-pro' ),
			'plutus_recipe_dis_zoom'     => __( 'Disable Zoom on Image', 'plutus-recipe-pro' ),
			'plutus_recipe_dis_lightbox' => __( 'Disable Image Lightbox', 'plutus-recipe-pro' ),

			'plutus_recipe_hide_cal'     => __( 'Hide Calories', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_fat'     => __( 'Hide Fat', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_rating'  => __( 'Hide Rating', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_cat'     => __( 'Hide Category', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_keyw'    => __( 'Hide Keywords', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_cuisine' => __( 'Hide Cuisine', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_author'  => __( 'Hide Author', 'plutus-recipe-pro' ),

			'plutus_recipe_hide_print'     => __( 'Hide Print Button', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_pinterest' => __( 'Hide Pinterest Button', 'plutus-recipe-pro' ),
			'plutus_recipe_use_ricktext'   => __( 'Make Ingredients is Visual Editor on Edit Recipe Screen', 'plutus-recipe-pro' ),

			'plutus_recipe_hide_videobox' => __( 'Hide Video Box', 'plutus-recipe-pro' ),
			'plutus_recipe_hide_nots'     => __( 'Hide Notes Box', 'plutus-recipe-pro' ),

		);

		foreach ( $general_checkboxs as $general_checkbox_key => $general_checkbox_label ) {
			$wp_customize->add_setting( $general_checkbox_key, array(
				'sanitize_callback' => 'plutus_recipe_sanitize_checkbox',
			) );

			$wp_customize->add_control( $general_checkbox_key, array(
				'settings' => $general_checkbox_key,
				'label'    => $general_checkbox_label,
				'section'  => 'plutus_recipe_general',
				'type'     => 'checkbox',
			) );
		}


		// Colors
		$wp_customize->add_section( 'plutus_recipe_colors', array(
			'title' => __( 'Color Options For Recipe Shortcode', 'plutus-recipe-pro' ),
			'panel' => 'plutus_recipe_panel'
		) );

		$colors = array(
			'plutus_recipe_text_color'         => __( 'Recipe Text Color', 'plutus-recipe-pro' ),
			'plutus_recipe_border_color'       => __( 'Recipe Border Color', 'plutus-recipe-pro' ),
			'plutus_recipe_bg_color'           => __( 'Recipe Background Color', 'plutus-recipe-pro' ),
			'plutus_recipe_title_color'        => __( 'Recipe Title Color', 'plutus-recipe-pro' ),
			'plutus_recipe_meta_color'         => __( 'Recipe Meta Color', 'plutus-recipe-pro' ),
			'plutus_recipe_ratingNormal_color' => __( 'Recipe Rating Color', 'plutus-recipe-pro' ),
			'plutus_recipe_ratingRated_color'  => __( 'Recipe Rating Rated Color', 'plutus-recipe-pro' ),

			'plutus_recipe_btnText_color'  => __( 'Recipe Button Text & Border Color', 'plutus-recipe-pro' ),
			'plutus_recipe_btnTextH_color' => __( 'Recipe Button Text Hover Color', 'plutus-recipe-pro' ),
			'plutus_recipe_btnBgH_color'   => __( 'Recipe Button Background & Border Color', 'plutus-recipe-pro' ),

			'plutus_recipe_sectionTitle_color' => __( 'Recipe Section Title Color', 'plutus-recipe-pro' ),
			'plutus_recipe_notesTitle_color'   => __( 'Recipe Notes Title Color', 'plutus-recipe-pro' ),
			'plutus_recipe_notesText_color'    => __( 'Recipe Notes Text Color', 'plutus-recipe-pro' ),
		);

		foreach ( $colors as $color_key => $color_label ) {
			$wp_customize->add_setting( $color_key, array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color_key, array(
				'label'    => $color_label,
				'section'  => 'plutus_recipe_colors',
				'settings' => $color_key,
			) ) );
		}

		// Recipe index shortcode
		// General options
		$wp_customize->add_section( 'plutus_recipeI_general', array(
			'title' => __( 'General Options For Recipe Index Shortcode', 'plutus-recipe-pro' ),
			'panel' => 'plutus_recipe_panel'
		) );

		$wp_customize->add_setting( 'plutus_recipeI_style', array(
			'default'           => 's1',
			'sanitize_callback' => 'plutus_recipe_sanitize_text',

		) );
		$wp_customize->add_control( 'plutus_recipeI_style', array(
			'settings' => 'plutus_recipeI_style',
			'label'    => __( 'Choose style', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipeI_general',
			'type'     => 'select',
			'choices'  => array(
				's1' => __( 'Style 1', 'plutus-recipe-pro' ),
				's2' => __( 'Style 2', 'plutus-recipe-pro' ),
				's3' => __( 'Style 3', 'plutus-recipe-pro' ),
				's4' => __( 'Style 4', 'plutus-recipe-pro' ),
			),
		) );
		$wp_customize->add_setting( 'plutus_recipeI_titleAlign', array(
			'default'           => 'left',
			'sanitize_callback' => 'plutus_recipe_sanitize_text',

		) );
		$wp_customize->add_control( 'plutus_recipeI_titleAlign', array(
			'settings' => 'plutus_recipeI_titleAlign',
			'label'    => __( 'Choose Image Type', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipeI_general',
			'type'     => 'select',
			'choices'  => array(
				'left'   => __( 'Left', 'plutus-recipe-pro' ),
				'center' => __( 'Center', 'plutus-recipe-pro' ),
				'right'  => __( 'Right', 'plutus-recipe-pro' ),
			),
		) );
		$wp_customize->add_setting( 'plutus_recipeI_imgtype', array(
			'default'           => 'square',
			'sanitize_callback' => 'plutus_recipe_sanitize_text',

		) );
		$wp_customize->add_control( 'plutus_recipeI_imgtype', array(
			'settings' => 'plutus_recipeI_imgtype',
			'label'    => __( 'Choose Image Type', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipeI_general',
			'type'     => 'select',
			'choices'  => array(
				'square'    => __( 'Square', 'plutus-recipe-pro' ),
				'landscape' => __( 'Landscape', 'plutus-recipe-pro' ),
				'vertical'  => __( 'Vertical', 'plutus-recipe-pro' ),
			),
		) );
		$wp_customize->add_setting( 'plutus_recipeI_imgsize', array(
			'default'           => 'medium_large',
			'sanitize_callback' => 'plutus_recipe_sanitize_text',

		) );
		$wp_customize->add_control( 'plutus_recipeI_imgsize', array(
			'settings' => 'plutus_recipeI_imgsize',
			'label'    => __( 'Choose Image Size', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipeI_general',
			'type'     => 'select',
			'choices'  => plutus_recipe_choices_image_sizes(),
		) );

		$RecipeI_checkboxs = array(
			'plutusRecipeI_show_pcat'    => __( 'Show Category', 'plutus-recipe-pro' ),
			'plutusRecipeI_hide_pauthor' => __( 'Hide Author', 'plutus-recipe-pro' ),
			'plutusRecipeI_hide_pdate'   => __( 'Hide Date', 'plutus-recipe-pro' ),
			'plutusRecipeI_hide_img'     => __( 'Hide Image', 'plutus-recipe-pro' ),
			'plutusRecipeI_titleUpper'   => __( 'Turn off Uppercase for Title Items', 'plutus-recipe-pro' ),
		);

		foreach ( $RecipeI_checkboxs as $general_checkbox_key => $general_checkbox_label ) {
			$wp_customize->add_setting( $general_checkbox_key, array(
				'sanitize_callback' => 'plutus_recipe_sanitize_checkbox',
			) );

			$wp_customize->add_control( $general_checkbox_key, array(
				'settings' => $general_checkbox_key,
				'label'    => $general_checkbox_label,
				'section'  => 'plutus_recipeI_general',
				'type'     => 'checkbox',
			) );
		}

		$wp_customize->add_setting( 'plutus_recipeI_vMorePos', array(
			'default'           => 'bottom',
			'sanitize_callback' => 'plutus_recipe_sanitize_text',

		) );
		$wp_customize->add_control( 'plutus_recipeI_vMorePos', array(
			'settings' => 'plutus_recipeI_vMorePos',
			'label'    => __( 'Position for "View All" button', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipeI_general',
			'type'     => 'select',
			'choices'  => array(
				'top'    => __( 'Top', 'plutus-recipe-pro' ),
				'bottom' => __( 'Bottom', 'plutus-recipe-pro' ),
			),
		) );

		$wp_customize->add_setting( 'plutus_recipeI_rowGap', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'plutus_recipeI_rowGap', array(
			'label'    => esc_html__( 'Row Gap', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipeI_general',
			'settings' => 'plutus_recipeI_rowGap',
		) );

		$wp_customize->add_setting( 'plutus_recipeI_ColGap', array(
			'default' => '',
		) );

		$wp_customize->add_control( 'plutus_recipeI_ColGap', array(
			'label'    => esc_html__( 'Column Gap', 'plutus-recipe-pro' ),
			'section'  => 'plutus_recipeI_general',
			'settings' => 'plutus_recipeI_ColGap',
		) );

		// Colors
		$wp_customize->add_section( 'plutus_recipeI_colors', array(
			'title' => __( 'Color Options For Recipe Index Shortcode', 'plutus-recipe-pro' ),
			'panel' => 'plutus_recipe_panel'
		) );

		$colors = array(
			'plutus_recipeI_heading_color'  => __( 'Heading title Color', 'plutus-recipe-pro' ),
			'plutus_recipeI_cat_color'      => __( 'Categories Color', 'plutus-recipe-pro' ),
			'plutus_recipeI_author_color'   => __( 'Author & Date Color', 'plutus-recipe-pro' ),
			'plutus_recipeI_Info_bgcolor'   => __( 'Item Infor Background for Style 2, 4', 'plutus-recipe-pro' ),
			'plutus_recipeI_vMore_color'    => __( '"View More" Button Text Color', 'plutus-recipe-pro' ),
			'plutus_recipeI_vMore_bgcolor'  => __( '"View More" Button Background Color', 'plutus-recipe-pro' ),
			'plutus_recipeI_vMore_hcolor'   => __( '"View More" Button Hover Text Color', 'plutus-recipe-pro' ),
			'plutus_recipeI_vMore_hbgcolor' => __( '"View More" Button Hover Background Color', 'plutus-recipe-pro' ),
		);

		foreach ( $colors as $color_key => $color_label ) {
			$wp_customize->add_setting( $color_key, array(
				'sanitize_callback' => 'sanitize_hex_color',
			) );

			$wp_customize->add_control( new WP_Customize_Color_Control( $wp_customize, $color_key, array(
				'label'    => $color_label,
				'section'  => 'plutus_recipeI_colors',
				'settings' => $color_key,
			) ) );
		}

		// Tranlation
		$wp_customize->add_section( 'plutus_recipe_trans', array(
			'title' => __( 'Quick Text Translation', 'plutus-recipe-pro' ),
			'panel' => 'plutus_recipe_panel'
		) );


		$trans_arr = array(
			'plutus_recipe_instructions_label' => esc_html__( 'Instructions', 'plutus-recipe-pro' ),
			'plutus_recipe_ingredient_label'   => esc_html__( 'Ingredients', 'plutus-recipe-pro' ),
			'plutus_recipe_gallery_label'      => esc_html__( 'Gallery', 'plutus-recipe-pro' ),
			'plutus_recipe_video_label'        => esc_html__( 'Video', 'plutus-recipe-pro' ),
			'plutus_recipe_notes_label'        => esc_html__( 'Notes', 'plutus-recipe-pro' ),

			'plutus_recipe_servings_label'   => esc_html__( 'Serves:', 'plutus-recipe-pro' ),
			'plutus_recipe_preptime_label'   => esc_html__( 'Prep Time:', 'plutus-recipe-pro' ),
			'plutus_recipe_nutrition_label'  => esc_html__( 'Nutrition facts:', 'plutus-recipe-pro' ),
			'plutus_recipe_cooktime_label'   => esc_html__( 'Cooking Time:', 'plutus-recipe-pro' ),
			'plutus_recipe_customer_reviews' => esc_html__( 'customer reviews', 'plutus-recipe-pro' ),
			'plutus_recipe_rating_label'     => esc_html__( 'Rating:', 'plutus-recipe-pro' ),
			'plutus_recipe_author_label'     => esc_html__( 'Author:', 'plutus-recipe-pro' ),
			'plutus_recipe_keywords_label'   => esc_html__( 'Keywords:', 'plutus-recipe-pro' ),
			'plutus_recipe_category_label'   => esc_html__( 'Category:', 'plutus-recipe-pro' ),
			'plutus_recipe_cuisine_label'    => esc_html__( 'Cuisine:', 'plutus-recipe-pro' ),
			'plutus_recipe_btnPrint_label'   => esc_html__( 'Print This', 'plutus-recipe-pro' ),
			'plutus_recipe_calodf_label'     => esc_html__( 'calories', 'plutus-recipe-pro' ),
			'plutus_recipe_fatdf_label'      => esc_html__( 'fat', 'plutus-recipe-pro' ),
			'plutus_recipe_viewall_label'    => esc_html__( 'View All', 'plutus-recipe-pro' ),

		);

		foreach ( $trans_arr as $trans_key => $trans_text ) {
			$wp_customize->add_setting( $trans_key, array(
				'default'           => $trans_text,
				'sanitize_callback' => 'plutus_recipe_sanitize_text',
			) );

			$wp_customize->add_control( $trans_key, array(
				'label'    => esc_html__( 'Text:', 'plutus-recipe-pro' ) . ' "' . $trans_text . '"',
				'section'  => 'plutus_recipe_trans',
				'settings' => $trans_key,
			) );
		}
	}
endif;
add_action( 'customize_register', 'plutus_recipe_customize_register' );

/**
 * Sanitize the checkbox.
 *
 */
if ( ! function_exists( 'plutus_recipe_sanitize_checkbox' ) ):
	function plutus_recipe_sanitize_checkbox( $checked ) {
		return isset( $checked ) && true == $checked ? true : false;
	}
endif;

/**
 * Sanitize the text.
 *
 */
if ( ! function_exists( 'plutus_recipe_sanitize_text' ) ) {
	function plutus_recipe_sanitize_text( $text ) {
		return $text;
	}
}

