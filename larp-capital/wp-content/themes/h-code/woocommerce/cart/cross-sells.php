<?php
/**
 * Cross-sells
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/cross-sells.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 4.4.0
 */

defined( 'ABSPATH' ) || exit;

global $product, $woocommerce_loop;

if ( ! $crosssells = WC()->cart->get_cross_sells() ) {
	return;
}

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => apply_filters( 'woocommerce_cross_sells_total', $posts_per_page ),
	'orderby'             => $orderby,
	'post__in'            => $crosssells,
	'meta_query'          => WC()->query->get_meta_query()
);

$products 					 = new WP_Query( $args );
$woocommerce_loop['name']    = 'cross-sells';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_cross_sells_columns', $columns );
if ( empty( $woocommerce_loop['loop'] ) ) {
 $woocommerce_loop['loop'] = 0;
}

if ( $products->have_posts() ) : ?>
	<div class="wpb_column hcode-column-container col-md-12 col-sm-12 col-xs-12"><div class="wide-separator-line  margin-eight no-margin-lr"></div></div>
	<div class="cross-sells clear-both">

		<div class="col-md-12 text-center">
			<?php
			$heading = apply_filters( 'woocommerce_product_cross_sells_products_heading', __( 'You may be interested in&hellip;', 'woocommerce' ) );

			if ( $heading ) :
				?>
				<h3 class="section-title"><?php echo esc_html( $heading ); ?></h2>
			<?php endif; ?>
    	</div>

		<div class="products product-3 product-listing col-md-12 col-sm-12 no-padding<?php hcode_woocommerce_category_view()?>">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php
				// Increase loop count
				$woocommerce_loop['loop']++;

				// Extra post classes
				$classes = array();

		        $classes[] = 'col-md-4 col-sm-6 col-xs-12';
		        $woocommerce_loop['columns'] = apply_filters( 'loop_shop_columns', 3 );

				?>
				<div <?php post_class( $classes ); ?>>
					<div class="home-product text-center position-relative overflow-hidden">
						<?php do_action( 'woocommerce_before_shop_loop_item' ); ?>
						<div class="product-image-wrapper">
							<a href="<?php the_permalink(); ?>">

								<?php
									/**
									 * woocommerce_before_shop_loop_item_title hook
									 *
									 * @hooked woocommerce_template_loop_product_thumbnail - 10
									 */
									//do_action( 'woocommerce_before_shop_loop_item_title' );
								?>
								<?php
				                    if ( has_post_thumbnail() ) {
				                        the_post_thumbnail( 'shop_catalog' );
				                    }elseif ( wc_placeholder_img_src() ) {
				                        echo wc_placeholder_img( 'shop_catalog' );
				                    }
				                ?>
							</a>
							<?php 
								/**
								* hcode_sale_flash hook
								*
								* @hooked hcode_sale_flash - 10
								*
								*/
								do_action ( 'hcode_sale_flash' );
							?>
						</div>
						<div class="product-content-wrapper">
							<span class="product-name text-uppercase">
								<a href="<?php the_permalink(); ?>">	
									<?php
										/**
										 * woocommerce_shop_loop_item_title hook
										 *
										 * @hooked woocommerce_template_loop_product_title - 10
										 */
										wc_get_template( 'loop/title.php' );
									?>
								</a>
							</span>
							<?php do_action('hcode_woocommerce_product_title_stock_and_shipping_available'); ?>

							<?php 
								/* Show Product Excerpt For List View */
							do_action('hcode_woocommerce_product_list_excerpt'); ?>
							<!-- <a href="<?php the_permalink(); ?>"> -->
								<?php
									/**
									 * woocommerce_after_shop_loop_item_title hook
									 *
									 * @hooked woocommerce_template_loop_rating - 5
									 * @hooked woocommerce_template_loop_price - 10
									 */
									do_action( 'woocommerce_after_shop_loop_item_title' );
								?>
							<!-- </a> -->
						
							<div class="quick-buy">
								<div class="product-share">
									<?php

										/**
										 * woocommerce_after_shop_loop_item hook
										 *
										 * @hooked woocommerce_template_loop_add_to_cart - 10
										 */
										do_action( 'woocommerce_after_shop_loop_item' );

									?>
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
