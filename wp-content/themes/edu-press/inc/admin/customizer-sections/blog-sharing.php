<?php
/**
 * Section Sharing
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
	array(
		'id'       => 'sharing',
		'panel'    => 'blog',
		'title'    => esc_html__( 'Social Share', 'edu-press' ),
		'priority' => 21,
	)
);

// Sharing Group
thim_customizer()->add_field(
	array(
		'id'       => 'group_sharing',
		'type'     => 'sortable',
		'label'    => esc_html__( 'Sortable Sharing Buttons', 'edu-press' ),
		'tooltip'  => esc_html__( 'Click on eye icons to show or hide buttons. Use drag and drop to change the position of social share icons..', 'edu-press' ),
		'section'  => 'sharing',
		'priority' => 10,
		'default'  => array(
			'facebook',
			'twitter',
			'pinterest',
		),
		'choices'  => array(
			'facebook'  => esc_html__( 'Facebook', 'edu-press' ),
			'twitter'   => esc_html__( 'Twitter', 'edu-press' ),
			'pinterest' => esc_html__( 'Pinterest', 'edu-press' ),
		),
	)
);

