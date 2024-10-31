<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}

$recipe_data = plutus_recipe_data_parse_args( $plutus_recipe_datas );


if( 's3' != $recipe_data['plutus_recipe_scStyle']  ) {
	return;
}

if ( plutus_recipe_get_option( 'plutus_recipe_hide_gallery' ) ) {
	return;
}

if ( ! $recipe_data['plutus_recipe_gallery'] ) {
	return;
}

$markup_img = '';
if ( plutus_recipe_get_option( 'plutus_recipe_hide_gallery' ) ) {
	return;
}

$recipe_gallery = (array) $recipe_data['plutus_recipe_gallery'];

foreach ( $recipe_gallery as $gallery_id ) {
	$image_size = apply_filters( 'plutus_recipe_shortcode/image_size', 'large' );
	$image_info = wp_get_attachment_image_src( $gallery_id, $image_size );

	$dis_zoom     = plutus_recipe_get_option( 'plutus_recipe_dis_zoom' );
	$dis_lightbox = plutus_recipe_get_option( 'plutus_recipe_dis_lightbox' );


	if ( $image_info ) {
		list( $src, $width, $height ) = $image_info;
		$image_alt = trim( strip_tags( get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ) );

		if ( $src ) {
			$image = '<img itemprop="image" src="' . esc_url( $src ) . '" alt="' . esc_attr( $image_alt ? $image_alt : esc_html__( 'Recipe image', 'plutus-recipe-pro' ) ) . '" width="' . esc_attr( $width ) . '" height="' . esc_attr( $height ) . '"/>';
			$output = '<div data-thumb="' . esc_url( $src ) . '" class="plutus-recipe-image' . ( $class ? ' ' . $class : '' ) . '">';
			$output .= '<a href="' . esc_url( $dis_lightbox ? '#' : $src ) . '">';
			$output .= $image;
			$output .= '</a>';
			$output .= '</div>';

			$markup_img .= $output;
		}
	}
}

if ( ! $markup_img ) {
	return;
}

$dis_lightbox = plutus_recipe_get_option( 'plutus_recipe_dis_lightbox' );
?>
	<div class="plutus-recipe-gallery-section">
		<h3 class="plutus-recipe-label"><?php echo plutus_recipe_get_option( 'plutus_recipe_gallery_label' ); ?></h3>
		<div class="plutus-recipe-images<?php echo( ! $dis_lightbox ? ' plutus-image-lightbox ' : '' ); ?>">
			<?php echo do_shortcode( $markup_img ); ?>
		</div>
	</div>
<?php

