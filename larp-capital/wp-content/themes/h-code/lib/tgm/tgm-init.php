<?php
/**
 * TGM Init Class
 *
 * @package H-Code
 */
?>
<?php
include_once ('class-tgm-plugin-activation.php');

if ( ! function_exists( 'hcode_plugin_activation' ) ) {
    function hcode_plugin_activation() {
         $hcode_newsletter_plugin = '';
        if( !defined( 'XYZ_EM_PLUGIN_FILE' ) ){
            $hcode_newsletter_plugin = array(
                'name'               => esc_html__('Mailchimp for WordPress','H-Code'),                          // The plugin name.
                'slug'               => 'mailchimp-for-wp',                          // The plugin slug (typically the folder name).
                'required'           => false,                                         // If false, the plugin is only 'recommended' instead of required.
            );
        }
    	$plugin_list = array(	
    		array(
                'name'				 => esc_html__( 'H-Code Addons', 'H-Code' ),           // The plugin name
                'slug'				 => 'hcode-addons',                                    // The plugin slug (typically the folder name)
                'source'			 => HCODE_THEME_DIR . '/plugins/hcode-addons.zip',     // The plugin source
                'required'			 => true,                                              // If false, the plugin is only 'recommended' instead of required
                'version'			 => HCODE_ADDONS_VERSION,                              // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'	 => false,                                             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => false,                                             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'		 => '',                                                // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => esc_html__( 'WPBakery Page Builder', 'H-Code' ),   // The plugin name
                'slug'               => 'js_composer',                                     // The plugin slug (typically the folder name)
                'source'             => HCODE_THEME_DIR . '/plugins/js_composer.zip',      // The plugin source
                'required'           => true,                                              // If false, the plugin is only 'recommended' instead of required
                'version'            => '6.7.0',                                           // E.g. 1.0.0. If set, the active plugin must be this version or higher, otherwise a notice is presented
                'force_activation'   => false,                                             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch
                'force_deactivation' => false,                                             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins
                'external_url'       => '',                                                // If set, overrides default API URL and points to an external URL
            ),
            array(
                'name'               => esc_html__( 'Slider Revolution', 'H-Code' ),       // The plugin name.
                'slug'               => 'revslider',                                       // The plugin slug (typically the folder name).
                'source'             => HCODE_THEME_DIR . '/plugins/revslider.zip',        // The plugin source.
                'required'           => true,                                              // If false, the plugin is only 'recommended' instead of required.
                'version'            => '6.5.5',                                          // E.g. 1.0.0. If set, the active plugin must be this version or higher.
                'force_activation'   => false,                                             // If true, plugin is activated upon theme activation and cannot be deactivated until theme switch.
                'force_deactivation' => false,                                             // If true, plugin is deactivated upon theme switch, useful for theme-specific plugins.
                'external_url'       => '',                                                // If set, overrides default API URL and points to an external URL.
            ),
    		array(
                'name'               => esc_html__( 'WooCommerce', 'H-Code' ),             // The plugin name.
                'slug'               => 'woocommerce',                                     // The plugin slug (typically the folder name).
                'required'           => false ,                                            // If false, the plugin is only 'recommended' instead of required.
            ),
    		array(
                'name'               => esc_html__( 'Contact Form 7', 'H-Code' ),          // The plugin name.
                'slug'               => 'contact-form-7',                                  // The plugin slug (typically the folder name).
                'required'           => false,                                             // If false, the plugin is only 'recommended' instead of required.
            ),            
            $hcode_newsletter_plugin
    	);

    	$mainconfig = array(
                'id'           => 'hcode_tgmpa',                // Unique ID for hashing notices for multiple instances of TGMPA.
                'default_path' => '',                           // Default absolute path to bundled plugins.
                'menu'         => 'install-required-plugins',   // Menu slug.
                'parent_slug'  => 'themes.php',                 // Parent menu slug.
                'capability'   => 'edit_theme_options',         // Capability needed to view plugin install page, should be a capability associated with the parent menu used.
                'has_notices'  => true,                         // Show admin notices or not.
                'dismissable'  => true,                         // If false, a user cannot dismiss the nag message.
                'dismiss_msg'  => '',                           // If 'dismissable' is false, this message will be output at top of nag.
                'is_automatic' => false,                        // Automatically activate plugins after installation or not.
                'message'      => '',                           // Message to output right before the plugins table.
    	);

    	tgmpa( $plugin_list, $mainconfig );

    }
}

add_action( 'tgmpa_register', 'hcode_plugin_activation' );