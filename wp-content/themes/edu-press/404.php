<?php
/**
 * The template for displaying 404 pages (not found).
 *
 * @link https://codex.wordpress.org/Creating_an_Error_404_Page
 *
 */
get_header();

?>

<section class="error-404 not-found">
	<div class="content-404 container">
		<div class="row">
			<header class="page-header">
				<h1 class="title-heading"><?php esc_html_e( '404 Error', 'edu-press' ); ?></h1>
			</header><!-- .page-header -->

			<div class="page-content">
				<img src="<?php echo esc_url( THIM_URI . 'images/image-404.png' ) ?>" alt="<?php esc_attr_e( '404 Error', 'edu-press' ) ?>">
			</div><!-- .page-content -->
		</div>
	</div>
</section><!-- .error-404 -->

</div><!-- #main-content -->
</div><!-- content-pusher -->

<?php get_footer(); ?>


</body>
</html>