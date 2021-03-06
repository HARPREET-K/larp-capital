<?php
/**
 * Checkout Form
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<section>
	<div class="container">
		<div class="row">

		<?php wc_print_notices(); ?>

		<div class="margin-seven no-margin-top woocommerce-checkout-top">
			<?php do_action( 'woocommerce_before_checkout_form', $checkout ); ?>
		</div>

		<?php 

		// If checkout registration is disabled and not logged in, the user cannot checkout.
		if ( ! $checkout->is_registration_enabled() && $checkout->is_registration_required() && ! is_user_logged_in() ) {
			echo apply_filters( 'woocommerce_checkout_must_be_logged_in_message', __( 'You must be logged in to checkout.', 'woocommerce' ) );
			return;
		}

		?>

		<form name="checkout" method="post" class="checkout woocommerce-checkout no-transition" action="<?php echo esc_url( wc_get_checkout_url() ); ?>" enctype="multipart/form-data">

			<?php if ( $checkout->get_checkout_fields() ) : ?>
				<div class="margin-five no-margin-top col-md-12 col-sm-12 col-xs-12 no-padding">
					<?php do_action( 'woocommerce_checkout_before_customer_details' ); ?>

					
					<div class="col-md-5 col-sm-12 col-xs-12 pull-left sm-margin-bottom-seven">
						<?php do_action( 'woocommerce_checkout_billing' ); ?>
					</div>

					<div class="col-md-5 col-sm-12 col-xs-12 pull-right">
						<?php do_action( 'woocommerce_checkout_shipping' ); ?>
					</div>

					<?php do_action( 'woocommerce_checkout_after_customer_details' ); ?>

				</div>

				

			<?php endif; ?>
			<div class="col-md-12 col-sm-12 col-xs-12">
				<h2 id="order_review_heading" class="black-text font-weight-600 text-uppercase text-large"><?php esc_html_e( 'Your order', 'woocommerce' ); ?></h2>
			</div>
			<?php do_action( 'woocommerce_checkout_before_order_review' ); ?>

			<div id="order_review" class="woocommerce-checkout-review-order col-md-12 col-sm-12 col-xs-12">
				
				<?php do_action( 'woocommerce_checkout_order_review' ); ?>

			</div>

			<?php do_action( 'woocommerce_checkout_after_order_review' ); ?>


		</form>

		<?php do_action( 'woocommerce_after_checkout_form', $checkout ); ?>
		</div>
	</div>
</section>