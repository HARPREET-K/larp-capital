<?php
/**
 * displaying content for blog single page modern layout
 *
 * @package H-Code
 */
?>
<?php
global $hcode_archive_page_thumbnail_size;
$page = $infinite_scroll_main_class = '';
if(is_search()){
    $page = 'search';
}
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_search_layout_settings = (isset($hcode_options['hcode_general_layout_settings'])) ? $hcode_options['hcode_general_layout_settings'] : '';
// Added in v1.6
$hcode_enable_title = (isset($hcode_options['hcode_general_enable_title'])) ? $hcode_options['hcode_general_enable_title'] : '';
$hcode_enable_author = (isset($hcode_options['hcode_general_enable_author'])) ? $hcode_options['hcode_general_enable_author'] : '';
$hcode_enable_date = (isset($hcode_options['hcode_general_enable_date'])) ? $hcode_options['hcode_general_enable_date'] : '';
$hcode_date_format = (isset($hcode_options['hcode_general_date_format'])) ? $hcode_options['hcode_general_date_format'] : '';
$hcode_enable_like = (isset($hcode_options['hcode_general_enable_like'])) ? $hcode_options['hcode_general_enable_like'] : '';
$hcode_enable_comment = (isset($hcode_options['hcode_general_enable_comment'])) ? $hcode_options['hcode_general_enable_comment'] : '';
$hcode_enable_separator = (isset($hcode_options['hcode_general_enable_separator'])) ? $hcode_options['hcode_general_enable_separator'] : '';
$hcode_enable_button = (isset($hcode_options['hcode_general_enable_button'])) ? $hcode_options['hcode_general_enable_button'] : '';
$hcode_button_text = (isset($hcode_options['hcode_general_button_text'])) ? $hcode_options['hcode_general_button_text'] : '';

$hcode_enable_excerpt = (isset($hcode_options['hcode_general_enable_excerpt'])) ? $hcode_options['hcode_general_enable_excerpt'] : '';
$hcode_excerpt_length = (isset($hcode_options['hcode_general_excerpt_length'])) ? $hcode_options['hcode_general_excerpt_length'] : '';
$hcode_enable_content = (isset($hcode_options['hcode_general_enable_content'])) ? $hcode_options['hcode_general_enable_content'] : '';
$hcode_item_per_page = (isset($hcode_options['hcode_general_item_per_page'])) ? $hcode_options['hcode_general_item_per_page'] : '';
$hcode_enable_number = (isset($hcode_options['hcode_general_enable_number'])) ? $hcode_options['hcode_general_enable_number'] : '';

$hcode_archive_page_thumbnail_size = (isset($hcode_options['hcode_general_archive_page_thumbnail_size'])) ? $hcode_options['hcode_general_archive_page_thumbnail_size'] : 'full';

// H-Code V1.8 add pagination style.
$hcode_general_archive_page_enable_navigation = (isset($hcode_options['hcode_general_archive_page_enable_navigation'])) ? $hcode_options['hcode_general_archive_page_enable_navigation'] : '1';
$hcode_general_archive_page_navigation_style = (isset($hcode_options['hcode_general_archive_page_navigation_style'])) ? $hcode_options['hcode_general_archive_page_navigation_style'] : 'number-pagination';

$hcode_show_thumbnail = (isset($hcode_options['hcode_general_show_thumbnail'])) ? $hcode_options['hcode_general_show_thumbnail'] : '';
$hcode_show_feature_image = (isset($hcode_options['hcode_general_show_feature_image'])) ? $hcode_options['hcode_general_show_feature_image'] : '0';

/* H-Code V1.8 Add pagination style */
if( $hcode_general_archive_page_enable_navigation == 1 ) {
    switch( $hcode_general_archive_page_navigation_style ) {
        case 'infinite-scroll-pagination':
            $infinite_scroll_main_class = ' infinite-scroll-pagination';
        break;
        default:
            $infinite_scroll_main_class = '';
        break;
    }
}

// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
$i = 1;
if( have_posts() ) {
    $default_posts_per_page = ( !empty($hcode_item_per_page) ) ? $hcode_item_per_page : get_option( 'posts_per_page' );
    if( $paged > 1){
        $i = ($paged - 1 ) * $default_posts_per_page + 1;
    }
    echo '<div class="blog-archive-modern-layout'.$infinite_scroll_main_class.'">';
    while ( have_posts() ) : the_post();

        // Added in v1.8
        $hcode_post_classes = '';
        $hcode_post_class_list = array();

        if( $hcode_general_archive_page_enable_navigation == 1 ) {
            if( $hcode_general_archive_page_navigation_style == 'infinite-scroll-pagination' ) {
                $hcode_post_class_list[] = 'blog-single-post';
            }
        }

        $hcode_post_class_list[] = 'blog-listing blog-listing-classic blog-listing-full';
        ob_start();
            post_class($hcode_post_class_list);
            $hcode_post_classes .= ob_get_contents();
        ob_end_clean();

        if($i < 10){
            $i = '0'.$i;
        }

        $hcode_show_author =  ( $hcode_enable_author == 1 ) ? esc_html__('Posted by ', 'H-Code').'<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span> ' : '';
        $show_date = ( $hcode_enable_date == 1 ) ? '<span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time>' : '';
        $post_type = get_post_type( get_the_ID() );
        echo '<div '.$hcode_post_classes.'>';
            echo '<div class="col-md-2 col-sm-2 col-xs-5 clearfix text-center no-padding-right xs-padding-right">';
                echo '<div class="avtar text-left"><a href="'.get_permalink().'">';
                        echo get_avatar( get_the_author_meta( 'ID' ), 300 );
                        echo '</a>';
                echo '</div>';

                echo '<div class="blog-date-right light-gray-text2 no-padding-bottom">'.$show_date.'</div>';
                echo '<div class="blog-date-right light-gray-text2">'.$hcode_show_author.'</div>';
                echo '<div class="separator-line bg-black no-margin-lr no-margin xs-margin-ten-bottom"></div>';
            echo '</div>';
            echo '<div class="col-md-10 col-sm-10 col-xs-12 no-padding-left xs-padding-left">';
            if( $hcode_enable_number == 1 ){
                echo '<div class="blog-number bg-white black-text text-center alt-font">'.$i.'</div>';
            }
                $blog_quote = hcode_post_meta('hcode_quote');
                $blog_image = hcode_post_meta('hcode_image');
                $blog_gallery = hcode_post_meta('hcode_gallery');
                $blog_video = hcode_post_meta('hcode_video_type');
                if( $hcode_show_thumbnail == 1 ){
                    if( !empty( $blog_image ) && $hcode_show_feature_image != 1 ){
                        get_template_part('loop/archive/loop','image');  
                    }elseif( !empty( $blog_gallery ) && $hcode_show_feature_image != 1 ){
                        get_template_part('loop/archive/loop','gallery');
                    }elseif( !empty( $blog_video ) && $hcode_show_feature_image != 1 ){
                        get_template_part('loop/archive/loop','video');
                    }elseif( !empty( $blog_quote ) && $hcode_show_feature_image != 1 ){
                        get_template_part('loop/archive/loop','quote'); 
                    } else {
                        if ( has_post_thumbnail() ) {
                            echo '<div class="blog-image"><a href="'.get_permalink().'">';
                            echo get_the_post_thumbnail( get_the_ID(), $hcode_archive_page_thumbnail_size );
                            echo '</a></div>';
                        } elseif( esc_url( $hcode_no_image['url'] ) ) {
                            echo '<div class="blog-image"><a href="'.get_permalink().'">';
                            echo wp_get_attachment_image( $hcode_no_image['id'], $hcode_archive_page_thumbnail_size );
                            echo '</a></div>';
                        }
                    }
                }
                echo '<div class="blog-details">';
                    if( $hcode_enable_title == 1 ){
                        echo '<div class="blog-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                    }
                        if($post_type == 'post'):
                            echo '<div>';
                                if( $hcode_enable_like == 1 ){
                                    echo get_simple_likes_button( get_the_ID() );
                                }
                                if(( $hcode_enable_comment == 1 ) && (comments_open() || get_comments_number())){
                                    comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                }
                            echo '</div>';
                        endif;
                        if( $hcode_enable_separator == 1 ){
                            echo '<div class="separator-line bg-black no-margin-lr margin-four"></div>';
                        }
                        if($hcode_enable_excerpt == 1):
                            $show_excerpt = ( !empty($hcode_excerpt_length) ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : wpautop(hcode_get_the_excerpt_theme(55));
                            echo '<div class="blog-short-description entry-content">'.$show_excerpt.'</div>';
                        elseif($hcode_enable_content == 1):
                            echo '<div class="blog-short-description entry-content">'.hcode_get_the_post_content().'</div>';
                        endif;
                        if( $hcode_enable_button == 1 ){
                            echo '<a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                        }
                echo '</div>';
            echo '</div>';
        echo '</div>';
        $i++;
    endwhile;
    echo '</div>';
    if( $hcode_general_archive_page_enable_navigation == 1 ) {
        if( $wp_query->max_num_pages > 1 ){

            if( $hcode_general_archive_page_navigation_style == 'infinite-scroll-pagination'  ) {

                echo '<div class="pagination hcode-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                    if( get_next_posts_link() ) :
                        next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right text-color"></i>' );
                    endif;
                echo '</div>';

            } else {
                if( $wp_query->query_vars['paged'] > 1 ) {
                    $current = $wp_query->query_vars['paged'];
                } else {
                    $current = 1;
                }
                echo '<div class="pagination">';
                    echo paginate_links( array(
                        'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                        'format'       => '',
                        'add_args'     => '',
                        'current'      => $current,
                        'total'        => $wp_query->max_num_pages,
                        'prev_text'    => '<img alt="Previous" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-small.png" width="20" height="13">',
                        'next_text'    => '<img alt="Next" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-small.png" width="20" height="13">',
                        'type'         => 'plain',
                        'end_size'     => 2,
                        'mid_size'     => 2
                    ) );
                echo '</div>';
                
            }
        }
    }
} else {
    get_template_part('templates/content','none');
}