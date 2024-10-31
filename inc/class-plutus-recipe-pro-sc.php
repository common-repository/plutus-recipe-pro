<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Class_Plutus_Recipe_Pro_Shortcode' ) ):
	class Class_Plutus_Recipe_Pro_Shortcode {
		public static function plutus_recipe_func( $atts, $content = "" ) {
			$atts = shortcode_atts( array( 'post_id' => '' ), $atts, 'plutus_recipe' );

			$post_id         = '';
			if ( $atts['post_id'] ) {
				$post_id = $atts['post_id'];
			} elseif ( is_single() ) {
				$post_id = get_the_ID();
			}

			if ( ! $post_id ) {
				self::error( 'Plutus Recipe', esc_html__( 'Please insert post ID', 'plutus-recipe-pro' ) );
				return;
			}

			$recipe_data_pmt = get_post_meta( $post_id, 'plutus_recipe_data', true );

			if ( ! $recipe_data_pmt ) {
				self::error( 'Plutus Recipe', esc_html__( 'shortcode is empty. Configure this data shortcode', 'plutus-recipe-pro' ) );
				return;
			}

			if ( isset( $recipe_data_pmt['plutus_recipe_scStyle'] ) && ! $recipe_data_pmt['plutus_recipe_scStyle'] ) {
				unset( $recipe_data_pmt['plutus_recipe_scStyle'] );
			}

			$recipe_data_pmt['post_id'] = $post_id;
			$recipe_data = plutus_recipe_data_parse_args( $recipe_data_pmt );

			$recipe_style = $recipe_data['plutus_recipe_scStyle'] ? $recipe_data['plutus_recipe_scStyle'] : 's1';

			$class_wrap = 'plutus-recipe';
			$class_wrap .= ' plutus-recipe-pID-' . esc_attr( $post_id );
			$class_wrap .= ' plutus-recipe-' . esc_attr( $recipe_style );

			global $plutus_recipe_datas;

			$plutus_recipe_datas = $recipe_data;

			ob_start();

			do_action( 'plutus_recipe_shortcode/before_shortcode' );
			?>
			<div id="plutus-recipe-pID-<?php echo esc_attr( $post_id ); ?>" class="<?php echo esc_attr( $class_wrap ); ?>" itemscope itemtype="http://schema.org/Recipe">
				<div class="plutus-recipe-inner">
					<div class="plutus-recipe-header">
						<?php
						/**
						 * Hook: plutus_recipe_shortcode/before_summary.
						 *
						 * @hooked plutus_recipe_show_images - 20
						 */
						do_action( 'plutus_recipe_shortcode/before_summary', $post_id );
						?>
						<div class="plutus-recipe-summary">
							<?php
							/**
							 * Hook: plutus_recipe_shortcode/entry_summary.
							 *
							 * @see plutus_recipe_shortcode_title() - 5
							 * @see plutus_recipe_shortcode_excerpt() - 10
							 * @see plutus_recipe_shortcode_meta() - 15
							 * @see plutus_recipe_shortcode_sharing() - 20
							 */
							do_action( 'plutus_recipe_shortcode/entry_summary', $post_id );
							?>
						</div>
					</div>
					<div class="plutus-recipe-content">
						<?php
						/**
						 * Hook: plutus_recipe_shortcode/entry_content.
						 *
						 * @see plutus_recipe_shortcode_ingredients()
						 * @see plutus_recipe_shortcode_instructions()
						 * @see plutus_recipe_shortcode_video()
						 * @see plutus_recipe_shortcode_notes()
						 */
						do_action( 'plutus_recipe_shortcode/entry_content', $post_id );
						?>
					</div>
				</div>
			</div>
			<?php
			do_action( 'plutus_recipe_shortcode/end_shortcode' );

			$output = ob_get_clean();

			unset( $plutus_recipe_datas );

			return $output;
		}

		public static function error( $title, $mess, $class = '' ) {
			if ( ! $mess || ! is_user_logged_in() ) {
				return;
			}
			echo '<div class="plutus-missing-settings ' . $class . '"><span class="plutus-mess-title">' . $title . '</span><span class="plutus-mess-ctent">' . $mess . '</span></div>';
		}
	}

	add_shortcode( 'plutus_recipe', array( 'Class_Plutus_Recipe_Pro_Shortcode', 'plutus_recipe_func' ) );
endif;