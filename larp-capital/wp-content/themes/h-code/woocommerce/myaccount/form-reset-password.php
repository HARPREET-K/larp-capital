<?php
/**
 * Lost password reset form.
 *
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package H-Code
 * @version 3.5.5
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_reset_password_form' );
?>

	<form method="post" class="woocommerce-ResetPassword lost_reset_password">

		<div class="col-md-12">
			<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px xs-margin-bottom-5px">
				<?php echo apply_filters( 'woocommerce_reset_password_message', esc_html__( 'Enter a new password below.', 'woocommerce' ) ); ?><?php // @codingStandardsIgnoreLine ?>
			</h2>
		</div>

		<div class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first col-md-6 col-sm-12 col-xs-12">
			<label for="password_1"><?php _e( 'New password', 'woocommerce' ); ?>&nbsp;<em class="required">*</em></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_1" id="password_1" autocomplete="new-password" />
		</div>
		<div class="woocommerce-form-row woocommerce-form-row--last form-row form-row-last col-md-6 col-sm-12 col-xs-12">
			<label for="password_2"><?php _e( 'Re-enter new password', 'woocommerce' ); ?>&nbsp;<em class="required">*</em></label>
			<input type="password" class="woocommerce-Input woocommerce-Input--text input-text" name="password_2" id="password_2" autocomplete="new-password" />
		</div>

		<input type="hidden" name="reset_key" value="<?php echo esc_attr( $args['key'] ); ?>" />
		<input type="hidden" name="reset_login" value="<?php echo esc_attr( $args['login'] ); ?>" />

		<div class="clear"></div>

		<?php do_action( 'woocommerce_resetpassword_form' ); ?>

		<p class="woocommerce-form-row form-row col-md-12 col-xs-12">
			<input type="hidden" name="wc_reset_password" value="true" />
			<button type="submit" class="woocommerce-Button highlight-button btn-small margin-right-20px xs-margin-five-bottom button btn" value="<?php esc_attr_e( 'Save', 'woocommerce' ); ?>"><?php esc_html_e( 'Save', 'woocommerce' ); ?></button>
		</p>

		<?php wp_nonce_field( 'reset_password', 'woocommerce-reset-password-nonce' ); ?>

	</form>
	<?php
		do_action( 'woocommerce_after_reset_password_form' );