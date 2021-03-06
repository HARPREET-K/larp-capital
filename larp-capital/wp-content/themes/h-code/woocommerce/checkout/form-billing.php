<?php
/**
 * Checkout billing information form
 *
 * @author  Themezaa
 * @package H-Code
 * @version 3.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

/** @global WC_Checkout $checkout */
?>

	<?php if ( wc_ship_to_billing_address_only() && WC()->cart->needs_shipping() ) : ?>
		<h2 class="black-text font-weight-600 text-uppercase text-large"><?php _e( 'Billing &amp; Shipping', 'woocommerce' ); ?></h2>
	<?php else : ?>
		<h2 class="black-text font-weight-600 text-uppercase text-large"><?php _e( 'Billing details', 'woocommerce' ); ?></h2>
	<?php endif; ?>

	<?php do_action( 'woocommerce_before_checkout_billing_form', $checkout ); ?>

	<?php foreach ( $checkout->get_checkout_fields( 'billing' ) as $key => $field ) : ?>
		<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
	<?php endforeach; ?>

	<?php do_action('woocommerce_after_checkout_billing_form', $checkout ); ?>

	<?php if ( ! is_user_logged_in() && $checkout->is_registration_enabled() ) : ?>
		<div class="woocommerce-account-fields">
			<?php if ( ! $checkout->is_registration_required() ) : ?>
				<div class="clear"></div>
				<p class="form-row form-row-wide create-account">
					<input class="woocommerce-form__input woocommerce-form__input-checkbox input-checkbox" id="createaccount" <?php checked( ( true === $checkout->get_value( 'createaccount' ) || ( true === apply_filters( 'woocommerce_create_account_default_checked', false ) ) ), true ) ?> type="checkbox" name="createaccount" value="1" /> <span><?php _e( 'Create an account?', 'woocommerce' ); ?></span>
				</p>

			<?php endif; ?>

		<?php do_action( 'woocommerce_before_checkout_registration_form', $checkout ); ?>

		<?php if ( $checkout->get_checkout_fields( 'account' ) ) : ?>

			<div class="create-account">
			<div class="col-md-12 no-padding">
				<?php foreach ( $checkout->get_checkout_fields( 'account' )  as $key => $field ) : ?>
					<?php woocommerce_form_field( $key, $field, $checkout->get_value( $key ) ); ?>
				<?php endforeach; ?>
			</div>
				<div class="clear"></div>

			</div>

		<?php endif; ?>

		<?php do_action( 'woocommerce_after_checkout_registration_form', $checkout ); ?>
		</div>
	<?php endif; ?>
