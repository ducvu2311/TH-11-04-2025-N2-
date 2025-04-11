<?php
function thim_get_all_plugins_require() {
	return array(
		array(
			'name' => 'Contact Form 7',
			'slug' => 'contact-form-7',
			'required' => false,
		),
		array(
			'name'     => 'LearnPress',
			'slug'     => 'learnpress',
			'required' => false,
		),
		array(
			'name'     => 'Elementor Page Builder',
			'slug'     => 'elementor',
			'required' => false,
			'icon'     => 'https://ps.w.org/elementor/assets/icon-128x128.gif'
		),
		array(
			'name'       => 'Thim Elementor Kit',
			'slug'       => 'thim-elementor-kit',
			'required' => false,
		),

	);
}

add_filter( 'thim_core_get_all_plugins_require', 'thim_get_all_plugins_require' );

/**
 * Theme id.
 */
if ( ! function_exists( 'thim_my_theme_item_id' ) ) {
	function thim_my_theme_item_id() {
		return '2191';
	}
}
add_filter( 'thim_core_my_theme_id', 'thim_my_theme_item_id' );
