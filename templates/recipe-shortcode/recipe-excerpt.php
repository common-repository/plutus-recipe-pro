<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}

$class_hide = '';
$description = isset( $plutus_recipe_datas['plutus_recipe_desc'] ) ? $plutus_recipe_datas['plutus_recipe_desc'] : '';

if ( ! $description ) {
	if ( get_the_excerpt() ) {
		$description = get_the_excerpt();
	} else {
		$description = get_the_title();
	}

	$class_hide = ' plutus-recipe-inputhide';
}

echo '<div class="plutus-recipe-desc' . esc_attr( $class_hide ) . '" itemprop="description">' . $description . '</div>';
