<?php
/**
 * Section Blog Archive
 *
 * @package Edu_Press
 */

thim_customizer()->add_section(
	array(
		'id'       => 'blog_archive',
		'panel'    => 'blog',
		'title'    => esc_html__( 'Archive', 'edu-press' ),
		'priority' => 10,
	)
);

thim_layout_setting_customizer('blog_archive','thim_archive_');
// Excerpt Content
thim_customizer()->add_field(
	array(
		'id'       => 'thim_archive_excerpt_length',
		'type'     => 'slider',
		'label'    => esc_html__( 'Excerpt Length', 'edu-press' ),
		'tooltip'  => esc_html__( 'Choose the number of words you want to cut from the content to be the excerpt of search and archive', 'edu-press' ),
		'priority' => 11,
		'default'  => 30,
		'section'  => 'blog_archive',
		'choices'  => array(
			'min'  => '0',
			'max'  => '500',
			'step' => '5',
		),
	)
);

// Number columns
thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'thim_archive_columns_grid',
		'label'    => esc_html__( 'Column Grid', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows select column grid.', 'edu-press' ),
		'priority' => 14,
		'default'  => '2',
		'multiple' => 0,
		'section'  => 'blog_archive',
		'choices'  => array(
			'2' => esc_html__( '2', 'edu-press' ),
			'3' => esc_html__( '3', 'edu-press' ),
			'4' => esc_html__( '4', 'edu-press' ),
		),
	)
);