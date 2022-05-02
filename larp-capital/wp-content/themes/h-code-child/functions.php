<?php

/**
 * H-Code Child Theme Function File
 */

if ( ! function_exists( 'hcode_child_style' ) ) :
	function hcode_child_style() {
	    wp_enqueue_style( 'hcode-parent-style', get_template_directory_uri(). '/style.css', array( 'hcode-animate-style', 'hcode-bootstrap', 'hcode-et-line-icons-style', 'hcode-font-awesome-style', 'hcode-magnific-popup-style', 'hcode-owl-carousel-style', 'hcode-owl-transitions-style', 'hcode-text-effect-style', 'hcode-menu-hamburger-style', 'hcode-mCustomScrollbar-style' ), '1.0' );
	}
endif;
add_action( 'wp_enqueue_scripts', 'hcode_child_style' );