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

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $woocommerce_loop;

// Store loop count we're currently on
if ( empty( $woocommerce_loop['loop'] ) ) {
	$woocommerce_loop['loop'] = 0;
}

// Store column count for displaying the grid
if ( empty( $woocommerce_loop['columns'] ) ) {
	$woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
}

$hcode_category_product_row = hcode_option( 'hcode_category_product_row_column' );
switch ( $hcode_category_product_row ) {
    case '6':
        $classes[] = 'col-md-2 col-sm-6 col-xs-12';
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 6 );
        break;
    case '4':
        $classes[] = 'col-md-3 col-sm-6 col-xs-12';
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
        break;
    case '3':
        $classes[] = 'col-md-4 col-sm-6 col-xs-12';
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
        break;
    case '2':
        $classes[] = 'col-md-6 col-sm-6 col-xs-12';
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 2 );
        break;
    case '1':
        $classes[] = 'col-md-12 col-sm-12 col-xs-12';
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 1 );
        break;
    default:
        $classes[] = 'col-md-4 col-sm-6 col-xs-12';
        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );
        break;
}

?>
<div <?php wc_product_cat_class($classes); ?>>
	<div class="text-center position-relative overflow-hidden">

		<?php
			/**
			 * woocommerce_before_subcategory hook.
			 *
			 * @hooked woocommerce_template_loop_category_link_open - 10
			 */
			do_action( 'woocommerce_before_subcategory', $category );

			/**
			 * woocommerce_before_subcategory_title hook.
			 *
			 * @hooked woocommerce_subcategory_thumbnail - 10
			 */
			do_action( 'woocommerce_before_subcategory_title', $category );

			echo '<h3 class="text-med font-weight-600 black-text text-uppercase letter-spacing-1">';
				echo esc_attr($category->name);

				if ( $category->count > 0 )
					echo apply_filters( 'woocommerce_subcategory_count_html', ' <span class="count light-gray-text">(' . $category->count . ')</span>', $category );
			echo '</h3>';

			/**
			 * woocommerce_after_subcategory_title hook.
			 */
			do_action( 'woocommerce_after_subcategory_title', $category );

			/**
			 * woocommerce_after_subcategory hook.
			 *
			 * @hooked woocommerce_template_loop_category_link_close - 10
			 */
			do_action( 'woocommerce_after_subcategory', $category );
		?>
	</div>
</div>