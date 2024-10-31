<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

$hide_print     = plutus_recipe_get_option( 'plutus_recipe_hide_print' );
$hide_pinterest = plutus_recipe_get_option( 'plutus_recipe_hide_pinterest' );

if ( $hide_print && $hide_pinterest ) {
	return;
}
?>
<div class="plutus-recipe-sharing plutus-hide-print">
	<?php if ( ! $hide_print ) { ?>
		<a href="#" class="plutus-recipe-printbtn" data-print="<?php echo PLUTUS_RECIPE_URL . 'css/print.css?ver=' . PLUTUS_RECIPE_VERSION; ?>">
			<?php plutus_recipe_social_icon_svg( 'print', 13 ) ?>
			<span><?php echo plutus_recipe_get_option( 'plutus_recipe_btnPrint_label' ); ?></span>
		</a>
		<?php
	}
	if ( ! $hide_pinterest ) {
		?>
		<a class="plutus-recipe-pinterest" data-pin-do="none" rel="nofollow noreferrer noopener"
		   onclick="var e=document.createElement('script');e.setAttribute('type','text/javascript');e.setAttribute('charset','UTF-8');e.setAttribute('src','//assets.pinterest.com/js/pinmarklet.js?r='+Math.random()*99999999);document.body.appendChild(e);">
			<i class="fab fa-pinterest-p"></i>
			<?php plutus_recipe_social_icon_svg( 'pinterest', 13 ) ?>
			<span>Pinterest</span>
		</a>
	<?php } ?>
</div>
