<?php
	/**
 	 * H-Code Footer Menu Class.
     *
     * @package H-Code
    */
?>
<?php
	/**
	 * Defind Footer Menu Class 
	 */
	
	if( !class_exists( 'Hcode_Footer_Menu' ) ) {
  
  		class Hcode_Footer_Menu {

			public function __construct() {
      			add_action( 'init', array( $this, 'hcode_hamburger_menu_init' ), 40 );
    		}

			public function hcode_hamburger_menu_init() {
	        	require_once( HCODE_THEME_FOOTER_MENU . '/footer-menu-addon.php' );
	    	}
	  	}
	  	
		$Hcode_Footer_Menu = new Hcode_Footer_Menu();
	}