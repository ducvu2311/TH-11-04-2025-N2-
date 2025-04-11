<?php

/**
 * Add action and add filter
 * Class Thim_Wrapper_Layout
 */

function thim_get_theme_option( $name = '', $value_default = '' ) {
	$data = get_theme_mods();
	if ( isset( $data[$name] ) ) {
		return $data[$name];
	} else {
		return $value_default;
	}
}

/**
 * Get prefix for key customizer
 */
if ( ! function_exists( 'thim_get_prefix_key' ) ) {
	function thim_get_prefix_key() {
		if ( get_post_type() == "product" ) {
			$prefix = 'thim_woo';
		} else {
			$prefix = 'thim_archive';
		}

		if ( is_single() ) {
			$prefix .= '_single';
		}

		if ( is_page() ) {
			$prefix = 'thim_page';
		}

		return $prefix;
	}
}

class Thim_Wrapper_Layout {
	public function __construct() {
		if ( class_exists( 'LearnPress' ) ) {
			remove_action( 'learn-press/before-main-content', LearnPress::instance()->template( 'general' )->func( 'breadcrumb' ) );
		}
		add_action( 'learn-press/before-main-content',array( $this, 'thim_wrapper_page_title'), 10 );

		// action thim_wrapper_loop_start
		add_action( 'thim_wrapper_loop_start', array( $this, 'thim_wrapper_div_open' ), 1 );
		add_action( 'thim_wrapper_loop_start', array( $this, 'thim_wrapper_loop_start' ), 10 );
		add_action( 'thim_wrapper_loop_start', array( $this, 'thim_wrapper_page_title' ), 5 );
		// action thim_wrapper_loop_end
		add_action( 'thim_wrapper_loop_end', array( $this, 'thim_wrapper_loop_end' ), 10 );
		add_action( 'thim_wrapper_loop_end', array( $this, 'thim_wrapper_div_close' ), 30 );
		//add thim_wrapper_loop_start
		add_action( 'woocommerce_before_main_content', array( $this,'thim_wrapper_div_open'), 1 );
		add_action( 'woocommerce_before_main_content', array( $this,'thim_wrapper_page_title'), 2 );
		add_action( 'woocommerce_before_main_content', array( $this,'thim_wrapper_loop_start'), 5 );
		//add thim_wrapper_loop_end
		add_action( 'woocommerce_after_main_content', array( $this,'thim_wrapper_loop_end'), 50 );
		add_action( 'woocommerce_after_main_content', array( $this,'thim_wrapper_div_close'), 51 );

		//
		add_action( 'thim_before_archive_loop', array( $this,'thim_before_archive_loop_title'), 5 );

	}

	function thim_wrapper_layout() {
		$class_col           = 'col-sm-9 alignleft';
		$prefix              = thim_get_prefix_key();
		$wrapper_layout      = thim_get_theme_option( $prefix . '_layout', 'sidebar-right' );
		$postid = '';
		if ( is_page() || is_single() ) {
			$postid = get_the_ID();
			/***********custom layout*************/
			$using_custom_layout = get_post_meta( $postid, 'thim_mtb_custom_layout', true );
			if ( $using_custom_layout ) {
				$wrapper_layout = get_post_meta( $postid, 'thim_mtb_layout', true );
			}
		}
		if ( $wrapper_layout == 'full-content' || is_404()) {
			$class_col = "col-sm-12 full-width";
		}
		if ( $wrapper_layout == 'sidebar-right' ) {
			$class_col = "col-sm-9 alignleft";
		}
		if ( $wrapper_layout == 'sidebar-left' ) {
			$class_col = 'col-sm-9 alignright';
		}
		if ( $postid == get_option('learn_press_profile_page_id')) {
			$class_col = "col-sm-12 full-width";
		}
		return $class_col;
	}

	public function thim_wrapper_div_open() {
		echo '<div class="content-area">';
	}

	public function thim_wrapper_loop_end() {
		$class_col = $this->thim_wrapper_layout();

		echo '</main>';
		if ( $class_col == 'col-sm-9 alignleft' || $class_col == 'col-sm-9 alignright') {
			if ( get_post_type() == "product" ) {
				get_sidebar( 'shop' );
			} else {
				get_sidebar();
			}
		}
		echo '</div>';

		do_action( 'thim_after_site_content' );

		echo '</div>';
	}

	public function thim_wrapper_loop_start() {
		$sidebar_class = '';
		$class_col     = $this->thim_wrapper_layout();
		if ( $class_col == "col-sm-9 alignleft" ) {
			$sidebar_class = ' sidebar-right';
		}

		if ( $class_col == "col-sm-9 alignright" ) {
			$sidebar_class = ' sidebar-left';
		}


		// no pading top
		if ( is_page() || is_single() ) {
			$mtb_no_padding = get_post_meta( get_the_ID(), 'thim_mtb_no_padding', true );
			if ( $mtb_no_padding ) {
				$sidebar_class .= ' no-padding';
			}
		}

		do_action( 'thim_before_site_content' );

		echo '<div class="container site-content' . $sidebar_class . '">';
		echo '<div class="row"><main id="main" class="site-main ' . $class_col. '">';
	}

	public function thim_before_archive_loop_title() {
 		?>
		<div class="thim-display-mode-header">
			<div class="thim-display-mode switch-layout-container">

				<?php if(!(thim_get_theme_option('thim_archive_hide_title'))) : ?>
					<h1 class="page-title"><?php echo esc_html__('Blog', 'edu-press' ) ?></h1>
				<?php endif; ?>
				<div class="thim-display-mode-right">
					<?php get_search_form('blog'); ?>
				</div>
			</div>
 		<?php
		the_archive_description();
		echo '</div>';
	}

	public function thim_wrapper_div_close() {
		echo '</div>';
	}

	public function thim_wrapper_page_title() {
		$prefix = thim_get_prefix_key();
		//Hide breadcrumbs default from customizer options
		$hide_breadcrumbs = thim_get_theme_option( $prefix . '_hide_breadcrumbs', 0 );

		if ( is_page() || is_single() ) {
			$post_id = get_the_ID();
			//Check using custom heading on single
			$hide_breadcrumbs = get_post_meta( $post_id, 'thim_mtb_hide_breadcrumbs', true );
		}

		if ( $hide_breadcrumbs != '1' && ! is_front_page() && ! is_404() ) {
			?>
			<div class="top_heading">
				<div class="banner-wrapper container">
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
}

new Thim_Wrapper_Layout();
