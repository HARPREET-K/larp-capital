<?php
/**
 * Single Product Meta
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/meta.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	    https://docs.woocommerce.com/document/template-structure/
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product;

/* H-Code V1.8 hide/show category and tags */
$enable_product_category = ( hcode_option('enable_product_category')) ? hcode_option('enable_product_category') : '';
$enable_product_tags = ( hcode_option('enable_product_tags')) ? hcode_option('enable_product_tags') : '';

if( $enable_product_category || $enable_product_tags ) {
?>
<div class="col-md-12 col-sm-12 col-xs-12 no-padding-lr product-meta-single-page border-top product_meta">

	<?php do_action( 'woocommerce_product_meta_start' ); ?>

	<?php if( $enable_product_category ) { ?>
	
	<?php echo wc_get_product_category_list( $product->get_id(), ', ', '<div class="posted_in margin-bottom-10px">' . _n( 'Category:', 'Categories:', count( $product->get_category_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>

	<?php } ?>
	<?php if( $enable_product_tags ) { ?>
	
	<?php echo wc_get_product_tag_list( $product->get_id(), ', ', '<div class="tagged_as margin-bottom-10px">' . _n( 'Tag:', 'Tags:', count( $product->get_tag_ids() ), 'woocommerce' ) . ' ', '</div>' ); ?>
	<?php } ?>

	<?php do_action( 'woocommerce_product_meta_end' ); ?>

</div>
<?php } ?>