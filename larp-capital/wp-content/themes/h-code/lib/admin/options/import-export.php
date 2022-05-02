<?php
/**
 * Import / Export Tab For Theme Option.
 *
 * @package H-Code
 */
?>
<?php
$message = $hcode_import_export_notice = $hcode_import_export_button_text = '';
if( isset($_GET['show-message'])){
    $message = 'class="demo-show-message"';
}else{
    $message = 'class="demo-hide-message"';
}

if ( ! function_exists( 'is_plugin_active' ) ) {
    require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
}

if( is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ){
    $hcode_import_export_notice .= '<strong style="color:red; font-size:16px;">'.esc_html__( 'Notice: Please deactivate WordPress Importer plugin and then try demo data import to make it run successfully.', 'H-Code').'</strong><br/><br/>';
}

if( isset( $_GET['page'] ) ) {
if( file_exists( HCODE_THEME_IMPORTER . '/sample-data/H-Code.xml' ) && $_GET['page'] == 'hcode_theme_settings' ) {
    if( !is_plugin_active( 'wordpress-importer/wordpress-importer.php' ) ){

        if( hcode_is_theme_licence_active() ) {
            $hcode_import_export_button_text .= '<div class="wrap">';
                $hcode_import_export_button_text .= '<div id="run-regenerate-thumbnails" '.$message.'>';
                    $hcode_import_export_button_text .= '<div class="hcode-importer-notice">';
                        $hcode_import_export_button_text .= '<strong>'.__( 'Demo data successfully imported. Now, please install and run', 'H-Code').' <a title="' . __( 'Regenerate Thumbnails', 'H-Code' ) . '" class="thickbox" href="'.admin_url( 'plugin-install.php?tab=plugin-information&amp;plugin=regenerate-thumbnails&amp;TB_iframe=true&amp;width=830&amp;height=472' ).'">'. __( 'Regenerate Thumbnails', 'H-Code' ).'</a> '. __( 'plugin once.', 'H-Code' ).'</strong>';
                    $hcode_import_export_button_text .= '</div>';
                $hcode_import_export_button_text .= '</div>';
                
                $hcode_import_export_button_text .= '<div class="import-content import-content-tab-box">';
                    $hcode_import_export_button_text .= '<div class="import-content-top">';
                        $hcode_import_export_button_text .= '<a data-demo-import="full" class="button-primary hcode-import-button hcode-demo-import" href="javascript:void(0);">'. __( 'Import Layouts', 'H-Code' ) .'</a>';
                    $hcode_import_export_button_text .= '</div>';

                    $hcode_import_export_button_text .= '<hr>';

                    $hcode_import_export_button_text .= '<div class="import-content-top">';
                        $hcode_import_export_button_text .= '<a class="single-layout-panel hcode-import-button button-primary import-tab-link" href="javascript:void(0);"><span class="icon-wrapper"><i class="fas fa-columns"></i></span>'. __( 'Single Layouts', 'H-Code' ) .'</a>';
                        $hcode_import_export_button_text .= '<a data-demo-import="settings" class="hcode-demo-import single-click-import hcode-import-button button-primary import-tab-link" href="javascript:void(0);"><span class="icon-wrapper"><i class="fas fa-cog"></i></span>'. __( 'Theme Settings', 'H-Code' ) .'</a>';
                        $hcode_import_export_button_text .= '<a data-demo-import="menu" class="hcode-demo-import single-click-import hcode-import-button button-primary import-tab-link" href="javascript:void(0);"><span class="icon-wrapper"><i class="fas fa-bars"></i></span>'. __( 'Navigation Menu', 'H-Code' ) .'</a>';
                        $hcode_import_export_button_text .= '<a data-demo-import="widgets" class="hcode-demo-import single-click-import hcode-import-button button-primary import-tab-link" href="javascript:void(0);"><span class="icon-wrapper"><i class="fas fa-columns"></i></span>'. __( 'Widgets', 'H-Code' ) .'</a>';
                        
                        if( class_exists('UniteFunctionsRev') ) {
                            $hcode_import_export_button_text .= '<a data-demo-import="rev-slider" class="hcode-demo-import hcode-import-button button-primary import-tab-link" href="javascript:void(0);"><span class="icon-wrapper"><i class="fas fa-columns"></i></span>'. __( 'Revolution Slider', 'H-Code' ) .'</a>';
                        }
                        
                        if( class_exists( 'WPCF7' ) ) {
                            $hcode_import_export_button_text .= '<a data-demo-import="contact-form" class="contact-form-single-click-import hcode-import-button button-primary import-tab-link" href="javascript:void(0);"><span class="icon-wrapper"><i class="fas fa-edit"></i></span>'. __( 'Contact Form', 'H-Code' ) .'</a>';
                        }

                        if( defined('MC4WP_PLUGIN_FILE' ) ) {
                            $hcode_import_export_button_text .= '<a data-demo-import="mailchimp-form" class="hcode-demo-import hcode-import-button button-primary import-tab-link" href="javascript:void(0);"><span class="icon-wrapper"><i class="fab fa-mailchimp"></i></span>'. __( 'Mailchimp Form', 'H-Code' ) .'</a>';
                        }
                        
                    $hcode_import_export_button_text .= '</div>';

                   if ( ! class_exists( 'WXR_Parser' ) ) {
                        require_once get_template_directory() . '/lib/importer/parsers.php';
                    }
                    $parser = new WXR_Parser();
                    $parsed_xml = $parser->parse( HCODE_THEME_IMPORTER . '/sample-data/H-Code.xml' );

                    $post_array = array();
                    $page_array = array();
                    $portfolio_array = array();
                    $product_array = array();
                    $contact_form_array = array();

                    foreach ($parsed_xml['posts'] as $key => $value) {
                        switch ($value['post_type']) {
                            case 'post':
                                $id = array( $value[ 'post_id' ] );
                                $post_array[ $value[ 'post_title' ] ] = array( 'id' => $id );
                            break;
                            case 'page':
                                $id = array( $value[ 'post_id' ] );
                                $page_array[ $value[ 'post_title' ] ] = array( 'id' => $id );
                            break;
                            case 'portfolio':
                                $id = array( $value[ 'post_id' ] );
                                $portfolio_array[ $value[ 'post_title' ] ] = array( 'id' => $id );
                            break;
                            case 'product':
                                $id = array( $value[ 'post_id' ] );
                                $product_array[ $value[ 'post_title' ] ] = array( 'id' => $id );
                            break;
                            case 'wpcf7_contact_form':
                                if( class_exists( 'WPCF7' ) ) {
                                    $id = array( $value[ 'post_id' ] );
                                    $contact_form_array[ $value[ 'post_title' ] ] = array( 'id' => $id );
                                }
                            break;
                        }
                    }

                    if(class_exists('Woocommerce')){
                        $class_single = ' four-column';
                    }else{
                        $class_single = ' three-column';
                    }

                    $hcode_import_export_button_text .= '<div class="single-layout-wrapper hidden">';

                        $hcode_import_export_button_text .= '<div class="post-main'.$class_single.'">';
                            $hcode_import_export_button_text .= '<h3>'.__( 'Posts', 'H-Code' ).'</h3>';
                            $hcode_import_export_button_text .= '<select name="post[]" multiple>';
                                
                                ksort($post_array);
                                foreach ($post_array as $key => $value) {
                                    $hcode_import_export_button_text .= '<option value="'.esc_attr(implode(',', $value['id'])).'">'.$key.'</option>';
                                }
                                
                            $hcode_import_export_button_text .= '</select>';
                        $hcode_import_export_button_text .= '</div>';
                        $hcode_import_export_button_text .= '<div class="page-main'.$class_single.'">';
                            $hcode_import_export_button_text .= '<h3>'.__( 'Pages', 'H-Code' ).'</h3>';
                            $hcode_import_export_button_text .= '<select name="page[]" multiple>';
                                
                                ksort($page_array);
                                foreach ($page_array as $key => $value) {
                                    $hcode_import_export_button_text .= '<option value="'.esc_attr(implode(',', $value['id'])).'">'.$key.'</option>';
                                }
                                
                            $hcode_import_export_button_text .= '</select>';
                        $hcode_import_export_button_text .= '</div>';
                        $hcode_import_export_button_text .= '<div class="portfolio-main'.$class_single.'">';
                            $hcode_import_export_button_text .= '<h3>'.__( 'Portfolio', 'H-Code' ).'</h3>';
                            $hcode_import_export_button_text .= '<select name="portfolio[]" multiple>';
                                
                                ksort($portfolio_array);
                                foreach ($portfolio_array as $key => $value) {
                                    $hcode_import_export_button_text .= '<option value="'.esc_attr(implode(',', $value['id'])).'">'.$key.'</option>';
                                }
                                
                            $hcode_import_export_button_text .= '</select>';
                        $hcode_import_export_button_text .= '</div>';

                        if(class_exists('Woocommerce')){
                            $hcode_import_export_button_text .= '<div class="product-main'.$class_single.'">';
                                $hcode_import_export_button_text .= '<h3>'.__( 'product', 'H-Code' ).'</h3>';
                                $hcode_import_export_button_text .= '<select name="product[]" multiple>';
                                    
                                    ksort($product_array);
                                    foreach ($product_array as $key => $value) {
                                        $hcode_import_export_button_text .= '<option value="'.esc_attr(implode(',', $value['id'])).'">'.$key.'</option>';
                                    }
                                                                    
                                $hcode_import_export_button_text .= '</select>';
                            $hcode_import_export_button_text .= '</div>';
                        }

                        $hcode_import_export_button_text .= '<div class="import-content-top">';
                            $hcode_import_export_button_text .= '<a data-demo-import="import-single" id="hcode-single-demo-import" class="button-primary hcode-demo-import" href="javascript:void(0);">'. __( 'Import Singles', 'H-Code' ) .'</a>';
                        $hcode_import_export_button_text .= '</div>';
                    $hcode_import_export_button_text .= '</div>';

                    if( class_exists( 'WPCF7' ) ) {
                        $hcode_import_export_button_text .= '<div class="contact-form-wrapper hidden">';
                            $hcode_import_export_button_text .= '<div class="contact-form-main post-main four-column">';
                                $hcode_import_export_button_text .= '<h3>Contact Form</h3>';
                                $hcode_import_export_button_text .= '<select name="contactform[]" multiple>';
                                    
                                    ksort($contact_form_array);
                                    foreach ($contact_form_array as $key => $value) {
                                        $hcode_import_export_button_text .= '<option value="'.esc_attr(implode(',', $value['id'])).'">'.$key.'</option>';
                                    }
                                    
                                $hcode_import_export_button_text .= '</select>';
                            $hcode_import_export_button_text .= '</div>';
                            $hcode_import_export_button_text .= '<div class="import-content-top">';
                                $hcode_import_export_button_text .= '<a data-demo-import="contact-form" id="hcode-single-demo-import" class="button-primary hcode-demo-import" href="javascript:void(0);">'. __( 'Import Contact Form', 'H-Code' ) .'</a>';
                            $hcode_import_export_button_text .= '</div>';
                        $hcode_import_export_button_text .= '</div>';
                    }
                    
                    $hcode_import_export_button_text .= '<hr>';

                    $hcode_import_export_button_text .= '<div class="import-content-top">';
                        $hcode_import_export_button_text .= '<a data-demo-import="delete-demo-media" class="button-primary hcode-import-button hcode-demo-import" href="javascript:void(0);">'. __( 'delete DEMO MEDIA', 'H-Code' ) .'</a>';
                    $hcode_import_export_button_text .= '</div>';
                $hcode_import_export_button_text .= '</div>';
            $hcode_import_export_button_text .= '</div>';
            $hcode_import_export_button_text .= '<div class="import-ajax-message"></div>';
        } else {
            $hcode_import_export_button_text .= '<div class="demo-licence-not-activated">
                <div class="licence-not-activated"><i class="fas fa-info-circle"></i><span>'.__( 'Please activate your H-Code theme license copy to enjoy premium feature of demo data import.', 'H-Code' ).'</span></div><br>
                <a class="hcode-demo-import-licence" href="'.admin_url( 'themes.php?page=hcode-licence-activation' ).'">'.__( 'Activate H-Code WordPress Theme License', 'H-Code' ).'</a>
            </div>';
        }
    }
}
}

$this->sections[] = array(
    'title' => esc_html__('Import/Export', 'H-Code'),
    'desc' => esc_html__('Import/Export options', 'H-Code'),
    'icon' => 'fas fa-exchange-alt icon-rotate-90',
    'fields' => array(
        
        array(
            'id'            => 'hcode_import_sample_data',
            'type'          => 'raw',
            'title'         => '',
            'content'       => $hcode_import_export_notice.'<strong>'.esc_html__('Import Demo Content', 'H-Code').'</strong>
                <p class="description">'.esc_html__('Import demo content data including posts, pages, portfolio, theme options, widgets, images, sliders etc... It may take several minutes, so please have some patience.', 'H-Code').'</p><br/>
                <strong>'.esc_html__('Warning', 'H-Code').'</strong>
                <p class="description">'.esc_html__('Importing demo content will import sliders, pages, posts, portfolio, theme options, widgets, sidebars and other settings. Your existing setup will be replaced with new demo data and settings from the installed theme version demo content and configurations. So we recommend you take the backup of your existing WordPress setup and database for your safety.', 'H-Code').'</p></br>
                <strong>'.esc_html__('Demo Import Requirements', 'H-Code').'</strong>
                <ul class="import-export-desc">
                    <li><i class="fas fa-check"></i>'.esc_html__('Memory Limit of 256 MB and max execution time (php time limit) of 300 seconds.', 'H-Code').'</li>
                    <li><i class="fas fa-check"></i>'.esc_html__('Hcode Addon must be activated for Custom post type and Shortcodes to import.', 'H-Code').'</li>
                    <li><i class="fas fa-check"></i>'.esc_html__('WPBakery Page Builder and Revolution Slider must be activated for content and sliders to import.', 'H-Code').'</li>
                    <li><i class="fas fa-check"></i>'.esc_html__('WooCommerce must be activated for shop data to import.', 'H-Code').'</li>
                    <li><i class="fas fa-check"></i>'.esc_html__('Contact Form 7 must be activated for form data to import.', 'H-Code').'</li>
                    <li><i class="fas fa-check"></i>'.esc_html__('Mailchimp must be activated for newsletter form data to import.', 'H-Code').'</li>
                </ul>
                '.$hcode_import_export_button_text
        ),
        
        array(
            'id'            => 'opt-import-export',
            'type'          => 'import_export',
            'title'         => esc_html__('Import / Export', 'H-Code'),
            'subtitle'      => esc_html__('Save and restore your H-Code options', 'H-Code'),
            'full_width'    => false
        )
    ),
);