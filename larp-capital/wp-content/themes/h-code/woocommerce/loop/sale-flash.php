<?php
/**
 * Product loop sale flash
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     1.6.4
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $post, $product;

?>
<div class="onsale onsale-style-2">
<?php if ( $product->is_on_sale() ) :

	echo apply_filters( 'woocommerce_sale_flash', '<div class="sale white-text">' . esc_html__( 'Sale', 'woocommerce' ) . '</div>', $post, $product );

endif; ?>
<?php 
$new_product = get_post_meta( $post->ID, 'hcode_new_product_shop', true );
if ( $new_product == 'yes' ) :
	
	echo '<div class="new white-text">' . esc_html__( 'New', 'H-Code' ) . '</div>';

endif; ?>
</div>
