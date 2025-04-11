<?php
/**
 * Section Styling
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
	array(
		'id'       => 'styling',
		'panel'    => 'general',
		'title'    => esc_html__( 'Styling', 'edu-press' ),
		'priority' => 30,
	)
);

// Select Theme Primary Colors
thim_customizer()->add_field(
	array(
		'id'            => 'body_primary_color',
		'type'          => 'color',
		'label'         => esc_html__( 'Primary Color', 'edu-press' ),
		'tooltip'       => esc_html__( 'Allows you to choose a primary color for your site.', 'edu-press' ),
		'section'       => 'styling',
		'priority'      => 10,
		'alpha'       => true,
		'default'     => '#439fdf',
		'transport' => 'postMessage'
	)
);

thim_customizer()->add_field(
	array(
		'id'              => 'background_main_color',
		'label'           => esc_html__( 'Background Body Color', 'edu-press' ),
		'type'          => 'color',
		'section'       => 'styling',
		'priority'      => 20,
		'alpha'       => true,
		'default'     => '#fff',
		'transport' => 'postMessage',
		'js_vars'         => array(
			array(
				'element'  => 'body',
				'function' => 'css',
				'property' => 'background-color',
			),
		),
	)
);

thim_customizer()->add_field(
	array(
		'id'        => 'border_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Border Color', 'edu-press' ),
		'section'   => 'general_styling',
		'priority'  => 10,
		'choices'   => array( 'alpha' => true ),
		'default'   => '#eee',
		'transport' => 'postMessage',
		'js_vars'   => array(
			array(
				'function' => 'style',
				'element'  => ':root',
				'property' => '--thim-border-color',
			),
		),
	)
);

// width container
thim_customizer()->add_field(
    array(
        'id'          => 'body_container',
        'type'        => 'dimension',
        'label'       => esc_html__( 'Max width container','edu-press' ),
        'tooltip'     => esc_html__( 'Allow to assign a value for body width. Example: 10px, 3em, 48%, 90vh, ...','edu-press' ),
        'section'     => 'styling',
        'default'     => '1290px',
        'priority'    => 40,
        'choices'     => array(
            'min'  => 1200,
            'max'  => 1600,
            'step' => 5,
        ),
        'transport' => 'postMessage',
        'js_vars'   => array(
            array(
                'choice'   => 'width',
                'element'  => 'body .container',
                'property' => 'max-width',
            )
        )
    )
);
// Border Radius
thim_customizer()->add_field(
	array(
		'id'       => 'border_radius_content',
		'type'     => 'switch',
		'label'    => esc_html__( 'Border Radius', 'edu-press' ),
		'section'  => 'styling',
		'default'  => false,
		'priority' => 45,
		'choices'  => array(
			true  => esc_html__( 'On', 'edu-press' ),
			false => esc_html__( 'Off', 'edu-press' ),
		),
		'tooltip'  => esc_html__( 'Enable border radius in some places (List Course, Button, Shop, Blog .....)', 'edu-press' ),
	)
);

thim_customizer()->add_field(
	array(
		'id'              => 'border_radius',
		'type'            => 'dimensions',
		'label'           => esc_html__( 'Border Radius Size','edu-press' ),
		'section'         => 'styling',
		'priority'        => 50,
		'default'         => [
			'item'     		=> '10px',
			'item-big' 		=> '20px',
			'button'     	=> '60px',
		],
		'choices'         => [
			'labels' => [
				'item'     => esc_html__( 'Global - Default', 'edu-press' ),
				'item-big' => esc_html__( 'Global - Big', 'edu-press' ),
				'button'     => esc_html__( 'Button', 'edu-press' ),
			],
		],
		'active_callback' => array(
			array(
				'setting'  => 'border_radius_content',
				'operator' => '===',
				'value'    => true,
			),
		),
	)
);
