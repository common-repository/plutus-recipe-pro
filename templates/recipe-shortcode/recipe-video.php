<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $plutus_recipe_datas;

if ( ! $plutus_recipe_datas ) {
	return;
}

$recipe_data = plutus_recipe_data_parse_args( $plutus_recipe_datas );
$hide_videobox = plutus_recipe_get_option( 'plutus_recipe_hide_videobox' );

if( $hide_videobox ) {
	return;
}
if ( ! $recipe_data['plutus_recipe_videoid'] ) {
	return;
}
$videotitle    = $recipe_data['plutus_recipe_videotitle'] ? $recipe_data['plutus_recipe_videotitle'] : plutus_recipe_get_option( 'plutus_recipe_videotitle' );
$videoduration = $recipe_data['plutus_recipe_videoduration'] ? $recipe_data['plutus_recipe_videoduration'] : plutus_recipe_get_option( 'plutus_recipe_videoduration' );
$videoudate    = $recipe_data['plutus_recipe_videoudate'] ? $recipe_data['plutus_recipe_videoudate'] : plutus_recipe_get_option( 'plutus_recipe_videoudate' );
$videodesc     = $recipe_data['plutus_recipe_videodesc'] ? $recipe_data['plutus_recipe_videodesc'] : plutus_recipe_get_option( 'plutus_recipe_videodesc' );

$show_video_meta = false;
?>
	<div class="plutus-recipe-video-wrap plutus-hide-print">
		<h3 class="plutus-recipe-label"><?php echo plutus_recipe_get_option( 'plutus_recipe_video_label' ) ?></h3>
		<div itemprop="video" itemscope itemtype="http://schema.org/VideoObject">
			<div id="schema-videoobject">
				<iframe width="853" height="480" src="https://www.youtube.com/embed/<?php echo esc_attr( $recipe_data['plutus_recipe_videoid'] ); ?>?rel=0&controls=0&showinfo=0" frameborder="0" allowfullscreen></iframe>
			</div>
			<?php
			if ( ! $show_video_meta ) {
				echo '<div class="plutus-recipe-inputhide">';
			}
			?>
			<span itemprop="name"><?php echo esc_html( $videotitle ); ?></span>
			<span itemprop="description"><?php echo esc_html( $videodesc ) ?></span>
			<meta itemprop="thumbnailURL" content="https://img.youtube.com/vi/<?php echo esc_attr( $recipe_data['plutus_recipe_videoid'] ); ?>/hqdefault.jpg"/>
			<meta itemprop="uploadDate" content="<?php echo esc_attr( $videoudate ); ?>"/>
			<meta itemprop="duration" content="PT<?php echo esc_attr( $videoduration ); ?>"/>
			<meta itemprop="contentUrl" content="https://youtube.googleapis.com/v/<?php echo esc_attr( $recipe_data['plutus_recipe_videoid'] ); ?>"/>
			<meta itemprop="embedURL" content="https://youtube.googleapis.com/v/<?php echo esc_attr( $recipe_data['plutus_recipe_videoid'] ); ?>"/>
			<?php
			if ( ! $show_video_meta ) {
				echo '</div>';
			}
			?>
		</div>
	</div>
<?php
