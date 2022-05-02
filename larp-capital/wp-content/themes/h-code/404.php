<?php
/**
 * The template for displaying 404 pages (not found)
 *
 * @package H-Code
 */

get_header();?>
<?php
    $font_color = ( hcode_option( '404_font_color' ) ) ? ' color: '.hcode_option( '404_font_color' ).' !important;' : '';
    $title_text = ( hcode_option( '404_title_text' ) ) ? hcode_option( '404_title_text' ) : '';
    $content_text = ( hcode_option( '404_content_text' ) ) ? hcode_option( '404_content_text' ) : '';
    $img = hcode_option( '404_image' );

    $img_id = $img['id'];
    $hcode_title_image_srcset = hcode_option( '404_image_srcset' );
    $hcode_srcset = $hcode_srcset_data = $hcode_srcset_classes = '';
    $hcode_srcset = wp_get_attachment_image_srcset( $img_id, $hcode_title_image_srcset );
    if( $hcode_srcset ){
        $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
        $hcode_srcset_classes = ' bg-image-srcset';
    }
    $hcode_image_url = wp_get_attachment_image_src( $img_id, $hcode_title_image_srcset );

    $image = ( $hcode_image_url[0] ) ? ' background-image: url('.$hcode_image_url[0].'); ' : '';
    $bg_color = ( hcode_option( '404_bg_color' ) ) ? ' background-color: '.hcode_option( '404_bg_color' ).'; ' : '';
    $button = ( hcode_option( '404_button' ) ) ? hcode_option( '404_button' ) : __( 'Go to home page', 'H-Code' );
    $button_url = ( hcode_option( '404_button_url' ) ) ? get_permalink( get_page_by_path( hcode_option( '404_button_url' ) )) : home_url();
    $enable_text_button = hcode_option( '404_enable_text_button' );
    $enable_search = hcode_option( '404_enable_search' );

    $top_header_class = '';

    $hcode_enable_mini_header = hcode_option( 'hcode_enable_mini_header' );
    $hcode_enable_mini_header_mobile = hcode_option( 'hcode_enable_mini_header_mobile' );
            
    $hcode_options = get_option( 'hcode_theme_setting' );
    $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
    $hcode_header_layout = (isset($hcode_options['hcode_header_layout'])) ? $hcode_options['hcode_header_layout'] : '';
       
    if($hcode_enable_header == 1 && $hcode_header_layout != 'headertype9') {
        $header_logo_position = hcode_option( 'hcode_header_logo_position' );
        if( hcode_check_enable_mini_header() ) {
            if( $header_logo_position == 'top' && $hcode_header_layout != 'headertype9' && $hcode_header_layout != 'headertype10' && $hcode_header_layout != 'headertype11' ) {
                $top_header_class .= 'content-top-margin-extra-big';
            } else {
                $top_header_class .= 'content-top-margin-big';
            }
        } else if( $hcode_header_layout != 'headertype8' ) {
            if( $header_logo_position == 'top' && $hcode_header_layout != 'headertype9' && $hcode_header_layout != 'headertype10' && $hcode_header_layout != 'headertype11' ) {
                $top_header_class .= 'content-top-margin-midium-big';
            } else {
                $top_header_class .= 'content-top-margin';
            }
        }
    }
    else if($hcode_enable_header == 1 && hcode_check_enable_mini_header() && $hcode_header_layout == 'headertype9') {
        $top_header_class .= 'content-mini-header-margin';
    }

    if( $hcode_enable_mini_header == 1 && $hcode_enable_mini_header_mobile == 1 ) {
        $top_header_class .= ' mobile-mini-header-visible';
    }

    ?>
    <?php // Start 404 Page Content
    echo '<section class="no-padding cover-background full-screen wow fadeIn'.$hcode_srcset_classes.'" style="'.$font_color . $image.$bg_color.'"'.$hcode_srcset_data.'>';
        echo '<div class="container">';
            echo '<div class="row">';
                echo '<div class="col-md-10 col-sm-12 col-xs-12 text-center center-col full-screen">';
                    echo '<div class="col-text-center">';
                        echo '<div class="col-text-middle-main">';
                            echo '<div class="col-text-middle">';
                                if( $title_text ){
                                    echo '<p class="not-found-title white-text" style="'.$font_color.'">'.$title_text.'</p>';
                                }
                                if( $content_text ) {
                                    echo '<p class="title-small xs-title-small xs-display-none text-uppercase letter-spacing-2 white-text" style="'.$font_color.'">'.$content_text.'</p>';
                                }

                                echo '<div class="not-found-search-box">';
                                    if( $enable_text_button == 1 ){
                                        echo '<a class="btn-small-white btn btn-medium no-margin-right" style="'.$font_color.'" href="'.$button_url.'">'.$button.'</a>';
                                    }
                                    if( $enable_text_button == 1 && $enable_search == 1 ){
                                        echo '<div class="not-found-or-text" style="'.$font_color.'">'.__('or', 'H-Code').'</div>';
                                    }
                                    if( $enable_search == 1 ){
                                        echo get_search_form( );
                                    }
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
    echo '</section>';
    get_footer();