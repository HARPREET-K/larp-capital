<?php
/**
 * displaying portfolio single posts video for portfolio
 *
 * @package H-Code
 */
?>
<?php

$video = hcode_post_meta( 'hcode_video' );

if( strpos( $video, 'player.vimeo.com' ) == true ) {
	$video_url = $video;
} else {
	$video_url = 'https://www.youtube.com/embed/'.substr( $video, strpos( $video, "v=" ) + 2 );
}

if( $video ) {
    echo '<div class="gallery-img fit-videos margin-bottom-30px">';
        echo '<iframe src="'.$video_url.'" width="640" height="360" allowfullscreen></iframe>';
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