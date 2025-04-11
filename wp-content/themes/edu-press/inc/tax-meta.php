<?php

if ( is_admin() ) {

	$prefix = 'thim_';

	$config = array(
		'id'             => 'category_meta_box',
		'title'          => esc_html__( 'Category Meta Box', 'edu-press' ),
		'pages'          => array( 'course_category', 'category' ),
		'context'        => 'normal',
		'fields'         => array(),
		'local_images'   => false,
		'use_with_theme' => get_template_directory_uri() . '/inc/libs/Tax-meta-class'
	);

	$thim_tps = new Tax_Meta_Class( $config );

	$cate_prefix = 'learnpress_cate_';

	$thim_tps->addImage( $prefix . $cate_prefix . 'icon', array( 'name' => __( 'Icon', 'edu-press' ), 'std' => array() ) );

	$thim_tps->Finish();
}
