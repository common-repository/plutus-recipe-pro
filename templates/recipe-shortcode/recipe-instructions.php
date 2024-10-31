<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}

$recipe_data = plutus_recipe_data_parse_args( $plutus_recipe_datas );

if ( ! $recipe_data['plutus_recipe_instructions'] ) {
	return;
}
?>
<div class="plutus-recipe-instructions">
	<h3 class="plutus-recipe-label"><?php echo plutus_recipe_get_option( 'plutus_recipe_instructions_label' ); ?></h3>
	<div itemprop="recipeInstructions">
		<?php echo wpautop( htmlspecialchars_decode( $recipe_data['plutus_recipe_instructions'] ) ); ?>
	</div>
</div>