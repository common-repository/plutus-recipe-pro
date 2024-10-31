<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}

$recipe_data = plutus_recipe_data_parse_args( $plutus_recipe_datas );


$list_metas = array();

if ( $recipe_data['plutus_recipe_servings'] ) {
	$list_metas['servings'] = plutus_recipe_get_recipe_servings( $recipe_data['plutus_recipe_servings'] );
}

if ( $recipe_data['plutus_recipe_preptime'] ) {
	$list_metas['preptime'] = plutus_recipe_get_recipe_preptime( $recipe_data['plutus_recipe_preptime'], $recipe_data['plutus_recipe_preptimefm'] );
}

if ( $recipe_data['plutus_recipe_cooktime'] ) {
	$list_metas['cooktime'] = plutus_recipe_get_recipe_cooktime( $recipe_data['plutus_recipe_cooktime'], $recipe_data['plutus_recipe_cooktimefm'] );
}

$list_metas['calo_fat'] = plutus_recipe_get_recipe_calo_fat( $recipe_data['plutus_recipe_calo'], $recipe_data['plutus_recipe_fat'] );
$list_metas['category'] = plutus_recipe_get_recipe_category( $plutus_recipe_datas['post_id'] );
$list_metas['cuisine'] = plutus_recipe_get_recipe_cuisine( $recipe_data['plutus_recipe_cuisine'] );
$list_metas['keyw'] = plutus_recipe_get_recipe_keywords( $recipe_data['plutus_recipe_keyw'] );
$list_metas['author'] = plutus_recipe_get_recipe_author();

if ( $recipe_data['plutus_recipe_rating'] ) {
	$list_metas['rating'] = plutus_recipe_get_recipe_rating( $recipe_data );
}

if ( ! $list_metas ) {
	return;
}
?>
<div class="plutus-recipe-meta">
	<ul class="plutus-list-unstyled">
		<?php
		foreach ( $list_metas as $list_meta_key => $list_meta ) {
			if( $list_meta ){
				echo '<li class="plutus-recipe-meta-' . esc_attr( $list_meta_key ) . '">' . $list_meta . '</li>';
			}
		}
		?>
	</ul>
</div>
