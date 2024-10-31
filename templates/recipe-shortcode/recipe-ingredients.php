<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}
$recipe_data = plutus_recipe_data_parse_args( $plutus_recipe_datas );

$ingredient_html = '';
if( $recipe_data['plutus_recipe_ingredients_type'] && $recipe_data['plutus_recipe_ingredients_rtext'] ) {

	$ingredients_autop = wpautop( htmlspecialchars_decode( $recipe_data['plutus_recipe_ingredients_rtext'] ) );
	$ingredients_autop = str_replace( '<li', '<li itemprop="recipeIngredient"', $ingredients_autop );
	$ingredient_html   = str_replace( '<p', '<p itemprop="recipeIngredient"', $ingredients_autop );

}elseif ( $recipe_data['plutus_recipe_ingredients'] ) {
	$ingredients_trim = wp_strip_all_tags( $recipe_data['plutus_recipe_ingredients'] );
	$ingredients_arr  = preg_split( '/\r\n|[\r\n]/', $ingredients_trim );

	if ( $ingredients_arr ) {
		$ingredient_html .= '<ul>';
		foreach ( $ingredients_arr as $ingredient ) {
			if ( ! $ingredient ) {
				continue;
			}

			$ingredient_html .= '<li><span itemprop="recipeIngredient">' . $ingredient . '</span></li>';
		}
		$ingredient_html .= '</ul>';
	}
}
$output = '';
if ( $ingredient_html ) {
	$output .= '<div class="plutus-recipe-ingredients">';
	$output .= '<h3 class="plutus-recipe-label">' . plutus_recipe_get_option( 'plutus_recipe_ingredient_label' ) . '</h3>';
	$output .= $ingredient_html;
	$output .= '</div>';
}

echo '' . $output;