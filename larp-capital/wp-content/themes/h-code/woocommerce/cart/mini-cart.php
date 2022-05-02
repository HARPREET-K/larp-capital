<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     5.2.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if( ! WC()->cart ) {
	return;
} 

do_action( 'woocommerce_before_mini_cart' ); ?>

<div class="top-cart">
    <a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="shopping-cart">
        <i class="fas fa-shopping-cart"></i>
        <div class="subtitle">
        	<?php 
				if( WC()->cart->cart_contents_count == 0 ) {
					echo esc_html_e( '(0) item', 'H-Code' );
				} elseif( WC()->cart->cart_contents_count == 1 ) {
					printf( esc_html__( '(%d) item', 'H-Code' ), WC()->cart->cart_contents_count );
				} else {
					printf( esc_html__( '(%d) items', 'H-Code' ), WC()->cart->cart_contents_count );
				}
			?>
		</div>
		<div class="subtitle-mobile">
        	<?php 
				if( WC()->cart->cart_contents_count == 0 ) {
					echo '0';
				} elseif( WC()->cart->cart_contents_count == 1 ) {
					printf( '%d', WC()->cart->cart_contents_count );
				} else {
					printf( '%d', WC()->cart->cart_contents_count );
				}
			?>
		</div>
    </a>
	<div class="cart-content">
		<ul class="woocommerce-mini-cart cart-list product_list_widget">

			<?php if ( ! WC()->cart->is_empty() ) : ?>

				<?php
					do_action( 'woocommerce_before_mini_cart_contents' );

					foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
						$_product     = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
						$product_id   = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

						if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {

							$product_name      = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
							$thumbnail     = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
							$product_price = apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key );
							$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
							?>
							<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mini_cart_item', $cart_item, $cart_item_key ) ); ?>">
								<?php
								echo apply_filters( 'woocommerce_cart_item_remove_link', sprintf(
									'<a href="%s" class="remove remove_from_cart_button" aria-label="%s" data-product_id="%s" data-cart_item_key="%s" data-product_sku="%s">&times;</a>',
									esc_url( wc_get_cart_remove_url( $cart_item_key ) ),
									esc_attr__( 'Remove this item', 'woocommerce' ),
									esc_attr( $product_id ),
									esc_attr( $cart_item_key ),
									esc_attr( $_product->get_sku() )
								), $cart_item_key );
								?>
								<?php if ( empty( $product_permalink ) ) : ?>
									<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
								<?php else : ?>
									<a href="<?php echo esc_url( $product_permalink ); ?>">
										<?php echo $thumbnail; // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
									</a>
								<?php endif; ?>
								
								<div class="mini-cart-product-box">
									<?php if ( empty( $product_permalink ) ) : ?>
										<?php echo esc_attr( $product_name ); ?>
									<?php else : ?>
										<a href="<?php echo esc_url( $product_permalink ); ?>" class="mini-cart-title">
											<?php echo esc_attr( $product_name ); ?>
										</a>
									<?php endif; ?>
									<?php echo wc_get_formatted_cart_item_data( $cart_item ); ?>

									<?php echo apply_filters( 'woocommerce_widget_cart_item_quantity', '<span class="quantity">' . sprintf( '%s &times; %s', $cart_item['quantity'], $product_price ) . '</span>', $cart_item, $cart_item_key ); ?>
									<a href="<?php echo esc_url( $_product->get_permalink( $cart_item ) ); ?>" class="mini-cart-edit"><?php  esc_html_e( 'Edit', 'woocommerce' ); ?></a>
								</div>
							</li>
							<?php
						}
					}
					do_action( 'woocommerce_mini_cart_contents' );
				?>

			<?php else : ?>

				<li class="empty woocommerce-mini-cart__empty-message"><?php esc_html_e( 'No products in the cart.', 'woocommerce' ); ?></li>

			<?php endif; ?>

		</ul>
	
	<?php if ( ! WC()->cart->is_empty() ) : ?>		

		<p class="woocommerce-mini-cart__total total">
			<?php
			/**
			 * Hook: woocommerce_widget_shopping_cart_total.
			 *
			 * @hooked woocommerce_widget_shopping_cart_subtotal - 10
			 */
			do_action( 'woocommerce_widget_shopping_cart_total' );
			?>
		</p>

		<?php do_action( 'woocommerce_widget_shopping_cart_before_buttons' ); ?>

		<p class="buttons">
			
			<?php do_action( 'woocommerce_widget_shopping_cart_buttons' ); ?>
			
			<a href="<?php echo esc_url( wc_get_cart_url() ); ?>" class="btn btn-very-small-white no-margin-bottom margin-seven pull-left no-margin-lr cart"><?php esc_html_e( 'View cart', 'woocommerce' ); ?></a>
			<a href="<?php echo esc_url( wc_get_checkout_url() ); ?>" class="btn btn-very-small-white no-margin-bottom margin-seven no-margin-right pull-right checkout"><?php esc_html_e( 'Checkout', 'woocommerce' ); ?></a>
		</p>

	<?php endif; ?>
	</div>
	<!-- end shopping bag content -->
</div>
<?php do_action( 'woocommerce_after_mini_cart' ); ?>
