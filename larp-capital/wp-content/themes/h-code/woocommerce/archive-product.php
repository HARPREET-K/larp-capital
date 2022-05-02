<?php
/**
 * The Template for displaying product archives, including the main shop page which is a post type archive.
 *
 * Override this template by copying it to yourtheme/woocommerce/archive-product.php
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.0
 */

defined( 'ABSPATH' ) || exit;

get_header( 'shop' );

	global $hcode_theme_settings;

	/**
	 * Hook: woocommerce_before_main_content.
	 *
	 * @hooked woocommerce_output_content_wrapper - 10 (outputs opening divs for the content)
	 * @hooked woocommerce_breadcrumb - 20
	 * @hooked WC_Structured_Data::generate_website_data() - 30
	 */

	do_action( 'woocommerce_before_main_content' );    
	
	/* Check shop page */
	wc_get_template_part( 'content', 'before-category' );

	$hcode_archive_description = ( isset( $hcode_theme_settings['hcode_enable_archive_description'] ) ) ? $hcode_theme_settings['hcode_enable_archive_description'] : '';
	
	if( $hcode_archive_description == 1 ){

		/**
		 * Hook: woocommerce_archive_description.
		 *
		 * @hooked woocommerce_taxonomy_archive_description - 10
		 * @hooked woocommerce_product_archive_description - 10
		 */

		do_action( 'woocommerce_archive_description' ); 
	}

	if ( woocommerce_product_loop() ) {

		echo '<div class="shorting clearfix xs-margin-top-three">';
			
			/**
			 * Hook: woocommerce_before_shop_loop.
			 *
			 * @hooked wc_print_notices - 10
			 * @hooked woocommerce_result_count - 20
			 * @hooked woocommerce_catalog_ordering - 30
			 */
			do_action( 'woocommerce_before_shop_loop' );
		
		echo '</div>';

		woocommerce_product_loop_start();

			if ( wc_get_loop_prop( 'total' ) ) {
				//woocommerce_product_subcategories();

				while ( have_posts() ) {
					the_post();

					do_action( 'woocommerce_shop_loop' );

					wc_get_template_part( 'content', 'product' );

				}
			}

		woocommerce_product_loop_end();

		/**
		 * woocommerce_after_shop_loop hook
		 *
		 * @hooked woocommerce_pagination - 10
		 */
		do_action( 'woocommerce_after_shop_loop' );

	} else {
		
		/**
		 * Hook: woocommerce_no_products_found.
		 *
		 * @hooked wc_no_products_found - 10
		 */
		do_action( 'woocommerce_no_products_found' );
	}

	
		/* Check shop page */
	wc_get_template_part( 'content', 'after-category' );
	
	/**
	 * woocommerce_after_main_content hook
	 *
	 * @hooked woocommerce_output_content_wrapper_end - 10 (outputs closing divs for the content)
	 */
	do_action( 'woocommerce_after_main_content' );

get_footer( 'shop' );