<?php
/**
 * The template for displaying product content in the single-product.php template
 *
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package H-Code
 * @version 3.6.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

/**
 * woocommerce_before_single_product hook
 *
 * @hooked wc_print_notices - 10
 */
 do_action( 'woocommerce_before_single_product' );

 if ( post_password_required() ) {
 	echo get_the_password_form();
 	return;
 }

$classes = array();
$classes[] = 'single-product-wrapper no-transition';

wc_get_template_part( 'content', 'before-product' ); 

$product_sidebar_position = hcode_option( 'product_sidebar_position' );
$enable_product_brand_logo = hcode_option( 'enable_product_brand_logo' );
	
$hcode_product_main_top_classes = $hcode_product_main_bottom_classes = $hcode_product_bottom_title_classes = '';

switch ($product_sidebar_position) {
	case '1':
		$hcode_product_main_top_classes .= 'col-md-6 col-sm-12 col-xs-12';
		$hcode_product_main_bottom_classes .= 'col-md-5 col-sm-12 col-xs-12 col-md-offset-1 entry-summary';
		$hcode_product_bottom_title_classes .= '<div class="product-title-wrapper sm-display-none display-block">'.hcode_woocommerce_product_single_title().'</div>';
	break;
		
	case '2':
	case '3':
		$hcode_product_main_top_classes .= 'col-md-6 col-sm-12 col-xs-12';
		$hcode_product_main_bottom_classes .= 'col-md-6 col-sm-12 col-xs-12 detail-right entry-summary';
		$hcode_product_bottom_title_classes .= '<div class="product-title-wrapper sm-display-none display-block">'.hcode_woocommerce_product_single_title().'</div>';
	break;

	case '4':
		$hcode_product_main_top_classes .= 'col-md-12 col-sm-12 col-xs-12 margin-ten-bottom';
		$hcode_product_main_bottom_classes .= 'col-md-12 col-sm-12 col-xs-12 entry-summary';
		$hcode_product_bottom_title_classes .= '';
	break;
}

if( $product_sidebar_position == 4 ) {
	echo '<div class="product-title-responsive-wrapper col-md-12 col-sm-12 col-xs-12">'.hcode_woocommerce_product_single_title().'</div>';
} else {
	echo '<div class="product-title-responsive-wrapper col-md-12 col-sm-12 col-xs-12 sm-display-block display-none">'.hcode_woocommerce_product_single_title().'</div>';
}
?>
<div id="product-<?php the_ID(); ?>" <?php wc_product_class( '', $product ); ?>>
	<?php
	echo '<div class="wpb_column hcode-column-container sm-margin-bottom-ten single-product-wrapper-left '.esc_attr( $hcode_product_main_top_classes ).'">';
		
		/**
		 * woocommerce_before_single_product_summary hook
		 *
		 * @hooked woocommerce_show_product_sale_flash - 10
		 * @hooked woocommerce_show_product_images - 20
		 */
		do_action( 'woocommerce_before_single_product_summary' );

	echo '</div>';
	echo '<div class="'.esc_attr( $hcode_product_main_bottom_classes ).'">';

		$terms = get_the_terms( get_the_ID(), 'product_brand' );

		if( $enable_product_brand_logo == 1 && $terms && ! is_wp_error( $terms ) ){
		    echo '<div class="hcode-product-brand-rating">';
		    	echo '<div class="hcode-rating-section">';
		}

		global $product;
		$rating_count = $product->get_rating_count();
		if ( wc_product_sku_enabled() && ( $product->get_sku() || $rating_count > 0 ) ) {
			echo '<div class="rating margin-five no-margin-top light-gray-text2 hcode-rating">';
			
				/**
				 * hcode_woocommerce_product_single_rating_sku hook
				 *
				 * @hooked woocommerce_template_single_rating - 10
				 * @hooked woocommerce_template_single_meta - 40
				 *	
				 */

				do_action( 'hcode_woocommerce_product_single_rating_sku');	
			echo '</div>';
		}
		if( $enable_product_brand_logo == 1 ){

			$terms = get_the_terms( get_the_ID(), 'product_brand' );

			if ( $terms && ! is_wp_error( $terms ) ) {
			 
			    $hcode_brand_logos = array();
			 
			    foreach ( $terms as $term ) {
			    	$thumbnail_id = get_term_meta( $term->term_id, 'logo_id', true );      
			    	$brand_link = get_term_link( $term->term_id );         
	                $hcode_brand_logos[] = '<a href="'.$brand_link.'">'.wp_get_attachment_image( $thumbnail_id, 'full' ).'</a>';
			    }
			                         
			    $hcode_brand_logo = join( '', $hcode_brand_logos );
			    echo '</div>';		 
			    echo '<div class="hcode-brand-logo-wrapper">';
			        printf( esc_html__( '%s', 'H-Code' ), $hcode_brand_logo );
			    echo '</div>';
			    echo '</div>';
			}
		}

		if( $product_sidebar_position != 4 ) {
			echo '<div class="product-title-wrapper sm-display-none display-block">'.hcode_woocommerce_product_single_title().'</div>';
		}
		/**
		 * Hook: woocommerce_single_product_summary.
		 *
		 * @hooked woocommerce_template_single_title - 5
		 * @hooked woocommerce_template_single_rating - 10
		 * @hooked woocommerce_template_single_price - 10
		 * @hooked woocommerce_template_single_excerpt - 20
		 * @hooked woocommerce_template_single_add_to_cart - 30
		 * @hooked woocommerce_template_single_meta - 40
		 * @hooked woocommerce_template_single_sharing - 50
		 * @hooked WC_Structured_Data::generate_product_data() - 60
		 */
		do_action( 'woocommerce_single_product_summary' );

	echo '</div>';
	?>
</div><!-- #product-<?php the_ID(); ?> -->

<?php
	/**
	 * woocommerce_after_single_product_summary hook
	 *
	 * @hooked woocommerce_output_product_data_tabs - 10
	 * @hooked woocommerce_upsell_display - 15
	 * @hooked woocommerce_output_related_products - 20
	 */
	do_action( 'woocommerce_after_single_product_summary' );

	/* End sidebar Div*/
	wc_get_template_part( 'content', 'after-product' ); 

	do_action( 'woocommerce_after_single_product' );