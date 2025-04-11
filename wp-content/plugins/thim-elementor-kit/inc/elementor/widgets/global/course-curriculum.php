<?php

namespace Elementor;

use LearnPress\Models\UserModel;
use LearnPress\Models\CourseModel;
use LearnPress\TemplateHooks\Course\SingleCourseTemplate;
use Thim_EL_Kit\GroupControlTrait;

class Thim_Ekit_Widget_Course_Curriculum extends Widget_Base {
	use GroupControlTrait;

	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
		$this->add_script_depends( 'lp-curriculum' );
	}

	public function get_name() {
		return 'thim-ekits-course-curricilum';
	}

	public function get_title() {
		return esc_html__( 'Course Curriculum', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'thim-eicon eicon-post-list';
	}

	public function get_categories() {
		return array( \Thim_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE, \Thim_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE_ITEM );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'curriculum_info',
			array(
				'label' => esc_html__( 'Info', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Curriculum', 'thim-elementor-kit' ),
				'name'     => 'curriculum_typo',
				'selector' => '{{WRAPPER}} .lp-course-curriculum__title',
			)
		);
		$this->add_responsive_control(
			'curriculum_margin',
			array(
				'label'      => esc_html__( 'Margin', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::DIMENSIONS,
				'size_units' => array( 'px', 'em' ),
				'selectors'  => array(
					'{{WRAPPER}} .lp-course-curriculum__title' => 'margin: {{TOP}}{{UNIT}} {{RIGHT}}{{UNIT}} {{BOTTOM}}{{UNIT}} {{LEFT}}{{UNIT}};',
				),
			)
		);
		$this->add_group_control(
			Group_Control_Typography::get_type(),
			array(
				'label'    => esc_html__( 'Toggle', 'thim-elementor-kit' ),
				'name'     => 'toggle_typo',
				'selector' => '{{WRAPPER}} .course-curriculum-info__right',
			)
		);
		$this->add_control(
			'toggle_color',
			array(
				'label'     => esc_html__( 'Color Toggle', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .course-curriculum-info__right' => 'color: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'toggle_color_hover',
			array(
				'label'     => esc_html__( 'Color Hover', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .course-curriculum-info__right:hover' => 'color: {{VALUE}}',
				),
			)
		);
		$this->end_controls_section();
		$this->register_style_content();

	}
	protected function register_style_content(){
		$this->start_controls_section(
			'section_curriculum_style_new',
			array(
				'label' => esc_html__( 'Content', 'thim-elementor-kit' ),
				'tab'   => Controls_Manager::TAB_STYLE,
			)
		);

		$this->add_responsive_control(
			'curriculum_max_height',
			array(
				'label'      => esc_html__( 'Max Height', 'thim-elementor-kit' ),
				'type'       => Controls_Manager::SLIDER,
				'size_units' => array( 'px', '%', 'em', 'vh', 'custom' ),
				'default'    => array(
					'unit' => 'vh',
					'size' => 80,
				),
				'selectors'  => array(
					'{{WRAPPER}} .lp-course-curriculum' => '--thim-curriculum-popup-max-height: {{SIZE}}{{UNIT}}',
				),
			)
		);
		$this->_register_setting_curriculum();
		$this->add_control(
			'status_completed_color',
			array(
				'label'     => esc_html__( 'Completed Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lp-course-curriculum' => '--thim-curriculum-status-completed: {{VALUE}}',
					'{{WRAPPER}} .course-curriculum' => '--thim-curriculum-bg-status-completed: {{VALUE}}',
				),
			)
		);
		$this->add_control(
			'status_failed_color',
			array(
				'label'     => esc_html__( 'Failed Color', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::COLOR,
				'selectors' => array(
					'{{WRAPPER}} .lp-course-curriculum' => '--thim-curriculum-status-failed: {{VALUE}}',
					'{{WRAPPER}} .course-curriculum' => '--thim-curriculum-bg-status-failed: {{VALUE}}',
				),
			)
		);

		$this->end_controls_section();
	}

	public function render() {
		do_action( 'thim-ekit/modules/single-course/before-preview-query' );

		$course_model = CourseModel::find( get_the_ID(), true );
		if ( ! $course_model ) {
			return;
		}

		$user = UserModel::find( get_current_user_id(), true );

		$singleCourseTemplate = SingleCourseTemplate::instance();

		?>

		<div class="thim-ekit-single-course__curriculum">
			<?php
			if ( is_callable( [ $singleCourseTemplate, 'html_curriculum' ] ) ) {
				echo $singleCourseTemplate->html_curriculum( $course_model, $user );
			}
			?>
		</div>

		<?php

		do_action( 'thim-ekit/modules/single-course/after-preview-query' );
	}
}
