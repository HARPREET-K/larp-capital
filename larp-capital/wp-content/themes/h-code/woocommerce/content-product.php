<?php
/**
 * The template for displaying product content within loops
 *
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

// Ensure visibility.
if ( empty( $product ) || ! $product->is_visible() ) {
	return;
}

?>
<div <?php wc_product_class( '', $product ); ?>>
<?php
	echo '<div class="home-product text-center position-relative overflow-hidden">';
		
		echo '<div class="product-image-wrapper">';

			/**
			 * Hook: woocommerce_before_shop_loop_item.
			 *
			 * @hooked woocommerce_template_loop_product_link_open - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item' ); /* Link start here */
			
			/**
			 * woocommerce_before_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_product_thumbnail - 10
			 */
			do_action( 'woocommerce_before_shop_loop_item_title' );
			
			echo '</a>'; /* Link end here */
			
			/**
			* hcode_sale_flash hook
			*
			* @hooked hcode_sale_flash - 10
			*
			*/
			do_action ( 'hcode_sale_flash' );

		echo '</div>';
		echo '<div class="product-content-wrapper">';
			echo '<span class="product-name text-uppercase">';
						
				$link = apply_filters( 'woocommerce_loop_product_link', get_the_permalink(), $product );
				echo '<a href="' . esc_url( $link ) . '" class="woocommerce-LoopProduct-link woocommerce-loop-product__link">';

				/**
				 * woocommerce_shop_loop_item_title hook
				 *
				 * @hooked woocommerce_template_loop_product_title - 10
				 */
				do_action( 'woocommerce_shop_loop_item_title' );

				echo '</a>';

			echo '</span>';
			
			/**
			 * hcode_woocommerce_product_title_stock_and_shipping_available hook
			 *
			 * @hooked hcode_woocommerce_product_title_stock_and_shipping_available - 5
			 */
			do_action( 'hcode_woocommerce_product_title_stock_and_shipping_available' );

			
			/* Show product excerpt for list view only */
			do_action( 'hcode_woocommerce_product_list_excerpt' );

			
			/**
			 * woocommerce_after_shop_loop_item_title hook
			 *
			 * @hooked woocommerce_template_loop_rating - 5
			 * @hooked woocommerce_template_loop_price - 10
			 */
			do_action( 'woocommerce_after_shop_loop_item_title' );
		
			echo '<div class="quick-buy">';
				echo '<div class="product-share">';

					/**
					 * woocommerce_after_shop_loop_item hook
					 *
					 * @hooked woocommerce_template_loop_add_to_cart - 10
					 */
					do_action( 'woocommerce_after_shop_loop_item' );

				echo '</div>';
			echo '</div>';
		echo '</div>';
	echo '</div>';
	?>
</div>