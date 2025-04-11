<?php
add_filter( 'thim_ekit/elementor/widgets/list', 'register_list_shortcode' );
function register_list_shortcode( $widgets ) {
	$data = array();

	if ( class_exists( 'LearnPress' ) ) {
		$data = array_merge( $data, array(
			'course-categories',
		) );
	}

	return array_merge( $widgets, array( 'edu-press' => $data ) );
}
