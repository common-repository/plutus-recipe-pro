<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}

if ( isset( $plutus_recipe_datas['plutus_recipe_title'] ) && $plutus_recipe_datas['plutus_recipe_title'] ) {
	$title = $plutus_recipe_datas['plutus_recipe_title'];
} elseif ( isset( $plutus_recipe_datas['post_id'] ) ) {
	$title = get_the_title( $plutus_recipe_datas['post_id'] );
}

if ( $title ) {
	echo '<h2 class="plutus-recipe-title" itemprop="name">' . ( $title ) . '</h2>';
}