<?php
/**
 * hcode import data.
 *
 * @package hcode
 */
?>
<?php
    if( !defined( 'ABSPATH' ) ) {
        exit; // Exit if accessed directly
    }

    // Don't resize images for import
    if ( ! function_exists( 'hcode_no_image_resize' ) ) :
        function hcode_no_image_resize( $sizes ) {
            return array();
        }
    endif;

    // Hook For Import Sample Data And Log Messages.
    add_action( 'wp_ajax_hcode_import_sample_data', 'hcode_import_sample_data' );
    add_action( 'wp_ajax_hcode_refresh_import_log', 'hcode_refresh_import_log' );

    if ( ! function_exists( 'hcode_import_sample_data' ) ) :
        function hcode_import_sample_data() {
            global $wpdb;

            if ( current_user_can( 'manage_options' ) ) {

                /* Load WP Importer */
                if ( !defined( 'WP_LOAD_IMPORTERS' ) ) define( 'WP_LOAD_IMPORTERS', true );

                /* Check if main importer class doesn't exist */
                if ( ! class_exists( 'WP_Importer' ) ) {
                    $wp_importer = ABSPATH . 'wp-admin/includes/class-wp-importer.php';
                    include $wp_importer;
                }
                
                // if WP importer doesn't exist
                if ( ! class_exists( 'WP_Import' ) ) {
                    $wp_import = HCODE_THEME_IMPORTER . '/wordpress-importer.php';
                    include_once $wp_import;
                }

                // check for main import class and wp import class.
                if ( class_exists( 'WP_Importer' ) && class_exists( 'WP_Import' ) ) { 

                    hcode_log( '', false );

                    if( !empty( $_POST['setup_key'] ) ) {

                        $import_options = isset( $_POST['import_options'] ) ? $_POST['import_options'] : '';                        
                        $setup_key      = $_POST['setup_key'];

                        add_filter( 'intermediate_image_sizes_advanced', 'hcode_no_image_resize' );
                        
                        // Sample Data Zip.
                        $sample_data_xml = dirname( __FILE__ ) . '/sample-data/H-Code.xml';
                        $sample_mailchimp_data_xml = dirname( __FILE__ ) . '/sample-data/mail_chimp.xml';
                        $sample_menu_data_xml = dirname( __FILE__ ) . '/sample-data/nav_menu_item.xml';

                        if( $setup_key == 'full' ) {
                            $ids = '';
                            // Import Sample Data XML.
                            $importer = new WP_Import();
                            // Import Full with all Posts, Pages, Media, Navigation Menu, Contact Forms, Settings.
                            $importer->import_menu = true;
                            $importer->fetch_attachments = true;
                            
                            if(class_exists('Woocommerce')){
                                hcode_log( __( 'MESSAGE - Import Full Start.', 'H-Code' ) );
                            } else {
                                hcode_log( __( 'MESSAGE - Import Without Woocommerce Start.', 'H-Code' ) );
                            }
                                $importer->import( $sample_data_xml, $ids );
                            if(class_exists('Woocommerce')){
                                hcode_log( __( 'MESSAGE - Import Full End', 'H-Code' ) );
                            } else {
                                hcode_log( __( 'MESSAGE - Import Without Woocommerce End', 'H-Code' ) );
                            }

                            if(class_exists('Woocommerce')){

                                hcode_log('MESSAGE - Import WooCommerce Pages Setting Start.');
                                // Set Woocommerce Default Pages.
                                $woopages = array(
                                    'woocommerce_shop_page_id' => 'shop',
                                    'woocommerce_cart_page_id' => 'shopping cart',
                                    'woocommerce_checkout_page_id' => 'checkout',
                                    'woocommerce_myaccount_page_id' => 'my account',
                                    'woocommerce_lost_password_page_id' => 'lost-password',
                                    'woocommerce_edit_address_page_id' => 'edit-address',
                                    'woocommerce_view_order_page_id' => 'view-order',
                                    'woocommerce_change_password_page_id' => 'change-password',
                                    'woocommerce_logout_page_id' => 'logout',   
                                    'woocommerce_pay_page_id' => 'pay',
                                    'woocommerce_thanks_page_id' => 'order-received'
                                );
                                foreach($woopages as $woo_page_name => $woo_page_title) {
                                    $woopage = get_page_by_title( $woo_page_title );
                                    if(isset( $woopage ) && $woopage->ID) {
                                        update_option($woo_page_name, $woopage->ID); // Front Page
                                    }
                                }
                                hcode_log('MESSAGE - Import WooCommerce Pages Setting End.');

                                // We no longer need to install pages.
                                delete_option( '_wc_needs_pages' );
                                    

                                // Add Image In Woocommerce Category.
                                hcode_log('MESSAGE - Set WooCommerce Category Image Start.');
                                $product_categories = get_terms( 'product_cat');
                                $attachment_image = hcode_wp_get_attachment_by_post_name( '1920x1100-ph' );
                                
                                foreach ($product_categories as $key => $value) {
                                    if( $attachment_image ){
                                        update_term_meta( $value->term_id, 'thumbnail_id', $attachment_image->ID );
                                    }
                                }
                                hcode_log('MESSAGE - Set WooCommerce Category Image End.');

                                // Add Image/Logo In Woocommerce Brands.
                                hcode_log('MESSAGE - Set WooCommerce Brand Logo And Image Start.');
                                $brandlogo = 1;
                                $product_brands = get_terms( 'product_brand');
                                foreach ($product_brands as $key => $value) {
                                    if( $attachment_image ){
                                        update_term_meta( $value->term_id, 'thumbnail_id', $attachment_image->ID );
                                    }
                                    $attachment_logo = hcode_wp_get_attachment_by_post_name( 'brand-logo'.$brandlogo );
                                    
                                    if( $attachment_logo ){
                                        update_term_meta( $value->term_id, 'logo_id', $attachment_logo->ID );
                                    }
                                    $brandlogo++;
                                }
                                hcode_log('MESSAGE - Set WooCommerce Brand Logo And Image End.');

                                // Add Custom Color in pa_colors taxonomy
                                hcode_log('MESSAGE - Set WooCommerce Color Attribute Start.');
                                $pa_colors_exist = taxonomy_exists( 'pa_colors');
                                if ( $pa_colors_exist ) {
                                    $attribute_colors_term = get_terms( 'pa_colors');
                                    $colors = array();
                                    
                                    $attribute_colors = hcode_csv_to_array(HCODE_THEME_IMPORTER_SAMPLEDATA . '/attribute_colors.csv');
                                    foreach ($attribute_colors as $attribute => $color) {
                                        $colors[] = $color['code'];
                                    }

                                    $i=0;
                                    foreach ($attribute_colors_term as $key => $value) {
                                        $empty_array = array();
                                        $empty_array['custom_color'] = $colors[$i];
                                        add_option( 'taxonomy_'.$value->term_id, $empty_array );
                                        $i++;
                                    }
                                }
                                hcode_log('MESSAGE - Set WooCommerce Color Attribute End.');

                                // Flush rules after install
                                flush_rewrite_rules();
                                
                            } //End If class_exist('Woocommerce') 

                            // Set imported menus to registered theme locations
                            // registered menu locations in theme
                            $locations = get_theme_mod( 'nav_menu_locations' );
                            // registered menus
                            $menus = wp_get_nav_menus();
                            hcode_log('MESSAGE - Import Menu Location Start.');
                            // assign menus to theme locations
                            if($menus) {
                                foreach($menus as $menu) {
                                    if( $menu->name == 'Main menu' ) {
                                        $locations['hcodemegamenu'] = $menu->term_id;
                                    } else if( $menu->name == 'Footer Menu' ) {
                                        $locations['hcodefootermenu'] = $menu->term_id;
                                    }
                                }
                            }

                            // set menus to locations
                            set_theme_mod( 'nav_menu_locations', $locations );

                            hcode_log('MESSAGE - Import Menu Location End.');

                        }

                        if( ( $setup_key == 'full' || $setup_key == 'mailchimp-form' ) && defined('MC4WP_PLUGIN_FILE' ) ) {
                            
                            // Import Sample Data XML.
                            $importer = new WP_Import();
                            
                            if( $setup_key == 'import-single' ) {
                                $importer->fetch_attachments = true;
                            } else {
                                $importer->fetch_attachments = false;
                            }
                            $importer->import_menu = false;
                            ob_start();
                                if( $setup_key == 'import-single' ) {
                                    hcode_log( __( 'MESSAGE - Import Single Layout Item Start.', 'H-Code' ) );
                                } else {
                                    hcode_log( __( 'MESSAGE - Import Mailchimp Form Start.', 'H-Code' ) );
                                }
                                
                                $importer->import( $sample_mailchimp_data_xml );

                                if( $setup_key == 'import-single' ) {
                                    hcode_log( __( 'MESSAGE - Import Single Layout Item End.', 'H-Code' ) );
                                } else {
                                    hcode_log( __( 'MESSAGE - Import Mailchimp Form End.', 'H-Code' ) );
                                }

                            ob_end_clean();
                        }

                        if( $setup_key == 'import-single' || $setup_key == 'contact-form' ) {
                            
                            // Import Sample Data XML.
                            $importer = new WP_Import();
                            
                            if( $setup_key == 'import-single' ) {
                                $importer->fetch_attachments = true;
                            } else {
                                $importer->fetch_attachments = false;
                            }
                            $importer->import_menu = false;
                            ob_start();
                                if( $setup_key == 'import-single' ) {
                                    hcode_log( __( 'MESSAGE - Import Single Layout Item Start.', 'H-Code' ) );
                                } else {
                                    hcode_log( __( 'MESSAGE - Import Contact Form Start.', 'H-Code' ) );
                                }
                                
                                $importer->import( $sample_data_xml, $import_options );

                                if( $setup_key == 'import-single' ) {
                                    hcode_log( __( 'MESSAGE - Import Single Layout Item End.', 'H-Code' ) );
                                } else {
                                    hcode_log( __( 'MESSAGE - Import Contact Form End.', 'H-Code' ) );
                                }

                            ob_end_clean();

                            if(class_exists('Woocommerce')){
                                
                                // Add Custom Color in pa_colors taxonomy
                                $pa_colors_exist = taxonomy_exists( 'pa_colors');
                                if ( $pa_colors_exist ) {
                                    $attribute_colors_term = get_terms( 'pa_colors');
                                    $colors = array();
                                    
                                    $attribute_colors = hcode_csv_to_array(HCODE_THEME_IMPORTER_SAMPLEDATA . '/attribute_colors.csv');

                                    foreach ($attribute_colors as $attribute => $color) {
                                        $colors[] = $color['code'];
                                    }

                                    $i=0;
                                    foreach ($attribute_colors_term as $key => $value) {
                                        $empty_array = array();
                                        $empty_array['custom_color'] = $colors[$i];
                                        add_option( 'taxonomy_'.$value->term_id, $empty_array );
                                        $i++;
                                    }
                                }
                            }
                        } 

                        if( $setup_key == 'menu' ){

                            $ids = '';
                            // Import Sample Data XML.
                            $importer = new WP_Import();
                            $importer->import_menu = true;
                            $importer->fetch_attachments = true;
                            ob_start();
                                hcode_log( __( 'MESSAGE - Menu Import Start.', 'H-Code' ) );
                                $importer->import( $sample_menu_data_xml, $ids );
                            ob_end_clean();
                                hcode_log(  __( 'MESSAGE - Menu Import End', 'H-Code' ) );

                            // Set imported menus to registered theme locations
                            // registered menu locations in theme
                            $locations = get_theme_mod( 'nav_menu_locations' );
                            // registered menus
                            $menus = wp_get_nav_menus();
                            hcode_log('MESSAGE - Import Menu Location Start.');
                            // assign menus to theme locations
                            if($menus) {
                                foreach($menus as $menu) {
                                    if( $menu->name == 'Main menu' ) {
                                        $locations['hcodemegamenu'] = $menu->term_id;
                                    } else if( $menu->name == 'Footer Menu' ) {
                                        $locations['hcodefootermenu'] = $menu->term_id;
                                    }
                                }
                            }

                            // set menus to locations
                            set_theme_mod( 'nav_menu_locations', $locations );

                            hcode_log('MESSAGE - Import Menu Location End.');

                        } 

                        if( $setup_key == 'settings' || $setup_key == 'full' ) {

                            // Add sidebar widget areas
                            register_sidebar ( array (
                                'name' => 'Footer Social Icons',
                                'id' => sanitize_title ( 'Footer Social Icons' ),
                                'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                                'after_widget' => '</div>',
                                'before_title'  => '<h5 class="sidebar-title">',
                                'after_title'   => '</h5>',
                            ) );
                            
                            register_sidebar ( array (
                                'name' => 'Menu Social Icons',
                                'id' => sanitize_title ( 'Menu Social Icons' ),
                                'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                                'after_widget' => '</div>',
                                'before_title'  => '<h5 class="sidebar-title">',
                                'after_title'   => '</h5>',
                            ) );

                            register_sidebar ( array (
                                'name' => 'Menu Social Icons - option 2',
                                'id' => sanitize_title ( 'Menu Social Icons - option 2' ),
                                'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                                'after_widget' => '</div>',
                                'before_title'  => '<h5 class="sidebar-title">',
                                'after_title'   => '</h5>',
                            ) );

                            register_sidebar ( array (
                                'name' => 'Menu Social Icons - option 3',
                                'id' => sanitize_title ( 'Menu Social Icons - option 3' ),
                                'before_widget' => '<div id="%1$s" class="custom-widget %2$s">',
                                'after_widget' => '</div>',
                                'before_title'  => '<h5 class="sidebar-title">',
                                'after_title'   => '</h5>',
                            ) );

                             // Import Theme Customize file.
                            $theme_options_file = dirname( __FILE__ ) . '/sample-data/theme_options.json';

                            $remove_options = get_theme_mods();
                            
                            if ( ! empty( $remove_options ) && ! is_array( $remove_options ) ) {
                                $remove_options = json_decode( $remove_options );

	                            hcode_log( __( 'MESSAGE - Before Import Customize Clear All Customize Settings Start.', 'H-Code' ) );
	                            if ( ! empty( $remove_options ) ) {
	                                foreach ( $remove_options as $key => $value ) {
	                                    remove_theme_mod( $key );
	                                }
	                            }
	                            hcode_log( __( 'MESSAGE - Before Import Customize Clear All Customize Settings End.', 'H-Code' ) );
	                        }
                            
                            /* Save new settings */

                            hcode_log( __( 'MESSAGE - Import Customize Setting Start.', 'H-Code' ) );
                            $encode_options = file_get_contents( $theme_options_file );
                            $options = json_decode( $encode_options, true );
                            // foreach ( $options as $key => $value ) {                                     
                            //     set_theme_mod( $key, $value );
                            // }
                            update_option( 'hcode_theme_setting', $options );
                            hcode_log( __( 'MESSAGE - Import Customize Setting End.', 'H-Code' ) );

                            /* when settings import, menu id can't change */
                            // registered menu locations in theme
                            $locations = get_theme_mod( 'nav_menu_locations' );
                            // registered menus
                            $menus = wp_get_nav_menus();
                            hcode_log('MESSAGE - Import Menu Location Start.');
                            // assign menus to theme locations
                            if($menus) {
                                foreach($menus as $menu) {
                                    if( $menu->name == 'Main menu' ) {
                                        $locations['hcodemegamenu'] = $menu->term_id;
                                    } else if( $menu->name == 'Footer Menu' ) {
                                        $locations['hcodefootermenu'] = $menu->term_id;
                                    }
                                }
                            }

                            // set menus to locations
                            set_theme_mod( 'nav_menu_locations', $locations );

                            hcode_log('MESSAGE - Import Menu Location End.');

                            // reading settings
                            $homepage_title = 'Home main';
                            $homepage = get_page_by_title( $homepage_title );
                            if( isset( $homepage ) && $homepage->ID ) {
                                hcode_log( __( 'MESSAGE - Set Static Homepage Start.', 'H-Code' ) );
                                update_option('show_on_front', 'page');
                                update_option('page_on_front', $homepage->ID); // Front Page
                                hcode_log( __( 'MESSAGE - Set Static Homepage End.', 'H-Code' ) );
                            }else{
                                hcode_log( __( 'NOTICE - Static Homepage Couldn\'t Be Set.', 'H-Code' ) );
                            }

                       }

                       if( $setup_key == 'widgets' || $setup_key == 'full' ) {

                            // Sidebar Widgets Json File.
                            $widgets_file = dirname( __FILE__ ) . '/sample-data/widget_data.json';
                           
                            if( isset( $widgets_file ) && $widgets_file ) {

                                // Add data to widgets
                                hcode_log( __( 'MESSAGE - Before Import Widget Clear All Widgetarea Start.', 'H-Code' ) );
                                $sidebars = wp_get_sidebars_widgets();

                                unset($sidebars['wp_inactive_widgets']);

                                foreach ( $sidebars as $sidebar => $widgets ) {
                                    $sidebars[$sidebar] = array();
                                }

                                $sidebars['wp_inactive_widgets'] = array();
                                wp_set_sidebars_widgets( $sidebars );
                                hcode_log( __( 'MESSAGE - Before Import Widget Clear All Widgetarea End.', 'H-Code' ) );

                                $widgets_json = $widgets_file; // widgets data file
                                $widgets_json = file_get_contents( $widgets_json );
                                $widget_data = $widgets_json;
                                hcode_log( __( 'MESSAGE - Import Widget Setting Start.', 'H-Code' ) );
                                $import_widgets = hcode_import_widget_sample_data( $widget_data );
                            }

                        }

                        if( $setup_key == 'rev-slider' || $setup_key == 'full' ) {

                            // Import Revslider
                            if( class_exists('UniteFunctionsRev') ) {

                            $rev_directory = dirname( __FILE__ ) . '/sample-data/revsliders/';
                            // if revslider is activated
                            $rev_files = hcode_get_zip_import_files( $rev_directory, 'zip' );

                                $slider = new RevSlider();
                                hcode_log( __( 'MESSAGE - Import Revslider Start.', 'H-Code' ) );
                                foreach( $rev_files as $rev_file ) { 

                                    // finally import rev slider data files
                                    $filepath = $rev_file;
                                    ob_start();
                                        $slider->importSliderFromPost(true, false, $filepath);
                                    ob_clean();
                                    ob_end_clean();
                                }
                                hcode_log( __( 'MESSAGE - Import Revslider End.', 'H-Code' ) );
                            }

                        }

                        if( $setup_key == 'delete-demo-media' ) {

                            global $wpdb;
                            $s_string = $wpdb->esc_like( 'hcode' );
                            $s_string = '%' . $s_string . '%';
                            $sql = "SELECT ID FROM $wpdb->posts WHERE post_title LIKE %s";
                            $sql = $wpdb->prepare( $sql, $s_string );
                            $matching_ids = $wpdb->get_results( $sql,OBJECT );
                            foreach( $matching_ids as $key => $value ) {
                                wp_delete_attachment( $value->ID, true );
                            }
                        } 
                    }

                    exit;
                }else{
                    hcode_log( __( 'ERROR - Importer can\'t load WP_Importer or WP_Import class not exists', 'H-Code' ) );
                    return false;
                }

            }
        }
    endif;

    if( ! ( function_exists( 'hcode_wp_get_attachment_by_post_name' ) ) ):
        function hcode_wp_get_attachment_by_post_name( $post_name ) {
            $args = array(
                'post_per_page' => 1,
                'post_type'     => 'attachment',
                'name'          => trim ( $post_name ),
            );
            $get_posts = new Wp_Query( $args );

            if ( ! empty( $get_posts->posts[0] ) ) {
                return $get_posts->posts[0];
            } else {
              return false;
            }
        }
    endif;

    // For More Info Check Widget Import Plugin ( http://wordpress.org/plugins/widget-settings-importexport/ )
    if( ! ( function_exists( 'hcode_import_widget_sample_data' ) ) ):
        function hcode_import_widget_sample_data( $widget_data ) {
            $json_data = $widget_data;
            $json_data = json_decode( $json_data, true );

            $sidebar_data = $json_data[0];
            $widget_data = $json_data[1];

            foreach ( $widget_data as $widget_title => $widget_value ) {
                foreach ( $widget_value as $widget_key => $widget_value ) {
                    $widgets[$widget_title][$widget_key] = $widget_data[$widget_title][$widget_key];
                }
            }
            
            $sidebar_data = array( array_filter( $sidebar_data ), $widgets );

            hcode_parse_import_widget_sample_data( $sidebar_data );

        }
    endif;

    if( ! ( function_exists( 'hcode_parse_import_widget_sample_data' ) ) ):
        function hcode_parse_import_widget_sample_data( $import_array ) {
            global $wp_registered_sidebars;
            $sidebars_data = $import_array[0];
            $widget_data = $import_array[1];
            $current_sidebars = get_option( 'sidebars_widgets' );
            $new_widgets = array( );

            foreach ( $sidebars_data as $import_sidebar => $import_widgets ) :

                foreach ( $import_widgets as $import_widget ) :
                    //if the sidebar exists
                    if ( isset( $wp_registered_sidebars[$import_sidebar] ) ) :
                        $title = trim( substr( $import_widget, 0, strrpos( $import_widget, '-' ) ) );
                        $index = trim( substr( $import_widget, strrpos( $import_widget, '-' ) + 1 ) );
                        $current_widget_data = get_option( 'widget_' . $title );
                        $new_widget_name = hcode_get_new_widget_name( $title, $index );
                        $new_index = trim( substr( $new_widget_name, strrpos( $new_widget_name, '-' ) + 1 ) );

                        if ( !empty( $new_widgets[ $title ] ) && is_array( $new_widgets[$title] ) ) {
                            while ( array_key_exists( $new_index, $new_widgets[$title] ) ) {
                                $new_index++;
                            }
                        }
                        $current_sidebars[$import_sidebar][] = $title . '-' . $new_index;
                        if ( array_key_exists( $title, $new_widgets ) ) {
                            $new_widgets[$title][$new_index] = $widget_data[$title][$index];
                            $multiwidget = $new_widgets[$title]['_multiwidget'];
                            unset( $new_widgets[$title]['_multiwidget'] );
                            $new_widgets[$title]['_multiwidget'] = $multiwidget;
                        } else {
                            $current_widget_data[$new_index] = $widget_data[$title][$index];
                            $current_multiwidget = isset($current_widget_data['_multiwidget']) ? $current_widget_data['_multiwidget'] : false;
                            $new_multiwidget = isset($widget_data[$title]['_multiwidget']) ? $widget_data[$title]['_multiwidget'] : false;
                            $multiwidget = ($current_multiwidget != $new_multiwidget) ? $current_multiwidget : 1;
                            unset( $current_widget_data['_multiwidget'] );
                            $current_widget_data['_multiwidget'] = $multiwidget;
                            $new_widgets[$title] = $current_widget_data;
                        }

                    endif;
                endforeach;
            endforeach;

            if ( isset( $new_widgets ) && isset( $current_sidebars ) ) {
                update_option( 'sidebars_widgets', $current_sidebars );

                foreach ( $new_widgets as $title => $content ){
                    update_option( 'widget_' . $title, $content );
                }
                hcode_log( __( 'MESSAGE - Import Widget Setting End.', 'H-Code' ) );
                return true;
            }
            hcode_log( __( 'NOTICE - Import Widget Setting Not Completed.', 'H-Code' ) );
            return false;
        }
    endif;

    if( ! ( function_exists( 'hcode_get_new_widget_name' ) ) ):
        function hcode_get_new_widget_name( $widget_name, $widget_index ) {
            $current_sidebars = get_option( 'sidebars_widgets' );
            $all_widget_array = array( );
            foreach ( $current_sidebars as $sidebar => $widgets ) {
                if ( !empty( $widgets ) && is_array( $widgets ) && $sidebar != 'wp_inactive_widgets' ) {
                    foreach ( $widgets as $widget ) {
                        $all_widget_array[] = $widget;
                    }
                }
            }
            while ( in_array( $widget_name . '-' . $widget_index, $all_widget_array ) ) {
                $widget_index++;
            }
            $new_widget_name = $widget_name . '-' . $widget_index;
            return $new_widget_name;
        }
    endif;

    if( ! ( function_exists( 'hcode_get_zip_import_files' ) ) ):
        function hcode_get_zip_import_files( $directory, $filetype ) {
            $phpversion = phpversion();
            $files = array();

            // Check if the php version allows for recursive iterators
            if ( version_compare( $phpversion, '5.2.11', '>' ) ) {
                if ( $filetype != '*' )  {
                    $filetype = '/^.*\.' . $filetype . '$/';
                } else {
                    $filetype = '/.+\.[^.]+$/';
                }
                $directory_iterator = new RecursiveDirectoryIterator( $directory );
                $recusive_iterator = new RecursiveIteratorIterator( $directory_iterator );
                $regex_iterator = new RegexIterator( $recusive_iterator, $filetype );

                foreach( $regex_iterator as $file ) {
                    $files[] = $file->getPathname();
                }
            // Fallback to glob() for older php versions
            } else {
                if ( $filetype != '*' )  {
                    $filetype = '*.' . $filetype;
                }

                foreach( glob( $directory . $filetype ) as $filename ) {
                    $filename = basename( $filename );
                    $files[] = $directory . $filename;
                }
            }

            return $files;
        }
    endif;

    // Function To Add hcode Import Log.
    if( ! ( function_exists( 'hcode_log' ) ) ):
        function hcode_log($message, $append = true) {
            $upload_dir = wp_upload_dir();            
            if (isset($upload_dir['baseurl'])) {
                
                $data = '';
                if (!empty($message)) {
                    $data = "<p>".date("Y-m-d H:i:s").' - '.$message."</p>";
                }
                
                if ($append === true) {
                    file_put_contents($upload_dir['basedir'].'/importer.log', $data, FILE_APPEND);
                    file_put_contents($upload_dir['basedir'].'/importer-full.log', $data, FILE_APPEND);
                } else {
                    file_put_contents($upload_dir['basedir'].'/importer.log', $data);
                    
                }
            }
        }
    endif;

    // Function To Get hcode Import Log.
    if( ! ( function_exists( 'get_hcode_import_log' ) ) ):
        function get_hcode_import_log() {            
            $upload_dir = wp_upload_dir();           
            if (isset($upload_dir['baseurl'])) {
                
                if (file_exists($upload_dir['basedir'].'/importer.log')) {
                    return file_get_contents($upload_dir['basedir'].'/importer.log');
                }
            }
            return '';
        }
    endif;

    // Ajax Function To Check Refresh Import Logs.
    if( ! ( function_exists( 'hcode_refresh_import_log' ) ) ):
        function hcode_refresh_import_log() {
          
            $check_hcode_log = get_hcode_import_log();
            //don't add message if ERROR was found, JS script is going to stop refreshing
            if( strpos( $check_hcode_log, 'ERROR' ) === false ) { 
                hcode_log( __( 'MESSAGE - Import in progress...', 'H-Code' ) );
            }
            $printlog = get_hcode_import_log();
            echo $printlog;
            die();
        }
    endif;

    /* To Read WooCommerce Product Attribute Colors */
    if( ! ( function_exists( 'hcode_csv_to_array' ) ) ):
        function hcode_csv_to_array($filename='', $delimiter=',')
        {
            if(!file_exists($filename) || !is_readable($filename))
                return FALSE;
            
            $header = NULL;
            $data = array();
            if (($handle = fopen($filename, 'r')) !== FALSE)
            {
                while (($row = fgetcsv($handle, 1000, $delimiter)) !== FALSE)
                {
                    if(!$header)
                        $header = $row;
                    else
                        $data[] = array_combine($header, $row);
                }
                fclose($handle);
            }
            return $data;
        }
    endif;
