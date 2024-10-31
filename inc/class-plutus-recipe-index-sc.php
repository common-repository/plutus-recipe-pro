<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

if ( ! class_exists( 'Class_Plutus_Recipe_Index_Shortcode' ) ):
	class Class_Plutus_Recipe_Index_Shortcode {

		/**
		 * Main function
		 *
		 * @param $atts
		 * @param string $content
		 *
		 * @return string|void
		 */
		public static function plutus_recipe_func( $atts, $content = "" ) {
			$atts = shortcode_atts( array(
				'style'          => '',
				'title'          => '',
				'cat'            => '',
				'ppp'            => '',
				'columns'        => '',
				'show_pcat'      => '',
				'hide_pauthor'   => '',
				'hide_pdate'     => '',
				'hide_pimg'      => '',
				'image_size'     => '',
				'image_type'     => '',
				'titleofupper'   => '',
				'view_more_pos'  => '',
				'view_more_link' => '',
				'view_more_text' => '',
				'row_gap'        => '',
				'col_gap'        => '',
			), $atts, 'plutus_recipe_index' );

			$atts = self::update_shortcode_atts( $atts );

			$result_query = new WP_Query( array(
				'category_name'       => $atts['cat'],
				'posts_per_page'      => $atts['ppp'],
				'ignore_sticky_posts' => true
			) );

			if ( ! $result_query->have_posts() ) {
				self::error( 'Plutus Recipe Index', esc_html__( 'shortcode is empty. Configure this data shortcode', 'plutus-recipe-pro' ) );

				return;
			}


			global $plutus_recipeIndex_datas;
			$plutus_recipeIndex_datas = $atts;

			$class_wrap = 'plutus-recipe-index';
			$class_wrap .= ' plutus-recipeI-' . esc_attr( $atts['columns'] );
			$class_wrap .= ' plutus-recipeI-' . esc_attr( $atts['style'] );

			if ( $atts['titleofupper'] ) {
				$class_wrap .= ' plutus-recipeI-titleofUpper';
			}

			$id_sc = 'plutus-recipeI-' . rand( 1000, 100000 );

			ob_start();

			do_action( 'plutus_recipe_index_shortcode/before_shortcode' );
			?>
			<div id="<?php echo esc_attr( $id_sc ); ?>" class="<?php echo esc_attr( $class_wrap ); ?>">
				<div class="plutus-recipe-index-inner">
					<?php plutus_recipe_get_template( 'recipe-index-shortcode/shortcode-heading.php' ); ?>
					<div class="plutus-index-items">
						<?php
						/* Start the Loop */
						while ( $result_query->have_posts() ) : $result_query->the_post();
							plutus_recipe_get_template( 'recipe-index-shortcode/item-content-' . esc_attr( $atts['style'] ) . '.php' );
						endwhile;
						?>
					</div>
					<?php
					if ( 'bottom' == $atts['view_more_pos'] && $atts['view_more_link'] && $atts['view_more_text'] ) {
						echo '<div class="plutus-recipeI-btn-wrap">';
						echo '<a class="plutus-recipeI-button button" href="' . esc_url( $atts['view_more_link'] ) . '" target="_bank">' . do_shortcode( $atts['view_more_text'] ) . '</a>';
						echo '</div>';
					}
					?>
				</div>
				<?php
				$css = '';
				if ( $atts['row_gap'] ) {
					$css .= '#' . $id_sc . ' .plutus-index-items .plutus-recipeI-item{ margin-top:' . esc_attr( $atts['row_gap'] ) . 'px ; }';
					$css .= '#' . $id_sc . ' .plutus-index-items{ margin-top:-' . esc_attr( $atts['row_gap'] ) . 'px; }';
				}
				if ( $atts['col_gap'] ) {
					$col_gap = intval( $atts['row_gap'] ) / 2;
					$css     .= '#' . $id_sc . ' .plutus-index-items .plutus-recipeI-item{ padding-left:' . esc_attr( $col_gap ) . 'px ;; padding-right:' . esc_attr( $col_gap ) . 'px ;; }';
					$css     .= '#' . $id_sc . ' .plutus-index-items{ margin-left:-' . esc_attr( $col_gap ) . 'px; margin-right:-' . esc_attr( $col_gap ) . 'px; }';
				}

				if ( $css ) {
					echo '<style>' . $css . '</style>';
				}
				?>
			</div>
			<?php
			wp_reset_postdata();
			do_action( 'plutus_recipe_index_shortcode/end_shortcode' );

			$output = ob_get_clean();

			unset( $plutus_recipeIndex_datas );

			return $output;
		}

		public static function get_thumb_shortcode( $datas ) {
			$attr_thumbnail = array(
				'image_type' => $datas['image_type'],
				'image_size' => $datas['image_size'],
			);

			echo '<div class="plutus-rIndex-pthumb">';
			plutus_recipe_get_post_thumbnail( $attr_thumbnail );
			echo '</div>';
		}

		/**
		 * Use setting come from Customize
		 *
		 * @param $atts
		 *
		 * @return mixed
		 */
		public static function update_shortcode_atts( $atts ) {
			$recipe_style  = plutus_recipe_get_option( 'plutus_recipeI_style' );
			$image_type    = plutus_recipe_get_option( 'plutus_recipeI_imgtype' );
			$image_size    = plutus_recipe_get_option( 'plutus_recipeI_imgsize' );
			$show_pcat     = plutus_recipe_get_option( 'plutusRecipeI_show_pcat' );
			$hide_pauthor  = plutus_recipe_get_option( 'plutusRecipeI_hide_pauthor' );
			$hide_pdate    = plutus_recipe_get_option( 'plutusRecipeI_hide_pdate' );
			$hide_img      = plutus_recipe_get_option( 'plutusRecipeI_hide_img' );
			$titleUpper    = plutus_recipe_get_option( 'plutusRecipeI_titleUpper' );
			$vMorePos      = plutus_recipe_get_option( 'plutus_recipeI_vMorePos' );
			$viewall_label = plutus_recipe_get_option( 'plutus_recipe_viewall_label' );
			$row_gap       = plutus_recipe_get_option( 'plutus_recipeI_rowGap' );
			$col_gap       = plutus_recipe_get_option( 'plutus_recipeI_ColGap' );

			if ( ! $atts['style'] ) {
				$atts['style'] = $recipe_style;
			}
			if ( ! $atts['image_type'] ) {
				$atts['image_type'] = $image_type;
			}
			if ( ! $atts['image_size'] ) {
				$atts['image_size'] = $image_size;
			}
			if ( ! $atts['show_pcat'] || '' ) {
				$atts['show_pcat'] = $show_pcat;
			}
			if ( ! $atts['hide_pauthor'] ) {
				$atts['hide_pauthor'] = $hide_pauthor;
			}
			if ( ! $atts['hide_pdate'] ) {
				$atts['hide_pdate'] = $hide_pdate;
			}
			if ( ! $atts['hide_pimg'] ) {
				$atts['hide_pimg'] = $hide_img;
			}
			if ( ! $atts['titleofupper'] ) {
				$atts['titleofupper'] = $titleUpper;
			}

			if ( ! $atts['view_more_pos'] ) {
				$atts['view_more_pos'] = $vMorePos;
			}
			if ( ! $atts['view_more_text'] ) {
				$atts['view_more_text'] = $viewall_label;
			}

			if ( ! $atts['row_gap'] ) {
				$atts['row_gap'] = $row_gap;
			}
			if ( ! $atts['col_gap'] ) {
				$atts['col_gap'] = $col_gap;
			}

			return $atts;
		}

		public static function error( $title, $mess, $class = '' ) {
			if ( ! $mess || ! is_user_logged_in() ) {
				return;
			}
			echo '<div class="plutus-missing-settings ' . $class . '"><span class="plutus-mess-title">' . $title . '</span><span class="plutus-mess-ctent">' . $mess . '</span></div>';
		}
	}

	add_shortcode( 'plutus_recipe_index', array( 'Class_Plutus_Recipe_Index_Shortcode', 'plutus_recipe_func' ) );
endif;