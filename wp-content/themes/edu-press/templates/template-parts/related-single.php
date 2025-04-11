<?php
/**
 * Related Post
 *
 */

$related         = thim_get_related_posts();
$related_columns = thim_get_related_columns_class( 'col-md-6 ' );

if ( $related->have_posts() ) {
	?>
	<section class="related-archive">
		<h3 class="related-title"><?php esc_html_e( 'Your Might Also Like', 'edu-press' ); ?></h3>
		<?php
		echo '<ul class="archived-posts blog-content row">';
		while ( $related->have_posts() ) {
			$related->the_post();
			if ( has_post_thumbnail() ) {
				?>
				<li <?php post_class( $related_columns ); ?>>
					<div class="category-posts clear">
						<?php echo thim_get_feature_image( get_post_thumbnail_id(), 'full' ); ?>
						<div class="rel-post-text">
							<h4 class="entry-title">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
							</h4>

							<div class="entry-meta">
								<?php thim_entry_meta_author(); ?>
								<?php thim_entry_meta_date(); ?>
							</div>
						</div>
					</div>
				</li>
				<?php
			} else { ?>
				<li <?php post_class( $related_columns ); ?>>
					<div class="category-posts clear">
						<div class="rel-post-text">
							<h4 class="entry-title no-images">
								<a href="<?php echo esc_url( get_the_permalink() ); ?>" title="<?php echo esc_attr( get_the_title() ); ?>"><?php the_title(); ?></a>
							</h4>

							<div class="entry-meta">
								<?php thim_entry_meta_author(); ?>
								<?php thim_entry_meta_date(); ?>
							</div>
						</div>
						<div class="des-related">
							<?php the_excerpt(); ?>
						</div>
					</div>
				</li>
			<?php }
		}
		echo '</ul>';
		?>
	</section><!--.related-->
	<?php
}

wp_reset_postdata();

?>
