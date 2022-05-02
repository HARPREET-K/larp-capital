<?php
/**
 * The template for displaying pages
 *
 * This is the template that displays all pages by default.
 * Please note that this is the WordPress construct of pages and that
 * other "pages" on your WordPress site will use a different template.
 *
 * @package H-Code
 */
get_header(); ?>
<?php
// Start the loop.
while ( have_posts() ) : the_post();

    $layout_settings = $enable_container_fluid = $class_main_section = $section_class = '';
    
    $hcode_options = get_option( 'hcode_theme_setting' );
    
    $layout_settings = hcode_option('hcode_layout_settings');
    $enable_container_fluid = hcode_option('hcode_enable_container_fluid');

    $hcode_enable_page_feature_image = hcode_option( 'hcode_enable_page_feature_image' );
    
    switch ($layout_settings) {
        case 'hcode_layout_full_screen':
            $section_class .= 'no-padding';
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid';
            }else{
                $class_main_section .= 'container';
            }
        break;

        case 'hcode_layout_both_sidebar':
            
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid col3-layout';
            }else{
                $class_main_section .= 'container col3-layout';
            }
        break;

        case 'hcode_layout_left_sidebar':
        case 'hcode_layout_right_sidebar':
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid col2-layout';
            }else{
                $class_main_section .= 'container col2-layout';
            }
        break;

        default:
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid';
            }else{
                $class_main_section .= 'container';
            }
        break;
    }
    
    $hcode_post_class_list = array();
    $hcode_post_class_list[] = 'parent-section '.$section_class.'';
    
?>
<section <?php post_class( $hcode_post_class_list ) ?>>
    <div class="<?php echo esc_attr($class_main_section); ?>">
        <div class="row">
        
            <?php if ( post_password_required() ) { ?>
                <section>
                    <div class="container">
                        <div class="row no-margin">
            <?php } ?>

                <?php get_template_part('templates/sidebar-left'); ?>

                <?php
                if ( is_singular() && has_post_thumbnail() && $hcode_enable_page_feature_image == 1 ) :
                     if( $layout_settings == 'hcode_layout_full_screen' ) {
                         echo '<section class="no-padding-bottom margin-bottom-40px">';
                     } else {
                         echo '<section class="margin-bottom-40px no-padding">';
                     }
                     
                         if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                             echo '<div class="container-fluid">';
                         }else{
                             echo '<div class="container">';
                         }
                         
                             echo '<div class="row">';
                                the_post_thumbnail('full');
                             echo '</div>';
                         echo '</div>';
                     echo '</section>';
                endif; // End is_singular()

                echo '<div class="hcode-rich-snippet display-none">';
                echo '<span class="entry-title">'.get_the_title().'</span>';
                
                echo '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span>';
                echo '<span class="published">'.get_the_date().'</span><time class="updated" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date().'</time>';
                echo '</div>';
                    
                ?>

                <div class="entry-content">
                    <?php the_content(); ?>
                </div>
                    <?php
                        wp_link_pages( array(
                            'before' => '<div class="page-links">' . esc_html__( 'Pages:', 'H-Code' ),
                            'after'  => '</div>',
                        ) );
                        $enable_comment = hcode_option('hcode_enable_page_comment');

                        if($enable_comment == 'default'):
                            $enable_page_comment = hcode_option('hcode_enable_page_comment');
                        else:
                            $enable_page_comment = $enable_comment;
                        endif;

                        if ( $enable_page_comment == 1 && (comments_open() || get_comments_number()) ) :
                            comments_template();
                        endif;
                    ?>
                <?php get_template_part('templates/sidebar-right'); ?>

            <?php if ( post_password_required() ) { ?>
                        </div>    
                    </div>
                </section>
            <?php } ?>

        </div>
    </div>
</section>
<?php 
endwhile;
// End the loop.
?>
<?php 
    get_footer();