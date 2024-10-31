<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipeIndex_datas;

$show_pcat    = isset( $plutus_recipeIndex_datas['show_pcat'] ) ? $plutus_recipeIndex_datas['show_pcat'] : '';
$hide_pauthor = isset( $plutus_recipeIndex_datas['hide_pauthor'] ) ? $plutus_recipeIndex_datas['hide_pauthor'] : '';
$hide_pdate   = isset( $plutus_recipeIndex_datas['hide_pdate'] ) ? $plutus_recipeIndex_datas['hide_pdate'] : '';
$hide_pimg    = isset( $plutus_recipeIndex_datas['hide_pimg'] ) ? $plutus_recipeIndex_datas['hide_pimg'] : '';
$image_type    = isset( $plutus_recipeIndex_datas['image_type'] ) ? $plutus_recipeIndex_datas['image_type'] : '';
?>
<article <?php post_class( 'plutus-recipeI-item' ); ?>>
	<div class="plutus-recipeI-inner">
		<?php
		if ( 'yes' != $hide_pimg ) {

			$attr_thumbnail = array();
			if ( $image_type ) {
				$attr_thumbnail = array( 'image_type' => $image_type );
			}
			echo '<div class="plutus-rIndex-pthumb">';
			plutus_recipe_get_post_thumbnail( $attr_thumbnail );
			echo '</div>';
		}
		?>
		<div class="plutus-rIndex-info">
			<h3 class="plutus-rIndex-title"><a href="<?php echo get_permalink(); ?>"><?php the_title(); ?></a></h3>
			<div class="entry-meta plutus-pmeta-items">
				<?php
				if ( 'yes' == $show_pcat ) {
					echo '<span class="plutus-pmeta-item plutus-pmeta-cat">';
					plutus_recipe_the_primary_category();
					echo '</span>';
				}
				if ( 'yes' != $hide_pauthor ) {
					plutus_recipe_posted_by();
				}

				if ( 'yes' != $hide_pdate ) {
					plutus_recipe_posted_on();
				}
				?>
			</div>
		</div>
	</div>
</article>