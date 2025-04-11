<?php
/**
 * Block Styles
 *
 * @link https://developer.wordpress.org/reference/functions/register_block_style/
 *
 * @package WordPress
 * @subpackage Edu_Press
 * @since Edu Press 1.0
 */

if ( function_exists( 'register_block_style' ) ) {
	/**
	 * Register block styles.
	 *
	 * @since Edu Press 1.0
	 *
	 * @return void
	 */
	function edu_press_register_block_styles() {
		// Columns: Overlap.
		register_block_style(
			'core/columns',
			array(
				'name'  => 'edu-press-columns-overlap',
				'label' => esc_html__( 'Overlap', 'edu-press' ),
			)
		);

		// Cover: Borders.
		register_block_style(
			'core/cover',
			array(
				'name'  => 'edu-press-border',
				'label' => esc_html__( 'Borders', 'edu-press' ),
			)
		);

		// Group: Borders.
		register_block_style(
			'core/group',
			array(
				'name'  => 'edu-press-border',
				'label' => esc_html__( 'Borders', 'edu-press' ),
			)
		);

		// Image: Borders.
		register_block_style(
			'core/image',
			array(
				'name'  => 'edu-press-border',
				'label' => esc_html__( 'Borders', 'edu-press' ),
			)
		);

		// Image: Frame.
		register_block_style(
			'core/image',
			array(
				'name'  => 'edu-press-image-frame',
				'label' => esc_html__( 'Frame', 'edu-press' ),
			)
		);

		// Latest Posts: Dividers.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'edu-press-latest-posts-dividers',
				'label' => esc_html__( 'Dividers', 'edu-press' ),
			)
		);

		// Latest Posts: Borders.
		register_block_style(
			'core/latest-posts',
			array(
				'name'  => 'edu-press-latest-posts-borders',
				'label' => esc_html__( 'Borders', 'edu-press' ),
			)
		);

		// Media & Text: Borders.
		register_block_style(
			'core/media-text',
			array(
				'name'  => 'edu-press-border',
				'label' => esc_html__( 'Borders', 'edu-press' ),
			)
		);

		// Separator: Thick.
		register_block_style(
			'core/separator',
			array(
				'name'  => 'edu-press-separator-thick',
				'label' => esc_html__( 'Thick', 'edu-press' ),
			)
		);

		// Social icons: Dark gray color.
		register_block_style(
			'core/social-links',
			array(
				'name'  => 'edu-press-social-icons-color',
				'label' => esc_html__( 'Dark gray', 'edu-press' ),
			)
		);
	}
	add_action( 'init', 'edu_press_register_block_styles' );
}
