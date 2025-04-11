<?php

namespace Elementor;

use Thim_EL_Kit\Utilities\Widget_Loop_Trait;

if ( ! class_exists( '\Elementor\Thim_Ekit_Widget_Course_Buttons' ) ) {
	include THIM_EKIT_PLUGIN_PATH . 'inc/elementor/widgets/single-course/course-buttons.php';
}


class Thim_Ekit_Widget_Loop_Course_Buttons extends Thim_Ekit_Widget_Course_Buttons {

	use Widget_Loop_Trait;

    public function __construct( $data = array(), $args = null ) { 
		parent::__construct( $data, $args );
	}

    public function get_name() {
		return 'thim-loop-course-buttons';
	}

	public function show_in_panel() {
		$post_type = get_post_meta( get_the_ID(), 'thim_loop_item_post_type', true );
		if ( ! empty( $post_type ) && $post_type == 'lp_course' ) {
			return true;
		}

		return false;
	}

	public function get_title() {
		return esc_html__( 'Item Course buttons', 'thim-elementor-kit' );
	}

	public function get_icon() {
		return 'thim-eicon eicon-button';
	}

	public function get_keywords() {
		return array( 'course', 'button' );
	}
}