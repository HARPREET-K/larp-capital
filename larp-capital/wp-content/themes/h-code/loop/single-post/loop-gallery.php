<?php
/**
 * displaying single posts in gallery for blog
 *
 * @package H-Code
 */
?>
<?php
$blog_lightbox_gallery = hcode_post_meta( 'hcode_lightbox_image' );
$blog_gallery = hcode_post_meta( 'hcode_gallery' );
$gallery = explode( ",", $blog_gallery );
$popup_id = 'blog-'.get_the_ID();
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_disable_feature_image = (isset($hcode_options['hcode_disable_feature_image'])) ? $hcode_options['hcode_disable_feature_image'] : '';
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

if( is_array( $gallery ) ) {
	if( $blog_lightbox_gallery == 1 ) {
		echo '<div class="blog-image bg-transparent lightbox-gallery margin-bottom-30px">';
			foreach( $gallery as $key => $value ) {

				$img_lightbox_caption = hcode_option_image_caption( $value );
				$img_lightbox_title = hcode_option_lightbox_image_title( $value );
				$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
				$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 

				$thumb = wp_get_attachment_image_src( $value, 'full' );
			    echo '<div class="col-md-4 col-sm-6 col-xs-12 no-padding">';
                    echo '<a '.$image_lightbox_title.$image_lightbox_caption.' href="'.$thumb[0].'" class="lightboxgalleryitem" data-group="'.$popup_id.'">';
                    echo wp_get_attachment_image( $value, 'full' );
                    echo '</a>';
                echo '</div>';
			}
	    echo '</div>';
	} else {
		echo '<div class="blog-image bg-transparent margin-bottom-30px">';
	        echo '<div id="owl-demo" class="blog-gallery owl-carousel owl-theme dark-pagination">';
				foreach( $gallery as $key => $value ) {
		            echo '<div class="item">';
		            	echo wp_get_attachment_image( $value, 'full' );
		        	echo '</div>';
				}
	        echo '</div>';
	    echo '</div>';
	}
}

if( $hcode_disable_feature_image == 1 ){
	$blog_image = hcode_post_meta( 'hcode_featured_image' );
	if( $blog_image == 1 ) {
		echo '<div class="blog-image bg-transparent">';
	        if ( has_post_thumbnail() ) {
	            echo get_the_post_thumbnail( get_the_ID(), 'full' );
	        }elseif( !empty( $hcode_no_image['url'] ) ) {
	        	echo wp_get_attachment_image( $hcode_no_image['id'], 'full' );
	        }
		echo '</div>';
	}
}