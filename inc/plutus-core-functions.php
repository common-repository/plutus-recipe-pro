<?php
/**
 * Get other templates and including the file.
 *
 * @param string $template_name Template name.
 */
if ( ! class_exists( 'plutus_recipe_get_template' ) ):
	function plutus_recipe_get_template( $template_name ) {
		$cache_key = sanitize_key( implode( '-', array( 'template', $template_name ) ) );

		$template = (string) wp_cache_get( $cache_key, 'plutus_recipe' );

		if ( empty( $template ) ) {
			$template = plutus_recipe_locate_template( $template_name );

			wp_cache_set( $cache_key, $template, 'plutus_recipe' );
		}

		include $template;
	}
endif;

/**
 * Locate a template and return the path for inclusion.
 *
 * This is the load order:
 *
 * yourtheme/$template_path/$template_name
 * yourtheme/$template_name
 * $default_path/$template_name
 *
 * @param string $template_name Template name.
 *
 * @return string
 */
if ( ! class_exists( 'plutus_recipe_locate_template' ) ):
	function plutus_recipe_locate_template( $template_name ) {

		$template_path = 'plutus-recipe-pro';
		$default_path  = untrailingslashit( PLUTUS_RECIPE_DIR ) . '/templates/';

		// Look within passed path within the theme - this is priority.
		$template = locate_template( array(
				trailingslashit( $template_path ) . $template_name,
				$template_name,
			)
		);

		// Get default template.
		if ( ! $template ) {
			$template = $default_path . $template_name;
		}

		return $template;
	}
endif;

/**
 * Get recipe shortcode id
 */
if ( ! function_exists( 'plutus_recipe_get_shortcode_id' ) ):
	function plutus_recipe_get_shortcode_id( $shortcode_id ) {
		if ( ! $shortcode_id ) {
			$shortcode_id = get_the_ID();
		}

		return $shortcode_id;
	}
endif;
if ( ! function_exists( 'plutus_recipe_data_parse_args' ) ):
	function plutus_recipe_data_parse_args( $data ) {
		$recipe_data_df = array(
			'post_id'                         => '',
			'plutus_recipe_scStyle'           => plutus_recipe_get_option( 'plutus_recipe_scStyle' ),
			'plutus_recipe_title'             => '',
			'plutus_recipe_img'               => '',
			'plutus_recipe_desc'              => '',
			'plutus_recipe_servings'          => '',
			'plutus_recipe_preptime'          => '',
			'plutus_recipe_preptimefm'        => '',
			'plutus_recipe_cooktime'          => '',
			'plutus_recipe_cooktimefm'        => '',
			'plutus_recipe_calo'              => '',
			'plutus_recipe_fat'               => '',
			'plutus_recipe_cuisine'           => '',
			'plutus_recipe_keyw'              => '',
			'plutus_recipe_rating'            => '',
			'plutus_recipe_rating_people'     => '',
			'plutus_recipe_rating_total'      => '',
			'plutus_recipe_videoid'           => '',
			'plutus_recipe_videotitle'        => '',
			'plutus_recipe_videoduration'     => '',
			'plutus_recipe_videoudate'        => '',
			'plutus_recipe_videodesc'         => '',
			'plutus_recipe_ingredients_type'  => '',
			'plutus_recipe_ingredients'       => '',
			'plutus_recipe_ingredients_rtext' => '',
			'plutus_recipe_instructions'      => '',
			'plutus_recipe_notes'             => '',
		);

		return wp_parse_args( $data, $recipe_data_df );
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_primary_category' ) ):
	function plutus_recipe_get_primary_category( $post_id = '' ) {

		if ( empty( $post_id ) ) {
			$post_id = get_the_ID();
		}

		$category_display = '';
		$category_link    = '';
		if ( class_exists( 'WPSEO_Primary_Term' ) ) {
			// Show the post's 'Primary' category, if this Yoast feature is available, & one is set
			$wpseo_primary_term = new WPSEO_Primary_Term( 'category', get_the_id() );
			$wpseo_primary_term = $wpseo_primary_term->get_primary_term();
			$term               = get_term( $wpseo_primary_term );
			if ( is_wp_error( $term ) ) {
				// Default to first category (not Yoast) if an error is returned
				$category = get_the_category( $post_id );
				if ( ! empty( $category ) && isset( $category[0]->name ) ) {
					$category_display = $category[0]->name;
					$category_link    = get_category_link( $category[0]->term_id );
				}
			} else {
				// Yoast Primary category
				$category_display = $term->name;
				$category_link    = get_category_link( $term->term_id );
			}
		} else {
			// Default, display the first category in WP's list of assigned categories
			$category = get_the_category( $post_id );
			if ( ! empty( $category ) && isset( $category[0]->name ) ) {
				$category_display = $category[0]->name;
				$category_link    = get_category_link( $category[0]->term_id );
			}
		}

		if ( $category_link && $category_display ) {
			return '<a class="plutus-primary-cat" href="' . esc_attr( $category_link ) . '">' . esc_html( $category_display ) . '</a>';
		}

		return;
	}
endif;

if ( ! function_exists( 'plutus_recipe_the_primary_category' ) ):
	function plutus_recipe_the_primary_category( $post_id = '' ) {
		echo plutus_recipe_get_primary_category( $post_id );
	}
endif;

if ( ! function_exists( 'plutus_recipe_get_post_thumbnail' ) ) {
	function plutus_recipe_get_post_thumbnail( $args = null ) {
		$post_id = $image_size = $image_type = '';
		$class   = $echo = '';

		$args = wp_parse_args( $args, array(
			'post_id'    => '',
			'image_size' => 'medium',
			'image_type' => 'landscape',
			'class'      => '',
			'echo'       => true
		) );

		extract( $args );

		if ( ! $post_id ) {
			$post_id = get_the_ID();
		}

		$src_thmb = plutus_recipe_get_featured_image_src( $post_id, $image_size );

		$classes = 'plutus-img-placeholder';
		$classes .= ' plutus-image-' . $image_type;
		$classes .= $class ? ' ' . $class : '';

		$output = '<a class="' . $classes . '"';
		$output .= 'style="background-image: url(' . esc_attr( $src_thmb ) . ');"';
		$output .= ' href="' . get_the_permalink() . '"';
		$output .= ' title="' . esc_attr( get_the_title() ) . '"';
		$output .= '>';

		$output .= '</a>';

		if ( $echo ) {
			echo apply_filters( 'plutus_recipe_shortcode/plutus_recipe_get_post_thumbnail', $output );
		}

		return $output;
	}
}

/**
 * Get the featured image size url from post
 *
 */
if ( ! function_exists( 'plutus_recipe_get_featured_image_src' ) ) {
	function plutus_recipe_get_featured_image_src( $id, $size = 'full' ) {
		$img_placeholder = PLUTUS_RECIPE_URL . 'images/plutus-placeholder.png';

		if ( ! has_post_thumbnail( $id ) ) {
			return $img_placeholder;
		} else {
			$image_html = get_the_post_thumbnail( $id, $size );
			preg_match( '@src="([^"]+)"@', $image_html, $match );
			$src       = array_pop( $match );
			$src_check = substr( $src, - 4 );

			// Case: format of featured image is gif
			if ( $src_check == '.gif' ) {
				$image_full = get_the_post_thumbnail( $id, 'full' );
				preg_match( '@src="([^"]+)"@', $image_full, $match_full );
				$src = array_pop( $match_full );
			}

			if ( empty( $src ) ) {
				$src = $img_placeholder;
			}

			return $src;
		}
	}
}

if ( ! function_exists( 'plutus_recipe_posted_by' ) ) :
	/**
	 * Prints HTML with meta information for the current author.
	 */
	function plutus_recipe_posted_by() {
		$byline = sprintf(
		/* translators: %s: post author. */
			esc_html_x( 'by %s', 'post author', 'plutus-recipe-pro' ),
			'<span class="author vcard"><a class="url fn n" href="' . esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ) . '">' . esc_html( get_the_author() ) . '</a></span>'
		);

		$output = '<span class="plutus-pmeta-item byline"> ' . $byline . '</span>'; // WPCS: XSS OK.

		echo apply_filters( 'plutus_recipe_pro/posted_by_hook', $output );

	}
endif;

/**
 * Prints HTML with meta information for the current post-date/time and author.
 */
if ( ! function_exists( 'plutus_recipe_posted_on' ) ):
	function plutus_recipe_posted_on() {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';
		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time><time class="updated" datetime="%3$s">%4$s</time>';
		}

		$show_updated = plutus_recipe_get_option( 'plutus_recipe_show_date_updated' );

		$time_string = sprintf( $time_string,
			! $show_updated ? esc_attr( get_the_date( 'c' ) ) : esc_attr( get_the_modified_date( 'c' ) ),
			! $show_updated ? esc_html( get_the_date() ) : esc_html( get_the_modified_date() ),
			esc_attr( get_the_modified_date( 'c' ) ),
			esc_html( get_the_modified_date() )
		);

		$output = '<span class="plutus-pmeta-item posted-on">' . $time_string . '</span>';

		echo apply_filters( 'plutus_recipe_pro/posted_on_hook', $output );

	}
endif;

/**
 * See if theme/s is activate or not.
 *
 * @param string|array $theme Theme name or array of theme names to check.
 *
 * @return boolean
 */
if ( ! function_exists( 'plutus_is_active_theme' ) ) {
	function plutus_is_active_theme( $theme ) {
		return is_array( $theme ) ? in_array( get_template(), $theme, true ) : get_template() === $theme;
	}
}

/**
 * Get all image sizes.
 */
if ( ! function_exists( 'plutus_recipe_get_all_image_sizes' ) ):
	function plutus_recipe_get_all_image_sizes() {
		global $_wp_additional_image_sizes;

		$default_image_sizes = array( 'thumbnail', 'medium', 'medium_large', 'large' );

		$image_sizes = array();
		foreach ( $default_image_sizes as $size ) {
			$image_sizes[ $size ] = [
				'width'  => (int) get_option( $size . '_size_w' ),
				'height' => (int) get_option( $size . '_size_h' ),
				'crop'   => (bool) get_option( $size . '_crop' ),
			];
		}

		if ( $_wp_additional_image_sizes ) {
			$image_sizes = array_merge( $image_sizes, $_wp_additional_image_sizes );
		}

		return apply_filters( 'plutus_recipe_pro/image_size_names_choose', $image_sizes );
	}
endif;

/**
 * Get image sizes.
 *
 * Retrieve available image sizes after filtering `include` and `exclude` arguments.
 */
if ( ! function_exists( 'plutus_recipe_choices_image_sizes' ) ):
	function plutus_recipe_choices_image_sizes( $default = false ) {
		$wp_image_sizes = plutus_recipe_get_all_image_sizes();

		$image_sizes = array();

		if ( $default ) {
			$image_sizes[''] = esc_html__( 'Default from Customize', PLUTUS_RECIPE_VERSION );
		}

		foreach ( $wp_image_sizes as $size_key => $size_attributes ) {
			$control_title = ucwords( str_replace( '_', ' ', $size_key ) );
			if ( is_array( $size_attributes ) ) {
				$control_title .= sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
			}

			$image_sizes[ $size_key ] = $control_title;
		}

		$image_sizes['full'] = esc_html__( 'Full','plutus-recipe-pro' );

		return $image_sizes;
	}
endif;

if ( ! function_exists( 'plutus_recipe_choices_image_sizes_vc' ) ):
	function plutus_recipe_choices_image_sizes_vc( $default = false ) {
		$wp_image_sizes = plutus_recipe_get_all_image_sizes();

		$image_sizes = array();

		if ( $default ) {
			$image_sizes[ esc_html__( 'Default from Customize', PLUTUS_RECIPE_VERSION ) ] = '';
		}

		foreach ( $wp_image_sizes as $size_key => $size_attributes ) {
			$control_title = ucwords( str_replace( '_', ' ', $size_key ) );
			if ( is_array( $size_attributes ) ) {
				$control_title .= sprintf( ' - %d x %d', $size_attributes['width'], $size_attributes['height'] );
			}

			$image_sizes[ $control_title ] = $size_key;
		}

		$image_sizes[ esc_html__( 'Full', PLUTUS_RECIPE_VERSION ) ] = 'full';

		return $image_sizes;
	}
endif;
