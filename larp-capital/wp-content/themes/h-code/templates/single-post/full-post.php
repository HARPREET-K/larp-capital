<?php
/**
 * displaying content with full width header
 *
 * @package H-Code
 */
?>
<?php 
$output = '';
$hcode_options = get_option( 'hcode_theme_setting' );

$blog_image = hcode_post_meta('hcode_image');
$blog_quote = hcode_post_meta('hcode_quote');
$blog_gallery = hcode_post_meta('hcode_gallery');
$blog_video = hcode_post_meta('hcode_video_type');
$blog_feature_image = hcode_post_meta("hcode_featured_image");
if($blog_image == 1 || !empty($blog_gallery) || !empty($blog_video) || !empty($blog_quote) || $blog_feature_image == 1):
?>
<section class="no-padding-bottom">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-sm-10 center-col text-center">
            <?php
            if ( !post_password_required() ) {
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
            <div class="row">
                <div class="wpb_column hcode-column-container col-md-8 col-sm-10 text-center center-col blog-date">
                    <?php hcode_single_post_meta_tag(); ?>
                </div>
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
        echo '<section class="no-padding">';
            echo '<div class="container">';
                echo '<div class="row">';
                    get_template_part( 'author-bio' );
                echo '</div>';
            echo '</div>';
        echo '</section>';

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
    <section class="no-padding wow fadeIn">
        <div class="container">
            <div class="row">
                <div class="col-md-8 col-sm-10 center-col">
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