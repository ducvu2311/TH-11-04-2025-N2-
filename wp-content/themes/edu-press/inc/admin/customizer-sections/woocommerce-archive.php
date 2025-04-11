<?php
/**
 * Section Woocommerce Archive
 *
 * @package estatesy
 */

thim_customizer()->add_section(
	array(
		'id'       => 'woo_archive',
		'panel'    => 'woocommerce',
		'title'    => esc_html__( 'Archive', 'edu-press' ),
		'priority' => 2,
	)
);
thim_customizer()->add_field(
	array(
		'id'       => 'thim_woo_set_show_qv',
		'type'     => 'switch',
		'label'    => esc_html__( 'Show Quick View', 'edu-press' ),
		'tooltip'  => esc_html__( 'Allows you to enable or disable the quick view.', 'edu-press' ),
		'section'  => 'woo_archive',
		'default'  => false,
		'priority' => 40,
		'choices'  => array(
			true  => esc_html__( 'On', 'edu-press' ),
			false => esc_html__( 'Off', 'edu-press' ),
		),
	)
);
thim_layout_setting_customizer('woo_archive','thim_woo_');
