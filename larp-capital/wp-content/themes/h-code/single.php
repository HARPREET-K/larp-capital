<?php
/**
 * The template for displaying all single posts
 *
 * @package H-Code
 */

get_header(); ?>
<?php
    // Start of the loop.
    while ( have_posts() ) : the_post();
        $layout_settings = $enable_container_fluid = $class_main_section = $section_class = $single_post_layout = '';
        // Get Theme option.
        $hcode_options = get_option( 'hcode_theme_setting' );
        // Set Layout Setting
        $layout_settings = isset($hcode_options['hcode_layout_settings_post']) ? $hcode_options['hcode_layout_settings_post'] :'';

        if( !empty($layout_settings)){
            $layout_settings = hcode_option_post('hcode_layout_settings');
            $enable_container_fluid = hcode_option_post('hcode_enable_container_fluid');
        
            $single_post_layout = hcode_option('hcode_single_layout_settings');
            switch ($layout_settings) {
                case 'hcode_layout_full_screen':
                    if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
                        $class_main_section .= 'container-fluid';
                    }else{
                        $class_main_section .= 'container';
                    }
                    $section_class .= 'no-padding';
                break;

                case 'hcode_layout_both_sidebar':
                    $class_main_section .= 'container col3-layout';
                break;

                case 'hcode_layout_left_sidebar':
                case 'hcode_layout_right_sidebar':
                    $section_class .= 'no-padding-bottom';
                    
                    if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
                        $class_main_section .= 'container-fluid col2-layout';
                    } else {
                        $class_main_section .= 'container col2-layout';
                    }
                break;
                
                default:
                    if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
                        $class_main_section .= 'container-fluid';
                    } else {
                        $class_main_section .= 'container';
                    }
                break;
            }

            $section_class .= ' parent-section';
            $hcode_post_classes = '';
            ob_start();
                post_class( $section_class );
                $hcode_post_classes .= ob_get_contents();
            ob_end_clean();
            
            $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
            $hcode_disable_post_title = (isset($hcode_options['hcode_disable_post_title'])) ? $hcode_options['hcode_disable_post_title'] : '';
            $hcode_post_title = hcode_option('hcode_enable_post_title');
            $featured_image = get_post_thumbnail_id( get_the_ID() );

            $hcode_image_overlay = $bg_img_style = '';
            $hcode_srcset = $hcode_srcset_data = $hcode_srcset_classes = '';
            $hcode_image_overlay = 'bg-black';
            if( $featured_image ){
                $featured_image = $featured_image;
            } elseif( !empty( $hcode_no_image['id'] ) ) {
                $featured_image = $hcode_no_image['id'];
            }

            if( !empty( $featured_image ) ) {
                $img_id = $featured_image;
                $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
                if( $hcode_srcset ){
                    $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
                    $hcode_srcset_classes = ' bg-image-srcset';
                }
                $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );
                $bg_img_style = ' style="background: transparent url(\'' . $hcode_image_url[0] . '\') repeat scroll 50% 0%;"';
            }

            if( $single_post_layout == 'hcode_single_layout_full_width' ) {
                echo '<section class="wow fadeIn blog-single-full-width-header fix-background parallax-fix'.$hcode_srcset_classes.'"'.$bg_img_style.$hcode_srcset_data.'>';
                    echo '<div class="opacity-full '.$hcode_image_overlay.'"></div>';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-7 col-sm-8 position-relative full-width-headline text-center center-col">';
                                echo '<h2 class="white-text alt-font entry-title">';
                                    if( $hcode_disable_post_title == 1 ){
                                        if( $hcode_post_title == 1 || empty($hcode_post_title) ){
                                            echo get_the_title();
                                        }
                                    }
                                echo '</h2>';
                                hcode_full_width_single_post_meta();
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }

            echo '<section '.$hcode_post_classes.'>';
                echo '<div class="'.$class_main_section.'">';
                    echo '<div class="row">';
                        get_template_part('templates/post-sidebar-left'); 
                        switch ($single_post_layout) {
                            case 'hcode_single_layout_standard':
                                // Standard Post layout.
                                get_template_part('templates/single-post/standard','post');
                            break;

                            case 'hcode_single_layout_full_width':
                                // Full Width Header Image Post layout.
                                get_template_part('templates/single-post/full','post');
                            break;

                            case 'hcode_single_layout_full_width_image_slider':
                                // Full Width With Image Slider Post layout.
                                get_template_part('templates/single-post/full','post-with-slider');
                            break;

                            case 'hcode_single_layout_full_width_lightbox':
                                // Full Width With Lightbox Slider Gallery layout.
                                get_template_part('templates/single-post/full','width-with-lightbox-gallery');
                            break;
                        }
                        // If Is Set Get Post Right Sidebar.
                        get_template_part('templates/post-sidebar-right');

                        // If Is Set Get Post Related Posts.
                        $enable_related_posts = hcode_option('hcode_enable_related_posts');
                        
                        if($enable_related_posts == 1):
                            hcode_single_post_related_posts();
                        endif;
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        
        } else {
            
            $layout_settings = hcode_option('hcode_layout_settings');
            $enable_container_fluid = hcode_option('hcode_enable_container_fluid');
        
            $single_post_layout = hcode_option('hcode_single_layout_settings');

            switch ($layout_settings) {
                case 'hcode_layout_full_screen':
                    if(isset($enable_container_fluid) && $enable_container_fluid == '1') {
                        $class_main_section .= 'container-fluid';
                        $section_class .= 'no-padding';
                    }else{
                        $class_main_section .= 'container';
                        $section_class .= 'no-padding';
                    }
                break;

                case 'hcode_layout_both_sidebar':
                    $section_class .= '';
                    $class_main_section .= 'container col3-layout';
                break;

                case 'hcode_layout_left_sidebar':
                case 'hcode_layout_right_sidebar':
                    $section_class .= 'no-padding-bottom';
                    $class_main_section .= 'container col2-layout';
                break;
                
                default:
                    $section_class .= '';
                    $class_main_section .= 'container';
                break;
            }

            $section_class .= ' parent-section';
            $hcode_post_classes = '';
            ob_start();
                post_class( $section_class );
                $hcode_post_classes .= ob_get_contents();
            ob_end_clean();
            
            $hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
            $hcode_disable_post_title = (isset($hcode_options['hcode_disable_post_title'])) ? $hcode_options['hcode_disable_post_title'] : '';
            $hcode_post_title = hcode_option('hcode_enable_post_title');
            $featured_image = get_post_thumbnail_id( get_the_ID() );

            $hcode_image_overlay = $bg_img_style = '';
            $hcode_image_overlay = 'bg-black';
            if( $featured_image ){
                $featured_image = $featured_image;
            } elseif( !empty( $hcode_no_image['id'] ) ) {
                $featured_image = $hcode_no_image['id'];
            }

            if( !empty( $featured_image ) ) {
                $img_id = $featured_image;
                $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
                if( $hcode_srcset ){
                    $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
                    $hcode_srcset_classes = ' bg-image-srcset';
                }
                $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );
                $bg_img_style = ' style="background: transparent url(\'' . $hcode_image_url[0] . '\') repeat scroll 50% 0%;"';
            }

            if( $single_post_layout == 'hcode_single_layout_full_width' ) {
                echo '<section class="wow fadeIn blog-single-full-width-header fix-background parallax-fix'.$hcode_srcset_classes.'"'.$bg_img_style.$hcode_srcset_data.'>';
                    echo '<div class="opacity-full '.$hcode_image_overlay.'"></div>';
                    echo '<div class="container">';
                        echo '<div class="row">';
                            echo '<div class="col-md-7 col-sm-8 position-relative full-width-headline text-center center-col">';
                                echo '<h2 class="white-text alt-font entry-title">';
                                    if( $hcode_disable_post_title == 1 ){
                                        if( $hcode_post_title == 1 || empty($hcode_post_title) ){
                                            echo get_the_title();
                                        }
                                    }
                                echo '</h2>';
                                hcode_full_width_single_post_meta();
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</section>';
            }
            echo '<section '.$hcode_post_classes.'>';
                echo '<div class="'.$class_main_section.'">';
                    echo '<div class="row">';
                        // If Is Set Get Post Left Sidebar.
                        get_template_part('templates/post-sidebar-left'); 
                                    
                        switch ($single_post_layout) {
                            case 'hcode_single_layout_standard':
                                // Standard Post layout.
                                get_template_part('templates/single-post/standard','post');
                            break;

                            case 'hcode_single_layout_full_width':
                                // Full Width Header Image Post layout.
                                get_template_part('templates/single-post/full','post');
                            break;

                            case 'hcode_single_layout_full_width_image_slider':
                                // Full Width With Image Slider Post layout.
                                get_template_part('templates/single-post/full','post-with-slider');
                            break;

                            case 'hcode_single_layout_full_width_lightbox':
                                // Full Width With Lightbox Slider Gallery layout.
                                get_template_part('templates/single-post/full','width-with-lightbox-gallery');
                            break;
                        }
                        // If Is Set Get Post Right Sidebar.
                        get_template_part('templates/post-sidebar-right');

                        // If Is Set Get Post Related Posts.
                        $enable_related_posts = hcode_option('hcode_enable_related_posts');
                        
                        if($enable_related_posts == 1):
                            hcode_single_post_related_posts();
                        endif;
                    echo '</div>';
                echo '</div>';
            echo '</section>';
        }
// End of the loop.
endwhile;

get_footer();