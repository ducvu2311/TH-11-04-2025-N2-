<?php
/**
 * Footer template: Default
 *
 * @package Edu_Press
 */
?>


<?php
if ( is_active_sidebar( 'footer-sidebar' ) ) {
	echo '<div class="footer"><div class="container">';
	dynamic_sidebar( 'footer-sidebar' );
	echo '</div></div>';
}
?>

<div class="copyright-area">
	<div class="container">
		<div class="row">
			<?php thim_copyright_bar(); ?>

			<?php
			if ( is_active_sidebar( 'copyright' ) ) {
				echo '<div class="col-sm-6 text-right">';
				dynamic_sidebar( 'copyright' );
				echo '</div>';
			}
			?>
		</div>
	</div>
</div>
