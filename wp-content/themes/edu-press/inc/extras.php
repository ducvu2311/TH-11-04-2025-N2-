<?php
/**
 * Handles Ajax request to persist notices dismissal.
 * Uses check_ajax_referer to verify nonce.
 */
add_action( 'wp_ajax_thim_dismiss_admin_notice', 'thim_dismiss_admin_notice' );
function thim_dismiss_admin_notice() {
	$option_name        = sanitize_text_field( $_POST['option_name'] );
	$dismissible_length = sanitize_text_field( $_POST['dismissible_length'] );
	$transient          = 0;
	if ( 'forever' != $dismissible_length ) {
		$transient          = absint( $dismissible_length ) * DAY_IN_SECONDS;
		$dismissible_length = strtotime( absint( $dismissible_length ) . ' days' );
	}
	check_ajax_referer( 'dismissible-notice', 'nonce' );
	$dismiss = set_site_transient( $option_name, $dismissible_length, $transient );
	wp_die( $dismiss );
}

/**
 * Adds custom classes to the array of body classes.
 *
 * @param array $classes Classes for the body element.
 *
 * @return array
 */
function thim_body_classes( $classes ) {
	// Adds a class of group-blog to blogs with more than 1 published author.
	if ( is_multi_author() ) {
		$classes[] = 'group-blog';
	}

	// Adds a class of hfeed to non-singular pages.
	if ( ! is_singular() ) {
		$classes[] = 'hfeed';
	}

	if ( get_theme_mod( 'header_position', 'default' ) != 'default' ) {
		$classes[] = ' header-overlay';
	}
	if ( get_theme_mod( 'show_sticky_menu', true ) ) {
		$classes[] = 'sticky-header';
	}

	if ( get_theme_mod( 'sticky_menu_style', 'same' ) === 'custom' ) {
		$classes[] = 'custom-sticky';
	}
	$classes[] = 'nofixcss';
 	return $classes;
}

add_filter( 'body_class', 'thim_body_classes' );

/**
 * Support SSL (https)
 */
function thim_ssl_secure_url( $sources ) {
	$scheme = parse_url( home_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		if ( stripos( $sources, 'http://' ) === 0 ) {
			$sources = 'https' . substr( $sources, 4 );
		}

		return $sources;
	}

	return $sources;
}

function thim_ssl_secure_image_srcset( $sources ) {
	$scheme = parse_url( home_url(), PHP_URL_SCHEME );
	if ( 'https' == $scheme ) {
		foreach ( $sources as &$source ) {
			if ( stripos( $source['url'], 'http://' ) === 0 ) {
				$source['url'] = 'https' . substr( $source['url'], 4 );
			}
		}

		return $sources;
	}

	return $sources;
}
