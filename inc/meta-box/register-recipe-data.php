<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
/**
 * Register recipe .
 */
if ( ! class_exists( 'plutus_register_recipe_data' ) ):
	add_filter( 'plutus_meta_boxes', 'plutus_register_recipe_data' );
	function plutus_register_recipe_data( $meta_boxes ) {

		$tabs = array(
			'general'      => array(
				'label' => esc_html__( 'General', 'plutus-recipe-pro' ),
				'icon'  => 'dashicons dashicons-admin-site',
			),
			'video'        => array(
				'label' => esc_html__( 'Video', 'plutus-recipe-pro' ),
				'icon'  => 'dashicons dashicons-video-alt3',
			),
			'ingredients'  => array(
				'label' => esc_html__( 'Ingredients', 'plutus-recipe-pro' ),
				'icon'  => 'dashicons dashicons-list-view',
			),
			'instructions' => array(
				'label' => esc_html__( 'Instructions', 'plutus-recipe-pro' ),
				'icon'  => 'dashicons dashicons-format-aside',
			),
			'notes'        => array(
				'label' => esc_html__( 'Notes', 'plutus-recipe-pro' ),
				'icon'  => 'dashicons dashicons-exerpt-view',
			)
		);

		$fields = array(
			array(
				'type' => 'srart_accordion',
				'name' => esc_html__( 'Your Recipes', 'plutus-recipe-pro' ),
				'std'  => 'active',
				'tab'  => 'general',
			),
			array(
				'tab'  => 'general',
				'type' => 'custom_html',
				'std'  => '<p style="margin:-10px 0;padding: 0;">You can display your recipe for this post by using the following shortcode: <strong>[plutus_recipe]</strong>
			<br>Check options for Recipe/Recipe Index via <strong>Appearance &gt; Customize &gt;Plutus Recipe Pro Options</strong></p>',
			),
			array(
				'type' => 'end_accordion',
				'tab'  => 'general',
			),
			array(
				'id'      => 'plutus_recipe_scStyle',
				'name'    => esc_html__( 'Recipe style', 'plutus-recipe-pro' ),
				'type'    => 'select',
				'options' => array(
					'' => __( 'Default on Customizer', 'plutus-recipe-pro' ),
					's1' => __( 'Style 1', 'plutus-recipe-pro' ),
					's2' => __( 'Style 2', 'plutus-recipe-pro' ),
					's3' => __( 'Style 3', 'plutus-recipe-pro' ),
				),
				'std'     => '',
				'tab'     => 'general',
			),
			array(
				'id'   => 'plutus_recipe_title',
				'type' => 'text',
				'name' => esc_html__( 'Recipe title', 'plutus-recipe-pro' ),
				'desc' => esc_html__( 'Leave blank to use post title', 'plutus-recipe-pro' ),
				'std'  => 'Demo Recipe',
				'tab'  => 'general',
			),
			array(
				'id'   => 'plutus_recipe_img',
				'name' => esc_html__( 'Recipe Image', 'plutus-recipe-pro' ),
				'type' => 'image',
				'desc' => esc_html__( 'Leave blank to use featured image', 'plutus-recipe-pro' ),
				'std'  => '',
				'tab'  => 'general',
			),
			array(
				'id'   => 'plutus_recipe_gallery',
				'name' => esc_html__( 'Recipe Gallery', 'plutus-recipe-pro' ),
				'type' => 'images',
				'std'  => '',
				'tab'  => 'general',
			),
			array(
				'id'          => 'plutus_recipe_desc',
				'type'        => 'textarea',
				'name'        => esc_html__( 'Recipe description', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'placeholder' => esc_html__( 'You can write some description for your recipe here.', 'plutus-recipe-pro' ),
				'tab'         => 'general',
			),

			array(
				'id'      => 'plutus_recipe_rating',
				'name'    => esc_html__( 'Rating', 'plutus-recipe-pro' ),
				'type'    => 'select',
				'options' => array(
					'1' => esc_html__( '1 star', 'plutus-recipe-pro' ),
					'2' => esc_html__( '2 stars', 'plutus-recipe-pro' ),
					'3' => esc_html__( '3 stars', 'plutus-recipe-pro' ),
					'4' => esc_html__( '4 stars', 'plutus-recipe-pro' ),
					'5' => esc_html__( '5 stars', 'plutus-recipe-pro' )
				),
				'std'     => '5',
				'tab'     => 'general',
				'style'   => 'plutus-col-6',
			),
			array(
				'id'      => 'plutus_recipe_rating_people',
				'type'    => 'hidden',
				'tab'     => 'general',
			),
			array(
				'id'      => 'plutus_recipe_rating_total',
				'type'    => 'hidden',
				'tab'     => 'general',
			),
			array(
				'id'          => 'plutus_recipe_servings',
				'type'        => 'text',
				'name'        => esc_html__( 'Servings for:', 'plutus-recipe-pro' ),
				'std'         => '',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'style'       => 'plutus-col-6',
				'placeholder' => '6',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_cooktime',
				'type'        => 'text',
				'name'        => esc_html__( 'Cooke Time:', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'style'       => 'plutus-col-6',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'placeholder' => '30 Minutes',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_cooktimefm',
				'type'        => 'text',
				'name'        => esc_html__( 'Cooke Time Structured Data Format:', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'style'       => 'plutus-col-6',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'placeholder' => '1H30M',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_preptime',
				'type'        => 'text',
				'name'        => esc_html__( 'Prep Time:', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'style'       => 'plutus-col-6',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'placeholder' => '1 Hour',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_preptimefm',
				'type'        => 'text',
				'name'        => esc_html__( 'Prep Time Structured Data Format:', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'style'       => 'plutus-col-6',
				'placeholder' => '1H30M',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_calo',
				'type'        => 'text',
				'name'        => esc_html__( 'Number calories for this recipe', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'style'       => 'plutus-col-6',
				'placeholder' => '300',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_fat',
				'type'        => 'text',
				'name'        => esc_html__( 'Number fat for this recipe', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'style'       => 'plutus-col-6',
				'placeholder' => '15 grams',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_cuisine',
				'type'        => 'text',
				'name'        => esc_html__( 'Recipe Cuisine:', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'style'       => 'plutus-col-6',
				'placeholder' => 'French or Ethiopian',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_readyin',
				'type'        => 'text',
				'name'        => esc_html__( 'Ready In:', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'attrs'       => array(
					'style' => 'width:200px;'
				),
				'style'       => 'plutus-col-6',
				'placeholder' => '3m',
				'tab'         => 'general',
			),
			array(
				'id'          => 'plutus_recipe_keyw',
				'type'        => 'text',
				'name'        => esc_html__( 'Recipe Keywords:', 'plutus-recipe-pro' ),
				'desc'        => '',
				'std'         => '',
				'placeholder' => 'cake for a party, coffee',
				'tab'         => 'general',
			),

			// Tab video
			array(
				'id'   => 'plutus_recipe_videoid',
				'type' => 'text',
				'name' => esc_html__( 'Recipe title', 'plutus-recipe-pro' ),
				'desc' => 'Fill the Youtube video ID for your recipe here. Example: If the video has URL like this: <br><strong>https://www.youtube.com/watch?v=<span style="color: #6759d2;">YQHsXMglC9A<span></span></span></strong> - the video ID will be is <strong>YQHsXMglC9A</strong>',
				'std'  => '',
				'tab'  => 'video',
			),
			array(
				'id'   => 'plutus_recipe_videotitle',
				'type' => 'text',
				'name' => esc_html__( 'Recipe Video Title:', 'plutus-recipe-pro' ),
				'desc' => esc_html__( 'Fill the Youtube video title here', 'plutus-recipe-pro' ),
				'std'  => '',
				'tab'  => 'video',
			),
			array(
				'id'   => 'plutus_recipe_videoduration',
				'type' => 'text',
				'name' => esc_html__( 'Recipe Video Duration:', 'plutus-recipe-pro' ),
				'desc' => esc_html__( 'Fill the Youtube video duration here. Example: If the video has duration is: 30 Minutes 17 Secs, you need fill here: 30M17S', 'plutus-recipe-pro' ),
				'std'  => '',
				'tab'  => 'video',
			),
			array(
				'id'   => 'plutus_recipe_videoudate',
				'type' => 'text',
				'name' => esc_html__( 'Recipe Video Upload Date:', 'plutus-recipe-pro' ),
				'desc' => esc_html__( 'Fill the Youtube video upload date here. Example: 2018-07-31 ( format: YYYY-MM-DD )', 'plutus-recipe-pro' ),
				'std'  => '',
				'tab'  => 'video',
			),
			array(
				'id'   => 'plutus_recipe_videodesc',
				'type' => 'text',
				'name' => esc_html__( 'Recipe Video Description:', 'plutus-recipe-pro' ),
				'desc' => esc_html__( 'Fill the Youtube video description here.', 'plutus-recipe-pro' ),
				'std'  => '',
				'tab'  => 'video',
			),
			// Tab ingredients
			array(
				'id'      => 'plutus_recipe_ingredients_type',
				'name'    => esc_html__( 'Ingredients Type', 'plutus-recipe-pro' ),
				'type'    => 'select',
				'options' => array(
					''         => esc_html__( 'Default on Customize', 'plutus-recipe-pro' ),
					'textarea' => esc_html__( 'Textarea', 'plutus-recipe-pro' ),
					'wysiwyg'  => esc_html__( 'Text Editor', 'plutus-recipe-pro' ),
				),
				'std'     => '',
				'tab'     => 'ingredients',
			),
			array(
				'id'          => 'plutus_recipe_ingredients',
				'type'        => 'textarea',
				'name'        => '',
				'desc'        => '',
				'std'         => '',
				'placeholder' => esc_html__( 'Put each ingredient on its own line.', 'plutus-recipe-pro' ),
				'tab'         => 'ingredients',
				'hidden'      => array( 'plutus_recipe_ingredients_type', '==', 'wysiwyg' ),
			),
			array(
				'name'    => '',
				'id'      => 'plutus_recipe_ingredients_rtext',
				'type'    => 'wysiwyg',
				'options' => array(
					'teeny' => true,
				),
				'hidden'  => array( 'plutus_recipe_ingredients_type', '!=', 'wysiwyg' ),
				'tab'     => 'ingredients',
			),
			// Tab instructions
			array(
				'name'    => '',
				'id'      => 'plutus_recipe_instructions',
				'type'    => 'wysiwyg',
				'options' => array(
					'teeny' => true,
				),
				'tab'     => 'instructions',
			),
			// Tab notes
			array(
				'name'    => '',
				'id'      => 'plutus_recipe_notes',
				'type'    => 'wysiwyg',
				'options' => array(
					'teeny' => true,
				),
				'tab'     => 'notes',
			)
		);

		$meta_boxes[] = array(
			'id'         => 'plutus-metabox-single',
			'title'      => esc_html__( 'Plutus Recipe Options', 'plutus-recipe-pro' ),
			'post_types' => array( 'post' ),
			'context'    => 'advanced',
			'priority'   => 'default',
			'autosave'   => 'false',
			'tabs'       => apply_filters( 'plutus-recipe-pro/single-meta-box-tabs', $tabs ),
			'fields'     => apply_filters( 'plutus-recipe-pro/single-meta-box-fields', $fields ),
		);

		return $meta_boxes;
	}
endif;