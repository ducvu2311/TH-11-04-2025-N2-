<?php
/**
 * Panel General
 *
 * @package Edu_Press
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'general',
		'priority' => 30,
		'title'    => esc_html__( 'General', 'edu-press' ),
		'icon'     => 'dashicons-admin-generic',
	)
);
