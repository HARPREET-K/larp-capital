<?php
/**
 * displaying portfolio single posts in gallery for portfolio
 *
 * @package H-Code
 */
?>
<?php
$portfolio_gallery = hcode_post_meta( 'hcode_gallery' );
$gallery = explode( ",", $portfolio_gallery );
$popup_id = 'portfolio-'.get_the_ID();
$i = 1;
$image = '';
// no image
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
if( is_array( $gallery ) ) {
	echo '<div class="gallery-img lightbox-gallery margin-bottom-30px">';
	foreach( $gallery as $k => $value ) {

		$img_lightbox_caption = hcode_option_image_caption( $value );
		$img_lightbox_title = hcode_option_lightbox_image_title( $value );
		$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
		$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 

		$thumb_gallery = wp_get_attachment_image_src( $value, 'full' );
		if( $i == 1 ) {
			echo '<a href="'.$thumb_gallery[0].'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="'.$popup_id.'">';
				echo wp_get_attachment_image( $value, 'full' );
			echo '</a>';
		} else {
			echo '<a href="'.$thumb_gallery[0].'" '.$image_lightbox_title.$image_lightbox_caption.' class="lightboxgalleryitem" data-group="'.$popup_id.'"></a>';
		}
		$i++;
	}
	echo '</div>';
}

$portfolio_image = hcode_post_meta( 'hcode_featured_image' );
$enable_featured_image = (isset($hcode_options['hcode_enable_featured_image_portfolio'])) ? $hcode_options['hcode_enable_featured_image_portfolio'] : '';

if( $enable_featured_image == 1 ){
	if( $portfolio_image == 1 ) {
		if ( has_post_thumbnail() ) {
			echo '<div class="gallery-img margin-bottom-30px">';
	        echo get_the_post_thumbnail( get_the_ID(), 'full' );
	        echo '</div>';
	    }
	}
}