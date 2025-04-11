<?php
/**
 * Section Footer Settings
 *
 */

// Add Section Footer Options
thim_customizer()->add_section(
	array(
		'id'       => 'footer_options',
		'title'    => esc_html__( 'Footer Settings', 'edu-press' ),
		'panel'    => 'footer',
		'priority' => 50,
		'icon'     => 'dashicons-admin-page',
	)
);



thim_customizer()->add_field(
	array(
		'id'       => 'thim_footer_size',
		'type'     => 'select',
		'label'    => esc_html__( 'Size', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you to select the size layout for the footer layout.', 'edu-press' ),
		'section'  => 'footer_options',
		'priority' => 15,
		'multiple' => 0,
		'default'  => 'default',
		'choices'  => array(
			'default'    => esc_html__( 'Default', 'edu-press' ),
			'full_width' => esc_html__( 'Full width', 'edu-press' ),
		),
	)
);
// Footer Text Color
thim_customizer()->add_field(
	array(
		'type'      => 'multicolor',
		'id'        => 'footer_color',
		'label'     => esc_html__( 'Color', 'edu-press' ),
		'section'   => 'footer_options',
		'priority'  => 50,
		'choices'   => array(
			'bg'    => esc_html__( 'Background Color', 'edu-press' ),
			'title' => esc_html__( 'Title', 'edu-press' ),
			'text'  => esc_html__( 'Text', 'edu-press' ),
			'link'  => esc_html__( 'Link', 'edu-press' ),
			'hover' => esc_html__( 'Hover', 'edu-press' ),
		),
		'default'   => array(
			'bg'    => '#F5FBFF',
			'title' => '#333',
			'text'  => '#737F87',
			'link'  => '#737F87',
			'hover' => '#03C6BA',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'title',
				'function' => 'css',
				'element'  => 'footer#colophon .footer .widget-title',
				'property' => 'color',
			),
			array(
				'choice'   => 'text',
				'function' => 'css',
				'element'  => '
								footer#colophon .footer .thim-footer-location .social a,
								footer#colophon .footer,
								footer#colophon .footer .thim-footer-location .info .fa,
								footer#colophon .footer a,
								.thim-social li a
								',
				'property' => 'color',
			),
			array(
				'choice'   => 'link',
				'function' => 'css',
				'element'  => 'footer#colophon .footer .thim-footer-location .info a',
				'property' => 'color',
			),
			array(
				'choice'   => 'hover',
				'function' => 'style',
				'element'  => 'footer#colophon .footer a:hover',
				'property' => 'color',
			),
		),
	)
);

// Footer Font title
thim_customizer()->add_field(
	array(
		'id'        => 'footer_font_title',
		'label'     => esc_html__( 'Font Title', 'edu-press' ),
		'type'      => 'typography',
		'priority'  => 50,
		'section'   => 'footer_options',
		'default'   => array(
			'font-size'      => '1.3em',
			'line-height'    => '1.3em',
			'text-transform' => 'normal',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-size',
				'element'  => '#main-content footer#colophon .footer .widget-title',
				'property' => 'font-size',
			),
			array(
				'choice'   => 'line-height',
				'element'  => '#main-content footer#colophon .footer .widget-title',
				'property' => 'line-height',
			),
			array(
				'choice'   => 'text-transform',
				'element'  => '#main-content footer#colophon .footer .widget-title',
				'property' => 'text-transform',
			),

		),
	)
);
// Footer text
thim_customizer()->add_field(
	array(
		'id'        => 'footer_font_text',
		'label'     => esc_html__( 'Font Text', 'edu-press' ),
		'type'      => 'typography',
		'priority'  => 50,
		'section'   => 'footer_options',
		'default'   => array(
			'font-size'   => '1em',
			'line-height' => '1.3em',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-size',
				'element'  => '#main-content footer#colophon .footer .widget-title',
				'property' => 'font-size',
			),
			array(
				'choice'   => 'line-height',
				'element'  => '#main-content footer#colophon .footer .widget-title',
				'property' => 'line-height',
			),
		),
	)
);
