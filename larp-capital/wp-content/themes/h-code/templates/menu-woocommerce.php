<?php
/**
 * displaying woocommerce category page menu sections
 *
 * @package H-Code
 */
?>
<?php
    $hcode_header_text_color = $output = $classes = $enable_sticky = $hcode_menu_hover_delay = $hcode_top_header = $hcode_remove_top_header = $header_menu_col_class = $header_logo_wrap_class = '';

    $hcode_options = get_option( 'hcode_theme_setting' );
    
    $hcode_enable_header = ( isset( $hcode_options['hcode_enable_header_woocommerce'] ) ) ? $hcode_options['hcode_enable_header_woocommerce'] : '';

    $hcode_header_layout_global = !empty( $hcode_options['hcode_header_layout'] ) ? $hcode_options['hcode_header_layout'] : '';
    $hcode_header_layout_woocommerce = (isset( $hcode_options['hcode_header_layout_woocommerce'] ) && !empty( $hcode_options['hcode_header_layout_woocommerce'] ) ) ? $hcode_options['hcode_header_layout_woocommerce'] : $hcode_header_layout_global;

if( hcode_check_enable_mini_header() ) { 
    $hcode_enable_mini_header_sidebar   = hcode_option( 'hcode_enable_mini_header_sidebar' );
    $hcode_enable_sticky_mini_header    = hcode_option( 'hcode_enable_sticky_mini_header' );
    $hcode_enable_mini_header_mobile    = hcode_option( 'hcode_enable_mini_header_mobile' );

    $sticky_header_class = empty( $hcode_enable_sticky_mini_header ) ? 'no-sticky-mini-header ' : 'sticky-mini-header ';
    $mini_header_mobile_class   = $hcode_enable_mini_header_mobile == 1 ? 'mini-header-mobile ' : '';

    echo '<header class="'.$sticky_header_class.$mini_header_mobile_class.$hcode_header_layout_woocommerce.'">';
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

if( $hcode_enable_header == 1 ){
        
    $hcode_header_layout = ( is_404() ) ? $hcode_options['404_header_type'] :$hcode_header_layout_woocommerce;

    /* Get Alt Text For Header Logo */
    $hcode_header_logo_woocommerce = hcode_option( 'hcode_header_logo_woocommerce' );
    $get_general_logo_alt_text = $add_general_logo_alt_text = '';
    if( isset( $hcode_header_logo_woocommerce['id'] ) ) {
        $get_general_logo_alt_text = get_post_meta( $hcode_header_logo_woocommerce["id"], '_wp_attachment_image_alt', true );
        $add_general_logo_alt_text = $get_general_logo_alt_text ? $get_general_logo_alt_text : get_bloginfo( 'name' );
    }

    /* Get Alt Text For Header Light Logo */
    $hcode_header_light_logo_woocommerce = hcode_option( 'hcode_header_light_logo_woocommerce' );
    $get_header_light_logo_alt_text = $add_header_light_logo_alt_text = '';
    if( isset( $hcode_header_light_logo_woocommerce['id'] ) ) {
        $get_header_light_logo_alt_text = get_post_meta( $hcode_header_light_logo_woocommerce["id"], '_wp_attachment_image_alt', true );
        $add_header_light_logo_alt_text = $get_header_light_logo_alt_text ? $get_header_light_logo_alt_text : get_bloginfo( 'name' );
    }

    /* Get Alt Text For Header Retina Logo */
    $hcode_retina_logo_woocommerce = hcode_option( 'hcode_retina_logo_woocommerce' );
    $get_retina_logo_alt_text = $add_retina_logo_alt_text = '';
    if( isset( $hcode_retina_logo_woocommerce['id'] ) ) {
        $get_retina_logo_alt_text = get_post_meta( $hcode_retina_logo_woocommerce["id"], '_wp_attachment_image_alt', true );
        $add_retina_logo_alt_text = $get_retina_logo_alt_text ? $get_retina_logo_alt_text : get_bloginfo( 'name' );
    }

    /* Get Alt Text For Header Retina Logo */
    $hcode_retina_logo_light_woocommerce = hcode_option( 'hcode_retina_logo_light_woocommerce' );
    $get_retina_light_logo_alt_text = $add_retina_light_logo_alt_text = '';
    if( isset( $hcode_retina_logo_light_woocommerce['id'] ) ) {
        $get_retina_light_logo_alt_text = get_post_meta( $hcode_retina_logo_light_woocommerce["id"], '_wp_attachment_image_alt', true );
        $add_retina_light_logo_alt_text = $get_retina_light_logo_alt_text ? $get_retina_light_logo_alt_text : get_bloginfo( 'name' );
    }

    $hcode_header_logo_global = !empty( $hcode_options['hcode_header_logo']['url'] ) ? $hcode_options['hcode_header_logo']['url'] : '';
    $hcode_enable_menu = ( isset( $hcode_options['hcode_enable_menu'] ) && !empty( $hcode_options['hcode_enable_menu'] ) ) ? $hcode_options['hcode_enable_menu'] : '';
    $hcode_header_logo = ( isset( $hcode_options['hcode_header_logo_woocommerce']['url'] ) && !empty( $hcode_options['hcode_header_logo_woocommerce']['url'] ) ) ? $hcode_options['hcode_header_logo_woocommerce']['url'] : $hcode_header_logo_global;

    $hcode_header_light_logo_global = !empty( $hcode_options['hcode_header_light_logo']['url'] ) ? $hcode_options['hcode_header_light_logo']['url'] : '';
    $hcode_header_light_logo = ( isset( $hcode_options['hcode_header_light_logo_woocommerce']['url'] ) && !empty( $hcode_options['hcode_header_light_logo_woocommerce']['url'] ) ) ? $hcode_options['hcode_header_light_logo_woocommerce']['url'] : $hcode_header_light_logo_global;

    $header_menu_global = !empty( $hcode_options['hcode_header_menu'] ) ? $hcode_options['hcode_header_menu'] : '';
    $header_menu = ( isset( $hcode_options['hcode_header_menu_woocommerce'] ) && !empty( $hcode_options['hcode_header_menu_woocommerce'] ) ) ? $hcode_options['hcode_header_menu_woocommerce'] : $header_menu_global;
    
    $header_secondary_menu_global = !empty( $hcode_options['hcode_header_secondary_menu'] ) ? $hcode_options['hcode_header_secondary_menu'] : '';
    $header_secondary_menu = ( isset( $hcode_options['hcode_header_secondary_menu_woocommerce'] ) && !empty( $hcode_options['hcode_header_secondary_menu_woocommerce'] ) ) ? $hcode_options['hcode_header_secondary_menu_woocommerce'] : $header_secondary_menu_global;

    $hcode_header_text_color_global = !empty( $hcode_options['hcode_header_text_color'] ) ? ' '.$hcode_options['hcode_header_text_color'] : '';
    $hcode_header_text_color = ( isset( $hcode_options['hcode_header_text_color_woocommerce'] ) && !empty( $hcode_options['hcode_header_text_color_woocommerce'] ) ) ? ' '.$hcode_options['hcode_header_text_color_woocommerce'] : ' '.$hcode_header_text_color_global;

    $hcode_header_search = ( isset( $hcode_options['hcode_header_search_woocommerce'] ) ) ? $hcode_options['hcode_header_search_woocommerce'] : '';
    $hcode_header_cart = ( isset( $hcode_options['hcode_header_cart_woocommerce'] ) ) ? $hcode_options['hcode_header_cart_woocommerce'] : '';
    if( isset( $hcode_options['hcode_header_mini_cart_woocommerce'] ) ){
        $hcode_header_mini_cart_woocommerce = ( isset( $hcode_options['hcode_header_mini_cart_woocommerce'] ) && !empty( $hcode_options['hcode_header_mini_cart_woocommerce'] ) ) ? $hcode_options['hcode_header_mini_cart_woocommerce'] : $hcode_options['hcode_header_mini_cart'];
    }else{
        $hcode_header_mini_cart_woocommerce = 'hcode-mini-cart';
    }

    $hcode_search_placeholder_text = ( isset( $hcode_options['hcode_search_placeholder_text'] ) && !empty( $hcode_options['hcode_search_placeholder_text'] ) ) ? $hcode_options['hcode_search_placeholder_text'] : '';

    $retina_global = !empty( $hcode_options['hcode_retina_logo']['url'] ) ? $hcode_options['hcode_retina_logo']['url'] : '';
    $retina = ( isset( $hcode_options['hcode_retina_logo_woocommerce']['url'] ) && !empty( $hcode_options['hcode_retina_logo_woocommerce']['url'] ) ) ? $hcode_options['hcode_retina_logo_woocommerce']['url'] : $retina_global;

    $retina_light_global = !empty( $hcode_options['hcode_retina_logo_light']['url'] ) ? $hcode_options['hcode_retina_logo_light']['url'] : '';
    $retina_light = ( isset( $hcode_options['hcode_retina_logo_light_woocommerce']['url'] ) && !empty( $hcode_options['hcode_retina_logo_light_woocommerce']['url'] ) ) ? $hcode_options['hcode_retina_logo_light_woocommerce']['url'] : $retina_light_global;

    $retina_width_global = ( isset( $hcode_options['hcode_retina_logo_width'] ) && !empty( $hcode_options['hcode_retina_logo_width'] ) ) ? 'width:'.$hcode_options['hcode_retina_logo_width'].';' : '';
    $retina_width = ( isset( $hcode_options['hcode_retina_logo_width_woocommerce'] ) && !empty( $hcode_options['hcode_retina_logo_width_woocommerce'] ) ) ? 'width:'.$hcode_options['hcode_retina_logo_width_woocommerce'].'; ' : $retina_width_global;

    $retina_height_global = ( isset( $hcode_options['hcode_retina_logo_height'] ) && !empty( $hcode_options['hcode_retina_logo_height'] ) ) ? 'max-height:'.$hcode_options['hcode_retina_logo_height'].';' : '';
    $retina_height = ( isset( $hcode_options['hcode_retina_logo_height_woocommerce'] ) && !empty( $hcode_options['hcode_retina_logo_height_woocommerce'] ) ) ? 'max-height:'.$hcode_options['hcode_retina_logo_height_woocommerce'].';' : $retina_height_global;
    $r_style  = '';

    /* H-Code V1.8 */
    $hcode_menu_hover_delay = ( isset( $hcode_options['hcode_menu_hover_delay'] ) && !empty( $hcode_options['hcode_menu_hover_delay'] ) ) ? $hcode_options['hcode_menu_hover_delay'] : '100';
    
    $hcode_enable_mini_header = hcode_option( 'hcode_enable_mini_header' );
    $hcode_enable_sticky_mini_header= hcode_option( 'hcode_enable_sticky_mini_header' );

    /* H-Code V1.8.6 */
    $hcode_non_sticky_menu = !empty( $hcode_options['hcode_non_sticky_menu_woocommerce'] ) ? $hcode_options['hcode_non_sticky_menu_woocommerce'] : '';
    $hcode_non_sticky_class = ( $hcode_non_sticky_menu ) ? 'non-sticky-header ' : '';

    if( hcode_check_enable_mini_header() && $hcode_enable_sticky_mini_header != 1 && $hcode_header_layout != 'headertype8' ){
        $classes .= 'non-sticky-mini-header ';
    }

    /* H-Code V1.9.4 */
    $hcode_top_header_space = ( isset( $hcode_options['hcode_top_header_space_woocommerce'] ) && !empty( $hcode_options['hcode_top_header_space_woocommerce'] ) ) ? $hcode_options['hcode_top_header_space_woocommerce'] : '';
    
    if( $hcode_top_header_space == 1 && ( $hcode_header_layout == 'headertype1' || $hcode_header_layout == 'headertype3' || $hcode_header_layout == 'headertype4' || $hcode_header_layout == 'headertype10' ) ){
        $hcode_top_header .= 'hcode-nav-margin ';
    }

    $hcode_remove_top_header_space = !empty( $hcode_options['hcode_remove_top_header_space_woocommerce'] ) ? $hcode_options['hcode_remove_top_header_space_woocommerce'] : '';
    if( $hcode_remove_top_header_space != 1 && ( $hcode_header_layout == 'headertype2' || $hcode_header_layout == 'headertype5' || $hcode_header_layout == 'headertype6' || $hcode_header_layout == 'headertype7' || $hcode_header_layout == 'headertype8' || $hcode_header_layout == 'headertype11' ) ){
        $hcode_remove_top_header .= ' hcode-nav-margin';
    }

    $hcode_header_logo_position_global = !empty( $hcode_options['hcode_header_logo_position'] ) ? $hcode_options['hcode_header_logo_position'] : '';
    $header_logo_position = isset( $hcode_options['hcode_header_logo_position_woocommerce'] ) && !empty( $hcode_options['hcode_header_logo_position_woocommerce'] ) ? $hcode_options['hcode_header_logo_position_woocommerce'] : $hcode_header_logo_position_global;
    
    $hcode_header_full_width = !empty( $hcode_options['hcode_header_full_width_woocommerce'] ) ? $hcode_options['hcode_header_full_width_woocommerce'] : '';
    $hcode_header_menu_position = !empty( $hcode_options['hcode_header_menu_position_woocommerce'] ) ? $hcode_options['hcode_header_menu_position_woocommerce'] : '';
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
                    $classes .= 'static-sticky-gray '.$hcode_non_sticky_class.$nav_class.$hcode_remove_top_header;
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

    $menu_image_global = !empty( $hcode_options['hcode_menu_image'] ) ? $hcode_options['hcode_menu_image'] : '';
    $menu_image = ( isset( $hcode_options['hcode_menu_image_woocommerce'] ) && !empty( $hcode_options['hcode_menu_image_woocommerce'] ) ) ? $hcode_options['hcode_menu_image_woocommerce'] : $menu_image_global;
    if( is_array( $menu_image ) ){
        $menu_image =  $menu_image['url'];
    }

    $menu_logo_global = !empty( $hcode_options['hcode_menu_logo'] ) ? $hcode_options['hcode_menu_logo'] : '';
    $menu_logo = ( isset( $hcode_options['hcode_menu_logo_woocommerce'] ) && !empty( $hcode_options['hcode_menu_logo_woocommerce'] ) ) ? $hcode_options['hcode_menu_logo_woocommerce'] : $menu_logo_global;
    if( is_array( $menu_logo ) ){
        $menu_logo =  $menu_logo['url'];
    }

    $hcode_enable_menu_social_icons_global = !empty( $hcode_options['hcode_enable_menu_social_icons'] ) ? $hcode_options['hcode_enable_menu_social_icons'] : '';
    $enable_menu_social_icons = ( isset( $hcode_options['hcode_enable_menu_social_icons_woocommerce'] ) && !empty( $hcode_options['hcode_enable_menu_social_icons_woocommerce'] ) ) ? $hcode_options['hcode_enable_menu_social_icons_woocommerce'] : $hcode_enable_menu_social_icons_global;

    $hcode_menu_social_sidebar_global = !empty( $hcode_options['hcode_menu_social_sidebar'] ) ? $hcode_options['hcode_menu_social_sidebar'] : '';
    $menu_social_sidebar = ( isset( $hcode_options['hcode_menu_social_sidebar_woocommerce'] ) && !empty( $hcode_options['hcode_menu_social_sidebar_woocommerce'] ) ) ? $hcode_options['hcode_menu_social_sidebar_woocommerce'] : $hcode_menu_social_sidebar_global;

    $hcode_enable_menu_separator_global = !empty( $hcode_options['hcode_enable_menu_separator'] ) ? $hcode_options['hcode_enable_menu_separator'] : '';
    $enable_menu_separator = ( isset( $hcode_options['hcode_enable_menu_separator_woocommerce'] ) && !empty( $hcode_options['hcode_enable_menu_separator_woocommerce'] ) ) ? $hcode_options['hcode_enable_menu_separator_woocommerce'] : $hcode_enable_menu_separator_global;

    if( !( $hcode_header_layout == 'headertype9' || $hcode_header_layout == 'headertype10' || $hcode_header_layout == 'headertype11' ) ) {

        if( $header_logo_position == 'center' ) {
            $classes .= ' header-center-logo ';
            $header_logo_wrap_class = 'center-logo';
            if( $hcode_header_search != 1  && $hcode_header_cart != 1 ) {
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

ob_start();
if( !empty( $hcode_header_logo ) || $retina ) {
    echo '<a class="logo-light" href="'.home_url('/').'">';
        if( $hcode_header_logo ){
            echo '<img alt="'.$add_general_logo_alt_text.'" src="'.$hcode_header_logo.'" class="logo" data-no-lazy="1" />';
        }
        if( $retina ){
            if( $retina_width || $retina_height ){
                $r_style = ' style="'.$retina_width.$retina_height.'"';
            }
            echo '<img alt="'.$add_retina_logo_alt_text.'" src="'.$retina.'" class="retina-logo" data-no-lazy="1"'.$r_style.' />';
        }
    echo '</a>';
} else {
    echo '<a href="'.home_url( '/' ).'" class="logo-light hcode-site-title" rel="home">';
        echo '<span class="logo">'.get_bloginfo('name').'</span>';
        echo '<span class="retina-logo">'.get_bloginfo('name').'</span>';
    echo '</a>';
}    
if( !empty( $hcode_header_light_logo ) && ( $hcode_header_layout != 'headertype9' ) ){
    $header_type= array('headertype5','headertype7');
    if( !in_array( $hcode_header_layout, $header_type ) ){ 
        echo '<a class="logo-dark" href="'.home_url('/').'">';
            if( $hcode_header_light_logo ){
                echo '<img alt="'.$add_header_light_logo_alt_text.'" src="'.$hcode_header_light_logo.'" class="logo" data-no-lazy="1" />';
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

    if( $hcode_header_layout == 'headertype9' ) {

        $enable_title = hcode_option('enable_wc_category_title_wrapper');
        if( $enable_title == '1' ){
            $hcode_options = get_option( 'hcode_theme_setting' );
            $enable_title = ( isset( $hcode_options['enable_wc_category_title_wrapper'] ) ) ? $hcode_options['enable_wc_category_title_wrapper'] : '';
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
            echo '<button class="menu-button" id="open-button">';
                echo '<span class="sr-only">'.esc_html( 'Open Menu', 'H-Code' ).'</span>';
                    echo '<span class="icon-bar"></span>';
                    echo '<span class="icon-bar"></span>';
                    echo '<span class="icon-bar"></span>';
            echo '</button>';
        }

    } elseif( $hcode_header_layout == 'headertype10' ) {

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
                            echo '<div class="menu-wrap pull-menu full-screen">';
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
                                    if( $hcode_header_cart == 1 && is_active_sidebar( $hcode_header_mini_cart_woocommerce ) ){
                                        echo '<div class="top-cart">';
                                            dynamic_sidebar( $hcode_header_mini_cart_woocommerce );
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

    } elseif( $hcode_header_layout == 'headertype11' ) {

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
                                    echo '<div class="pull-menu full-screen">';
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
                                    if( $hcode_header_cart == 1 && is_active_sidebar( $hcode_header_mini_cart_woocommerce ) ){
                                        echo '<div class="top-cart">';
                                            dynamic_sidebar( $hcode_header_mini_cart_woocommerce );
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

        echo '<nav class="navbar navbar-default navbar-fixed-top nav-transparent overlay-nav sticky-nav '.$classes.$hcode_header_text_color." ".$enable_sticky.'" data-menu-hover-delay="'.$hcode_menu_hover_delay.'"'.$hcode_header_top_offset.'>';
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

                                $defaults = '';
                                
                                if( $header_logo_position == 'center' ){
                                    echo '<div id="mega-menu" class="navbar-collapse collapse">';
                                }
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
                                } elseif( has_nav_menu('hcodemegamenu') ) {
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
                            if( $hcode_header_cart == 1 && $hcode_header_mini_cart_woocommerce ){
                                echo '<div class="top-cart">';
                                    dynamic_sidebar( $hcode_header_mini_cart_woocommerce );
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