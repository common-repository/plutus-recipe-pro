<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! function_exists( 'plutus_recipe_default_option' ) ):
	function plutus_recipe_default_option( $key ) {
		$defaults = array(

			'plutus_recipe_instructions_label' => esc_html__( 'Instructions', 'plutus-recipe-pro' ),
			'plutus_recipe_ingredient_label'   => esc_html__( 'Ingredients', 'plutus-recipe-pro' ),
			'plutus_recipe_notes_label'        => esc_html__( 'Notes', 'plutus-recipe-pro' ),
			'plutus_recipe_gallery_label'      => esc_html__( 'Gallery', 'plutus-recipe-pro' ),
			'plutus_recipe_servings_label'     => esc_html__( 'Serves:', 'plutus-recipe-pro' ),
			'plutus_recipe_preptime_label'     => esc_html__( 'Prep Time:', 'plutus-recipe-pro' ),
			'plutus_recipe_nutrition_label'    => esc_html__( 'Nutrition facts:', 'plutus-recipe-pro' ),
			'plutus_recipe_cooktime_label'     => esc_html__( 'Cooking Time:', 'plutus-recipe-pro' ),
			'plutus_recipe_customer_reviews'   => esc_html__( 'voted', 'plutus-recipe-pro' ),
			'plutus_recipe_rating_label'       => esc_html__( 'Rating:', 'plutus-recipe-pro' ),
			'plutus_recipe_author_label'       => esc_html__( 'Author:', 'plutus-recipe-pro' ),
			'plutus_recipe_keywords_label'     => esc_html__( 'Keywords:', 'plutus-recipe-pro' ),
			'plutus_recipe_category_label'     => esc_html__( 'Category:', 'plutus-recipe-pro' ),
			'plutus_recipe_cuisine_label'      => esc_html__( 'Cuisine:', 'plutus-recipe-pro' ),
			'plutus_recipe_btnPrint_label'     => esc_html__( 'Print This', 'plutus-recipe-pro' ),
			'plutus_recipe_calodf_label'       => esc_html__( 'calories', 'plutus-recipe-pro' ),
			'plutus_recipe_fatdf_label'        => esc_html__( 'fat', 'plutus-recipe-pro' ),
			'plutus_recipe_video_label'        => esc_html__( 'Video', 'plutus-recipe-pro' ),
			'plutus_recipe_viewall_label'        => esc_html__( 'View All', 'plutus-recipe-pro' ),

			'plutus_recipe_calodf'       => '200',
			'plutus_recipe_fatdf'         => '10',

			'plutus_recipeI_style'    => 's1',
			'plutus_recipeI_imgsize'  => 'medium_large',
			'plutus_recipeI_imgtype'  => 'square',
			'plutus_recipeI_vMorePos' => 'bottom',
			'plutus_recipeI_titleAlign' => 'left',

			// Video

			'plutus_recipe_videoid'       => '',
			'plutus_recipe_videotitle'    => '',
			'plutus_recipe_videoduration' => '',
			'plutus_recipe_videoudate'    => '',
			'plutus_recipe_videodesc'     => '',
		);

		return isset( $defaults[ $key ] ) ? $defaults[ $key ] : '';
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_option' ) ):
	function plutus_recipe_get_option( $key ) {
		if ( ! $key ) {
			return '';
		}

		return get_theme_mod( $key, plutus_recipe_default_option( $key ) );
	}
endif;