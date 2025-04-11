<?php
/**
 * Panel Blog
 *
 * @package Edu_Press
 */

thim_customizer()->add_panel(
	array(
		'id'       => 'blog',
		'priority' => 42,
		'title'    => esc_html__( 'Blog', 'edu-press' ),
		'icon'     => 'dashicons-welcome-write-blog',
	)
);
