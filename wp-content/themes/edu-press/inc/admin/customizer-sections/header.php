<?php
/**
 * Panel Header
 *
 * @package Edu_Press
 */


thim_customizer()->add_panel(
	array(
		'id'       => 'header',
		'priority' => 35,
		'title'    => esc_html__( 'Header', 'edu-press' ),
		'icon'     => 'dashicons-editor-table'
	)
);
