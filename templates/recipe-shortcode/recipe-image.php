<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipe_datas;


if ( ! $plutus_recipe_datas ) {
	return;
}

$post_id = isset( $plutus_recipe_datas['post_id'] ) ? $plutus_recipe_datas['post_id'] : get_the_ID();

$recipe_data = plutus_recipe_data_parse_args( $plutus_recipe_datas );

$markup_img   = '';
$class_slider = '';

$hide_fimg    = plutus_recipe_get_option( 'plutus_recipe_hide_fimg' );
$dis_lightbox = plutus_recipe_get_option( 'plutus_recipe_dis_lightbox' );
$hide_gallery = plutus_recipe_get_option( 'plutus_recipe_hide_gallery' );
$dis_zoom     = plutus_recipe_get_option( 'plutus_recipe_dis_zoom' );
$image_size   = plutus_recipe_get_option( 'plutus_recipe_imgsize' );

if ( 's3' == $recipe_data['plutus_recipe_scStyle'] ) {
	$dis_lightbox = true;
	$hide_gallery = true;
	$dis_zoom     = true;
	$image_size   = 'thumbnail';
}

$hide_fimg_class = $hide_fimg ? 'plutus-recipe-inputhide' : '';

if( ! $hide_fimg ) {
	$image_id   = $recipe_data['plutus_recipe_img'] ? $recipe_data['plutus_recipe_img'] : get_post_thumbnail_id( $post_id );
	$markup_img = plutus_recipe_get_gallery_image_html( $image_id, $hide_fimg_class, $dis_zoom, $dis_lightbox, $image_size );
}

if ( ! $hide_gallery ) {
	if ( $recipe_data['plutus_recipe_gallery'] ) {
		$recipe_gallery = (array) $plutus_recipe_datas['plutus_recipe_gallery'];

		foreach ( $recipe_gallery as $gallery_id ) {
			$markup_img .= plutus_recipe_get_gallery_image_html( $gallery_id, '', $dis_zoom, $dis_lightbox );
		}

		$class_slider = ' plutus-recipe-owl-carousel';
	}
}

$dis_lightbox = plutus_recipe_get_option( 'plutus_recipe_dis_lightbox' );

if ( $markup_img ) {
	echo '<div class="plutus-recipe-images-wrap' . ( $hide_fimg && $dis_lightbox ? ' plutus-recipe-images-hide' : '' ) . '">';
	echo '<div class="' . ( ! $dis_lightbox ? 'plutus-image-lightbox ' : '' ) . 'plutus-recipe-images' . esc_attr( $class_slider ) . '">';
	echo '' . $markup_img;
	echo '</div>';
	echo '</div>';
}
