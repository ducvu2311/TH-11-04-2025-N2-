<?php
/**
 * Theme functions and definitions.
 *
 * @link    https://developer.wordpress.org/themes/basics/theme-functions/
 *
 */

define( 'THIM_DIR', trailingslashit( get_template_directory() ) );
define( 'THIM_URI', trailingslashit( get_template_directory_uri() ) );
define( 'THIM_THEME_VERSION', '1.0.5' );


/**
 * Custom template tags for this theme.
 */
require_once( THIM_DIR . 'inc/template-tags.php' );

/**
 * Custom functions that act independently of the theme templates.
 */
require_once( THIM_DIR . 'inc/extras.php' );

if ( class_exists( 'WooCommerce' ) ) {
	require THIM_DIR . 'woocommerce/woocommerce.php';
}

//logo
require_once THIM_DIR . 'templates/header/logo.php';
/**
 * Custom wrapper layout for theme
 */
require_once( THIM_DIR . 'inc/wrapper-layout.php' );
/**
 * Custom functions
 */
require_once( THIM_DIR . 'inc/custom-functions.php' );

// register widget elementor kit
require THIM_DIR . 'inc/register-widget-ekit.php';

// Block styles
require THIM_DIR . '/inc/blocks/block-styles.php';

// Block Patterns.
require THIM_DIR . '/inc/blocks/block-patterns.php';

include_once THIM_DIR . '/inc/variables-css.php';
require_once( THIM_DIR . 'inc/init.php' );
require_once( THIM_DIR . 'inc/metabox.php' );

