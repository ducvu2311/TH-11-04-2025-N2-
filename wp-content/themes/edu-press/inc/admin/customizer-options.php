<?php

if ( ! function_exists( 'thim_layout_setting_customizer' ) ) {
	function thim_layout_setting_customizer( $section_id, $prefix ) {

		thim_customizer()->add_field(
			array(
				'id'       => $prefix . 'layout',
				'type'     => 'radio-image',
				'label'    => esc_html__( 'Layout', 'edu-press' ),
				'tooltip'  => esc_html__( 'Allows you to choose a layout for all archive pages.', 'edu-press' ),
				'section'  => $section_id,
				'priority' => 10,
				'default'  => 'full-content',
				'choices'  => array(
					'sidebar-left'  => THIM_URI . 'images/layout/sidebar-left.jpg',
					'full-content'  => THIM_URI . 'images/layout/body-full.jpg',
					'sidebar-right' => THIM_URI . 'images/layout/sidebar-right.jpg',
				),
			)
		);
	}
}
/**
 * Create Edu_Press_Customize
 *
 */

/**
 * Class Thim_Customize_Options
 */
class Thim_Customize_Options {
	/**
	 * Thim_Customize_Options constructor.
	 */
	public function __construct() {
		add_action( 'customize_register', [ $this, 'thim_deregister' ] );
		add_action( 'thim_customizer_register', [ $this, 'thim_create_customize_options' ] );
	}

	/**
	 * Deregister customize default unnecessary
	 *
	 * @param $wp_customize
	 */
	public function thim_deregister( $wp_customize ) {
		$wp_customize->remove_control( 'blogdescription' );
		$wp_customize->remove_control( 'blogname' );
		$wp_customize->remove_control( 'display_header_text' );
		// Rename existing section
		$wp_customize->add_section( 'title_tagline', array(
			'title'    => esc_html__( 'Logo', 'edu-press' ),
			'panel'    => 'general',
			'priority' => 20,
		) );
	}

	/**
	 * Create customize
	 *
	 * @param $wp_customize
	 */
	public function thim_create_customize_options( $wp_customize ) {

		// include sections
		$customize_path = THIM_DIR . 'inc/admin/customizer-sections/';

		//general
		require_once $customize_path . 'general-logo.php';
		require_once $customize_path . 'general-styling.php';
		require_once $customize_path . 'general-typography.php';
		require_once $customize_path . 'general.php';
		require_once $customize_path . 'general-features.php';
		//header
		require_once $customize_path . 'header.php';
		require_once $customize_path . 'header-layouts.php';
		require_once $customize_path . 'header-main-menu.php';
		require_once $customize_path . 'header-sticky-menu.php';
		//blog
		require_once $customize_path . 'blog.php';
		require_once $customize_path . 'blog-archive.php';
		require_once $customize_path . 'blog-meta.php';
		require_once $customize_path . 'blog-sharing.php';
		require_once $customize_path . 'blog-singular.php';
		// page
		require_once $customize_path . 'page-setting.php';
		//learnpress
		if ( class_exists( 'LearnPress' ) ) {
			require_once $customize_path . 'course.php';
		}

		// WooCommerce
		if ( class_exists( 'WooCommerce' ) ) {
			require_once $customize_path . 'woocommerce-archive.php';
			require_once $customize_path . 'woocommerce-single.php';
		}
		//footer
		require_once $customize_path . 'footer.php';
		require_once $customize_path . 'footer-options.php';
		require_once $customize_path . 'footer-copyright.php';
		//
		require_once $customize_path . 'nav-menus.php';
		require_once $customize_path . 'widgets.php';
	}
}

$thim_customize = new Thim_Customize_Options();
