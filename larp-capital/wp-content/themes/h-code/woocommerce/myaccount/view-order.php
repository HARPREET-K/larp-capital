<?php
/**
 * View Order
 *
 * Shows the details of a particular order on the account page.
 *
 * @author  Themezaa
 * @package H-Code
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<div class="col-md-12 col-sm-12 col-xs-12">
	<p><?php
		/* translators: 1: order number 2: order date 3: order status */
		printf(
			__( 'Order #%1$s was placed on %2$s and is currently %3$s.', 'woocommerce' ),
			'<mark class="order-number">' . $order->get_order_number() . '</mark>',
			'<mark class="order-date">' . wc_format_datetime( $order->get_date_created() ) . '</mark>',
			'<mark class="order-status">' . wc_get_order_status_name( $order->get_status() ) . '</mark>'
		);
	?></p>
</div>

<?php if ( $notes = $order->get_customer_order_notes() ) : ?>
	
	<div class="col-md-12 col-sm-12 col-xs-12">
		<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px"><?php _e( 'Order updates', 'woocommerce' ); ?></h2>
		<ol class="woocommerce-OrderUpdates commentlist notes">
			<?php foreach ( $notes as $note ) : ?>
			<li class="woocommerce-OrderUpdate comment note">
				<div class="woocommerce-OrderUpdate-inner comment_container">
					<div class="woocommerce-OrderUpdate-text comment-text">
						<p class="woocommerce-OrderUpdate-meta meta"><?php echo date_i18n( __( 'l jS \o\f F Y, h:ia', 'woocommerce' ), strtotime( $note->comment_date ) ); ?></p>
						<div class="woocommerce-OrderUpdate-description description">
							<?php echo wpautop( wptexturize( $note->comment_content ) ); ?>
						</div>
		  				<div class="clear"></div>
		  			</div>
					<div class="clear"></div>
				</div>
			</li>
			<?php endforeach; ?>
		</ol>
	</div>
<?php endif; ?>

<?php do_action( 'woocommerce_view_order', $order_id ); ?>
