<?php
/**
 * displaying content with full width slider
 *
 * @package H-Code
 */
?>
<?php
$hcode_options = get_option( 'hcode_theme_setting' ); 
// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
$hcode_disable_post_title = (isset($hcode_options['hcode_disable_post_title'])) ? $hcode_options['hcode_disable_post_title'] : '';
$hcode_post_title = hcode_option('hcode_enable_post_title');
$featured_image = get_post_thumbnail_id( get_the_ID() );

if( $featured_image ) {
    $featured_image = $featured_image;
} elseif( !empty( $hcode_no_image['id'] ) ) {
    $featured_image = $hcode_no_image['id'];
}

$hcode_srcset_classes = $hcode_srcset_data = '';
if( $featured_image ) {
    $img_id = $featured_image;
    $hcode_srcset = wp_get_attachment_image_srcset( $img_id, 'full' );
    if( $hcode_srcset ){
        $hcode_srcset_data = ' data-bg-srcset="'.esc_attr( $hcode_srcset ).'"';
        $hcode_srcset_classes = ' bg-image-srcset';
    }
    $hcode_image_url = wp_get_attachment_image_src($img_id, 'full' );
    echo '<section class="wow fadeIn blog-single-full-width-with-image-slider-header background-center-fix'.$hcode_srcset_classes.'" style="background: url('.$hcode_image_url[0].');"'.$hcode_srcset_data.'></section>';
}
    
$post_author = get_post_field( 'post_author', get_the_ID() );
$author = get_the_author_meta( 'user_nicename', $post_author);
$day = get_the_date('d', get_the_ID());
$month = get_the_date('F', get_the_ID());
$year = get_the_date('Y', get_the_ID()); 

$hcode_single_enable_author     = hcode_option('hcode_single_enable_author');
$hcode_single_enable_date       = hcode_option('hcode_single_enable_date');
$hcode_single_date_format       = hcode_option('hcode_single_date_format');
$hcode_single_enable_category   = hcode_option('hcode_single_enable_category');
?>
<section class="wow fadeIn bg-yellow">
    <div class="container">
        <div class="row">
            <!-- content  -->
            <div class="col-md-12 col-sm-12 blog-headline position-relative">
                <?php if( $hcode_single_enable_date ) { ?>
                <!-- post date  -->
                <div class="blog-date bg-black white-text text-center alt-font"><span class="white-text"><?php echo esc_attr($day);?></span><?php echo esc_attr($month);?></div>
                <!-- end post date  -->
                <?php } ?>
                <div class="col-md-10 col-sm-9 col-xs-12 xs-no-padding pull-right">
                    <!-- post title  -->
                    <?php
                    if( $hcode_disable_post_title == 1 ){
                        if( $hcode_post_title == 1 || empty($hcode_post_title) ){
                    ?>
                        <h2 class="blog-single-full-width-with-image-slider-headline alt-font text-black entry-title"><?php echo get_the_title();?></h2>
                    <?php }
                    } ?>
                    <!-- end post title  -->
                    <?php if( $hcode_single_enable_author ) { ?>
                        <!-- Posted by  -->
                        <span class="posted-by blog-single-full-width-with-image-slider-meta text-uppercase white-text alt-font"><?php echo sprintf( '%1$s <span class="author vcard"><a class="white-text url fn n" href="%2$s">%3$s</a></span>',esc_html__( 'Posted by - ', 'H-Code' ), esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ), get_the_author() ); ?></span>
                        <!-- end Posted by  -->
                    <?php } ?>
                    <?php if( $hcode_single_enable_category ) { ?>
                    <!-- post categories  -->
                    <div class="blog-cat text-uppercase">
                    <?php
                        $categories = get_the_category();
                        foreach ($categories as $k => $cat) {
                            $cat_link = get_category_link($cat->cat_ID);
                            echo '<a href="'.$cat_link.'" rel="category tag">'.$cat->name.'</a>';
                        }
                    ?>
                    </div>
                    <?php } ?>
                </div>
                <!-- end post categories  -->
            </div>
            <!-- slider  -->
            
            <!-- end slider  -->
        </div>
        <!-- end content  -->
    </div>
</section>
<?php
$hcode_options = get_option( 'hcode_theme_setting' );
$blog_image = hcode_post_meta('hcode_image');
$blog_quote = hcode_post_meta('hcode_quote');
$blog_gallery = hcode_post_meta('hcode_gallery');
$blog_video = hcode_post_meta('hcode_video_type');
$blog_feature_image = hcode_post_meta("hcode_featured_image");
if($blog_image == 1 || !empty($blog_gallery) || !empty($blog_video) || !empty($blog_quote) || $blog_feature_image == 1):
?>
<?php if ( !post_password_required() ) { ?>
<section>
    <div class="container">
        <div class="row">
            <div class="col-md-12 col-sm-12">
            <?php
                $output ='';
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
            ?>
            </div>
        </div>
    </div>
</section>
<?php } else{  ?>
<section class="no-padding-top"></section>
<?php } ?>
<?php endif; ?>
<div class="blog-details-text entry-content">
	<?php the_content(); ?>
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
            <div class="col-md-12 col-sm-12 col-xs-12 blog-date text-left border-bottom no-padding-lr center-col padding-four">
                <?php hcode_single_post_meta_tag(); ?>
            </div>
        </div>
    </section>
    <?php
    }
    endif;
    ?>
</div>
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

<?php
	// If comments are open or we have at least one comment, load up the comment template
$hcode_enable_post_comment = hcode_option('hcode_enable_post_comment');

if( $hcode_enable_post_comment == 1 ):
	if ( comments_open() || get_comments_number() ) : ?>
    <section class="wow fadeIn clear-both no-padding">
        <div class="container">
            <div class="row">
                <div class="col-md-9 col-sm-12 center-col">
		          <?php comments_template(); ?>
                </div>
            </div>
        </div>
    </section>
    <?php 
	endif;
endif;

$enable_navigation = hcode_option('hcode_enable_navigation');

if($enable_navigation == 1):
    hcode_single_post_navigation(); 
endif;