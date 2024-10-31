<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'plutus_recipe_show_images' ) ):
	/**
	 * Output the recipe image before the recipe entry summary.
	 */
	function plutus_recipe_show_images() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-image.php' );
	}
endif;

if ( ! function_exists( 'plutus_recipe_shortcode_title' ) ) {

	/**
	 * Output the recipe shortcode title.
	 */
	function plutus_recipe_shortcode_title() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-title.php' );
	}
}
if ( ! function_exists( 'plutus_recipe_shortcode_excerpt' ) ) {

	/**
	 * Output the recipe shortcode excerpt.
	 */
	function plutus_recipe_shortcode_excerpt() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-excerpt.php' );
	}
}
if ( ! function_exists( 'plutus_recipe_shortcode_meta' ) ) {

	/**
	 * Output the recipe shortcode meta.
	 */
	function plutus_recipe_shortcode_meta() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-meta.php' );
	}
}

if ( ! function_exists( 'plutus_recipe_shortcode_sharing' ) ) {

	/**
	 * Output the recipe shortcode sharing.
	 */
	function plutus_recipe_shortcode_sharing() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-sharing.php' );
	}
}

if ( ! function_exists( 'plutus_recipe_shortcode_ingredients' ) ) {

	/**
	 * Output the recipe shortcode ingredients.
	 */
	function plutus_recipe_shortcode_ingredients() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-ingredients.php' );
	}
}

if ( ! function_exists( 'plutus_recipe_shortcode_instructions' ) ) {

	/**
	 * Output the recipe shortcode instructions.
	 */
	function plutus_recipe_shortcode_instructions() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-instructions.php' );
	}
}

if ( ! function_exists( 'plutus_recipe_shortcode_video' ) ) {

	/**
	 * Output the recipe shortcode video.
	 */
	function plutus_recipe_shortcode_video() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-video.php' );
	}
}

if ( ! function_exists( 'plutus_recipe_shortcode_notes' ) ) {

	/**
	 * Output the recipe shortcode notes.
	 */
	function plutus_recipe_shortcode_notes() {
		plutus_recipe_get_template( 'recipe-shortcode/recipe-notes.php' );
	}
}

if( ! function_exists( 'plutus_recipe_shortcode_gallery_section' ) ):
	function plutus_recipe_shortcode_gallery_section(){
		plutus_recipe_get_template( 'recipe-shortcode/recipe-gallery.php' );
	}
endif;

/**
 * Get HTML for a gallery image.
 *
 * @return string
 */
function plutus_recipe_get_gallery_image_html( $attachment_id, $class = '', $dis_zoom, $dis_lightbox, $image_size = '' ) {

	if( empty( $image_size ) ) {
		$image_size = 'medium_large';
	}
	$image_size = apply_filters( 'plutus_recipe_shortcode/image_size', $image_size );
	$image_info = wp_get_attachment_image_src( $attachment_id, $image_size );

	if ( $image_info ) {
		list( $src, $width, $height ) = $image_info;
		$image_alt = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

		if ( $src ) {
			$image = '<img itemprop="image" src="' . esc_url( $src ) . '" alt="' . esc_attr( $image_alt ? $image_alt : esc_html__( 'Recipe image', 'plutus-recipe-pro' ) ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '"/>';

			$output = '<div data-thumb="' . esc_url( $src ) . '" class="plutus-recipe-image' . ( $class ? ' ' . $class : '' ) . '">';

			if( ! $dis_lightbox ) {
				$output .= '<a class="' . ( ! $dis_zoom ? 'plutus-zoomImg' : '' ) . '" href="' . esc_url( $src ) . '">';
				$output .= $image;
				$output .= '<span class="plutus-zoomImg-icon"></span>';
				$output .= '</a>';
			}else{
				$output .= '<div class="' . ( ! $dis_zoom ? 'plutus-zoomImg' : '' ) . '">';
				$output .= $image;
				$output .= '</div>';
			}


			$output .= '</div>';

			return $output;
		}
	}

	return '';
}


if ( ! function_exists( 'plutus_recipe_get_recipe_servings' ) ):
	function plutus_recipe_get_recipe_servings( $recipe_servings ) {

		$output = '<div class="plutus-recipe-meta-item serves">';
		$output .= '<span class="plutus-recipe-meta-label">' . plutus_recipe_get_option( 'plutus_recipe_servings_label' ) . '</span>';
		$output .= '<span class="servings" itemprop="recipeYield">' . esc_attr( $recipe_servings ) . '</span>';

		$output .= '</div>';

		return $output;
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_preptime' ) ):
	function plutus_recipe_get_recipe_preptime( $preptime, $preptimefm ) {

		$output = '<span class="plutus-recipe-meta-item preptTime">';
		$output .= '<span class="plutus-recipe-meta-label">' . plutus_recipe_get_option( 'plutus_recipe_preptime_label' ) . '</span>';
		$output .= '<time class="preptime" datetime="PT' . esc_attr( $preptimefm ) . '" itemprop="prepTime">' . esc_attr( $preptime ) . '</time>';
		$output .= '</span>';

		return $output;
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_cooktime' ) ):
	function plutus_recipe_get_recipe_cooktime( $cooktime, $cooktimefm ) {

		$output = '<div class="plutus-recipe-meta-item cooktime">';
		$output .= '<span class="plutus-recipe-meta-label">' . plutus_recipe_get_option( 'plutus_recipe_cooktime_label' ) . '</span>';
		$output .= '<time datetime="PT' . esc_attr( $cooktimefm ) . '" itemprop="totalTime">' . esc_attr( $cooktime ) . '</span>';
		$output .= '<time class="plutus-recipe-inputhide" datetime="PT' . esc_attr( $cooktimefm ) . '" itemprop="cookTime">' . esc_attr( $cooktime ) . '</time>';
		$output .= '</div>';

		return $output;
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_calo_fat' ) ):
	function plutus_recipe_get_recipe_calo_fat( $calo, $fat ) {

		$hide_cal = plutus_recipe_get_option( 'plutus_recipe_hide_cal' );
		$hide_fat = plutus_recipe_get_option( 'plutus_recipe_hide_fat' );

		$nutrition_label = plutus_recipe_get_option( 'plutus_recipe_nutrition_label' );
		$calo_df         = plutus_recipe_get_option( 'plutus_recipe_calodf' );
		$calo_df_label   = plutus_recipe_get_option( 'plutus_recipe_calodf_label' );
		$fat_df          = plutus_recipe_get_option( 'plutus_recipe_fatdf' );
		$fat_df_label    = plutus_recipe_get_option( 'plutus_recipe_fatdf_label' );

		$output = '<div itemprop="nutrition" itemscope itemtype="http://schema.org/NutritionInformation" class="plutus-recipe-nutrition' . ( $hide_cal && $hide_fat ? ' plutus-recipe-inputhide' : '' ) . '">';
		$output .= '<span class="plutus-recipe-meta-label">' . $nutrition_label . '</span>';
		$output .= '<span itemprop="calories" class="nutrition-item' . ( $hide_cal ? ' plutus-recipe-inputhide' : '' ) . '">' . ( $calo ? $calo : $calo_df ) . ' ' . $calo_df_label . '</span>';
		$output .= '<span itemprop="fatContent" class="nutrition-item' . ( $hide_fat ? ' plutus-recipe-inputhide' : '' ) . '">' . ( $fat ? $fat : $fat_df ) . ' ' . $fat_df_label . '</span>';

		$output .= '</div>';


		return $output;
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_rating' ) ):
	function plutus_recipe_get_recipe_rating( $recipe_data ) {
		$hide_rating      = plutus_recipe_get_option( 'plutus_recipe_hide_rating' );
		$rating_label     = plutus_recipe_get_option( 'plutus_recipe_rating_label' );
		$customer_reviews = plutus_recipe_get_option( 'plutus_recipe_customer_reviews' );

		$post_id       = $recipe_data['post_id'];
		$rating        = $recipe_data['plutus_recipe_rating'];
		$rating_people = $recipe_data['plutus_recipe_rating_people'];
		$rating_total  = $recipe_data['plutus_recipe_rating_total'];

		if ( ! $rating_total && $rating ) {
			$rating_total = $rating;
		}

		if ( $rating_total && $rating_people ) {
			$rating = number_format( intval( $rating_total ) / intval( $rating_people ), 1 );
		}

		$output = '<div itemprop="aggregateRating" itemscope itemtype="http://schema.org/AggregateRating" ' . ( $hide_rating ? ' class="plutus-recipe-inputhide"' : '' ) . '>';
		$output .= '<span class="plutus-recipe-meta-label">' . $rating_label . '</span>';
		$output .= '<span itemprop="ratingValue" class="plutus-ratingValue">' . esc_attr( $rating ) . '</span>/5';
		$output .= '<div id="plutus-action-rating" class="readOnly" data-postid="' . esc_attr( $post_id ) . '" data-rating ="' . esc_attr( $rating ) . '" data-ratingpeople="' . esc_attr( $rating_people ) . '"></div>';
		$output .= '<span>( <span itemprop="reviewCount" class="plutus-rating-people"> ' . esc_attr( $rating_people ) . '</span>' . $customer_reviews . ' )</span>';
		$output .= '</div>';

		return apply_filters( 'plutus_recipe_get_recipe_rating', $output );
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_author' ) ):
	function plutus_recipe_get_recipe_author() {
		$hide_author = plutus_recipe_get_option( 'plutus_recipe_hide_author' );

		global $post;
		$author_id = $post->post_author;

		$output = '<div class="plutus-recipe-author' . ( $hide_author ? ' plutus-recipe-inputhide' : '' ) . '">';
		$output .= '<span class="plutus-recipe-meta-label">' . plutus_recipe_get_option( 'plutus_recipe_author_label' ) . '</span>';
		$output .= '<span itemprop="author">' . get_the_author_meta( 'nickname', $author_id ) . '</span>';
		$output .= '</div>';

		return $output;
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_keywords' ) ):
	function plutus_recipe_get_recipe_keywords( $keyw ) {
		$hide_keyw = plutus_recipe_get_option( 'plutus_recipe_hide_keyw' );

		$output = '<div class="plutus-recipe-keywords' . ( $hide_keyw ? ' plutus-recipe-inputhide' : '' ) . '">';
		$output .= '<span class="plutus-recipe-meta-label">' . plutus_recipe_get_option( 'plutus_recipe_keywords_label' ) . '</span>';
		$output .= '<span itemprop="keywords">' . ( $keyw ? $keyw : plutus_recipe_get_option( 'plutus_recipe_keyw_df' ) ) . '</span>';
		$output .= '</div>';

		return $output;
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_cuisine' ) ):
	function plutus_recipe_get_recipe_cuisine( $cuisine ) {
		$hide_cuisine = plutus_recipe_get_option( 'plutus_recipe_hide_cuisine' );

		$output = '<div class="plutus-recipe-keywords' . ( $hide_cuisine ? ' plutus-recipe-inputhide' : '' ) . '">';
		$output .= '<span class="plutus-recipe-meta-label">' . plutus_recipe_get_option( 'plutus_recipe_cuisine_label' ) . '</span>';
		$output .= '<span itemprop="recipeCuisine" >' . ( $cuisine ? $cuisine : plutus_recipe_get_option( 'plutus_recipe_cuisine_df' ) ) . '</span>';
		$output .= '</div>';

		return $output;
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_recipe_category' ) ):
	function plutus_recipe_get_recipe_category( $post_id ) {
		$hide_cat = plutus_recipe_get_option( 'plutus_recipe_hide_cat' );

		$cat = 'Uncategorized';

		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', $post_id );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );

			if ( ! is_wp_error( $term ) ) {
				$cat = $term->name;
			}
		} else {
			$the_category = get_the_category( $post_id );
			if ( ! empty( $the_category ) && isset( $the_category[0]->name ) ) {
				$cat = $the_category[0]->name;
			}
		}

		$output = '<div class="plutus-recipe-category' . ( $hide_cat ? ' plutus-recipe-inputhide' : '' ) . '">';
		$output .= '<span class="plutus-recipe-meta-label">' . plutus_recipe_get_option( 'plutus_recipe_category_label' ) . '</span>';
		$output .= '<span itemprop="recipeCategory">' . $cat . '</span>';
		$output .= '</div>';

		return $output;
	}
endif;

