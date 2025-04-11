<?php

namespace Elementor;

use Elementor\Plugin;
use Elementor\Group_Control_Image_Size;
use Elementor\Utils;
use Thim_EL_Kit\GroupControlTrait;

if ( ! class_exists( '\Elementor\Thim_Ekits_Course_Base' ) ) {
	include THIM_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/global/course-base.php';
}

class Thim_Ekit_Widget_Course_Related extends Thim_Ekits_Course_Base {
	use GroupControlTrait;
	public function __construct( $data = array(), $args = null ) {
		parent::__construct( $data, $args );
	}

	public function get_name() {
		return 'thim-ekits-course-related';
	}

	public function get_title() {
		return esc_html__( ' Course Related', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'thim-eicon eicon-product-related';
	}

	public function get_style_depends(): array {
		return [ 'e-swiper' ];
	}
	
	public function get_categories() {
		return array( \Thim_EL_Kit\Elementor::CATEGORY_SINGLE_COURSE );
	}

	public function get_help_url() {
		return '';
	}

	protected function register_controls() {
		$this->start_controls_section(
			'section_options',
			array(
				'label' => esc_html__( 'Options', 'thim-elementor-kit' ),
			)
		);

		$this->add_control(
			'build_loop_item',
			array(
				'label'     => esc_html__( 'Build Loop Item', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SWITCHER,
				'default'   => 'no',
				'separator' => 'before',
			)
		);
		$this->add_control(
			'template_id',
			array(
				'label'     => esc_html__( 'Choose a template', 'thim-elementor-kit' ),
				'type'      => Controls_Manager::SELECT2,
				'default'   => '0',
				'options'   => array(
								   '0' => esc_html__( 'None', 'thim-elementor-kit' )
							   ) + \Thim_EL_Kit\Functions::instance()->get_pages_loop_item( 'lp_course' ),
				//				'frontend_available' => true,
				'condition' => array(
					'build_loop_item' => 'yes',
				),
			)
		);

		$this->add_control(
			'number_posts',
			array(
				'label'   => esc_html__( 'Number Post', 'thim-elementor-kit' ),
				'default' => '4',
				'type'    => Controls_Manager::NUMBER,
			)
		);
		$this->add_responsive_control(
			'columns',
			array(
				'label'     => esc_html__( 'Columns', 'thim-elementor-kit' ),
				'default'   => '4',
				'type'      => Controls_Manager::NUMBER,
				'selectors' => array(
					'{{WRAPPER}}' => '--thim-ekits-course-columns: repeat({{VALUE}}, 1fr)',
				),
			)
		);
		$this->end_controls_section();
		$this->_register_settings_slider_mobile();
		parent::register_controls();
	}

	public function render() {
		$settings   = $this->get_settings_for_display();
		$course_id  = get_the_ID();
		$query_args = array(
			'post_type'           => 'lp_course',
			'posts_per_page'      => $settings['number_posts'],
			'post__not_in'        => array( $course_id ),
			'paged'               => 1,
			'order'               => 'desc',
			'ignore_sticky_posts' => true,
		);

		$tag_ids = array();
		$tags    = get_the_terms( $course_id, 'course_tag' );

		if ( $tags ) {
			foreach ( $tags as $individual_tag ) {
				$tag_ids[] = $individual_tag->term_id;
			}
		}

		if ( $tag_ids ) {
			$query_args['tax_query'] = array(
				array(
					'taxonomy' => 'course_tag',
					'field'    => 'term_id',
					'terms'    => $tag_ids,
				),
			);
		}

		$the_query = new \WP_Query( $query_args );
		$class_inner = 'thim-ekits-course__inner';
		if ( isset( $settings['slider_mobile'] ) && $settings[ 'slider_mobile' ] == 'yes' ){
			$class_inner       .= ' thim-ekits-mobile-sliders';
		}
		?>
		<div class="thim-ekits-course">
			<div class="<?php echo esc_attr($class_inner); ?>">
				<?php
				if ( $the_query->have_posts() ) :
					while ( $the_query->have_posts() ) {
						$the_query->the_post();
						parent::render_course( $settings, 'thim-ekits-course__item' );
					}
				endif;
				wp_reset_postdata();
				?>
			</div>
		</div>
		<?php
	}
}
