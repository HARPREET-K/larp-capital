<?php
/**
 * displaying posts featured image for blog
 *
 * @package H-Code
 */
?>
<?php
global $hcode_blog_thumbnail_size;

// no image
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';

echo '<div class="blog-image"><a href="'.get_permalink().'">';
    if ( has_post_thumbnail() ) {
        echo get_the_post_thumbnail( get_the_ID(), $hcode_blog_thumbnail_size );
    }elseif( !empty( $hcode_no_image['url'] ) ) {
    	echo wp_get_attachment_image( $hcode_no_image['id'], $hcode_blog_thumbnail_size );
    }
echo '</a></div>';