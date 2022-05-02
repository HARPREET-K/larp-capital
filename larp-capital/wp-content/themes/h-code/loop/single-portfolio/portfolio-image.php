<?php
/**
 * displaying portfolio single posts featured image for portfolio
 *
 * @package H-Code
 */
?>
<?php
$portfolio_image = hcode_post_meta( 'hcode_image' );
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