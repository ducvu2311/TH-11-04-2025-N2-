<?php

/**
 * For use thim-core
 */
if ( class_exists( 'LearnPress' ) ) {
	require THIM_DIR . 'inc/learnpress.php';
}
require THIM_DIR . 'inc/admin/installer/installer.php';
if ( class_exists( 'TP' ) ) {
	require THIM_DIR . 'inc/admin/plugins-require.php';
	require THIM_DIR . 'inc/admin/customizer-options.php';
}
require THIM_DIR . 'inc/libs/Tax-meta-class/Tax-meta-class.php';
require THIM_DIR . 'inc/tax-meta.php';

/**
 * Check a plugin activate
 *
 * @param $plugin
 *
 * @return bool
 */
function thim_plugin_active( $plugin ) {
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );
	if ( is_plugin_active( $plugin ) ) {
		return true;
	}

	return false;
}

if ( ! function_exists( 'thim_print_breadcrumbs' ) ) {
	function thim_print_breadcrumbs() {
		?>
		<div class="breadcrumbs-wrapper">
			<div class="container">
				<?php
				//Check seo by yoast breadcrumbs
				$wpseo = get_option( 'wpseo_titles' );
				if ( ( class_exists( 'WPSEO' ) || class_exists( 'WPSEO_Premium' ) ) && $wpseo['breadcrumbs-enable'] && function_exists( 'yoast_breadcrumb' ) ) {
					yoast_breadcrumb( '<div id="breadcrumbs">', '</div>' );
				} else {
					do_action( 'thim_breadcrumbs' );
				}
				?>
			</div>
		</div>
		<?php
	}
}

/**
 * Footer Copyright bar
 *
 * @return bool
 * @return string
 */

if ( ! function_exists( 'thim_copyright_bar' ) ) {
	function thim_copyright_bar() {
		if ( get_theme_mod( 'copyright_show', true ) ) : ?>
			<div class="col-sm-6 copyright-text">
				<?php
				echo wp_kses_post(get_theme_mod( 'copyright_text', 'Designed by ThimPress. Powered by WordPress.' ));
				?>
			</div>
		<?php endif;
	}
}

/**
 * Get feature image
 *
 * @param int $attachment_id
 * @param int $width
 * @param int $height
 *
 * @return string
 */

if ( ! function_exists( 'thim_get_feature_image' ) ) {
	function thim_get_feature_image( $attachment_id, $size_type = null, $width = null, $height = null, $alt = null, $title = null, $no_lazyload = null ) {

		if ( ! $size_type ) {
			$size_type = 'full';
		}
		$style = '';
		if ( $width && $height ) {
			$src   = wp_get_attachment_image_src( $attachment_id, array( $width, $height ) );
			$style = ' width="' . $width . '" height="' . $height . '"';
		} else {
			$src = wp_get_attachment_image_src( $attachment_id, $size_type );
			if ( ! empty( $src[1] ) && ! empty( $src[2] ) ) {
				$style = ' width="' . $src[1] . '" height="' . $src[2] . '"';
			}
		}

		if ( ! $src ) {
			$query_args    = array(
				'post_type'   => 'attachment',
				'post_status' => 'inherit',
				'meta_query'  => array(
					array(
						'key'     => '_wp_attached_file',
						'compare' => 'LIKE',
						'value'   => 'demo_image.jpg'
					)
				)
			);
			$attachment_id = get_posts( $query_args );
			if ( ! empty( $attachment_id ) && $attachment_id[0] ) {
				$attachment_id = $attachment_id[0]->ID;
				$src           = wp_get_attachment_image_src( $attachment_id, 'full' );
			}
		}

		if ( ! $alt ) {
			$alt = get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) ? get_post_meta( $attachment_id, '_wp_attachment_image_alt', true ) : get_the_title( $attachment_id );
		}
		if ( $no_lazyload == 1 ) {
			$style .= ' data-skip-lazy';
		}
		if ( ! $title ) {
			$title = get_the_title( $attachment_id );
		}

		if ( empty( $src ) ) {
			return '<img src="' . esc_url( THIM_URI . 'images/demo_images/demo_image.jpg' ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" ' . $style . '>';
		}

		return '<img src="' . esc_url( $src[0] ) . '" alt="' . esc_attr( $alt ) . '" title="' . esc_attr( $title ) . '" ' . $style . '>';

	}
}

add_filter( 'class_header_layout', function ( $class ) {
	$thim_header_layout = esc_attr( get_theme_mod( 'thim_header_size' ) );
	if ( $thim_header_layout == 'full_width' ) {
		$class .= '-fluid';
	}
	$class .= ' item-' . esc_attr( get_theme_mod( 'main_menu_align', 'text-right' ) );
	$class .= ' menu-hover-' . esc_attr( get_theme_mod( 'item_hover_hover', 'line' ) );

	return $class;
} );

if ( ! function_exists( 'thim_default_get_post_thumbnail' ) ) {
	function thim_default_get_post_thumbnail( $size ) {

		if ( thim_plugin_active( 'thim-core/thim-core.php' ) ) {
			return;
		}

		if ( get_the_post_thumbnail( get_the_ID(), $size ) ) {
			?>
			<div class='post-formats-wrapper'>
				<a class="post-image" href="<?php echo esc_url( get_permalink() ); ?>">
					<?php echo get_the_post_thumbnail( get_the_ID(), $size ); ?>
				</a>
			</div>
			<?php
		}
	}
}
add_action( 'thim_entry_top', 'thim_default_get_post_thumbnail', 20 );

if ( ! function_exists( 'thim_enable_upload_svg' ) ) {
	function thim_enable_upload_svg( $mimes ) {
		$mimes['svg'] = 'image/svg+xml';

		return $mimes;
	}

	add_filter( 'upload_mimes', 'thim_enable_upload_svg' );
}
