<?php
/**
 * Single Product Up-Sells
 *
 * @author  Themezaa
 * @package H-Code
 * @version 3.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

global $product, $woocommerce_loop;

$upsells = $product->get_upsell_ids();

if ( sizeof( $upsells ) == 0 ) {
	return;
}

$args = array(
	'post_type'           => 'product',
	'ignore_sticky_posts' => 1,
	'no_found_rows'       => 1,
	'posts_per_page'      => $posts_per_page,
	'orderby'             => $orderby,
	'post__in'            => $upsells,
	'post__not_in'        => array( $product->get_id() ),
	'meta_query'          => WC()->query->get_meta_query()
);

$products 					 = new WP_Query( $args );
$woocommerce_loop['name']    = 'up-sells';
$woocommerce_loop['columns'] = apply_filters( 'woocommerce_up_sells_columns', $columns );

if ( $products->have_posts() ) : ?>
	<div class="wpb_column hcode-column-container col-md-12 col-sm-12 col-xs-12"><div class="wide-separator-line  margin-eight no-margin-lr"></div></div>
	<div class="upsells products clear-both">

		<div class="col-md-12 text-center">
    		<h3 class="section-title"><?php esc_html_e( 'You may also like&hellip;', 'woocommerce' ) ?></h3>
    	</div>

		<div class="products product-3 product-listing col-md-12 col-sm-12 no-padding<?php hcode_woocommerce_category_view()?>">
			<?php while ( $products->have_posts() ) : $products->the_post(); ?>

				<?php //wc_get_template_part( 'content', 'product' ); ?>
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