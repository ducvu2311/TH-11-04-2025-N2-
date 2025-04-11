<?php
if ( ! function_exists( 'thim_get_src_logo' ) ) {
	function thim_get_src_logo( $key_name, $default = '' ) {
		$value = get_theme_mod( $key_name, false );
		if ( ! empty( $value ) ) {
			if ( is_numeric( $value ) ) {
				$value_att = wp_get_attachment_image_src( $value, 'full' );
				if ( $value_att ) {
					$src_logo = $value_att[0];
				}
			} else {
				$src_logo = $value;
			}
		} else {
			$src_logo = $default;
		}

		return thim_ssl_secure_url( $src_logo );
	}
}

add_action( 'thim_logo', 'thim_logo', 1 );
// logo
if ( ! function_exists( 'thim_logo' ) ) :
	function thim_logo() {
		$data_logo = '' ;
  		// Logo customizer
 		$src_logo = thim_get_src_logo( 'thim_logo', get_template_directory_uri() . '/images/sticky-logo.png' );
		// sticky logo
 		$data_logo   .= thim_get_src_logo( 'thim_sticky_logo' ) ? ' data-sticky="' . thim_get_src_logo( 'thim_sticky_logo' ) . '"' : '';
 		// retina logo
 		$data_logo   .= thim_get_src_logo( 'thim_logo_retina' ) ? ' data-retina="' . thim_get_src_logo( 'thim_logo_retina' ) . '"' : '';

		echo '<a href="' . esc_url( home_url( '/' ) ) . '" title="' . esc_attr( get_bloginfo( 'name' ) ) . ' - ' . esc_attr( get_bloginfo( 'description' ) ) . '" rel="home" class="thim-logo">';
		echo '<img src="' . $src_logo . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '" ' .  $data_logo . '>';
		echo '</a>';
	}
endif;
