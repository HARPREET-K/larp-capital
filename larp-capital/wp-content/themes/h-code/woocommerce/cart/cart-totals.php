<?php
/**
 * Cart totals
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.6
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>

<div class="cart_totals <?php echo ( WC()->customer->has_calculated_shipping() ) ? 'calculated_shipping' : ''; ?>">

	<?php do_action( 'woocommerce_before_cart_totals' ); ?>

	<table class="table cart-total">

		<tr class="cart-subtotal">
			<th class="padding-two text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php esc_html_e( 'Subtotal', 'woocommerce' ); ?></th>
			<td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text"><?php wc_cart_totals_subtotal_html(); ?></td>
		</tr>

		<?php foreach ( WC()->cart->get_coupons() as $code => $coupon ) : ?>
			<tr class="cart-discount coupon-<?php echo esc_attr( sanitize_title( $code ) ); ?>">
				<th class="padding-two text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php wc_cart_totals_coupon_label( $coupon ); ?></th>
				<td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text"><?php wc_cart_totals_coupon_html( $coupon ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php if ( WC()->cart->needs_shipping() && WC()->cart->show_shipping() ) : ?>

			<?php do_action( 'woocommerce_cart_totals_before_shipping' ); ?>

			<?php wc_cart_totals_shipping_html(); ?>

			<?php do_action( 'woocommerce_cart_totals_after_shipping' ); ?>

		<?php elseif ( WC()->cart->needs_shipping() ) : ?>

			<tr class="shipping">
				<th class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php esc_html_e( 'Shipping', 'woocommerce' ); ?></th>
				<td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text"><?php woocommerce_shipping_calculator(); ?></td>
			</tr>

		<?php endif; ?>

		<?php foreach ( WC()->cart->get_fees() as $fee ) : ?>
			<tr class="fee">
				<th class="text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php echo esc_attr( $fee->name ); ?></th>
				<td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text"><?php wc_cart_totals_fee_html( $fee ); ?></td>
			</tr>
		<?php endforeach; ?>

		<?php 
		if ( wc_tax_enabled() && ! WC()->cart->display_prices_including_tax() ) :
			$taxable_address = WC()->customer->get_taxable_address();
			$estimated_text  = WC()->customer->is_customer_outside_base() && ! WC()->customer->has_calculated_shipping()
					? sprintf( ' <small>(' . __( 'estimated for %s', 'woocommerce' ) . ')</small>', WC()->countries->estimated_for_prefix( $taxable_address[0] ) . WC()->countries->countries[ $taxable_address[0] ] )
					: '';

			if ( 'itemized' === get_option( 'woocommerce_tax_total_display' ) ) : ?>
				<?php foreach ( WC()->cart->get_tax_totals() as $code => $tax ) : ?>
					<tr class="tax-rate tax-rate-<?php echo sanitize_title( $code ); ?>">
						<th class="padding-two text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php echo esc_html( $tax->label ) . $estimated_text; ?></th>
						<td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text" data-title="<?php echo esc_attr( $tax->label ); ?>"><?php echo wp_kses_post( $tax->formatted_amount ); ?></td>
					</tr>
				<?php endforeach; ?>
			<?php else : ?>
				<tr class="tax-total">
					<th class="padding-two text-right no-padding-right text-uppercase font-weight-600 letter-spacing-2 text-small"><?php echo esc_html( WC()->countries->tax_or_vat() ) . $estimated_text; ?></th>
					<td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text" data-title="<?php echo esc_attr( WC()->countries->tax_or_vat() ); ?>"><?php wc_cart_totals_taxes_total_html(); ?></td>
				</tr>
			<?php endif; ?>
		<?php endif; ?>

		<tr>
			<td colspan="2" class="padding-one no-padding-right xs-no-padding">
            	<hr>
            </td>
        </tr>
		<?php do_action( 'woocommerce_cart_totals_before_order_total' ); ?>

		<tr class="total">
			<th class="padding-two text-uppercase text-right no-padding-right font-weight-600 text-large xs-no-padding black-text"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			<td class="padding-two text-uppercase text-right no-padding-right font-weight-600 black-text text-large no-letter-spacing xs-no-padding"><?php wc_cart_totals_order_total_html(); ?></td>
		</tr>
		<tr>
			<td colspan="2" class="padding-one no-padding-right xs-no-padding">
            	<hr class="no-margin-bottom">
            </td>
        </tr>
		<?php do_action( 'woocommerce_cart_totals_after_order_total' ); ?>

	</table>

	<?php wc_get_template( 'cart/proceed-to-checkout-button.php' );?>

	<?php do_action( 'woocommerce_after_cart_totals' ); ?>

</div>
