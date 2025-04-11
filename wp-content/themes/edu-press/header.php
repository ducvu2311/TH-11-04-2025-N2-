<?php
/**
 * The header for our theme.
 *
 * This is the template that displays all of the <head> section and everything up until <div id="content">
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */
?><!DOCTYPE html>
<html itemscope itemtype="http://schema.org/WebPage" <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="profile" href="http://gmpg.org/xfn/11">
	<link rel="pingback" href="<?php bloginfo( 'pingback_url' ); ?>">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>

<?php do_action( 'thim_before_body' ); ?>

<?php if ( function_exists( 'wp_body_open' ) ) {
	wp_body_open();
} ?>
<div id="wrapper-container" class="content-pusher">
<header id="masthead" class="site-header affix-top">

	<?php do_action( 'thim_topbar' ); ?>

	<div class="header-wrap <?php echo esc_attr( apply_filters( 'class_header_layout', 'container' ) ); ?>">
		<div class="row">
			<div class="navigation">
				<div class="width-logo table-cell">
					<?php do_action( 'thim_logo' ); ?>
				</div>

				<nav class="width-navigation table-cell main-navigation">
					<div class="inner-navigation">
						<?php get_template_part( 'templates/header/main-menu' ); ?>
					</div>
					<span class="thim-ekits-menu__mobile__close"><i class="tk tk-times"></i></span>
				</nav>

				<?php if ( is_active_sidebar( 'menu_right' ) ) : ?>
					<div class="width-header-right table-cell">
						<div class="header-right">
							<?php dynamic_sidebar( 'menu_right' ) ?>
						</div>
					</div>
				<?php endif; ?>

				<div class="menu-mobile-effect navbar-toggle">
					<span></span>
					<span></span>
					<span></span>
				</div>
			</div>
		</div>
	</div>
</header><!-- #masthead -->
