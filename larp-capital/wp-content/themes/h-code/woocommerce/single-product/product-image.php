<?php
/**
 * Single Product Image
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

$enable_product_default_image_gallery = ( hcode_option('enable_product_default_image_gallery')) ? hcode_option('enable_product_default_image_gallery') : '';

if( $enable_product_default_image_gallery ) {
	$columns           = apply_filters( 'woocommerce_product_thumbnails_columns', 6 );
	$post_thumbnail_id = $product->get_image_id();
	$wrapper_classes   = apply_filters( 'woocommerce_single_product_image_gallery_classes', array(
		'woocommerce-product-gallery',
		'woocommerce-product-gallery--' . ( $product->get_image_id() ? 'with-images' : 'without-images' ),
		'woocommerce-product-gallery--columns-' . absint( $columns ),
		'images',
		'single-product-wrapper-left',
		'no-transition',
	) );
	?>
	<div class="<?php echo esc_attr( implode( ' ', array_map( 'sanitize_html_class', $wrapper_classes ) ) ); ?>" data-columns="<?php echo esc_attr( $columns ); ?>" style="opacity: 0; transition: opacity .25s ease-in-out;">
		<figure class="woocommerce-product-gallery__wrapper default-woocommerce-product-image">
			<?php

			if ( $product->get_image_id() ) {
				$html = wc_get_gallery_image_html( $post_thumbnail_id, true );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src( 'woocommerce_single' ) ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';
			}

			echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );

			do_action( 'woocommerce_product_thumbnails' );
			?>
		</figure>
	</div>

<?php } else {

	$attachment_ids = $product->get_gallery_image_ids();
	$post_thumbnail_id = $product->get_image_id();
	if ( $attachment_ids || has_post_thumbnail() ) {

		$attachment_flag = false;
		$enable_product_image_lightbox_gallery = ( hcode_option( 'enable_product_image_lightbox_gallery' ) ) ? hcode_option( 'enable_product_image_lightbox_gallery' ) : '';
		$additional_class = '';

		if( $enable_product_image_lightbox_gallery != 1 ) {
			$additional_class = ' hcode-remove-lightbox-popup';
		}
	
		echo '<div class="single-product-image-wrapper">';
		echo '<div class="hcode-single-big-product-thumbnail-carousel images owl-carousel owl-theme product-zoom-gallery owl-small-arrow'.esc_attr( $additional_class ).'">';
			if ( has_post_thumbnail() ) {
				$attachment_flag = true;
				$img_lightbox_caption = hcode_option_image_caption( $post_thumbnail_id );
				$img_lightbox_title = hcode_option_lightbox_image_title( $post_thumbnail_id );
				$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
				$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 
				
				$full_size = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
				$full_src = wp_get_attachment_image_src( $post_thumbnail_id, $full_size );
				$image = wp_get_attachment_image( $post_thumbnail_id, $full_size, false, array(
					'data-caption'            => get_post_field( 'post_excerpt', $post_thumbnail_id ),
					'data-src'                => $full_src[0],
					'data-large_image'        => $full_src[0],
					'data-large_image_width'  => $full_src[1],
					'data-large_image_height' => $full_src[2],
					'class'                   => 'wp-post-image',
				) );

				$image = '<div class="item woocommerce-product-gallery__image" data-thumb="' . esc_url( $full_src[0] ) . '"><a href="'.esc_url( $full_src[0] ).'" class="woocommerce-main-image woocommerce-product-gallery__image zoom"'.$image_lightbox_caption.$image_lightbox_title.'>'.$image.'</a></div>';
				
				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image , $post_thumbnail_id );
			} else {
				$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
				$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
				$html .= '</div>';

				echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
			}

			if ( $attachment_ids && $attachment_flag ) {

				foreach ( $attachment_ids as $attachment_id ) {
					$img_lightbox_caption = hcode_option_image_caption( $attachment_id );
					$img_lightbox_title = hcode_option_lightbox_image_title( $attachment_id );
					$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
					$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 
					
					$full_size = apply_filters( 'woocommerce_gallery_full_size', apply_filters( 'woocommerce_product_thumbnails_large_size', 'full' ) );
					$full_src = wp_get_attachment_image_src( $attachment_id, $full_size );
					$image = wp_get_attachment_image( $attachment_id, $full_size );

					$image = wp_get_attachment_image( $attachment_id, $full_size, false, array(
						'data-caption'            => get_post_field( 'post_excerpt', $attachment_id ),
						'data-src'                => $full_src[0],
						'data-large_image'        => $full_src[0],
						'data-large_image_width'  => $full_src[1],
						'data-large_image_height' => $full_src[2],
					) );

					$image = '<div class="item woocommerce-product-gallery__image" data-thumb="' . esc_url( $full_src[0] ) . '"><a itemprop="image" href="'.esc_url( $full_src[0] ).'" class="woocommerce-main-image woocommerce-product-gallery__image"'.$image_lightbox_caption.$image_lightbox_title.'>'.$image.'</a></div>';
					echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $image , $attachment_id );
				}
			}
		echo '</div>';
		echo '</div>';
		do_action( 'woocommerce_product_thumbnails' );
	} else {
		$html  = '<div class="woocommerce-product-gallery__image--placeholder">';
		$html .= sprintf( '<img src="%s" alt="%s" class="wp-post-image" />', esc_url( wc_placeholder_img_src() ), esc_html__( 'Awaiting product image', 'woocommerce' ) );
		$html .= '</div>';
		echo '<div class="single-product-image-wrapper">';
		echo apply_filters( 'woocommerce_single_product_image_thumbnail_html', $html, $post_thumbnail_id );
		echo '</div>';
		do_action( 'woocommerce_product_thumbnails' );
	}
}