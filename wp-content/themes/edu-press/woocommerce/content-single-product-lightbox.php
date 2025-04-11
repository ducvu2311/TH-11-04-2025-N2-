<?php

if ( !defined( 'ABSPATH' ) ) {
	exit;
} // Exit if accessed directly

global $post, $product;
$attachment_ids = $product->get_gallery_image_ids();
?>

<div class="woocommerce">
	<div id="product-<?php the_ID(); ?>" class="product shop-single-v1-section">
		<div class="images images_quick_view">
  			<?php
			do_action( 'woocommerce_before_single_product_summary' );
			?>
		</div>

		<div class="summary summary_quick_view">
			<?php
//			wp_enqueue_script( 'variations' );
			/**
			 * woocommerce_single_product_summary hook
			 *
			 * @hooked woocommerce_template_single_title - 5
			 * @hooked woocommerce_template_single_price - 10
			 * @hooked woocommerce_template_single_excerpt - 20
			 * @hooked woocommerce_template_single_add_to_cart - 30
			 * @hooked woocommerce_template_single_meta - 40
			 * @hooked woocommerce_template_single_sharing - 50
			 */
			do_action( 'woocommerce_single_product_summary_quick' );
			?>
		</div>
	</div>
</div>