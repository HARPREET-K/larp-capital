<?php
/**
 * Single Product Thumbnails
 *
 * @author  Themezaa
 * @package H-Code
 * @version 3.5.1
 */

defined( 'ABSPATH' ) || exit;

// Note: `wc_get_gallery_image_html` was added in WC 3.3.2 and did not exist prior. This check protects against theme overrides being used on older versions of WC.
if ( ! function_exists( 'wc_get_gallery_image_html' ) ) {
	return;
}

global $product;

$enable_product_image_gallery_thumb_slider = hcode_option( 'enable_product_image_gallery_thumb_slider' );
$thumb_gallery_hide_mobile = ( $enable_product_image_gallery_thumb_slider != 1 ) ? ' xs-display-none' : '';

$attachment_ids = $product->get_gallery_image_ids();

if ( $attachment_ids && $product->get_image_id() ) {
	
	$enable_product_default_image_gallery = ( hcode_option( 'enable_product_default_image_gallery' ) ) ? hcode_option( 'enable_product_default_image_gallery' ) : '';

	if( $enable_product_default_image_gallery ) {
		foreach ( $attachment_ids as $attachment_id ) {
			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', wc_get_gallery_image_html( $attachment_id  ), $attachment_id );
		}
	} else {

		echo '<div class="hcode-single-product-thumbnail-carousel thumbnails owl-carousel owl-theme owl-small-arrow'.$thumb_gallery_hide_mobile.'">';

			if ( has_post_thumbnail() ) {
				$post_thumbnail_id = $product->get_image_id();
				$img_lightbox_caption = hcode_option_image_caption( $post_thumbnail_id );
				$img_lightbox_title = hcode_option_lightbox_image_title( $post_thumbnail_id );
				$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
				$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 
				
				$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
				$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
				$full_src = wp_get_attachment_image_src( $post_thumbnail_id, 'full' );
				$image = wp_get_attachment_image( $post_thumbnail_id, 'thumbnail', false, array(
					'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
					'data-src'                => $full_src[0],
					'data-large_image'        => $full_src[0],
					'data-large_image_width'  => $full_src[1],
					'data-large_image_height' => $full_src[2],
					'class'                   => 'wp-post-image',
				) );

				$image = '<div class="item"><a href="'.esc_url( $full_src[0] ).'"'.$image_lightbox_caption.$image_lightbox_title.'>'.$image.'</a></div>';
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image , $post_thumbnail_id );
			}

			if ( $attachment_ids ) {
				foreach ( $attachment_ids as $attachment_id ) {
					
					$img_lightbox_caption = hcode_option_image_caption( $attachment_id );
					$img_lightbox_title = hcode_option_lightbox_image_title( $attachment_id );
					$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
					$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 
					
					$gallery_thumbnail = wc_get_image_size( 'gallery_thumbnail' );
					$thumbnail_size    = apply_filters( 'woocommerce_gallery_thumbnail_size', array( $gallery_thumbnail['width'], $gallery_thumbnail['height'] ) );
					$full_src = wp_get_attachment_image_src( $attachment_id, 'full' );
					$image = wp_get_attachment_image( $attachment_id, 'thumbnail', false, array(
						'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
						'data-src'                => $full_src[0],
						'data-large_image'        => $full_src[0],
						'data-large_image_width'  => $full_src[1],
						'data-large_image_height' => $full_src[2],
						'class'                   => '',
					) );

					$image = '<div class="item"><a href="'.esc_url( $full_src[0] ).'"'.$image_lightbox_caption.$image_lightbox_title.'>'.$image.'</a></div>';
					
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image , $attachment_id );
				}
			}
		echo '</div>';
	}
}