<?php

thim_customizer()->add_section(
	array(
		'id'       => 'page_layout',
		'title'    => esc_html__( 'Page Setting', 'edu-press' ),
		'priority' => 43,
		'icon'     => 'dashicons-admin-page',
	)
);

thim_layout_setting_customizer( 'page_layout', 'thim_page_' );
