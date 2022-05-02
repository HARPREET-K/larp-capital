<?php
/**
 * displaying layout for archive, search page
 *
 * @package H-Code
 */
get_header(); 
?>
<?php
    $layout_settings = $enable_container_fluid = $class_main_section = $section_class = '';
    $layout_settings_inner = hcode_option('hcode_blog_page_settings');
    
    $layout_settings = $layout_settings_inner;
    $enable_container_fluid = hcode_option('hcode_blog_page_enable_container_fluid');
    switch ($layout_settings) {
        case 'hcode_blog_page_full_screen':
            if(isset($enable_container_fluid) && $enable_container_fluid == '1'){
                $class_main_section .= 'container-fluid';
            }else{
                $class_main_section .= 'container';
            }
        break;

        case 'hcode_blog_page_both_sidebar':
            $class_main_section .= 'container col3-layout';
        break;

        case 'hcode_blog_page_left_sidebar':
        case 'hcode_blog_page_right_sidebar':
            $class_main_section .= 'container col2-layout';
        break;

        default:
            $class_main_section .= 'container';
        break;
    }   

    get_template_part('templates/title');

?>
<section class="parent-section">
    <div class="<?php echo esc_attr($class_main_section); ?>">
        <div class="row">
            <?php get_template_part('templates/blog-page-left'); ?>
                <?php 
                    get_template_part('templates/index-content/content');
                ?>
            <?php get_template_part('templates/blog-page-right'); ?>
        </div>
    </div>
</section>
<?php get_footer(); ?>