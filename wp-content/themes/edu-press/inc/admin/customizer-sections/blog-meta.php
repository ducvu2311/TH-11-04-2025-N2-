<?php
/**
 * Section Blog Archive
 *
 * @package Hair_Salon
 */

thim_customizer()->add_section(
	array(
		'id'       => 'blog_meta',
		'panel'    => 'blog',
		'title'    => esc_html__( 'Meta Tags Archive', 'edu-press' ),
		'priority' => 20,
	)
);

thim_customizer()->add_field(
	array(
		'id'       => 'group_meta_tags',
		'type'     => 'sortable',
		'label'    => esc_html__( 'Meta Tags', 'edu-press' ),
		'tooltip'  => esc_html__( 'Click on eye icon to show or hide buttons. Use drag and drop to change the position of meta tags..', 'edu-press' ),
		'section'  => 'blog_meta',
		'priority' => 20,
		'default'  => array(
			'date',
			'author',
			'comment_number',
			'category',
			'tag',
		),

		'choices' => array(
			'date'           => esc_html__( 'Date', 'edu-press' ),
			'author'         => esc_html__( 'Author', 'edu-press' ),
			'category'       => esc_html__( 'Category', 'edu-press' ),
			'tag'            => esc_html__( 'Tag', 'edu-press' ),
			'comment_number' => esc_html__( 'Comments Number', 'edu-press' ),
		),
	)
);

