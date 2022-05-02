<?php
/**
 * displaying layout for archive, search page
 *
 * @package H-Code
 */

get_header(); 

$layout_settings = $enable_container_fluid = $class_main_section = '';
$layout_settings_inner = hcode_option('hcode_general_settings');
$hcode_options = get_option( 'hcode_theme_setting' );

   
$layout_settings = (isset($hcode_options['hcode_general_settings'])) ? $hcode_options['hcode_general_settings'] : 'hcode_general_right_sidebar';
$enable_container_fluid = (isset($hcode_options['hcode_general_enable_container_fluid'])) ? $hcode_options['hcode_general_enable_container_fluid'] : '';
switch ($layout_settings) {
    case 'hcode_general_full_screen':
        if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
            $class_main_section .= 'container-fluid';
        } else {
            $class_main_section .= 'container';
        }
    break;

    case 'hcode_general_both_sidebar':
        $class_main_section .= 'container col3-layout';
    break;

    case 'hcode_general_left_sidebar':
    case 'hcode_general_right_sidebar':
        $class_main_section .= 'container col2-layout';
    break;

    default:
        $class_main_section .= 'container';
    break;
}

// Check menu type for page
$hcode_header_menu_type = (isset($hcode_options['hcode_header_layout_general'])) ? $hcode_options['hcode_header_layout_general'] : 'headertype6';
$hcode_layout_settings = (isset($hcode_options['hcode_general_layout_settings'])) ? $hcode_options['hcode_general_layout_settings'] : 'classic';

echo '<section class="parent-section '.esc_attr( $hcode_header_menu_type ).'">';
    echo '<div class="'.esc_attr( $class_main_section ).'">';
        echo '<div class="row">';
        
            get_template_part( 'templates/archive', 'left' );
            
            if( is_category() || is_tag() ) {
                the_archive_description( '<div class="archive-description text-med">', '</div>' ); 
            }
            
            get_template_part( 'templates/page-content/'.$hcode_layout_settings.'/content' );
        
            get_template_part( 'templates/archive', 'right' ); 
        echo '</div>';
    echo '</div>';
echo '</section>';
	
get_footer();