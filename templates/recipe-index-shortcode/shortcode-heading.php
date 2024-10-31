<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipeIndex_datas;

$title          = isset( $plutus_recipeIndex_datas['title'] ) ? $plutus_recipeIndex_datas['title'] : '';
$view_more_link = isset( $plutus_recipeIndex_datas['view_more_link'] ) ? $plutus_recipeIndex_datas['view_more_link'] : '';
$view_more_text = isset( $plutus_recipeIndex_datas['view_more_text'] ) ? $plutus_recipeIndex_datas['view_more_text'] : '';
$view_more_pos = isset( $plutus_recipeIndex_datas['view_more_pos'] ) ? $plutus_recipeIndex_datas['view_more_pos'] : '';

if ( ( 'top' == $view_more_pos && $view_more_link && $view_more_text ) || $title ) {

	$titleAlign = plutus_recipe_get_option( 'plutus_recipeI_titleAlign' );
	echo '<div class="plutus-index-heading-wrap plutus-index-heading-' . esc_attr( $titleAlign ) . '">';
	if ( $title ) {
		echo '<h3 class="plutus-index-heading">';
		if ( $view_more_link ) {
			echo '<a href="' . esc_attr( $view_more_link ) . '">' . do_shortcode( $title ) . '</a>';
		} else {
			echo '<span>' . do_shortcode( $title ) . '</span>';
		}
		echo '</h3>';
	}

	if ( 'top' == $view_more_pos && $view_more_link && $view_more_text ) {
		echo '<a class="plutus-btn-viewmore" href="' . esc_url( $view_more_link ) . '">' . do_shortcode( $view_more_text ) . plutus_recipe_get_icon_svg( 'angle-double-right',16 ) .'</a>';
	}

	echo '</div>';
}
