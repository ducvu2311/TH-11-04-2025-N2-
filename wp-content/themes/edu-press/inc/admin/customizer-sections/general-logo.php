<?php
/**
 * Field Logo and Sticky Logo
 *
 */

// Header Logo
thim_customizer()->add_field(
	array(
		'id'       => 'thim_logo',
		'type'     => 'image',
		'section'  => 'title_tagline',
		'label'    => esc_html__( 'Logo', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you to add, remove, change logo on your site. ', 'edu-press' ),
		'priority' => 10,
		'default'  => THIM_URI . "images/logo.png",
	)
);

// Header Sticky Logo
thim_customizer()->add_field(
	array(
		'id'       => 'thim_sticky_logo',
		'type'     => 'image',
		'section'  => 'title_tagline',
		'label'    => esc_html__( 'Sticky Logo', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you to add, remove, or change the sticky logo on your site.', 'edu-press' ),
		'priority' => 20,
		'default'  => THIM_URI . "images/logo-sticky.png",
	)
);

// Header Retina Logo
thim_customizer()->add_field(
	array(
		'id'       => 'thim_retina_logo',
		'type'     => 'image',
		'section'  => 'title_tagline',
		'label'    => esc_html__( 'Retina Logo', 'edu-press' ),
		'tooltip'  => esc_html__( 'Select an image file for the retina version of the logo. It should be exactly 2x the size of the logo.', 'edu-press' ),
		'priority' => 30,
	)
);

// Logo width
thim_customizer()->add_field(
	array(
		'id'        => 'width_logo',
		'type'      => 'dimension',
		'label'     => esc_html__( 'Logo width', 'edu-press' ),
		'tooltip'   => esc_html__( 'Allows you to assign a value for logo width. Example: 10px, 3em, 48%, 90vh etc.', 'edu-press' ),
		'section'   => 'title_tagline',
		'default'   => '200px',
		'priority'  => 40,
		'choices'   => array(
			'min'  => 100,
			'max'  => 500,
			'step' => 10,
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'width',
				'element'  => 'header#masthead .width-logo',
				'property' => 'width',
			)
		)
	)
);
