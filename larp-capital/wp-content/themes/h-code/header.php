<?php
/**
* The template for displaying the header
*
* Displays all of the head element and everything up until the "Title".
*
* @package H-Code
*/

?>
<!DOCTYPE html>
<html <?php language_attributes(); ?> class="no-js">
	<head>
		<meta charset="<?php bloginfo( 'charset' ); ?>">
		<meta name="viewport" content="width=device-width,initial-scale=1.0,maximum-scale=1" />
		<link rel="profile" href="http://gmpg.org/xfn/11">
		<?php
			// Set Header for Ajax Popup.
			hcode_set_header( get_the_ID() );
			wp_head();
		?>
	</head>
	<body <?php body_class(); ?>>
	<?php
		if ( function_exists( 'wp_body_open' ) ) {
			wp_body_open();
		} else {
			do_action( 'wp_body_open' );
		}

		// Add Div For Ajax Popup
		hcode_add_ajax_page_div_header( get_the_ID() );

		if ( class_exists( 'WooCommerce' ) && ( is_product() || is_product_category() || is_product_tag() || is_tax( 'product_brand' ) ) ) {
			get_template_part( 'templates/menu-woocommerce' );
			get_template_part( 'templates/title' );
		} elseif ( is_search() || is_category() || is_archive() ) {
			get_template_part( 'templates/menu-archive' ); 
			get_template_part( 'templates/title' );
		} elseif ( is_home() ) {
			get_template_part( 'templates/menu' );
		} else {
			get_template_part( 'templates/menu' );
			get_template_part( 'templates/title' );
		}	