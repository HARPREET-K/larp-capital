<?php
/**
 * displaying menu section
 *
 * @package H-Code
 */
?>
<?php 
$hcode_header_text_color = $old_page_header_meta = $output = $classes = $enable_sticky = $hcode_menu_hover_delay = $hcode_top_header = $hcode_remove_top_header = $header_menu_col_class = $header_logo_wrap_class = '';
if( class_exists( 'WooCommerce' ) && ( is_product() || is_product_category() || is_product_tag()) || is_404() || is_home() ){
    $enable_header = '2';
}else{
    $old_page_header_meta = get_post_meta( $post->ID, 'hcode_enable_header_single', true);
    if( $old_page_header_meta != '' && strlen( $old_page_header_meta ) > 0 ){
        $enable_header = hcode_option('hcode_enable_header');
    } else {
        $enable_header = '2';  
    }
}
$hcode_header_layout = hcode_option('hcode_header_layout');
if( hcode_check_enable_mini_header() ) { 
        $hcode_enable_mini_header_sidebar   = hcode_option( 'hcode_enable_mini_header_sidebar' );
        $hcode_enable_sticky_mini_header    = hcode_option( 'hcode_enable_sticky_mini_header' );
        $hcode_enable_mini_header_mobile    = hcode_option( 'hcode_enable_mini_header_mobile' );
        $sticky_header_class        = empty( $hcode_enable_sticky_mini_header ) ? 'no-sticky-mini-header ' : 'sticky-mini-header ';
        $mini_header_mobile_class   = $hcode_enable_mini_header_mobile == 1 ? 'mini-header-mobile ' : '';

    echo '<header class="'.$sticky_header_class.$mini_header_mobile_class.$hcode_header_layout.'">';
        echo '<div class="top-header-area">';
            echo '<div class="container">';
                echo '<div class="row">';
                    echo '<div class="col-md-12">';
                        dynamic_sidebar( $hcode_enable_mini_header_sidebar );
                    echo '</div>';
                echo '</div>';
            echo '</div>';
        echo '</div>';
}

if( $enable_header == '1' || $enable_header == '2' ){
    $hcode_options = get_option( 'hcode_theme_setting' );
    
    if( $enable_header == '2' ){
        $hcode_enable_header = ( isset( $hcode_options['hcode_enable_header'] ) ) ? $hcode_options['hcode_enable_header'] : '';
        if( $hcode_enable_header == 0 ){
            return;
        }
    }
    $hcode_enable_menu = hcode_option( 'hcode_enable_menu' );
    $hcode_header_logo = hcode_option( 'hcode_header_logo' );

    /* Main Logo Alt text */

    $get_logo_alt_text = $add_logo_alt_text = '';
    if( isset( $hcode_header_logo['id'] ) ) {
        $get_logo_alt_text = get_post_meta( $hcode_header_logo["id"], '_wp_attachment_image_alt', true );
        $add_logo_alt_text = $get_logo_alt_text ? $get_logo_alt_text : get_bloginfo( 'name' );
    } else {
        $get_logo_alt_text = get_post_meta( get_the_ID(), 'hcode_header_logo_single', true );
        $get_image_id = attachment_url_to_postid( $get_logo_alt_text );
        $get_id_logo_alt_text = get_post_meta ( $get_image_id, '_wp_attachment_image_alt', true );
        $add_logo_alt_text = $get_id_logo_alt_text ? $get_id_logo_alt_text : get_bloginfo( 'name' );
    }
    if( is_array( $hcode_header_logo ) ){
        $hcode_header_logo = $hcode_header_logo['url'];
    }

    /* Light Logo Alt text */
    $hcode_header_light_logo = hcode_option( 'hcode_header_light_logo' );
    $get_light_logo_alt_text = $add_light_logo_alt_text = '';
    if( isset( $hcode_header_light_logo['id'] ) ) {
        $get_light_logo_alt_text = get_post_meta( $hcode_header_light_logo["id"], '_wp_attachment_image_alt', true );
        $add_light_logo_alt_text = $get_light_logo_alt_text ? $get_light_logo_alt_text : get_bloginfo( 'name' );
    } else {
        $get_light_logo_alt_text = get_post_meta( get_the_ID(), 'hcode_header_light_logo_single_thumb', true );
        $get_image_id = attachment_url_to_postid( $get_light_logo_alt_text );
        $get_id_logo_alt_text = get_post_meta ( $get_image_id, '_wp_attachment_image_alt', true );
        $add_light_logo_alt_text = $get_id_logo_alt_text ? $get_id_logo_alt_text : get_bloginfo( 'name' );
    }
    if( is_array( $hcode_header_light_logo ) ){
        $hcode_header_light_logo =  $hcode_header_light_logo['url'];
    }

    /* Retina Logo Alt text */
    $retina = hcode_option( 'hcode_retina_logo' );
    $get_retina_logo_alt_text = $add_retina_logo_alt_text = '';
    if( isset( $retina['id'] ) ) {
        $get_retina_logo_alt_text = get_post_meta( $retina["id"], '_wp_attachment_image_alt', true );
        $add_retina_logo_alt_text = $get_retina_logo_alt_text ? $get_retina_logo_alt_text : get_bloginfo( 'name' );
    } else {
        $get_retina_logo_alt_text = get_post_meta( get_the_ID(), 'hcode_retina_logo_single_thumb', true );
        $get_image_id = attachment_url_to_postid( $get_retina_logo_alt_text );
        $get_id_logo_alt_text = get_post_meta ( $get_image_id, '_wp_attachment_image_alt', true );
        $add_retina_logo_alt_text = $get_id_logo_alt_text ? $get_id_logo_alt_text : get_bloginfo( 'name' );
    }
    if( is_array( $retina ) ){
        $retina =  $retina['url'];
    }

    /* Retina Logo Light Alt text */
    $retina_light = hcode_option( 'hcode_retina_logo_light' );
    $get_retina_light_logo_alt_text = $add_retina_light_logo_alt_text = '';
    if( isset( $retina_light['id'] ) ) {
        $get_retina_light_logo_alt_text = get_post_meta( $retina_light["id"], '_wp_attachment_image_alt', true );
        $add_retina_light_logo_alt_text = $get_retina_light_logo_alt_text ? $get_retina_light_logo_alt_text : get_bloginfo( 'name' );
    } else {
        $get_retina_light_logo_alt_text = get_post_meta( get_the_ID(), 'hcode_retina_logo_light_single_thumb', true );
        $get_image_id = attachment_url_to_postid( $get_retina_light_logo_alt_text );
        $get_id_logo_alt_text = get_post_meta ( $get_image_id, '_wp_attachment_image_alt', true );
        $add_retina_light_logo_alt_text = $get_id_logo_alt_text ? $get_id_logo_alt_text : get_bloginfo( 'name' );
    }
    if( is_array( $retina_light ) ){
        $retina_light =  $retina_light['url'];
    }

    $header_menu = hcode_option('hcode_header_menu');
    if( empty( $header_menu ) ) {
        $header_menu = ( isset( $hcode_options['hcode_header_menu'] ) ) ? $hcode_options['hcode_header_menu'] : '';
    }

    $header_secondary_menu = hcode_option('hcode_header_secondary_menu');
    if( empty( $header_secondary_menu ) ) {
        $header_secondary_menu = ( isset( $hcode_options['hcode_header_secondary_menu'] ) ) ? $hcode_options['hcode_header_secondary_menu'] : '';
    }

    $hcode_header_text_color = ' '.hcode_option('hcode_header_text_color');
    $hcode_header_search = hcode_option('hcode_header_search');
    $hcode_header_cart = hcode_option('hcode_header_cart');
    if( isset( $hcode_options['hcode_header_mini_cart'] ) ){
        $hcode_header_mini_cart = ( isset( $hcode_options['hcode_header_mini_cart'] ) && !empty( $hcode_options['hcode_header_mini_cart'] ) ) ? $hcode_options['hcode_header_mini_cart'] : '';
    } else {
        $hcode_header_mini_cart = 'hcode-mini-cart';
    }
    
    $hcode_search_placeholder_text = ( isset( $hcode_options['hcode_search_placeholder_text'] ) && !empty( $hcode_options['hcode_search_placeholder_text'] ) ) ? $hcode_options['hcode_search_placeholder_text'] : '';

    $menu_style = hcode_option('hcode_header_layout');
    if( empty( $menu_style ) ) {
        $menu_style = ( isset( $hcode_options['hcode_header_layout'] ) ) ? $hcode_options['hcode_header_layout'] : '';
    }

    /* H-Code V1.8 */
    $hcode_menu_hover_delay = ( isset( $hcode_options['hcode_menu_hover_delay'] ) && !empty( $hcode_options['hcode_menu_hover_delay'] ) ) ? $hcode_options['hcode_menu_hover_delay'] : '100';

    $hcode_enable_mini_header = hcode_option( 'hcode_enable_mini_header' );
    $hcode_enable_sticky_mini_header= hcode_option( 'hcode_enable_sticky_mini_header' );

    /* H-Code V1.8.6 */
    $hcode_non_sticky_menu = hcode_option( 'hcode_non_sticky_menu' );
    $hcode_non_sticky_class = ( $hcode_non_sticky_menu ) ? ' non-sticky-header ' : '';

    if( hcode_check_enable_mini_header() && $hcode_enable_sticky_mini_header != 1 && $hcode_header_layout != 'headertype8' ){
        $classes .= 'non-sticky-mini-header ';
    }

    /* H-Code V1.9.4 */
    $hcode_top_header_space = hcode_option_single( 'hcode_top_header_space' );
    if( $hcode_top_header_space == 1 && ( $menu_style == 'headertype1' || $menu_style == 'headertype3' || $menu_style == 'headertype4' || $menu_style == 'headertype10' ) ){
        $hcode_top_header .= 'hcode-nav-margin ';
    } elseif( is_home() && ( $menu_style == 'headertype1' || $menu_style == 'headertype3' || $menu_style == 'headertype4' || $menu_style == 'headertype10' ) ){
        $hcode_top_header .= 'hcode-nav-margin ';
    }
    $hcode_remove_top_header_space = hcode_option_single( 'hcode_remove_top_header_space' );
    if( $hcode_remove_top_header_space != 1 && ( $menu_style == 'headertype2' || $menu_style == 'headertype5' || $menu_style == 'headertype6' || $menu_style == 'headertype7' || $menu_style == 'headertype8' || $menu_style == 'headertype11' ) ){
        $hcode_remove_top_header .= ' hcode-nav-margin';
    }
    $header_logo_position = hcode_option( 'hcode_header_logo_position' );
    $hcode_header_full_width = hcode_option( 'hcode_header_full_width' );
    $hcode_header_menu_position = hcode_option( 'hcode_header_menu_position' );
    $nav_class = ( $hcode_header_full_width == 1 ) ? ' fluid-menu': '';
    $logo_class = ( $hcode_header_full_width == 1 ) ? ' header-logo': '';
    $container_class = ( $hcode_header_full_width == 1 ) ? 'container-fluid': 'container';
    $hcode_menu_position = ( $hcode_header_menu_position && $header_logo_position == 'left' ) ? ' '.$hcode_header_menu_position : '';
    $hcode_header_top_offset = ( isset( $hcode_options['hcode_header_top_offset'] ) && !empty( $hcode_options['hcode_header_top_offset'] ) ) ? ' data-offset='.$hcode_options['hcode_header_top_offset'] : ' data-offset=0';

    switch ( $hcode_header_layout ) {
        case 'headertype1':
                    $classes .= 'transparent-header nav-border-bottom '.$hcode_non_sticky_class.$hcode_top_header.$nav_class;
                    break;
        case 'headertype2':
                    $classes .= 'nav-dark shrink-nav-white '.$hcode_non_sticky_class.$nav_class.$hcode_remove_top_header;
                    break;
        case 'headertype3':
                    $classes .= 'nav-dark-transparent shrink-nav-white '.$hcode_non_sticky_class.$hcode_top_header.$nav_class;
                    break;
        case 'headertype4':
                    $classes .= 'nav-border-bottom nav-light-transparent '.$hcode_non_sticky_class.$hcode_top_header.$nav_class;
                    break;
        case 'headertype5':
                    $classes .= 'nav-border-bottom static-sticky '.$hcode_non_sticky_class.$nav_class.$hcode_remove_top_header;
                    break;
        case 'headertype6':
                    $classes .= 'white-header nav-border-bottom '.$hcode_non_sticky_class.$nav_class.$hcode_remove_top_header;
                    break;
        case 'headertype7':
                    $classes .= 'static-sticky-gray static-sticky '.$hcode_non_sticky_class.$nav_class.$hcode_remove_top_header;
                    break;
        case 'headertype8':
                    $classes .= 'non-sticky-header non-sticky '.$nav_class.$hcode_remove_top_header;
                    break;
        case 'headertype10':
                    $classes .= 'shrink-nav-white '.$hcode_non_sticky_class.$hcode_top_header;
                    break;
        case 'headertype11':
                    $classes .= $hcode_non_sticky_class.$hcode_remove_top_header;
                    break;
    }

    $menu_image = hcode_option('hcode_menu_image');
    if( is_array( $menu_image ) ){
        $menu_image =  $menu_image['url'];
    }

    $menu_logo = hcode_option('hcode_menu_logo');
    if( is_array( $menu_logo ) ){
        $menu_logo =  $menu_logo['url'];
    }

    $enable_menu_social_icons = hcode_option('hcode_enable_menu_social_icons');
    if( $enable_menu_social_icons == '' ) {
        $enable_menu_social_icons = ( isset( $hcode_options['hcode_enable_menu_social_icons'] ) ) ? $hcode_options['hcode_enable_menu_social_icons'] : '';
    }
    $menu_social_sidebar = hcode_option('hcode_menu_social_sidebar');
    if( $menu_social_sidebar == '' ) {
        $menu_social_sidebar = ( isset( $hcode_options['hcode_menu_social_sidebar'] ) ) ? $hcode_options['hcode_menu_social_sidebar'] : '';
    }
    $enable_menu_separator = hcode_option('hcode_enable_menu_separator');
    if( $enable_menu_separator == '' ) {
        $enable_menu_separator = ( isset( $hcode_options['hcode_enable_menu_separator'] ) ) ? $hcode_options['hcode_enable_menu_separator'] : '';
    }
    if( !( $menu_style == 'headertype9' || $menu_style == 'headertype10' || $menu_style == 'headertype11' ) ) {
        
        if( $header_logo_position == 'center' ) {
            $classes .= ' header-center-logo ';
            $header_logo_wrap_class = 'center-logo';
            if( $hcode_header_search != 1 && $hcode_header_cart != 1 ) {
                $header_menu_col_class  = 'center-logo-full-width';
            }

            if( $hcode_header_search == 1 || $hcode_header_cart == 1 ) {
                $classes .= ' center-logo-search-cart-full-width ';
            }
        } elseif( $header_logo_position == 'top' ) {
            $classes .= ' header-top-logo ';
            $header_logo_wrap_class = 'header-top-logo-center';
        }
    }

    // Logo html start
    ob_start();

    $retina_width = ( isset( $hcode_options['hcode_retina_logo_width'] ) && $hcode_options['hcode_retina_logo_width'] ) ? 'width:'.$hcode_options['hcode_retina_logo_width'].'; ' : '';
    $retina_height = ( isset( $hcode_options['hcode_retina_logo_height'] ) && $hcode_options['hcode_retina_logo_height'] ) ? 'max-height:'.$hcode_options['hcode_retina_logo_height'].';' : '';
    $r_style  = '';
    if( !empty( $hcode_header_logo ) || $retina ){
        echo '<a class="logo-light" href="'.home_url('/').'">';
            if( $hcode_header_logo ){
                echo '<img alt="'.$add_logo_alt_text.'" src="'.$hcode_header_logo.'" class="logo" data-no-lazy="1" />';
            }
            if( $retina ){
                if( $retina_width || $retina_height ){
                    $r_style = ' style="'.$retina_width.$retina_height.'"';
                }//add_retina_logo_alt_text
                echo '<img alt="'.$add_retina_logo_alt_text.'" src="'.$retina.'" class="retina-logo" data-no-lazy="1"'.$r_style.' />';
            }
        echo '</a>';
    } else {
        echo '<a href="'.home_url( '/' ).'" class="logo-light hcode-site-title" rel="home">';
            echo '<span class="logo">'.get_bloginfo('name').'</span>';
            echo '<span class="retina-logo">'.get_bloginfo('name').'</span>';
        echo '</a>';
    } 

    if( ( !empty( $hcode_header_light_logo ) || $retina_light ) && ( $menu_style != 'headertype9' ) ){
        
        $header_type= array('headertype5','headertype7');

        if( !in_array( $hcode_header_layout, $header_type ) ){ 
            echo '<a class="logo-dark" href="'.home_url('/').'">';
                if( $hcode_header_light_logo ){
                    echo '<img alt="'.$add_light_logo_alt_text.'" src="'.$hcode_header_light_logo.'" class="logo" data-no-lazy="1" />';
                }
                if( $retina_light ){
                    if( $retina_width || $retina_height ){
                        $r_style = ' style="'.$retina_width.$retina_height.'"';
                    }
                    echo '<img alt="'.$add_retina_light_logo_alt_text.'" src="'.$retina_light.'" class="retina-logo-light" data-no-lazy="1"'.$r_style.' />';
                }
            echo '</a>';
        } 
    } else {
        
        $header_type= array('headertype5','headertype7','headertype9');
        if( !in_array( $hcode_header_layout, $header_type ) ){ 
            echo '<a href="'.home_url( '/' ).'" class="logo-dark hcode-site-title" rel="home">';
                echo '<span class="logo">'.get_bloginfo('name').'</span>';
                echo '<span class="retina-logo">'.get_bloginfo('name').'</span>';
            echo '</a>';
        }
    }
    $logo_html = ob_get_clean();

    if( $menu_style == 'headertype9' ) {

        if( is_home() ) {
            $enable_title = hcode_option('hcode_enable_blog_title_wrapper');
            if( $enable_title == '1' ){
                $hcode_options = get_option( 'hcode_theme_setting' );
                $enable_title = ( isset( $hcode_options['hcode_enable_blog_title_wrapper'] ) ) ? $hcode_options['hcode_enable_blog_title_wrapper'] : '';
            }
        } else {
            $enable_title = hcode_option('hcode_enable_title_wrapper');
            if( $enable_title == '1' ){
                $hcode_options = get_option( 'hcode_theme_setting' );
                $enable_title = ( isset( $hcode_options['hcode_enable_title_wrapper'] ) ) ? $hcode_options['hcode_enable_title_wrapper'] : '';
            }
        }
            
        echo '<div class="navbar menu-wrap pull-menu default-hamburger-menu hamburger-menu1'.$hcode_header_text_color.'"'.$hcode_header_top_offset.'>';
            echo '<nav class="menu navigation-menu no-transition no-shrink-nav">';
                echo '<div class="hcode-header-logo navbar-header no-padding clearfix text-center xs-text-left">'.$logo_html.'</div>';
                echo '<div class="hcode-hamburger-menu">';
                    echo '<div class="no-padding" id="bs-example-navbar-collapse-1">';
                        $defaults = '';
                        if ( !empty( $header_menu ) ){
                            $defaults = array(
                                'menu'            => $header_menu,
                                'container'       => false,
                                'menu_class'      => 'nav navbar-default navbar-nav',
                                'menu_id'         => 'accordion',
                                'echo'            => true,
                                'fallback_cb'     => false,
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                'walker'          => new Hcode_Hamburger_Menu_Walker
                            );
                        } else {
                            $defaults = array(
                                'container'       => false,
                                'menu_class'      => 'nav navbar-default navbar-nav',
                                'menu_id'         => 'accordion',
                                'echo'            => true,
                                'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                            );
                        }

                        wp_nav_menu( $defaults );
                    echo '</div>';
                echo '</div>';
                if( $enable_menu_social_icons == 1 && is_active_sidebar( $menu_social_sidebar ) ) {
                    echo '<div class="col-md-12 no-padding clearfix">';
                        echo '<div class="footer-social no-margin-bottom no-margin-lr text-center">';
                            dynamic_sidebar( $menu_social_sidebar );
                        echo '</div>';
                    echo '</div>';
                }
            echo '</nav>';
            echo '<button class="close-button" id="close-button">'.esc_html( 'Close Menu', 'H-Code' ).'</button>';
        echo '</div>';
        if( $hcode_enable_menu == 1 ){
            echo '<button class="menu-button pull-menu-button" id="open-button">';
                echo '<span class="sr-only">'.esc_html( 'Open Menu', 'H-Code' ).'</span>';
                    echo '<span class="icon-bar"></span>';
                    echo '<span class="icon-bar"></span>';
                    echo '<span class="icon-bar"></span>';
            echo '</button>';
        }

    } elseif( $menu_style == 'headertype10' ) {
        if( $hcode_header_search == 1 || $hcode_header_cart == 1 ) {
            echo '<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav full-width-pull-menu default-hamburger-menu hamburger-menu2 hamburger-menu-with-search-and-cart '.$classes.$hcode_header_text_color.'"'.$hcode_header_top_offset.'>';
        } else {
            echo '<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav full-width-pull-menu default-hamburger-menu hamburger-menu2 '.$classes.$hcode_header_text_color.'"'.$hcode_header_top_offset.'>';
        }
            echo '<div class="nav-header-container '.$container_class.'">';
                echo '<div class="row">';
                    echo '<div class="hcode-header-logo">'.$logo_html.'</div>';
                    if( $hcode_enable_menu == 1 ){
                        echo '<div class="hcode-hamburger-menu no-transition">';
                            echo '<div class="menu-wrap pull-menu full-screen ">';
                                echo '<div class="pull-menu-open">';
                                    echo '<div class="pull-menu-open-sub">';
                                        echo '<div class="col-md-12">';
                                            $defaults = '';
                                            if ( !empty( $header_menu ) ){
                                                $defaults = array(
                                                    'menu'            => $header_menu,
                                                    'container'       => false,
                                                    'menu_class'      => 'nav navbar-nav panel-group',
                                                    'menu_id'         => 'accordion',
                                                    'echo'            => true,
                                                    'fallback_cb'     => false,
                                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                    'walker'          => new Hcode_Hamburger_Menu_Walker
                                                );
                                            } else {
                                                $defaults = array(
                                                    'container'       => false,
                                                    'menu_class'      => 'nav navbar-nav panel-group',
                                                    'menu_id'         => 'accordion',
                                                    'echo'            => true,
                                                    'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                );
                                            }

                                            wp_nav_menu( $defaults );
                                        echo '</div>';
                                        echo '<div class="col-md-12 text-center cover-background padding-five" style="background-image:url('.esc_url( $menu_image ).');">';
                                            if( !empty( $menu_logo ) ) {
                                                echo '<div>';
                                                    echo '<img src="'.esc_url( $menu_logo ).'" alt="'.get_bloginfo('name').'" />';
                                                echo '</div>';
                                            }
                                            if( $enable_menu_social_icons == 1 && is_active_sidebar( $menu_social_sidebar ) ) {
                                                echo '<div class="padding-two no-padding-bottom">';
                                                    dynamic_sidebar( $menu_social_sidebar );
                                                echo '</div>';
                                            }
                                        echo '</div>';
                                        echo '<button class="close-button" id="close-button">'.esc_html( 'Close Menu', 'H-Code' ).'</button>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            if( $hcode_header_search == 1 || $hcode_header_cart == 1 ){
                                echo '<div class="search-cart-header">';
                                    if( $hcode_header_cart == 1 && is_active_sidebar( $hcode_header_mini_cart ) ){
                                        echo '<div class="top-cart">';
                                            dynamic_sidebar( $hcode_header_mini_cart );
                                        echo '</div>';
                                    }

                                    if( $hcode_header_search == 1 ){
                                        echo '<div id="top-search">';
                                            echo '<a href="#search-header" class="header-search-form"><i class="fas fa-search"></i></a>';
                                        echo '</div>';
                                        echo '<form id="search-header" method="get" action="'.esc_url( home_url( '/' ) ).'" name="search-header" class="mfp-hide search-form-result">';
                                            echo '<div class="search-form position-relative">';
                                                echo '<button type="submit" class="fas fa-search close-search search-button black-text"></button>';
                                                echo '<input type="text" name="s" class="search-input" value="'.get_search_query().'" placeholder="'.$hcode_search_placeholder_text.'" autocomplete="off">';
                                            echo '</div>';
                                        echo '</form>';
                                    }
                                echo '</div>';
                            }
                            echo '<button type="button" class="navbar-toggle" id="open-button" data-toggle="collapse" data-target=".navbar-collapse">';
                                echo '<span class="sr-only">'.esc_html( 'Open Menu', 'H-Code' ).'</span>';
                                echo '<span class="icon-bar"></span>';
                                echo '<span class="icon-bar"></span>';
                                echo '<span class="icon-bar"></span>';
                            echo '</button>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</nav>';

    } elseif( $menu_style == 'headertype11' ) { 
        if( $hcode_header_search == 1 || $hcode_header_cart == 1 ) {
            echo '<nav class="navbar navbar-default nav-dark navbar-fixed-top nav-transparent overlay-nav sticky-nav full-width-pull-menu full-width-pull-menu-dark default-hamburger-menu hamburger-menu3 hamburger-menu-with-search-and-cart '.$classes.$hcode_header_text_color.'"'.$hcode_header_top_offset.'>';
        } else {
            echo '<nav class="navbar navbar-default nav-dark navbar-fixed-top nav-transparent overlay-nav sticky-nav full-width-pull-menu full-width-pull-menu-dark default-hamburger-menu hamburger-menu3 '.$classes.$hcode_header_text_color.'"'.$hcode_header_top_offset.'>';            
        }
            echo '<div class="nav-header-container '.$container_class.'">';
                echo '<div class="row">';
                    echo '<div class="hcode-header-logo">'.$logo_html.'</div>';
                    
                    if( $hcode_enable_menu == 1 ){
                        echo '<div class="hcode-hamburger-menu no-transition">';
                            echo '<div class="menu-wrap full-screen no-padding">';
                                if( $menu_image ){
                                    echo '<div class="col-md-6 col-sm-6 full-screen no-padding cover-background xs-display-none" style="background-image:url('.esc_url( $menu_image ).');"></div>';
                                }
                                echo '<div class="col-md-6 col-sm-6 full-screen bg-white bg-hamburger-menu3">';
                                    echo '<div class="pull-menu full-screen ">';
                                        echo '<div class="pull-menu-open">';
                                            echo '<div class="pull-menu-open-sub">';
                                                $defaults = '';
                                                if ( !empty( $header_menu ) ){
                                                    $defaults = array(
                                                        'menu'            => $header_menu,
                                                        'container'       => false,
                                                        'menu_class'      => 'nav navbar-nav panel-group no-padding',
                                                        'menu_id'         => 'accordion',
                                                        'echo'            => true,
                                                        'fallback_cb'     => false,
                                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                        'walker'          => new Hcode_Hamburger_Menu_Walker
                                                    );
                                                } else {
                                                    $defaults = array(
                                                        'container'       => false,
                                                        'menu_class'      => 'nav navbar-nav panel-group no-padding',
                                                        'menu_id'         => 'accordion',
                                                        'echo'            => true,
                                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                                    );
                                                }

                                                wp_nav_menu( $defaults );

                                                if( $enable_menu_separator == 1 ) {
                                                    echo '<div class="separator-line-thick bg-black margin-three pull-left margin-five"></div>';
                                                }

                                                if( $enable_menu_social_icons == 1 && is_active_sidebar( $menu_social_sidebar ) ) {
                                                    echo '<div class="col-md-12 col-sm-12 col-xs-12 no-padding">';
                                                        dynamic_sidebar( $menu_social_sidebar );
                                                    echo '</div>';
                                                }
                                            echo '</div>';
                                        echo '</div>';
                                        echo '<button class="close-button" id="close-button">'.esc_html( 'Close Menu', 'H-Code' ).'</button>';
                                    echo '</div>';
                                echo '</div>';
                            echo '</div>';
                            if( $hcode_header_search == 1 || $hcode_header_cart == 1 ){
                                echo '<div class="search-cart-header">';
                                    if( $hcode_header_cart == 1 && is_active_sidebar( $hcode_header_mini_cart ) ){
                                        echo '<div class="top-cart">';
                                            dynamic_sidebar( $hcode_header_mini_cart );
                                        echo '</div>';
                                    }

                                    if( $hcode_header_search == 1 ){
                                        echo '<div id="top-search">';
                                            echo '<a href="#search-header" class="header-search-form"><i class="fas fa-search"></i></a>';
                                        echo '</div>';
                                        echo '<form id="search-header" method="get" action="'.esc_url( home_url( '/' ) ).'" name="search-header" class="mfp-hide search-form-result">';
                                            echo '<div class="search-form position-relative">';
                                                echo '<button type="submit" class="fas fa-search close-search search-button black-text"></button>';
                                                echo '<input type="text" name="s" class="search-input" value="'.get_search_query().'" placeholder="'.$hcode_search_placeholder_text.'" autocomplete="off">';
                                            echo '</div>';
                                        echo '</form>';
                                    }
                                echo '</div>';
                            }
                            echo '<button type="button" class="menu-button-orange navbar-toggle" id="open-button" data-toggle="collapse" data-target=".navbar-collapse">';
                                echo '<span class="sr-only">'.esc_html( 'Open Menu', 'H-Code' ).'</span>';
                                echo '<span class="icon-bar"></span>';
                                echo '<span class="icon-bar"></span>';
                                echo '<span class="icon-bar"></span>';
                            echo '</button>';
                        echo '</div>';
                    }
                echo '</div>';
            echo '</div>';
        echo '</nav>';
    } else {

        echo '<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav '. $classes.$hcode_header_text_color." ".$enable_sticky.'" data-menu-hover-delay="'.$hcode_menu_hover_delay.'"'.$hcode_header_top_offset.'>';
            echo '<div class="nav-header-container '.$container_class.'">';
                echo '<div class="row">';
                    $header_container_class = $header_container_id = $header_container = '';
                    if( $header_logo_position == 'center' ){
                        echo '<div class="hcode-center-logo-menu">';
                    }else{
                        $header_container_class = 'navbar-collapse collapse';
                        $header_container_id = 'mega-menu';
                        $header_container = 'div';
                    }
                        echo '<div class="hcode-header-logo '.$header_logo_wrap_class.$logo_class.'">'.$logo_html.'</div>';

                        echo '<div class="'.$header_menu_col_class.$hcode_menu_position.' accordion-menu">';
                            if( $hcode_enable_menu == 1 ){
                                echo '<div class="navbar-header">';
                                    echo '<button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">';
                                        echo '<span class="sr-only">'.esc_html( 'Toggle navigation', 'H-Code' ).'</span>';
                                        echo '<span class="icon-bar"></span>';
                                        echo '<span class="icon-bar"></span>';
                                        echo '<span class="icon-bar"></span>';
                                    echo '</button>';
                                echo '</div>';
                                if( $header_logo_position == 'center' ){
                                    echo '<div id="mega-menu" class="navbar-collapse collapse">';
                                }
                                $defaults = '';
                                if ( !empty( $header_menu ) ){
                                    $defaults = array(
                                        'menu'            => $header_menu,
                                        'container'       => $header_container,
                                        'container_class' => $header_container_class,
                                        'container_id'    => $header_container_id,
                                        'menu_class'      => 'mega-menu-ul nav navbar-nav',
                                        'menu_id'         => '',
                                        'echo'            => true,
                                        'fallback_cb'     => false,
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'walker'          => new Hcode_Mega_Menu_Walker
                                    );
                                }elseif( has_nav_menu('hcodemegamenu') ){
                                    $defaults = array(
                                        'theme_location'  => 'hcodemegamenu',
                                        'container'       => $header_container,
                                        'container_class' => $header_container_class,
                                        'container_id'    => $header_container_id,
                                        'menu_class'      => 'mega-menu-ul nav navbar-nav',
                                        'menu_id'         => '',
                                        'echo'            => true,
                                        'fallback_cb'     => false,
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'walker'          => new Hcode_Mega_Menu_Walker
                                    );
                                } else {
                                    $defaults = array(
                                        'container'       => $header_container,
                                        'container_class' => $header_container_class,
                                        'container_id'    => $header_container_id,
                                        'menu_class'      => 'mega-menu-ul nav navbar-nav default-menu-wrapper',
                                        'menu_id'         => '',
                                        'echo'            => true,
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                    );
                                }

                                wp_nav_menu( $defaults );

                                if ( $header_logo_position == 'center' && !empty( $header_secondary_menu ) ){

                                    $secondary_defaults = array(
                                        'menu'            => $header_secondary_menu,
                                        'container'       => $header_container,
                                        'container_class' => $header_container_class,
                                        'container_id'    => $header_container_id,
                                        'menu_class'      => 'mega-menu-ul nav navbar-nav',
                                        'menu_id'         => '',
                                        'echo'            => true,
                                        'fallback_cb'     => false,
                                        'items_wrap'      => '<ul id="%1$s" class="%2$s">%3$s</ul>',
                                        'walker'          => new Hcode_Second_Mega_Menu_Walker
                                    );

                                    wp_nav_menu( $secondary_defaults );

                                }
                                if( $header_logo_position == 'center' ){
                                    echo '</div>';
                                }
                            }
                        echo '</div>';

                    if( $header_logo_position == 'center' ){
                        echo '</div>';
                    }
                    
                    if( $hcode_header_search == 1 || $hcode_header_cart == 1 ){
                        echo '<div class="search-cart-header">';
                            if( $hcode_header_cart == 1 && is_active_sidebar( $hcode_header_mini_cart ) ){
                                echo '<div class="top-cart">';
                                    dynamic_sidebar( $hcode_header_mini_cart );
                                echo '</div>';
                            }

                            if( $hcode_header_search == 1 ){
                                echo '<div id="top-search">';
                                    echo '<a href="#search-header" class="header-search-form"><i class="fas fa-search"></i></a>';
                                echo '</div>';
                                echo '<form id="search-header" method="get" action="'.esc_url( home_url( '/' ) ).'" name="search-header" class="mfp-hide search-form-result">';
                                    echo '<div class="search-form position-relative">';
                                        echo '<button type="submit" class="fas fa-search close-search search-button black-text"></button>';
                                        echo '<input type="text" name="s" class="search-input" value="'.get_search_query().'" placeholder="'.$hcode_search_placeholder_text.'" autocomplete="off">';
                                    echo '</div>';
                                echo '</form>';
                            }
                        echo '</div>';
                    }
                    
                echo '</div>';
            echo '</div>';
        echo '</nav>';
    }
}
if( hcode_check_enable_mini_header() ) {
    echo '</header>';
}