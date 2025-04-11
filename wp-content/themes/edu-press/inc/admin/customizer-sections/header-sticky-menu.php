<?php
/**
 * Section Header Sticky Menu
 *
 * @package Edu_Press
 */

thim_customizer()->add_section(
	array(
		'id'       => 'header_sticky_menu',
		'title'    => esc_html__( 'Sticky Menu', 'edu-press' ),
		'panel'    => 'header',
		'priority' => 55,
	)
);

// Enable or Disable
thim_customizer()->add_field(
	array(
		'id'       => 'show_sticky_menu',
		'type'     => 'switch',
		'label'    => esc_html__( 'Sticky On Scroll', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you can show or hide sticky header menu on your site . ', 'edu-press' ),
		'section'  => 'header_sticky_menu',
		'default'  => true,
		'priority' => 10,
		'choices'  => array(
			true  => esc_html__( 'On', 'edu-press' ),
			false => esc_html__( 'Off', 'edu-press' ),
		),
	)
);

// Select Style
thim_customizer()->add_field(
	array(
		'id'       => 'sticky_menu_style',
		'type'     => 'select',
		'label'    => esc_html__( 'Select Styles', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you can select sticky menu style for your header . ', 'edu-press' ),
		'section'  => 'header_sticky_menu',
		'default'  => 'same',
		'priority' => 10,
		'multiple' => 0,
		'choices'  => array(
			'same'   => esc_html__( 'The same with the main menu', 'edu-press' ),
			'custom' => esc_html__( 'Custom', 'edu-press' )
		),
	)
);
thim_customizer()->add_field(
	array(
		'type'            => 'multicolor',
		'id'              => 'sticky_menu',
		'label'           => esc_html__( 'Color', 'edu-press' ),
		'section'         => 'header_sticky_menu',
		'priority'        => 20,
		'choices'         => array(
			'background_color' => esc_html__( 'Background Color', 'edu-press' ),
			'text_color'       => esc_html__( 'Text Color', 'edu-press' ),
			'text_color_hover' => esc_html__( 'Text Color Hover', 'edu-press' ),
		),
		'default'         => array(
			'background_color' => '#fff',
			'text_color'       => '#333',
			'text_color_hover' => '#439fdf',
		),
		'transport'       => 'postMessage',
		'js_vars'         => array(
			array(
				'choice'   => 'background_color',
				'element'  => 'body header#masthead.site-header.custom-sticky.affix',
				'property' => 'background-color',
			),
			array(
				'choice'   => 'text_color',
				'element'  => 'body header#masthead.site-header.affix.custom-sticky #primary-menu >li >a,
                               header#masthead.site-header.affix.custom-sticky #primary-menu >li >span',
				'property' => 'color',
			),
			array(
				'choice'   => 'text_color_hover',
				'element'  => 'body header#masthead.site-header.affix.custom-sticky #primary-menu >li >a:hover,
                               body header#masthead.site-header.affix.custom-sticky #primary-menu >li >span:hover',
				'property' => 'color',
			)
		),
		'active_callback' => array(
			array(
				'setting'  => 'sticky_menu_style',
				'operator' => '===',
				'value'    => 'custom',
			),
		),
	)
);
