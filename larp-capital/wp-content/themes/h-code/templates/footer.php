<?php
/**
 * displaying footer section
 *
 * @package H-Code
 */
?>
<?php
$footer_menu_class = $footer_social_class = $old_page_footer_meta = '';
$enable_sidebar = hcode_option( 'hcode_enable_sidebar_section' );

if( !empty( $post ) ) {
    $old_page_footer_meta = get_post_meta( $post->ID, 'hcode_enable_page_footer_single', true);
}
if( $old_page_footer_meta != '' && strlen( $old_page_footer_meta ) > 0 ) {
    $enable_footer = hcode_option( 'hcode_enable_page_footer' );
} else {
    $enable_footer = 'default';  
}

$hcode_options = get_option( 'hcode_theme_setting' );
$enable_social_icons = hcode_option( 'hcode_enable_social_icons' );
$enable_social_sidebar = hcode_option( 'hcode_social_sidebar' );
$enable_footer_copyright = hcode_option( 'hcode_enable_footer_copyright' );
$footer_copyright = hcode_option( 'hcode_footer_copyright' );
$enable_scrolltotop_button = hcode_option( 'hcode_enable_scrolltotop_button' );
$enable_scrolltotop_button_mobile = hcode_option( 'hcode_enable_scrolltotop_button_mobile' );

$enable_footer_logo = (isset($hcode_options['hcode_enable_footer_logo'])) ? $hcode_options['hcode_enable_footer_logo'] : '';
$footer_logo = (isset($hcode_options['hcode_footer_logo'])) ? $hcode_options['hcode_footer_logo'] : '';
$enable_footer_menu = '';

if( ( is_page() || is_single('page') || is_singular(array( 'post', 'portfolio' ))) && $enable_footer != 'default'){
    $footer_sidebar1 = hcode_option('hcode_footer_sidebar_1');
    $footer_sidebar2 = hcode_option('hcode_footer_sidebar_2');
    $footer_sidebar3 = hcode_option('hcode_footer_sidebar_3');
    $footer_sidebar4 = hcode_option('hcode_footer_sidebar_4');
    $footer_sidebar5 = hcode_option('hcode_footer_sidebar_5');
    $enable_footer_menu = hcode_option('hcode_enable_footer_menu');
    $footer_menu = hcode_option('hcode_footer_menu');
    
}else{
    $enable_sidebar = (isset($hcode_options['hcode_enable_sidebar_section'])) ? $hcode_options['hcode_enable_sidebar_section'] : '';
    $enable_footer = hcode_option('hcode_enable_page_footer');
    $enable_footer_menu = hcode_option('hcode_enable_footer_menu');
    $footer_menu = hcode_option('hcode_footer_menu');
    $footer_sidebar1 = hcode_option('hcode_footer_sidebar_1');
    $footer_sidebar2 = hcode_option('hcode_footer_sidebar_2');
    $footer_sidebar3 = hcode_option('hcode_footer_sidebar_3');
    $footer_sidebar4 = hcode_option('hcode_footer_sidebar_4');
    $footer_sidebar5 = hcode_option('hcode_footer_sidebar_5');
    $enable_social_icons = hcode_option('hcode_enable_social_icons');
}
$seperator = $footer_class = '';

/* Footer Column */
$hcode_footer_sidebar_1_md_column = hcode_option( 'hcode_footer_sidebar_1_md_column' );
$hcode_footer_sidebar_1_md_column = ( $hcode_footer_sidebar_1_md_column ) ? $hcode_footer_sidebar_1_md_column.' ' : 'col-md-4 ';
$hcode_footer_sidebar_1_sm_column = hcode_option( 'hcode_footer_sidebar_1_sm_column' );
$hcode_footer_sidebar_1_sm_column = ( $hcode_footer_sidebar_1_sm_column ) ? $hcode_footer_sidebar_1_sm_column.' ' : 'col-sm-12 ';
$hcode_footer_sidebar_1_xs_column = hcode_option( 'hcode_footer_sidebar_1_xs_column' );
$hcode_footer_sidebar_1_xs_column = ( $hcode_footer_sidebar_1_xs_column ) ? $hcode_footer_sidebar_1_xs_column.' ' : 'col-xs-12 ';

$hcode_footer_sidebar_2_md_column = hcode_option( 'hcode_footer_sidebar_2_md_column' );
$hcode_footer_sidebar_2_md_column = ( $hcode_footer_sidebar_2_md_column ) ? $hcode_footer_sidebar_2_md_column.' ' : 'col-md-2 ';
$hcode_footer_sidebar_2_sm_column = hcode_option( 'hcode_footer_sidebar_2_sm_column' );
$hcode_footer_sidebar_2_sm_column = ( $hcode_footer_sidebar_2_sm_column ) ? $hcode_footer_sidebar_2_sm_column.' ' : 'col-sm-3 ';
$hcode_footer_sidebar_2_xs_column = hcode_option( 'hcode_footer_sidebar_2_xs_column' );
$hcode_footer_sidebar_2_xs_column = ( $hcode_footer_sidebar_2_xs_column ) ? $hcode_footer_sidebar_2_xs_column.' ' : 'col-xs-12 ';

$hcode_footer_sidebar_3_md_column = hcode_option( 'hcode_footer_sidebar_3_md_column' );
$hcode_footer_sidebar_3_md_column = ( $hcode_footer_sidebar_3_md_column ) ? $hcode_footer_sidebar_3_md_column.' ' : 'col-md-2 ';
$hcode_footer_sidebar_3_sm_column = hcode_option( 'hcode_footer_sidebar_3_sm_column' );
$hcode_footer_sidebar_3_sm_column = ( $hcode_footer_sidebar_3_sm_column ) ? $hcode_footer_sidebar_3_sm_column.' ' : 'col-sm-3 ';
$hcode_footer_sidebar_3_xs_column = hcode_option( 'hcode_footer_sidebar_3_xs_column' );
$hcode_footer_sidebar_3_xs_column = ( $hcode_footer_sidebar_3_xs_column ) ? $hcode_footer_sidebar_3_xs_column.' ' : 'col-xs-12 ';

$hcode_footer_sidebar_4_md_column = hcode_option( 'hcode_footer_sidebar_4_md_column' );
$hcode_footer_sidebar_4_md_column = ( $hcode_footer_sidebar_4_md_column ) ? $hcode_footer_sidebar_4_md_column.' ' : 'col-md-2 ';
$hcode_footer_sidebar_4_sm_column = hcode_option( 'hcode_footer_sidebar_4_sm_column' );
$hcode_footer_sidebar_4_sm_column = ( $hcode_footer_sidebar_4_sm_column ) ? $hcode_footer_sidebar_4_sm_column.' ' : 'col-sm-3 ';
$hcode_footer_sidebar_4_xs_column = hcode_option( 'hcode_footer_sidebar_4_xs_column' );
$hcode_footer_sidebar_4_xs_column = ( $hcode_footer_sidebar_4_xs_column ) ? $hcode_footer_sidebar_4_xs_column.' ' : 'col-xs-12 ';

$hcode_footer_sidebar_5_md_column = hcode_option( 'hcode_footer_sidebar_5_md_column' );
$hcode_footer_sidebar_5_md_column = ( $hcode_footer_sidebar_5_md_column ) ? $hcode_footer_sidebar_5_md_column.' ' : 'col-md-2 ';
$hcode_footer_sidebar_5_sm_column = hcode_option( 'hcode_footer_sidebar_5_sm_column' );
$hcode_footer_sidebar_5_sm_column = ( $hcode_footer_sidebar_5_sm_column ) ? $hcode_footer_sidebar_5_sm_column.' ' : 'col-sm-3 ';
$hcode_footer_sidebar_5_xs_column = hcode_option( 'hcode_footer_sidebar_5_xs_column' );
$hcode_footer_sidebar_5_xs_column = ( $hcode_footer_sidebar_5_xs_column ) ? $hcode_footer_sidebar_5_xs_column.' ' : 'col-xs-12 ';

if( $enable_footer == 1 ) {
    if( $enable_sidebar == 0 && ( $enable_footer_menu == '1' || $enable_social_icons == 1 ) ) {
        $footer_class .= '';
        echo '<div class="container hcode-footer-middle">';
    } elseif( $enable_sidebar == 0 && $enable_footer_menu == '0' && $enable_social_icons == 0 ) {
        $footer_class .= 'no-margin-bottom';
    } else {
        $footer_class .= 'no-margin-bottom';
        if( $enable_sidebar == 1 || $enable_footer_menu == 1 || $enable_social_icons == 1 ) {
            echo '<div class="container footer-middle hcode-footer-middle">';
        }
    }
    if( $enable_sidebar == 0 || ( $enable_footer_menu == 0 && $enable_social_icons == 0 ) ) {
        $seperator .='';
    } else {
        $seperator .='<div class="wide-separator-line bg-mid-gray no-margin-lr margin-three no-margin-bottom"></div>';
    }
    
    if( $enable_sidebar == 1 ){
	    echo '<div class="row">';
	    	if( is_active_sidebar( $footer_sidebar1 ) && !( empty( $footer_sidebar1 ) ) ) {
	    		echo '<div class="'.$hcode_footer_sidebar_1_md_column.$hcode_footer_sidebar_1_sm_column.$hcode_footer_sidebar_1_xs_column.'footer-links no-transition sm-margin-bottom-15px">';
					dynamic_sidebar( $footer_sidebar1 );
				echo '</div>';
			}

			if( is_active_sidebar( $footer_sidebar2 ) && !( empty( $footer_sidebar2 ) ) ) {
				echo '<div class="'.$hcode_footer_sidebar_2_md_column.$hcode_footer_sidebar_2_sm_column.$hcode_footer_sidebar_2_xs_column.'footer-links no-transition">';
					dynamic_sidebar( $footer_sidebar2 );
				echo '</div>';
			}

			if( is_active_sidebar( $footer_sidebar3 ) && !( empty( $footer_sidebar3 ) ) ) {
				echo '<div class="'.$hcode_footer_sidebar_3_md_column.$hcode_footer_sidebar_3_sm_column.$hcode_footer_sidebar_3_xs_column.'footer-links no-transition">';
					dynamic_sidebar( $footer_sidebar3 );
				echo '</div>';
			}
	       
			if( is_active_sidebar( $footer_sidebar4 ) && !( empty( $footer_sidebar4 ) ) ) {
				echo '<div class="'.$hcode_footer_sidebar_4_md_column.$hcode_footer_sidebar_4_sm_column.$hcode_footer_sidebar_4_xs_column.'footer-links no-transition">';	
					dynamic_sidebar( $footer_sidebar4 );
				echo '</div>';
			}

            if( is_active_sidebar( $footer_sidebar5 ) && !( empty( $footer_sidebar5 ) ) ) {
                echo '<div class="'.$hcode_footer_sidebar_5_md_column.$hcode_footer_sidebar_5_sm_column.$hcode_footer_sidebar_5_xs_column.'footer-links no-transition">';  
                    dynamic_sidebar( $footer_sidebar5 );
                echo '</div>';
            }
	    echo '</div>'.$seperator;
    }
    if( $enable_footer_menu == 1 || $enable_social_icons == 1 ){
        if( $enable_footer_menu == 1 && $enable_social_icons == 0 ){
            $footer_menu_class .= ' footer-position';
        } elseif( $enable_footer_menu == 0 && $enable_social_icons == 1 ){
            $footer_social_class .= ' footer-position';
        } else{
            $footer_menu_class .= '';
            $footer_social_class .= '';
        }

        echo '<div class="row margin-four '.$footer_class.'">';
        	if (($footer_menu != '' && $enable_footer_menu == '1') || (has_nav_menu( 'hcodefootermenu' ) && $enable_footer_menu == '1')){
                echo '<div class="col-md-6 col-sm-12 sm-text-center sm-margin-bottom-four hcode-footer-menu'.$footer_menu_class.'">';

                    $defaults = '';
                    if( !empty( $footer_menu ) ){
                        $defaults = array(
                            'container'       => '',
                            'menu'            => $footer_menu,
                            'menu_class'      => 'list-inline footer-link text-uppercase',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => false,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker'          => new Hcode_Footer_Menu_Walker,
                        );
                    } elseif( has_nav_menu( 'hcodefootermenu' ) ){
                        $defaults = array(
                            'theme_location'  => 'hcodefootermenu',
                            'container'       => '',
                            'menu_class'      => 'list-inline footer-link text-uppercase',
                            'menu_id'         => '',
                            'echo'            => true,
                            'fallback_cb'     => false,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            'walker'          => new Hcode_Footer_Menu_Walker, 
                        );
                    }else{
                        $defaults = array(
                            'container'       => '',
                            'menu_class'      => 'list-inline footer-link text-uppercase',
                            'menu_id'         => '',
                            'echo'            => true,
                            'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                        );
                    }
                    wp_nav_menu( $defaults );

                echo '</div>';
        	}
            if(($enable_social_icons == 1 || $enable_social_icons == 'default') && !(empty($enable_social_sidebar))){
                echo '<div class="col-md-6 col-sm-12 footer-social text-right sm-text-center'.$footer_social_class.'">';
                    dynamic_sidebar( $enable_social_sidebar );
                echo '</div>';
            }
        echo '</div>';
    }

    if( $enable_sidebar == 1 || $enable_footer_menu == 1 || $enable_social_icons == 1 ){
       echo '</div>';
    }

    /* Add Privacy Policy Link */
    $hcode_set_policy_page = false;
    $hcode_policy_page_id = (int) get_option( 'wp_page_for_privacy_policy' );
    if ( ! empty( $hcode_policy_page_id ) && get_post_status( $hcode_policy_page_id ) === 'publish' ) {                           
        $hcode_set_policy_page = true;
    }

    if( ( $enable_footer_copyright == 1 && $footer_copyright ) || $enable_footer_logo == 1 || $hcode_set_policy_page ) {
        echo '<div class="container-fluid bg-dark-gray footer-bottom hcode-footer-bottom">';
            echo '<div class="container">';
                echo '<div class="row margin-three">';
                    if( ( $enable_footer_copyright == 1 && $footer_copyright ) || $hcode_set_policy_page ) {
                        $column_size = ( $enable_footer_logo == 1 && !empty( $footer_logo['url'] ) ) ? '9' : '12';

                        echo '<div class="col-md-'.esc_attr( $column_size ).' col-sm-'.esc_attr( $column_size ).' col-xs-12 copyright text-left letter-spacing-1 xs-text-center xs-margin-bottom-one light-gray-text2">';
                            if( $enable_footer_copyright == 1 && $footer_copyright ) {
                                $args = array( 'before_widget' => '<div class="hcode-footer-copyright vertical-align-middle display-inline-block">', 'after_widget'  => '</div>' );
                                echo the_widget( 'WP_Widget_Text', array( 'text' => $footer_copyright ), $args );
                            }

                            if ( function_exists( 'the_privacy_policy_link' ) ) {
                                if( $enable_footer_copyright == 1 && $footer_copyright ) {
                                    the_privacy_policy_link( ' | ', '' );
                                } else {
                                    the_privacy_policy_link();
                                }
                            }
                        echo '</div>';
                    }
                    if( $enable_footer_logo == 1 ) {
                        $bottom_column_size = ( ( $enable_footer_copyright == 1 && $footer_copyright ) || $hcode_set_policy_page ) ? '3' : '12';
                        echo '<div class="col-md-'.esc_attr( $bottom_column_size ).' col-sm-'.esc_attr( $bottom_column_size ).' col-xs-12 footer-logo text-right xs-text-center">';
                            echo '<a href="'.home_url('/').'">';
                                echo wp_get_attachment_image( $footer_logo['id'], 'full' );
                            echo '</a>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</div>';
    }
}

$enable_ajax = '';
if( get_post_type( get_the_ID() ) == 'portfolio' && is_singular( 'portfolio' ) ){
    $enable_ajax = get_post_meta( get_the_ID(), 'hcode_enable_ajax_popup_single', true );
}

$hcode_enable_scrolltotop_button_position = ( isset( $hcode_options['hcode_enable_scrolltotop_button_position'] ) && $hcode_options['hcode_enable_scrolltotop_button_position'] == 1 ) ? ' scrolltotop-position-right' : ' scrolltotop-position-left';

if( $enable_scrolltotop_button == 1 && ( $enable_ajax == '' || $enable_ajax == 'no' ) ) {
    echo '<a class="scrollToTop'.esc_attr( $hcode_enable_scrolltotop_button_position ).'" href="javascript:void(0);"><i class="fas fa-angle-up"></i></a>';
} elseif ( $enable_scrolltotop_button_mobile == 1 && ( $enable_ajax == '' || $enable_ajax == 'no' ) ) {
    echo '<a class="display-none xs-display-block scrollToTop'.esc_attr( $hcode_enable_scrolltotop_button_position ).'" href="javascript:void(0);"><i class="fas fa-angle-up"></i></a>';
}