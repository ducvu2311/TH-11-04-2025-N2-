<?php
/**
 * Template part for displaying posts.
 *
 * @link https://codex.wordpress.org/Template_Hierarchy
 *
 */
$theme_options_data = get_theme_mods();
$column            = ! empty( $theme_options_data['thim_archive_columns_grid'] ) ? $theme_options_data['thim_archive_columns_grid'] : '3';

if ( isset( $_GET['column'] ) ) {
	$column = $_GET['column'];
}
$class = 'column-' . $column . ' col-md-' . ( 12 / $column );


if ( has_post_format( 'link' ) && get_post_meta( get_the_ID(), 'thim_link_url', true ) && get_post_meta( get_the_ID(), 'thim_link_text', true ) ) {
	$url   = get_post_meta( get_the_ID(), 'thim_link_url', true );
	$title = get_post_meta( get_the_ID(), 'thim_link_text', true );
} else {
	$url   = get_permalink();
	$title = get_the_title();
}
?>
<article id="post-<?php the_ID(); ?>" <?php post_class( $class ); ?>>
	<div class="content-inner">
		<?php
			do_action( 'thim_entry_top', 'gallery_thumbnails' );
		?>
		<div class="entry-content">
			<header class="entry-header">
				<?php
				echo sprintf( '<h2 class="entry-title"><a href="%s" rel="bookmark">%s</a></h2>', esc_url( $url ), esc_attr( $title ) );
				?>
			</header>
			<div class="entry-summary">
				<?php
				thim_entry_meta( array('date') );
				the_excerpt();
				?>
			</div>
		</div>
	</div>
</article><!-- #post-## -->
