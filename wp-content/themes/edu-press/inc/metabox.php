<?php
//Filter meta-box
add_filter( 'thim_metabox_display_settings', 'thim_add_metabox_settings', 100, 2 );

if ( ! function_exists( 'thim_add_metabox_settings' ) ) {
	function thim_add_metabox_settings( $meta_box, $prefix ) {
		$meta_box['post_types'] = array( 'page', 'post', 'product' );
		$prefix                 = 'thim_mtb_';
		if ( isset( $_GET['post'] ) && ( $_GET['post'] == get_option( 'page_on_front' ) || $_GET['post'] == get_option( 'page_for_posts' ) ) ) {

		} else {
			$meta_box['tabs'] = array(
				'layout' => array(
					'label' => __( 'Layout', 'edu-press' ),
					'icon'  => 'dashicons-align-left',
				),
			);
		}
		$meta_box['fields'] = array(

			array(
				'name' => __( 'Hide Breadcrumbs', 'edu-press' ),
				'id'   => $prefix . 'hide_breadcrumbs',
				'type' => 'checkbox',
				'std'  => false,
				'tab'  => 'layout',
			),
			array(
				'name' => __( 'Hide title', 'edu-press' ),
				'id'   => $prefix . 'hide_title',
				'type' => 'checkbox',
				'std'  => false,
				'desc' => __( 'Hide the title of the page, working only on the page', 'edu-press' ),
				'tab'  => 'layout',
			),
			/**
			 * Custom layout
			 */
			array(
				'name' => __( 'Use Custom Layout', 'edu-press' ),
				'id'   => $prefix . 'custom_layout',
				'type' => 'checkbox',
				'tab'  => 'layout',
				'std'  => false,
			),

			array(
				'name'    => __( 'Select Layout', 'edu-press' ),
				'id'      => $prefix . 'layout',
				'type'    => 'image_select',
				'options' => array(
					'sidebar-left'  => THIM_URI . 'images/layout/sidebar-left.jpg',
					'full-content'  => THIM_URI . 'images/layout/body-full.jpg',
					'sidebar-right' => THIM_URI . 'images/layout/sidebar-right.jpg',
				),
				'default' => 'sidebar-right',
				'tab'     => 'layout',
				'hidden'  => array( $prefix . 'custom_layout', '=', false ),
			),

			array(
				'name' => __( 'No Padding Content', 'edu-press' ),
				'id'   => $prefix . 'no_padding',
				'type' => 'checkbox',
				'std'  => false,
				'tab'  => 'layout',
			),
		);

		return $meta_box;
	}
}
