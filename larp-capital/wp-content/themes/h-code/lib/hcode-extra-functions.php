<?php
/**
 * H-Code Theme Extra Function.
 *
 * @package H-Code
 */
?>
<?php
if ( ! function_exists( 'hcode_set_header' ) ) {
    function hcode_set_header( $id ){
        if( get_post_type( $id ) == 'portfolio' && is_singular('portfolio') ){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }
        
        if($enable_ajax == 'yes'){
            remove_all_actions('wp_head');
        }
    }
}

if ( ! function_exists( 'hcode_set_footer' ) ) {
    function hcode_set_footer( $id ){
        if(get_post_type( $id ) == 'portfolio' && is_singular('portfolio')){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }

        if($enable_ajax == 'yes'){
            remove_all_actions('wp_footer');
            add_action( 'wp_footer','hcode_hook_for_ajax_page' );
            add_action( 'wp_footer', 'hcode_addons_generate_custom_css' );
        }
    }
}

if ( ! function_exists( 'hcode_add_ajax_page_div_header' ) ) {
    function hcode_add_ajax_page_div_header( $id ){
        if( get_post_type( $id ) == 'portfolio' && is_singular('portfolio') ){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }
        
        if($enable_ajax == 'yes'){
            echo '<div class="bg-white">';
        }
    }
}

if ( ! function_exists( 'hcode_add_ajax_page_div_footer' ) ) {
    function hcode_add_ajax_page_div_footer( $id ){
        if(get_post_type( $id ) == 'portfolio' && is_singular('portfolio')){
            $enable_ajax = get_post_meta($id,'hcode_enable_ajax_popup_single',true);
        }else{
            $enable_ajax = '';
        }

        if($enable_ajax == 'yes'){
            echo '</div>';
        }
    }
}

if ( ! function_exists( 'hcode_post_meta' ) ) {
    function hcode_post_meta( $option ){
        global $post;
        $value = get_post_meta( $post->ID, $option.'_single', true);
        return $value;
    }
}

if ( ! function_exists( 'hcode_option' ) ) {
    function hcode_option( $option ){
        global $hcode_theme_settings, $post;
        $hcode_single = false;
        if(is_singular()){
            $value = get_post_meta( $post->ID, $option.'_single', true);
            $hcode_single = true;
        }

        if($hcode_single == true){
            if (is_string($value) && (strlen($value) > 0 || is_array($value)) && ($value != 'default' && $value != 'Select Sidebar')  ) {
                return $value;
            }
        }
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            return $option_value;
        }
        return false;
    }
}

if ( ! function_exists( 'hcode_option_post' ) ) {
    function hcode_option_post( $option ){
        global $hcode_theme_settings, $post;
        $option_post = '';
        $hcode_single = false;

        if(is_singular()){
            $value = get_post_meta( $post->ID, $option.'_single', true);
            $hcode_single = true;
        }

        if($hcode_single == true){
            if (is_string($value) && (strlen($value) > 0 || is_array($value)) && ($value != 'default' && $value != 'Select Sidebar')  ) {
                return $value;
            }
        }
        $option_post = $option.'_post';
        if(isset($hcode_theme_settings[$option_post]) && $hcode_theme_settings[$option_post] != ''){
            $option_value = $hcode_theme_settings[$option_post];
            return $option_value;
        }
        return false;
    }
}

if ( ! function_exists( 'hcode_option_portfolio' ) ) {
    function hcode_option_portfolio( $option ){
        global $hcode_theme_settings, $post;
        $option_post = '';
        $hcode_single = false;

        if(is_singular()){
            $value = get_post_meta( $post->ID, $option.'_single', true);
            $hcode_single = true;
        }

        if($hcode_single == true){
            if (is_string($value) && (strlen($value) > 0 || is_array($value)) && ($value != 'default' && $value != 'Select Sidebar')  ) {
                return $value;
            }
        }
        $option_post = $option.'_portfolio';
        if(isset($hcode_theme_settings[$option_post]) && $hcode_theme_settings[$option_post] != ''){
            $option_value = $hcode_theme_settings[$option_post];
            return $option_value;
        }
        return false;
    }
}

if ( ! function_exists( 'hcode_option_single' ) ) {
    function hcode_option_single( $option ){
        global $hcode_theme_settings, $post;
        $hcode_single = false;
        if(is_singular()){
            $value = get_post_meta( $post->ID, $option.'_single', true);
            $hcode_single = true;
        }

        if($hcode_single == true){
            if (is_string($value) && (strlen($value) > 0 || is_array($value)) && ($value != 'default' && $value != 'Select Sidebar')  ) {
                return $value;
            }
        }
        if( isset( $hcode_theme_settings[$option.'_all'] ) && $hcode_theme_settings[$option.'_all'] != '' && !empty( $hcode_theme_settings[$option.'_all'] ) ){
            $option_value = $hcode_theme_settings[$option.'_all'];
            return $option_value;
        }
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            return $option_value;
        }
        return false;
    }
}

/* Filter For the_post_thumbnail function attributes */
if( ! function_exists( 'hcode_filter_the_post_thumbnail_atts' ) ) :
    function hcode_filter_the_post_thumbnail_atts( $atts, $attachment ) {

        global $hcode_theme_settings;

        if( isset( $hcode_theme_settings['enable_image_alt'] ) && $hcode_theme_settings['enable_image_alt'] != '' ) {
            if( $hcode_theme_settings['enable_image_alt'] == '1' ) {
                $hcode_image_alt_text = get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true );
                $atts['alt'] = $hcode_image_alt_text;
            } else {
                $atts['alt'] = '';
            }
        }

        if( isset( $hcode_theme_settings['enable_image_title'] ) && $hcode_theme_settings['enable_image_title'] != '' ) {
            if( $hcode_theme_settings['enable_image_title'] == 1 && $attachment->post_title ){
                $atts['title'] = esc_attr( $attachment->post_title );
            }
        }
        return $atts;
    }
endif;
add_filter( 'wp_get_attachment_image_attributes', 'hcode_filter_the_post_thumbnail_atts', 10, 2 );

/* For Image Alt Text */
if ( ! function_exists( 'hcode_option_image_alt' ) ) {
    function hcode_option_image_alt( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_image_alt';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );

            if( !empty( $attachment->ID ) ) {
                $img_info = array(
                    'alt' => get_post_meta( $attachment->ID, '_wp_attachment_image_alt', true ),
                );
                if($option_value == '1'){
                    return $img_info;
                }
            }
        }
        return;
    }
}

/* For Image Title */
if ( ! function_exists( 'hcode_option_image_title' ) ) {
    function hcode_option_image_title( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_image_title';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );
            $img_info = array(
                'title' => $attachment->post_title
            );
            if($option_value == '1'){
                return $img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Image Caption */
if ( ! function_exists( 'hcode_option_image_caption' ) ) {
    function hcode_option_image_caption( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_lightbox_caption';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );
            $img_info = array(
                'caption' => $attachment->post_excerpt,
            );
            if($option_value == '1'){
                return $img_info;
            }else{
                return;
            }
        }
        return;
    }
}

/* For Lightbox Image Title */
if ( ! function_exists( 'hcode_option_lightbox_image_title' ) ) {
    function hcode_option_lightbox_image_title( $attach_id ){
        global $hcode_theme_settings, $post;
        $option = 'enable_lightbox_title';
        if(isset($hcode_theme_settings[$option]) && $hcode_theme_settings[$option] != ''){
            $option_value = $hcode_theme_settings[$option];
            $img_meta = wp_get_attachment_metadata( $attach_id );
            $attachment = get_post( $attach_id );
            $img_info = array(
                'title' => $attachment->post_title
            );
            if($option_value == '1'){
                return $img_info;
            }else{
                return;
            }
        }
        return;
    }
}

if ( ! function_exists( 'hcode_option_url' ) ) {
    function hcode_option_url($option) {
        $image = hcode_option($option);
        if (is_array($image) && isset($image['url']) && !empty($image['url'])) {
            return $image['url'];
        }
        return false;
    }
}

add_action( 'wp_before_admin_bar_render', 'hcode_remove_customizer_adminbar' ); 
if ( ! function_exists( 'hcode_remove_customizer_adminbar' ) ) {
    function hcode_remove_customizer_adminbar() {
        global $wp_admin_bar;
        $wp_admin_bar->remove_menu('customize');
    }
}

if ( ! function_exists( 'hcode_breadcrumb_li_display' ) ) {
    function hcode_breadcrumb_li_display() {

        if( class_exists( 'WooCommerce' ) && ( is_product_category() || is_tax('product_brand') || is_shop() || is_product_taxonomy() ) ) {// check woocommerce category, brand, shop page

            ob_start();
                do_action('hcode_woocommerce_breadcrumb');
            return ob_get_clean();

        } elseif (class_exists('breadcrumb_navigation_xt')) {
            $hcode_enable_category_breadcrumb = '';
            $hcode_options = get_option( 'hcode_theme_setting' );
            if( is_singular('post') ){
                $hcode_enable_category_breadcrumb = ( isset($hcode_options['hcode_enable_breadcrumb_category']) && $hcode_options['hcode_enable_breadcrumb_category'] == 1 ) ? true : false;
            }elseif( is_singular('portfolio') ){
                $hcode_enable_category_breadcrumb = ( isset($hcode_options['hcode_enable_breadcrumb_category_portfolio']) && $hcode_options['hcode_enable_breadcrumb_category_portfolio'] == 1 ) ? true : false;
            }

            $page_title_show_breadcrumb = true;
            if( is_singular( 'portfolio' ) ) {
                $page_title_show_breadcrumb = ( isset( $hcode_options['hcode_page_breadcrumb_title_show_portfolio'] ) && $hcode_options['hcode_page_breadcrumb_title_show_portfolio'] == 1 ) ? true : false;
            } elseif( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) || is_post_type_archive( 'portfolio' ) ) {
                $page_title_show_breadcrumb = ( isset( $hcode_options['hcode_category_page_breadcrumb_title_show'] ) && $hcode_options['hcode_category_page_breadcrumb_title_show'] == 1 ) ? true : false;
            } elseif( is_search() || is_category() || is_archive() ) {
                $page_title_show_breadcrumb = ( isset( $hcode_options['hcode_archive_page_breadcrumb_title_show'] ) && $hcode_options['hcode_archive_page_breadcrumb_title_show'] == 1 ) ? true : false;
            } else {
                $page_title_show_breadcrumb = ( isset( $hcode_options['hcode_page_show_breadcrumb_title'] ) && $hcode_options['hcode_page_show_breadcrumb_title'] == 1 ) ? true : false;
            }

            $hcode_breadcrumb = new breadcrumb_navigation_xt;
            $hcode_breadcrumb->opt['static_frontpage'] = false;
            $hcode_breadcrumb->opt['url_blog'] = '';
            $hcode_breadcrumb->opt['title_blog'] = __('Home','H-Code');
            $hcode_breadcrumb->opt['title_home'] = __('Home','H-Code');
            $hcode_breadcrumb->opt['separator'] = '';
            $hcode_breadcrumb->opt['tag_page_prefix'] = '';
            $hcode_breadcrumb->opt['singleblogpost_category_display'] = $hcode_enable_category_breadcrumb;
            $hcode_breadcrumb->opt['breadcrumb_title_hide'] = $page_title_show_breadcrumb;

            return $hcode_breadcrumb->display();
        }
    }    
}

/* page title option for archive pages*/
if ( ! function_exists( 'hcode_get_title_part_for_archive' ) ) {
    function hcode_get_title_part_for_archive(){

        global $wp_query, $hcode_featured_array;

        $top_header_class = $page_title = '';

        $hcode_options          = get_option( 'hcode_theme_setting' );

        $hcode_enable_header    = hcode_option('hcode_enable_header');
        $hcode_header_layout    = hcode_option('hcode_header_layout');
        $header_logo_position   = hcode_option( 'hcode_header_logo_position' );
        $hcode_enable_mini_header = hcode_option( 'hcode_enable_mini_header' );
        $hcode_enable_mini_header_mobile = hcode_option( 'hcode_enable_mini_header_mobile' );

        if( class_exists( 'WooCommerce' ) && ( is_product_category() || is_tax('product_brand') || is_tax('product_tag') || is_shop() ) ) {// check woocommerce category, brand, shop page

            $enable_title               = hcode_option('hcode_enable_wc_category_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_wc_category_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_wc_category_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_wc_category_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_wc_category_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_wc_category_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_wc_category_page_title_show_separator');
            $hcode_header_layout        = hcode_option('hcode_header_layout_woocommerce');
            $hcode_enable_header        = hcode_option('hcode_enable_header_woocommerce');
            $hcode_category_description = hcode_option('hcode_wc_category_description');
            
            if( hcode_option( 'hcode_header_logo_position_woocommerce' ) ) {
                $header_logo_position       = hcode_option( 'hcode_header_logo_position_woocommerce' );
            }
            
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-wc-style';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';
   
        } elseif(is_singular('portfolio')){// check single page for portfolio

            $enable_title               = hcode_option_portfolio('hcode_enable_title_wrapper');
            $page_title_premade_style   = hcode_option_portfolio('hcode_page_title_premade_style');
            $page_title_image           = hcode_option_portfolio('hcode_title_background');
            $hcode_title_parallax_effect= hcode_option_portfolio('hcode_title_parallax_effect');
            $page_subtitle              = hcode_option_portfolio('hcode_header_subtitle');
            $page_title_show_breadcrumb = hcode_option_portfolio('hcode_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option_portfolio('hcode_page_title_show_separator');
                 
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';

            if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag()) || is_404()){
                $enable_header = '2';
            }else{
                $enable_header = hcode_option('hcode_enable_header');
            }
            if($enable_header == '1' || $enable_header == '2'){
                $hcode_enable_header = hcode_option('hcode_enable_header');
                $hcode_header_layout = hcode_option('hcode_header_layout');
      

                if($enable_header == '2'){
                    $hcode_options = get_option( 'hcode_theme_setting' );
                    $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
                }
            }
            
        } elseif(is_tax('portfolio-category') || is_tax('portfolio-tags') || is_post_type_archive('portfolio')){// check category, tag page for portfolio

            $enable_title               = hcode_option('hcode_enable_category_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_category_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_category_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_category_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_category_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_category_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_category_page_title_show_separator');
                 
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';

        } elseif(is_search() || is_category() || is_archive()){// check archive, category, search, author page

            $enable_title               = hcode_option('hcode_enable_archive_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_archive_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_archive_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_archive_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_archive_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_archive_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_archive_page_title_show_separator');
            $hcode_header_layout        = hcode_option('hcode_header_layout_general');
            $hcode_enable_header        = hcode_option('hcode_enable_header_general');
            if( hcode_option( 'hcode_header_logo_position_general' ) ) {
                $header_logo_position       = hcode_option( 'hcode_header_logo_position_general' );
            }

            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';
  
        } elseif( is_home() ) {// default blog page

            $enable_title               = hcode_option('hcode_enable_blog_title_wrapper');
            $page_title_premade_style   = hcode_option('hcode_blog_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_blog_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_blog_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_blog_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_blog_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_blog_page_title_show_separator');
                 
            $enable_title = $enable_title != '' ? $enable_title : '1';
            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';
            $page_title_show_breadcrumb = $page_title_show_breadcrumb != '' ? $page_title_show_breadcrumb : '1';
 
        } else {

            $enable_title = hcode_option('hcode_enable_title_wrapper');

            if( $enable_title == '1' ){
                $hcode_options = get_option( 'hcode_theme_setting' );
                $enable_title = ( isset($hcode_options['hcode_enable_title_wrapper']) ) ? $hcode_options['hcode_enable_title_wrapper'] : '';
            }

            $page_title_premade_style   = hcode_option('hcode_page_title_premade_style');
            $page_title_image           = hcode_option('hcode_title_background');
            $hcode_title_parallax_effect= hcode_option('hcode_title_parallax_effect');
            $page_subtitle              = hcode_option('hcode_header_subtitle');
            $page_title_show_breadcrumb = hcode_option('hcode_page_title_show_breadcrumb');
            $page_title_show_separater  = hcode_option('hcode_page_title_show_separator');

            $page_title_premade_style   = !empty( $page_title_premade_style ) ? $page_title_premade_style : 'title-small-gray';

            if( class_exists( 'WooCommerce' ) && (is_product() || is_product_category() || is_product_tag()) || is_404()){
                $enable_header = '2';
            }else{
                $enable_header = hcode_option('hcode_enable_header');
            }
            if($enable_header == '1' || $enable_header == '2'){
                $hcode_enable_header = hcode_option('hcode_enable_header');
                $hcode_header_layout = hcode_option('hcode_header_layout');

                if($enable_header == '2'){
                    $hcode_options = get_option( 'hcode_theme_setting' );
                    $hcode_enable_header = (isset($hcode_options['hcode_enable_header'])) ? $hcode_options['hcode_enable_header'] : '';
                }
            }
        }

        if($enable_title == 0 || is_404()) {
            return;
        }
        
        if( class_exists( 'WooCommerce' ) && ( is_shop() || is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || is_product_taxonomy() ) ) {
            if ( apply_filters( 'woocommerce_show_page_title', true ) ) {
                ob_start();
                    woocommerce_page_title();
                    $page_title .= ob_get_contents();
                ob_end_clean();
            }
        } elseif( is_post_type_archive( 'portfolio' ) ) {
            $page_title .= ( isset( $hcode_options['hcode_portfolio_cat_title'] ) ) ? $hcode_options['hcode_portfolio_cat_title'] : '';
        } elseif( is_search() ) {
            $page_title .= __( 'Search For ', 'H-Code' ).'"'.get_search_query().'"';
        } elseif( is_author() ) {
            $page_title .= get_the_author();
        } elseif( is_archive() ) {
            if ( is_day() ) {
                $page_title .= get_the_date();
            } elseif ( is_month() ) {
                $page_title .= get_the_date( _x( 'F Y', 'monthly archives date format', 'H-Code' ) );
            } elseif ( is_year() ) {
                $page_title .= get_the_date( _x( 'Y', 'yearly archives date format', 'H-Code' ) );
            }
            $page_title .= single_cat_title( '', false );
        } elseif( is_home() ) {
            $page_title .= ( isset( $hcode_options['hcode_blog_page_title'] ) ) ? $hcode_options['hcode_blog_page_title'] : '';
        } else {
            $page_title .= get_the_title();
        }

        $page_title_image_id = '';
        if( is_array( $page_title_image ) ) {
            $page_title_image_id = $page_title_image['id'];
            $page_title_image = $page_title_image['url'];
        }

        $hcode_bg_page_title_color = hcode_option('hcode_bg_page_title_color');
        $hcode_bg_page_title_opacity = hcode_option('hcode_bg_page_title_opacity');
        $hcode_page_title_title_color = hcode_option('hcode_page_title_title_color');
        $hcode_page_title_subtitle_color = hcode_option('hcode_page_title_subtitle_color');
        $hcode_page_title_sep_color = hcode_option('hcode_page_title_sep_color');
        $hcode_page_title_breadcrumb_color = hcode_option('hcode_page_title_breadcrumb_color');
        $hcode_page_title_breadcrumb_hover_color = hcode_option('hcode_page_title_breadcrumb_hover_color');

        !empty( $hcode_bg_page_title_color ) ? $hcode_featured_array[] = '.page-title-section, .page-title-default-bg { background-color: '.$hcode_bg_page_title_color.'}' : '';

        !empty( $hcode_bg_page_title_opacity ) ? $hcode_featured_array[] = '.page-title-default-bg { opacity: '.$hcode_bg_page_title_opacity.'}' : '';

        !empty( $hcode_page_title_title_color ) ? $hcode_featured_array[] = '.page-title-section h1 { color: '.$hcode_page_title_title_color.'}' : '';

        !empty( $hcode_page_title_subtitle_color ) ? $hcode_featured_array[] = '.page-title-section span { color: '.$hcode_page_title_subtitle_color.'}' : '';

        !empty( $hcode_page_title_sep_color ) ? $hcode_featured_array[] = '.page-title-section .separator-line { background-color: '.$hcode_page_title_sep_color.'}' : '';

        !empty( $hcode_page_title_breadcrumb_color ) ? $hcode_featured_array[] = '.page-title-section ul li a, .page-title-section ul li { color: '.$hcode_page_title_breadcrumb_color.'}' : '';

        !empty( $hcode_page_title_breadcrumb_hover_color ) ? $hcode_featured_array[] = '.page-title-section ul li a:hover { color: '.$hcode_page_title_breadcrumb_hover_color.'}' : '';

        $output = '';

        switch ($page_title_premade_style) {
            case 'title-white':

                echo '<section class="page-title-section page-title border-bottom-light border-top-light bg-white">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow" data-wow-duration="300ms">';
                                    if($page_title){
                                        echo '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-gray-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
                break;

            case 'title-gray':
                
                echo '<section class="page-title-section page-title bg-gray">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow" data-wow-duration="300ms">';
                                    if($page_title){
                                        echo '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-gray-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
                break;

            case 'title-dark-gray':
                
                echo '<section class="page-title-section page-title bg-dark-gray">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow" data-wow-duration="300ms">';
                                    if($page_title){
                                        echo '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-white-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
                break;

            case 'title-black':

                echo '<section class="page-title-section page-title bg-black">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow" data-wow-duration="300ms">';
                                    if($page_title){
                                        echo '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-white-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';

                break;
            case 'title-with-image':
                
                $image_url = $page_title_image ;
                if( esc_url( $image_url ) ) {
                    if( $page_title_image_id ) {
                        $img_id = $page_title_image_id;
                    } else {
                        $img_id = hcode_get_attachment_id_from_url( $image_url  );
                    }
                    $hcode_srcset = $hcode_srcset_data = $hcode_srcset_classes = '';
                    $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
                    if( $hcode_srcset ){
                        $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
                        $hcode_srcset_classes = ' bg-image-srcset';
                    }
                    $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );

                    echo '<section class="page-title-section page-title '.$hcode_title_parallax_effect.$hcode_srcset_classes.' parallax-fix" style="background: url('.$hcode_image_url[0].'); background-position: 50% 0%;"'.$hcode_srcset_data.'>';
                } else {
                    echo '<section class="page-title-section page-title '.$hcode_title_parallax_effect.' parallax-fix">';
                }
                    echo '<div class="page-title-default-bg opacity-medium bg-black"></div>';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 slideInUp wow" data-wow-duration="300ms">';
                                    if($page_title){
                                        echo '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase sm-no-margin-top wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-white-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';

                break;
            case 'title-large':

                $image_url = $page_title_image ;

                if( esc_url( $image_url ) ) {
                    if( $page_title_image_id ) {
                        $img_id = $page_title_image_id;
                    } else {
                        $img_id = hcode_get_attachment_id_from_url( $image_url  );
                    }
                    $hcode_srcset = $hcode_srcset_data = $hcode_srcset_classes = '';
                    $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
                    if( $hcode_srcset ){
                        $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
                        $hcode_srcset_classes = ' bg-image-srcset';
                    }
                    $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );
                    echo '<section class="page-title-section page-title '.$hcode_title_parallax_effect.$hcode_srcset_classes.' parallax-fix page-title-large" style="background: url('.$image_url.'); background-position: 50% 0%;"'.$hcode_srcset_data.'>';
                } else {
                    echo '<section class="page-title-section page-title '.$hcode_title_parallax_effect.' parallax-fix page-title-large">';
                }
                    echo '<div class="page-title-default-bg opacity-medium bg-black"></div>';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 col-sm-12 text-center animated fadeInUp">';
                                if($page_title != '' || $page_subtitle != ''){
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line bg-yellow no-margin-top margin-four"></div>';
                                    }
                                    if($page_title){
                                        echo '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="white-text">'.$page_subtitle.'</span>';
                                    }
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
                break;
            case 'title-large-without-overlay':

                $image_url = $page_title_image ;

                if( esc_url( $image_url ) ) {
                    if( $page_title_image_id ) {
                        $img_id = $page_title_image_id;
                    } else {
                        $img_id = hcode_get_attachment_id_from_url( $image_url  );
                    }
                    $hcode_srcset = $hcode_srcset_data = $hcode_srcset_classes = '';
                    $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
                    if( $hcode_srcset ){
                        $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
                        $hcode_srcset_classes = ' bg-image-srcset';
                    }
                    $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );
                    echo '<section class="page-title-section page-title '.$hcode_title_parallax_effect.$hcode_srcset_classes.' parallax-fix page-title-large" style="background: url('.$image_url.'); background-position: 50% 0%;"'.$hcode_srcset_data.'>';
                } else {
                    echo '<section class="page-title-section page-title '.$hcode_title_parallax_effect.' parallax-fix page-title-large">';
                }
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-12 col-sm-12 text-center animated fadeInUp">';
                                if($page_title != '' || $page_subtitle != ''){
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line bg-yellow no-margin-top margin-four"></div>';
                                    }
                                    if($page_title){
                                        echo '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="text-uppercase gray-text">'.$page_subtitle.'</span>';
                                    }
                                }
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
                break;
            case 'title-small-white':

                echo '<section class="page-title-section page-title page-title-small border-bottom-light border-top-light bg-white">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        echo '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-gray-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
                break;
            case 'title-small-gray':

                echo '<section class="page-title-section page-title page-title-small bg-gray">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        echo '<h1 class="black-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-black no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-gray-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';

                break;
            case 'title-small-dark-gray':

                echo '<section class="page-title-section page-title page-title-small bg-dark-gray border-bottom-light border-top-light">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        echo '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-white-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';

                break;
            case 'title-small-black':

                echo '<section class="page-title-section page-title page-title-small bg-black border-bottom-light border-top-light">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != ''){
                                echo '<div class="col-lg-8 col-md-7 col-sm-12 animated fadeInUp">';
                                    
                                    if($page_title){
                                        echo '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-white no-margin-lr sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                            if($page_title_show_breadcrumb == 1){
                                echo '<div class="col-lg-4 col-md-5 col-sm-12 breadcrumb text-uppercase wow fadeInUp xs-display-none" data-wow-duration="600ms">';
                                    echo '<ul class="breadcrumb-white-text">';
                                        echo hcode_breadcrumb_li_display();
                                    echo '</ul>';
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';

                break;
            case 'title-center-align':

                echo '<section class="page-title-section page-title bg-black border-bottom-light border-top-light">';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            if($page_title != '' || $page_subtitle != ''){
                                echo '<div class="col-md-12 col-sm-12 animated text-center fadeInUp">';
                                    
                                    if($page_title){
                                        echo '<h1 class="white-text">'.$page_title.'</h1>';
                                    }
                                    if($page_subtitle){
                                        echo '<span class="white-text xs-display-none">'.$page_subtitle.'</span>';
                                    }
                                    if($page_title_show_separater == 1){
                                        echo '<div class="separator-line margin-three bg-white sm-margin-top-three sm-margin-bottom-three no-margin-bottom xs-display-none"></div>';
                                    }
                                echo '</div>';
                            }
                        echo '</div>';
                    echo '</div>';
                echo '</section>';

                break;
            case 'title-wc-style':
                if( class_exists( 'WooCommerce' ) ) {
                    if( is_shop() ) {
                        
                        $description = $page_subtitle;

                        // get the image URL
                        $image_url = $page_title_image;
                        if( esc_url( $image_url ) ) {
                            if( $page_title_image_id ) {
                                $img_id = $page_title_image_id;
                            } else {
                                $img_id = hcode_get_attachment_id_from_url( $image_url  );
                            }
                            $hcode_srcset = $hcode_srcset_data = $hcode_srcset_classes = '';
                            $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
                            if( $hcode_srcset ){
                                $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
                                $hcode_srcset_classes = ' bg-image-srcset';
                            }
                            $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );
                            echo '<section class="page-title-section page-title parallax3 parallax-fix page-title-large page-title-shop'.$hcode_srcset_classes.'" style="background: url('.esc_url( $hcode_image_url[0] ).');"'.$hcode_srcset_data.'>';
                        } else {
                            echo '<section class="page-title-section page-title parallax3 parallax-fix page-title-large page-title-shop">';
                        }

                        echo '<div class="page-title-default-bg opacity-light bg-dark-gray"></div>
                            <div class="container">
                                <div class="row">
                                    <div class="col-md-12 col-sm-12 wow fadeIn">';
                                        if ( ! empty( $description ) ) {
                                            echo '<span class="text-uppercase white-text">'.$description.'</span>';
                                        }
                                        echo '<h1 class="white-text">' . $page_title . '</h1>';
                        echo '</div>';
                                    if( $page_title_show_breadcrumb ):
                                        echo '<div class="col-md-12 col-sm-12 breadcrumb text-uppercase margin-three no-margin-bottom wow fadeIn">';
                                            echo '<ul class="woocommerce-breadcrumb-main breadcrumb-white-text">';
                                                echo hcode_breadcrumb_li_display();
                                            echo '</ul>
                                        </div>';
                                    endif;
                        echo '</div>
                            </div>
                                </section>';
                    } else {
                        
                        // get the query object
                        $product_category       = $wp_query->get_queried_object();

                        // get the thumbnail id user the term_id
                        $thumbnail_id           = get_term_meta( $product_category->term_id, 'thumbnail_id', true );

                        // get the image URL
                        $product_category_image = !empty( $thumbnail_id ) ? $thumbnail_id : $page_title_image_id;
                        
                        // get the subline / description
                        $description            = get_queried_object()->description;
                        $description            = !empty( $description ) && !is_shop() ? $description : $page_subtitle;

                        
                        if( $product_category_image ) {
                            $img_id = $product_category_image;
                            $hcode_srcset = $hcode_srcset_data = $hcode_srcset_classes = '';
                            $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
                            if( $hcode_srcset ){
                                $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
                                $hcode_srcset_classes = ' bg-image-srcset';
                            }
                            $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );
                            echo '<section class="page-title-section page-title parallax3 parallax-fix page-title-large page-title-shop'.$hcode_srcset_classes.'" style="background: url('.esc_url( $hcode_image_url[0] ).'); background-position: 50% 0%;"'.$hcode_srcset_data.'>';
                        } else {
                            echo '<section class="page-title-section page-title parallax3 parallax-fix page-title-large page-title-shop">';
                        }

                            echo '<div class="opacity-light bg-dark-gray"></div>';
                            echo '<div class="container">';
                                echo '<div class="row">';
                                    echo '<div class="col-md-12 col-sm-12 wow fadeIn">';
                                        if ( ! empty( $description ) && $hcode_category_description == 1 ) {
                                            echo '<span class="text-uppercase white-text">'.$description.'</span>';
                                        }
                                        if( $page_title ) {
                                            echo '<h1 class="white-text">'.$page_title.'</h1>';
                                        }
                                    echo '</div>';
                                    if( $page_title_show_breadcrumb ):
                                        echo '<div class="col-md-12 col-sm-12 breadcrumb text-uppercase margin-three no-margin-bottom wow fadeIn">';
                                            echo '<ul class="woocommerce-breadcrumb-main breadcrumb-white-text">';
                                                echo hcode_breadcrumb_li_display();
                                            echo '</ul>
                                        </div>';
                                    endif;
                                echo '</div>';
                            echo '</div>';
                        echo '</section>';
                    }
                }

                break;
        }
    }
}

if ( ! function_exists( 'hcode_categories_postcount_filter' ) ) {
    function hcode_categories_postcount_filter ($variable) {
       $variable = str_replace('(', '<span class="light-gray-text">/ ', $variable);
       $variable = str_replace(')', '</span>', $variable);
       return $variable;
    }
}
add_filter('wp_list_categories','hcode_categories_postcount_filter');

add_filter('wp_list_categories', 'hcode_add_new_class_list_categories');
if ( ! function_exists( 'hcode_add_new_class_list_categories' ) ) {
    function hcode_add_new_class_list_categories($list) {
        $list = str_replace('cat-item ', 'cat-item widget-category-list light-gray-text ', $list); 
        return $list;
    }
}

add_filter('get_archives_link', 'hcode_archive_count_no_brackets');
if ( ! function_exists( 'hcode_archive_count_no_brackets' ) ) {
    function hcode_archive_count_no_brackets($links) {
        $links = str_replace('(', '<span class="light-gray-text">/ ', $links);
        $links = str_replace(')', '</span>', $links);
        return $links;
    }
}
add_filter('get_archives_link', 'hcode_add_new_class_list_archives');
if ( ! function_exists( 'hcode_add_new_class_list_archives' ) ) {
    function hcode_add_new_class_list_archives($list) {
        $list = str_replace('<li>', '<li class="widget-category-list"> ', $list); 
        return $list;
    }
}

if ( ! function_exists( 'hcode_wp_tag_cloud_filter' ) ) {
    function hcode_wp_tag_cloud_filter($return, $args)
    {
      return '<div class="tags_cloud tags">'.$return.'</div>';
    }
}
add_filter('wp_tag_cloud','hcode_wp_tag_cloud_filter', 10, 2);
/*  comment form customization   */

if ( ! function_exists( 'hcode_theme_comment' ) ) {
    function hcode_theme_comment($comment, $args, $depth) {
        
        $GLOBALS['comment'] = $comment;
        extract($args, EXTR_SKIP);

        if ( 'div' == $args['style'] ) {
            $tag = 'div';
            $add_below = 'comment';
        } else {
            $tag = 'li';
            $add_below = 'div-comment';
        }
            
    ?>
        <<?php echo esc_html( $tag ) ?> <?php comment_class( empty( $args['has_children'] ) ? 'blog-comment' : 'blog-comment parent' ) ?> id="comment-<?php comment_ID() ?>">
        <?php if ( 'div' != $args['style'] ) : ?>
        <div id="div-comment-<?php comment_ID() ?>" class="comment-body">
        <?php endif; ?>
            
        <?php if ( $comment->comment_approved == '0' ) : ?>
            <em class="comment-awaiting-moderation"><?php esc_html_e( 'Your comment is awaiting moderation.', 'H-Code' ); ?></em>
            <br />
        <?php endif; ?>
        <div class="comment-author vcard comment-avtar">
            <?php if ( $args['avatar_size'] != 0 ) echo get_avatar( $comment, $args['avatar_size'] );   ?>
        </div>
        <div class="comment-right comment-text overflow-hidden position-relative">
                <div class="blog-date no-padding-top">
                    <div class="comment-meta commentmetadata">
                            <?php 
                                $comment_author_url  = get_comment_author_url( $comment );
                                if ( !empty( $comment_author_url ) ) {
                            ?>
                                <a rel="external nofollow" href="<?php echo get_comment_author_url( $comment ); ?>">
                            <?php }
                            
                            printf( esc_html__( '%s, ', 'H-Code' ), get_comment_author( $comment ) );
                            
                            if ( !empty( $comment_author_url ) ) { ?>
                            </a>
                            <?php } ?>
                            
                            <?php
                            /* translators: comment date */
                            printf( esc_html__('%s','H-Code'), get_comment_date( '', $comment ) );
                            ?>
                            
                            <?php comment_reply_link( array_merge( $args, array( 'add_below' => $add_below, 'depth' => $depth, 'max_depth' => $args['max_depth'] ) ) ); ?>
                    </div>
                </div>
                <?php comment_text(); ?>
        </div>
        <?php if ( 'div' != $args['style'] ) : ?>
        </div>
        <?php endif; ?>
    <?php
    }
}

// filter to replace class on reply link
add_filter('comment_reply_link', 'hcode_replace_reply_link_class');
if ( ! function_exists( 'hcode_replace_reply_link_class' ) ) {
    function hcode_replace_reply_link_class($class){
        $class = str_replace( "class='comment-reply-link", "class='comment-reply-link comment-reply inner-link bg-black", $class );
        return $class;
    }
}

add_filter('the_category', 'hcode_the_category');
if ( ! function_exists( 'hcode_the_category' ) ) {
    function hcode_the_category($cat_list)
    {
        return str_ireplace('<a', '<a class="white-text"', $cat_list);
    }
}

if ( ! function_exists( 'hcode_get_attachment_id_from_url' ) ) {
    function hcode_get_attachment_id_from_url($image_url) {
        global $wpdb;
        $image = '';
        $attachment = false;
        if ( '' == $image_url )
                return;

        $upload_dir_paths = wp_upload_dir();
        
        if ( false !== strpos( $image_url, $upload_dir_paths['baseurl'] ) ) {

            // Remove the upload path base directory from the attachment URL
            $image_url = str_replace( $upload_dir_paths['baseurl'] . '/', '', $image_url );

            $attachment = $wpdb->get_var( $wpdb->prepare( "SELECT hcodeposts.ID FROM $wpdb->posts hcodeposts, $wpdb->postmeta hcodepostmeta WHERE hcodeposts.ID = hcodepostmeta.post_id AND hcodepostmeta.meta_key = '_wp_attached_file' AND hcodepostmeta.meta_value = '%s' AND hcodeposts.post_type = 'attachment'", $image_url ) );
        }
        return $attachment;
    }
}

/* Post Navigation */
if ( ! function_exists( 'hcode_single_post_navigation' ) ) :
    function hcode_single_post_navigation() {
        if( is_singular( 'post' ) ) {

            $link = '';
            // no image
            $hcode_options = get_option( 'hcode_theme_setting' );
            $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
            $hcode_post_pagination_type = ( isset( $hcode_options['hcode_post_pagination_type'] ) ) ? $hcode_options['hcode_post_pagination_type'] : 'category';

            if( $hcode_post_pagination_type == 'post_tag' || $hcode_post_pagination_type == 'category' ){

                if( $hcode_post_pagination_type == 'category' ){
                    $cat = get_the_category(); 
                    $current_cat_id = $cat[0]->cat_ID;
                    $link = get_category_link( $current_cat_id );

                    $args = array( 
                        'category' => $current_cat_id,
                        'posts_per_page' => -1,
                    );
                } else {
                    $tags = get_the_tags();
                    $current_tag_id = $tags[0]->term_id;
                    $link = get_tag_link( $current_tag_id );                    
                    $args = array( 
                        'tag_id' => $current_tag_id,
                        'posts_per_page' => -1,
                    );
                }

                $posts = get_posts( $args );

                // get IDs of posts retrieved from get_posts
                $ids = array();
                foreach ( $posts as $thepost ) {
                    $ids[] = $thepost->ID;
                }
            
                $thisindex = array_search( get_the_ID(), $ids );

                if( ( $thisindex - 1 ) < 0 ) {
                    $previd = '';
                } else {
                    $previd = $ids[ $thisindex - 1 ];
                }

                if( ( $thisindex + 1 ) > count( $ids ) - 1 ) {
                    $nextid = '';
                } else {
                    $nextid = $ids[ $thisindex + 1 ];
                }
            } else {
                $previd = '';
                $nextid = '';

                $prev_post = get_previous_post();
                if( !empty( $prev_post ) ) {
                  $previd = $prev_post->ID;
                }

                $next_post = get_next_post();
                if( !empty( $next_post ) ) {
                  $nextid = $next_post->ID;
                }

                $cat = get_the_category();
                if( !empty( $cat ) ) {
                    $current_cat_id = $cat[0]->cat_ID;
                    $link = get_category_link( $current_cat_id );   
                }
            }

            $related_post_style = hcode_option( 'enable_navigation_style' );    
            
            if( $related_post_style == 'normal' ){ 

                echo '<div class="next-previous-project-style2" role="navigation">';
                    echo '<div class="previous-link">';
                        if ( ! empty( $previd) ) {
                            echo '<a rel="prev" class="border-right" href="'.get_permalink( $previd ).'">';
                                echo '<i class="fas fa-angle-left"></i>&nbsp;<span>'.esc_html__( "Previous Post", "H-Code" ).'</span>';
                            echo '</a>';
                        }
                    echo '</div>';
                    echo '<div class="back-to-category">';
                        $navigation_post_category_link = ( isset( $hcode_options['navigation_post_category_link'] ) ) ? $hcode_options['navigation_post_category_link'] : '';
                        $navigation_post_category_link_target = ( isset( $hcode_options['navigation_post_category_link_target'] ) ) ? $hcode_options['navigation_post_category_link_target'] : '_self';

                        if( $navigation_post_category_link ) {
                            echo '<a href="'.esc_url( $navigation_post_category_link ).'" class="text-uppercase back-project" target="'.$navigation_post_category_link_target.'">';
                                echo '<i class="fas fa-th-large"></i>';
                            echo '</a>';
                        } else {
                            if( $link ) {
                                echo '<a href="'.esc_url( $link ).'" class="text-uppercase back-project" target="'.$navigation_post_category_link_target.'">';
                                    echo '<i class="fas fa-th-large"></i>';
                                echo '</a>';
                            }
                        }
                    echo '</div>';
                    echo '<div class="next-link">';
                        if ( ! empty( $nextid ) ) {
                            echo '<a rel="next" class="border-left-1px" href="'.get_permalink( $nextid ).'">';
                                echo '<span>'.esc_html__( "Next Post", "H-Code" ).'</span>&nbsp;<i class="fas fa-angle-right"></i>';
                            echo '</a>';
                        }
                    echo '</div>';
                echo '</div>';
            }
            
            if( $related_post_style == 'modern' ) {

                $navigation_image_srcset  = !empty( $hcode_options['navigation_image_srcset'] ) ? $hcode_options['navigation_image_srcset'] : 'full';
                echo '<div class="next-previous-project xs-display-none">';
                    if ( $nextid ) {
                        echo '<div class="next-project">';
                            echo '<a rel="next" href="'.get_permalink( $nextid ).'">';

                                $next_project_img = HCODE_THEME_ASSETS . '/images/next-project.png';
                                if( file_exists( $next_project_img ) ) {
                                    echo '<img alt="'.__( "Next Post", "H-Code" ).'" class="next-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/next-project.png" width="33" height="83">';
                                }
                                echo '<span>'.esc_html__( 'Next Post', 'H-Code' ).'</span>';

                                if ( $nextid &&  has_post_thumbnail( $nextid ) ) {
                                    echo get_the_post_thumbnail( $nextid, $navigation_image_srcset );
                                } else {
                                    $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
                                    if( isset( $hcode_no_image['url'] ) && $hcode_no_image['url'] ) {
                                        echo wp_get_attachment_image( $hcode_no_image['id'], $navigation_image_srcset );
                                    } else {
                                        $default_img = HCODE_THEME_ASSETS . '/images/no-image-133x83.jpg';
                                        if( file_exists( $default_img ) ) {
                                            echo '<img src="'.HCODE_THEME_ASSETS_URI.'/images/no-image-133x83.jpg" width="133" height="83"  alt="'.esc_html__( 'No Image', 'H-Code' ).'" />';
                                        }
                                    }
                                }
                            echo '</a>';
                        echo '</div>';
                    }
                    if( $previd ) {
                        echo '<div class="previous-project">';
                            echo '<a rel="prev" href="'.get_permalink( $previd ).'">';
                                if ( $previd &&  has_post_thumbnail( $previd ) ) {
                                    echo get_the_post_thumbnail( $previd, $navigation_image_srcset );
                                } else {

                                    $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
                                    if( isset( $hcode_no_image['url'] ) && $hcode_no_image['url'] ) {
                                        echo wp_get_attachment_image( $hcode_no_image['id'], $navigation_image_srcset );
                                    } else {
                                        $default_img = HCODE_THEME_ASSETS . '/images/no-image-133x83.jpg';
                                        if( file_exists( $default_img ) ) {
                                            echo '<img src="'.HCODE_THEME_ASSETS_URI.'/images/no-image-133x83.jpg" width="133" height="83"  alt="'.esc_html__( 'No Image', 'H-Code' ).'" />';
                                        }
                                    }
                                }
                                $previous_project_img = HCODE_THEME_ASSETS . '/images/previous-project.png';
                                if( file_exists( $previous_project_img ) ) {
                                    echo '<img alt="'.__( "Previous Post", "H-Code" ).'" class="previous-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/previous-project.png" width="33" height="83">';
                                }
                                echo '<span>'.esc_html__( 'Previous Post','H-Code' ).'</span>';
                            echo '</a>';
                        echo '</div>';
                    }
                echo '</div>';
            }
        } else {
            return;
        }
    }
endif;

/* Portfolio Navigation */
if ( ! function_exists( 'hcode_single_portfolio_navigation' ) ) :
    function hcode_single_portfolio_navigation() {
        $hcode_options = get_option( 'hcode_theme_setting' );
        $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
        $hcode_portfolio_pagination_type = ( isset( $hcode_options['hcode_portfolio_pagination_type'] ) ) ? $hcode_options['hcode_portfolio_pagination_type'] : '';

        $link = $previd = $nextid = $next_image = $prev_image = $thumb_icon = $thumb_icon_next = '';

        if( $hcode_portfolio_pagination_type == 'portfolio-tags' || $hcode_portfolio_pagination_type == 'portfolio-category' ){
            if( isset( $hcode_no_image['url'] ) ) {
                $image_thumb = $hcode_no_image['url'];
            } else {
                $image_thumb = '';
            }

            $terms = get_the_terms( get_the_ID() , $hcode_portfolio_pagination_type );
            
            if( empty($terms) ) {
                return;
            }

            $link = get_term_link( $terms[0]->slug, $hcode_portfolio_pagination_type );

            $args = array( 
                'post_type' => 'portfolio',
                'posts_per_page' => -1,
                'tax_query' => array(
                    array(
                        'taxonomy' => $hcode_portfolio_pagination_type,
                        'terms' => array( $terms[0]->term_id ),
                        'field' => 'term_id',
                        'operator' => 'IN',
                    ),
                ),
                'meta_query' => array(
                    array(
                        'key'       => 'hcode_enable_ajax_popup_single',
                        'value'     => 'yes',
                        'compare'   => '!=',
                    )
                )
            );
            $posts = get_posts( $args );
            
            $ids = array();
            foreach ( $posts as $thepost ) {
                $ids[] = $thepost->ID;
            }

            $thisindex = array_search( get_the_ID(), $ids );
            if( ( $thisindex - 1 ) < 0 ) {
                $previd = '';
            } else {
                $previd = $ids[ $thisindex - 1 ];
            }
            if( ( $thisindex + 1 ) > count( $ids ) - 1 ) {
                $nextid = '';
            } else {
                $nextid = $ids[ $thisindex + 1 ];
            }

        } else {

            $prev_post = get_previous_post();
            if( !empty( $prev_post ) ) {
              $previd = $prev_post->ID;
            }

            $next_post = get_next_post();
            if( !empty( $next_post ) ) {
              $nextid = $next_post->ID;
            }

            $terms = get_the_terms( get_the_ID() , 'portfolio-category' );
            if( !empty( $terms ) ) {
                $link = get_term_link( $terms[0]->slug, 'portfolio-category' );
            }
        }

        $related_portfolio_style = hcode_option( 'enable_navigation_portfolio_style' );

        if( $related_portfolio_style == 'normal' ) {
            echo '<div class="next-previous-project-style2" role="navigation">';
                echo '<div class="previous-link">';
                    if ( $previd ) {
                        echo '<a rel="prev" class="border-right" href="'.get_permalink( $previd ).'"><i class="fas fa-angle-left"></i>&nbsp;<span>'.esc_html__( "Previous Project", "H-Code" ).'</span></a>';
                    }
                echo '</div>';
                echo '<div class="back-to-category">';
                    $navigation_portfolio_category_link = ( isset( $hcode_options['navigation_portfolio_category_link'] ) ) ? $hcode_options['navigation_portfolio_category_link'] : '';
                    $navigation_portfolio_category_link_target = ( isset( $hcode_options['navigation_portfolio_category_link_target'] ) ) ? $hcode_options['navigation_portfolio_category_link_target'] : '_self';

                    if( $navigation_portfolio_category_link ) {
                        echo '<a href="'.esc_url( $navigation_portfolio_category_link ).'" class="text-uppercase back-project" target="'.$navigation_portfolio_category_link_target.'">';
                            echo '<i class="fas fa-th-large"></i>';
                        echo '</a>';
                    } else {
                        if( $link ) {
                            echo '<a href="'.esc_url( $link ).'" class="border-right text-uppercase back-project" target="'.$navigation_portfolio_category_link_target.'"><i class="fas fa-th-large"></i></a>';
                        }
                    }
                echo '</div>';
                echo '<div class="next-link">';
                    if( $nextid ) {
                        echo '<a rel="next" class="border-left-1px" href="'.get_permalink( $nextid ).'"><span>'.esc_html__( "Next Project", "H-Code" ).'</span>&nbsp;<i class="fas fa-angle-right"></i></a>';
                    }
                echo '</div>';
            echo '</div>';
        }
        
        if( $related_portfolio_style == 'modern' ) {

            $portfolio_navigation_image_srcset = !empty( $hcode_options['portfolio_navigation_image_srcset'] ) ? $hcode_options['portfolio_navigation_image_srcset'] : 'full';
            
            echo '<div class="next-previous-project xs-display-none">';
                if ( $nextid ) {
                    echo '<div class="next-project">';
                        echo '<a rel="next" href="'.get_permalink( $nextid ).'">';
                        $next_project_img = HCODE_THEME_ASSETS . '/images/next-project.png';
                        if( file_exists( $next_project_img ) ) {
                            echo '<img alt="'.__( "Next Project", "H-Code" ).'" class="next-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/next-project.png" width="33" height="83">';
                        }
                        echo '<span>'.esc_html__( 'Next Project', 'H-Code' ).'</span>';
                        
                        if ( $nextid &&  has_post_thumbnail( $nextid ) ) {
                            echo get_the_post_thumbnail( $nextid, $portfolio_navigation_image_srcset );
                        } else {
                            $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
                            if( isset( $hcode_no_image['url'] ) && $hcode_no_image['url'] ) {
                                echo wp_get_attachment_image( $hcode_no_image['id'], $portfolio_navigation_image_srcset );
                            } else {
                                $default_img = HCODE_THEME_ASSETS . '/images/no-image-133x83.jpg';
                                if( file_exists( $default_img ) ) {
                                    echo '<img src="'.HCODE_THEME_ASSETS_URI.'/images/no-image-133x83.jpg" width="133" height="83"  alt="'.esc_html__( 'No Image', 'H-Code' ).'" />';
                                }
                            }
                        }
                        echo '</a>';
                    echo '</div>';
                } 
                if( $previd ) {
                    echo '<div class="previous-project">';
                    echo '<a rel="prev" href="'.get_permalink( $previd ).'">';
                        if ( $previd &&  has_post_thumbnail( $previd ) ) {
                            echo get_the_post_thumbnail( $previd, $portfolio_navigation_image_srcset );
                        } else {
                            $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
                            if( isset( $hcode_no_image['url'] ) && $hcode_no_image['url'] ) {
                                echo wp_get_attachment_image( $hcode_no_image['id'], $portfolio_navigation_image_srcset );
                            } else {
                                $default_img = HCODE_THEME_ASSETS . '/images/no-image-133x83.jpg';
                                if( file_exists( $default_img ) ) {
                                    echo '<img src="'.HCODE_THEME_ASSETS_URI.'/images/no-image-133x83.jpg" width="133" height="83"  alt="'.esc_html__( 'No Image', 'H-Code' ).'" />';
                                }
                            }
                        }
                        $previous_project_img = HCODE_THEME_ASSETS . '/images/previous-project.png';
                        if( file_exists( $previous_project_img ) ) {
                            echo '<img alt="'.__( "Previous Project", "H-Code" ).'" class="previous-project-img" src="'.HCODE_THEME_ASSETS_URI.'/images/previous-project.png" width="33" height="83">';
                        }
                        echo '<span>'.esc_html__( 'Previous Project', 'H-Code' ).'</span>';
                    echo '</a>';
                    echo '</div>';
                }
            echo '</div>';
        }
    }
endif;

/* For Adding Class Into Single Post Pagination*/
if ( ! function_exists( 'hcode_posts_link_next_class' ) ) {
    function hcode_posts_link_next_class($format){
         $format = str_replace('href=', 'class="next" href=', $format);
         return $format;
    }
}
add_filter('next_post_link', 'hcode_posts_link_next_class');

if ( ! function_exists( 'hcode_posts_link_prev_class' ) ) {
    function hcode_posts_link_prev_class($format) {
         $format = str_replace('href=', 'class="previous" href=', $format);
         return $format;
    }
}
add_filter('previous_post_link', 'hcode_posts_link_prev_class');

/* Single blog page related post */
/* Post Navigation */
if ( ! function_exists( 'hcode_single_post_related_posts' ) ) :

    function hcode_single_post_related_posts( $post_type = 'post', $number_posts = '3') {

        $args = $output = $title = '';
        $hcode_options = get_option( 'hcode_theme_setting' ); 
    
        $related_post_image_srcset  = !empty($hcode_options['related_post_image_srcset']) ? $hcode_options['related_post_image_srcset'] : 'full';

        $title = (isset($hcode_options['hcode_related_post_title'])) ? $hcode_options['hcode_related_post_title'] : '';
        $enable_excerpt = (isset($hcode_options['hcode_enable_related_posts_excerpt'])) ? $hcode_options['hcode_enable_related_posts_excerpt'] : '';
        $enable_title   = (isset($hcode_options['hcode_enable_related_posts_title'])) ? $hcode_options['hcode_enable_related_posts_title'] : '';
        $enable_author  = (isset($hcode_options['hcode_enable_related_posts_author'])) ? $hcode_options['hcode_enable_related_posts_author'] : '';
        $enable_date    = (isset($hcode_options['hcode_enable_related_posts_date'])) ? $hcode_options['hcode_enable_related_posts_date'] : '';
        $date_format    = (isset($hcode_options['hcode_related_posts_date_format'])) ? $hcode_options['hcode_related_posts_date_format'] : '';
        $enable_separator = (isset($hcode_options['hcode_enable_related_posts_separator'])) ? $hcode_options['hcode_enable_related_posts_separator'] : '';
        $enable_like    = (isset($hcode_options['hcode_enable_related_posts_like'])) ? $hcode_options['hcode_enable_related_posts_like'] : '';
        $enable_comments= (isset($hcode_options['hcode_enable_related_posts_comments'])) ? $hcode_options['hcode_enable_related_posts_comments'] : '';
        $excerpt_length = (isset($hcode_options['hcode_related_post_excerpt_length'])) ? $hcode_options['hcode_related_post_excerpt_length'] : '';

        $recent_post = new WP_Query();

        if( $number_posts == 0 ) {
            return $recent_post;
        }

        $args = array(
            'category__in'          => wp_get_post_categories( get_the_ID() ),
            'ignore_sticky_posts'   => 0,
            'posts_per_page'        => $number_posts,
            'post__not_in'          => array( get_the_ID() ),
        );

        $recent_post = new WP_Query( $args );
        if ( $recent_post->have_posts() ) {

            $style_setting = '';            
            $enable_comment = hcode_option( 'hcode_enable_post_comment' );

            if( $enable_comment == 1 ) {
                $style_setting = 'border-top xs-no-padding-bottom xs-padding-five-top';
            } else {
                $style_setting = 'xs-no-margin xs-no-padding';
            }
            
            echo '<section class="hcode-related-post-wrapper no-padding clear-both"><div class="container"><div class="row">';
            echo '<div class="wpb_column hcode-column-container col-md-12 no-padding"><div class="hcode-divider '.$style_setting.' margin-five-top padding-five-bottom"></div></div>';
            if( $title ) {
                echo '<div class="col-md-12 col-sm-12 center-col text-center margin-eight no-margin-top xs-padding-ten-top">';
                    echo '<h3 class="blog-single-full-width-h3">'.esc_html( $title ).'</h3>';
                echo '</div>';
            }
            echo '<div class="blog-grid-listing padding-ten-bottom col-md-12 col-sm-12 col-xs-12 no-padding">';
            $i=1;
            while ( $recent_post->have_posts() ) {

                // Added in v1.8
                $hcode_post_classes = $post_image_output = '';
                ob_start();
                    post_class();
                    $hcode_post_classes .= ob_get_contents();
                ob_end_clean();
                $wow_duration = ($i * 300).'ms';
                echo '<div '.$hcode_post_classes.'>';
                    echo '<div class="col-md-4 col-sm-4 col-xs-12 blog-listing no-margin-bottom xs-margin-bottom-ten wow fadeInUp" data-wow-duration="'.$wow_duration.'">';
                    $recent_post->the_post();

                        if ( has_post_thumbnail() ) {
                            $post_image_output .= get_the_post_thumbnail( get_the_ID(), $related_post_image_srcset );
                        } else {

                            $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
                            if( isset( $hcode_no_image['url'] ) && $hcode_no_image['url'] ) {
                                $post_image_output .= wp_get_attachment_image( $hcode_no_image['id'], $related_post_image_srcset );
                            } else {
                                $default_img = HCODE_THEME_ASSETS . '/images/no-image-374x234.jpg';
                                if( file_exists( $default_img ) ) {
                                    $post_image_output .= '<img src="'.HCODE_THEME_ASSETS_URI.'/images/no-image-374x234.jpg" width="374" height="234"  alt="'.esc_html__( 'No Image', 'H-Code' ).'" />';
                                }
                            }
                        }

                        if( $post_image_output ) {
                            echo'<div class="blog-image"><a href="'.get_permalink().'">'.$post_image_output.'</a></div>';
                        }
                        
                        echo'<div class="blog-details no-padding hcode-related-blog">';
                            if( $enable_author == 1 || $enable_date == 1 ) {
                                echo'<div class="blog-date">';
                                    if( $enable_author == 1 ) {
                                        echo esc_html__( 'Posted by ', 'H-Code' );
                                        echo '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span>';
                                    }
                                    if( $enable_date == 1 ) {
                                        echo ( $enable_author == 1 ? ' | ' : '' ).'<span class="published">'.get_the_date( $date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $date_format ).'</time>';
                                    }
                                echo'</div>';
                            }

                            if( $enable_title == 1 ) {
                                echo'<div class="blog-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                            }

                            if( $enable_excerpt == 1 ) {
                                echo'<div class="blog-short-description entry-content">'.hcode_get_the_excerpt_theme( $excerpt_length ).'</div>';
                            }

                            if( $enable_separator == 1 ) {
                                echo'<div class="separator-line bg-black no-margin-lr"></div>';
                            }
                            echo '<div class="related-post-bottom-wrapper">';
                            
                                if( $enable_like == 1 ) {
                                    echo get_simple_likes_button( get_the_ID() );
                                }

                                if( $enable_comments == 1 && ( comments_open() || get_comments_number() ) ) {
                                    ob_start();
                                        comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                        echo ob_get_contents();  
                                    ob_end_clean();
                                }
                            echo '</div>';
                        echo'</div>';
                    echo  '</div>';
                echo  '</div>';
                $i++;
            }
            wp_reset_postdata();
            echo  '</div>';
            echo '</div></div></section>';
        }
    }
endif;

/* Single Portfolio Related Items */
if ( ! function_exists( 'hcode_single_portfolio_related_posts' ) ) :

    function hcode_single_portfolio_related_posts( $post_type = 'portfolio', $number_posts = '3' ) {
        global $post;
        $args = $output = '';
        $related_post_terms = array();    
        $hcode_options = get_option( 'hcode_theme_setting' ); 
        
        $related_portfolio_image_srcset  = !empty( $hcode_options['related_portfolio_image_srcset'] ) ? $hcode_options['related_portfolio_image_srcset'] : 'full';
        $title = ( isset( $hcode_options['hcode_related_title'] ) ) ? $hcode_options['hcode_related_title'] : '';

        $recent_post = new WP_Query();

        if( $number_posts == 0 ) {
            return $recent_post;
        }
        
        $terms = get_the_terms( get_the_ID() , 'portfolio-category' );

        if( $terms ) {
            foreach ($terms as $key => $value) {
                $related_post_terms[] = $value->term_id;
            }
        }
        $args = array(
            'post_type' => $post_type,
            'posts_per_page' => $number_posts,        
            'post__not_in' => array( get_the_ID() ),
            'tax_query' => array(
                array(
                    'taxonomy' => 'portfolio-category',
                    'terms' => $related_post_terms,
                    'field' => 'term_id',
                ),
            ),
            'meta_query' => array(
                array(
                    'key'       => 'hcode_link_type_single',
                    'value'     => 'ajax-popup',
                    'compare'   => '!=',
                )
            )
        );

        $recent_post = new WP_Query( $args );

        if ( $recent_post->have_posts() ) {
            
            echo '<div class="wpb_column hcode-column-container col-md-12 no-padding"><div class="hcode-divider border-top sm-padding-five-top xs-padding-five-top padding-five-bottom"></div></div><section class="clear-both no-padding-top"><div class="container"><div class="row">';
            if( $title ) {
                echo '<div class="col-md-12 col-sm-12 text-center">';
                    echo '<h3 class="section-title">'.esc_html( $title ).'</h3>';
                echo '</div>';
            }
            echo '<div class="work-3col gutter work-with-title ipad-3col">';
                echo '<div class="col-md-12 grid-gallery overflow-hidden content-section">';
                    echo '<div class="tab-content">';
                        echo '<ul class="grid masonry-items">';
                    while ( $recent_post->have_posts() ) : $recent_post->the_post();
                        // Added in v1.8
                        $hcode_post_classes = '';
                        $hcode_post_class_list = array();
                        $hcode_post_class_list[] = 'portfolio-id-'.get_the_ID().'';
                        ob_start();
                            post_class( $hcode_post_class_list );
                            $hcode_post_classes .= ob_get_contents();
                        ob_end_clean();

                        echo '<li '.$hcode_post_classes.'>';
                            echo '<figure>';
                                $portfolio_subtitle = hcode_post_meta( 'hcode_subtitle' );
                                echo  '<div class="gallery-img">';
                                    echo  '<a href="'.get_permalink().'">';
                                        if ( has_post_thumbnail() ) {
                                            echo get_the_post_thumbnail( get_the_ID(), $related_portfolio_image_srcset );
                                        } else {
                                            $hcode_no_image = ( isset( $hcode_options['hcode_no_image'] ) ) ? $hcode_options['hcode_no_image'] : '';
                                            if( isset( $hcode_no_image['url'] ) && $hcode_no_image['url'] ) {
                                                echo wp_get_attachment_image( $hcode_no_image['id'], $related_portfolio_image_srcset );
                                            } else {
                                                $default_img = HCODE_THEME_ASSETS . '/images/no-image-374x234.jpg';
                                                if( file_exists( $default_img ) ) {
                                                    echo '<img src="' . HCODE_THEME_ASSETS_URI . '/images/no-image-374x234.jpg" width="374" height="234" alt="'.__( 'No Image', 'H-Code' ).'" />';
                                                }
                                            }                                                
                                        }
                                    echo '</a>';
                                echo '</div>';
                                if( get_the_title() || $portfolio_subtitle ) {
                                    echo '<figcaption>';
                                        echo '<h3 class="entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                                        echo '<p>'.esc_html( $portfolio_subtitle ).'</p>';
                                    echo '</figcaption>';
                                }
                            echo '</figure>';
                        echo '</li>';
                    endwhile;
                    wp_reset_postdata();
                        echo '</ul>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
            echo '</div></div></section>';
        }
    }
endif;

if ( ! function_exists( 'hcode_posts_customize' ) ) {
    function hcode_posts_customize($query) {
        $hcode_options = get_option( 'hcode_theme_setting' );
        if( !is_admin() && $query->is_main_query()):
            if( class_exists( 'WooCommerce' ) && ( is_product_category() || is_product_tag() || is_tax( 'product_brand' ) || $query->is_post_type_archive( 'product' ) || is_product_taxonomy() ) ) {
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = ''; }
                $hcode_item_per_page = (isset($hcode_options['hcode_category_product_per_page'])) ? $hcode_options['hcode_category_product_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
            } elseif(is_tax('portfolio-category') || is_post_type_archive('portfolio')) {
                $hcode_item_per_page = (isset($hcode_options['hcode_portfolio_cat_item_per_page'])) ? $hcode_options['hcode_portfolio_cat_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
            } elseif ((is_category() || is_archive() || is_author() || is_tag())) {
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
                $hcode_item_per_page = (isset($hcode_options['hcode_general_item_per_page'])) ? $hcode_options['hcode_general_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
            } elseif(is_search()) {
                $search_content_slug = array();
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } elseif ( get_query_var('page') ) { $paged = get_query_var('page'); } else { $paged = 1; }
                $hcode_item_per_page = (isset($hcode_options['hcode_general_item_per_page'])) ? $hcode_options['hcode_general_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
                $search_content = (isset($hcode_options['hcode_general_search_content_settings'])) ? $hcode_options['hcode_general_search_content_settings'] : '';
                if( $search_content ){
                    foreach ( $search_content as $key => $value ) {
                        if (strpos( $value, 'only-' ) === 0 ) {
                            $search_content_slug[] = str_replace('only-', '', $value);   
                        }else{
                            $search_content_slug[] = $value;
                        }
                    }
                }
                
                if( !empty($search_content_slug)){
                    $query->set('post_type', $search_content_slug);
                }
            }elseif( is_home() ){
                if ( get_query_var('paged') ) { $paged = get_query_var('paged'); } else if ( get_query_var('page') ) {$paged = get_query_var('page'); } else {$paged = 1; }
                $hcode_item_per_page = (isset($hcode_options['hcode_blog_page_item_per_page'])) ? $hcode_options['hcode_blog_page_item_per_page'] : '';
                $query->set('posts_per_page', $hcode_item_per_page);
                $query->set('paged', $paged);
            }

        endif;
    }
}
add_action('pre_get_posts', 'hcode_posts_customize');

if ( ! function_exists( 'hcode_get_the_excerpt_theme' ) ) {

    function hcode_get_the_excerpt_theme( $length ) {
        return hcode_Excerpt::hcode_get_by_length( $length );
    }
}

if ( ! function_exists( 'hcode_get_the_post_content' ) ) {
    function hcode_get_the_post_content() {
        return apply_filters( 'the_content', get_the_content() );
    }
}

if ( ! function_exists( 'hcode_widgets' ) ) {
    function hcode_widgets() {
        $custom_sidebars = hcode_option('sidebar_creation');
        if (is_array($custom_sidebars)) {
            foreach ($custom_sidebars as $sidebar) {

                if (empty($sidebar)) {
                    continue;
                }

                register_sidebar ( array (
                    'name' => $sidebar,
                    'id' => sanitize_title ( $sidebar ),
                    'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                    'after_widget' => '</div>',
                    'before_title'  => '<h5 class="sidebar-title widget-title">',
                    'after_title'   => '</h5><div class="thin-separator-line bg-dark-gray no-margin-lr margin-tb-20px"></div>',
                ) );
            }
        }
    }
}
add_action( 'widgets_init', 'hcode_widgets' );

/* For contact Form 7 select default */
if ( ! function_exists( 'hcode_wpcf7_form_elements' ) ) {
    function hcode_wpcf7_form_elements($html) {
        $text = __("Select Position", "H-Code");
        $html = str_replace('---', '' . $text . '', $html);
        return $html;
    }
}
add_filter('wpcf7_form_elements', 'hcode_wpcf7_form_elements');

/* For Wordpress4.4 move comment textarea bottom */
if ( ! function_exists( 'hcode_move_comment_field_to_bottom' ) ) {
    function hcode_move_comment_field_to_bottom( $fields ) {

        if( class_exists( 'WooCommerce' ) && is_product() ) {
            $comment_field = $fields['comment'];
            unset( $fields['comment'] );
            $fields['comment'] = $comment_field;
        } else {
            $comment_field = $fields['comment'];
            $cookies = $fields['cookies'];
            unset( $fields['comment'] );
            unset( $fields['cookies'] );
            $fields['comment'] = $comment_field;
            $fields['cookies'] = $cookies;
        }
        return $fields;
    }
}
add_filter( 'comment_form_fields', 'hcode_move_comment_field_to_bottom' );

if ( ! function_exists( 'hcode_get_sidebar' ) ) {
    function hcode_get_sidebar( $sidebar_name="0" ){
        if( $sidebar_name != "0" ) {
            dynamic_sidebar( $sidebar_name );
        } else {
            dynamic_sidebar( 'hcode-sidebar-1' );
        }
    }
}

/* Hook For ajax page */
if ( ! function_exists( 'hcode_hook_for_ajax_page' ) ) {
    function hcode_hook_for_ajax_page() {
        
        echo "<script>
        ( function( $ ) {
        'use strict';
            
            var isMobile = false;
            var isiPhoneiPad = false;
            
            if (/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini/i.test(navigator.userAgent)) {
                isMobile = true;
            }
            if (/iPhone|iPad|iPod/i.test(navigator.userAgent)) {
                isiPhoneiPad = true;
            }
            $(document).ready(function () {
                $('.owl-dots > .owl-dot').click(function (e) {
                    if ($(e.target).is('.mfp-close')){
                        return;
                    }else{
                        $(this).trigger('to.owl.carousel', [$(this).index(), 300]);
                        return false;
                    }
                });
                $('.owl-nav > .owl-prev').click(function (e) {
                    console.log(e.target);
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });
                $('.owl-nav > .owl-next').click(function (e) {
                    if ($(e.target).is('.mfp-close'))
                        return;
                    return false;
                });

                $('.masonry-items').imagesLoaded(function () {
                    $('.masonry-items').isotope({
                        itemSelector: 'li',
                        layoutMode: 'masonry'
                    });
                });
                SetResizeContent();
                SetResizeHeaderMenu();

                if( !isiPhoneiPad || !isMobile ) {
                    $('[data-hover=dropdown]').dropdownHover();
                }
            });

            function SetResizeHeaderMenu() {
                var width = $('nav.navbar').children('div.container').width();
                $('ul.mega-menu-full').each(function () {
                    $(this).css('width', width + 'px');
                });
            }
            function SetResizeContent() {
                var minheight = $(window).height();
                var minwidth = $(window).width();
                $('.full-screen').css('min-height', minheight);
                $('.menu-first-level').each(function () {
                    $(this).find('ul.collapse').removeClass('in');
                    var menu_link = $(this).children('a');
                    var dataurl = menu_link.attr('data-redirect-url');
                    var datadefaulturl = menu_link.attr('data-default-url');
                    if (minwidth >= 992) {
                        $(menu_link).removeAttr('data-toggle');
                        $(this).children('a').attr('href', dataurl);
                    } else {
                        $(menu_link).attr('data-toggle', 'collapse');
                        $(this).children('a').attr('href', datadefaulturl);
                    }
                });
            }
            $(window).resize(function () {
                setTimeout(function () {
                    SetResizeHeaderMenu();
                    SetResizeContent();
                }, 200);
            });

        })( jQuery );
        </script>";

    }
}

/* If Font Icon Not Available add from here */
if ( ! function_exists( 'hcode_fontawesome_icons_solid' ) ) :
    function hcode_fontawesome_icons_solid() {
        $fa_icons_solid = array( 'fa-ad', 'fa-address-book', 'fa-address-card', 'fa-adjust', 'fa-air-freshener', 'fa-align-center', 'fa-align-justify', 'fa-align-left', 'fa-align-right', 'fa-allergies', 'fa-ambulance', 'fa-american-sign-language-interpreting', 'fa-anchor', 'fa-angle-double-down', 'fa-angle-double-left', 'fa-angle-double-right', 'fa-angle-double-up', 'fa-angle-down', 'fa-angle-left', 'fa-angle-right', 'fa-angle-up', 'fa-angry', 'fa-ankh', 'fa-apple-alt', 'fa-archive', 'fa-archway', 'fa-arrow-alt-circle-down', 'fa-arrow-alt-circle-left', 'fa-arrow-alt-circle-right', 'fa-arrow-alt-circle-up', 'fa-arrow-circle-down', 'fa-arrow-circle-left', 'fa-arrow-circle-right', 'fa-arrow-circle-up', 'fa-arrow-down', 'fa-arrow-left', 'fa-arrow-right', 'fa-arrow-up', 'fa-arrows-alt', 'fa-arrows-alt-h', 'fa-arrows-alt-v', 'fa-assistive-listening-systems', 'fa-asterisk', 'fa-at', 'fa-atlas', 'fa-atom', 'fa-audio-description', 'fa-award', 'fa-baby', 'fa-baby-carriage', 'fa-backspace', 'fa-backward', 'fa-bacon', 'fa-bacteria', 'fa-bacterium', 'fa-bahai', 'fa-balance-scale', 'fa-balance-scale-left', 'fa-balance-scale-right', 'fa-ban', 'fa-band-aid', 'fa-barcode', 'fa-bars', 'fa-baseball-ball', 'fa-basketball-ball', 'fa-bath', 'fa-battery-empty', 'fa-battery-full', 'fa-battery-half', 'fa-battery-quarter', 'fa-battery-three-quarters', 'fa-bed', 'fa-beer', 'fa-bell', 'fa-bell-slash', 'fa-bezier-curve', 'fa-bible', 'fa-bicycle', 'fa-biking', 'fa-binoculars', 'fa-biohazard', 'fa-birthday-cake', 'fa-blender', 'fa-blender-phone', 'fa-blind', 'fa-blog', 'fa-bold', 'fa-bolt', 'fa-bomb', 'fa-bone', 'fa-bong', 'fa-book', 'fa-book-dead', 'fa-book-medical', 'fa-book-open', 'fa-book-reader', 'fa-bookmark', 'fa-border-all', 'fa-border-none', 'fa-border-style', 'fa-bowling-ball', 'fa-box', 'fa-box-open', 'fa-box-tissue', 'fa-boxes', 'fa-braille', 'fa-brain', 'fa-bread-slice', 'fa-briefcase', 'fa-briefcase-medical', 'fa-broadcast-tower', 'fa-broom', 'fa-brush', 'fa-bug', 'fa-building', 'fa-bullhorn', 'fa-bullseye', 'fa-burn', 'fa-bus', 'fa-bus-alt', 'fa-business-time', 'fa-calculator', 'fa-calendar', 'fa-calendar-alt', 'fa-calendar-check', 'fa-calendar-day', 'fa-calendar-minus', 'fa-calendar-plus', 'fa-calendar-times', 'fa-calendar-week', 'fa-camera', 'fa-camera-retro', 'fa-campground', 'fa-candy-cane', 'fa-cannabis', 'fa-capsules', 'fa-car', 'fa-car-alt', 'fa-car-battery', 'fa-car-crash', 'fa-car-side', 'fa-caravan', 'fa-caret-down', 'fa-caret-left', 'fa-caret-right', 'fa-caret-square-down', 'fa-caret-square-left', 'fa-caret-square-right', 'fa-caret-square-up', 'fa-caret-up', 'fa-carrot', 'fa-cart-arrow-down', 'fa-cart-plus', 'fa-cash-register', 'fa-cat', 'fa-certificate', 'fa-chair', 'fa-chalkboard', 'fa-chalkboard-teacher', 'fa-charging-station', 'fa-chart-area', 'fa-chart-bar', 'fa-chart-line', 'fa-chart-pie', 'fa-check', 'fa-check-circle', 'fa-check-double', 'fa-check-square', 'fa-cheese', 'fa-chess', 'fa-chess-bishop', 'fa-chess-board', 'fa-chess-king', 'fa-chess-knight', 'fa-chess-pawn', 'fa-chess-queen', 'fa-chess-rook', 'fa-chevron-circle-down', 'fa-chevron-circle-left', 'fa-chevron-circle-right', 'fa-chevron-circle-up', 'fa-chevron-down', 'fa-chevron-left', 'fa-chevron-right', 'fa-chevron-up', 'fa-child', 'fa-church', 'fa-circle', 'fa-circle-notch', 'fa-city', 'fa-clinic-medical', 'fa-clipboard', 'fa-clipboard-check', 'fa-clipboard-list', 'fa-clock', 'fa-clone', 'fa-closed-captioning', 'fa-cloud', 'fa-cloud-download-alt', 'fa-cloud-meatball', 'fa-cloud-moon', 'fa-cloud-moon-rain', 'fa-cloud-rain', 'fa-cloud-showers-heavy', 'fa-cloud-sun', 'fa-cloud-sun-rain', 'fa-cloud-upload-alt', 'fa-cocktail', 'fa-code', 'fa-code-branch', 'fa-coffee', 'fa-cog', 'fa-cogs', 'fa-coins', 'fa-columns', 'fa-comment', 'fa-comment-alt', 'fa-comment-dollar', 'fa-comment-dots', 'fa-comment-medical', 'fa-comment-slash', 'fa-comments', 'fa-comments-dollar', 'fa-compact-disc', 'fa-compass', 'fa-compress', 'fa-compress-alt', 'fa-compress-arrows-alt', 'fa-concierge-bell', 'fa-cookie', 'fa-cookie-bite', 'fa-copy', 'fa-copyright', 'fa-couch', 'fa-credit-card', 'fa-crop', 'fa-crop-alt', 'fa-cross', 'fa-crosshairs', 'fa-crow', 'fa-crown', 'fa-crutch', 'fa-cube', 'fa-cubes', 'fa-cut', 'fa-database', 'fa-deaf', 'fa-democrat', 'fa-desktop', 'fa-dharmachakra', 'fa-diagnoses', 'fa-dice', 'fa-dice-d20', 'fa-dice-d6', 'fa-dice-five', 'fa-dice-four', 'fa-dice-one', 'fa-dice-six', 'fa-dice-three', 'fa-dice-two', 'fa-digital-tachograph', 'fa-directions', 'fa-disease', 'fa-divide', 'fa-dizzy', 'fa-dna', 'fa-dog', 'fa-dollar-sign', 'fa-dolly', 'fa-dolly-flatbed', 'fa-donate', 'fa-door-closed', 'fa-door-open', 'fa-dot-circle', 'fa-dove', 'fa-download', 'fa-drafting-compass', 'fa-dragon', 'fa-draw-polygon', 'fa-drum', 'fa-drum-steelpan', 'fa-drumstick-bite', 'fa-dumbbell', 'fa-dumpster', 'fa-dumpster-fire', 'fa-dungeon', 'fa-edit', 'fa-egg', 'fa-eject', 'fa-ellipsis-h', 'fa-ellipsis-v', 'fa-envelope', 'fa-envelope-open', 'fa-envelope-open-text', 'fa-envelope-square', 'fa-equals', 'fa-eraser', 'fa-ethernet', 'fa-euro-sign', 'fa-exchange-alt', 'fa-exclamation', 'fa-exclamation-circle', 'fa-exclamation-triangle', 'fa-expand', 'fa-expand-alt', 'fa-expand-arrows-alt', 'fa-external-link-alt', 'fa-external-link-square-alt', 'fa-eye', 'fa-eye-dropper', 'fa-eye-slash', 'fa-fan', 'fa-fast-backward', 'fa-fast-forward', 'fa-faucet', 'fa-fax', 'fa-feather', 'fa-feather-alt', 'fa-female', 'fa-fighter-jet', 'fa-file', 'fa-file-alt', 'fa-file-archive', 'fa-file-audio', 'fa-file-code', 'fa-file-contract', 'fa-file-csv', 'fa-file-download', 'fa-file-excel', 'fa-file-export', 'fa-file-image', 'fa-file-import', 'fa-file-invoice', 'fa-file-invoice-dollar', 'fa-file-medical', 'fa-file-medical-alt', 'fa-file-pdf', 'fa-file-powerpoint', 'fa-file-prescription', 'fa-file-signature', 'fa-file-upload', 'fa-file-video', 'fa-file-word', 'fa-fill', 'fa-fill-drip', 'fa-film', 'fa-filter', 'fa-fingerprint', 'fa-fire', 'fa-fire-alt', 'fa-fire-extinguisher', 'fa-first-aid', 'fa-fish', 'fa-fist-raised', 'fa-flag', 'fa-flag-checkered', 'fa-flag-usa', 'fa-flask', 'fa-flushed', 'fa-folder', 'fa-folder-minus', 'fa-folder-open', 'fa-folder-plus', 'fa-font', 'fa-football-ball', 'fa-forward', 'fa-frog', 'fa-frown', 'fa-frown-open', 'fa-funnel-dollar', 'fa-futbol', 'fa-gamepad', 'fa-gas-pump', 'fa-gavel', 'fa-gem', 'fa-genderless', 'fa-ghost', 'fa-gift', 'fa-gifts', 'fa-glass-cheers', 'fa-glass-martini', 'fa-glass-martini-alt', 'fa-glass-whiskey', 'fa-glasses', 'fa-globe', 'fa-globe-africa', 'fa-globe-americas', 'fa-globe-asia', 'fa-globe-europe', 'fa-golf-ball', 'fa-gopuram', 'fa-graduation-cap', 'fa-greater-than', 'fa-greater-than-equal', 'fa-grimace', 'fa-grin', 'fa-grin-alt', 'fa-grin-beam', 'fa-grin-beam-sweat', 'fa-grin-hearts', 'fa-grin-squint', 'fa-grin-squint-tears', 'fa-grin-stars', 'fa-grin-tears', 'fa-grin-tongue', 'fa-grin-tongue-squint', 'fa-grin-tongue-wink', 'fa-grin-wink', 'fa-grip-horizontal', 'fa-grip-lines', 'fa-grip-lines-vertical', 'fa-grip-vertical', 'fa-guitar', 'fa-h-square', 'fa-hamburger', 'fa-hammer', 'fa-hamsa', 'fa-hand-holding', 'fa-hand-holding-heart', 'fa-hand-holding-medical', 'fa-hand-holding-usd', 'fa-hand-holding-water', 'fa-hand-lizard', 'fa-hand-middle-finger', 'fa-hand-paper', 'fa-hand-peace', 'fa-hand-point-down', 'fa-hand-point-left', 'fa-hand-point-right', 'fa-hand-point-up', 'fa-hand-pointer', 'fa-hand-rock', 'fa-hand-scissors', 'fa-hand-sparkles', 'fa-hand-spock', 'fa-hands', 'fa-hands-helping', 'fa-hands-wash', 'fa-handshake', 'fa-handshake-alt-slash', 'fa-handshake-slash', 'fa-hanukiah', 'fa-hard-hat', 'fa-hashtag', 'fa-hat-cowboy', 'fa-hat-cowboy-side', 'fa-hat-wizard', 'fa-hdd', 'fa-head-side-cough', 'fa-head-side-cough-slash', 'fa-head-side-mask', 'fa-head-side-virus', 'fa-heading', 'fa-headphones', 'fa-headphones-alt', 'fa-headset', 'fa-heart', 'fa-heart-broken', 'fa-heartbeat', 'fa-helicopter', 'fa-highlighter', 'fa-hiking', 'fa-hippo', 'fa-history', 'fa-hockey-puck', 'fa-holly-berry', 'fa-home', 'fa-horse', 'fa-horse-head', 'fa-hospital', 'fa-hospital-alt', 'fa-hospital-symbol', 'fa-hospital-user', 'fa-hot-tub', 'fa-hotdog', 'fa-hotel', 'fa-hourglass', 'fa-hourglass-end', 'fa-hourglass-half', 'fa-hourglass-start', 'fa-house-damage', 'fa-house-user', 'fa-hryvnia', 'fa-i-cursor', 'fa-ice-cream', 'fa-icicles', 'fa-icons', 'fa-id-badge', 'fa-id-card', 'fa-id-card-alt', 'fa-igloo', 'fa-image', 'fa-images', 'fa-inbox', 'fa-indent', 'fa-industry', 'fa-infinity', 'fa-info', 'fa-info-circle', 'fa-italic', 'fa-jedi', 'fa-joint', 'fa-journal-whills', 'fa-kaaba', 'fa-key', 'fa-keyboard', 'fa-khanda', 'fa-kiss', 'fa-kiss-beam', 'fa-kiss-wink-heart', 'fa-kiwi-bird', 'fa-landmark', 'fa-language', 'fa-laptop', 'fa-laptop-code', 'fa-laptop-house', 'fa-laptop-medical', 'fa-laugh', 'fa-laugh-beam', 'fa-laugh-squint', 'fa-laugh-wink', 'fa-layer-group', 'fa-leaf', 'fa-lemon', 'fa-less-than', 'fa-less-than-equal', 'fa-level-down-alt', 'fa-level-up-alt', 'fa-life-ring', 'fa-lightbulb', 'fa-link', 'fa-lira-sign', 'fa-list', 'fa-list-alt', 'fa-list-ol', 'fa-list-ul', 'fa-location-arrow', 'fa-lock', 'fa-lock-open', 'fa-long-arrow-alt-down', 'fa-long-arrow-alt-left', 'fa-long-arrow-alt-right', 'fa-long-arrow-alt-up', 'fa-low-vision', 'fa-luggage-cart', 'fa-lungs', 'fa-lungs-virus', 'fa-magic', 'fa-magnet', 'fa-mail-bulk', 'fa-male', 'fa-map', 'fa-map-marked', 'fa-map-marked-alt', 'fa-map-marker', 'fa-map-marker-alt', 'fa-map-pin', 'fa-map-signs', 'fa-marker', 'fa-mars', 'fa-mars-double', 'fa-mars-stroke', 'fa-mars-stroke-h', 'fa-mars-stroke-v', 'fa-mask', 'fa-medal', 'fa-medkit', 'fa-meh', 'fa-meh-blank', 'fa-meh-rolling-eyes', 'fa-memory', 'fa-menorah', 'fa-mercury', 'fa-meteor', 'fa-microchip', 'fa-microphone', 'fa-microphone-alt', 'fa-microphone-alt-slash', 'fa-microphone-slash', 'fa-microscope', 'fa-minus', 'fa-minus-circle', 'fa-minus-square', 'fa-mitten', 'fa-mobile', 'fa-mobile-alt', 'fa-money-bill', 'fa-money-bill-alt', 'fa-money-bill-wave', 'fa-money-bill-wave-alt', 'fa-money-check', 'fa-money-check-alt', 'fa-monument', 'fa-moon', 'fa-mortar-pestle', 'fa-mosque', 'fa-motorcycle', 'fa-mountain', 'fa-mouse', 'fa-mouse-pointer', 'fa-mug-hot', 'fa-music', 'fa-network-wired', 'fa-neuter', 'fa-newspaper', 'fa-not-equal', 'fa-notes-medical', 'fa-object-group', 'fa-object-ungroup', 'fa-oil-can', 'fa-om', 'fa-otter', 'fa-outdent', 'fa-pager', 'fa-paint-brush', 'fa-paint-roller', 'fa-palette', 'fa-pallet', 'fa-paper-plane', 'fa-paperclip', 'fa-parachute-box', 'fa-paragraph', 'fa-parking', 'fa-passport', 'fa-pastafarianism', 'fa-paste', 'fa-pause', 'fa-pause-circle', 'fa-paw', 'fa-peace', 'fa-pen', 'fa-pen-alt', 'fa-pen-fancy', 'fa-pen-nib', 'fa-pen-square', 'fa-pencil-alt', 'fa-pencil-ruler', 'fa-people-arrows', 'fa-people-carry', 'fa-pepper-hot', 'fa-percent', 'fa-percentage', 'fa-person-booth', 'fa-phone', 'fa-phone-alt', 'fa-phone-slash', 'fa-phone-square', 'fa-phone-square-alt', 'fa-phone-volume', 'fa-photo-video', 'fa-piggy-bank', 'fa-pills', 'fa-pizza-slice', 'fa-place-of-worship', 'fa-plane', 'fa-plane-arrival', 'fa-plane-departure', 'fa-plane-slash', 'fa-play', 'fa-play-circle', 'fa-plug', 'fa-plus', 'fa-plus-circle', 'fa-plus-square', 'fa-podcast', 'fa-poll', 'fa-poll-h', 'fa-poo', 'fa-poo-storm', 'fa-poop', 'fa-portrait', 'fa-pound-sign', 'fa-power-off', 'fa-pray', 'fa-praying-hands', 'fa-prescription', 'fa-prescription-bottle', 'fa-prescription-bottle-alt', 'fa-print', 'fa-procedures', 'fa-project-diagram', 'fa-pump-medical', 'fa-pump-soap', 'fa-puzzle-piece', 'fa-qrcode', 'fa-question', 'fa-question-circle', 'fa-quidditch', 'fa-quote-left', 'fa-quote-right', 'fa-quran', 'fa-radiation', 'fa-radiation-alt', 'fa-rainbow', 'fa-random', 'fa-receipt', 'fa-record-vinyl', 'fa-recycle', 'fa-redo', 'fa-redo-alt', 'fa-registered', 'fa-remove-format', 'fa-reply', 'fa-reply-all', 'fa-republican', 'fa-restroom', 'fa-retweet', 'fa-ribbon', 'fa-ring', 'fa-road', 'fa-robot', 'fa-rocket', 'fa-route', 'fa-rss', 'fa-rss-square', 'fa-ruble-sign', 'fa-ruler', 'fa-ruler-combined', 'fa-ruler-horizontal', 'fa-ruler-vertical', 'fa-running', 'fa-rupee-sign', 'fa-sad-cry', 'fa-sad-tear', 'fa-satellite', 'fa-satellite-dish', 'fa-save', 'fa-school', 'fa-screwdriver', 'fa-scroll', 'fa-sd-card', 'fa-search', 'fa-search-dollar', 'fa-search-location', 'fa-search-minus', 'fa-search-plus', 'fa-seedling', 'fa-server', 'fa-shapes', 'fa-share', 'fa-share-alt', 'fa-share-alt-square', 'fa-share-square', 'fa-shekel-sign', 'fa-shield-alt', 'fa-shield-virus', 'fa-ship', 'fa-shipping-fast', 'fa-shoe-prints', 'fa-shopping-bag', 'fa-shopping-basket', 'fa-shopping-cart', 'fa-shower', 'fa-shuttle-van', 'fa-sign', 'fa-sign-in-alt', 'fa-sign-language', 'fa-sign-out-alt', 'fa-signal', 'fa-signature', 'fa-sim-card', 'fa-sink', 'fa-sitemap', 'fa-skating', 'fa-skiing', 'fa-skiing-nordic', 'fa-skull', 'fa-skull-crossbones', 'fa-slash', 'fa-sleigh', 'fa-sliders-h', 'fa-smile', 'fa-smile-beam', 'fa-smile-wink', 'fa-smog', 'fa-smoking', 'fa-smoking-ban', 'fa-sms', 'fa-snowboarding', 'fa-snowflake', 'fa-snowman', 'fa-snowplow', 'fa-soap', 'fa-socks', 'fa-solar-panel', 'fa-sort', 'fa-sort-alpha-down', 'fa-sort-alpha-down-alt', 'fa-sort-alpha-up', 'fa-sort-alpha-up-alt', 'fa-sort-amount-down', 'fa-sort-amount-down-alt', 'fa-sort-amount-up', 'fa-sort-amount-up-alt', 'fa-sort-down', 'fa-sort-numeric-down', 'fa-sort-numeric-down-alt', 'fa-sort-numeric-up', 'fa-sort-numeric-up-alt', 'fa-sort-up', 'fa-spa', 'fa-space-shuttle', 'fa-spell-check', 'fa-spider', 'fa-spinner', 'fa-splotch', 'fa-spray-can', 'fa-square', 'fa-square-full', 'fa-square-root-alt', 'fa-stamp', 'fa-star', 'fa-star-and-crescent', 'fa-star-half', 'fa-star-half-alt', 'fa-star-of-david', 'fa-star-of-life', 'fa-step-backward', 'fa-step-forward', 'fa-stethoscope', 'fa-sticky-note', 'fa-stop', 'fa-stop-circle', 'fa-stopwatch', 'fa-stopwatch-20', 'fa-store', 'fa-store-alt', 'fa-store-alt-slash', 'fa-store-slash', 'fa-stream', 'fa-street-view', 'fa-strikethrough', 'fa-stroopwafel', 'fa-subscript', 'fa-subway', 'fa-suitcase', 'fa-suitcase-rolling', 'fa-sun', 'fa-superscript', 'fa-surprise', 'fa-swatchbook', 'fa-swimmer', 'fa-swimming-pool', 'fa-synagogue', 'fa-sync', 'fa-sync-alt', 'fa-syringe', 'fa-table', 'fa-table-tennis', 'fa-tablet', 'fa-tablet-alt', 'fa-tablets', 'fa-tachometer-alt', 'fa-tag', 'fa-tags', 'fa-tape', 'fa-tasks', 'fa-taxi', 'fa-teeth', 'fa-teeth-open', 'fa-temperature-high', 'fa-temperature-low', 'fa-tenge', 'fa-terminal', 'fa-text-height', 'fa-text-width', 'fa-th', 'fa-th-large', 'fa-th-list', 'fa-theater-masks', 'fa-thermometer', 'fa-thermometer-empty', 'fa-thermometer-full', 'fa-thermometer-half', 'fa-thermometer-quarter', 'fa-thermometer-three-quarters', 'fa-thumbs-down', 'fa-thumbs-up', 'fa-thumbtack', 'fa-ticket-alt', 'fa-times', 'fa-times-circle', 'fa-tint', 'fa-tint-slash', 'fa-tired', 'fa-toggle-off', 'fa-toggle-on', 'fa-toilet', 'fa-toilet-paper', 'fa-toilet-paper-slash', 'fa-toolbox', 'fa-tools', 'fa-tooth', 'fa-torah', 'fa-torii-gate', 'fa-tractor', 'fa-trademark', 'fa-traffic-light', 'fa-trailer', 'fa-train', 'fa-tram', 'fa-transgender', 'fa-transgender-alt', 'fa-trash', 'fa-trash-alt', 'fa-trash-restore', 'fa-trash-restore-alt', 'fa-tree', 'fa-trophy', 'fa-truck', 'fa-truck-loading', 'fa-truck-monster', 'fa-truck-moving', 'fa-truck-pickup', 'fa-tshirt', 'fa-tty', 'fa-tv', 'fa-umbrella', 'fa-umbrella-beach', 'fa-underline', 'fa-undo', 'fa-undo-alt', 'fa-universal-access', 'fa-university', 'fa-unlink', 'fa-unlock', 'fa-unlock-alt', 'fa-upload', 'fa-user', 'fa-user-alt', 'fa-user-alt-slash', 'fa-user-astronaut', 'fa-user-check', 'fa-user-circle', 'fa-user-clock', 'fa-user-cog', 'fa-user-edit', 'fa-user-friends', 'fa-user-graduate', 'fa-user-injured', 'fa-user-lock', 'fa-user-md', 'fa-user-minus', 'fa-user-ninja', 'fa-user-nurse', 'fa-user-plus', 'fa-user-secret', 'fa-user-shield', 'fa-user-slash', 'fa-user-tag', 'fa-user-tie', 'fa-user-times', 'fa-users', 'fa-users-cog', 'fa-users-slash', 'fa-utensil-spoon', 'fa-utensils', 'fa-vector-square', 'fa-venus', 'fa-venus-double', 'fa-venus-mars', 'fa-vest', 'fa-vest-patches', 'fa-vial', 'fa-vials', 'fa-video', 'fa-video-slash', 'fa-vihara', 'fa-virus', 'fa-virus-slash', 'fa-viruses', 'fa-voicemail', 'fa-volleyball-ball', 'fa-volume-down', 'fa-volume-mute', 'fa-volume-off', 'fa-volume-up', 'fa-vote-yea', 'fa-vr-cardboard', 'fa-walking', 'fa-wallet', 'fa-warehouse', 'fa-water', 'fa-wave-square', 'fa-weight', 'fa-weight-hanging', 'fa-wheelchair', 'fa-wifi', 'fa-wind', 'fa-window-close', 'fa-window-maximize', 'fa-window-minimize', 'fa-window-restore', 'fa-wine-bottle', 'fa-wine-glass', 'fa-wine-glass-alt', 'fa-won-sign', 'fa-wrench', 'fa-x-ray', 'fa-yen-sign', 'fa-yin-yang' );
        return $fa_icons_solid;
    }
endif;


if ( ! function_exists( 'hcode_fontawesome_icons_reg' ) ) :
    function hcode_fontawesome_icons_reg() {
        $fa_icons_reg = array( 'fa-address-book', 'fa-address-card', 'fa-angry', 'fa-arrow-alt-circle-down', 'fa-arrow-alt-circle-left', 'fa-arrow-alt-circle-right', 'fa-arrow-alt-circle-up', 'fa-bell', 'fa-bell-slash', 'fa-bookmark', 'fa-building', 'fa-calendar', 'fa-calendar-alt', 'fa-calendar-check', 'fa-calendar-minus', 'fa-calendar-plus', 'fa-calendar-times', 'fa-caret-square-down', 'fa-caret-square-left', 'fa-caret-square-right', 'fa-caret-square-up', 'fa-chart-bar', 'fa-check-circle', 'fa-check-square', 'fa-circle', 'fa-clipboard', 'fa-clock', 'fa-clone', 'fa-closed-captioning', 'fa-comment', 'fa-comment-alt', 'fa-comment-dots', 'fa-comments', 'fa-compass', 'fa-copy', 'fa-copyright', 'fa-credit-card', 'fa-dizzy', 'fa-dot-circle', 'fa-edit', 'fa-envelope', 'fa-envelope-open', 'fa-eye', 'fa-eye-slash', 'fa-file', 'fa-file-alt', 'fa-file-archive', 'fa-file-audio', 'fa-file-code', 'fa-file-excel', 'fa-file-image', 'fa-file-pdf', 'fa-file-powerpoint', 'fa-file-video', 'fa-file-word', 'fa-flag', 'fa-flushed', 'fa-folder', 'fa-folder-open', 'fa-frown', 'fa-frown-open', 'fa-futbol', 'fa-gem', 'fa-grimace', 'fa-grin', 'fa-grin-alt', 'fa-grin-beam', 'fa-grin-beam-sweat', 'fa-grin-hearts', 'fa-grin-squint', 'fa-grin-squint-tears', 'fa-grin-stars', 'fa-grin-tears', 'fa-grin-tongue', 'fa-grin-tongue-squint', 'fa-grin-tongue-wink', 'fa-grin-wink', 'fa-hand-lizard', 'fa-hand-paper', 'fa-hand-peace', 'fa-hand-point-down', 'fa-hand-point-left', 'fa-hand-point-right', 'fa-hand-point-up', 'fa-hand-pointer', 'fa-hand-rock', 'fa-hand-scissors', 'fa-hand-spock', 'fa-handshake', 'fa-hdd', 'fa-heart', 'fa-hospital', 'fa-hourglass', 'fa-id-badge', 'fa-id-card', 'fa-image', 'fa-images', 'fa-keyboard', 'fa-kiss', 'fa-kiss-beam', 'fa-kiss-wink-heart', 'fa-laugh', 'fa-laugh-beam', 'fa-laugh-squint', 'fa-laugh-wink', 'fa-lemon', 'fa-life-ring', 'fa-lightbulb', 'fa-list-alt', 'fa-map', 'fa-meh', 'fa-meh-blank', 'fa-meh-rolling-eyes', 'fa-minus-square', 'fa-money-bill-alt', 'fa-moon', 'fa-newspaper', 'fa-object-group', 'fa-object-ungroup', 'fa-paper-plane', 'fa-pause-circle', 'fa-play-circle', 'fa-plus-square', 'fa-question-circle', 'fa-registered', 'fa-sad-cry', 'fa-sad-tear', 'fa-save', 'fa-share-square', 'fa-smile', 'fa-smile-beam', 'fa-smile-wink', 'fa-snowflake', 'fa-square', 'fa-star', 'fa-star-half', 'fa-sticky-note', 'fa-stop-circle', 'fa-sun', 'fa-surprise', 'fa-thumbs-down', 'fa-thumbs-up', 'fa-times-circle', 'fa-tired', 'fa-trash-alt', 'fa-user', 'fa-user-circle', 'fa-window-close', 'fa-window-maximize', 'fa-window-minimize', 'fa-window-restore' );
        return $fa_icons_reg;
    }
endif;

if ( ! function_exists( 'hcode_fontawesome_icons_brand' ) ) :
    function hcode_fontawesome_icons_brand() {
        $fa_icons_brand = array( 'fa-500px' ,'fa-accessible-icon' ,'fa-accusoft' ,'fa-acquisitions-incorporated' ,'fa-adn' ,'fa-adversal' ,'fa-affiliatetheme' ,'fa-airbnb' ,'fa-algolia' ,'fa-alipay' ,'fa-amazon' ,'fa-amazon-pay' ,'fa-amilia' ,'fa-android' ,'fa-angellist' ,'fa-angrycreative' ,'fa-angular' ,'fa-app-store' ,'fa-app-store-ios' ,'fa-apper' ,'fa-apple' ,'fa-apple-pay' ,'fa-artstation' ,'fa-asymmetrik' ,'fa-atlassian' ,'fa-audible' ,'fa-autoprefixer' ,'fa-avianex' ,'fa-aviato' ,'fa-aws' ,'fa-bandcamp' ,'fa-battle-net' ,'fa-behance' ,'fa-behance-square' ,'fa-bimobject' ,'fa-bitbucket' ,'fa-bitcoin' ,'fa-bity' ,'fa-black-tie' ,'fa-blackberry' ,'fa-blogger' ,'fa-blogger-b' ,'fa-bluetooth' ,'fa-bluetooth-b' ,'fa-bootstrap' ,'fa-btc' ,'fa-buffer' ,'fa-buromobelexperte' ,'fa-buy-n-large' ,'fa-buysellads' ,'fa-canadian-maple-leaf' ,'fa-cc-amazon-pay' ,'fa-cc-amex' ,'fa-cc-apple-pay' ,'fa-cc-diners-club' ,'fa-cc-discover' ,'fa-cc-jcb' ,'fa-cc-mastercard' ,'fa-cc-paypal' ,'fa-cc-stripe' ,'fa-cc-visa' ,'fa-centercode' ,'fa-centos' ,'fa-chrome' ,'fa-chromecast' ,'fa-cloudflare' ,'fa-cloudscale' ,'fa-cloudsmith' ,'fa-cloudversify' ,'fa-codepen' ,'fa-codiepie' ,'fa-confluence' ,'fa-connectdevelop' ,'fa-contao' ,'fa-cotton-bureau' ,'fa-cpanel' ,'fa-creative-commons' ,'fa-creative-commons-by' ,'fa-creative-commons-nc' ,'fa-creative-commons-nc-eu' ,'fa-creative-commons-nc-jp' ,'fa-creative-commons-nd' ,'fa-creative-commons-pd' ,'fa-creative-commons-pd-alt' ,'fa-creative-commons-remix' ,'fa-creative-commons-sa' ,'fa-creative-commons-sampling' ,'fa-creative-commons-sampling-plus' ,'fa-creative-commons-share' ,'fa-creative-commons-zero' ,'fa-critical-role' ,'fa-css3' ,'fa-css3-alt' ,'fa-cuttlefish' ,'fa-d-and-d' ,'fa-d-and-d-beyond' ,'fa-dailymotion' ,'fa-dashcube' ,'fa-deezer' ,'fa-delicious' ,'fa-deploydog' ,'fa-deskpro' ,'fa-dev' ,'fa-deviantart' ,'fa-dhl' ,'fa-diaspora' ,'fa-digg' ,'fa-digital-ocean' ,'fa-discord' ,'fa-discourse' ,'fa-dochub' ,'fa-docker' ,'fa-draft2digital' ,'fa-dribbble' ,'fa-dribbble-square' ,'fa-dropbox' ,'fa-drupal' ,'fa-dyalog' ,'fa-earlybirds' ,'fa-ebay' ,'fa-edge' ,'fa-edge-legacy' ,'fa-elementor' ,'fa-ello' ,'fa-ember' ,'fa-empire' ,'fa-envira' ,'fa-erlang' ,'fa-ethereum' ,'fa-etsy' ,'fa-evernote' ,'fa-expeditedssl' ,'fa-facebook' ,'fa-facebook-f' ,'fa-facebook-messenger' ,'fa-facebook-square' ,'fa-fantasy-flight-games' ,'fa-fedex' ,'fa-fedora' ,'fa-figma' ,'fa-firefox' ,'fa-firefox-browser' ,'fa-first-order' ,'fa-first-order-alt' ,'fa-firstdraft' ,'fa-flickr' ,'fa-flipboard' ,'fa-fly' ,'fa-font-awesome' ,'fa-font-awesome-alt' ,'fa-font-awesome-flag' ,'fa-fonticons' ,'fa-fonticons-fi' ,'fa-fort-awesome' ,'fa-fort-awesome-alt' ,'fa-forumbee' ,'fa-foursquare' ,'fa-free-code-camp' ,'fa-freebsd' ,'fa-fulcrum' ,'fa-galactic-republic' ,'fa-galactic-senate' ,'fa-get-pocket' ,'fa-gg' ,'fa-gg-circle' ,'fa-git' ,'fa-git-alt' ,'fa-git-square' ,'fa-github' ,'fa-github-alt' ,'fa-github-square' ,'fa-gitkraken' ,'fa-gitlab' ,'fa-gitter' ,'fa-glide' ,'fa-glide-g' ,'fa-gofore' ,'fa-goodreads' ,'fa-goodreads-g' ,'fa-google' ,'fa-google-drive' ,'fa-google-pay' ,'fa-google-play' ,'fa-google-plus' ,'fa-google-plus-g' ,'fa-google-plus-square' ,'fa-google-wallet' ,'fa-gratipay' ,'fa-grav' ,'fa-gripfire' ,'fa-grunt' ,'fa-guilded' ,'fa-gulp' ,'fa-hacker-news' ,'fa-hacker-news-square' ,'fa-hackerrank' ,'fa-hips' ,'fa-hire-a-helper' ,'fa-hive' ,'fa-hooli' ,'fa-hornbill' ,'fa-hotjar' ,'fa-houzz' ,'fa-html5' ,'fa-hubspot' ,'fa-ideal' ,'fa-imdb' ,'fa-innosoft' ,'fa-instagram' ,'fa-instagram-square' ,'fa-instalod' ,'fa-intercom' ,'fa-internet-explorer' ,'fa-invision' ,'fa-ioxhost' ,'fa-itch-io' ,'fa-itunes' ,'fa-itunes-note' ,'fa-java' ,'fa-jedi-order' ,'fa-jenkins' ,'fa-jira' ,'fa-joget' ,'fa-joomla' ,'fa-js' ,'fa-js-square' ,'fa-jsfiddle' ,'fa-kaggle' ,'fa-keybase' ,'fa-keycdn' ,'fa-kickstarter' ,'fa-kickstarter-k' ,'fa-korvue' ,'fa-laravel' ,'fa-lastfm' ,'fa-lastfm-square' ,'fa-leanpub' ,'fa-less' ,'fa-line' ,'fa-linkedin' ,'fa-linkedin-in' ,'fa-linode' ,'fa-linux' ,'fa-lyft' ,'fa-magento' ,'fa-mailchimp' ,'fa-mandalorian' ,'fa-markdown' ,'fa-mastodon' ,'fa-maxcdn' ,'fa-mdb' ,'fa-medapps' ,'fa-medium' ,'fa-medium-m' ,'fa-medrt' ,'fa-meetup' ,'fa-megaport' ,'fa-mendeley' ,'fa-microblog' ,'fa-microsoft' ,'fa-mix' ,'fa-mixcloud' ,'fa-mixer' ,'fa-mizuni' ,'fa-modx' ,'fa-monero' ,'fa-napster' ,'fa-neos' ,'fa-nimblr' ,'fa-node' ,'fa-node-js' ,'fa-npm' ,'fa-ns8' ,'fa-nutritionix' ,'fa-octopus-deploy' ,'fa-odnoklassniki' ,'fa-odnoklassniki-square' ,'fa-old-republic' ,'fa-opencart' ,'fa-openid' ,'fa-opera' ,'fa-optin-monster' ,'fa-orcid' ,'fa-osi' ,'fa-page4' ,'fa-pagelines' ,'fa-palfed' ,'fa-patreon' ,'fa-paypal' ,'fa-penny-arcade' ,'fa-perbyte' ,'fa-periscope' ,'fa-phabricator' ,'fa-phoenix-framework' ,'fa-phoenix-squadron' ,'fa-php' ,'fa-pied-piper' ,'fa-pied-piper-alt' ,'fa-pied-piper-hat' ,'fa-pied-piper-pp' ,'fa-pied-piper-square' ,'fa-pinterest' ,'fa-pinterest-p' ,'fa-pinterest-square' ,'fa-playstation' ,'fa-product-hunt' ,'fa-pushed' ,'fa-python' ,'fa-qq' ,'fa-quinscape' ,'fa-quora' ,'fa-r-project' ,'fa-raspberry-pi' ,'fa-ravelry' ,'fa-react' ,'fa-reacteurope' ,'fa-readme' ,'fa-rebel' ,'fa-red-river' ,'fa-reddit' ,'fa-reddit-alien' ,'fa-reddit-square' ,'fa-redhat' ,'fa-renren' ,'fa-replyd' ,'fa-researchgate' ,'fa-resolving' ,'fa-rev' ,'fa-rocketchat' ,'fa-rockrms' ,'fa-rust' ,'fa-safari' ,'fa-salesforce' ,'fa-sass' ,'fa-schlix' ,'fa-scribd' ,'fa-searchengin' ,'fa-sellcast' ,'fa-sellsy' ,'fa-servicestack' ,'fa-shirtsinbulk' ,'fa-shopify' ,'fa-shopware' ,'fa-simplybuilt' ,'fa-sistrix' ,'fa-sith' ,'fa-sketch' ,'fa-skyatlas' ,'fa-skype' ,'fa-slack' ,'fa-slack-hash' ,'fa-slideshare' ,'fa-snapchat' ,'fa-snapchat-ghost' ,'fa-snapchat-square' ,'fa-soundcloud' ,'fa-sourcetree' ,'fa-speakap' ,'fa-speaker-deck' ,'fa-spotify' ,'fa-squarespace' ,'fa-stack-exchange' ,'fa-stack-overflow' ,'fa-stackpath' ,'fa-staylinked' ,'fa-steam' ,'fa-steam-square' ,'fa-steam-symbol' ,'fa-sticker-mule' ,'fa-strava' ,'fa-stripe' ,'fa-stripe-s' ,'fa-studiovinari' ,'fa-stumbleupon' ,'fa-stumbleupon-circle' ,'fa-superpowers' ,'fa-supple' ,'fa-suse' ,'fa-swift' ,'fa-symfony' ,'fa-teamspeak' ,'fa-telegram' ,'fa-telegram-plane' ,'fa-tencent-weibo' ,'fa-the-red-yeti' ,'fa-themeco' ,'fa-themeisle' ,'fa-think-peaks' ,'fa-tiktok' ,'fa-trade-federation' ,'fa-trello' ,'fa-tripadvisor' ,'fa-tumblr' ,'fa-tumblr-square' ,'fa-twitch' ,'fa-twitter' ,'fa-twitter-square' ,'fa-typo3' ,'fa-uber' ,'fa-ubuntu' ,'fa-uikit' ,'fa-umbraco' ,'fa-uncharted' ,'fa-uniregistry' ,'fa-unity' ,'fa-unsplash' ,'fa-untappd' ,'fa-ups' ,'fa-usb' ,'fa-usps' ,'fa-ussunnah' ,'fa-vaadin' ,'fa-viacoin' ,'fa-viadeo' ,'fa-viadeo-square' ,'fa-viber' ,'fa-vimeo' ,'fa-vimeo-square' ,'fa-vimeo-v' ,'fa-vine' ,'fa-vk' ,'fa-vnv' ,'fa-vuejs' ,'fa-watchman-monitoring' ,'fa-waze' ,'fa-weebly' ,'fa-weibo' ,'fa-weixin' ,'fa-whatsapp' ,'fa-whatsapp-square' ,'fa-whmcs' ,'fa-wikipedia-w' ,'fa-windows' ,'fa-wix' ,'fa-wizards-of-the-coast' ,'fa-wodu' ,'fa-wolf-pack-battalion' ,'fa-wordpress' ,'fa-wordpress-simple' ,'fa-wpbeginner' ,'fa-wpexplorer' ,'fa-wpforms' ,'fa-wpressr' ,'fa-xbox' ,'fa-xing' ,'fa-xing-square' ,'fa-y-combinator' ,'fa-yahoo' ,'fa-yammer' ,'fa-yandex' ,'fa-yandex-international' ,'fa-yarn' ,'fa-yelp' ,'fa-yoast' ,'fa-youtube' ,'fa-youtube-square' ,'fa-zhihu' );
        return $fa_icons_brand;
    }
endif;

if ( ! function_exists( 'hcode_fontawesome_icons_old' ) ) :
    function hcode_fontawesome_icons_old() {
        $fa_icon_old = array( 'fa-500px' => 'fab fa-500px','fa-address-book-o' => 'far fa-address-book','fa-address-card-o' => 'far fa-address-card','fa-adn' => 'fab fa-adn','fa-amazon' => 'fab fa-amazon','fa-android' => 'fab fa-android','fa-angellist' => 'fab fa-angellist','fa-apple' => 'fab fa-apple','fa-area-chart' => 'fas fa-chart-area','fa-arrow-circle-o-down' => 'far fa-arrow-alt-circle-down','fa-arrow-circle-o-left' => 'far fa-arrow-alt-circle-left','fa-arrow-circle-o-right' => 'far fa-arrow-alt-circle-right','fa-arrow-circle-o-up' => 'far fa-arrow-alt-circle-up','fa-arrows' => 'fas fa-arrows-alt','fa-arrows-alt' => 'fas fa-expand-arrows-alt','fa-arrows-h' => 'fas fa-arrows-alt-h','fa-arrows-v' => 'fas fa-arrows-alt-v','fa-asl-interpreting' => 'fas fa-american-sign-language-interpreting','fa-automobile' => 'fas fa-car','fa-bandcamp' => 'fab fa-bandcamp','fa-bank' => 'fas fa-university','fa-bar-chart' => 'far fa-chart-bar','fa-bar-chart-o' => 'far fa-chart-bar','fa-bathtub' => 'fas fa-bath','fa-battery' => 'fas fa-battery-full','fa-battery-0' => 'fas fa-battery-empty','fa-battery-1' => 'fas fa-battery-quarter','fa-battery-2' => 'fas fa-battery-half','fa-battery-3' => 'fas fa-battery-three-quarters','fa-battery-4' => 'fas fa-battery-full','fa-behance' => 'fab fa-behance','fa-behance-square' => 'fab fa-behance-square','fa-bell-o' => 'far fa-bell','fa-bell-slash-o' => 'far fa-bell-slash','fa-bitbucket' => 'fab fa-bitbucket','fa-bitbucket-square' => 'fab fa-bitbucket','fa-bitcoin' => 'fab fa-btc','fa-black-tie' => 'fab fa-black-tie','fa-bluetooth' => 'fab fa-bluetooth','fa-bluetooth-b' => 'fab fa-bluetooth-b','fa-bookmark-o' => 'far fa-bookmark','fa-btc' => 'fab fa-btc','fa-building-o' => 'far fa-building','fa-buysellads' => 'fab fa-buysellads','fa-cab' => 'fas fa-taxi','fa-calendar' => 'fas fa-calendar-alt','fa-calendar-check-o' => 'far fa-calendar-check','fa-calendar-minus-o' => 'far fa-calendar-minus','fa-calendar-o' => 'far fa-calendar','fa-calendar-plus-o' => 'far fa-calendar-plus','fa-calendar-times-o' => 'far fa-calendar-times','fa-caret-square-o-down' => 'far fa-caret-square-down','fa-caret-square-o-left' => 'far fa-caret-square-left','fa-caret-square-o-right' => 'far fa-caret-square-right','fa-caret-square-o-up' => 'far fa-caret-square-up','fa-cc' => 'far fa-closed-captioning','fa-cc-amex' => 'fab fa-cc-amex','fa-cc-diners-club' => 'fab fa-cc-diners-club','fa-cc-discover' => 'fab fa-cc-discover','fa-cc-jcb' => 'fab fa-cc-jcb','fa-cc-mastercard' => 'fab fa-cc-mastercard','fa-cc-paypal' => 'fab fa-cc-paypal','fa-cc-stripe' => 'fab fa-cc-stripe','fa-cc-visa' => 'fab fa-cc-visa','fa-chain' => 'fas fa-link','fa-chain-broken' => 'fas fa-unlink','fa-check-circle-o' => 'far fa-check-circle','fa-check-square-o' => 'far fa-check-square','fa-chrome' => 'fab fa-chrome','fa-circle-o' => 'far fa-circle','fa-circle-o-notch' => 'fas fa-circle-notch','fa-circle-thin' => 'far fa-circle','fa-clipboard' => 'far fa-clipboard','fa-clock-o' => 'far fa-clock','fa-clone' => 'far fa-clone','fa-close' => 'fas fa-times','fa-cloud-download' => 'fas fa-cloud-download-alt','fa-cloud-upload' => 'fas fa-cloud-upload-alt','fa-cny' => 'fas fa-yen-sign','fa-code-fork' => 'fas fa-code-branch','fa-codepen' => 'fab fa-codepen','fa-codiepie' => 'fab fa-codiepie','fa-comment-o' => 'far fa-comment','fa-commenting' => 'far fa-comment-dots','fa-commenting-o' => 'far fa-comment-dots','fa-comments-o' => 'far fa-comments','fa-compass' => 'far fa-compass','fa-connectdevelop' => 'fab fa-connectdevelop','fa-contao' => 'fab fa-contao','fa-copyright' => 'far fa-copyright','fa-creative-commons' => 'fab fa-creative-commons','fa-credit-card' => 'far fa-credit-card','fa-credit-card-alt' => 'fas fa-credit-card','fa-css3' => 'fab fa-css3','fa-cutlery' => 'fas fa-utensils','fa-dashboard' => 'fas fa-tachometer-alt','fa-dashcube' => 'fab fa-dashcube','fa-deafness' => 'fas fa-deaf','fa-dedent' => 'fas fa-outdent','fa-delicious' => 'fab fa-delicious','fa-deviantart' => 'fab fa-deviantart','fa-diamond' => 'far fa-gem','fa-digg' => 'fab fa-digg','fa-dollar' => 'fas fa-dollar-sign','fa-dot-circle-o' => 'far fa-dot-circle','fa-dribbble' => 'fab fa-dribbble','fa-drivers-license' => 'fas fa-id-card','fa-drivers-license-o' => 'far fa-id-card','fa-dropbox' => 'fab fa-dropbox','fa-drupal' => 'fab fa-drupal','fa-edge' => 'fab fa-edge','fa-eercast' => 'fab fa-sellcast','fa-empire' => 'fab fa-empire','fa-envelope-o' => 'far fa-envelope','fa-envelope-open-o' => 'far fa-envelope-open','fa-envira' => 'fab fa-envira','fa-etsy' => 'fab fa-etsy','fa-eur' => 'fas fa-euro-sign','fa-euro' => 'fas fa-euro-sign','fa-exchange' => 'fas fa-exchange-alt','fa-expeditedssl' => 'fab fa-expeditedssl','fa-external-link' => 'fas fa-external-link-alt','fa-external-link-square' => 'fas fa-external-link-square-alt','fa-eye' => 'far fa-eye','fa-eye-slash' => 'far fa-eye-slash','fa-eyedropper' => 'fas fa-eye-dropper','fa-fa' => 'fab fa-font-awesome','fa-facebook' => 'fab fa-facebook-f','fa-facebook-f' => 'fab fa-facebook-f','fa-facebook-official' => 'fab fa-facebook','fa-facebook-square' => 'fab fa-facebook-square','fa-feed' => 'fas fa-rss','fa-file-archive-o' => 'far fa-file-archive','fa-file-audio-o' => 'far fa-file-audio','fa-file-code-o' => 'far fa-file-code','fa-file-excel-o' => 'far fa-file-excel','fa-file-image-o' => 'far fa-file-image','fa-file-movie-o' => 'far fa-file-video','fa-file-o' => 'far fa-file','fa-file-pdf-o' => 'far fa-file-pdf','fa-file-photo-o' => 'far fa-file-image','fa-file-picture-o' => 'far fa-file-image','fa-file-powerpoint-o' => 'far fa-file-powerpoint','fa-file-sound-o' => 'far fa-file-audio','fa-file-text' => 'fas fa-file-alt','fa-file-text-o' => 'far fa-file-alt','fa-file-video-o' => 'far fa-file-video','fa-file-word-o' => 'far fa-file-word','fa-file-zip-o' => 'far fa-file-archive','fa-files-o' => 'far fa-copy','fa-firefox' => 'fab fa-firefox','fa-first-order' => 'fab fa-first-order','fa-flag-o' => 'far fa-flag','fa-flash' => 'fas fa-bolt','fa-flickr' => 'fab fa-flickr','fa-floppy-o' => 'far fa-save','fa-folder-o' => 'far fa-folder','fa-folder-open-o' => 'far fa-folder-open','fa-font-awesome' => 'fab fa-font-awesome','fa-fonticons' => 'fab fa-fonticons','fa-fort-awesome' => 'fab fa-fort-awesome','fa-forumbee' => 'fab fa-forumbee','fa-foursquare' => 'fab fa-foursquare','fa-free-code-camp' => 'fab fa-free-code-camp','fa-frown-o' => 'far fa-frown','fa-futbol-o' => 'far fa-futbol','fa-gbp' => 'fas fa-pound-sign','fa-ge' => 'fab fa-empire','fa-gear' => 'fas fa-cog','fa-gears' => 'fas fa-cogs','fa-get-pocket' => 'fab fa-get-pocket','fa-gg' => 'fab fa-gg','fa-gg-circle' => 'fab fa-gg-circle','fa-git' => 'fab fa-git','fa-git-square' => 'fab fa-git-square','fa-github' => 'fab fa-github','fa-github-alt' => 'fab fa-github-alt','fa-github-square' => 'fab fa-github-square','fa-gitlab' => 'fab fa-gitlab','fa-gittip' => 'fab fa-gratipay','fa-glass' => 'fas fa-glass-martini','fa-glide' => 'fab fa-glide','fa-glide-g' => 'fab fa-glide-g','fa-google' => 'fab fa-google','fa-google-plus' => 'fab fa-google-plus-g','fa-google-plus-circle' => 'fab fa-google-plus','fa-google-plus-official' => 'fab fa-google-plus','fa-google-plus-square' => 'fab fa-google-plus-square','fa-google-wallet' => 'fab fa-google-wallet','fa-gratipay' => 'fab fa-gratipay','fa-grav' => 'fab fa-grav','fa-group' => 'fas fa-users','fa-hacker-news' => 'fab fa-hacker-news','fa-hand-grab-o' => 'far fa-hand-rock','fa-hand-lizard-o' => 'far fa-hand-lizard','fa-hand-o-down' => 'far fa-hand-point-down','fa-hand-o-left' => 'far fa-hand-point-left','fa-hand-o-right' => 'far fa-hand-point-right','fa-hand-o-up' => 'far fa-hand-point-up','fa-hand-paper-o' => 'far fa-hand-paper','fa-hand-peace-o' => 'far fa-hand-peace','fa-hand-pointer-o' => 'far fa-hand-pointer','fa-hand-rock-o' => 'far fa-hand-rock','fa-hand-scissors-o' => 'far fa-hand-scissors','fa-hand-spock-o' => 'far fa-hand-spock','fa-hand-stop-o' => 'far fa-hand-paper','fa-handshake-o' => 'far fa-handshake','fa-hard-of-hearing' => 'fas fa-deaf','fa-hdd-o' => 'far fa-hdd','fa-header' => 'fas fa-heading','fa-heart-o' => 'far fa-heart','fa-hospital-o' => 'far fa-hospital','fa-hotel' => 'fas fa-bed','fa-hourglass-1' => 'fas fa-hourglass-start','fa-hourglass-2' => 'fas fa-hourglass-half','fa-hourglass-3' => 'fas fa-hourglass-end','fa-hourglass-o' => 'far fa-hourglass','fa-houzz' => 'fab fa-houzz','fa-html5' => 'fab fa-html5','fa-id-badge' => 'far fa-id-badge','fa-id-card-o' => 'far fa-id-card','fa-ils' => 'fas fa-shekel-sign','fa-image' => 'far fa-image','fa-imdb' => 'fab fa-imdb','fa-inr' => 'fas fa-rupee-sign','fa-instagram' => 'fab fa-instagram','fa-institution' => 'fas fa-university','fa-internet-explorer' => 'fab fa-internet-explorer','fa-intersex' => 'fas fa-transgender','fa-ioxhost' => 'fab fa-ioxhost','fa-joomla' => 'fab fa-joomla','fa-jpy' => 'fas fa-yen-sign','fa-jsfiddle' => 'fab fa-jsfiddle','fa-keyboard-o' => 'far fa-keyboard','fa-krw' => 'fas fa-won-sign','fa-lastfm' => 'fab fa-lastfm','fa-lastfm-square' => 'fab fa-lastfm-square','fa-leanpub' => 'fab fa-leanpub','fa-legal' => 'fas fa-gavel','fa-lemon-o' => 'far fa-lemon','fa-level-down' => 'fas fa-level-down-alt','fa-level-up' => 'fas fa-level-up-alt','fa-life-bouy' => 'far fa-life-ring','fa-life-buoy' => 'far fa-life-ring','fa-life-ring' => 'far fa-life-ring','fa-life-saver' => 'far fa-life-ring','fa-lightbulb-o' => 'far fa-lightbulb','fa-line-chart' => 'fas fa-chart-line','fa-linkedin' => 'fab fa-linkedin-in','fa-linkedin-square' => 'fab fa-linkedin','fa-linode' => 'fab fa-linode','fa-linux' => 'fab fa-linux','fa-list-alt' => 'far fa-list-alt','fa-long-arrow-down' => 'fas fa-long-arrow-alt-down','fa-long-arrow-left' => 'fas fa-long-arrow-alt-left','fa-long-arrow-right' => 'fas fa-long-arrow-alt-right','fa-long-arrow-up' => 'fas fa-long-arrow-alt-up','fa-mail-forward' => 'fas fa-share','fa-mail-reply' => 'fas fa-reply','fa-mail-reply-all' => 'fas fa-reply-all','fa-map-marker' => 'fas fa-map-marker-alt','fa-map-o' => 'far fa-map','fa-maxcdn' => 'fab fa-maxcdn','fa-meanpath' => 'fab fa-font-awesome','fa-medium' => 'fab fa-medium','fa-meetup' => 'fab fa-meetup','fa-meh-o' => 'far fa-meh','fa-minus-square-o' => 'far fa-minus-square','fa-mixcloud' => 'fab fa-mixcloud','fa-mobile' => 'fas fa-mobile-alt','fa-mobile-phone' => 'fas fa-mobile-alt','fa-modx' => 'fab fa-modx','fa-money' => 'far fa-money-bill-alt','fa-moon-o' => 'far fa-moon','fa-mortar-board' => 'fas fa-graduation-cap','fa-navicon' => 'fas fa-bars','fa-newspaper-o' => 'far fa-newspaper','fa-object-group' => 'far fa-object-group','fa-object-ungroup' => 'far fa-object-ungroup','fa-odnoklassniki' => 'fab fa-odnoklassniki','fa-odnoklassniki-square' => 'fab fa-odnoklassniki-square','fa-opencart' => 'fab fa-opencart','fa-openid' => 'fab fa-openid','fa-opera' => 'fab fa-opera','fa-optin-monster' => 'fab fa-optin-monster','fa-pagelines' => 'fab fa-pagelines','fa-paper-plane-o' => 'far fa-paper-plane','fa-paste' => 'far fa-clipboard','fa-pause-circle-o' => 'far fa-pause-circle','fa-paypal' => 'fab fa-paypal','fa-pencil' => 'fas fa-pencil-alt','fa-pencil-square' => 'fas fa-pen-square','fa-pencil-square-o' => 'far fa-edit','fa-photo' => 'far fa-image','fa-picture-o' => 'far fa-image','fa-pie-chart' => 'fas fa-chart-pie','fa-pied-piper' => 'fab fa-pied-piper','fa-pied-piper-alt' => 'fab fa-pied-piper-alt','fa-pied-piper-pp' => 'fab fa-pied-piper-pp','fa-pinterest' => 'fab fa-pinterest','fa-pinterest-p' => 'fab fa-pinterest-p','fa-pinterest-square' => 'fab fa-pinterest-square','fa-play-circle-o' => 'far fa-play-circle','fa-plus-square-o' => 'far fa-plus-square','fa-product-hunt' => 'fab fa-product-hunt','fa-qq' => 'fab fa-qq','fa-question-circle-o' => 'far fa-question-circle','fa-quora' => 'fab fa-quora','fa-ra' => 'fab fa-rebel','fa-ravelry' => 'fab fa-ravelry','fa-rebel' => 'fab fa-rebel','fa-reddit' => 'fab fa-reddit','fa-reddit-alien' => 'fab fa-reddit-alien','fa-reddit-square' => 'fab fa-reddit-square','fa-refresh' => 'fas fa-sync','fa-registered' => 'far fa-registered','fa-remove' => 'fas fa-times','fa-renren' => 'fab fa-renren','fa-reorder' => 'fas fa-bars','fa-repeat' => 'fas fa-redo','fa-resistance' => 'fab fa-rebel','fa-rmb' => 'fas fa-yen-sign','fa-rotate-left' => 'fas fa-undo','fa-rotate-right' => 'fas fa-redo','fa-rouble' => 'fas fa-ruble-sign','fa-rub' => 'fas fa-ruble-sign','fa-ruble' => 'fas fa-ruble-sign','fa-rupee' => 'fas fa-rupee-sign','fa-s15' => 'fas fa-bath','fa-safari' => 'fab fa-safari','fa-scissors' => 'fas fa-cut','fa-scribd' => 'fab fa-scribd','fa-sellsy' => 'fab fa-sellsy','fa-send' => 'fas fa-paper-plane','fa-send-o' => 'far fa-paper-plane','fa-share-square-o' => 'far fa-share-square','fa-shekel' => 'fas fa-shekel-sign','fa-sheqel' => 'fas fa-shekel-sign','fa-shield' => 'fas fa-shield-alt','fa-shirtsinbulk' => 'fab fa-shirtsinbulk','fa-sign-in' => 'fas fa-sign-in-alt','fa-sign-out' => 'fas fa-sign-out-alt','fa-signing' => 'fas fa-sign-language','fa-simplybuilt' => 'fab fa-simplybuilt','fa-skyatlas' => 'fab fa-skyatlas','fa-skype' => 'fab fa-skype','fa-slack' => 'fab fa-slack','fa-sliders' => 'fas fa-sliders-h','fa-slideshare' => 'fab fa-slideshare','fa-smile-o' => 'far fa-smile','fa-snapchat' => 'fab fa-snapchat','fa-snapchat-ghost' => 'fab fa-snapchat-ghost','fa-snapchat-square' => 'fab fa-snapchat-square','fa-snowflake-o' => 'far fa-snowflake','fa-soccer-ball-o' => 'far fa-futbol','fa-sort-alpha-asc' => 'fas fa-sort-alpha-down','fa-sort-alpha-desc' => 'fas fa-sort-alpha-up','fa-sort-amount-asc' => 'fas fa-sort-amount-down','fa-sort-amount-desc' => 'fas fa-sort-amount-up','fa-sort-asc' => 'fas fa-sort-up','fa-sort-desc' => 'fas fa-sort-down','fa-sort-numeric-asc' => 'fas fa-sort-numeric-down','fa-sort-numeric-desc' => 'fas fa-sort-numeric-up','fa-soundcloud' => 'fab fa-soundcloud','fa-spoon' => 'fas fa-utensil-spoon','fa-spotify' => 'fab fa-spotify','fa-square-o' => 'far fa-square','fa-stack-exchange' => 'fab fa-stack-exchange','fa-stack-overflow' => 'fab fa-stack-overflow','fa-star-half-empty' => 'far fa-star-half','fa-star-half-full' => 'far fa-star-half','fa-star-half-o' => 'far fa-star-half','fa-star-o' => 'far fa-star','fa-steam' => 'fab fa-steam','fa-steam-square' => 'fab fa-steam-square','fa-sticky-note-o' => 'far fa-sticky-note','fa-stop-circle-o' => 'far fa-stop-circle','fa-stumbleupon' => 'fab fa-stumbleupon','fa-stumbleupon-circle' => 'fab fa-stumbleupon-circle','fa-sun-o' => 'far fa-sun','fa-superpowers' => 'fab fa-superpowers','fa-support' => 'far fa-life-ring','fa-tablet' => 'fas fa-tablet-alt','fa-tachometer' => 'fas fa-tachometer-alt','fa-telegram' => 'fab fa-telegram','fa-television' => 'fas fa-tv','fa-tencent-weibo' => 'fab fa-tencent-weibo','fa-themeisle' => 'fab fa-themeisle','fa-thermometer' => 'fas fa-thermometer-full','fa-thermometer-0' => 'fas fa-thermometer-empty','fa-thermometer-1' => 'fas fa-thermometer-quarter','fa-thermometer-2' => 'fas fa-thermometer-half','fa-thermometer-3' => 'fas fa-thermometer-three-quarters','fa-thermometer-4' => 'fas fa-thermometer-full','fa-thumb-tack' => 'fas fa-thumbtack','fa-thumbs-o-down' => 'far fa-thumbs-down','fa-thumbs-o-up' => 'far fa-thumbs-up','fa-ticket' => 'fas fa-ticket-alt','fa-times-circle-o' => 'far fa-times-circle','fa-times-rectangle' => 'fas fa-window-close','fa-times-rectangle-o' => 'far fa-window-close','fa-toggle-down' => 'far fa-caret-square-down','fa-toggle-left' => 'far fa-caret-square-left','fa-toggle-right' => 'far fa-caret-square-right','fa-toggle-up' => 'far fa-caret-square-up','fa-trash' => 'fas fa-trash-alt','fa-trash-o' => 'far fa-trash-alt','fa-trello' => 'fab fa-trello','fa-tripadvisor' => 'fab fa-tripadvisor','fa-try' => 'fas fa-lira-sign','fa-tumblr' => 'fab fa-tumblr','fa-tumblr-square' => 'fab fa-tumblr-square','fa-turkish-lira' => 'fas fa-lira-sign','fa-twitch' => 'fab fa-twitch','fa-twitter' => 'fab fa-twitter','fa-twitter-square' => 'fab fa-twitter-square','fa-unsorted' => 'fas fa-sort','fa-usb' => 'fab fa-usb','fa-usd' => 'fas fa-dollar-sign','fa-user-circle-o' => 'far fa-user-circle','fa-user-o' => 'far fa-user','fa-vcard' => 'fas fa-address-card','fa-vcard-o' => 'far fa-address-card','fa-viacoin' => 'fab fa-viacoin','fa-viadeo' => 'fab fa-viadeo','fa-viadeo-square' => 'fab fa-viadeo-square','fa-video-camera' => 'fas fa-video','fa-vimeo' => 'fab fa-vimeo-v','fa-vimeo-square' => 'fab fa-vimeo-square','fa-vine' => 'fab fa-vine','fa-vk' => 'fab fa-vk','fa-volume-control-phone' => 'fas fa-phone-volume','fa-warning' => 'fas fa-exclamation-triangle','fa-wechat' => 'fab fa-weixin','fa-weibo' => 'fab fa-weibo','fa-weixin' => 'fab fa-weixin','fa-whatsapp' => 'fab fa-whatsapp','fa-wheelchair-alt' => 'fab fa-accessible-icon','fa-wikipedia-w' => 'fab fa-wikipedia-w','fa-window-close-o' => 'far fa-window-close','fa-window-maximize' => 'far fa-window-maximize','fa-window-restore' => 'far fa-window-restore','fa-windows' => 'fab fa-windows','fa-won' => 'fas fa-won-sign','fa-wordpress' => 'fab fa-wordpress','fa-wpbeginner' => 'fab fa-wpbeginner','fa-wpexplorer' => 'fab fa-wpexplorer','fa-wpforms' => 'fab fa-wpforms','fa-xing' => 'fab fa-xing','fa-xing-square' => 'fab fa-xing-square','fa-y-combinator' => 'fab fa-y-combinator','fa-y-combinator-square' => 'fab fa-hacker-news','fa-yahoo' => 'fab fa-yahoo','fa-yc' => 'fab fa-y-combinator','fa-yc-square' => 'fab fa-hacker-news','fa-yelp' => 'fab fa-yelp','fa-yen' => 'fas fa-yen-sign','fa-yoast' => 'fab fa-yoast','fa-youtube' => 'fab fa-youtube','fa-youtube-play' => 'fab fa-youtube','fa-youtube-square' => 'fab fa-youtube-square', /*H-code custom font*/ 'fa-facebook' => 'fab fa-facebook-f', 'fa-google-plus' => 'fab fa-google-plus-g', 'fa-linkedin' => 'fab fa-linkedin-in' );
    return $fa_icon_old;
    }
endif;

if ( ! function_exists( 'hcode_get_all_font_icons' ) ) :
    function hcode_get_all_font_icons() {

        $hcode_etline_icons = array( 'icon-mobile', 'icon-laptop', 'icon-desktop', 'icon-tablet', 'icon-phone', 'icon-document', 'icon-documents', 'icon-search', 'icon-clipboard', 'icon-newspaper', 'icon-notebook', 'icon-book-open', 'icon-browser', 'icon-calendar', 'icon-presentation', 'icon-picture', 'icon-pictures', 'icon-video', 'icon-camera', 'icon-printer', 'icon-toolbox', 'icon-briefcase', 'icon-wallet', 'icon-gift', 'icon-bargraph', 'icon-grid', 'icon-expand', 'icon-focus', 'icon-edit', 'icon-adjustments', 'icon-ribbon', 'icon-hourglass', 'icon-lock', 'icon-megaphone', 'icon-shield', 'icon-trophy', 'icon-flag', 'icon-map', 'icon-puzzle', 'icon-basket', 'icon-envelope', 'icon-streetsign', 'icon-telescope', 'icon-gears', 'icon-key', 'icon-paperclip', 'icon-attachment', 'icon-pricetags', 'icon-lightbulb', 'icon-layers', 'icon-pencil', 'icon-tools', 'icon-tools-2', 'icon-scissors', 'icon-paintbrush', 'icon-magnifying-glass', 'icon-circle-compass', 'icon-linegraph', 'icon-mic', 'icon-strategy', 'icon-beaker', 'icon-caution', 'icon-recycle', 'icon-anchor', 'icon-profile-male', 'icon-profile-female', 'icon-bike', 'icon-wine', 'icon-hotairballoon', 'icon-globe', 'icon-genius', 'icon-map-pin', 'icon-dial', 'icon-chat', 'icon-heart', 'icon-cloud', 'icon-upload', 'icon-download', 'icon-target', 'icon-hazardous', 'icon-piechart', 'icon-speedometer', 'icon-global', 'icon-compass', 'icon-lifesaver', 'icon-clock', 'icon-aperture', 'icon-quote', 'icon-scope', 'icon-alarmclock', 'icon-refresh', 'icon-happy', 'icon-sad', 'icon-facebook', 'icon-twitter', 'icon-googleplus', 'icon-rss', 'icon-tumblr', 'icon-linkedin', 'icon-dribbble' );
        
        $hcode_fa_icons_solid = array( 'fas fa-ad','fas fa-address-book','fas fa-address-card','fas fa-adjust','fas fa-air-freshener','fas fa-align-center','fas fa-align-justify','fas fa-align-left','fas fa-align-right','fas fa-allergies','fas fa-ambulance','fas fa-american-sign-language-interpreting','fas fa-anchor','fas fa-angle-double-down','fas fa-angle-double-left','fas fa-angle-double-right','fas fa-angle-double-up','fas fa-angle-down','fas fa-angle-left','fas fa-angle-right','fas fa-angle-up','fas fa-angry','fas fa-ankh','fas fa-apple-alt','fas fa-archive','fas fa-archway','fas fa-arrow-alt-circle-down','fas fa-arrow-alt-circle-left','fas fa-arrow-alt-circle-right','fas fa-arrow-alt-circle-up','fas fa-arrow-circle-down','fas fa-arrow-circle-left','fas fa-arrow-circle-right','fas fa-arrow-circle-up','fas fa-arrow-down','fas fa-arrow-left','fas fa-arrow-right','fas fa-arrow-up','fas fa-arrows-alt','fas fa-arrows-alt-h','fas fa-arrows-alt-v','fas fa-assistive-listening-systems','fas fa-asterisk','fas fa-at','fas fa-atlas','fas fa-atom','fas fa-audio-description','fas fa-award','fas fa-baby','fas fa-baby-carriage','fas fa-backspace','fas fa-backward','fas fa-bacon','fas fa-balance-scale','fas fa-balance-scale-left','fas fa-balance-scale-right','fas fa-ban','fas fa-band-aid','fas fa-barcode','fas fa-bars','fas fa-baseball-ball','fas fa-basketball-ball','fas fa-bath','fas fa-battery-empty','fas fa-battery-full','fas fa-battery-half','fas fa-battery-quarter','fas fa-battery-three-quarters','fas fa-bed','fas fa-beer','fas fa-bell','fas fa-bell-slash','fas fa-bezier-curve','fas fa-bible','fas fa-bicycle','fas fa-biking','fas fa-binoculars','fas fa-biohazard','fas fa-birthday-cake','fas fa-blender','fas fa-blender-phone','fas fa-blind','fas fa-blog','fas fa-bold','fas fa-bolt','fas fa-bomb','fas fa-bone','fas fa-bong','fas fa-book','fas fa-book-dead','fas fa-book-medical','fas fa-book-open','fas fa-book-reader','fas fa-bookmark','fas fa-border-all','fas fa-border-none','fas fa-border-style','fas fa-bowling-ball','fas fa-box','fas fa-box-open','fas fa-boxes','fas fa-braille','fas fa-brain','fas fa-bread-slice','fas fa-briefcase','fas fa-briefcase-medical','fas fa-broadcast-tower','fas fa-broom','fas fa-brush','fas fa-bug','fas fa-building','fas fa-bullhorn','fas fa-bullseye','fas fa-burn','fas fa-bus','fas fa-bus-alt','fas fa-business-time','fas fa-calculator','fas fa-calendar','fas fa-calendar-alt','fas fa-calendar-check','fas fa-calendar-day','fas fa-calendar-minus','fas fa-calendar-plus','fas fa-calendar-times','fas fa-calendar-week','fas fa-camera','fas fa-camera-retro','fas fa-campground','fas fa-candy-cane','fas fa-cannabis','fas fa-capsules','fas fa-car','fas fa-car-alt','fas fa-car-battery','fas fa-car-crash','fas fa-car-side','fas fa-caret-down','fas fa-caret-left','fas fa-caret-right','fas fa-caret-square-down','fas fa-caret-square-left','fas fa-caret-square-right','fas fa-caret-square-up','fas fa-caret-up','fas fa-carrot','fas fa-cart-arrow-down','fas fa-cart-plus','fas fa-cash-register','fas fa-cat','fas fa-certificate','fas fa-chair','fas fa-chalkboard','fas fa-chalkboard-teacher','fas fa-charging-station','fas fa-chart-area','fas fa-chart-bar','fas fa-chart-line','fas fa-chart-pie','fas fa-check','fas fa-check-circle','fas fa-check-double','fas fa-check-square','fas fa-cheese','fas fa-chess','fas fa-chess-bishop','fas fa-chess-board','fas fa-chess-king','fas fa-chess-knight','fas fa-chess-pawn','fas fa-chess-queen','fas fa-chess-rook','fas fa-chevron-circle-down','fas fa-chevron-circle-left','fas fa-chevron-circle-right','fas fa-chevron-circle-up','fas fa-chevron-down','fas fa-chevron-left','fas fa-chevron-right','fas fa-chevron-up','fas fa-child','fas fa-church','fas fa-circle','fas fa-circle-notch','fas fa-city','fas fa-clinic-medical','fas fa-clipboard','fas fa-clipboard-check','fas fa-clipboard-list','fas fa-clock','fas fa-clone','fas fa-closed-captioning','fas fa-cloud','fas fa-cloud-download-alt','fas fa-cloud-meatball','fas fa-cloud-moon','fas fa-cloud-moon-rain','fas fa-cloud-rain','fas fa-cloud-showers-heavy','fas fa-cloud-sun','fas fa-cloud-sun-rain','fas fa-cloud-upload-alt','fas fa-cocktail','fas fa-code','fas fa-code-branch','fas fa-coffee','fas fa-cog','fas fa-cogs','fas fa-coins','fas fa-columns','fas fa-comment','fas fa-comment-alt','fas fa-comment-dollar','fas fa-comment-dots','fas fa-comment-medical','fas fa-comment-slash','fas fa-comments','fas fa-comments-dollar','fas fa-compact-disc','fas fa-compass','fas fa-compress','fas fa-compress-arrows-alt','fas fa-concierge-bell','fas fa-cookie','fas fa-cookie-bite','fas fa-copy','fas fa-copyright','fas fa-couch','fas fa-credit-card','fas fa-crop','fas fa-crop-alt','fas fa-cross','fas fa-crosshairs','fas fa-crow','fas fa-crown','fas fa-crutch','fas fa-cube','fas fa-cubes','fas fa-cut','fas fa-database','fas fa-deaf','fas fa-democrat','fas fa-desktop','fas fa-dharmachakra','fas fa-diagnoses','fas fa-dice','fas fa-dice-d20','fas fa-dice-d6','fas fa-dice-five','fas fa-dice-four','fas fa-dice-one','fas fa-dice-six','fas fa-dice-three','fas fa-dice-two','fas fa-digital-tachograph','fas fa-directions','fas fa-divide','fas fa-dizzy','fas fa-dna','fas fa-dog','fas fa-dollar-sign','fas fa-dolly','fas fa-dolly-flatbed','fas fa-donate','fas fa-door-closed','fas fa-door-open','fas fa-dot-circle','fas fa-dove','fas fa-download','fas fa-drafting-compass','fas fa-dragon','fas fa-draw-polygon','fas fa-drum','fas fa-drum-steelpan','fas fa-drumstick-bite','fas fa-dumbbell','fas fa-dumpster','fas fa-dumpster-fire','fas fa-dungeon','fas fa-edit','fas fa-egg','fas fa-eject','fas fa-ellipsis-h','fas fa-ellipsis-v','fas fa-envelope','fas fa-envelope-open','fas fa-envelope-open-text','fas fa-envelope-square','fas fa-equals','fas fa-eraser','fas fa-ethernet','fas fa-euro-sign','fas fa-exchange-alt','fas fa-exclamation','fas fa-exclamation-circle','fas fa-exclamation-triangle','fas fa-expand','fas fa-expand-arrows-alt','fas fa-external-link-alt','fas fa-external-link-square-alt','fas fa-eye','fas fa-eye-dropper','fas fa-eye-slash','fas fa-fan','fas fa-fast-backward','fas fa-fast-forward','fas fa-fax','fas fa-feather','fas fa-feather-alt','fas fa-female','fas fa-fighter-jet','fas fa-file','fas fa-file-alt','fas fa-file-archive','fas fa-file-audio','fas fa-file-code','fas fa-file-contract','fas fa-file-csv','fas fa-file-download','fas fa-file-excel','fas fa-file-export','fas fa-file-image','fas fa-file-import','fas fa-file-invoice','fas fa-file-invoice-dollar','fas fa-file-medical','fas fa-file-medical-alt','fas fa-file-pdf','fas fa-file-powerpoint','fas fa-file-prescription','fas fa-file-signature','fas fa-file-upload','fas fa-file-video','fas fa-file-word','fas fa-fill','fas fa-fill-drip','fas fa-film','fas fa-filter','fas fa-fingerprint','fas fa-fire','fas fa-fire-alt','fas fa-fire-extinguisher','fas fa-first-aid','fas fa-fish','fas fa-fist-raised','fas fa-flag','fas fa-flag-checkered','fas fa-flag-usa','fas fa-flask','fas fa-flushed','fas fa-folder','fas fa-folder-minus','fas fa-folder-open','fas fa-folder-plus','fas fa-font','fas fa-football-ball','fas fa-forward','fas fa-frog','fas fa-frown','fas fa-frown-open','fas fa-funnel-dollar','fas fa-futbol','fas fa-gamepad','fas fa-gas-pump','fas fa-gavel','fas fa-gem','fas fa-genderless','fas fa-ghost','fas fa-gift','fas fa-gifts','fas fa-glass-cheers','fas fa-glass-martini','fas fa-glass-martini-alt','fas fa-glass-whiskey','fas fa-glasses','fas fa-globe','fas fa-globe-africa','fas fa-globe-americas','fas fa-globe-asia','fas fa-globe-europe','fas fa-golf-ball','fas fa-gopuram','fas fa-graduation-cap','fas fa-greater-than','fas fa-greater-than-equal','fas fa-grimace','fas fa-grin','fas fa-grin-alt','fas fa-grin-beam','fas fa-grin-beam-sweat','fas fa-grin-hearts','fas fa-grin-squint','fas fa-grin-squint-tears','fas fa-grin-stars','fas fa-grin-tears','fas fa-grin-tongue','fas fa-grin-tongue-squint','fas fa-grin-tongue-wink','fas fa-grin-wink','fas fa-grip-horizontal','fas fa-grip-lines','fas fa-grip-lines-vertical','fas fa-grip-vertical','fas fa-guitar','fas fa-h-square','fas fa-hamburger','fas fa-hammer','fas fa-hamsa','fas fa-hand-holding','fas fa-hand-holding-heart','fas fa-hand-holding-usd','fas fa-hand-lizard','fas fa-hand-middle-finger','fas fa-hand-paper','fas fa-hand-peace','fas fa-hand-point-down','fas fa-hand-point-left','fas fa-hand-point-right','fas fa-hand-point-up','fas fa-hand-pointer','fas fa-hand-rock','fas fa-hand-scissors','fas fa-hand-spock','fas fa-hands','fas fa-hands-helping','fas fa-handshake','fas fa-hanukiah','fas fa-hard-hat','fas fa-hashtag','fas fa-hat-wizard','fas fa-haykal','fas fa-hdd','fas fa-heading','fas fa-headphones','fas fa-headphones-alt','fas fa-headset','fas fa-heart','fas fa-heart-broken','fas fa-heartbeat','fas fa-helicopter','fas fa-highlighter','fas fa-hiking','fas fa-hippo','fas fa-history','fas fa-hockey-puck','fas fa-holly-berry','fas fa-home','fas fa-horse','fas fa-horse-head','fas fa-hospital','fas fa-hospital-alt','fas fa-hospital-symbol','fas fa-hot-tub','fas fa-hotdog','fas fa-hotel','fas fa-hourglass','fas fa-hourglass-end','fas fa-hourglass-half','fas fa-hourglass-start','fas fa-house-damage','fas fa-hryvnia','fas fa-i-cursor','fas fa-ice-cream','fas fa-icicles','fas fa-icons','fas fa-id-badge','fas fa-id-card','fas fa-id-card-alt','fas fa-igloo','fas fa-image','fas fa-images','fas fa-inbox','fas fa-indent','fas fa-industry','fas fa-infinity','fas fa-info','fas fa-info-circle','fas fa-italic','fas fa-jedi','fas fa-joint','fas fa-journal-whills','fas fa-kaaba','fas fa-key','fas fa-keyboard','fas fa-khanda','fas fa-kiss','fas fa-kiss-beam','fas fa-kiss-wink-heart','fas fa-kiwi-bird','fas fa-landmark','fas fa-language','fas fa-laptop','fas fa-laptop-code','fas fa-laptop-medical','fas fa-laugh','fas fa-laugh-beam','fas fa-laugh-squint','fas fa-laugh-wink','fas fa-layer-group','fas fa-leaf','fas fa-lemon','fas fa-less-than','fas fa-less-than-equal','fas fa-level-down-alt','fas fa-level-up-alt','fas fa-life-ring','fas fa-lightbulb','fas fa-link','fas fa-lira-sign','fas fa-list','fas fa-list-alt','fas fa-list-ol','fas fa-list-ul','fas fa-location-arrow','fas fa-lock','fas fa-lock-open','fas fa-long-arrow-alt-down','fas fa-long-arrow-alt-left','fas fa-long-arrow-alt-right','fas fa-long-arrow-alt-up','fas fa-low-vision','fas fa-luggage-cart','fas fa-magic','fas fa-magnet','fas fa-mail-bulk','fas fa-male','fas fa-map','fas fa-map-marked','fas fa-map-marked-alt','fas fa-map-marker','fas fa-map-marker-alt','fas fa-map-pin','fas fa-map-signs','fas fa-marker','fas fa-mars','fas fa-mars-double','fas fa-mars-stroke','fas fa-mars-stroke-h','fas fa-mars-stroke-v','fas fa-mask','fas fa-medal','fas fa-medkit','fas fa-meh','fas fa-meh-blank','fas fa-meh-rolling-eyes','fas fa-memory','fas fa-menorah','fas fa-mercury','fas fa-meteor','fas fa-microchip','fas fa-microphone','fas fa-microphone-alt','fas fa-microphone-alt-slash','fas fa-microphone-slash','fas fa-microscope','fas fa-minus','fas fa-minus-circle','fas fa-minus-square','fas fa-mitten','fas fa-mobile','fas fa-mobile-alt','fas fa-money-bill','fas fa-money-bill-alt','fas fa-money-bill-wave','fas fa-money-bill-wave-alt','fas fa-money-check','fas fa-money-check-alt','fas fa-monument','fas fa-moon','fas fa-mortar-pestle','fas fa-mosque','fas fa-motorcycle','fas fa-mountain','fas fa-mouse-pointer','fas fa-mug-hot','fas fa-music','fas fa-network-wired','fas fa-neuter','fas fa-newspaper','fas fa-not-equal','fas fa-notes-medical','fas fa-object-group','fas fa-object-ungroup','fas fa-oil-can','fas fa-om','fas fa-otter','fas fa-outdent','fas fa-pager','fas fa-paint-brush','fas fa-paint-roller','fas fa-palette','fas fa-pallet','fas fa-paper-plane','fas fa-paperclip','fas fa-parachute-box','fas fa-paragraph','fas fa-parking','fas fa-passport','fas fa-pastafarianism','fas fa-paste','fas fa-pause','fas fa-pause-circle','fas fa-paw','fas fa-peace','fas fa-pen','fas fa-pen-alt','fas fa-pen-fancy','fas fa-pen-nib','fas fa-pen-square','fas fa-pencil-alt','fas fa-pencil-ruler','fas fa-people-carry','fas fa-pepper-hot','fas fa-percent','fas fa-percentage','fas fa-person-booth','fas fa-phone','fas fa-phone-alt','fas fa-phone-slash','fas fa-phone-square','fas fa-phone-square-alt','fas fa-phone-volume','fas fa-photo-video','fas fa-piggy-bank','fas fa-pills','fas fa-pizza-slice','fas fa-place-of-worship','fas fa-plane','fas fa-plane-arrival','fas fa-plane-departure','fas fa-play','fas fa-play-circle','fas fa-plug','fas fa-plus','fas fa-plus-circle','fas fa-plus-square','fas fa-podcast','fas fa-poll','fas fa-poll-h','fas fa-poo','fas fa-poo-storm','fas fa-poop','fas fa-portrait','fas fa-pound-sign','fas fa-power-off','fas fa-pray','fas fa-praying-hands','fas fa-prescription','fas fa-prescription-bottle','fas fa-prescription-bottle-alt','fas fa-print','fas fa-procedures','fas fa-project-diagram','fas fa-puzzle-piece','fas fa-qrcode','fas fa-question','fas fa-question-circle','fas fa-quidditch','fas fa-quote-left','fas fa-quote-right','fas fa-quran','fas fa-radiation','fas fa-radiation-alt','fas fa-rainbow','fas fa-random','fas fa-receipt','fas fa-recycle','fas fa-redo','fas fa-redo-alt','fas fa-registered','fas fa-remove-format','fas fa-reply','fas fa-reply-all','fas fa-republican','fas fa-restroom','fas fa-retweet','fas fa-ribbon','fas fa-ring','fas fa-road','fas fa-robot','fas fa-rocket','fas fa-route','fas fa-rss','fas fa-rss-square','fas fa-ruble-sign','fas fa-ruler','fas fa-ruler-combined','fas fa-ruler-horizontal','fas fa-ruler-vertical','fas fa-running','fas fa-rupee-sign','fas fa-sad-cry','fas fa-sad-tear','fas fa-satellite','fas fa-satellite-dish','fas fa-save','fas fa-school','fas fa-screwdriver','fas fa-scroll','fas fa-sd-card','fas fa-search','fas fa-search-dollar','fas fa-search-location','fas fa-search-minus','fas fa-search-plus','fas fa-seedling','fas fa-server','fas fa-shapes','fas fa-share','fas fa-share-alt','fas fa-share-alt-square','fas fa-share-square','fas fa-shekel-sign','fas fa-shield-alt','fas fa-ship','fas fa-shipping-fast','fas fa-shoe-prints','fas fa-shopping-bag','fas fa-shopping-basket','fas fa-shopping-cart','fas fa-shower','fas fa-shuttle-van','fas fa-sign','fas fa-sign-in-alt','fas fa-sign-language','fas fa-sign-out-alt','fas fa-signal','fas fa-signature','fas fa-sim-card','fas fa-sitemap','fas fa-skating','fas fa-skiing','fas fa-skiing-nordic','fas fa-skull','fas fa-skull-crossbones','fas fa-slash','fas fa-sleigh','fas fa-sliders-h','fas fa-smile','fas fa-smile-beam','fas fa-smile-wink','fas fa-smog','fas fa-smoking','fas fa-smoking-ban','fas fa-sms','fas fa-snowboarding','fas fa-snowflake','fas fa-snowman','fas fa-snowplow','fas fa-socks','fas fa-solar-panel','fas fa-sort','fas fa-sort-alpha-down','fas fa-sort-alpha-down-alt','fas fa-sort-alpha-up','fas fa-sort-alpha-up-alt','fas fa-sort-amount-down','fas fa-sort-amount-down-alt','fas fa-sort-amount-up','fas fa-sort-amount-up-alt','fas fa-sort-down','fas fa-sort-numeric-down','fas fa-sort-numeric-down-alt','fas fa-sort-numeric-up','fas fa-sort-numeric-up-alt','fas fa-sort-up','fas fa-spa','fas fa-space-shuttle','fas fa-spell-check','fas fa-spider','fas fa-spinner','fas fa-splotch','fas fa-spray-can','fas fa-square','fas fa-square-full','fas fa-square-root-alt','fas fa-stamp','fas fa-star','fas fa-star-and-crescent','fas fa-star-half','fas fa-star-half-alt','fas fa-star-of-david','fas fa-star-of-life','fas fa-step-backward','fas fa-step-forward','fas fa-stethoscope','fas fa-sticky-note','fas fa-stop','fas fa-stop-circle','fas fa-stopwatch','fas fa-store','fas fa-store-alt','fas fa-stream','fas fa-street-view','fas fa-strikethrough','fas fa-stroopwafel','fas fa-subscript','fas fa-subway','fas fa-suitcase','fas fa-suitcase-rolling','fas fa-sun','fas fa-superscript','fas fa-surprise','fas fa-swatchbook','fas fa-swimmer','fas fa-swimming-pool','fas fa-synagogue','fas fa-sync','fas fa-sync-alt','fas fa-syringe','fas fa-table','fas fa-table-tennis','fas fa-tablet','fas fa-tablet-alt','fas fa-tablets','fas fa-tachometer-alt','fas fa-tag','fas fa-tags','fas fa-tape','fas fa-tasks','fas fa-taxi','fas fa-teeth','fas fa-teeth-open','fas fa-temperature-high','fas fa-temperature-low','fas fa-tenge','fas fa-terminal','fas fa-text-height','fas fa-text-width','fas fa-th','fas fa-th-large','fas fa-th-list','fas fa-theater-masks','fas fa-thermometer','fas fa-thermometer-empty','fas fa-thermometer-full','fas fa-thermometer-half','fas fa-thermometer-quarter','fas fa-thermometer-three-quarters','fas fa-thumbs-down','fas fa-thumbs-up','fas fa-thumbtack','fas fa-ticket-alt','fas fa-times','fas fa-times-circle','fas fa-tint','fas fa-tint-slash','fas fa-tired','fas fa-toggle-off','fas fa-toggle-on','fas fa-toilet','fas fa-toilet-paper','fas fa-toolbox','fas fa-tools','fas fa-tooth','fas fa-torah','fas fa-torii-gate','fas fa-tractor','fas fa-trademark','fas fa-traffic-light','fas fa-train','fas fa-tram','fas fa-transgender','fas fa-transgender-alt','fas fa-trash','fas fa-trash-alt','fas fa-trash-restore','fas fa-trash-restore-alt','fas fa-tree','fas fa-trophy','fas fa-truck','fas fa-truck-loading','fas fa-truck-monster','fas fa-truck-moving','fas fa-truck-pickup','fas fa-tshirt','fas fa-tty','fas fa-tv','fas fa-umbrella','fas fa-umbrella-beach','fas fa-underline','fas fa-undo','fas fa-undo-alt','fas fa-universal-access','fas fa-university','fas fa-unlink','fas fa-unlock','fas fa-unlock-alt','fas fa-upload','fas fa-user','fas fa-user-alt','fas fa-user-alt-slash','fas fa-user-astronaut','fas fa-user-check','fas fa-user-circle','fas fa-user-clock','fas fa-user-cog','fas fa-user-edit','fas fa-user-friends','fas fa-user-graduate','fas fa-user-injured','fas fa-user-lock','fas fa-user-md','fas fa-user-minus','fas fa-user-ninja','fas fa-user-nurse','fas fa-user-plus','fas fa-user-secret','fas fa-user-shield','fas fa-user-slash','fas fa-user-tag','fas fa-user-tie','fas fa-user-times','fas fa-users','fas fa-users-cog','fas fa-utensil-spoon','fas fa-utensils','fas fa-vector-square','fas fa-venus','fas fa-venus-double','fas fa-venus-mars','fas fa-vial','fas fa-vials','fas fa-video','fas fa-video-slash','fas fa-vihara','fas fa-voicemail','fas fa-volleyball-ball','fas fa-volume-down','fas fa-volume-mute','fas fa-volume-off','fas fa-volume-up','fas fa-vote-yea','fas fa-vr-cardboard','fas fa-walking','fas fa-wallet','fas fa-warehouse','fas fa-water','fas fa-wave-square','fas fa-weight','fas fa-weight-hanging','fas fa-wheelchair','fas fa-wifi','fas fa-wind','fas fa-window-close','fas fa-window-maximize','fas fa-window-minimize','fas fa-window-restore','fas fa-wine-bottle','fas fa-wine-glass','fas fa-wine-glass-alt','fas fa-won-sign','fas fa-wrench','fas fa-x-ray','fas fa-yen-sign','fas fa-yin-yang' );
        
        $hcode_fa_icons_reg = array( 'far fa-address-book','far fa-address-card','far fa-angry','far fa-arrow-alt-circle-down','far fa-arrow-alt-circle-left','far fa-arrow-alt-circle-right','far fa-arrow-alt-circle-up','far fa-bell','far fa-bell-slash','far fa-bookmark','far fa-building','far fa-calendar','far fa-calendar-alt','far fa-calendar-check','far fa-calendar-minus','far fa-calendar-plus','far fa-calendar-times','far fa-caret-square-down','far fa-caret-square-left','far fa-caret-square-right','far fa-caret-square-up','far fa-chart-bar','far fa-check-circle','far fa-check-square','far fa-circle','far fa-clipboard','far fa-clock','far fa-clone','far fa-closed-captioning','far fa-comment','far fa-comment-alt','far fa-comment-dots','far fa-comments','far fa-compass','far fa-copy','far fa-copyright','far fa-credit-card','far fa-dizzy','far fa-dot-circle','far fa-edit','far fa-envelope','far fa-envelope-open','far fa-eye','far fa-eye-slash','far fa-file','far fa-file-alt','far fa-file-archive','far fa-file-audio','far fa-file-code','far fa-file-excel','far fa-file-image','far fa-file-pdf','far fa-file-powerpoint','far fa-file-video','far fa-file-word','far fa-flag','far fa-flushed','far fa-folder','far fa-folder-open','far fa-frown','far fa-frown-open','far fa-futbol','far fa-gem','far fa-grimace','far fa-grin','far fa-grin-alt','far fa-grin-beam','far fa-grin-beam-sweat','far fa-grin-hearts','far fa-grin-squint','far fa-grin-squint-tears','far fa-grin-stars','far fa-grin-tears','far fa-grin-tongue','far fa-grin-tongue-squint','far fa-grin-tongue-wink','far fa-grin-wink','far fa-hand-lizard','far fa-hand-paper','far fa-hand-peace','far fa-hand-point-down','far fa-hand-point-left','far fa-hand-point-right','far fa-hand-point-up','far fa-hand-pointer','far fa-hand-rock','far fa-hand-scissors','far fa-hand-spock','far fa-handshake','far fa-hdd','far fa-heart','far fa-hospital','far fa-hourglass','far fa-id-badge','far fa-id-card','far fa-image','far fa-images','far fa-keyboard','far fa-kiss','far fa-kiss-beam','far fa-kiss-wink-heart','far fa-laugh','far fa-laugh-beam','far fa-laugh-squint','far fa-laugh-wink','far fa-lemon','far fa-life-ring','far fa-lightbulb','far fa-list-alt','far fa-map','far fa-meh','far fa-meh-blank','far fa-meh-rolling-eyes','far fa-minus-square','far fa-money-bill-alt','far fa-moon','far fa-newspaper','far fa-object-group','far fa-object-ungroup','far fa-paper-plane','far fa-pause-circle','far fa-play-circle','far fa-plus-square','far fa-question-circle','far fa-registered','far fa-sad-cry','far fa-sad-tear','far fa-save','far fa-share-square','far fa-smile','far fa-smile-beam','far fa-smile-wink','far fa-snowflake','far fa-square','far fa-star','far fa-star-half','far fa-sticky-note','far fa-stop-circle','far fa-sun','far fa-surprise','far fa-thumbs-down','far fa-thumbs-up','far fa-times-circle','far fa-tired','far fa-trash-alt','far fa-user','far fa-user-circle','far fa-window-close','far fa-window-maximize','far fa-window-minimize','far fa-window-restore' );

        $hcode_fa_icons_brand = array( 'fab fa-500px','fab fa-accessible-icon','fab fa-accusoft','fab fa-acquisitions-incorporated','fab fa-adn','fab fa-adobe','fab fa-adversal','fab fa-affiliatetheme','fab fa-airbnb','fab fa-algolia','fab fa-alipay','fab fa-amazon','fab fa-amazon-pay','fab fa-amilia','fab fa-android','fab fa-angellist','fab fa-angrycreative','fab fa-angular','fab fa-app-store','fab fa-app-store-ios','fab fa-apper','fab fa-apple','fab fa-apple-pay','fab fa-artstation','fab fa-asymmetrik','fab fa-atlassian','fab fa-audible','fab fa-autoprefixer','fab fa-avianex','fab fa-aviato','fab fa-aws','fab fa-bandcamp','fab fa-battle-net','fab fa-behance','fab fa-behance-square','fab fa-bimobject','fab fa-bitbucket','fab fa-bitcoin','fab fa-bity','fab fa-black-tie','fab fa-blackberry','fab fa-blogger','fab fa-blogger-b','fab fa-bluetooth','fab fa-bluetooth-b','fab fa-bootstrap','fab fa-btc','fab fa-buffer','fab fa-buromobelexperte','fab fa-buysellads','fab fa-canadian-maple-leaf','fab fa-cc-amazon-pay','fab fa-cc-amex','fab fa-cc-apple-pay','fab fa-cc-diners-club','fab fa-cc-discover','fab fa-cc-jcb','fab fa-cc-mastercard','fab fa-cc-paypal','fab fa-cc-stripe','fab fa-cc-visa','fab fa-centercode','fab fa-centos','fab fa-chrome','fab fa-chromecast','fab fa-cloudscale','fab fa-cloudsmith','fab fa-cloudversify','fab fa-codepen','fab fa-codiepie','fab fa-confluence','fab fa-connectdevelop','fab fa-contao','fab fa-cpanel','fab fa-creative-commons','fab fa-creative-commons-by','fab fa-creative-commons-nc','fab fa-creative-commons-nc-eu','fab fa-creative-commons-nc-jp','fab fa-creative-commons-nd','fab fa-creative-commons-pd','fab fa-creative-commons-pd-alt','fab fa-creative-commons-remix','fab fa-creative-commons-sa','fab fa-creative-commons-sampling','fab fa-creative-commons-sampling-plus','fab fa-creative-commons-share','fab fa-creative-commons-zero','fab fa-critical-role','fab fa-css3','fab fa-css3-alt','fab fa-cuttlefish','fab fa-d-and-d','fab fa-d-and-d-beyond','fab fa-dashcube','fab fa-delicious','fab fa-deploydog','fab fa-deskpro','fab fa-dev','fab fa-deviantart','fab fa-dhl','fab fa-diaspora','fab fa-digg','fab fa-digital-ocean','fab fa-discord','fab fa-discourse','fab fa-dochub','fab fa-docker','fab fa-draft2digital','fab fa-dribbble','fab fa-dribbble-square','fab fa-dropbox','fab fa-drupal','fab fa-dyalog','fab fa-earlybirds','fab fa-ebay','fab fa-edge','fab fa-elementor','fab fa-ello','fab fa-ember','fab fa-empire','fab fa-envira','fab fa-erlang','fab fa-ethereum','fab fa-etsy','fab fa-evernote','fab fa-expeditedssl','fab fa-facebook','fab fa-facebook-f','fab fa-facebook-messenger','fab fa-facebook-square','fab fa-fantasy-flight-games','fab fa-fedex','fab fa-fedora','fab fa-figma','fab fa-firefox','fab fa-first-order','fab fa-first-order-alt','fab fa-firstdraft','fab fa-flickr','fab fa-flipboard','fab fa-fly','fab fa-font-awesome','fab fa-font-awesome-alt','fab fa-font-awesome-flag','fab fa-fonticons','fab fa-fonticons-fi','fab fa-fort-awesome','fab fa-fort-awesome-alt','fab fa-forumbee','fab fa-foursquare','fab fa-free-code-camp','fab fa-freebsd','fab fa-fulcrum','fab fa-galactic-republic','fab fa-galactic-senate','fab fa-get-pocket','fab fa-gg','fab fa-gg-circle','fab fa-git','fab fa-git-alt','fab fa-git-square','fab fa-github','fab fa-github-alt','fab fa-github-square','fab fa-gitkraken','fab fa-gitlab','fab fa-gitter','fab fa-glide','fab fa-glide-g','fab fa-gofore','fab fa-goodreads','fab fa-goodreads-g','fab fa-google','fab fa-google-drive','fab fa-google-play','fab fa-google-plus','fab fa-google-plus-g','fab fa-google-plus-square','fab fa-google-wallet','fab fa-gratipay','fab fa-grav','fab fa-gripfire','fab fa-grunt','fab fa-gulp','fab fa-hacker-news','fab fa-hacker-news-square','fab fa-hackerrank','fab fa-hips','fab fa-hire-a-helper','fab fa-hooli','fab fa-hornbill','fab fa-hotjar','fab fa-houzz','fab fa-html5','fab fa-hubspot','fab fa-imdb','fab fa-instagram','fab fa-intercom','fab fa-internet-explorer','fab fa-invision','fab fa-ioxhost','fab fa-itch-io','fab fa-itunes','fab fa-itunes-note','fab fa-java','fab fa-jedi-order','fab fa-jenkins','fab fa-jira','fab fa-joget','fab fa-joomla','fab fa-js','fab fa-js-square','fab fa-jsfiddle','fab fa-kaggle','fab fa-keybase','fab fa-keycdn','fab fa-kickstarter','fab fa-kickstarter-k','fab fa-korvue','fab fa-laravel','fab fa-lastfm','fab fa-lastfm-square','fab fa-leanpub','fab fa-less','fab fa-line','fab fa-linkedin','fab fa-linkedin-in','fab fa-linode','fab fa-linux','fab fa-lyft','fab fa-magento','fab fa-mailchimp','fab fa-mandalorian','fab fa-markdown','fab fa-mastodon','fab fa-maxcdn','fab fa-medapps','fab fa-medium','fab fa-medium-m','fab fa-medrt','fab fa-meetup','fab fa-megaport','fab fa-mendeley','fab fa-microsoft','fab fa-mix','fab fa-mixcloud','fab fa-mizuni','fab fa-modx','fab fa-monero','fab fa-napster','fab fa-neos','fab fa-nimblr','fab fa-node','fab fa-node-js','fab fa-npm','fab fa-ns8','fab fa-nutritionix','fab fa-odnoklassniki','fab fa-odnoklassniki-square','fab fa-old-republic','fab fa-opencart','fab fa-openid','fab fa-opera','fab fa-optin-monster','fab fa-osi','fab fa-page4','fab fa-pagelines','fab fa-palfed','fab fa-patreon','fab fa-paypal','fab fa-penny-arcade','fab fa-periscope','fab fa-phabricator','fab fa-phoenix-framework','fab fa-phoenix-squadron','fab fa-php','fab fa-pied-piper','fab fa-pied-piper-alt','fab fa-pied-piper-hat','fab fa-pied-piper-pp','fab fa-pinterest','fab fa-pinterest-p','fab fa-pinterest-square','fab fa-playstation','fab fa-product-hunt','fab fa-pushed','fab fa-python','fab fa-qq','fab fa-quinscape','fab fa-quora','fab fa-r-project','fab fa-raspberry-pi','fab fa-ravelry','fab fa-react','fab fa-reacteurope','fab fa-readme','fab fa-rebel','fab fa-red-river','fab fa-reddit','fab fa-reddit-alien','fab fa-reddit-square','fab fa-redhat','fab fa-renren','fab fa-replyd','fab fa-researchgate','fab fa-resolving','fab fa-rev','fab fa-rocketchat','fab fa-rockrms','fab fa-safari','fab fa-salesforce','fab fa-sass','fab fa-schlix','fab fa-scribd','fab fa-searchengin','fab fa-sellcast','fab fa-sellsy','fab fa-servicestack','fab fa-shirtsinbulk','fab fa-shopware','fab fa-simplybuilt','fab fa-sistrix','fab fa-sith','fab fa-sketch','fab fa-skyatlas','fab fa-skype','fab fa-slack','fab fa-slack-hash','fab fa-slideshare','fab fa-snapchat','fab fa-snapchat-ghost','fab fa-snapchat-square','fab fa-soundcloud','fab fa-sourcetree','fab fa-speakap','fab fa-speaker-deck','fab fa-spotify','fab fa-squarespace','fab fa-stack-exchange','fab fa-stack-overflow','fab fa-stackpath','fab fa-staylinked','fab fa-steam','fab fa-steam-square','fab fa-steam-symbol','fab fa-sticker-mule','fab fa-strava','fab fa-stripe','fab fa-stripe-s','fab fa-studiovinari','fab fa-stumbleupon','fab fa-stumbleupon-circle','fab fa-superpowers','fab fa-supple','fab fa-suse','fab fa-symfony','fab fa-teamspeak','fab fa-telegram','fab fa-telegram-plane','fab fa-tencent-weibo','fab fa-the-red-yeti','fab fa-themeco','fab fa-themeisle','fab fa-think-peaks','fab fa-trade-federation','fab fa-trello','fab fa-tripadvisor','fab fa-tumblr','fab fa-tumblr-square','fab fa-twitch','fab fa-twitter','fab fa-twitter-square','fab fa-typo3','fab fa-uber','fab fa-ubuntu','fab fa-uikit','fab fa-uniregistry','fab fa-untappd','fab fa-ups','fab fa-usb','fab fa-usps','fab fa-ussunnah','fab fa-vaadin','fab fa-viacoin','fab fa-viadeo','fab fa-viadeo-square','fab fa-viber','fab fa-vimeo','fab fa-vimeo-square','fab fa-vimeo-v','fab fa-vine','fab fa-vk','fab fa-vnv','fab fa-vuejs','fab fa-waze','fab fa-weebly','fab fa-weibo','fab fa-weixin','fab fa-whatsapp','fab fa-whatsapp-square','fab fa-whmcs','fab fa-wikipedia-w','fab fa-windows','fab fa-wix','fab fa-wizards-of-the-coast','fab fa-wolf-pack-battalion','fab fa-wordpress','fab fa-wordpress-simple','fab fa-wpbeginner','fab fa-wpexplorer','fab fa-wpforms','fab fa-wpressr','fab fa-xbox','fab fa-xing','fab fa-xing-square','fab fa-y-combinator','fab fa-yahoo','fab fa-yammer','fab fa-yandex','fab fa-yandex-international','fab fa-yarn','fab fa-yelp','fab fa-yoast','fab fa-youtube','fab fa-youtube-square','fab fa-zhihu' );

        $hcode_all_icons_list = array_merge( $hcode_etline_icons, $hcode_fa_icons_solid, $hcode_fa_icons_reg, $hcode_fa_icons_brand );

        return $hcode_all_icons_list;
    }
endif;
add_filter( 'redux/font-icons', 'hcode_get_all_font_icons' );

// Remove Empty P tag

if( ! function_exists( 'hcode_remove_wpautop' ) ) {
  function hcode_remove_wpautop( $content, $force_br = true ) {
    if ( $force_br ) {
      $content = wpautop( preg_replace( '/<\/?p\>/', "\n", $content ) . "\n" );
    }
    return do_shortcode( shortcode_unautop( $content ) );
  }
}

// Post Meta
if ( ! function_exists( 'hcode_single_post_meta' ) ) :

    function hcode_single_post_meta() {

        $hcode_single_enable_author     = hcode_option( 'hcode_single_enable_author' );
        $hcode_single_enable_date       = hcode_option( 'hcode_single_enable_date' );
        $hcode_single_date_format       = hcode_option( 'hcode_single_date_format' );
        $hcode_single_enable_category   = hcode_option( 'hcode_single_enable_category' );

        $posted_by = array();
        if ( ( 'post' == get_post_type() && $hcode_single_enable_author ) || 'portfolio' == get_post_type() ) {
            if ( is_singular() || is_multi_author() ) {
                $posted_by[] = sprintf( '%1$s <span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
                    esc_html__( 'Posted by ', 'H-Code' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    get_the_author()
                );
            }
        }
        if ( in_array( get_post_type(), array( 'post', 'attachment', 'portfolio' ) ) && $hcode_single_enable_date ) {
            $time_string = '%2$s';

            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( 'c' ) ),
                get_the_date( $hcode_single_date_format ),
                esc_attr( get_the_modified_date( 'c' ) ),
                get_the_modified_date( $hcode_single_date_format )
            );

            $posted_by[] = sprintf( '<span class="published">%1$s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_single_date_format ).'</time>',
                $time_string
            );
        }
        if ( 'post' == get_post_type() && $hcode_single_enable_category ) {
            
            $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
            if ( $categories_list && hcode_categorized_blog() ) {
                $posted_by[] = sprintf( '%1$s',
                    $categories_list
                );
            }
        }

        if( !empty( $posted_by ) ) {
            echo '<div class="blog-date no-padding-top standard-post-meta">';
            echo implode(' | ', $posted_by);
            echo '</div>';
        }
    }
endif;

// single portfolio meta

if ( ! function_exists( 'hcode_single_portfolio_meta' ) ) :

    function hcode_single_portfolio_meta() {
    $output = '';
    ob_start();
    $hcode_enable_meta_author_portfolio = hcode_option('hcode_enable_meta_author_portfolio');
    $hcode_enable_meta_date_portfolio = hcode_option('hcode_enable_meta_date_portfolio');
    $hcode_portfolio_date_format = hcode_option('hcode_portfolio_date_format');
    $hcode_enable_meta_category_portfolio = hcode_option('hcode_enable_meta_category_portfolio');
        if ( 'portfolio' == get_post_type() ) {
            if ( (is_singular() || is_multi_author()) && $hcode_enable_meta_author_portfolio == 1 ) {
                printf( '%1$s <span class="author vcard"><a class="url fn n" href="%2$s">%3$s</a></span>',
                    _x( 'Created by', 'Used before post author name.', 'H-Code' ),
                    esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                    get_the_author()
                );
            }
        }
        if ( in_array( get_post_type(), array( 'portfolio' ) ) ) {
            $time_string = '%2$s';

            $time_string = sprintf( $time_string,
                esc_attr( get_the_date( 'c' ) ),
                get_the_date( $hcode_portfolio_date_format ),
                esc_attr( get_the_modified_date( 'c' ) ),
                get_the_modified_date( $hcode_portfolio_date_format )
            );
            if( $hcode_enable_meta_date_portfolio == 1){
                if($hcode_enable_meta_author_portfolio == 1){
                    printf( ' | <span class="published">%1$s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_portfolio_date_format ).'</time>',
                        $time_string
                    );
                }else{
                    printf( ' <span class="published">%1$s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_portfolio_date_format ).'</time>',
                        $time_string
                    );
                }
            }
        }

        if ( 'portfolio' == get_post_type() ) {
            $cat = get_the_terms( get_the_ID(), 'portfolio-category' );
            $item = 1;
            $cat_slug = '';
            if( !empty( $cat ) ) {
                foreach ($cat as $key => $c) {
                    if( count($cat) == $item){
                        $cat_slug .= '<a href="' . get_term_link( $c ) . '" title="' . sprintf( esc_html__( 'View all post filed under %s', 'H-Code' ), $c->name ) . '" rel="category tag">' . $c->name . '</a>';
                    }else{
                        $cat_slug .= '<a href="' . get_term_link( $c ) . '" title="' . sprintf( esc_html__( 'View all post filed under %s', 'H-Code' ), $c->name ) . '" rel="category tag">' . $c->name . '</a>, ';
                    }
                    $item++;
                }
            }
            if( $cat_slug && $hcode_enable_meta_category_portfolio == 1 ) {
                if( $hcode_enable_meta_author_portfolio == 1 || $hcode_enable_meta_date_portfolio == 1 ) {
                    echo ' | '.$cat_slug;
                } else {
                    echo sprintf( __('%s','H-Code'), $cat_slug );
                }
            }
        }
    $output = ob_get_contents();  
    ob_end_clean(); 
    return $output;
    }
endif;

// Blog Full Width Header Meta

if ( ! function_exists( 'hcode_full_width_single_post_meta' ) ) :

function hcode_full_width_single_post_meta() {

    $hcode_single_enable_author     = hcode_option('hcode_single_enable_author');
    $hcode_single_enable_date       = hcode_option('hcode_single_enable_date');
    $hcode_single_date_format       = hcode_option('hcode_single_date_format');
    $hcode_single_enable_category   = hcode_option('hcode_single_enable_category');

    if ( 'post' == get_post_type() && $hcode_single_enable_author ) {
        if ( is_singular() || is_multi_author() ) {
            printf( '<div class="posted-by text-uppercase full-width-header-post-meta">%1$s <span class="author vcard"><a class="url fn n white-text" href="%2$s">%3$s</a></span></div>',
                esc_html__( 'Posted by ', 'H-Code' ),
                esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ),
                get_the_author()
            );
        }
    }
    printf('<div class="full-blog-date text-uppercase full-width-header-post-meta">');
        if( $hcode_single_enable_date ) {
            if ( in_array( get_post_type(), array( 'post', 'attachment' ) ) ) {
                $time_string = '%2$s';

                $time_string = sprintf( $time_string,
                    esc_attr( get_the_date( 'c' ) ),
                    get_the_date($hcode_single_date_format)
                );

                printf( ' <span class="published">%s</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_single_date_format ).'</time>',
                    $time_string
                );
            }
        }
        
        if( $hcode_single_enable_date && $hcode_single_enable_category ) {
            echo ' | ';
        }

        if( $hcode_single_enable_category ) {
            if ( 'post' == get_post_type() ) {
                
                $categories_list = get_the_category_list( _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
                if ( $categories_list && hcode_categorized_blog() ) {
                    printf( '%1$s',
                        $categories_list
                    );
                }
            }
        }
    printf('</div>');  
    if ( is_attachment() && wp_attachment_is_image() ) {
        // Retrieve attachment metadata.
        $metadata = wp_get_attachment_metadata();

        printf( '<span class="full-size-link"><span class="screen-reader-text">%1$s </span><a href="%2$s">%3$s &times; %4$s</a></span>',
            _x( 'Full size', 'Used before full size attachment link.', 'H-Code' ),
            esc_url( wp_get_attachment_url() ),
            $metadata['width'],
            $metadata['height']
        );
    }

    if ( ! is_single() && ! post_password_required() && ( comments_open() || get_comments_number() ) ) {
        echo '<span class="comments-link">';
        comments_popup_link( esc_html__( 'Leave a comment', 'H-Code' ), esc_html__( '1 Comment', 'H-Code' ), esc_html__( '% Comments', 'H-Code' ) );
        echo '</span>';
    }
}
endif;

if ( ! function_exists( 'hcode_categorized_blog' ) ) :
    function hcode_categorized_blog() {
        if ( false === ( $all_the_cool_cats = get_transient( 'hcode_categories' ) ) ) {
            // Create an array of all the categories that are attached to posts.
            $all_the_cool_cats = get_categories( array(
                'fields'     => 'ids',
                'hide_empty' => 1,

                // We only need to know if there is more than one category.
                'number'     => 2,
            ) );

            // Count the number of categories that are attached to the posts.
            $all_the_cool_cats = count( $all_the_cool_cats );

            set_transient( 'hcode_categories', $all_the_cool_cats );
        }

        if ( $all_the_cool_cats > 1 ) {
            // This blog has more than 1 category so hcode_categorized_blog should return true.
            return true;
        } else {
            // This blog has only 1 category so hcode_categorized_blog should return false.
            return false;
        }
    }
endif;

if ( ! function_exists( 'hcode_category_transient_flusher' ) ) :
    function hcode_category_transient_flusher() {
        delete_transient( 'hcode_categories' );
    }
endif;
add_action( 'edit_category', 'hcode_category_transient_flusher' );
add_action( 'save_post',     'hcode_category_transient_flusher' );

// Get the Post Tags

if ( ! function_exists( 'hcode_single_post_meta_tag' ) ) :

    function hcode_single_post_meta_tag() {
    if ( 'post' == get_post_type() ) {

            $tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
            if ( $tags_list ) {
                printf( '%1$s %2$s',
                    __( '<h5 class="widget-title margin-one no-margin-top">Tags</h5>', 'H-Code' ),
                    $tags_list
                );
            }
        }
    }
endif;

// To Get Portfolio Tags

if ( ! function_exists( 'hcode_single_portfolio_meta_tag' ) ) :

    function hcode_single_portfolio_meta_tag() {
    if ( 'portfolio' == get_post_type() ) {

            global $post;
            $portfolio_tag_list = get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="widget-title margin-one no-margin-top">Tags</h5>', ', ', '');
            if($portfolio_tag_list):
                echo '<div class="blog-date float-left width-100 no-padding-top margin-eight no-margin-bottom">';
                echo get_the_term_list($post->ID, 'portfolio-tags', '<h5 class="widget-title margin-one no-margin-top">Tags</h5>', ', ', '');
                echo '</div>';
            endif;
        }
    }
endif;

if ( ! function_exists( 'hcode_login_logo' ) ) :
// To Change Admin Panel Logo.
    function hcode_login_logo() { 
        $admin_logo = hcode_option('hcode_header_logo');
        if( is_array( $admin_logo    ) ) {
            if( $admin_logo['url'] ) {
            ?>
            <style type="text/css">
                .login h1 a {
                    background-image: url(<?php echo esc_url( $admin_logo['url'] ) ?>  ) !important;
                    background-size: contain !important;
                    height: 48px !important;
                    width: 100% !important;
                }
            </style>
            <?php 
            }
        }
    }
endif;
add_action( 'login_enqueue_scripts', 'hcode_login_logo' );

// To Change Admin Panel Logo Url.
if ( ! function_exists( 'hcode_login_logo_url' ) ) :
    function hcode_login_logo_url() {
        return home_url( '/' );
    }
endif;
add_filter( 'login_headerurl', 'hcode_login_logo_url' );

// To Change Admin Panel Logo Title.
if ( version_compare( $GLOBALS['wp_version'], '5.2.0', '<' ) ) {
    add_filter( 'login_headertitle', 'hcode_login_logo_url_title' );
} else {
    add_filter( 'login_headertext', 'hcode_login_logo_url_title' );
}
if ( ! function_exists( 'hcode_login_logo_url_title' ) ) :
    function hcode_login_logo_url_title() {
        $text = get_bloginfo('name').' | '.get_bloginfo('description');
        return $text;
    }
endif;

// To remove deprecated notice for old functions
add_filter('deprecated_constructor_trigger_error', '__return_false');

// For Title Tag
if ( ! function_exists( '_wp_render_title_tag' ) ) {
    function hcode_theme_slug_render_title() {
    ?>
        <title><?php wp_title( '|', true, 'right' ); ?></title>
    <?php
    }
    add_action( 'wp_head', 'hcode_theme_slug_render_title' );
}

if ( ! function_exists( 'hcode_registered_sidebars_array' ) ) :
function hcode_registered_sidebars_array() {
    global $wp_registered_sidebars;
    if( ! empty( $wp_registered_sidebars ) && is_array( $wp_registered_sidebars ) ){ 
        $sidebar_array = array();
        $sidebar_array['default'] = 'Default';
        foreach( $wp_registered_sidebars as $sidebar ){
            $sidebar_array[$sidebar['id']] = $sidebar['name'];
        }
    }
    return $sidebar_array;
}
endif;

// Check if Hcode-addons Plugin active or not.
if( !class_exists( 'Hcode_Addons_Post_Type' ) ) {
    if ( ! function_exists( 'get_simple_likes_button' ) ) {
        function get_simple_likes_button( $id ) {
            return;
        }
    }
}

// Remove VC redirection
if( class_exists( 'Vc_Manager' ) ) {
    remove_action( 'vc_activation_hook', 'vc_page_welcome_set_redirect' );
    remove_action( 'admin_init', 'vc_page_welcome_redirect' );
}

// Post excerpt
add_filter('the_content', 'hcode_trim_excerpts');
if ( ! function_exists( 'hcode_trim_excerpts' ) ) {
    function hcode_trim_excerpts($content = false) {
        global $post;

        /* To fixed Business directory plugin issue */
        if( get_post_type() == 'wpbdp_listing' ) {
            if( is_archive() ) {
                $content = str_replace("|br|", "<br>", $content );
                return $content;
            }
        }

        if( !is_singular() && !is_admin() ){
            $content = $post->post_excerpt;
            // If an excerpt is set in the Optional Excerpt box
            if( $content ) {
                $content = apply_filters('the_excerpt', $content);

            } else {
                $content = $post->post_content;
            }
        }
        $content = str_replace( "|br|", "<br>", $content );
        // Make sure to return the content
        return $content;
    }
}

if ( ! function_exists( 'hcode_enqueue_fonts_url' ) ) :

function hcode_enqueue_fonts_url( $swap = true ) {

    global $hcode_theme_settings;

    $hcode_fonts_url = '';
    $hcode_fonts = $hcode_main_font_weight = $hcode_alt_font_weight = $hcode_font_subsets = array();

    /* For Main Font Weight */
    $hcode_main_font_weight_array = ( isset( $hcode_theme_settings['main_font_weight'] ) ) ? $hcode_theme_settings['main_font_weight'] : '';
    if( !empty( $hcode_main_font_weight_array ) ) {
        foreach ($hcode_main_font_weight_array as $key => $value) {
            if( $value == 1 ){
                $hcode_main_font_weight[] = $key;
            }
        }
    }

    if( !empty( $hcode_main_font_weight ) ) {
        $hcode_main_font_weight = implode( ',', $hcode_main_font_weight );
    } else {
        $hcode_main_font_weight = '100,300,400,500,600,700,800,900';
    }

    if( isset($hcode_theme_settings['main_font']['font-family']) && $hcode_theme_settings['main_font']['font-family'] ){
        $hcode_fonts[] = $hcode_theme_settings['main_font']['font-family'].':'.$hcode_main_font_weight;
    }else{
        $hcode_fonts[] = 'Open Sans:100,300,400,500,600,700,800,900';
    }

    /* For Alt Font Weight */
    $hcode_alt_font_weight_array = ( isset( $hcode_theme_settings['alt_font_weight'] ) ) ? $hcode_theme_settings['alt_font_weight'] : '';
    if( !empty( $hcode_alt_font_weight_array ) ) {
        foreach ($hcode_alt_font_weight_array as $key => $value) {
            if( $value == 1 ){
                $hcode_alt_font_weight[] = $key;
            }
        }
    }

    if( !empty( $hcode_alt_font_weight ) ) {
        $hcode_alt_font_weight = implode( ',', $hcode_alt_font_weight );
    } else {
        $hcode_alt_font_weight = '100,300,400,500,600,700,800,900';
    }
    if( isset( $hcode_theme_settings['alt_font']['font-family'] ) && $hcode_theme_settings['alt_font']['font-family'] ){
        $hcode_fonts[] = $hcode_theme_settings['alt_font']['font-family'].':'.$hcode_alt_font_weight;
    }else{
        $hcode_fonts[] = 'Oswald:100,300,400,500,600,700,800,900';
    }

    /* For Font Subsets */
    $hcode_main_font_subsets = ( isset( $hcode_theme_settings['main_font_languages'] ) ) ? $hcode_theme_settings['main_font_languages'] : '' ;
    if( !empty( $hcode_main_font_subsets ) ) {
        foreach ($hcode_main_font_subsets as $key => $value) {
            if( $value == 1 ){
                $hcode_font_subsets[] = $key;
            }
        }
    }
    if( !empty( $hcode_font_subsets ) ) {
        $hcode_main_font_subsets = implode( ',',  $hcode_font_subsets );
    } else {
        $hcode_main_font_subsets = '';
    }
    if ( $hcode_fonts ) {
        $hcode_fonts_url = add_query_arg( array(
            'family' => urlencode( implode( '|', $hcode_fonts ) ),
            'subset' => urlencode( $hcode_main_font_subsets ),
        ), '//fonts.googleapis.com/css' );
    }
    if( $swap ) {
        $hcode_fonts_url = add_query_arg( array(
            'display' => 'swap',
        ), $hcode_fonts_url );
    }
    return $hcode_fonts_url;
}
endif;

if ( ! function_exists( 'hcode_font_scripts' ) ) :
    function hcode_font_scripts() {
        global $hcode_theme_settings;

        $disable_google_fonts = ( isset( $hcode_theme_settings['disable_google_fonts'] ) ) ? $hcode_theme_settings['disable_google_fonts'] : '' ;
        if( $disable_google_fonts != 1 ) {
            $hcode_performance_google_fonts_render = ( isset( $hcode_theme_settings['hcode_performance_google_fonts_render'] ) ) ? $hcode_theme_settings['hcode_performance_google_fonts_render'] : '' ;
            if( $hcode_performance_google_fonts_render != 1 ) {
                wp_enqueue_style( 'hcode-fonts', hcode_enqueue_fonts_url(), array(), null );
            }
        }
    }
endif;
add_action( 'wp_enqueue_scripts', 'hcode_font_scripts' );

add_action( 'wp_footer', 'hcode_load_font_faster_render', 99 );
if( ! function_exists( 'hcode_load_font_faster_render' ) ) :
    function hcode_load_font_faster_render(){
        global $hcode_theme_settings;

        $hcode_performance_google_fonts_render = ( isset( $hcode_theme_settings['hcode_performance_google_fonts_render'] ) ) ? $hcode_theme_settings['hcode_performance_google_fonts_render'] : '' ;
        if( $hcode_performance_google_fonts_render == 1 ) {
            $disable_google_fonts = ( isset( $hcode_theme_settings['disable_google_fonts'] ) ) ? $hcode_theme_settings['disable_google_fonts'] : '' ;
            if( $disable_google_fonts != 1 ) {
                $hcode_enqueue_fonts_url = hcode_enqueue_fonts_url( false );
                if( $hcode_enqueue_fonts_url ) {
                    ?>
<link rel="dns-prefetch" href="https://fonts.googleapis.com/">
<link rel="preconnect" href="https://fonts.googleapis.com/" crossorigin="anonymous">
<link rel="preload" href="<?php echo esc_url( $hcode_enqueue_fonts_url ) ?>" as="font" crossorigin="anonymous">
<script type="text/javascript">
!function(e,n,t){"use strict";var o="<?php echo esc_url( $hcode_enqueue_fonts_url ) ?>",r="__3perf_googleFonts_a1ce4";function c(e){(n.head||n.body).appendChild(e)}function a(){var e=n.createElement("link");e.href=o,e.rel="stylesheet",c(e)}function f(e){if(!n.getElementById(r)){var t=n.createElement("style");t.id=r,c(t)}n.getElementById(r).innerHTML=e}e.FontFace&&e.FontFace.prototype.hasOwnProperty("display")?(t[r]&&f(t[r]),fetch(o).then(function(e){return e.text()}).then(function(e){return e.replace(/@font-face {/g,"@font-face{font-display:swap;")}).then(function(e){return t[r]=e}).then(f).catch(a)):a()}(window,document,localStorage);
</script>
                <?php
                }
            }
        }
    }
endif;
/* End Google Fonts Render Faster */


if ( ! function_exists( 'hcode_check_enable_mini_header' ) ) :
    function hcode_check_enable_mini_header() {

        $hcode_enable_mini_header           = hcode_option( 'hcode_enable_mini_header' );
        $hcode_enable_mini_header_sidebar   = hcode_option( 'hcode_enable_mini_header_sidebar' );

        if( $hcode_enable_mini_header == 1 && !empty( $hcode_enable_mini_header_sidebar ) && is_active_sidebar( $hcode_enable_mini_header_sidebar ) ) {
            return true;
        }

        return false;
    }
endif;

if ( ! function_exists( 'hcode_extract_shortcode_contents' ) ) :
    /**
     * Extract text contents from all shortcodes for usage in excerpts
     *
     * @return string The shortcode contents
     **/
    function hcode_extract_shortcode_contents( $m ) {
        global $shortcode_tags;

        // Setup the array of all registered shortcodes
        $shortcodes = array_keys( $shortcode_tags );
        $no_space_shortcodes = array( 'dropcap' );
        $omitted_shortcodes  = array( 'slide' );

        // Extract contents from all shortcodes recursively
        if ( in_array( $m[2], $shortcodes ) && ! in_array( $m[2], $omitted_shortcodes ) ) {
            $pattern = get_shortcode_regex();
            // Add space the excerpt by shortcode, except for those who should stick together, like dropcap
            $space = ' ' ;
            if ( in_array( $m[2], $no_space_shortcodes ) ) {
                $space = '' ;
            }
            $content = preg_replace_callback( "/$pattern/s", 'hcode_extract_shortcode_contents', rtrim( $m[5] ) . $space );
            return $content;
        }

        // allow [[foo]] syntax for escaping a tag
        if ( $m[1] == '[' && $m[6] == ']' ) {
            return substr( $m[0], 1, -1 );
        }

       return $m[1] . $m[6];
    }
endif;

if ( ! function_exists( 'hcode_theme_active_licence' ) ) :
    function hcode_theme_active_licence( $value ='no' ) {
        $hcode_option_name = 'hcode_theme_active' ;
        if ( get_option( $hcode_option_name ) !== false ) {
            update_option( $hcode_option_name, $value );
        } else {
            $deprecated = null;
            $autoload = 'no';
            add_option( $hcode_option_name, $value, $deprecated, $autoload );
        }
    }
endif;

if ( ! function_exists( 'hcode_is_theme_licence_active' ) ) :
    function hcode_is_theme_licence_active() {
        $hcode_theme_active = get_option( 'hcode_theme_active' );
        if( $hcode_theme_active == 'yes' || defined('ENVATO_HOSTED_SITE') ){
            return true;
        } else {
            return false;
        }
    }
endif;

if ( ! function_exists( 'hcode_theme_activate' ) ) :
    function hcode_theme_activate() {
        global $pagenow;
        if( !hcode_is_theme_licence_active() ){
            if( is_admin() && 'themes.php' == $pagenow && isset( $_GET[ 'activated' ] ) ) {
                wp_redirect( admin_url( 'themes.php?page=hcode-licence-activation' ) );
                exit;
            }
        }

    }
endif;
add_action( 'after_setup_theme', 'hcode_theme_activate', 11 );

if ( ! function_exists( 'hcode_get_host' ) ) :
    function hcode_get_host() {
        $hcode_api_host = 'http://api.themezaa.com';
        return $hcode_api_host;
    }
endif;

if ( ! function_exists( 'hcode_random_string' ) ) :
    function hcode_random_string( $length = 20 ) {
        $characters = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $len = strlen( $characters );
        $str = '';
        for ( $i = 0; $i < $length; $i ++ ) {
            $str .= $characters[ rand( 0, $len - 1 ) ];
        }

        return $str;
    }
endif;

if ( ! function_exists( 'hcode_generate_theme_licence_activation_url' ) ) :
    function hcode_generate_theme_licence_activation_url() {
            
        $hcode_licence_api = hcode_get_host();

        $hcode_token = sha1( current_time( 'timestamp' ) . '|' . hcode_random_string(20) );
        $hcode_home_url = esc_url( home_url( '/' ) );

        $hcode_redirect = admin_url( 'themes.php?page=hcode-licence-activation' );
                    
        if ( false === ( $hcode_token == get_transient( 'hcode_licence_token' ) ) ) {
            set_transient( 'hcode_licence_token', $hcode_token, HOUR_IN_SECONDS );
        }
        $hcode_get_transient = get_transient( 'hcode_licence_token' );

        return sprintf( '%s?token=%s&url=%s&redirect=%s&itemid=%s', $hcode_licence_api.'/activate-license/', $hcode_get_transient, $hcode_home_url, $hcode_redirect, '14561695' );
    }
endif;

if ( ! function_exists( 'hcode_theme_licence_notice' ) ) :
    function hcode_theme_licence_notice() {
        
        if( !empty( $_COOKIE['hcode_hide_activation_message'] ) || hcode_is_theme_licence_active() ) {
            return;
        }

        if( isset( $_GET['response'] ) ) {
            if( $_GET['response'] == 'true' ) {
                return;
            }
        }

        $class = 'notice notice-success hcode-license-activation-message is-dismissible';
        $message = esc_html__( 'Please activate your H-Code WordPress theme license to unlock H-Code premium features.', 'H-Code' );

        printf( '<div class="%1$s"><p>%2$s</p></div>', esc_attr( $class ), esc_html( $message ) ); 
    }
endif;
add_action( 'admin_notices', 'hcode_theme_licence_notice' );

if ( ! function_exists( 'hcode_add_default_cursor' ) ) :
    function hcode_add_default_cursor() {
        
        $hcode_custom_css = '';
        $hcode_options = get_option( 'hcode_theme_setting' );

        $hcode_show_default_cursor_image =  (isset($hcode_options['hcode_show_default_cursor_image']) && !empty($hcode_options['hcode_show_default_cursor_image'])) ? $hcode_options['hcode_show_default_cursor_image'] : '';

        if( $hcode_show_default_cursor_image != 1 ) {
            $hcode_custom_css .= "figure:hover img, figure:hover figcaption, .popup-gallery img, .lightbox-gallery img, .image-popup-no-margins img, .image-popup-vertical-fit img, .zoom-gallery img { cursor: pointer !important }";
            $hcode_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container, .mfp-auto-cursor .mfp-content { cursor: pointer !important }";
        } else {
            /* For Open Cursor */
            $hcode_default_open_cursor_image = (isset($hcode_options['hcode_default_open_cursor_image']) && !empty($hcode_options['hcode_default_open_cursor_image'])) ? $hcode_options['hcode_default_open_cursor_image'] : '';
            if( isset( $hcode_default_open_cursor_image['url'] ) && !empty( $hcode_default_open_cursor_image['url'] ) ){
                $hcode_custom_css .= "figure:hover img, figure:hover figcaption,.popup-gallery img, .lightbox-gallery img, .image-popup-no-margins img, .image-popup-vertical-fit img, .zoom-gallery img { cursor: url('".esc_url($hcode_default_open_cursor_image['url'])."'), pointer !important }";
            }

            /* For Close Cursor */
            $hcode_default_close_cursor_image = (isset($hcode_options['hcode_default_close_cursor_image']) && !empty($hcode_options['hcode_default_close_cursor_image'])) ? $hcode_options['hcode_default_close_cursor_image'] : '';
            if( isset( $hcode_default_close_cursor_image['url'] ) && !empty( $hcode_default_close_cursor_image['url'] ) ){
                $hcode_custom_css .= ".mfp-zoom-out-cur, .mfp-zoom-out-cur .mfp-image-holder .mfp-close, .mfp-image-holder, .mfp-iframe-holder, .mfp-close-btn-in, .mfp-content, .mfp-container { cursor: url('".esc_url($hcode_default_close_cursor_image['url'])."'), pointer !important }";
            }
        }

        wp_add_inline_style( 'hcode-magnific-popup-style', $hcode_custom_css );
    }
endif;
add_action( 'wp_enqueue_scripts', 'hcode_add_default_cursor', 999 );

add_filter( 'body_class', 'hcode_add_body_class' );
if ( ! function_exists( 'hcode_add_body_class' ) ) :
    function hcode_add_body_class( $classes ) {

        $hcode_options = get_option( 'hcode_theme_setting' );

        $hcode_popup_on_click_close =  (isset($hcode_options['hcode_popup_on_click_close']) && !empty($hcode_options['hcode_popup_on_click_close'])) ? $hcode_options['hcode_popup_on_click_close'] : '';
        if( $hcode_popup_on_click_close != 1 ) {
            $classes[] = 'hcode-custom-popup-close';
        }           

        if( ( isset( $hcode_options['enable_lightbox_title'] ) && $hcode_options['enable_lightbox_title'] == 1 ) || ( isset( $hcode_options['enable_lightbox_caption'] ) && $hcode_options['enable_lightbox_caption'] == 1 ) ){
            $classes[] = 'hcode-custom-lightbox-title';
        }
        $classes[] = 'hcode-menu-custom-color';
        return $classes;
    }
endif;

if ( ! function_exists( 'hcode_admin_favicon' ) ) :
    function hcode_admin_favicon() {
        
        global $hcode_theme_settings;

        $enable_theme_favicon = ( isset( $hcode_theme_settings[ 'enable_theme_favicon' ] ) ) ? $hcode_theme_settings[ 'enable_theme_favicon' ] : 1;
        $hcode_favicon_meta_tags = array();
        if( $enable_theme_favicon ) {
            if( hcode_option( 'default_favicon' ) ) {
                $default_favicon = hcode_option_url( 'default_favicon' );
                $hcode_favicon_meta_tags[] = sprintf( '<link rel="shortcut icon" href="%s" />', esc_url( $default_favicon ) );
            }
            if( hcode_option( 'apple_iPhone_favicon' ) ) {
                $apple_iPhone_favicon = hcode_option_url( 'apple_iPhone_favicon' );
                $hcode_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" href="%s" />', esc_url( $apple_iPhone_favicon ) );
            }
            if( hcode_option( 'apple_iPad_favicon' ) ) {
                $apple_iPad_favicon = hcode_option_url( 'apple_iPad_favicon' );
                $hcode_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="72x72" href="%s" />', esc_url( $apple_iPad_favicon ) );
            }
            if( hcode_option( 'apple_iPhone_retina_favicon' ) ) {
                $apple_iPhone_retina_favicon = hcode_option_url( 'apple_iPhone_retina_favicon' );
                $hcode_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="114x114" href="%s" />', esc_url( $apple_iPhone_retina_favicon ) );
            }
            if( hcode_option( 'apple_iPad_retina_favicon' ) ) {
                $apple_iPad_retina_favicon = hcode_option_url( 'apple_iPad_retina_favicon' );
                $hcode_favicon_meta_tags[] = sprintf( '<link rel="apple-touch-icon" sizes="149x149" href="%s" />', esc_url( $apple_iPad_retina_favicon ) );
            }

            if( count( $hcode_favicon_meta_tags ) >= 1 ) {
                foreach ( $hcode_favicon_meta_tags as $hcode_favicon_meta_tag ) {
                    echo "$hcode_favicon_meta_tag\n";
                }
            }
        }
    }
endif;    
add_action( 'admin_head', 'hcode_admin_favicon', 99999 );
add_action( 'wp_head', 'hcode_admin_favicon', 99999 );

if ( ! function_exists( 'hcode_space_before_head' ) ) :
    function hcode_space_before_head() {
        
        if ( is_singular() && pings_open() ) {
            printf( '<link rel="pingback" href="%s">' . "\n", get_bloginfo( 'pingback_url' ) );
        }

        if( hcode_option( 'general_css_code' ) ) { ?>
            <style>
                <?php echo hcode_option( 'general_css_code' ); ?>
            </style>
        <?php }
    
        if( hcode_option( 'tracking_code' ) ) {
            echo hcode_option( 'tracking_code' );
        }

        if( hcode_option( 'space_before_head' ) ) {
            echo hcode_option( 'space_before_head' );
        }
    }
endif;    
add_action( 'wp_head', 'hcode_space_before_head', 99999 );

if ( ! function_exists( 'hcode_space_before_body' ) ) :
    function hcode_space_before_body() {
        if( hcode_option( 'space_before_body' ) ):
            echo hcode_option( 'space_before_body' );
        endif;
    }
endif;    
add_action( 'wp_footer', 'hcode_space_before_body', 99999 );

if ( ! function_exists( 'hcode_get_header_layout' ) ) :
    function hcode_get_header_layout( $type = 'title' ) {

        if( $type == 'preview' ) {

            return array(
                            "headertype1" => get_template_directory_uri()."/assets/images/header1.jpg",
                            "headertype2" => get_template_directory_uri()."/assets/images/header2.jpg",
                            "headertype3" => get_template_directory_uri()."/assets/images/header3.jpg",
                            "headertype4" => get_template_directory_uri()."/assets/images/header4.jpg",
                            "headertype5" => get_template_directory_uri()."/assets/images/header5.jpg",
                            "headertype6" => get_template_directory_uri()."/assets/images/header6.jpg",
                            "headertype7" => get_template_directory_uri()."/assets/images/header7.jpg",
                            "headertype8" => get_template_directory_uri()."/assets/images/header6.jpg",
                            "headertype9" => get_template_directory_uri()."/assets/images/header9.jpg",
                            "headertype10"=> get_template_directory_uri()."/assets/images/header10.jpg",
                            "headertype11"=> get_template_directory_uri()."/assets/images/header11.jpg",
                        );
        } else if( $type == 'meta_fields' ) {

            return array(  
                            'default'     => esc_html__('Default', 'H-Code'),
                            'headertype1' => esc_html__('Light Header', 'H-Code'),
                            'headertype2' => esc_html__('Dark Header', 'H-Code'),
                            'headertype3' => esc_html__('Dark Transparent Header', 'H-Code'),
                            'headertype4' => esc_html__('Light Transparent Header', 'H-Code'),
                            'headertype5' => esc_html__('Static Sticky Header', 'H-Code'),
                            'headertype6' => esc_html__('White Sticky Header', 'H-Code'),
                            'headertype7' => esc_html__('Gray Header', 'H-Code'),
                            'headertype8' => esc_html__('Non Sticky Header', 'H-Code'),
                            'headertype9' => esc_html__('Hamburger Header 1', 'H-Code'),
                            'headertype10'=> esc_html__('Hamburger Header 2', 'H-Code'),
                            'headertype11'=> esc_html__('Hamburger Header 3', 'H-Code'),
                        );
        } else {

            return array(  
                            'imgtitle1'   => esc_html__('Light Header', 'H-Code'),
                            'imgtitle2'   => esc_html__('Dark Header', 'H-Code'),
                            'imgtitle3'   => esc_html__('Dark Transparent Header', 'H-Code'),
                            'imgtitle4'   => esc_html__('Light Transparent Header', 'H-Code'),
                            'imgtitle5'   => esc_html__('Static Sticky Header', 'H-Code'),
                            'imgtitle6'   => esc_html__('White Sticky Header', 'H-Code'),
                            'imgtitle7'   => esc_html__('Gray Header', 'H-Code'),
                            'imgtitle8'   => esc_html__('Non Sticky Header', 'H-Code'),
                            'imgtitle9'   => esc_html__('Hamburger Header 1', 'H-Code'),
                            'imgtitle10'  => esc_html__('Hamburger Header 2', 'H-Code'),
                            'imgtitle11'  => esc_html__('Hamburger Header 3', 'H-Code'),
                        );
        }
    }
endif;

if( ! function_exists( 'hcode_get_intermediate_image_sizes' ) ) :
    function hcode_get_intermediate_image_sizes() {
        global $wp_version;
        $image_sizes = array( 'full', 'thumbnail', 'medium', 'medium_large', 'large' ); // Standard sizes
        if( $wp_version >= '4.7.0' ){
            $_wp_additional_image_sizes = wp_get_additional_image_sizes();
            if ( ! empty( $_wp_additional_image_sizes ) ) {
                $image_sizes = array_merge( $image_sizes, array_keys( $_wp_additional_image_sizes ) );
            }
            return apply_filters( 'intermediate_image_sizes', $image_sizes );
        } else {
            return $image_sizes;
        }
    }
endif;

if( ! function_exists( 'hcode_get_image_sizes' ) ) :
    function hcode_get_image_sizes() {
        global $_wp_additional_image_sizes;

        $sizes = array();

        foreach ( get_intermediate_image_sizes() as $_size ) {
            if ( in_array( $_size, array('full', 'thumbnail', 'medium', 'medium_large', 'large') ) ) {
                $sizes[ $_size ]['width']  = get_option( "{$_size}_size_w" );
                $sizes[ $_size ]['height'] = get_option( "{$_size}_size_h" );
                $sizes[ $_size ]['crop']   = (bool) get_option( "{$_size}_crop" );
            } elseif ( isset( $_wp_additional_image_sizes[ $_size ] ) ) {
                $sizes[ $_size ] = array(
                    'width'  => $_wp_additional_image_sizes[ $_size ]['width'],
                    'height' => $_wp_additional_image_sizes[ $_size ]['height'],
                    'crop'   => $_wp_additional_image_sizes[ $_size ]['crop'],
                );
            }
        }
        return $sizes;
    }
endif;

if( ! function_exists( 'hcode_get_image_size' ) ) :
        function hcode_get_image_size( $size ) {
            $sizes = hcode_get_image_sizes();

            if ( isset( $sizes[ $size ] ) ) {
                return $sizes[ $size ];
            }

            return false;
        }
    endif;

if( ! function_exists( 'hcode_get_thumbnail_image_sizes' ) ) :
    function hcode_get_thumbnail_image_sizes() {

        $thumbnail_image_sizes = array();

        // Hackily add in the data link parameter.
        $hcode_srcset = hcode_get_intermediate_image_sizes();

        if(!empty($hcode_srcset)) {
            foreach ( $hcode_srcset as $value => $label ){
                
                if( 'full' === $label ) {
                    $data = esc_html__( 'Original Full Size', 'H-Code' );
                } else {
                    $hcode_srcset_image_data = hcode_get_image_size( $label );
                    $width = ( $hcode_srcset_image_data['width'] == 0 ) ? esc_html( 'Auto', 'H-Code' ) : $hcode_srcset_image_data['width'].'px';
                    $height = ( $hcode_srcset_image_data['height'] == 0 ) ? esc_html( 'Auto', 'H-Code' ) : $hcode_srcset_image_data['height'].'px';

                    $data = ucwords( str_replace( '_', ' ', str_replace( '-', ' ', esc_attr( $label ) ) ) ).' ('.esc_attr( $width ).' X '.esc_attr( $height ).')';
                }

                $thumbnail_image_sizes[$data] = $label;
            }
        }

        return $thumbnail_image_sizes;
    }
endif;

if ( ! function_exists( 'hcode_hide_feature_image' ) ) :
    function hcode_hide_feature_image( $classes ) {

        if( is_single() ) {

            $hcode_options = get_option( 'hcode_theme_setting' );
            $hcode_disable_feature_image = ( isset( $hcode_options[ 'hcode_disable_feature_image' ] ) ) ? $hcode_options[ 'hcode_disable_feature_image' ] : '';

            if( $hcode_disable_feature_image != 1 ){
                $classes[] = 'hide-post-feature-image';
            }
        }
        
        return $classes;
    }
endif;
add_filter( 'post_class', 'hcode_hide_feature_image' );

add_filter( 'the_privacy_policy_link', 'hcode_privacy_policy_link' );

if ( ! function_exists( 'hcode_privacy_policy_link' ) ) :
    function hcode_privacy_policy_link( $link ) {
        $link = str_replace( 'privacy-policy-link', 'privacy-policy-link light-gray-text2 vertical-align-middle', $link );
        return $link;
    }
endif;


/* Body BG image */
add_action( 'wp_head', 'hcode_background_image_callback' );

if ( ! function_exists( 'hcode_background_image_callback' ) ) :
    function hcode_background_image_callback() {
        global $hcode_theme_settings, $post;

        $image_flag = true;
        $hcode_body_image = '';
        if( is_page() || is_single() || is_singular( 'portfolio' ) ) {
            $single_bg_image = get_post_meta( $post->ID, 'hcode_bg_image_single', true );
            if( esc_url( $single_bg_image ) ) {
                $hcode_body_image = $single_bg_image;
                $image_flag = false;
            }
        } 
        if( $image_flag ) {
            if( isset( $hcode_theme_settings['hcode_general_bg_image'] ) && $hcode_theme_settings['hcode_general_bg_image'] != ''){
                $hcodeimage = $hcode_theme_settings['hcode_general_bg_image'];
                $general_image =$hcodeimage['url'];
                
                if( esc_url( $general_image ) ) {
                    $hcode_body_image = $general_image;
                }
            }
        }
        
        if( $hcode_body_image ) {
        ?>
        <style type="text/css" id="hcode-background-image-css">body {background-image: url(<?php echo esc_url( $hcode_body_image ); ?>) !important;background-repeat: no-repeat !important;background-position: 50% 50% !important;-webkit-background-size: cover !important;-moz-background-size: cover !important;-o-background-size: cover !important;background-size: cover !important;background-attachment: fixed !important;}</style>
        <?php
        }
    }
endif;

//load button setting css other css 
if( ! function_exists( 'hcode_addons_generate_custom_css' ) ) {
    function hcode_addons_generate_custom_css() {
        global $hcode_featured_array, $style_array,$responsive_style;

        $output_css = '';
        if( !empty($hcode_featured_array)) {
            ob_start();
                echo '<style id="hcode-addon-custom-css" type="text/css">';
                    foreach ($hcode_featured_array as $key => $value) {
                        echo esc_attr( $value );
                    }    
                echo '</style>';
            $output_css = ob_get_contents();
            ob_end_clean();

            // 1. Remove comments.
            // 2. Remove whitespace.
            // 3. Remove starting whitespace.
            $output_css = preg_replace( '#/\*.*?\*/#s', '', $output_css );
            $output_css = preg_replace( '/\s*([{}|:;,])\s+/', '$1', $output_css );
            $output_css = preg_replace( '/\s\s+(.*)/', '$1', $output_css );

            ?>
                <script type="text/javascript"> (function($) { $('head').append('<?php print $output_css; ?>'); })(jQuery); </script>
            <?php   
        }

    }
}
add_action( 'wp_footer', 'hcode_addons_generate_custom_css', 998 );

/* Disable VC auto-update */
if( ! function_exists( 'hcode_vc_disable_update' ) ) {
    function hcode_vc_disable_update() {
        if( function_exists( 'vc_license' ) && function_exists( 'vc_updater' ) && ! vc_license()->isActivated() ) {
            remove_filter( 'upgrader_pre_download', array( vc_updater(), 'preUpgradeFilter' ), 10 );
            remove_filter( 'pre_set_site_transient_update_plugins', array( vc_updater()->updateManager(), 'check_update' ) );
        }
    }
}
add_action( 'admin_init', 'hcode_vc_disable_update', 9 );

/* Custom Header Image */
if( ! function_exists( 'hcode_custom_header_image' ) ) {
    function hcode_custom_header_image() {
        
        $header_image = get_header_image();

        if ( ! empty( $header_image ) ) {
            $hcode_header_image_css = ".navbar { background-image: url( ".esc_url( $header_image )." ) !important; background-repeat: no-repeat !important; background-position: 50% 50% !important; -webkit-background-size: cover !important; -moz-background-size: cover !important; -o-background-size: cover !important; background-size: cover !important; }";
            wp_add_inline_style( 'hcode-responsive-style', $hcode_header_image_css );
        }
    }
}
add_action( 'wp_enqueue_scripts', 'hcode_custom_header_image', 100 );