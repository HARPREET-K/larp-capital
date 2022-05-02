<?php
/**
 * displaying single posts featured image for blog
 *
 * @package H-Code
 */
?>
<?php
// no image

$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
$hcode_disable_feature_image = (isset($hcode_options['hcode_disable_feature_image'])) ? $hcode_options['hcode_disable_feature_image'] : '';

if( $hcode_disable_feature_image == 1 ){
	$blog_image = hcode_post_meta( 'hcode_image' );
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