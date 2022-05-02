<?php
/**
 * Empty cart page
 *
 * @package H-Code
 * @version 3.5.0
 */

defined( 'ABSPATH' ) || exit;

?>
<section>
	<div class="container">
		<div class="row">
			<?php wc_print_notices(); ?>
			<div class="col-md-12 text-center">
				<?php do_action( 'woocommerce_cart_is_empty' ); ?>

				<?php if ( wc_get_page_id( 'shop' ) > 0 ) : ?>
					<p class="return-to-shop">
						<a class="button wc-backward highlight-button-dark btn-medium button btn" href="<?php echo esc_url( apply_filters( 'woocommerce_return_to_shop_redirect', wc_get_page_permalink( 'shop' ) ) ); ?>">
							<?php esc_html_e( 'Return to shop', 'woocommerce' ) ?>
						</a>
					</p>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>