<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Plutus_El_Recipe_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'plutus_recipe';
	}

	public function get_title() {
		return esc_html__( 'Plutus Recipe', 'plutus-recipe-pro' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'plutus-recipe-pro' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'post_id',
			array(
				'label'       => __( 'Post ID', 'plutus-recipe-pro' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'input_type'  => 'post_id',
				'description' => esc_html__( 'Leave blank to use the ID of the current post', 'plutus-recipe-pro' ),
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {
		$settings = $this->get_settings_for_display();
		$post_ID  = ( isset( $settings['postID'] ) && $settings['postID'] ) ? $settings['postID'] : get_the_ID();
		echo do_shortcode( '[plutus_recipe post_id="' . $post_ID . '"]' );
	}

}

class Plutus_El_Recipe_Index_Widget extends \Elementor\Widget_Base {
	public function get_name() {
		return 'plutus_recipe_index';
	}

	public function get_title() {
		return esc_html__( 'Plutus Recipe Index', 'plutus-recipe-pro' );
	}

	public function get_icon() {
		return 'fa fa-code';
	}

	public function get_categories() {
		return array( 'general' );
	}

	protected function _register_controls() {

		$this->start_controls_section(
			'content_section',
			array(
				'label' => __( 'Content', 'plutus-recipe-pro' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$this->add_control(
			'style', array(
				'label'   => __( 'Choose Skin', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''          => __( 'Default from Customize', 'plutus-recipe-pro' ),
					's1' => esc_html__( 'Style 1', 'plutus-recipe-pro' ),
					's2' => esc_html__( 'Style 2', 'plutus-recipe-pro' ),
					's3' => esc_html__( 'Style 3', 'plutus-recipe-pro' ),
					's4' => esc_html__( 'Style 4', 'plutus-recipe-pro' ),
				)
			)
		);
		$this->add_control(
			'title', array(
				'label'   => __( 'Title', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => __( 'Recipe Index', 'plutus-recipe-pro' ),
			)
		);
		$this->add_control(
			'cat', array(
				'label'   => __( 'Category Slug', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::TEXT,
				'default' => '',
			)
		);
		$this->add_control(
			'ppp', array(
				'label'   => __( 'Numbers Item to Show', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::NUMBER,
				'default' => 6,
			)
		);
		$this->add_control(
			'columns', array(
				'label'   => __( 'Select Layout', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '2cols',
				'options' => array(
					'2cols' => esc_html__( '2 Columms', 'plutus-recipe-pro' ),
					'3cols' => esc_html__( '3 Columms', 'plutus-recipe-pro' ),
					'4cols' => esc_html__( '4 Columms', 'plutus-recipe-pro' ),
				)
			)
		);
		$this->add_control(
			'show_pcat', array(
				'label'     => esc_html__( 'Show Category', 'plutus-recipe-pro' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'plutus-recipe-pro' ),
				'label_off' => __( 'No', 'plutus-recipe-pro' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'hide_pauthor', array(
				'label'     => esc_html__( 'Hide Author', 'plutus-recipe-pro' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'plutus-recipe-pro' ),
				'label_off' => __( 'No', 'plutus-recipe-pro' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'hide_pdate', array(
				'label'     => esc_html__( 'Hide Date', 'plutus-recipe-pro' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'plutus-recipe-pro' ),
				'label_off' => __( 'No', 'plutus-recipe-pro' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'titleofupper', array(
				'label'     => esc_html__( 'Turn off Uppercase for Title Items', 'plutus-recipe-pro' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'plutus-recipe-pro' ),
				'label_off' => __( 'No', 'plutus-recipe-pro' ),
				'default'   => '',
			)
		);
		$this->add_control(
			'hide_pimg', array(
				'label'     => esc_html__( 'Hide Image', 'plutus-recipe-pro' ),
				'type'      => \Elementor\Controls_Manager::SWITCHER,
				'label_on'  => __( 'Yes', 'plutus-recipe-pro' ),
				'label_off' => __( 'No', 'plutus-recipe-pro' ),
				'default'   => '',
			)
		);

		$this->add_control(
			'image_type', array(
				'label'   => esc_html__( 'Image Type', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''          => __( 'Default from Customize', 'plutus-recipe-pro' ),
					'square'    => __( 'Square', 'plutus-recipe-pro' ),
					'landscape' => __( 'Landscape', 'plutus-recipe-pro' ),
					'vertical'  => __( 'Vertical', 'plutus-recipe-pro' ),
				),
			)
		);
		$this->add_control(
			'image_size', array(
				'label'   => esc_html__( 'Image Size', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => plutus_recipe_choices_image_sizes( true ),
			)
		);
		$this->add_control(
			'view_more_pos', array(
				'label'   => esc_html__( 'Position for "View All" button', 'plutus-recipe-pro' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => '',
				'options' => array(
					''       => __( 'Default from Customize', 'plutus-recipe-pro' ),
					'top'    => __( 'Top', 'plutus-recipe-pro' ),
					'bottom' => __( 'Bottom', 'plutus-recipe-pro' ),
				),
			)
		);
		$this->add_control(
			'view_more_link',
			array(
				'label'       => __( 'Link for "View All" button', 'plutus-recipe-pro' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'https://your-link.com', 'plutus-recipe-pro' ),
			)
		);
		$this->add_control(
			'view_more_text',
			array(
				'label'       => __( 'Text for "View All" button', 'plutus-recipe-pro' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'placeholder' => __( 'View All', 'plutus-recipe-pro' ),
			)
		);

		$this->add_control(
			'row_gap', array(
				'label'     => __( 'Rows Gap', 'plutus-recipe-pro' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
			)
		);
		$this->add_control(
			'col_gap', array(
				'label'     => __( 'Columns Gap', 'plutus-recipe-pro' ),
				'type'      => \Elementor\Controls_Manager::NUMBER,
			)
		);

		$this->end_controls_section();

	}

	/**
	 * Render oEmbed widget output on the frontend.
	 *
	 * Written in PHP and used to generate the final HTML.
	 *
	 * @since 1.0.0
	 * @access protected
	 */
	protected function render() {

		$settings = $this->get_settings_for_display();

		if ( $settings ) {

			$param = '';
			foreach ( (array) $settings as $k => $v ) {
				if( is_array( $v ) ) {
					continue;
				}

				if ( in_array( $k, array( 'show_pcat', 'hide_pauthor', 'hide_pdate', 'hide_pimg', 'hide_viewMore','titleofupper' ) ) ) {
					$param .= ' ' . $k . '="' . ( $v ? 'yes' : '' ) . '"';
				} elseif ( $v ) {
					$param .= ' ' . $k . '="' . $v . '"';
				}
			}
		}

		echo do_shortcode( '[plutus_recipe_index' . $param . ']' );

	}

}