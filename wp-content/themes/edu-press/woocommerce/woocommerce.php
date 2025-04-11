<?php

/**
 * Add action and add filter
 * Class Edu_Press_Woocommerce_Include
 */
class Edu_Press_Woocommerce_Include {
	public function __construct() {
		// remove hook default woocommerce
		$this->remove_hook_default();
		// Hook content product
		$this->hook_content_product();
		// Hook content-single product
		$this->hook_content_single_product();


		// hook wrapper result_count
		add_action( 'woocommerce_before_shop_loop', array( $this, 'woocommerce_result_count_open' ), 11 );
		add_action( 'woocommerce_before_shop_loop', array( $this, 'woocommerce_result_count_close' ), 90 );

		// Quick View
		//add_action( 'woocommerce_after_shop_loop_item_wishlist', 'woocommerce_template_loop_add_to_cart', 4 );
		//add_action( 'woocommerce_after_shop_loop_item_wishlist', array( $this, 'woocommerce_template_loop_wishlist' ), 5 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_title', 5 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_rating', 10 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_excerpt', 20 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_meta', 30 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_sharing', 40 );
		add_action( 'woocommerce_single_product_summary_quick', 'woocommerce_template_single_add_to_cart', 50 );

		///* PRODUCT QUICK VIEW */
		add_action( 'wp_ajax_jck_quickview', array( $this, 'woo_jck_quickview' ) );
		add_action( 'wp_ajax_nopriv_jck_quickview', array( $this, 'woo_jck_quickview' ) );
	}

	function woocommerce_template_loop_product_div_open() {
		echo '<div class="inner-item-product">';
	}

	function woocommerce_template_loop_product_div_close() {
		echo '</div>';
	}

	// hook wrapper result_count
	function woocommerce_result_count_open() {
		echo '<div class="wrapper-result-count">';
	}

	function woocommerce_template_loop_wishlist_before_div() {
		echo '<div class="box-button">';
	}

	function woocommerce_result_count_close() {
		echo '</div>';
	}

	/*
	 * woocommerce_template_controls_list_button
	 */

	function woocommerce_template_loop_quick_view() {
		wp_enqueue_script( 'magnific' );
		wp_enqueue_script( 'slick' );
		echo '<a href="javascript:void(0)" class="quick-view" data-prod="' . get_the_ID() . '"></a>';
	}

	function woocommerce_template_loop_wishlist() {
		echo '<a class="add-to-wish-list">add wish list</a>';
	}

	function woocommerce_template_loop_compare() {
		echo '<a class="add-to-compare">add compare</a>';
	}

	function woocommerce_template_loop_product_actions_before_div() {
		echo '<div class="product-item-actions">';
	}

	function woocommerce_template_loop_product_actions_after_div() {
		echo '</div>';
	}



	function woocommerce_cross_sale_count_mod( $count ) {
		return 3;
	}

	// hidden related product
	function woocommerce__related_products_args( $args ) {
		$args['posts_per_page'] = get_theme_mod( 'number_related', '4' );
		$args['columns']        = get_theme_mod( 'column_related', '4' );

		return $args;
	}

	// Ajax  minicart
	function edu_press_add_to_cart_success_ajax( $count_cat_product ) {
		list( $cart_items ) = edu_press_get_current_cart_info();
		if ( $cart_items < 0 ) {
			$cart_items = '0';
		}
		$count_cat_product['#header-mini-cart .wrapper-items-number'] = '<span class="wrapper-items-number">' . $cart_items . '</span>';

		return $count_cat_product;
	}

	public function woocommerce_template_category_product() {
		global $product;
		echo '<div class="cat_product">';
		echo wc_get_product_category_list( $product->get_id(), ', ', '', '' );
		echo '</div>';
	}

	///* PRODUCT QUICK VIEW */
	function woo_jck_quickview() {
		global $post, $product;
		$prod_id = $_POST["product"];
		$post    = get_post( $prod_id );
		$product = wc_get_product( $prod_id );
		ob_start();
		wc_get_template( 'content-single-product-lightbox.php' );
		$output = ob_get_contents();

		ob_end_clean();
		echo ent2ncr( $output );
		die();
	}

	function hook_content_product() {
		// woocommerce_before_shop_loop_item before
		add_action( 'woocommerce_before_shop_loop_item', function () {
			echo '<div class="inner-item-product">';
		}, 1 );
		add_action( 'woocommerce_after_shop_loop_item', function () {
			echo '</div></div>';
		}, 90 );


		// hook thumbnail image
		add_action( 'woocommerce_before_shop_loop_item_title', function () {
			echo '<div class="product-image">';
		}, 1 );
		add_action( 'woocommerce_before_shop_loop_item_title', function () {
			echo '</div><div class="wrapper-content-item">';
		}, 90 );

		/**
 		 * @see woocommerce_template_loop_product_actions_before_div()
		 * @see woocommerce_template_loop_add_to_cart()
		 * @see woocommerce_template_loop_quick_view() - 20
		 * @see woocommerce_template_loop_wishlist()
		* @see woocommerce_template_loop_compare()
		 * @see woocommerce_template_loop_product_actions_after_div()
		 */
		add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 10 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_product_actions_before_div' ), 11 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_quick_view' ), 20 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_wishlist' ), 25 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_compare' ), 30 );
		add_action( 'woocommerce_before_shop_loop_item_title', array( $this, 'woocommerce_template_loop_product_actions_after_div' ), 40 );
		/**
		 * Product Loop Items.
		 *
		 * @see woocommerce_template_category_product()
 		 */
		add_action( 'woocommerce_shop_loop_item_title', array( $this, 'woocommerce_template_category_product' ), 5 );

	}

	function hook_content_single_product() {
		remove_action( 'woocommerce_after_single_product_summary', 'woocommerce_output_product_data_tabs', 10 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_output_product_data_tabs', 65 );


		// hidden related product
		add_filter( 'woocommerce_output_related_products_args', array( $this, 'woocommerce__related_products_args' ) );
		add_filter( 'woocommerce_cross_sells_columns', array( $this, 'woocommerce_cross_sale_count_mod' ), 21 );

		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 25 );
		add_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 26 );

	}

	function remove_hook_default() {
		remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20, 0 );
		remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );
		remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_price', 10 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_meta', 40 );
		remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_sharing', 50 );
		remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );
	}
}

new Edu_Press_Woocommerce_Include();


/**
 * Custom current cart
 * @return array
 */
function edu_press_get_current_cart_info() {
	global $woocommerce;
	$items = '';
	if ( ! is_admin() ) {
		$items = count( $woocommerce->cart->get_cart() );
	}

	return array( $items, get_woocommerce_currency_symbol() );
}

if ( ! function_exists( 'woocommerce_template_loop_product_title' ) ) {
	function woocommerce_template_loop_product_title() {
		echo '<h2 class="woocommerce-loop-product_title"><a href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '">' . get_the_title() . '</a></h2>';
	}
}
// Override WooCommerce function
if ( ! function_exists( 'woocommerce_template_loop_product_thumbnail' ) ) {
	function woocommerce_template_loop_product_thumbnail() {
		echo '<a href="' . esc_url( get_the_permalink() ) . '" title="' . the_title_attribute( 'echo=0' ) . '" class="wp-post-image">';
		echo woocommerce_get_product_thumbnail();
		echo '</a>';
	}
}
