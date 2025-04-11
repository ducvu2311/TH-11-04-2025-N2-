<?php
/**
 * Section Header Main Menu
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
	array(
		'id'       => 'header_main_menu',
		'title'    => esc_html__( 'Main Menu', 'edu-press' ),
		'panel'    => 'header',
		'priority' => 30,
	)
);

// Select All Fonts For Main Menu
thim_customizer()->add_field(
	array(
		'id'        => 'main_menu',
		'type'      => 'typography',
		'label'     => esc_html__( 'Typography', 'edu-press' ),
		'tooltip'   => esc_html__( 'Allows you to select all the font properties for the header.', 'edu-press' ),
		'section'   => 'header_main_menu',
		'priority'  => 10,
		'default'   => array(
			'font-size'      => '16px',
			'line-height'    => '17px',
			'color'          => '#000',
			'text-transform' => 'uppercase',
			'font-weight' => 'normal',
			'text-align' =>'left'
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'font-size',
				'element'  => 'header#masthead.site-header #primary-menu >li >a,
                               header#masthead.site-header #primary-menu >li >span',
				'property' => 'font-size',
			),
			array(
				'choice'   => 'line-height',
				'element'  => 'header#masthead.site-header #primary-menu >li >a,
                               header#masthead.site-header #primary-menu >li >span',
				'property' => 'line-height',
			),
			array(
				'choice'   => 'color',
				'element'  => 'header#masthead.site-header #primary-menu >li >a,
                               header#masthead.site-header #primary-menu >li >span,
                               header#masthead.site-header .navigation .width-navigation .inner-navigation .navbar > .current-menu-item a',
				'property' => 'color',
			),
			array(
				'choice'   => 'text-transform',
				'element'  => 'header#masthead.site-header #primary-menu >li >a,
                               header#masthead.site-header #primary-menu >li >span',
				'property' => 'text-transform',
			),
		)
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'main_menu_color',
		'type'      => 'multicolor',
		'label'     => esc_html__( 'Main Menu Color', 'edu-press' ),
		'section'   => 'header_main_menu',
		'priority'  => 20,
		'choices'   => array(
			'background_color' => esc_html__( 'Background Color', 'edu-press' ),
			'border_color'     => esc_html__( 'Border Color', 'edu-press' ),
			'text_color_hover' => esc_html__( 'Text Color Hover', 'edu-press' ),
		),
		'default'   => array(
			'background_color' => '#fff',
			'border_color'     => '#E8E8E8',
			'text_color_hover' => '#03c6ba',
		),
		'transport' => 'postMessage',

		'js_vars' => array(
			array(
				'choice'   => 'background_color',
				'element'  => 'body #masthead.site-header',
				'property' => 'background-color',
			),

			array(
				'choice'   => 'border_color',
				'element'  => 'header#masthead.site-header',
				'property' => 'border-color',
			),

			array(
				'choice'   => 'text_color_hover',
				'element'  => 'header#masthead.site-header #primary-menu >li >a:hover,
                               header#masthead.site-header #primary-menu >li >span:hover',
				'property' => 'color',
			)
		)
	)
);

thim_customizer()->add_field(
	array(
		'type'      => 'multicolor',
		'id'        => 'sub_menu',
		'label'     => esc_html__( 'Sub Menu Color', 'edu-press' ),
		'section'   => 'header_main_menu',
		'priority'  => 21,
		'choices'   => array(
			'background_color' => esc_html__( 'Background Color', 'edu-press' ),
			'text_color'       => esc_html__( 'Text Color', 'edu-press' ),
			'text_color_hover' => esc_html__( 'Text Color Hover', 'edu-press' ),
		),
		'default'   => array(
			'background_color' => '#fff',
			'text_color'       => '#333',
			'text_color_hover' => '#439fdf',
		),
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'choice'   => 'background_color',
				'element'  => 'header#masthead.site-header #primary-menu .sub-menu',
				'property' => 'background-color',
			),
			array(
				'choice'   => 'text_color',
				'element'  => 'header#masthead.site-header .navigation #primary-menu .sub-menu a,
                               header#masthead.site-header .navigation #primary-menu .sub-menu span',
				'property' => 'color',
			),
			array(
				'choice'   => 'text_color_hover',
				'element'  => 'header#masthead.site-header .navigation #primary-menu .sub-menu a:hover,
                               header#masthead.site-header .navigation #primary-menu .sub-menu span:hover',
				'property' => 'color',
			),
		)
 	)
);

thim_customizer()->add_field(
	array(
		'type'      => 'multicolor',
		'id'        => 'mobile_menu',
		'label'     => esc_html__( 'Mobile Menu Color', 'edu-press' ),
		'section'   => 'header_main_menu',
		'priority'  => 22,
		'choices'   => array(
			'background_color' => esc_html__( 'Background Color', 'edu-press' ),
			'text_color'       => esc_html__( 'Text Color', 'edu-press' ),
			'text_color_hover' => esc_html__( 'Text Color Hover', 'edu-press' ),
		),
		'default'   => array(
			'background_color' => '#fff',
			'text_color'       => '#000',
			'text_color_hover' => '#439fdf',
		),
		'transport' => 'postMessage'
	)
);

thim_customizer()->add_field(
	array(
		'id'            => 'main_menu_align',
		'type'          => 'select',
		'label'         => esc_html__( 'Menu Align', 'edu-press' ),
		'section'       => 'header_main_menu',
		'priority'      => 15,
		'default'       => 'text-right',
		'choices'       => array(
			'text-left'   => esc_html__( 'Align Left', 'edu-press' ),
			'text-right'  => esc_html__( 'Align Right', 'edu-press' ),
			'text-center' => esc_html__( 'Align Center', 'edu-press' )
		),
		'wrapper_attrs' => array(
			'class' => '{default_class} thim-group-item thim-w50'
		)
	)
);

thim_customizer()->add_field(
	array(
		'type'     => 'select',
		'id'       => 'item_hover_hover',
		'label'    => esc_html__( 'Line Active Item', 'edu-press' ),
		'default'  => 'noline',
		'priority' => 16,
		'multiple' => 0,
		'section'  => 'header_main_menu',
		'choices'  => array(
			'noline'    => esc_html__( 'No line', 'edu-press' ),
			'line'    	=> esc_html__( 'line', 'edu-press' ),
		),
	)
);