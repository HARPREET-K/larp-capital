<?php
/**
 * H-Code Hamburger Menu Class.
 *
 * @package H-Code
 */
?>
<?php
/**
 * Defind Hamburger Menu Class 
 */
if( !class_exists( 'Hcode_Hamburger_Menu' ) ) {
  /**
   * Main Hcode_Hamburger_Menu class
   */
  class Hcode_Hamburger_Menu {

    public function __construct() {
    	add_action( 'init', array( $this, 'hcode_hamburger_menu_init' ), 40 );
    }

    public function hcode_hamburger_menu_init() {
      require_once( HCODE_THEME_HAMBURGER_MENU . '/hamburger-menu-addon.php' );
    }

} // end of class

$Hcode_Hamburger_Menu = new Hcode_Hamburger_Menu();
}