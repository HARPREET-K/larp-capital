<?php
/**
 * Defind Class 
 */
    
if( !class_exists( 'Hcode_Licence_Activation' ) ) {

  	class Hcode_Licence_Activation {

		// Construct
		public function __construct() {
		  	add_action( 'admin_menu', array( $this, 'hcode_licence_activation_page' ), 5 );
		  	add_action( 'wp_ajax_hcode_active_theme_licence', array( $this, 'hcode_active_theme_licence' ) );
		}

		public function hcode_licence_activation_page() {
		    add_theme_page(
		        esc_html__( 'Theme Licence', 'H-Code' ), // page title
		        esc_html__( 'Theme Licence', 'H-Code' ), // menu title
		        'manage_options',                   // capability
		        'hcode-licence-activation',          // menu slug
		        array( $this, 'hcode_licence_activation_callback' )  // callback function
		    );
		}

		// Add new submenu for demo data install in Admin panel > Appereance
		public function hcode_licence_activation_callback() {
			
		    global $title;

		    /* Check current user permission */
		    if( !current_user_can( 'manage_options' ) ) {
		        wp_die( esc_html__( 'You do not have sufficient permissions to access this page.', 'H-Code' ) );
		    }
		    /* Gets a WP_Theme object for a theme. */
		    $hcode_theme = wp_get_theme();

		    echo '<div class="wrap">';
		        echo '<h1>'.esc_attr( $title ).'</h1>';
		        echo '<div class="hcode-header-licence">';
		            echo '<div class="display_header">';
		                if( $hcode_theme->get( 'Name' ) ) :
		                    echo '<h2>'.$hcode_theme->get( 'Name' ).'</h2>';
		                endif;
		                if( $hcode_theme->get( 'Version' ) ) :
		                    echo '<span>'.$hcode_theme->get( 'Version' ).'</span>';
		                endif;
		            echo '</div>';
		            echo '<div class="hcode-head-right">';
		                echo '<a target="_blank" href="'.$hcode_theme->get( 'ThemeURI' ).'/documentation/">'.esc_html__( 'Online Documentation', 'H-Code' ).'</a><span class="link_sep">|</span><a target="_blank" href="'.$hcode_theme->get( 'AuthorURI' ).'/support">'.esc_html__( 'Support Center', 'H-Code' ).'</a></div>';
		            echo '<div class="clear"></div>';
		        echo '</div>';
		        echo '<div class="licence-content">';
			        echo '<div class="licence-content-top">';
                        echo '<div class="header-licence-top">';
                            echo '<div class="header-licence-top-left">';
                                echo '<a target="_blank" href="'.$hcode_theme->get( 'ThemeURI' ).'"><img src="'.HCODE_THEME_IMAGES_URI.'/licence-logo.png" alt="H-Code logo" ></a>';
                            echo '</div>';
                            echo '<div class="header-licence-top-right">';
                                echo '<h4>'.esc_html__( 'Welcome to H-Code - Responsive & Multipurpose WordPress Theme', 'H-Code' ).'</h4>';
                            echo '</div>';
                        echo '</div>';
                        $class = '';
                        echo '<div class="licence-content-bottom">';    
                            echo '<div class="licence-thankyou-message 	licence-added-success">';
                                echo esc_html__( 'Welcome to H-Code WordPress theme. Please activate your H-Code theme license copy and enjoy premium features.','H-Code' );
                            echo '</div>';
                            $hcode_is_theme_licence_active = hcode_is_theme_licence_active();

                            if( $hcode_is_theme_licence_active ) {
                                echo '<div class="licence-activated-success"><i class="fas fa-check-circle"></i><span>'.esc_html__( 'Awesome! Your H-Code WordPress theme license is activated already. Enjoy premium features of H-Code.', 'H-Code' ).'</span></div>';
                                $class = ' hide-licence-button"';
                            } else {
                                if( isset( $_GET['token'] ) && isset( $_GET['response'] ) ) {
                                    $hcode_get_transient = get_transient( 'hcode_licence_token' );
                                   	if( $_GET['token'] == $hcode_get_transient ) {
                                        if( $_GET['response'] == 'true' && isset( $_GET['msg']) ) {
                                           	echo '<div class="licence-activated-success"><i class="fas fa-check-circle"></i><span>'.esc_attr( $_GET['msg'] ).'</span></div>';
                                                $class = ' hide-licence-button"';
                                                hcode_theme_active_licence( 'yes' );
                                        }
                                        if( $_GET['response'] == 'false' && isset( $_GET['msg']) ) {
                                          	echo '<div class="licence-activated-failed"><i class="fas fa-times-circle"></i><span>'.esc_attr( $_GET['msg'] ).'</span></div>';
                                        }
                                        if( $_GET['response'] == 'access_denied' && isset( $_GET['msg']) ) {
                                          	echo '<div class="licence-activated-access-denied"><i class="fas fa-info-circle"></i><span>'.esc_attr( $_GET['msg'] ).'</span></div>';
                                        }
                                    }
                                }
                            }

                            echo '<a class="hcode-licence'.$class.'" href="javascript:void(0);">'.esc_html__( 'Activate H-Code WordPress Theme License', 'H-Code' ).'</a>';
                            echo '<img src="'.HCODE_THEME_IMAGES_URI.'/spin.gif" class="hcode-licence-spinner" alt="spinner" width="25" height="25">';
                            echo '<div class="licence-description">'.esc_html__( 'Activate your H-Code theme license using above button to unlock H-Code premium features like demo data import. Please note that you will need to login to your ThemeForest account from which you have purchased H-Code theme and allow the access to verify your theme purchase. ', 'H-Code' );
                                echo '<a target="_blank" href="'.$hcode_theme->get( 'ThemeURI' ).'/documentation/how-to-activate-h-code-theme-license/">'.esc_html__( 'For more details please check this article.', 'H-Code' ).'</a>';
                            echo '</div>';
                        echo '</div>';
                        echo '<div class="licence-support-content-bottom">';
                        	echo '<div class="license-documentation">';
                        		echo '<a href="'.$hcode_theme->get( 'ThemeURI' ).'/documentation/" target="_blank"><img src="'.HCODE_THEME_IMAGES_URI.'/online-documentation.png" /><span>'.esc_html__( 'Online Documentation','H-Code').'</span></a>';
                        	echo '</div>';
                        	echo '<div class="license-support">';
                        		echo '<a href="'.$hcode_theme->get( 'AuthorURI' ).'/support" target="_blank"><img src="'.HCODE_THEME_IMAGES_URI.'/support-center.png" /><span>'.esc_html__( 'Support Center','H-Code').'</span></a>';
                        	echo '</div>';
                        	echo '<div class="license-video">';
                        		echo '<a href="'.$hcode_theme->get( 'ThemeURI' ).'/documentation/general-information/video-tutorials/" target="_blank"><img src="'.HCODE_THEME_IMAGES_URI.'/video-tutorials.png" /><span>'.esc_html__( 'Video Tutorials','H-Code').'</span></a>';
                        	echo '</div>';
                        echo '</div>';    
			        echo '</div>';
		        echo '</div>';
		    echo '</div>';
		}
		    
		public function hcode_active_theme_licence() {
		    $HcodeResponse = array(
		        'status' => true,
		        'url' => hcode_generate_theme_licence_activation_url(),
		    );
		    die( json_encode( $HcodeResponse ) );
		}

	} // end of class
	$Hcode_Licence_Activation = new Hcode_Licence_Activation();
  
} // end of class_exists