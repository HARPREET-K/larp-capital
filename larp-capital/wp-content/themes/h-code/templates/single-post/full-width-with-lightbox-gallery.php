<?php
/**
 * displaying content with full width with lightbox gallery
 *
 * @package H-Code
 */
?>
<?php
$hcode_options = get_option( 'hcode_theme_setting' ); 
$hcode_disable_post_title = ( isset( $hcode_options['hcode_disable_post_title'] ) ) ? $hcode_options['hcode_disable_post_title'] : '';
$hcode_post_title = hcode_option( 'hcode_enable_post_title' );
$post_author = get_post_field( 'post_author', get_the_ID() );
$author = get_the_author_meta( 'user_nicename', $post_author );
$date = '<span class="published">'.get_the_date( $hcode_options['hcode_single_date_format'], get_the_ID() ).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_options['hcode_single_date_format'] ).'</time>';
$hcode_single_enable_author     = hcode_option( 'hcode_single_enable_author' );
$hcode_single_enable_date       = hcode_option( 'hcode_single_enable_date' );
$hcode_single_date_format       = hcode_option( 'hcode_single_date_format' );
$hcode_single_enable_category   = hcode_option( 'hcode_single_enable_category' );


/* Layout settings */
$hcode_layout_settings = hcode_option( 'hcode_layout_settings' );
$hcode_enable_container_fluid = hcode_option( 'hcode_enable_container_fluid' );

$container_class = $section_class = $comment_class = '';
switch( $hcode_layout_settings ) {
    case 'hcode_layout_full_screen':
        if( isset( $hcode_enable_container_fluid ) && $hcode_enable_container_fluid == '1' ){
            $container_class .= 'container-fluid';
            $section_class .= ' no-padding-bottom';
            $comment_class .= ' col-md-8 col-sm-10';
        }else{
            $container_class .= 'container';
            $section_class .= ' no-padding-bottom';
            $comment_class .= ' col-md-8 col-sm-10';
        }
    break;    
    case 'hcode_layout_both_sidebar':
        $section_class .= ' no-padding';
        $comment_class .= ' col-md-12 col-sm-12 no-padding-lr';
        if( isset( $hcode_enable_container_fluid ) && $hcode_enable_container_fluid == '1' ){
            $container_class .= 'container-fluid';
        } else {
            $container_class .= 'container';
        }
    break;

    case 'hcode_layout_left_sidebar':
    case 'hcode_layout_right_sidebar':
        $section_class .= ' no-padding';
        $comment_class .= ' col-md-12 col-sm-12 no-padding-lr';
        if( isset( $hcode_enable_container_fluid ) && $hcode_enable_container_fluid == '1' ){
            $container_class .= 'container-fluid';
        } else {
            $container_class .= 'container';
        }
    break;
}

$show_title_flag = false;
if( $hcode_disable_post_title == 1 ) {
    if( $hcode_post_title == 1 || empty( $hcode_post_title ) ) {
        $show_title_flag = true;
    }
}
$show_meta_flag = false;
if( $hcode_single_enable_author || $hcode_single_enable_date || $hcode_single_enable_category ) {
    $show_meta_flag = true;
}

if( $show_title_flag || $show_meta_flag ) {
?>
<section class="hcode-full-with-lightbox-gallery wow fadeIn<?php echo esc_attr( $section_class ); ?>">
    <div class="<?php echo esc_attr( $container_class ); ?>">
        <div class="row">
            <div class="col-md-12 col-sm-12 padding-five-bottom">
            <?php
            if( $hcode_disable_post_title == 1 ){
                if( $hcode_post_title == 1 || empty( $hcode_post_title ) ) {
            ?>
                <h2 class="blog-details-headline text-black text-center entry-title"><?php echo get_the_title();?></h2>
            <?php }
            } ?>
                <div class="blog-date no-padding-top text-center standard-post-meta">

                <?php 
                    $posted_by = array();
                    if( $hcode_single_enable_author ) {
                        $posted_by[] = esc_html__('Posted by ', 'H-Code') . '<span class="author vcard"><a class="url fn n" href="' . get_author_posts_url( $post_author ) . '">' . $author . '</a></span>';
                    }
                    if( $hcode_single_enable_date ) {
                        $posted_by[] = $date;
                    }
                    if( $hcode_single_enable_category ) {
                        $post_cat = array();
                        $categories = get_the_category();
                        foreach ($categories as $k => $cat) {
                            $cat_link = get_category_link($cat->cat_ID);
                            $post_cat[]='<a href="'.$cat_link.'" rel="category tag">'.$cat->name.'</a>';
                        }
                        $post_category=implode(",",$post_cat);

                        $posted_by[] = $post_category;
                    }
                    if( !empty( $posted_by ) ) {
                        echo implode(' | ', $posted_by);
                    }
                ?>

                
                </div>
            </div>
        </div>
    </div>
</section>
<?php
}
$hcode_options = get_option( 'hcode_theme_setting' );
$blog_image = hcode_post_meta('hcode_image');
$blog_quote = hcode_post_meta('hcode_quote');
$blog_gallery = hcode_post_meta('hcode_gallery');
$blog_video = hcode_post_meta('hcode_video_type');
$blog_feature_image = hcode_post_meta("hcode_featured_image");
if($blog_image == 1 || !empty($blog_gallery) || !empty($blog_video) || !empty($blog_quote) || $blog_feature_image == 1):
?>
<section class="no-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12 padding-five-bottom">
            <?php
            if ( !post_password_required() ) {
                $output = '';
                if(!empty($blog_quote)){
                    ob_start();
                        get_template_part('loop/single-post/loop','quote');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }elseif(!empty($blog_gallery)){
                    ob_start();
                        get_template_part('loop/single-post/loop','gallery');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }
                elseif(!empty($blog_video)){
                    ob_start();
                        get_template_part('loop/single-post/loop','video');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }
                elseif(!empty($blog_image)){
                    ob_start();
                        get_template_part('loop/single-post/loop','image');
                        $output .= ob_get_contents();  
                    ob_end_clean();  
                }
                
                echo sprintf( __('%s','H-Code'),$output);
            }
            ?>
            </div>
        </div>
    </div>
</section>
<?php endif; ?>
<div class="entry-content">
    <?php the_content(); ?>
</div>
<?php
wp_link_pages( array(
    'before'      => '<div class="page-links default-link-pages"><span class="page-links-title">' . esc_html__( 'Pages:', 'H-Code' ) . '</span>',
    'after'       => '</div>',
    'pagelink'    => '<span class="page-numbers">%</span>',
) );
$hcode_enable_tags = hcode_option('hcode_enable_meta_tags');

if($hcode_enable_tags == 1):
$tags_list = get_the_tag_list( '', _x( ', ', 'Used between list items, there is a space after the comma.', 'H-Code' ) );
if ( $tags_list ) { 
?>
    <section class="no-padding">
        <div class="container">
            <div class="row">
                <div class="wpb_column hcode-column-container col-md-12 col-sm-12 col-xs-12 blog-date no-padding-top margin-five-top">
                    <?php hcode_single_post_meta_tag(); ?>
                </div>
            </div>
        </div>
    </section>
<?php
}
endif;
    ?>
<section class="no-padding">
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <?php
                    $enable_post_author = hcode_option('hcode_enable_post_author');

                    if($enable_post_author == 1):
                        // Author bio.
                        if ( is_single() && get_the_author_meta( 'description' ) ) :
                                get_template_part( 'author-bio' );
                        endif;
                    endif;
                ?>
                <?php 
                $enable_social_icons = hcode_option('hcode_social_icons');
                
                if($enable_social_icons == 1 && class_exists('Hcode_Addons_Post_Type')):
                    echo do_shortcode( '[hcode_single_post_share]' ); 
                endif;
                ?>
            </div>
        </div>
    </div>
</section>
<?php
// If comments are open or we have at least one comment, load up the comment template
$hcode_enable_post_comment = hcode_option('hcode_enable_post_comment');

if( $hcode_enable_post_comment == 1 ):
    if ( comments_open() || get_comments_number() ) : ?>
    <section class="padding-two wow fadeIn">
        <div class="<?php echo esc_attr( $container_class ); ?>">
            <div class="row">
                <div class="center-col<?php echo esc_attr( $comment_class ); ?>">
                  <?php comments_template(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php 
    endif;
endif;
?>
<?php
$enable_navigation = hcode_option('hcode_enable_navigation');

if($enable_navigation == 1):
    hcode_single_post_navigation(); 
endif;