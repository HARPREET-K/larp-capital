<?php
/**
 * displaying posts in gallery for blog
 *
 * @package H-Code
 */
?>
<?php
global $hcode_blog_thumbnail_size;
$blog_lightbox_gallery = hcode_post_meta( 'hcode_lightbox_image' );
$blog_gallery = hcode_post_meta( 'hcode_gallery' );
$gallery = explode( ",", $blog_gallery );
$popup_id = 'blog-'.get_the_ID();

if( is_array( $gallery ) ) {
	if( $blog_lightbox_gallery == 1 ) {
		echo '<div class="blog-image lightbox-gallery">';
			foreach( $gallery as $key => $value ) {
				
				$img_lightbox_caption = hcode_option_image_caption( $value );
				$img_lightbox_title = hcode_option_lightbox_image_title( $value );
				$image_lightbox_caption = ( isset($img_lightbox_caption['caption']) && !empty($img_lightbox_caption['caption']) ) ? ' lightbox_caption="'.$img_lightbox_caption['caption'].'"' : '' ;
				$image_lightbox_title = ( isset($img_lightbox_title['title']) && !empty($img_lightbox_title['title']) ) ? ' title="'.$img_lightbox_title['title'].'"' : '' ; 
				$full_url = wp_get_attachment_image_src( $value, 'full' );
				
				echo '<div class="col-md-4 col-sm-6 col-xs-12 no-padding">';
	                echo '<a'.$image_lightbox_title.$image_lightbox_caption.' href="'.$full_url[0].'" class="lightboxgalleryitem" data-group="'.$popup_id.'">';
	                	echo wp_get_attachment_image( $value, $hcode_blog_thumbnail_size );
	                echo '</a>';
	            echo '</div>';
			}
	    echo '</div>';
	} else {
		echo '<div class="blog-image">';
	        echo '<div id="owl-demo" class="blog-gallery owl-carousel owl-theme dark-pagination">';
				foreach ($gallery as $key => $value) {
			        if ( $value ) {
			            echo '<div class="item">';
			                echo wp_get_attachment_image( $value, $hcode_blog_thumbnail_size );
				        echo '</div>';
			        }
				}
	        echo '</div>';
	    echo '</div>';
	}	
}