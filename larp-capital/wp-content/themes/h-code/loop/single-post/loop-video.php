<?php
/**
 * displaying single posts video for blog
 *
 * @package H-Code
 */
?>
<?php
// no image
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_disable_feature_image = (isset($hcode_options['hcode_disable_feature_image'])) ? $hcode_options['hcode_disable_feature_image'] : '';
$hcode_no_image = ( isset($hcode_options['hcode_no_image']) ) ? $hcode_options['hcode_no_image'] : '';
$video_type = hcode_post_meta( 'hcode_video_type' );

if( $video_type == 'self' ) {
	$video_mp4 = hcode_post_meta( 'hcode_video_mp4' );
	$video_ogg = hcode_post_meta( 'hcode_video_ogg' );
	$video_webm = hcode_post_meta( 'hcode_video_webm' );
    $mute = hcode_post_meta( 'hcode_enable_mute' );
    $loop = ( hcode_post_meta( 'hcode_enable_loop' ) != '' ) ? hcode_post_meta( 'hcode_enable_loop' ) : '1';
    $autoplay = ( hcode_post_meta( 'hcode_enable_autoplay' ) != '' ) ? hcode_post_meta( 'hcode_enable_autoplay' ) : '1';
    $controls = ( hcode_post_meta( 'hcode_enable_controls' ) != '' ) ? hcode_post_meta( 'hcode_enable_controls' ) : '1';
    $enable_mute = ( $mute == 1 ) ? ' muted' : '';
    $enable_loop = ( $loop == 1 ) ? ' loop' : '';
    $enable_autoplay = ( $autoplay == 1 ) ? ' autoplay' : '';
    $enable_controls = ( $controls == 1 ) ? ' controls' : '';
    if( $video_mp4 || $video_ogg || $video_webm ) {
        echo '<div class="blog-image bg-transparent text-center margin-bottom-30px">';
            echo '<video'.$enable_mute.$enable_loop.$enable_autoplay.$enable_controls.'>';
                if( !empty( $video_mp4 ) ) {
                    echo '<source src="'.$video_mp4.'" type="video/mp4">';
                }
                if( !empty( $video_ogg ) ) {
                    echo '<source src="'.$video_ogg.'" type="video/ogg">';
                }
                if( !empty( $video_webm ) ) {
                    echo '<source src="'.$video_webm.'" type="video/webm">';
                }
            echo '</video>';
        echo '</div>';
    }	
} else {
    $iframe_attributes = '';
    $video_url = hcode_post_meta( 'hcode_video' );
    $pos = strrpos( $video_url, '?' );
    $iframe_video_parameters = ( $pos === false ) ? $video_url : substr( $video_url, $pos + 1 );
    if( strpos( $iframe_video_parameters, 'autoplay=1' ) !== false ) {
        $iframe_attributes = ' allow="autoplay"';
    }
    if( $video_url ) {
        echo '<div class="blog-image bg-transparent fit-videos margin-bottom-30px">';
            echo '<iframe src="'.$video_url.'"'.$iframe_attributes.' width="640" height="360" allowfullscreen></iframe>';
        echo '</div>';
    }
}

if( $hcode_disable_feature_image == 1 ){
    $blog_image=hcode_post_meta( 'hcode_featured_image' );
    if( $blog_image == 1 ) {
        echo '<div class="blog-image bg-transparent">';
            if ( has_post_thumbnail() ) {
                echo get_the_post_thumbnail( get_the_ID(), 'full' );
            } elseif( !empty( $hcode_no_image['url'] ) ) {
                echo wp_get_attachment_image( $hcode_no_image['id'], 'full' );
            }
        echo '</div>';
    }
}