<?php

namespace Edu_Press\Init;

/**
 * Add action and add filter
 */
class init {
	public function __construct() {

		// action back to top
		add_action( 'thim_space_body', array( $this, 'back_to_top' ), 10 );
		// add preloading for site
		add_action( 'thim_before_body', array( $this, 'thim_preloading' ), 10 );
		add_action( 'thim_ekit/header_footer/template/before_header', array( $this, 'thim_preloading' ), 5 );
		// Template kit footer and header
		add_action( 'thim_ekit/header_footer/template/after_footer', function () {
			echo '</div>';
		}, 1 );
		add_action( 'thim_ekit/header_footer/template/after_footer', function () {
			do_action( 'thim_space_body' );
		} );
		add_action( 'thim_ekit/header_footer/template/before_header', function () {
			echo '<div id="wrapper-container" class="content-pusher">';
		}, 10 );

		//Register widget area.
		add_action( 'widgets_init', array( $this, 'register_widgets_init' ) );
		// after_setup_theme
		add_action( 'after_setup_theme', array( $this, 'setup_theme' ) );
		// register style and script
		add_action( 'wp_enqueue_scripts', array( $this, 'frontend_scripts' ), 100 );
		add_action( 'admin_enqueue_scripts', array( $this, 'admin_scripts' ) );


		// Display Topbar
		add_action( 'thim_topbar', array( $this, 'topbar_area' ), 10 );
		// footer area
		add_action( 'thim_footer_area', array( $this, 'footer_area' ), 10 );


		// remove input website in comment form
		add_filter( 'comment_form_fields', array( $this, 'move_comment_field_to_bottom' ) );

		// Define ajaxurl if not exist
		add_action( 'wp_head', array( $this, 'define_ajaxurl' ), 1000 );

		// Redirect to custom register page in case multi sites
		add_filter( 'wp_signup_location', array( $this, 'multisite_register_redirect' ) );
		//Thim core List child themes.
		add_filter( 'thim_core_list_child_themes', array( $this, 'list_child_themes' ) );

		// change length excerpt
		add_filter( 'excerpt_length', array( $this, 'excerpt_length' ), 99999 );
		add_filter( 'excerpt_more', array( $this, 'excerpt_more' ) );
		// remove prefix of archive title
		add_filter( 'get_the_archive_title_prefix', '__return_false' );
		// share product
		add_action( 'woocommerce_share', array( $this, 'social_share' ) );
		add_action( 'thim_social_share', array( $this, 'social_share' ) );
		remove_action( 'learn-press/before-main-content', 'learn_press_breadcrumb', 10 );

	}

	/* Share social */
	function social_share() {
		$sharings = get_theme_mod( 'group_sharing' );

		if ( isset( $sharings ) && $sharings ) {
			echo '<ul class="thim-social-share">';
			do_action( 'before_social_share_list' );

			echo '<li class="heading">' . esc_html__( 'Share:', 'edu-press' ) . '</li>';
			foreach ( $sharings as $sharing ) {
				switch ( $sharing ) {
					case 'facebook':
						echo '<li><div class="facebook-social"><a target="_blank" class="facebook"  href="https://www.facebook.com/sharer.php?u=' . urlencode( get_permalink() ) . '" title="' . esc_attr__( 'Facebook', 'edu-press' ) . '"><i class="tk tk-face"></i></a></div></li>';
						break;
					case 'twitter':
						echo '<li><div class="twitter-social"><a target="_blank" class="twitter" href="https://twitter.com/share?url=' . urlencode( get_permalink() ) . '&amp;text=' . rawurlencode( esc_attr( get_the_title() ) ) . '" title="' . esc_attr__( 'Twitter', 'edu-press' ) . '"><i class="tk tk-twitter"></i></a></div></li>';
						break;
					case 'pinterest':
						echo '<li><div class="pinterest-social"><a target="_blank" class="pinterest"  href="http://pinterest.com/pin/create/button/?url=' . urlencode( get_permalink() ) . '&amp;description=' . rawurlencode( esc_attr( get_the_excerpt() ) ) . '&amp;media=' . urlencode( wp_get_attachment_url( get_post_thumbnail_id() ) ) . '" onclick="window.open(this.href); return false;" title="' . esc_attr__( 'Pinterest', 'edu-press' ) . '"><i class="tk tk-pinterest-p"></i></a></div></li>';
						break;
				}
			}

			do_action( 'after_social_share_list' );

			echo '</ul>';
		}

	}

	//Thim core List child themes.
	public function list_child_themes() {
		return array(
			'edu-press-child' => array(
				'name'       => 'EduPress Child',
				'slug'       => 'edu-press-child',
				'screenshot' => 'https://raw.githubusercontent.com/ThimPressWP/demo-data/master/edu-press/images/child-theme.png',
				'source'     => 'https://github.com/ThimPressWP/demo-data/raw/master/edu-press/child-themes/edu-press-child.zip',
				'version'    => '1.0.0'
			),
		);
	}

	public function multisite_register_redirect( $url ) {

		if ( ! is_user_logged_in() ) {
			if ( is_multisite() ) {
				$url = add_query_arg( 'action', 'register', $this->thim_get_login_page_url() );
			}

			$user_login = isset( $_POST['user_login'] ) ? $_POST['user_login'] : '';
			$user_email = isset( $_POST['user_email'] ) ? $_POST['user_email'] : '';
			$errors     = register_new_user( $user_login, $user_email );
			if ( ! is_wp_error( $errors ) ) {
				$redirect_to = ! empty( $_POST['redirect_to'] ) ? $_POST['redirect_to'] : 'wp-login.php?checkemail=registered';
				wp_safe_redirect( $redirect_to );
				exit();
			}
		}

		return $url;
	}

	public function define_ajaxurl() {
		?>
		<script type="text/javascript">
			if (typeof ajaxurl === 'undefined') {
				/* <![CDATA[ */
				var ajaxurl = "<?php echo esc_js( admin_url( 'admin-ajax.php' ) ); ?>";
				/* ]]> */
			}
		</script>
		<?php
	}

	/**
	 * Move field comment bellow input fields
	 *
	 * @param $fields
	 *
	 * @return mixed
	 */
	function move_comment_field_to_bottom( $fields ) {

		$comment_field = $fields['comment'];

		unset( $fields['comment'] );

		$fields['comment'] = $comment_field;

		return $fields;
	}

	/**
	 *
	 * Display Topbar
	 *
	 * @return void
	 *
	 */

	public function topbar_area() {
		if ( is_active_sidebar( 'topbar' ) ) {
			echo '<div id="thim-header-topbar" >';
			if ( is_active_sidebar( 'topbar' ) ) {
				dynamic_sidebar( 'topbar' );
			}
			echo '</div>';
		}
	}

	/**
	 * Turn on and get the back to top
	 */
	public function back_to_top() {
		if ( get_theme_mod( 'feature_backtotop', true ) ) {
			echo '<div id="back-to-top" class="btn-back-to-top"><i class="tk tk-arrow-up"></i></div>';
		}
	}

	public function footer_area() {
		$template_name = 'templates/footer/' . get_theme_mod( 'footer_template', 'default' );
		echo '<footer id="colophon" class="site-footer">';
		get_template_part( $template_name );
		echo '</footer><!-- #colophon -->';
	}

	/**
	 * Register widget area.
	 *
	 * @link https://developer.wordpress.org/themes/functionality/sidebars/#registering-a-sidebar
	 */
	public function register_widgets_init() {

		register_sidebar(
			array(
				'name'          => esc_html__( 'Sidebar', 'edu-press' ),
				'id'            => 'sidebar',
				'description'   => esc_html__( 'Appears in the Sidebar section of the site.', 'edu-press' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);
		/**
		 * Sidebar for module Topbar
		 */
		register_sidebar(
			array(
				'name'          => esc_html__( 'Topbar ', 'edu-press' ),
				'id'            => 'topbar',
				'description'   => esc_html__( 'Display in topbar.', 'edu-press' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);


		register_sidebar(
			array(
				'name'          => esc_html__( 'Menu Right', 'edu-press' ),
				'id'            => 'menu_right',
				'description'   => esc_html__( 'Display in menu right item.', 'edu-press' ),
				'before_widget' => '<li id="%1$s" class="widget-menu-item %2$s">',
				'after_widget'  => '</li>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);

		register_sidebar(
			array(
				'name'          => esc_html__( 'Footer Sidebar', 'edu-press' ),
				'id'            => 'footer-sidebar',
				'description'   => esc_html__( 'Sidebar display widgets.', 'edu-press' ),
				'before_widget' => '<aside id="%1$s" class="widget %2$s">',
				'after_widget'  => '</aside>',
				'before_title'  => '<h3 class="widget-title">',
				'after_title'   => '</h3>',
			)
		);


		register_sidebar(
			array(
				'name'          => esc_html__( 'Copyright', 'edu-press' ),
				'id'            => 'copyright',
				'description'   => esc_html__( 'Appears in the copyright section of the site.', 'edu-press' ),
				'before_widget' => '<div class="widget %2$s">',
				'after_widget'  => '</div>',
				'before_title'  => '',
				'after_title'   => '',
			)
		);
	}

	/**
	 * Sets up theme defaults and registers support for various WordPress features.
	 *
	 * Note that this function is hooked into the after_setup_theme hook, which
	 * runs before the init hook. The init hook is too late for some features, such
	 * as indicating support for post thumbnails.
	 */
	public function setup_theme() {
		/**
		 * Set the content width in pixels, based on the theme's design and stylesheet.
		 *
		 * Priority 0 to make it available to lower priority callbacks.
		 *
		 * @global int $content_width
		 */
		$GLOBALS['content_width'] = apply_filters( 'thim_content_width', 640 );
		/*
		 * Make theme available for translation.
		 * Translations can be filed in the /languages/ directory.
		 * If you're building a theme based on this theme, use a find and replace
		 * to change 'edu-press' to the name of your theme in all the template files.
		 */
		load_theme_textdomain( 'edu-press', THIM_DIR . '/languages' );

		// Add default posts and comments RSS feed links to head.
		add_theme_support( 'automatic-feed-links' );

		/*
		 * Let WordPress manage the document title.
		 * By adding theme support, we declare that this theme does not use a
		 * hard-coded <title> tag in the document head, and expect WordPress to
		 * provide it for us.
		 */
		add_theme_support( 'title-tag' );

		/*
		 * Enable support for Post Thumbnails on posts and pages.
		 *
		 * @link https://developer.wordpress.org/themes/functionality/featured-images-post-thumbnails/
		 */
		add_theme_support( 'post-thumbnails' );

		// This theme uses wp_nav_menu() in one location.
		register_nav_menus(
			array(
				'primary' => esc_html__( 'Primary Menu', 'edu-press' ),
			)
		);

		/*
		 * Switch default core markup for search form, comment form, and comments
		 * to output valid HTML5.
		 */
		add_theme_support(
			'html5', array(
				'search-form',
				'comment-form',
				'comment-list',
				'gallery',
				'caption',
			)
		);

		/*
		 * Enable support for Post Formats.
		 * See https://developer.wordpress.org/themes/functionality/post-formats/
		 */
		add_theme_support(
			'post-formats', array(
				'aside',
				'image',
				'video',
				'audio',
				'link',
				'gallery',
			)
		);


		// Enqueue editor styles.
		add_editor_style( 'style-editor.css' );

		add_theme_support( 'thim-core' );
		add_theme_support( 'thim-core-lite' );
		add_theme_support( 'woocommerce' );
		add_theme_support( 'wc-product-gallery-slider' );

		add_theme_support( 'custom-logo' );
		add_theme_support( 'custom-header' );
		add_theme_support( 'custom-background' );
		/*
		 * Gutenberg
		 */
		add_theme_support( 'wp-block-styles' );
		// Add support for full and wide align images.
		add_theme_support( 'align-wide' );

		// Add support for responsive embeds.
		add_theme_support( 'responsive-embeds' );
		// Add theme support for selective refresh for widgets.
		add_theme_support( 'customize-selective-refresh-widgets' );

		add_filter( 'script_loader_tag', array( $this, 'filter_script_loader_tag' ), 10, 2 );
		//
		add_filter( 'thim_core_enqueue_file_css_customizer', '__return_false' );
		// remove wp_global_styles_render_svg_filters
		remove_action( 'wp_body_open', 'wp_global_styles_render_svg_filters' );

		add_filter( 'thim_importer_basic_settings', array( $this, 'thim_import_add_basic_settings' ) );
		add_filter( 'thim_importer_thim_enable_mega_menu', '__return_true' );
		add_filter( 'thim_importer_page_id_settings', array( $this, 'thim_import_add_page_id_settings' ) );
		add_filter( 'thim_theme_customizer_section', array( $this, 'thim_customizer_section') );

		// add folder download data demo
		add_filter( 'thim_prefix_folder_download_data_demo', function () {
			return 'edu-press';
		} );
	}

	public function thim_import_add_basic_settings( $settings ) {
		$settings[] = 'edu_press_option';
		$settings[] = 'thim_enable_mega_menu';
		$settings[] = 'thim_ekits_widget_settings';
		$settings[] = 'elementor_css_print_method';
		$settings[] = 'elementor_experiment-container';
		$settings[] = 'elementor_experiment-nested-elements';
		$settings[]	= 'elementor_google_font';
		$settings[]	= 'elementor_disable_typography_schemes';
		$settings[] = 'elementor_experiment-e_font_icon_svg';
		$settings[] = 'thim_ekits_advanced_settings';
		$settings[] = 'learn_press_layout_single_course';

		return $settings;
	}

	function thim_import_add_page_id_settings( $settings ) {
		$settings[] = 'elementor_active_kit';

		return $settings;
	}
 	public function thim_customizer_section() {

		$section = array(
			'panel'   => array( 'general', 'header', 'blog',  'woocommerce' , 'footer', 'widgets', 'nav_menus' ),
			'section' => array('course', 'typography', 'styling', 'advanced')
		);
		if ( ! class_exists( 'LearnPress' ) ) {
			unset( $section['section']['0'] );
		}
		if ( ! class_exists( 'WooCommerce' ) ) {
			unset( $section['panel']['4'] );
		}

		return $section;

	}

	public function filter_script_loader_tag( $tag, $handle ) {
		foreach ( array( 'async', 'defer' ) as $attr ) {
			if ( ! wp_scripts()->get_data( $handle, $attr ) ) {
				continue;
			}
			// Prevent adding attribute when already added in #12009.
			if ( ! preg_match( ":\s$attr(=|>|\s):", $tag ) ) {
				$tag = preg_replace( ':(?=></script>):', " $attr", $tag, 1 );
			}
			// Only allow async or defer, not both.
			break;
		}

		return $tag;
	}

	/**
	 * Enqueue scripts and styles.
	 */
	public function frontend_scripts() {
		// Enqueue Styles

		wp_enqueue_style( 'thim-style', get_stylesheet_uri(), array(), THIM_THEME_VERSION );
		$css     = '';
		$var_css = ':root{' . apply_filters( 'thim_get_var_css_customizer', $css ) . '}';
		wp_add_inline_style( 'thim-style', $var_css );

		if ( ! class_exists( 'TP' ) ) {
			wp_enqueue_style( 'thim-fontgoogle-default', 'https://fonts.googleapis.com/css2?family=Jost:wght@400;500;600;700;800&display=swap', array(), THIM_THEME_VERSION );
		}
		//	RTL
		if ( is_rtl() ) {
			wp_enqueue_style( 'style-rtl', THIM_URI . 'rtl.css', array(), THIM_THEME_VERSION );
		}
		wp_enqueue_style( 'elementor-icons-thim-ekits-fonts', THIM_URI . 'assets/css/thim-ekits-icons.min.css', array(), THIM_THEME_VERSION );
		// Enqueue Scripts
		wp_register_script( 'flexslider', THIM_URI . 'assets/js/jquery.flexslider-min.js', array( 'jquery' ), THIM_THEME_VERSION, true );

		wp_enqueue_script( 'theia-sticky-sidebar', THIM_URI . 'assets/js/theia-sticky-sidebar.js', array( 'jquery' ), THIM_THEME_VERSION, true );
		wp_enqueue_script( 'thim-custom', THIM_URI . 'assets/js/thim-custom.js', array( 'jquery' ), THIM_THEME_VERSION, true );

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}

	/**
	 * Enqueue admin scripts and styles.
	 */
	public function admin_scripts() {
		wp_enqueue_script( 'dismissible-notices', THIM_URI . 'inc/admin/assets/scripts.js', array( 'jquery', 'common' ), THIM_THEME_VERSION, true );
		wp_localize_script( 'dismissible-notices', 'dismissible_notice', array( 'nonce' => wp_create_nonce( 'dismissible-notice' ), ) );
	}

	/**
	 * Theme Feature: Preload
	 *
	 * @return bool
	 * @return string HTML for preload
	 */

	public function thim_preloading() {
		$preloading = get_theme_mod( 'theme_feature_preloading', 'off' );

		if ( $preloading != 'off' ) {

			echo '<div id="thim-preloading">';

			switch ( $preloading ) {
				case 'custom-image':
					$preloading_image = get_theme_mod( 'theme_feature_preloading_custom_image', false );
					if ( $preloading_image ) {
						if ( locate_template( 'templates/features/preloading/' . $preloading . '.php' ) ) {
							include locate_template( 'templates/features/preloading/' . $preloading . '.php' );
						}
					}
					break;
				default:
					if ( locate_template( 'templates/features/preloading/' . $preloading . '.php' ) ) {
						include locate_template( 'templates/features/preloading/' . $preloading . '.php' );
					}
					break;
			}

			echo '</div>';

		}
	}

	/**
	 *
	 * Excerpt Length
	 * @return string
	 */
	public function excerpt_length() {
		$thim_options = get_theme_mods();

		if ( isset( $thim_options['thim_archive_excerpt_length'] ) ) {
			$length = get_theme_mod( 'thim_archive_excerpt_length' );
		} else {
			$length = '50';
		}

		return $length;
	}

	/**
	 * Change excerpt more
	 * @return string
	 */
	public function excerpt_more() {
		return '...';
	}

	public function thim_get_login_page_url() {
		$page = get_option( 'thim_login_page' );
		if ( $page ) {
			return get_permalink( $page );
		} else {
			global $wpdb;
			$page = $wpdb->get_col(
				$wpdb->prepare(
					"SELECT p.ID FROM $wpdb->posts AS p INNER JOIN $wpdb->postmeta AS pm ON p.ID = pm.post_id
						WHERE 	pm.meta_key = %s
						AND 	pm.meta_value = %s
						AND		p.post_type = %s
						AND		p.post_status = %s",
					'thim_login_page',
					'1',
					'page',
					'publish'
				)
			);
			if ( ! empty( $page[0] ) ) {
				return get_permalink( $page[0] );
			}
		}

		return wp_login_url();
	}
}

new init();
