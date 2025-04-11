<?php
/**
 * The template for displaying search results pages.
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#search-result
 *
 */

get_header();
/**
 * thim_wrapper_loop_start hook
 *
 * @hooked thim_wrapper_loop_start - 1
 * @hooked thim_wrapper_page_title - 5
 * @hooked thim_wrapper_loop_start - 30
 */

do_action( 'thim_wrapper_loop_start' );

if ( have_posts() ) : ?>

	<div class="row blog-content">
		<?php
		/* Start the Loop */
		while ( have_posts() ) : the_post();

			get_template_part( 'templates/template-parts/content', 'search' );

		endwhile;
		?>
	</div><!-- .blog-content.blog-list -->

	<?php thim_paging_nav(); ?>

<?php else : ?>

	<?php get_template_part( 'templates/template-parts/content', 'none' ); ?>

<?php endif; ?>

<?php
/**
 * thim_wrapper_loop_end hook
 *
 * @hooked thim_wrapper_loop_end - 10
 * @hooked thim_wrapper_div_close - 30
 */
do_action( 'thim_wrapper_loop_end' );

get_footer();
?>
