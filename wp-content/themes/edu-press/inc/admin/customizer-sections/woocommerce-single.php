<?php
/**
 * Section Woocommerce Archive
 *
 * @package Edu_Press
 */

thim_customizer()->add_section(
	array(
		'id'       => 'woo_single',
		'panel'    => 'woocommerce',
		'title'    => esc_html__( 'Singular', 'edu-press' ),
		'priority' => 2,
	)
);

thim_layout_setting_customizer('woo_single','thim_woo_single_');
