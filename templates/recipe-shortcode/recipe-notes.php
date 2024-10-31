<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}

$recipe_data = plutus_recipe_data_parse_args( $plutus_recipe_datas );
$hide_nots   = plutus_recipe_get_option( 'plutus_recipe_hide_nots' );

if ( $hide_nots ) {
	return;
}

if ( ! $recipe_data['plutus_recipe_notes'] ) {
	return;
}

?>
	<div class="plutus-recipe-notes">
		<h3 class="plutus-recipe-label"><?php echo plutus_recipe_get_option( 'plutus_recipe_notes_label' ); ?></h3>
		<p><?php echo do_shortcode( $recipe_data['plutus_recipe_notes'] ); ?></p>
	</div>
<?php
