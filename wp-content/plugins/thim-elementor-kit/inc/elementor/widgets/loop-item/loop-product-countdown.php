<?php

namespace Elementor;

use Elementor\Controls_Manager;
use Elementor\Group_Control_Typography;
use Thim_EL_Kit\Custom_Post_Type;
use Thim_EL_Kit\Utilities\Widget_Loop_Trait;

defined( 'ABSPATH' ) || exit;
if ( ! class_exists( '\Elementor\Thim_Ekit_Widget_Countdown' ) ) {
	include THIM_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/global/countdown.php';
}

class Thim_Ekit_Widget_Loop_Product_Countdown extends Thim_Ekit_Widget_Countdown {

	use Widget_Loop_Trait;

	public function get_name() {
		return 'thim-loop-product-countdown';
	}

	public function show_in_panel() {
		$type      = get_post_meta( get_the_ID(), Custom_Post_Type::TYPE, true );
		$post_type = get_post_meta( get_the_ID(), 'thim_loop_item_post_type', true );

		if ( ( ! empty( $post_type ) && $post_type == 'product' ) || $type == 'single-product' ) {
			return true;
		}

		return false;
	}

	public function get_title() {
		return esc_html__( 'Product Count Down', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'thim-eicon eicon-countdown';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_heading',
			array(
				'label' => esc_html__( 'Heading', 'thim-elementor-kit' ),
			)
		);
		$this->add_control(
			'heading_text',
			[
				'label'   => esc_html__( 'Text', 'thim-elementor-kit' ),
				'type'    => Controls_Manager::TEXT,
				'default' => esc_html__( '', 'thim-elementor-kit' ),
			]
		);
		$this->end_controls_section();

		$this->register_controls_label();
		$this->register_controls_style_heading();
		$this->register_controls_style_count_down();
		$this->register_controls_style_item();
	}

	protected function register_controls_style_count_down() {
		$this->start_controls_section(
			'section_general_style',
			array(
				'label' => esc_html__( 'Style Count Down', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'general_bg_color',
			array(
				'label'     => esc_html__( 'Background Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-countdown-wrapper' => 'background-color: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'general_padding',
			array(
				'label'      => esc_html__( 'Padding', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .thim-ekits-countdown-wrapper' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);
		$this->add_group_control(
			\Elementor\Group_Control_Border::get_type(),
			[
				'name'     => 'general_border',
				'selector' => '{{WRAPPER}} .thim-ekits-countdown-wrapper',
			]
		);
		$this->add_responsive_control(
			'general_border_radius',
			array(
				'label'      => esc_html__( 'Border radius', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .thim-ekits-countdown-wrapper' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),

			)
		);
		$this->end_controls_section();
	}

	protected function register_controls_style_heading() {
		$this->start_controls_section(
			'section_heading_style',
			array(
				'label' => esc_html__( 'Heading', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_responsive_control(
			'heading_align',
			array(
				'label'     => esc_html__( 'Alignment', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::CHOOSE,
				'options'   => array(
					'left'   => array(
						'title' => esc_html__( 'Left', 'thim-elementor-kit' ),
						'icon'  => 'eicon-text-align-left',
					),
					'center' => array(
						'title' => esc_html__( 'Center', 'thim-elementor-kit' ),
						'icon'  => 'eicon-text-align-center',
					),
					'right'  => array(
						'title' => esc_html__( 'Right', 'thim-elementor-kit' ),
						'icon'  => 'eicon-text-align-right',
					),
				),
				'default'   => '',
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-heading-countdown' => 'text-align: {{VALUE}};',
				),
			)
		);
		$this->add_control(
			'heading_title_color',
			array(
				'label'     => esc_html__( 'Text Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-heading-countdown' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'heading_typography',
				'selector' => '{{WRAPPER}} .thim-ekits-heading-countdown',
			)
		);
		$this->add_responsive_control(
			'heading_space',
			array(
				'label'     => esc_html__( 'Spacing(px)', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-heading-countdown' => 'margin-bottom: {{SIZE}}px;',
				),
			)
		);
		$this->end_controls_section();
	}

	protected function render() {
		$product  = wc_get_product( false );
		$settings = $this->get_settings_for_display();
		if ( ! $product ) {
			return;
		}

		if ( $product->is_on_sale() ) {
			$date_end = get_post_meta( get_the_ID(), '_sale_price_dates_to', true );
			if ( $date_end ) :
				if ( ! empty( $settings['heading_text'] ) ) {
					echo '<div class="thim-ekits-heading-countdown">' . esc_html( $settings['heading_text'] ) . '</div>';
				}
				?>
				<div class="thim-ekits-countdown-wrapper" data-date_end="<?php echo esc_attr($date_end); ?>">
					<?php
					$list_labels = [ 'days', 'hours', 'minutes', 'seconds' ];
					foreach ( $list_labels as $label ) {
						echo wp_kses_post( $this->render_countdown_item( $label ) );
					}
					?>
				</div>
			<?php
			endif;
		}
	}

	public function render_plain_content() {
	}
}
