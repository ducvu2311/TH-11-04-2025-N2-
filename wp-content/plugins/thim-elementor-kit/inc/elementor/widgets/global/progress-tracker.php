<?php

namespace Elementor;

// If this file is called directly, abort.
use Thim_EL_Kit\GroupControlTrait;

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

class Thim_Ekit_Widget_Progress_Tracker extends Widget_Base {
	use GroupControlTrait;

    public function get_name() {
		return 'thim-ekits-progress-tracker';
	}

	public function get_title() {
		return esc_html__( 'Progress Tracker', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'thim-eicon eicon-progress-tracker';
	}

	public function get_categories() {
		return array( \Thim_EL_Kit\Elementor::CATEGORY );
	}

	public function get_keywords() {
		return [
			'progress',
			'line',
			'scroll',
		];
	}

    protected function register_controls() {
        $this->start_controls_section(
			'section_content_list',
			array(
				'label' => esc_html__( 'Progress Tracker', 'thim-elementor-kit' ),
			)
		);

        $this->add_control(
			'progress-tracker-direction',
			array(
				'label'       => esc_html__( 'Direction', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::CHOOSE,
				'toggle'      => false,
				'default'     => 'left',
				'options'     => array(
					'left'  => array(
						'title' => esc_html__( 'Left', 'thim-elementor-kit' ),
						'icon'  => 'eicon-h-align-left',
					),
					'right' => array(
						'title' => esc_html__( 'Right', 'thim-elementor-kit' ),
						'icon'  => 'eicon-h-align-right',
					),
				),
				'prefix_class' => 'thim-ekits-progress-tracker-direction-'
			)
		);

        $this->add_control(
			'percentage',
			[
				'label'       => esc_html__( 'Percentage', 'thim-elementor-kit' ),
				'type'        => Controls_Manager::SWITCHER,
				'label_on'     => esc_html__( 'Show', 'thim-elementor-kit' ),
				'label_off'    => esc_html__( 'Hide', 'thim-elementor-kit' ),
				'default'     => 'no',
			]
		);

        $this->end_controls_section();

        $this->register_section_style();
    }

    protected function register_section_style() {
        $this->start_controls_section(
			'style_tracker',
			array(
				'label' => esc_html__( 'Tracker', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

        $this->add_responsive_control(
			'progress_size',
			array(
				'label'     => esc_html__( 'Size', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SLIDER,
				'range'     => array(
					'px' => array(
						'min' => 0,
						'max' => 100,
					),
				),
                'selectors' => array(
					'{{WRAPPER}} .thim-ekits-scrollProgressContainer ' => 'height: {{SIZE}}{{UNIT}};',
				),
			)
		);

        $this->add_control(
			'progress_indicatior_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-scrollProgressContainer' => 'background-color: {{VALUE}}',
				),
			)
		);

        $this->add_control(
			'tracker_background_heading',
			array(
				'label'     => esc_html__( 'Tracker Background', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::HEADING,
				'separator' => 'before',
			)
		);

        $this->add_group_control(
            \Elementor\Group_Control_Background::get_type(),
            array(
                'name' => 'tracker_background',
                'label' => esc_html__( 'Tracker Background', 'thim-elementor-kit' ),
                'types' => [ 'classic', 'gradient' ],
                'selector' => '{{WRAPPER}} .thim-ekits-scrollProgressBar',
            )
        );

        $this->end_controls_section();

        $this->start_controls_section(
			'style_content',
			array(
				'label' => esc_html__( 'Percentage', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
                'condition' => array(
					'percentage' => 'yes',
				),
			)
		);

        $this->add_responsive_control(
			'alignment',
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
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-scrollProgressBar ' => 'text-align: {{VALUE}}',
				),
			)
		);

        $this->add_control(
			'percentage_color',
			array(
				'label'     => esc_html__( 'Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-scrollPercentage' => 'background-color: {{VALUE}}',
				),
			)
		);

        $this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Typography', 'thim-elementor-kit' ),
				'name'     => 'percentage_typography',
				'selector' => '{{WRAPPER}} .thim-ekits-scrollPercentage',
			)
		);

        $this->add_control(
			'percentage_margin',
			array(
				'label'     => esc_html__( 'Margin', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::DIMENSIONS,
				'separator' => 'before',
				'selectors' => array(
					'{{WRAPPER}} .thim-ekits-scrollPercentage' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);

        $this->end_controls_section();
    }

    protected function render() {
		$settings = $this->get_settings_for_display();

        ?>
        <div class="thim-ekits-scrollProgressContainer">
            <div class="thim-ekits-scrollProgressBar">
                <?php if ( $settings['percentage'] == 'yes' ) : ?>
                    <div class="thim-ekits-scrollPercentage">0%</div>
                <?php endif; ?>
            </div>
        </div>
        <?php
    }
}
