<?php
/**
 * Panel Footer
 *
 * @package Estatesy
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'footer',
		'priority' => 60,
		'title'    => esc_html__( 'Footer', 'edu-press' ),
		'icon'     => 'dashicons-align-right',
	)
);
