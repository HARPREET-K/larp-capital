<?php
/**
 * Edit address form
 *
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package H-Code
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

$page_title = ( 'billing' === $load_address ) ? esc_html__( 'Billing address', 'woocommerce' ) : esc_html__( 'Shipping address', 'woocommerce' );

?>
<div class="col-md-12 col-sm-12 col-xs-12 billing-shipping-address no-padding">

	<?php do_action( 'woocommerce_before_edit_account_address_form' ); ?>

	<?php if ( ! $load_address ) : ?>

		<?php wc_get_template( 'myaccount/my-address.php' ); ?>

	<?php else : ?>

		<form method="post">

			<div class="col-md-12 col-sm-12 col-xs-12">
				<h3 class="black-text font-weight-600 text-uppercase text-large margin-bottom-10px">
					<?php echo apply_filters( 'woocommerce_my_account_edit_address_title', $page_title, $load_address ); ?><?php // @codingStandardsIgnoreLine ?>
				</h3>
			</div>

			<?php do_action( "woocommerce_before_edit_address_form_{$load_address}" ); ?>

			<?php
			foreach ( $address as $key => $field ) {
				woocommerce_form_field( $key, $field, wc_get_post_data_by_key( $key, $field['value'] ) );
			}
			?>

			<?php do_action( "woocommerce_after_edit_address_form_{$load_address}" ); ?>

			<div class="col-md-12 col-xs-12 margin-top-10px">
				<button type="submit" class="highlight-button btn-small xs-margin-five-bottom button btn" name="save_address" value="<?php esc_attr_e( 'Save address', 'woocommerce' ); ?>"><?php esc_html_e( 'Save address', 'woocommerce' ); ?></button>
				<?php wp_nonce_field( 'woocommerce-edit_address', 'woocommerce-edit-address-nonce' ); ?>
				<input type="hidden" name="action" value="edit_address" />
			</div>

		</form>

	<?php endif; ?>

	<?php do_action( 'woocommerce_after_edit_account_address_form' ); ?>

</div>
