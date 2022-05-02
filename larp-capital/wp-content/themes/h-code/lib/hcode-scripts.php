<?php
/**
 * Theme Register Style Js.
 *
 * @package H-Code
 */
?>
<?php 

/*
 * Enqueue scripts and styles.
 */
if ( ! function_exists( 'hcode_register_style_js' ) ) {
	function hcode_register_style_js() {
		
		do_action( 'hcode_remove_third_party_script_style' );

		/*
		 * Load our h-code theme main and other required stylesheets.
		 */
		
		wp_register_style( 'hcode-style', get_stylesheet_uri() ,null, HCODE_THEME_VERSION );
		wp_register_style( 'hcode-animate-style', HCODE_THEME_CSS_URI . '/animate.css', null, '3.6.2' );
		wp_register_style( 'hcode-bootstrap', HCODE_THEME_CSS_URI . '/bootstrap.css', null, '3.2.0' );
		wp_register_style( 'hcode-et-line-icons-style', HCODE_THEME_CSS_URI . '/et-line-icons.css', null, HCODE_THEME_VERSION );
		wp_register_style( 'hcode-font-awesome-style', HCODE_THEME_CSS_URI . '/font-awesome.min.css', null, '5.15.3' );
		wp_register_style( 'hcode-magnific-popup-style', HCODE_THEME_CSS_URI . '/magnific-popup.css', null, HCODE_THEME_VERSION );
		wp_register_style( 'hcode-owl-carousel-style', HCODE_THEME_CSS_URI . '/owl.carousel.css', null, '2.3.4' );
		wp_register_style( 'hcode-owl-transitions-style', HCODE_THEME_CSS_URI . '/owl.transitions.css', null, '2.3.4' );
		wp_register_style( 'hcode-text-effect-style', HCODE_THEME_CSS_URI . '/text-effect.css', null, HCODE_THEME_VERSION );
		wp_register_style( 'hcode-menu-hamburger-style', HCODE_THEME_CSS_URI . '/menu-hamburger.css', null, HCODE_THEME_VERSION );
		wp_register_style( 'hcode-mCustomScrollbar-style', HCODE_THEME_CSS_URI . '/jquery.mCustomScrollbar.css', null, HCODE_THEME_VERSION );
		wp_register_style( 'hcode-responsive-style', HCODE_THEME_CSS_URI . '/responsive.css', null, HCODE_THEME_VERSION );
		wp_register_style( 'hcode-extralayers-style', HCODE_THEME_CSS_URI . '/extralayers.css', null, HCODE_THEME_VERSION );

		wp_enqueue_style( 'hcode-animate-style' );
		wp_enqueue_style( 'hcode-bootstrap' );
		wp_enqueue_style( 'hcode-et-line-icons-style' );
		wp_enqueue_style( 'hcode-font-awesome-style' );
		wp_enqueue_style( 'hcode-magnific-popup-style' );
		wp_enqueue_style( 'hcode-owl-carousel-style' );
		wp_enqueue_style( 'hcode-owl-transitions-style' );
		wp_enqueue_style( 'hcode-text-effect-style' );
		wp_enqueue_style( 'hcode-menu-hamburger-style' );
		wp_enqueue_style( 'hcode-mCustomScrollbar-style' );
		wp_enqueue_style( 'hcode-style' );

		wp_enqueue_style( 'hcode-responsive-style' );
		wp_enqueue_style( 'hcode-extralayers-style' );

		// Load the Internet Explorer specific stylesheet.
		wp_enqueue_style( 'hcode-ie', HCODE_THEME_CSS_URI.'/style-ie.css', array( 'hcode-style' ), '1.0' );
		wp_style_add_data( 'hcode-ie', 'conditional', 'IE' );
		
		// Load the html5 shiv.
		wp_register_script( 'hcode-html5', HCODE_THEME_JS_URI.'/html5shiv.js', array(), '3.7.3' );
		wp_script_add_data( 'hcode-html5', 'conditional', 'lt IE 9' );
		wp_enqueue_script( 'hcode-html5' );

		/*
		 * Load our h-code theme main and other required jquery files.
		 */
		wp_register_script( 'hcode-modernizr', HCODE_THEME_JS_URI.'/modernizr.js', array( 'jquery' ), '2.7.2', true );
		wp_register_script( 'hcode-bootstrap', HCODE_THEME_JS_URI.'/bootstrap.js', array( 'jquery' ), '3.2.0', true );
		wp_register_script( 'bootstrap-hover-dropdown', HCODE_THEME_JS_URI.'/bootstrap-hover-dropdown.js', array( 'jquery' ), '2.2.1', true );
		wp_register_script( 'hcode-jquery-easing', HCODE_THEME_JS_URI.'/jquery.easing.1.3.js', array( 'jquery' ), '1.3', true );
		wp_register_script( 'hcode-skrollr', HCODE_THEME_JS_URI.'/skrollr.min.js', array( 'jquery' ), '1.0', true );
	    wp_register_script( 'hcode-viewport', HCODE_THEME_JS_URI.'/jquery.viewport.mini.js',array( 'jquery' ), '1.0', true );
		wp_register_script( 'hcode-smooth-scroll', HCODE_THEME_JS_URI.'/jquery.smooth-scroll.min.js',array( 'jquery' ), '2.2.0', true );
		wp_register_script( 'hcode-wow', HCODE_THEME_JS_URI.'/wow.min.js',array( 'jquery' ), '1.1.3', true );
		wp_register_script( 'hcode-page-scroll', HCODE_THEME_JS_URI.'/page-scroll.js',array( 'jquery' ), '1.4.9', true );
		wp_register_script( 'hcode-easypiechart', HCODE_THEME_JS_URI.'/jquery.easypiechart.js',array( 'jquery' ), '1.0', true );
		wp_register_script( 'hcode-parallax', HCODE_THEME_JS_URI.'/jquery.parallax.js',array( 'jquery' ), '1.1.3', true );
		wp_register_script( 'hcode-isotope', HCODE_THEME_JS_URI.'/jquery.isotope.min.js',array( 'jquery' ),'3.0.6', true );
		wp_register_script( 'hcode-owl-carousel', HCODE_THEME_JS_URI.'/owl.carousel.min.js',array( 'jquery' ),'2.3.4',true);
		wp_register_script( 'hcode-magnific-popup', HCODE_THEME_JS_URI.'/jquery.magnific-popup.min.js',array( 'jquery' ),'1.0',true);
		wp_register_script( 'hcode-popup-gallery', HCODE_THEME_JS_URI.'/popup-gallery.js',array( 'jquery' ), HCODE_THEME_VERSION, true );
		wp_register_script( 'hcode-text-effect', HCODE_THEME_JS_URI.'/text-effect.js', array( 'jquery' ), '1.0', true );
		wp_register_script( 'hcode-counter', HCODE_THEME_JS_URI.'/jquery.countdown.min.js',array( 'jquery' ),'2.2.0',true);
		wp_register_script( 'hcode-fitvids', HCODE_THEME_JS_URI.'/jquery.fitvids.js',array( 'jquery' ),'1.1',true);
		wp_register_script( 'hcode-imagesloaded', HCODE_THEME_JS_URI.'/imagesloaded.pkgd.min.js',array( 'jquery' ),'4.1.4',true);
	    wp_register_script( 'hcode-classie', HCODE_THEME_JS_URI.'/classie.js',array( 'jquery' ),'1.0.1',true);
	    wp_register_script( 'hcode-hamburger-menu', HCODE_THEME_JS_URI.'/hamburger-menu.js',array( 'jquery' ),HCODE_THEME_VERSION,true);
	    wp_register_script( 'hcode-mcustomscrollbar', HCODE_THEME_JS_URI.'/jquery.mCustomScrollbar.concat.min.js',array( 'jquery' ),'3.1.13',true);
	    wp_register_script( 'hcode-appear-scroll', HCODE_THEME_JS_URI.'/jquery.appear.js',array( 'jquery' ),'0.3.6',true);
	    wp_register_script( 'hcode-ie-placeholder', HCODE_THEME_JS_URI.'/jquery.placeholder.min.js',array( 'jquery' ),'2.3.1',true);
	    wp_register_script( 'hcode-velocity', HCODE_THEME_JS_URI.'/velocity.min.js',array( 'jquery' ),'1.2.2',true);
	    wp_register_script( 'hcode-velocity-animation', HCODE_THEME_JS_URI.'/velocity-animation.js',array( 'jquery' ),'1.0',true);
	    wp_register_script( 'infinite-scroll', HCODE_THEME_JS_URI.'/infinite-scroll.js',array( 'jquery' ),'2.1.0',true);
	    wp_register_script( 'background-srcset', HCODE_THEME_JS_URI.'/background-srcset.js', array( 'jquery' ), '2.1.0', true );
		wp_register_script( 'hcodemain', HCODE_THEME_JS_URI.'/main.js',array( 'jquery' ),HCODE_THEME_VERSION,true);

		
	    wp_enqueue_script( 'hcode-modernizr' );
	    wp_enqueue_script( 'hcode-bootstrap' );
	    wp_enqueue_script( 'bootstrap-hover-dropdown' );
	    wp_enqueue_script( 'hcode-jquery-easing' );
	    wp_enqueue_script( 'hcode-skrollr' );
	    wp_enqueue_script( 'hcode-viewport' );
	    wp_enqueue_script( 'hcode-smooth-scroll' );
	    wp_enqueue_script( 'hcode-wow' );
	    wp_enqueue_script( 'hcode-page-scroll' );
	    wp_enqueue_script( 'hcode-easypiechart' );
	    wp_enqueue_script( 'hcode-parallax' );
	    wp_enqueue_script( 'hcode-isotope' );
	    wp_enqueue_script( 'hcode-owl-carousel' );
	    wp_enqueue_script( 'hcode-magnific-popup' );
	    wp_enqueue_script( 'hcode-popup-gallery' );
	    wp_enqueue_script( 'hcode-appear-scroll' );
	    wp_enqueue_script( 'hcode-text-effect' );
	    wp_enqueue_script( 'hcode-counter' );
	    wp_enqueue_script( 'hcode-fitvids' );
	    wp_enqueue_script( 'hcode-imagesloaded' );
	    wp_enqueue_script( 'hcode-ie-placeholder' );
	    wp_enqueue_script( 'hcode-classie' );
	    wp_enqueue_script( 'hcode-hamburger-menu' );
	    wp_enqueue_script( 'hcode-mcustomscrollbar' );
	    wp_enqueue_script( 'infinite-scroll' );
	    wp_enqueue_script( 'background-srcset' );
	    wp_enqueue_script( 'hcodemain' );

		/*
		 * Defind ajaxurl and wp_localize
		 */

		wp_localize_script( 'hcodemain', 'hcodeajaxurl', 
			array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'theme_url' => get_template_directory_uri(),
				'loading_image' => HCODE_THEME_IMAGES_URI.'/spin.gif'
		) );

        wp_localize_script( 'hcodemain', 'hcode_infinite_scroll_message', array(
            'message' => esc_attr__( 'All Post Loaded', 'H-Code' )
        ) ); 

		if ( is_singular() && comments_open() && get_option( 'thread_comments' ) ) {
			wp_enqueue_script( 'comment-reply' );
		}
	}
}

add_action( 'admin_enqueue_scripts', 'hcode_importer_script_loader' );
if ( ! function_exists( 'hcode_importer_script_loader' ) ) :
    function hcode_importer_script_loader(){

    	/* Remove from redux framework */
    	wp_register_script( 'hcode-import-accordion', HCODE_THEME_JS_URI . '/admin/hcode-import-accordion.js', array( 'jquery' ), HCODE_THEME_VERSION, true );
    	wp_enqueue_script( 'hcode-import-accordion' );

    	// Enqueue ET-Line Style For WP Admin.
		wp_enqueue_style( 'hcode-line-icons-style', HCODE_THEME_CSS_URI . '/et-line-icons.css',null, HCODE_THEME_VERSION );
		if( class_exists('ReduxFramework') ){
	   		// Enqueue elusive webfont Style For WP Admin.
			wp_enqueue_style( 'redux-elusive-icon', ReduxFramework::$_url . 'assets/css/vendor/elusive-icons/elusive-icons.css');
		}

        wp_localize_script( 'hcode-import-accordion', 'hcode_import_messages', array(
          'no_single_layout' => esc_attr__( 'Please select an option from the list to import', 'H-Code' ),
          'single_import_conformation' => esc_attr__( 'Are you sure to proceed? It will skip matching items and add new ones.', 'H-Code' ),
          'themesetting_import_conformation' => esc_attr__( 'Are you sure to proceed? It will overwrite existing theme theme settings with demo settings.', 'H-Code' ),
          'menu_import_conformation' => esc_attr__( 'Are you sure to proceed? It will add new items, no matter if that exist or not.', 'H-Code' ),
          'widget_import_conformation' => esc_attr__( 'Are you sure to proceed? It will overwrite existing matching widgets data with demo widget data.', 'H-Code' ),
          'slider_import_conformation' => esc_attr__( 'Are you sure to proceed? It will add new items, no matter if that exist or not.', 'H-Code' ),
          'contact_form_import_conformation' => esc_attr__( 'Are you sure to proceed? It will skip matching items and add new ones.', 'H-Code' ),
          'mailchimp_form_import_conformation' => esc_attr__( 'Are you sure to proceed? It will skip matching items and add new ones.', 'H-Code' ),
          'media_import_conformation' => esc_attr__( 'Are you sure to proceed?', 'H-Code' ),
          'full_import_conformation' => esc_attr__( 'Are you sure to proceed? It will overwrite existing theme theme settings and matching widget data and will add all other new data in your WordPress setup.', 'H-Code' )
        ) );
    }
endif;

add_action( 'wp_enqueue_scripts', 'hcode_register_style_js',99 );
if ( ! function_exists( 'hcode_load_vc_iframe_js' ) ) {
	function hcode_load_vc_iframe_js() {
		
    	wp_register_script( 'hcode-modernizr-js', HCODE_THEME_JS_URI.'/modernizr.js',array( 'jquery' ),'2.7.2',true);
		wp_register_script( 'hcode-bootstrap-js', HCODE_THEME_JS_URI.'/bootstrap.js',array( 'jquery' ),'3.2.0',true);
		wp_register_script( 'bootstrap-hover-dropdown-js', HCODE_THEME_JS_URI.'/bootstrap-hover-dropdown.js',array( 'jquery' ),'2.2.1',true);
		wp_register_script( 'hcode-jquery-easing-js', HCODE_THEME_JS_URI.'/jquery.easing.1.3.js',array( 'jquery' ),'1.3',true);
		wp_register_script( 'hcode-skrollr-js', HCODE_THEME_JS_URI.'/skrollr.min.js',array( 'jquery' ),'1.0',true);
	    wp_register_script( 'hcode-viewport-js', HCODE_THEME_JS_URI.'/jquery.viewport.mini.js',array( 'jquery' ),'1.0',true);
		wp_register_script( 'hcode-smooth-scroll-js', HCODE_THEME_JS_URI.'/jquery.smooth-scroll.min.js',array( 'jquery' ),'2.2.0',true);
		wp_register_script( 'hcode-wow-js', HCODE_THEME_JS_URI.'/wow.min.js',array( 'jquery' ),'1.1.3',true);
		wp_register_script( 'hcode-page-scroll-js', HCODE_THEME_JS_URI.'/page-scroll.js',array( 'jquery' ),'1.4.9',true);
		wp_register_script( 'hcode-easypiechart-js', HCODE_THEME_JS_URI.'/jquery.easypiechart.js',array( 'jquery' ),'1.0',true);
		wp_register_script( 'hcode-parallax-js', HCODE_THEME_JS_URI.'/jquery.parallax.js',array( 'jquery' ),'1.1.3',true);
		wp_register_script( 'hcode-isotope-js', HCODE_THEME_JS_URI.'/jquery.isotope.min.js',array( 'jquery' ),'3.0.6',true);
		wp_register_script( 'hcode-owl-carousel-js', HCODE_THEME_JS_URI.'/owl.carousel.min.js',array( 'jquery' ),'2.3.4',true);
		wp_register_script( 'hcode-magnific-popup-js', HCODE_THEME_JS_URI.'/jquery.magnific-popup.min.js',array( 'jquery' ),'1.0',true);
		wp_register_script( 'hcode-popup-gallery-js', HCODE_THEME_JS_URI.'/popup-gallery.js',array( 'jquery' ),HCODE_THEME_VERSION,true);
		wp_register_script( 'hcode-text-effect-js', HCODE_THEME_JS_URI.'/text-effect.js',array( 'jquery' ),'1.0',true);
		wp_register_script( 'hcode-counter-js', HCODE_THEME_JS_URI.'/jquery.countdown.min.js',array( 'jquery' ),'2.2.0',true);
		wp_register_script( 'hcode-fitvids-js', HCODE_THEME_JS_URI.'/jquery.fitvids.js',array( 'jquery' ),'1.1',true);
		wp_register_script( 'hcode-imagesloaded-js', HCODE_THEME_JS_URI.'/imagesloaded.pkgd.min.js',array( 'jquery' ), '4.1.4',true);
	    wp_register_script( 'hcode-classie-js', HCODE_THEME_JS_URI.'/classie.js',array( 'jquery' ),'1.0.1',true);
	    wp_register_script( 'hcode-hamburger-menu-js', HCODE_THEME_JS_URI.'/hamburger-menu.js',array( 'jquery' ),HCODE_THEME_VERSION,true);
	    wp_register_script( 'hcode-mcustomscrollbar-js', HCODE_THEME_JS_URI.'/jquery.mCustomScrollbar.concat.min.js',array( 'jquery' ),'3.1.13',true);
	    wp_register_script( 'hcode-appear-scroll-js', HCODE_THEME_JS_URI.'/jquery.appear.js',array( 'jquery' ),'0.3.6',true);
	    wp_register_script( 'hcode-ie-placeholder-js', HCODE_THEME_JS_URI.'/jquery.placeholder.min.js',array( 'jquery' ),'2.3.1',true);
	    wp_register_script( 'hcode-velocity-js', HCODE_THEME_JS_URI.'/velocity.min.js',array( 'jquery' ),'1.2.2',true);
	    wp_register_script( 'hcode-velocity-animation-js', HCODE_THEME_JS_URI.'/velocity-animation.js',array( 'jquery' ),'1.0',true);
	    wp_register_script( 'infinite-scroll-js', HCODE_THEME_JS_URI.'/infinite-scroll.js',array( 'jquery' ),'2.1.0',true);
		wp_register_script( 'hcodemain-js', HCODE_THEME_JS_URI.'/main.js',array( 'jquery' ),HCODE_THEME_VERSION,true);

	    wp_enqueue_script( 'hcode-modernizr-js' );
	    wp_enqueue_script( 'hcode-bootstrap-js' );
	    wp_enqueue_script( 'bootstrap-hover-dropdown-js' );
	    wp_enqueue_script( 'hcode-jquery-easing-js' );
	    wp_enqueue_script( 'hcode-skrollr-js' );
	    wp_enqueue_script( 'hcode-viewport-js' );
	    wp_enqueue_script( 'hcode-smooth-scroll-js' );
	    wp_enqueue_script( 'hcode-wow-js' );
	    wp_enqueue_script( 'hcode-page-scroll-js' );
	    wp_enqueue_script( 'hcode-easypiechart-js' );
	    wp_enqueue_script( 'hcode-parallax-js' );
	    wp_enqueue_script( 'hcode-isotope-js' );
	    wp_enqueue_script( 'hcode-owl-carousel-js' );
	    wp_enqueue_script( 'hcode-magnific-popup-js' );
	    wp_enqueue_script( 'hcode-popup-gallery-js' );
	    wp_enqueue_script( 'hcode-appear-scroll-js' );
	    wp_enqueue_script( 'hcode-text-effect-js' );
	    wp_enqueue_script( 'hcode-counter-js' );
	    wp_enqueue_script( 'hcode-fitvids-js' );
	    wp_enqueue_script( 'hcode-imagesloaded-js' );
	    wp_enqueue_script( 'hcode-ie-placeholder-js' );
	    wp_enqueue_script( 'hcode-classie-js' );
	    wp_enqueue_script( 'hcode-hamburger-menu-js' );
	    wp_enqueue_script( 'hcode-mcustomscrollbar-js' );
	    wp_enqueue_script( 'hcode-velocity-js' );
	    wp_enqueue_script( 'hcode-velocity-animation-js' );
	    wp_enqueue_script( 'infinite-scroll-js' );
	    wp_enqueue_script( 'hcodemain-js' );

	    wp_localize_script( 'hcodemain-js', 'hcodeajaxurl', 
			array( 'ajaxurl' => admin_url( 'admin-ajax.php' ),
				'theme_url' => get_template_directory_uri(),
				'loading_image' => HCODE_THEME_IMAGES_URI.'/spin.gif'
		) );

        wp_localize_script( 'hcodemain-js', 'hcode_infinite_scroll_message', array(
            'message' => esc_attr__( 'All Post Loaded', 'H-Code' )
        ) );
	}
}
add_action( 'vc_load_iframe_jscss', 'hcode_load_vc_iframe_js' );

if ( ! function_exists( 'hcode_vc_frontend_editor_enqueue_js_css' ) ) {
	function hcode_vc_frontend_editor_enqueue_js_css() {
		wp_register_script( 'hcode-easypiechart-js', HCODE_THEME_JS_URI.'/jquery.easypiechart.js',array( 'jquery' ),'1.0',true);
		wp_register_script( 'hcode-owl-carousel-js', HCODE_THEME_JS_URI.'/owl.carousel.min.js', array( 'jquery' ), '2.3.4',true );
		wp_enqueue_script( 'hcode-easypiechart-js' );
		wp_enqueue_script( 'hcode-owl-carousel-js' );
	}
}
add_action( 'vc_frontend_editor_enqueue_js_css', 'hcode_vc_frontend_editor_enqueue_js_css' );
