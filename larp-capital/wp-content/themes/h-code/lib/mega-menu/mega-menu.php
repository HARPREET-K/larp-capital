<?php
/**
 * H-Code Mega Menu Class.
 *
 * @package H-Code
 */
?>
<?php
/**
 * Defind Mega Menu Class 
 */
if( !class_exists( 'Hcode_Mega_Menu' ) ) {
  /**
   * Main Hcode_Mega_Menu class
   */
  class Hcode_Mega_Menu {
    /**
     * Construct
     */
    public function __construct() {
    	add_action( 'init', array( $this, 'hcode_mega_menu_init' ), 40 );
    	add_action( 'admin_enqueue_scripts', array( $this, 'hcode_mega_menu_admin_scripts' ) );
      add_action( 'admin_enqueue_scripts', array( $this, 'load_custom_wp_admin_style' ) );
      add_action( 'admin_print_scripts-post.php', array( $this, 'load_custom_wp_admin_style' ), 99 );
      add_action( 'admin_print_scripts-post-new.php', array( $this, 'load_custom_wp_admin_style' ), 99 );
    }
    public function load_custom_wp_admin_style() {

      /* Remove VC font awesome css */
      wp_dequeue_style( 'font-awesome' );
      wp_deregister_style( 'font-awesome' );
      wp_register_style( 'font-awesome', HCODE_THEME_CSS_URI . '/font-awesome.min.css',null, '5.15.3' );
      wp_enqueue_style( 'font-awesome' );

      // Register Style For WP Admin.
      wp_register_style( 'hcode-custom-admin-style', HCODE_THEME_MEGA_MENU_CSS_URI . '/custom-admin-style.css', false, '1.0.0' );
      // Enqueue Style For WP Admin.
      wp_enqueue_style( 'hcode-custom-admin-style' );
    }

    public function hcode_mega_menu_init() {
      require_once( HCODE_THEME_MEGA_MENU . '/mega-menu-addon.php' );
    }

    public function hcode_mega_menu_admin_scripts(){
      
    	wp_register_script( 'hcode-select2-jquery', HCODE_THEME_JS_URI . '/select2.full.min.js', array( 'jquery' ), '4.0.0', true );
      wp_register_script( 'hcode-custom-megamenu-jquery', HCODE_THEME_MEGA_MENU_JS_URI . '/megamenu.js', array( 'jquery' ), HCODE_THEME_VERSION, true );
      wp_register_style( 'select2-css', HCODE_THEME_CSS_URI . '/select2.min.css', false, '1.0' );
      wp_register_style( 'hcode-mega-menu-style', HCODE_THEME_MEGA_MENU_CSS_URI . '/megamenu.css',null, HCODE_THEME_VERSION );
      wp_register_style( 'font-awesome', HCODE_THEME_CSS_URI . '/font-awesome.min.css',null, '5.15.3' );

      wp_enqueue_script( 'hcode-select2-jquery' );
      wp_enqueue_script( 'hcode-custom-megamenu-jquery' );
      wp_enqueue_style( 'select2-css' );
      wp_enqueue_style( 'font-awesome' );
      wp_enqueue_style( 'hcode-mega-menu-style' );

      // Added in V1.9
      wp_localize_script( 'hcode-custom-megamenu-jquery', 'hcode_licence_messages', array( 'response_failed' => esc_attr__( 'Failed to get response from server. Please try again.', 'H-Code' ) ) );

      // Added in v1.8
      wp_register_style( 'hcode-line-icons-style', HCODE_THEME_CSS_URI . '/et-line-icons.css', null, HCODE_THEME_VERSION );
      wp_enqueue_style( 'hcode-line-icons-style' );
  }
} // end of class

$Hcode_Mega_Menu = new Hcode_Mega_Menu();
} // end of class_exists