<?php
/**
 * Section Header Layout
 *
 * @package Edu_Press
 */

thim_customizer()->add_section(
	array(
		'id'       => 'header_layout',
		'title'    => esc_html__( 'Layout', 'edu-press' ),
		'panel'    => 'header',
		'priority' => 20,
	)
);

// Select Header Size
thim_customizer()->add_field(
	array(
		'id'       => 'thim_header_size',
		'type'     => 'select',
		'label'    => esc_html__( 'Size', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you can select size layout for header layout. ', 'edu-press' ),
		'section'  => 'header_layout',
		'priority' => 15,
		'multiple' => 0,
		'default'  => 'default',
		'choices'  => array(
			'default'    => esc_html__( 'Default', 'edu-press' ),
			'full_width' => esc_html__( 'Full width', 'edu-press' ),
		),
	)
);

// Select Header Position
thim_customizer()->add_field(
	array(
		'id'       => 'header_position',
		'type'     => 'select',
		'label'    => esc_html__( 'Header Positions', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you can select position layout for header layout. ', 'edu-press' ),
		'section'  => 'header_layout',
		'priority' => 20,
		'multiple' => 0,
		'default'  => 'default',
		'choices'  => array(
			'default'           => esc_html__( 'Default', 'edu-press' ),
			'overlay'           => esc_html__( 'Overlay', 'edu-press' ),
		),
	)
);
