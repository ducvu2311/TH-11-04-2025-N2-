<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;

class Thim_Ekit_Widget_Course_Rating extends Widget_Base {

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'thim-ekits-course-rating';
	}

	public function get_title() {
		return esc_html__( ' Course Rating', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'thim-eicon eicon-rating';
	}

	public function get_categories() {
		return array( \Thim_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_content',
			array(
				'label' => esc_html__( 'Content', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'title',
			array(
				'label'   => esc_html__( 'Title', 'thim-elementor-kit' ),
				'type'    => Controls_Manager::TEXT,
				'default' => 'Review',
			)
		);
		$this->add_control(
			'show_total',
			array(
				'label'        => esc_html__( 'Total Rating', 'thim-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'thim-elementor-kit' ),
				'label_off'    => esc_html__( 'Hide', 'thim-elementor-kit' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->add_control(
			'show_number',
			array(
				'label'        => esc_html__( 'Number Rating', 'thim-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'thim-elementor-kit' ),
				'label_off'    => esc_html__( 'Hide', 'thim-elementor-kit' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);
		$this->end_controls_section();

		$this->start_controls_section(
			'section_star_style',
			array(
				'label' => esc_html__( 'Star', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_control(
			'star_color',
			array(
				'label'     => esc_html__( 'Star Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}}'    => '--thim-rating-star-color: {{VALUE}};',
					'{{WRAPPER}} .course-rate__summary .fas svg' => 'fill: {{VALUE}};',
					'{{WRAPPER}} .course-rate__summary .far svg' => 'stroke: {{VALUE}};',
				),
			)
		);
		$this->add_responsive_control(
			'star_size',
			array(
				'label'      => esc_html__( 'Star Size', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em' ),
				'range'      => array(
					'px' => array(
						'min'  => 1,
						'max'  => 100,
						'step' => 1,
					),
				),
				'selectors'  => array(
					'{{WRAPPER}} .course-rate__summary svg' => 'max-width: {{SIZE}}{{UNIT}}; height: auto',
				),
			)
		);

		$this->add_control(
			'one_star',
			array(
				'label'        => esc_html__( 'One Star', 'thim-elementor-kit' ),
				'type'         => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'On', 'thim-elementor-kit' ),
				'label_off'    => esc_html__( 'Off', 'thim-elementor-kit' ),
				'return_value' => 'yes',
				'default'      => 'no',
			)
		);

		$this->add_control(
			'one_star_margin',
			array(
				'label'     => esc_html__( 'Space', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => '',
				'selectors' => array(
					'body.rtl {{WRAPPER}} .course-rate__summary-value'       => 'margin-right: {{VALUE}}px;',
					'body:not(.rtl) {{WRAPPER}} .course-rate__summary-value' => 'margin-left: {{VALUE}}px;',
				),
				'condition' => array(
					'one_star' => 'yes',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_title_style',
			array(
				'label'     => esc_html__( 'Title', 'thim-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'title!' => '',
				),
			)
		);

		$this->add_control(
			'title_color',
			array(
				'label'     => esc_html__( 'Text Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .thim-ekit-single-course__rating__title' => 'color: {{VALUE}};',
				),
			)
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'typography',
				'selector' => '{{WRAPPER}} .thim-ekit-single-course__rating__title',
			)
		);

		$this->add_responsive_control(
			'title_margin',
			array(
				'label'      => esc_html__( 'Margin', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .thim-ekit-single-course__rating__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->end_controls_section();
		// setting total
		$this->start_controls_section(
			'section_total_style',
			array(
				'label'     => esc_html__( 'Total Rating', 'thim-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_total' => 'yes',
				),
			)
		);

		$this->add_control(
			'total_color',
			array(
				'label'     => esc_html__( 'Text Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .course-rate__summary-value' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'total_size',
				'selector' => '{{WRAPPER}} .course-rate__summary-value',
				'exclude'  => [
					'font_family',
					'text_transform',
					'font_style',
					'text_decoration',
					'letter_spacing',
					'word_spacing',
					'line_height'
				]
			)
		);

		$this->add_control(
			'total_margin',
			array(
				'label'     => esc_html__( 'Space', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => '',
				'selectors' => array(
					'body.rtl {{WRAPPER}} .course-rate__summary-value'       => 'margin-left: {{VALUE}}px;',
					'body:not(.rtl) {{WRAPPER}} .course-rate__summary-value' => 'margin-right: {{VALUE}}px;',
				),
			)
		);

		$this->end_controls_section();

		// setting total
		$this->start_controls_section(
			'section_number_style',
			array(
				'label'     => esc_html__( 'Number Rating', 'thim-elementor-kit' ),
				'tab'       => Controls_Manager::TAB_STYLE,
				'condition' => array(
					'show_number' => 'yes',
				),
			)
		);

		$this->add_control(
			'number_color',
			array(
				'label'     => esc_html__( 'Text Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .course-rate__summary-text' => 'color: {{VALUE}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'name'     => 'number_size',
				'selector' => '{{WRAPPER}} .course-rate__summary-text',
				'exclude'  => [ 'text_transform', 'text_decoration', 'letter_spacing', 'word_spacing', 'line_height' ]
			)
		);

		$this->add_control(
			'number_margin',
			array(
				'label'     => esc_html__( 'Space', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::NUMBER,
				'min'       => 0,
				'max'       => 100,
				'step'      => 1,
				'default'   => '',
				'selectors' => array(
					'body.rtl {{WRAPPER}} .course-rate__summary-text'       => 'margin-right: {{VALUE}}px;',
					'body:not(.rtl) {{WRAPPER}} .course-rate__summary-text' => 'margin-left: {{VALUE}}px;',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'thim-ekit/modules/single-course/before-preview-query' );
		$settings        = $this->get_settings_for_display();
		$course_rate_res = learn_press_get_course_rate( get_the_ID(), false );
		$total           = $course_rate_res['total'] ?? 0;
		$rated           = $course_rate_res['rated'] ?? 0;
		?>

		<div class="thim-ekit-single-course__rating">
			<?php
			if ( $settings['title'] ) { ?>
				<div class="thim-ekit-single-course__rating__title">
					<?php
					echo esc_html( $settings['title'] ); ?>
				</div>
			<?php
			} ?>

			<div class="course-rate__summary">

				<?php
				if ( $settings['one_star'] == 'yes' ) { 
					?>
					<svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" viewBox="0 0 24 24" fill="#ffb60a" stroke="#ffb60a" stroke-width="1" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-star">
						<polygon points="12 2 15.09 8.26 22 9.27 17 14.14 18.18 21.02 12 17.77 5.82 21.02 7 14.14 2 9.27 8.91 8.26 12 2"></polygon>
					</svg>
					<?php
					if ( $settings['show_total'] == 'yes' ) { ?>
						<div class="course-rate__summary-value"><?php
							echo esc_html( $rated ); ?></div>
					<?php
					}
					if ( $settings['show_number'] == 'yes' ) { ?>
						<div class="course-rate__summary-text">
							<?php
							printf( _n( '/%d rating', '/%d ratings', $total,
								'learnpress-course-review' ), $total ); ?>
						</div>
					<?php
					} 
				}else {
					if ( $settings['show_total'] == 'yes' ) { ?>
						<div class="course-rate__summary-value"><?php
							echo esc_html( $rated ); ?></div>
					<?php
					} ?>

					<?php
					learn_press_course_meta_primary_review(); ?>

					<?php
					if ( $settings['show_number'] == 'yes' ) { ?>
						<div class="course-rate__summary-text">
							<?php
							printf( _n( '(<span>%d</span> rating)', '(<span>%d</span> ratings)', $total,
								'learnpress-course-review' ), $total ); ?>
						</div>
					<?php
					} 
				} ?>

			</div>
		</div>
		<?php
		do_action( 'thim-ekit/modules/single-course/after-preview-query' );
	}

}
