<?php
/**
 * Panel Course
 * 
 * @package Edu_Press
 */

thim_customizer()->add_section(
    array(
        'id'       => 'course',
        'priority' => 43,
        'title'    => esc_html__( 'Courses', 'edu-press' ),
        'icon'     => 'dashicons-welcome-learn-more',
    )
);

thim_customizer()->add_field(
	array(
		'id'        => 'course_price_color',
		'type'      => 'color',
		'label'     => esc_html__( 'Course Price Color', 'edu-press' ),
 		'section'   => 'course',
		'priority'        => 40,
 		'default'   => '#f24c0a',
 	)
); 