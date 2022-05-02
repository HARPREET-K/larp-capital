<?php
/**
 * Edit account form
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
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_edit_account_form' ); ?>

<form class="woocommerce-EditAccountForm edit-account" action="" method="post"  <?php do_action( 'woocommerce_edit_account_form_tag' ); ?> >

	<?php do_action( 'woocommerce_edit_account_form_start' ); ?>

	<div class="col-md-12 col-sm-12 col-xs-12 margin-three-bottom no-padding">
		<div class="form-row form-row-first col-sm-6 col-xs-12">
			<label for="account_first_name"><?php esc_html_e( 'First name', 'woocommerce' ); ?> <em class="required">*</em></label>
			<input type="text" class="input-text" name="account_first_name" id="account_first_name" autocomplete="given-name" value="<?php echo esc_attr( $user->first_name ); ?>" />
		</div>
		<div class="form-row form-row-last col-sm-6 col-xs-12">
			<label for="account_last_name"><?php esc_html_e( 'Last name', 'woocommerce' ); ?> <em class="required">*</em></label>
			<input type="text" class="input-text" name="account_last_name" id="account_last_name" autocomplete="family-name" value="<?php echo esc_attr( $user->last_name ); ?>" />
		</div>
		<div class="clear"></div>

		<div class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide col-sm-12 col-xs-12">
			<label for="account_display_name"><?php esc_html_e( 'Display name', 'woocommerce' ); ?>&nbsp;<em class="required">*</em></label>
			<input type="text" class="woocommerce-Input woocommerce-Input--text input-text no-margin-bottom" name="account_display_name" id="account_display_name" value="<?php echo esc_attr( $user->display_name ); ?>" /> <span class="width-100 pull-left margin-bottom-20px"><em><?php esc_html_e( 'This will be how your name will be displayed in the account section and in reviews', 'woocommerce' ); ?></em></span>
		</div>

		<div class="clear"></div>	
		<div class="form-row form-row-wide col-sm-12 col-xs-12">
			<label for="account_email"><?php esc_html_e( 'Email address', 'woocommerce' ); ?> <em class="required">*</em></label>
			<input type="email" class="input-text" name="account_email" id="account_email" autocomplete="email" value="<?php echo esc_attr( $user->user_email ); ?>" />
		</div>
	</div>
	<div class="clear"></div>
	<fieldset>
		<div class="col-md-12">
			<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px xs-margin-bottom-5px">
				<?php esc_html_e( 'Password change', 'woocommerce' ); ?>
			</h2>
		</div>
		<div class="form-row form-row-wide col-sm-6 col-xs-12">
			<label for="password_current"><?php esc_html_e( 'Current password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="input-text" name="password_current" id="password_current" autocomplete="off" />
		</div>
		<div class="form-row form-row-wide col-sm-6 col-xs-12">
			<label for="password_1"><?php esc_html_e( 'New password (leave blank to leave unchanged)', 'woocommerce' ); ?></label>
			<input type="password" class="input-text" name="password_1" id="password_1" autocomplete="off" />
		</div>
		<div class="form-row form-row-wide col-sm-12 col-xs-12">
			<label for="password_2"><?php esc_html_e( 'Confirm new password', 'woocommerce' ); ?></label>
			<input type="password" class="input-text" name="password_2" id="password_2" autocomplete="off" />
		</div>

	</fieldset>
	<div class="clear"></div>

	<?php do_action( 'woocommerce_edit_account_form' ); ?>

	<div class="col-md-12 col-xs-12">
		<?php wp_nonce_field( 'save_account_details', 'save-account-details-nonce' ); ?>
		<button type="submit" class="woocommerce-Button highlight-button btn-small margin-right-20px xs-margin-five-bottom button btn" name="save_account_details" value="<?php esc_attr_e( 'Save changes', 'woocommerce' ); ?>"><?php esc_html_e( 'Save changes', 'woocommerce' ); ?></button>
		<input type="hidden" name="action" value="save_account_details" />
	</div>

	<?php do_action( 'woocommerce_edit_account_form_end' ); ?>
</form>

<?php do_action( 'woocommerce_after_edit_account_form' ); ?>