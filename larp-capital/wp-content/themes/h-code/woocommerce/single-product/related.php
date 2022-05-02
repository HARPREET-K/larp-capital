<?php
/**
 * Related Products
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/related.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://docs.woocommerce.com/document/template-structure/
 * @package     WooCommerce/Templates
 * @version     3.9.0
 */

if ( ! defined( 'ABSPATH' ) ) {
    exit;
}

global $product, $woocommerce_loop;

if ( empty( $product ) || ! $product->exists() ) {
    return;
}

if ( ! $related = wc_get_related_products( $product->get_id(), $posts_per_page ) ) {
    return;
}

/* Check related product config from admin options */
$related_product_grid_per_row = ( hcode_option('related_product_grid_per_row') ) ? hcode_option('related_product_grid_per_row') : 3;
$related_product_desktop_per_page = ( hcode_option('related_product_desktop_per_page') ) ? hcode_option('related_product_desktop_per_page') : 3;
$related_product_ipad_per_page = ( hcode_option('related_product_ipad_per_page') ) ? hcode_option('related_product_ipad_per_page') : 3;
$related_product_mobile_per_page = ( hcode_option('related_product_mobile_per_page') ) ? hcode_option('related_product_mobile_per_page') : 1;

$related_product_type = hcode_option( 'hcode_layout_woocommerce_settings' );
$related_product_classes = $sep_class = '';
switch ( $related_product_type ){
    case 'slider':
        $related_product_classes .= 'owl-carousel owl-theme dark-pagination owl-no-pagination owl-prev-next-simple';
        break;
    case 'grid':
    default:
        $related_product_classes .= 'related-product-grid product-'.$related_product_grid_per_row;
        break;
    case 'remove':
        return;
        break;
}

$args = apply_filters( 'woocommerce_related_products_args', array(
    'post_type'            => 'product',
    'ignore_sticky_posts'  => 1,
    'no_found_rows'        => 1,
    'posts_per_page'       => $posts_per_page,
    'orderby'              => $orderby,
    'post__in'             => $related,
    'post__not_in'         => array( $product->get_id() )
) );

$products                    = new WP_Query( $args );
$woocommerce_loop['name']    = 'related';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_related_products_columns', $columns );
$upsells = $product->get_upsell_ids();
if ( sizeof( $upsells ) == 0 ) {
    $sep_class = 'margin-eight';
}else{
    $sep_class = 'margin-three-top margin-eight-bottom';
}

if ( $products->have_posts() ) : ?>
<div class="wpb_column hcode-column-container col-md-12 col-sm-12 col-xs-12"><div class="wide-separator-line <?php echo esc_attr($sep_class) ?> no-margin-lr"></div></div>
    <div class="product-deails-related">
        <?php
        $heading = apply_filters( 'woocommerce_product_related_products_heading', __( 'Related products', 'woocommerce' ) );

        if ( $heading ) :
            ?>
            <div class="col-md-12 text-center">
                <h3 class="section-title"><?php echo esc_html( $heading ); ?></h3>
            </div>
        <?php endif; ?>
            
                <!-- related products slider -->
                <div id="related-products" class="<?php echo esc_attr($related_product_classes);?>">
                        <?php while ( $products->have_posts() ) : $products->the_post();
                                global $product, $woocommerce_loop;

                                // Store loop count we're currently on
                                if ( empty( $woocommerce_loop['loop'] ) ) {
                                        $woocommerce_loop['loop'] = 0;
                                }

                                // Ensure visibility
                                if ( ! $product || ! $product->is_visible() ) {
                                        return;
                                }

                                // Increase loop count
                                $woocommerce_loop['loop']++;

                                // Extra post classes
                                $classes = array();
                                if ( 0 == ( $woocommerce_loop['loop'] - 1 ) % $woocommerce_loop['columns'] || 1 == $woocommerce_loop['columns'] ) {
                                        $classes[] = 'first';
                                }
                                if ( 0 == $woocommerce_loop['loop'] % $woocommerce_loop['columns'] ) {
                                        $classes[] = 'last';
                                }
                                
                                switch ( $related_product_type  ) {
                                    case 'slider':
                                        // add item class
                                        $classes[] = 'item';
                                    break;
                                    
                                    case 'grid':
                                    default:
                                        switch ($related_product_grid_per_row){
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
                                                $classes[] = 'col-md-3 col-sm-4 col-xs-12';
                                                $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 4 );
                                                break;
                                        }
                                    break;
                                }
                                
                                ?>
                                <div <?php post_class( $classes ); ?>>
                                    <div class="home-product text-center position-relative overflow-hidden">

                                        <div class="product-image-wrapper">
                                            <a href="<?php the_permalink(); ?>">
                                                <?php 
                                                    if ( has_post_thumbnail() ) {
                                                        the_post_thumbnail( 'shop_catalog');
                                                    }elseif ( wc_placeholder_img_src() ) {
                                                        echo wc_placeholder_img( 'shop_catalog' );
                                                    }
                                                ?>
                                            </a>
                                            <?php do_action ( 'hcode_sale_flash' ); ?>
                                        </div>
                                        <div class="product-content-wrapper">
                                            <span class="product-name text-uppercase">
                                                <a href="<?php the_permalink(); ?>">
                                                    <?php the_title(); ?>
                                                </a>
                                            </span>
                                            <?php do_action( 'woocommerce_after_shop_loop_item_title' ); ?>
                                            <div class="quick-buy">
                                                <div class="product-share">
                                                    <?php do_action( 'woocommerce_after_shop_loop_item' ); ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        <?php endwhile; // end of the loop. ?>

                    </div>
    </div>

<?php endif;
wp_reset_postdata();
if($related_product_type == 'slider'): 
$slider_rtl_enable = ( is_rtl() ) ? 'true' : 'false';   
?>

<script type="text/javascript">jQuery(document).ready(function () { jQuery("#related-products").owlCarousel({ nav: true, dots: false,rtl: <?php echo esc_attr($slider_rtl_enable) ?> ,loop: true, responsive:{ 0: { items: <?php echo esc_attr($related_product_mobile_per_page); ?> }, 800: { items: <?php echo esc_attr($related_product_ipad_per_page); ?> }, 1200:{ items: <?php echo esc_attr($related_product_desktop_per_page); ?> } },navText: ["<i class='fas fa-angle-left'></i>", "<i class='fas fa-angle-right'></i>"] }); }); </script>

<?php

endif;