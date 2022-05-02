<?php
/**
 * Order Customer Details
 *
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
$show_shipping = ! wc_ship_to_billing_address_only() && $order->needs_shipping_address();
?>
<div class="col-md-12 col-sm-12 col-xs-12">
	
	<div class="col2-set addresses row">
		<div class="col-1 col-md-6 col-sm-6 col-xs-12">
			<div class="title">
				<h3 class="black-text font-weight-600 text-uppercase text-large margin-bottom-10px"><?php esc_html_e( 'Billing address', 'woocommerce' ); ?></h3>
			</div>
			<address>
				<?php echo wp_kses_post( $order->get_formatted_billing_address( __( 'N/A', 'woocommerce' ) ) ); ?>
				<?php if ( $order->get_billing_phone() ) : ?>
					<p class="woocommerce-customer-details--phone"><?php echo esc_html( $order->get_billing_phone() ); ?></p>
				<?php endif; ?>
				<?php if ( $order->get_billing_email() ) : ?>
					<p class="woocommerce-customer-details--email"><?php echo esc_html( $order->get_billing_email() ); ?></p>
				<?php endif; ?>
			</address>
		</div><!-- /.col-1 -->
		<?php if ( $show_shipping ) : ?>
		<div class="col-2 col-md-6 col-sm-6 col-xs-12">
			<div class="title">
				<h3 class="black-text font-weight-600 text-uppercase text-large margin-bottom-10px"><?php esc_html_e( 'Shipping address', 'woocommerce' ); ?></h3>
			</div>
			<address>
				<?php echo wp_kses_post( $order->get_formatted_shipping_address( __( 'N/A', 'woocommerce' ) ) ); ?>
			</address>
		</div><!-- /.col-2 -->
		<?php endif; ?>
	</div><!-- /.col2-set -->
	<?php do_action( 'woocommerce_order_details_after_customer_details', $order ); ?>
</div>