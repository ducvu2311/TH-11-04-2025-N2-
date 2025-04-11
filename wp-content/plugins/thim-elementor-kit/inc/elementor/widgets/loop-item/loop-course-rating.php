<?php

namespace Elementor;

use Thim_EL_Kit\Utilities\Widget_Loop_Trait;

if ( ! class_exists( '\Elementor\Thim_Ekit_Widget_Course_Rating' ) ) {
	include THIM_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/single-course/course-rating.php';
}


class Thim_Ekit_Widget_Loop_Course_Rating extends Thim_Ekit_Widget_Course_Rating {

	use Widget_Loop_Trait;

    public function __construct( $data = array(), $args = null ) { 
		parent::__construct( $data, $args );
	}

    public function get_name() {
		return 'thim-loop-course-rating';
	}

	public function show_in_panel() {
		$post_type = get_post_meta( get_the_ID(), 'thim_loop_item_post_type', true );
		if ( ! empty( $post_type ) && $post_type == 'lp_course' ) {
			return true;
		}

		return false;
	}

	public function get_title() {
		return esc_html__( 'Item Course Rating', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'thim-eicon eicon-rating';
	}

	public function get_keywords() {
		return array( 'course', 'ratting' );
	}
}