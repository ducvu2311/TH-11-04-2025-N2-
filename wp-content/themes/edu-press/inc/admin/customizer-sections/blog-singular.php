<?php
/**
 * Section Blog Singular
 *
 * @package Edu_Press
 */

thim_customizer()->add_section(
	array(
		'id'       => 'blog_singular',
		'panel'    => 'blog',
		'title'    => esc_html__( 'Singular', 'edu-press' ),
		'priority' => 10,
	)
);
thim_layout_setting_customizer( 'blog_singular', 'thim_archive_single_' );

thim_customizer()->add_field(
	array(
		'type'     => 'switch',
		'id'       => 'thim_archive_single_related_post',
		'label'    => esc_html__( 'Related Posts', 'edu-press' ),
		'tooltip'  => esc_html__( 'Turn on to display related posts.', 'edu-press' ),
		'default'  => true,
		'priority' => 100,
		'section'  => 'blog_singular',
		'choices'  => array(
			true  => esc_html__( 'On', 'edu-press' ),
			false => esc_html__( 'Off', 'edu-press' ),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'            => 'slider',
		'id'              => 'thim_archive_single_related_post_number',
		'label'           => esc_html__( 'Numbers of Related Post', 'edu-press' ),
		'default'         => 3,
		'priority'        => 110,
		'section'         => 'blog_singular',
		'choices'         => array(
			'min'  => 1,
			'max'  => 6,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_archive_single_related_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'type'            => 'slider',
		'id'              => 'thim_archive_single_related_post_column',
		'label'           => esc_html__( 'Column of Related', 'edu-press' ),
		'default'         => 3,
		'priority'        => 110,
		'section'         => 'blog_singular',
		'choices'         => array(
			'min'  => 1,
			'max'  => 6,
			'step' => 1,
		),
		'active_callback' => array(
			array(
				'setting'  => 'thim_archive_single_related_post',
				'operator' => '==',
				'value'    => true,
			),
		),
	)
);
