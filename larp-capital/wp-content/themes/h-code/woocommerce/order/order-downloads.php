<?php
/**
 * Order Downloads.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/order/order-downloads.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.3.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}
?>
<?php if( is_account_page() ) { ?>
<div class="woocommerce-order-downloads col-md-12 col-sm-12 col-xs-12">
<?php } else { ?>
<div class="woocommerce-order-downloads col-md-12 col-sm-12 col-xs-12 margin-five-bottom">
<?php } ?>
	<?php if ( isset( $show_title ) ) : ?>
		<h2 class="woocommerce-order-downloads__title black-text font-weight-600 text-uppercase title-small margin-bottom-20px"><?php _e( 'Downloads', 'woocommerce' ); ?></h2>
	<?php endif; ?>

	<table class="woocommerce-table woocommerce-table--order-downloads shop_table order_details shop-cart">
		<thead>
			<tr>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
				<th class="text-left text-uppercase font-weight-600 letter-spacing-2 text-small black-text <?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_html( $column_name ); ?>"><span class="nobr"><?php echo esc_html( $column_name ); ?></span></th>
				<?php endforeach; ?>
			</tr>
		</thead>

		<?php foreach ( $downloads as $download ) : ?>
			<tr>
				<?php foreach ( wc_get_account_downloads_columns() as $column_id => $column_name ) : ?>
					<td class="<?php echo esc_attr( $column_id ); ?>" data-title="<?php echo esc_attr( $column_name ); ?>"><?php
						if ( has_action( 'woocommerce_account_downloads_column_' . $column_id ) ) {
							do_action( 'woocommerce_account_downloads_column_' . $column_id, $download );
						} else {
							switch ( $column_id ) {
								case 'download-product' : 
									if ( $download['product_url'] ) {
										echo '<a href="' . esc_url( $download['product_url'] ) . '">' . esc_html( $download['product_name'] ) . '</a>';
									} else {
										echo esc_html( $download['product_name'] );
									}
								break;
								case 'download-file' : 
									echo '<a href="' . esc_url( $download['download_url'] ) . '" class="woocommerce-MyAccount-downloads-file button alt">' . esc_html( $download['download_name'] ) . '</a>';
								break;
								case 'download-remaining' :
									echo is_numeric( $download['downloads_remaining'] ) ? esc_html( $download['downloads_remaining'] ) : __( '&infin;', 'woocommerce' );
								break;
								case 'download-expires' : ?>
									<?php if ( ! empty( $download['access_expires'] ) ) : ?>
										<time datetime="<?php echo date( 'Y-m-d', strtotime( $download['access_expires'] ) ); ?>" title="<?php echo esc_attr( strtotime( $download['access_expires'] ) ); ?>"><?php echo date_i18n( get_option( 'date_format' ), strtotime( $download['access_expires'] ) ); ?></time>
									<?php else : ?>
										<?php _e( 'Never', 'woocommerce' ); ?>
									<?php endif;
								break;
							}
						}
					?></td>
				<?php endforeach; ?>
			</tr>
		<?php endforeach; ?>
	</table>
</div>