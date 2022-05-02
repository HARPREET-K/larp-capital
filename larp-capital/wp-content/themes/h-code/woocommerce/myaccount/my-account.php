<?php
/**
 * My Account page
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.5.0
 */

defined( 'ABSPATH' ) || exit;
?>

<div class="col-md-12 margin-bottom-20px">
	
	<?php
	/**
	 * My Account navigation.
	 * @since 2.6.0
	 */
	do_action( 'woocommerce_account_navigation' ); ?> 
	<div class="woocommerce-MyAccount-content">
		<?php
			/**
			 * My Account content.
			 * @since 2.6.0
			 */
			do_action( 'woocommerce_account_content' );
		?>
	</div>
</div>
