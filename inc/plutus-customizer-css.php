<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if( ! function_exists( 'plutus_recipe_customizer_css' ) ):
add_action( 'wp_head', 'plutus_recipe_customizer_css' );
function plutus_recipe_customizer_css(){
	$css = '';

	$border_color       = get_theme_mod( 'plutus_recipe_border_color' );
	$text_color         = get_theme_mod( 'plutus_recipe_text_color' );
	$bg_color           = get_theme_mod( 'plutus_recipe_bg_color' );
	$title_color        = get_theme_mod( 'plutus_recipe_title_color' );
	$meta_color         = get_theme_mod( 'plutus_recipe_meta_color' );
	$btnText_color      = get_theme_mod( 'plutus_recipe_btnText_color' );
	$btnTextH_color     = get_theme_mod( 'plutus_recipe_btnTextH_color' );
	$btnBgH_color       = get_theme_mod( 'plutus_recipe_btnBgH_color' );
	$sectionTitle_color = get_theme_mod( 'plutus_recipe_sectionTitle_color' );
	$notesTitle_color   = get_theme_mod( 'plutus_recipe_notesTitle_color' );
	$notesText_color    = get_theme_mod( 'plutus_recipe_notesText_color' );
	$normal_fill = get_theme_mod( 'plutus_recipe_ratingNormal_color' );
	$rated_fill  = get_theme_mod( 'plutus_recipe_ratingRated_color' );

	if( $normal_fill ) {
		$css .= '.jq-ry-group.jq-ry-normal-group svg{ color: ' . esc_attr( $normal_fill ) . ';fill: ' . esc_attr( $normal_fill ) . '; }';
	}
	if( $rated_fill ) {
		$css .= '.jq-ry-group.jq-ry-rated-group svg{ color: ' . esc_attr( $rated_fill ) . ';fill: ' . esc_attr( $rated_fill ) . '; }';
	}


	if( $border_color ) {
		$css .= '.entry-content .plutus-recipe, .plutus-recipe,';
		$css .= 'plutus-recipe .plutus-missing-settings,';
		$css .= '.plutus-recipe .plutus-recipe-content > div,';
		$css .= '.plutus-recipe-summary .plutus-recipe-sharing,.plutus-recipe-summary .plutus-recipe-meta';
		$css .= '{ border-color: ' . esc_attr( $border_color ) . '; }';
	}

	if( $text_color ) {
		$css .= '.entry-content .plutus-recipe, .plutus-recipe,.plutus-recipe .plutus-recipe-inner{ color: ' . esc_attr( $text_color ) . '; }';
	}

	if( $bg_color ) {
		$css .= '.entry-content .plutus-recipe, .plutus-recipe{ background-color: ' . esc_attr( $bg_color ) . '; }';
	}
	if( $title_color ) {
		$css .= '.entry-content .plutus-recipe .plutus-recipe-header h2, .plutus-recipe .plutus-recipe-header h2{ color: ' . esc_attr( $title_color ) . '; }';
	}
	if( $meta_color ) {
		$css .= '.plutus-recipe .plutus-recipe-meta, .plutus-recipe .plutus-recipe-meta a, .plutus-recipe .plutus-recipe-meta ul li{ color: ' . esc_attr( $meta_color ) . '; }';
	}
	if( $btnText_color ) {
		$css .= '.plutus-recipe .plutus-recipe-pinterest, .plutus-recipe a.plutus-recipe-printbtn{ color: ' . esc_attr( $btnText_color ) . ';border-color: ' . esc_attr( $btnText_color ) . '; }';
	}

	if( $btnTextH_color ) {
		$css .= '.plutus-recipe .plutus-recipe-pinterest:hover, .plutus-recipe a.plutus-recipe-printbtn:hover{ color: ' . esc_attr( $btnTextH_color ) . '; }';
	}

	if( $btnBgH_color ) {
		$css .= '.plutus-recipe .plutus-recipe-pinterest:hover, .plutus-recipe a.plutus-recipe-printbtn:hover{ border-color: ' . esc_attr( $btnBgH_color ) . ';background-color: ' . esc_attr( $btnBgH_color ) . '; }';
	}

	if( $sectionTitle_color ) {
		$css .= '.plutus-recipe-inner h3.plutus-recipe-label{ color: ' . esc_attr( $sectionTitle_color ) . '; }';
	}

	if( $notesTitle_color ) {
		$css .= '.plutus-recipe-inner .plutus-recipe-notes h3.plutus-recipe-label{ color: ' . esc_attr( $notesTitle_color ) . '; }';
	}
	if( $notesText_color ) {
		$css .= '.plutus-recipe-inner .plutus-recipe-notes p, .plutus-recipe-inner .plutus-recipe-notes{ color: ' . esc_attr( $notesText_color ) . '; }';
	}

	$recipeI_heading_color  = get_theme_mod( 'plutus_recipeI_heading_color' );
	$recipeI_cat_color      = get_theme_mod( 'plutus_recipeI_cat_color' );
	$recipeI_author_color   = get_theme_mod( 'plutus_recipeI_author_color' );
	$recipeI_Info_bgcolor   = get_theme_mod( 'plutus_recipeI_Info_bgcolor' );
	$recipeI_vMore_color    = get_theme_mod( 'plutus_recipeI_vMore_color' );
	$recipeI_vMore_bgcolor  = get_theme_mod( 'plutus_recipeI_vMore_bgcolor' );
	$recipeI_vMore_hcolor   = get_theme_mod( 'plutus_recipeI_vMore_hcolor' );
	$recipeI_vMore_hbgcolor = get_theme_mod( 'plutus_recipeI_vMore_hbgcolor' );

	if( $recipeI_heading_color ) {
		$css .= '.plutus-recipe-index .plutus-index-heading{ color: ' . esc_attr( $recipeI_heading_color ) . '; }';
	}
	if( $recipeI_cat_color ) {
		$css .= '.plutus-recipe-index a.plutus-primary-cat{ color: ' . esc_attr( $recipeI_cat_color ) . '; }';
	}
	if( $recipeI_author_color ) {
		$css .= '.plutus-recipe-index .plutus-pmeta-items, .plutus-recipe-index .plutus-pmeta-items a{ color: ' . esc_attr( $recipeI_author_color ) . '; }';
	}
	if( $recipeI_Info_bgcolor ) {
		$css .= '.plutus-recipeI-s4 .plutus-index-items .plutus-rIndex-info, .plutus-recipeI-s2 .plutus-index-items .plutus-rIndex-info{ background-color: ' . esc_attr( $recipeI_Info_bgcolor ) . '; }';
	}

	if( $recipeI_vMore_color ) {
		$css .= '.plutus-recipe-index .button.plutus-recipeI-button,.plutus-recipe-index .plutus-btn-viewmore{ color: ' . esc_attr( $recipeI_vMore_color ) . '; }';
	}
	if( $recipeI_vMore_hcolor ) {
		$css .= '.plutus-recipe-index .button.plutus-recipeI-button:hover,.plutus-recipe-index .plutus-btn-viewmore:hover{ color: ' . esc_attr( $recipeI_vMore_hcolor ) . '; }';
	}

	if( $recipeI_vMore_bgcolor ) {
		$css .= '.plutus-recipe-index .button.plutus-recipeI-button{ background-color: ' . esc_attr( $recipeI_vMore_bgcolor ) . '; }';
	}if( $recipeI_vMore_hbgcolor ) {
		$css .= '.plutus-recipe-index .button.plutus-recipeI-button:hover{ background-color: ' . esc_attr( $recipeI_vMore_hbgcolor ) . '; }';
	}


	if( $css ) {
		echo '<style>' . $css . '</style>';
	}
}
endif;