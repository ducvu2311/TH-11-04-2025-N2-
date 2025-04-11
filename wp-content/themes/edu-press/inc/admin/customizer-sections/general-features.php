<?php
/**
 * Section Advance features
 *
 * @package Edu_Press
 */

thim_customizer()->add_section(
	array(
		'id'       => 'advanced',
		'panel'    => 'general',
		'priority' => 90,
		'title'    => esc_html__( 'Extra Features', 'edu-press' ),
	)
);

// Feature: Back To Top
thim_customizer()->add_field(
	array(
		'type'     => 'switch',
		'id'       => 'feature_backtotop',
		'label'    => esc_html__( 'Back To Top', 'edu-press' ),
		'tooltip'  => esc_html__( 'Turn on to enable the Back To Top script which adds the scrolling to top functionality.', 'edu-press' ),
		'section'  => 'advanced',
		'default'  => true,
		'priority' => 40,
		'choices'  => array(
			true  => esc_html__( 'On', 'edu-press' ),
			false => esc_html__( 'Off', 'edu-press' ),
		),
	)
);

// Feature: Preload
thim_customizer()->add_field( array(
	'type'     => 'radio-image',
	'id'       => 'theme_feature_preloading',
	'section'  => 'advanced',
	'label'    => esc_html__( 'Preloading', 'edu-press' ),
	'default'  => 'off',
	'priority' => 70,
	'choices'  => array(
		'off'             => THIM_URI . 'images/preloading/off.jpg',
		'chasing-dots'    => THIM_URI . 'images/preloading/chasing-dots.gif',
		'circle'          => THIM_URI . 'images/preloading/circle.gif',
		'cube-grid'       => THIM_URI . 'images/preloading/cube-grid.gif',
		'double-bounce'   => THIM_URI . 'images/preloading/double-bounce.gif',
		'fading-circle'   => THIM_URI . 'images/preloading/fading-circle.gif',
		'folding-cube'    => THIM_URI . 'images/preloading/folding-cube.gif',
		'rotating-plane'  => THIM_URI . 'images/preloading/rotating-plane.gif',
		'spinner-pulse'   => THIM_URI . 'images/preloading/spinner-pulse.gif',
		'three-bounce'    => THIM_URI . 'images/preloading/three-bounce.gif',
		'wandering-cubes' => THIM_URI . 'images/preloading/wandering-cubes.gif',
		'wave'            => THIM_URI . 'images/preloading/wave.gif',
		'custom-image'    => THIM_URI . 'images/preloading/custom-image.jpg',
	),
) );

// Feature: Preload Image Upload
thim_customizer()->add_field( array(
	'type'            => 'kirki-image',
	'id'              => 'theme_feature_preloading_custom_image',
	'label'           => esc_html__( 'Preloading Custom Image', 'edu-press' ),
	'section'         => 'advanced',
	'priority'        => 80,
	'active_callback' => array(
		array(
			'setting'  => 'theme_feature_preloading',
			'operator' => '===',
			'value'    => 'custom-image',
		),
	),
) );

// Feature: Preload Colors
thim_customizer()->add_field( array(
	'type'            => 'multicolor',
	'id'              => 'theme_feature_preloading_style',
	'label'           => esc_html__( 'Preloading Color', 'edu-press' ),
	'section'         => 'advanced',
	'priority'        => 90,
	'choices'         => array(
		'background' => esc_html__( 'Background Color', 'edu-press' ),
		'color'      => esc_html__( 'Icon Color', 'edu-press' ),
	),
	'default'         => array(
		'background' => '#ffffff',
		'color'      => '#333333',
	),
	'active_callback' => array(
		array(
			'setting'  => 'theme_feature_preloading',
			'operator' => '!=',
			'value'    => 'off',
		),
	),
) );
