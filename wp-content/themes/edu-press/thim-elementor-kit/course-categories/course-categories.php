<?php

namespace Elementor;

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Ekit_Widget_Course_Categories extends Widget_Base {

	public function get_name() {
		return 'thim-ekits-course-categories';
	}

	public function get_title() {
		return esc_html__( 'Course Categories', 'edu-press' );
	}

	public function get_icon() {
		return 'thim-widget-icon eicon-table-of-contents';
	}

	public function get_categories() {
		return array( \Thim_EL_Kit\Elementor::CATEGORY );
	}

	protected function register_controls() {
		$this->start_controls_section(
			'content',
			[
				'label' => __( 'Course Categories', 'edu-press' )
			]
		);

		$this->add_control(
			'limit',
			[
				'label'   => esc_html__( 'Limit categories', 'edu-press' ),
				'type'    => Controls_Manager::NUMBER,
				'default' => 8,
				'min'     => 1,
				'step'    => 1,
			]
		);

		$this->add_responsive_control(
			'columns',
			array(
				'label'          => esc_html__( 'Columns', 'edu-press' ),
				'type'           => Controls_Manager::SELECT,
				'default'        => '3',
				'tablet_default' => '2',
				'mobile_default' => '1',
				'options'        => array(
					'1' => '1',
					'2' => '2',
					'3' => '3',
					'4' => '4',
					'5' => '5',
				),
				'selectors'      => array(
					'{{WRAPPER}}' => '--thim-ekits-course-categories__item: repeat({{VALUE}}, 1fr)',
				),
			)
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'item_settings',
			[
				'label' => esc_html__( 'Content', 'edu-press' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'item_padding',
			array(
				'label'      => esc_html__( 'Padding', 'edu-press' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .thim-ekits-course-categories__item' => 'padding: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->add_control(
			'item_border_radius',
			array(
				'label'      => esc_html__( 'Border Radius', 'edu-press' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', '%' ),
				'selectors'  => array(
					'{{WRAPPER}} .thim-ekits-course-categories__item ' => 'border-radius: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

		$this->start_controls_tabs(
			'item_content'
		);

		$this->start_controls_tab(
			'item_content_normal',
			array(
				'label' => esc_html__( 'Normal', 'edu-press' ),
			)
		);

		$this->add_control(
			'item_bg_color',
			[
				'label'     => esc_html__( 'background Color', 'edu-press' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .thim-ekits-course-categories__item' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->start_controls_tab(
			'item_content_hover',
			array(
				'label' => esc_html__( 'Hover', 'edu-press' ),
			)
		);

		$this->add_control(
			'item_bg_color_hover',
			[
				'label'     => esc_html__( 'background Color', 'edu-press' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .thim-ekits-course-categories__item:hover' => 'background-color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_tab();

		$this->end_controls_tabs();

		$this->end_controls_section();

		$this->start_controls_section(
			'title_settings',
			[
				'label' => esc_html__( 'Title', 'edu-press' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_responsive_control(
			'title_margin',
			[
				'label'      => esc_html__( 'Margin', 'edu-press' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => [ 'px', 'em', '%' ],
				'selectors'  => [
					'{{WRAPPER}} .thim-ekits-course-categories__item .title ' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				],
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'title_typography',
				'label'    => esc_html__( 'Typography', 'edu-press' ),
				'selector' => '{{WRAPPER}} .thim-ekits-course-categories__item .title',
			]
		);

		$this->add_control(
			'title_color',
			[
				'label'     => esc_html__( 'Title Color', 'edu-press' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .thim-ekits-course-categories__item .title' => 'color: {{VALUE}};'
				],
			]
		);

		$this->add_control(
			'title_color_hover',
			[
				'label'     => esc_html__( 'Title Color Hover', 'edu-press' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .thim-ekits-course-categories__item:hover .title'   => 'color: {{VALUE}};',
					'{{WRAPPER}} .thim-ekits-course-categories__item:hover .title a' => 'color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'count_settings',
			[
				'label' => esc_html__( 'Count', 'edu-press' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			]
		);

		$this->add_group_control(
			Group_Control_Typography::get_type(),
			[
				'name'     => 'count_typography',
				'label'    => esc_html__( 'Typography', 'edu-press' ),
				'selector' => '{{WRAPPER}} .thim-ekits-course-categories__item .count',
			]
		);

		$this->add_control(
			'count_color',
			[
				'label'     => esc_html__( 'Count Color', 'edu-press' ),
				'type'      => Controls_Manager::COLOR,
				'default'   => '',
				'selectors' => [
					'{{WRAPPER}} .thim-ekits-course-categories__item .count' => 'color: {{VALUE}};'
				],
			]
		);

		$this->end_controls_section();

		$this->start_controls_section(
			'section_design_layout',
			array(
				'label' => esc_html__( 'Layout', 'edu-press' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'column_gap',
			array(
				'label'              => esc_html__( 'Columns Gap', 'edu-press' ),
				'type'               => Controls_Manager::SLIDER,
				'default'            => array(
					'size' => 30,
				),
				'range'              => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'frontend_available' => true,
				'selectors'          => array(
					'{{WRAPPER}}' => '--thim-ekits-course-categories-column-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->add_responsive_control(
			'row_gap',
			array(
				'label'     => esc_html__( 'Rows Gap', 'edu-press' ),
				'type'      => Controls_Manager::SLIDER,
				'default'   => array(
					'size' => 30,
				),
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
				'selectors' => array(
					'{{WRAPPER}}' => '--thim-ekits-course-categories-row-gap: {{SIZE}}{{UNIT}}',
				),
			)
		);

		$this->end_controls_section();
	}

	protected function render() {
		$settings = $this->get_settings_for_display();

		$taxonomy = 'course_category';

		$args_cat = array(
			'taxonomy' => $taxonomy,
		);

		$cat_course = get_categories( $args_cat );
		$limit      = $settings['limit'];

		$html = '';
		if ( $cat_course ) {
			$index = 1;
			$html  = '<div class="thim-ekits-course-categories">';
			foreach ( $cat_course as $key => $value ) {

				$html .= '<div class="thim-ekits-course-categories__item">';
				$icon = array();
				if ( get_term_meta( $value->term_id, 'thim_learnpress_cate_icon', true ) ) {
					$icon = get_term_meta( $value->term_id, 'thim_learnpress_cate_icon', true );
				}
				if ( ! empty( $icon ) ) {
					$html .= '<img alt="' . $value->name . '" src="' . $icon['url'] . '">';
				}
				$html .= '<h4 class="title"><a href="' . esc_url( get_term_link( (int) $value->term_id, $taxonomy ) ) . '">' . $value->name . '</a></h4>';
				$html .= '<span class="count">' . $value->count . esc_html__( ' Courses ', 'edu-press' ) . ' </span>';
				$html .= '</div>';
				if ( $index == $limit ) {
					break;
				}
				$index ++;
			}
			$html .= '</div>';
		}

		echo ent2ncr( $html );
	}
}
