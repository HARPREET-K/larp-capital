<?php
/**
 * The template for displaying product category thumbnails within loops
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-product-cat.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.7.0
 */

defined( 'ABSPATH' ) || exit;

$order = wc_get_order( $order_id ); // phpcs:ignore WordPress.WP.GlobalVariablesOverride.OverrideProhibited

if ( ! $order ) {
	return;
}

$order_items           = $order->get_items( apply_filters( 'woocommerce_purchase_order_item_types', 'line_item' ) );
$show_purchase_note    = $order->has_status( apply_filters( 'woocommerce_purchase_note_order_statuses', array( 'completed', 'processing' ) ) );
$show_customer_details = is_user_logged_in() && $order->get_user_id() === get_current_user_id();
$downloads             = $order->get_downloadable_items();
$show_downloads        = $order->has_downloadable_item() && $order->is_download_permitted();

if ( $show_downloads ) {
	wc_get_template(
		'order/order-downloads.php',
		array(
			'downloads'  => $downloads,
			'show_title' => true,
		)
	);
}

?>
<div class="col-md-7 col-sm-12 col-xs-12">
	<?php do_action( 'woocommerce_order_details_before_order_table', $order ); ?>
	<h2 class="black-text font-weight-600 text-uppercase title-small margin-bottom-20px"><?php esc_html_e( 'Order details', 'woocommerce' ); ?></h2>
	<table class="shop_table order_details review-order-details table">
		<thead>
			<tr>
				<th class="product-name text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Product', 'woocommerce' ); ?></th>
				<th class="product-total text-right text-uppercase font-weight-600 letter-spacing-2 text-small black-text"><?php esc_html_e( 'Total', 'woocommerce' ); ?></th>
			</tr>
		</thead>
		<tbody>
			<?php
				do_action( 'woocommerce_order_details_before_order_table_items', $order );

				foreach ( $order_items as $item_id => $item ) {
					$product = $item->get_product();

					wc_get_template( 'order/order-details-item.php', array(
						'order'			     => $order,
						'item_id'		     => $item_id,
						'item'			     => $item,
						'show_purchase_note' => $show_purchase_note,
						'purchase_note'	     => $product ? $product->get_purchase_note() : '',
						'product'	         => $product,
					) );
				}

				do_action( 'woocommerce_order_details_after_order_table_items', $order );
			?>
		</tbody>
		<tfoot>
			<?php
				foreach ( $order->get_order_item_totals() as $key => $total ) {
					?>
					<tr>
						<td scope="row" class="text-uppercase font-weight-600 letter-spacing-2 black-text text-small"><?php echo esc_html( $total['label'] ); ?></td>
						<td class="text-uppercase font-weight-600 black-text text-right" data-title="<?php echo str_replace(":","",$total['label']); ?>"><?php echo ( 'payment_method' === $key ) ? esc_html( $total['value'] ) : wp_kses_post( $total['value'] ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></td>
					</tr>
					<?php
				}
			?>

			<?php if ( $order->get_customer_note() ) : ?>
				<tr>
					<td class="text-uppercase font-weight-600 letter-spacing-2 black-text text-small"><?php _e( 'Note:', 'woocommerce' ); ?></td>
					<td class="text-uppercase font-weight-600 black-text text-right"><?php echo wp_kses_post( nl2br( wptexturize( $order->get_customer_note() ) ) ); ?></td>
				</tr>
			<?php endif; ?>
		</tfoot>
	</table>
	<?php do_action( 'woocommerce_order_details_after_order_table', $order ); ?>
</div>
<?php
/**
 * Action hook fired after the order details.
 *
 * @since 4.4.0
 * @param WC_Order $order Order data.
 */
do_action( 'woocommerce_after_order_details', $order );

if ( $show_customer_details ) {
	wc_get_template( 'order/order-details-customer.php', array( 'order' => $order ) );
}