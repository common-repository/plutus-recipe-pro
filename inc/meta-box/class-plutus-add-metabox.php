<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Register a meta box using a class.
 */
class Plutus_Add_MetaBox {

	/**
	 * Meta box parameters.
	 *
	 * @var array
	 */
	public $meta_box;

	/**
	 * Constructor.
	 */
	public function __construct( $meta_box ) {
		if ( ! $meta_box ) {
			return;
		}

		$this->meta_box = $meta_box;

		if ( is_admin() ) {
			add_action( 'load-post.php', array( $this, 'init_metabox' ) );
			add_action( 'load-post-new.php', array( $this, 'init_metabox' ) );
		}
	}

	/**
	 * Meta box initialization.
	 */
	public function init_metabox() {
		add_action( 'add_meta_boxes', array( $this, 'add_metabox' ) );
		add_action( 'save_post', array( $this, 'save_metabox' ), 10, 2 );
	}

	/**
	 * Adds the meta box.
	 */
	public function add_metabox() {

		$metabox = $this->meta_box;

		if ( isset( $metabox['fields'] ) ) {
			unset( $metabox['fields'] );
		}

		add_meta_box(
			$metabox['id'],
			$metabox['title'],
			array( $this, 'render_metabox' ),
			$metabox['post_types'],
			$metabox['context'],
			$metabox['priority']
		);

	}

	/**
	 * Renders the meta box.
	 */
	public function render_metabox( $post ) {

		$metabox = $this->meta_box;
		$tabs    = isset( $metabox['tabs'] ) ? $metabox['tabs'] : array();

		$fields = isset( $metabox['fields'] ) ? $metabox['fields'] : array();

		if ( ! $fields ) {
			return;
		}

		echo '<div class="plutus-metabox-wrap">';

		if ( $tabs ) {
			echo '<ul class="plutus-metabox-tabs">';
			$i = 0;
			foreach ( $tabs as $key => $tab_data ) {
				$class = "tab-$key";
				if ( ! $i ) {
					$class .= ' tab-active';
				}
				printf(
					'<li class="%s" data-panel="%s"><a href="#">%s%s</a></li>',
					esc_attr( $class ),
					esc_attr( $key ),
					$tab_data['icon'] ? '<i class="' . esc_attr( $tab_data['icon'] ) . '"></i>' : '',
					$tab_data['label'] ? $tab_data['label'] : ''
				);

				$i ++;
			} // End foreach().
			echo '</ul>';

			$group_tabs = array();
			foreach ( (array) $fields as $field ) {
				if ( ! isset( $field['tab'] ) ) {
					continue;
				}

				$tab_key = $field['tab'];

				$group_tabs[ $tab_key ][] = $field;
			}

			echo '<div class="plutus-metabox-fields">';
			foreach ( (array) $group_tabs as $tab => $fields ) {

				echo '<div class="plutus-tab-panel plutus-tab-panel-' . esc_attr( $tab ) . '">';
				foreach ( (array) $fields as $field ) {
					Plutus_MetaBox_Fields::html_field( $field, $post->ID );
				}
				echo '</div>';
			}
			echo '</div>';
		} else {
			echo '<div class="plutus-metabox-fields">';
			foreach ( (array) $fields as $field ) {
				Plutus_MetaBox_Fields::html_field( $field, $post->ID );
			}
			echo '</div>';
		}


		echo '</div>';
	}


	/**
	 * Save the meta when the post is saved.
	 *
	 * @param $post_id
	 *
	 * @return mixed
	 */
	public function save_metabox( $post_id ) {

		$metabox = $this->meta_box;

		$fields = isset( $metabox['fields'] ) ? $metabox['fields'] : array();
		if ( ! $fields ) {
			return;
		}

		$data_recipe = array(
			'plutus_recipe_rating'        => '',
			'plutus_recipe_rating_people' => '',
			'plutus_recipe_rating_total'  => ''
		);
		foreach ( (array) $fields as $field ) {
			if ( ! isset( $field['id'] ) ) {
				continue;
			}

			$field_id                 = $field['id'];
			$value_field              = isset( $_POST[ $field_id ] ) ? sanitize_text_field( $_POST[ $field_id ] ) : '';
			$data_recipe[ $field_id ] = ( $value_field );
		}

		if( !$data_recipe['plutus_recipe_rating_people'] ) {
			$data_recipe['plutus_recipe_rating_people'] = 1;
		}

		if( !$data_recipe['plutus_recipe_rating_total']  && $data_recipe['plutus_recipe_rating'] ) {
			$data_recipe['plutus_recipe_rating_total'] = $data_recipe['plutus_recipe_rating'];
		}

		update_post_meta( $post_id, 'plutus_recipe_data', $data_recipe );
	}
}