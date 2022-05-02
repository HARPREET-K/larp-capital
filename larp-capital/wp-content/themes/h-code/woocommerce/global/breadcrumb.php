<?php
/**
 * Shop breadcrumb
 *
 * @author 		WooThemes
 * @package 	WooCommerce/Templates
 * @version     2.3.0
 * @see         woocommerce_breadcrumb()
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( $breadcrumb ) {

	echo sprintf( __('%s','H-Code'), $wrap_before );
	
	foreach ( $breadcrumb as $key => $crumb ) {
	
		echo sprintf( __('%s','H-Code'), $before );

		if ( ! empty( $crumb[1] ) && sizeof( $breadcrumb ) !== $key + 1 ) {
			echo '<li><a href="' . esc_url( $crumb[1] ) . '">' . esc_html( $crumb[0] ) . '</a></li>';
		} else {
			echo '<li>'.esc_html( $crumb[0] ).'</li>';
		}

		echo sprintf( __('%s','H-Code'), $after );

		if ( sizeof( $breadcrumb ) !== $key + 1 ) {
			echo sprintf( __('%s','H-Code'), $delimiter );
		}

	}

	echo sprintf( __('%s','H-Code'), $wrap_after );
}