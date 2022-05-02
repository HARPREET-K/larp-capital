<?php
/**
 * Show messages
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/notices/success.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! $notices ) {
	return;
}

?>
<div class="woocommerce-message" role="alert">
<?php foreach ( $notices as $notice ) : ?>
	<div class="col-sm-12 col-xs-12 woocommerce-success-message alert-remove xs-margin-bottom-10px"<?php echo wc_get_notice_data_attr( $notice ); ?>>
		<div class="alert alert-success fade in" role="alert">
			<i class="fas fa-thumbs-up alert-success"></i>
			<?php echo wc_kses_notice( $notice['notice'] ); ?>
			<button class="close checkout-alert-remove" type="button" data-dismiss="alert" aria-hidden="true">&times;</button>
		</div>
	</div>
<?php endforeach; ?>
</div>