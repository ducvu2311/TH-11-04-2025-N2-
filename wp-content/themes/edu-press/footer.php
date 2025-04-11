<?php
/**
 * The template for displaying the footer.
 *
 * Contains the closing of the #main-content div and all content after.
 *
 * @link    https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 */

/**
 * thim_wrapper_loop_start hook
 *
 * @hooked thim_footer_layout - 10
 */
do_action( 'thim_footer_area' );

/**
 *
 * @hooked thim_back_to_top - 10
 */
do_action( 'thim_space_body' ); ?>

<?php wp_footer(); ?>
</div>
</body>
</html>
