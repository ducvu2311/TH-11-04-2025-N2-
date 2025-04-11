<?php
/**
 * Template part for displaying single.
 *
 * @link    https://codex.wordpress.org/Template_Hierarchy
 *
 */

?>

<article id="post-<?php the_ID(); ?>" <?php post_class(); ?>>
	<div class="content-inner">
		
		<?php do_action( 'thim_entry_top', 'full' ); ?>

		<div class="entry-content">
			<header class="entry-header">
				<?php
				the_title( '<h1 class="entry-title">', '</h1>' );
				?>
				<?php thim_entry_meta(); ?>
			</header>

			<div class="entry-summary">
				<?php
				// Get post content
				the_content();

				wp_link_pages(
					array(
						'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'edu-press' ),
						'after'  => '</div>',
					)
				);

				?>
			</div>

			<div class="entry-tag-share">
				<?php do_action( 'thim_social_share' ); ?>
				<?php if ( get_theme_mod( 'show_tags_meta_tags', true ) ) : ?>
					<?php thim_entry_meta_tags(); ?>
				<?php endif; ?>
			</div>

		</div>

	</div><!-- .content-inner -->

	<?php	do_action( 'thim_post_footer' ); ?>
	
</article><!-- #post-## -->
