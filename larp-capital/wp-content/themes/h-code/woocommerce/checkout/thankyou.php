<?php
/**
 * Thankyou page
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/checkout/thankyou.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.7.0
 */

defined( 'ABSPATH' ) || exit;
?>
<?php
if ( $order ) : ?>
	<section class="order-receive-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 margin-five-bottom">

				<?php 

				do_action( 'woocommerce_before_thankyou', $order->get_id() );

				if ( $order->has_status( 'failed' ) ) : ?>

					<h4 class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed"><?php _e( 'Unfortunately your order cannot be processed as the originating bank/merchant has declined your transaction. Please attempt your purchase again.', 'woocommerce' ); ?></h4>

					<p class="woocommerce-notice woocommerce-notice--error woocommerce-thankyou-order-failed-actions">
						<a href="<?php echo esc_url( $order->get_checkout_payment_url() ); ?>" class="button pay highlight-button btn btn-very-small no-margin"><?php esc_html_e( 'Pay', 'woocommerce' ) ?></a>
						<?php if ( is_user_logged_in() ) : ?>
						<a href="<?php echo esc_url( wc_get_page_permalink( 'myaccount' ) ); ?>" class="button pay highlight-button btn btn-very-small no-margin"><?php esc_html_e( 'My account', 'woocommerce' ); ?></a>
						<?php endif; ?>
					</p>

				<?php else : ?>

					<h4 class="margin-bottom-10px"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', esc_html__( 'Thank you. Your order has been received.', 'woocommerce' ), $order ); ?></h4>

					<ul class="order_details">
						<li class="order">
							<?php esc_html_e( 'Order number:', 'woocommerce' ); ?>
							<strong><?php echo wp_kses_post($order->get_order_number()); ?></strong>
						</li>
						<li class="date">
							<?php esc_html_e( 'Date:', 'woocommerce' ); ?>
							<strong><?php echo wc_format_datetime( $order->get_date_created() ); ?></strong>
						</li>
						<?php if ( is_user_logged_in() && $order->get_user_id() === get_current_user_id() && $order->get_billing_email() ) : ?>
							<li class="woocommerce-order-overview__email email">
								<?php _e( 'Email:', 'woocommerce' ); ?>
								<strong><?php echo wp_kses_post($order->get_billing_email()); ?></strong>
							</li>
						<?php endif; ?>
						<li class="total">
							<?php esc_html_e( 'Total:', 'woocommerce' ); ?>
							<strong><?php echo wp_kses_post($order->get_formatted_order_total()); ?></strong>
						</li>
						<?php if ( $order->get_payment_method_title() ) : ?>
						<li class="method">
							<?php esc_html_e( 'Payment method:', 'woocommerce' ); ?>
							<strong><?php echo wp_kses_post( $order->get_payment_method_title() ); ?></strong>
						</li>
						<?php endif; ?>
					</ul>
					<div class="clear"></div>

				<?php endif; ?>
				<?php do_action( 'woocommerce_thankyou_' . $order->get_payment_method(), $order->get_id() ); ?>
				</div>

			<?php do_action( 'woocommerce_thankyou', $order->get_id() ); ?>

			<?php do_action( 'hcode_woocommerce_continue_shopping_link' ); ?>

			</div>
		</div>
	</section>

<?php else : ?>
	<section class="order-receive-wrapper">
		<div class="container">
			<div class="row">
				<div class="col-md-12 col-sm-12 col-xs-12 margin-five-bottom">
					<h4 class="margin-bottom-10px woocommerce-thankyou-order-received"><?php echo apply_filters( 'woocommerce_thankyou_order_received_text', __( 'Thank you. Your order has been received.', 'woocommerce' ), null ); ?></h4>
				</div>
			</div>
		</div>
	</section>

<?php endif; ?>
