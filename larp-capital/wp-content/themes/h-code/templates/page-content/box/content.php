<?php
/**
 * displaying content for blog single page grid layout
 *
 * @package H-Code
 */
?>
<?php
global $hcode_archive_page_thumbnail_size;

$class = $infinite_scroll_main_class = '';
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_search_layout_settings = (isset($hcode_options['hcode_general_layout_settings'])) ? $hcode_options['hcode_general_layout_settings'] : '';
// Added in v1.6
$hcode_enable_title = (isset($hcode_options['hcode_general_enable_title'])) ? $hcode_options['hcode_general_enable_title'] : '';
$hcode_enable_author = (isset($hcode_options['hcode_general_enable_author'])) ? $hcode_options['hcode_general_enable_author'] : '';
$hcode_enable_date = (isset($hcode_options['hcode_general_enable_date'])) ? $hcode_options['hcode_general_enable_date'] : '';
$hcode_date_format = (isset($hcode_options['hcode_general_date_format'])) ? $hcode_options['hcode_general_date_format'] : '';
$hcode_enable_like = (isset($hcode_options['hcode_general_enable_like'])) ? $hcode_options['hcode_general_enable_like'] : '';
$hcode_enable_comment = (isset($hcode_options['hcode_general_enable_comment'])) ? $hcode_options['hcode_general_enable_comment'] : '';
$hcode_enable_excerpt = (isset($hcode_options['hcode_general_enable_excerpt'])) ? $hcode_options['hcode_general_enable_excerpt'] : '';
$hcode_excerpt_length = (isset($hcode_options['hcode_general_excerpt_length'])) ? $hcode_options['hcode_general_excerpt_length'] : '';
$hcode_enable_content = (isset($hcode_options['hcode_general_enable_content'])) ? $hcode_options['hcode_general_enable_content'] : '';

$hcode_columns_settings = (isset($hcode_options['hcode_general_columns_settings'])) ? $hcode_options['hcode_general_columns_settings'] : '';
$hcode_archive_page_thumbnail_size = (isset($hcode_options['hcode_general_archive_page_thumbnail_size'])) ? $hcode_options['hcode_general_archive_page_thumbnail_size'] : 'full';

// H-Code V1.8 add pagination style.
$hcode_general_archive_page_enable_navigation = (isset($hcode_options['hcode_general_archive_page_enable_navigation'])) ? $hcode_options['hcode_general_archive_page_enable_navigation'] : '1';
$hcode_general_archive_page_navigation_style = (isset($hcode_options['hcode_general_archive_page_navigation_style'])) ? $hcode_options['hcode_general_archive_page_navigation_style'] : 'number-pagination';

$hcode_show_thumbnail = (isset($hcode_options['hcode_general_show_thumbnail'])) ? $hcode_options['hcode_general_show_thumbnail'] : '';
$hcode_show_feature_image = (isset($hcode_options['hcode_general_show_feature_image'])) ? $hcode_options['hcode_general_show_feature_image'] : '0';

// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
switch ($hcode_columns_settings) {
    case '2':
        $class .= 'col-md-6 col-sm-6 col-xs-12';
    break;
    case '4':
        $class .= 'col-md-3 col-sm-6 col-xs-12';
    break;
    default : 
        $class .= 'col-md-4 col-sm-6 col-xs-12';
    break;
}
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

if( have_posts() ){
    echo '<div class="blog-archive-box-layout'.$infinite_scroll_main_class.'">';
        while ( have_posts() ) : the_post();
            
            // Added in H-Code v1.8
            $hcode_post_class_list = array();
            if( $hcode_general_archive_page_enable_navigation == 1 ) {
                if( $hcode_general_archive_page_navigation_style == 'infinite-scroll-pagination' ) {
                    $hcode_post_class_list[] = 'blog-single-post';
                }
            }

            $hcode_post_classes = '';
            ob_start();
                post_class( $hcode_post_class_list );
                $hcode_post_classes .= ob_get_contents();
            ob_end_clean();

            $hcode_show_author =  ( $hcode_enable_author == 1 ) ? esc_html__('Posted by ', 'H-Code').'<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span> | ' : '';
            $show_date = ( $hcode_enable_date == 1 ) ? '<span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time>' : '';
            $post_type = get_post_type( get_the_ID() );
            echo '<div '.$hcode_post_classes.'>';
                echo '<div class="'.$class.' latest-blogs margin-three-bottom sm-margin-bottom-four">';
                    echo '<div class="blog-listing no-margin">';
                        echo '<div class="blog-image">';
                            $blog_quote = hcode_post_meta('hcode_quote');
                            $blog_image = hcode_post_meta('hcode_image');
                            $blog_gallery = hcode_post_meta('hcode_gallery');
                            $blog_video = hcode_post_meta('hcode_video_type');
                            if( $hcode_show_thumbnail == 1 ){
                                if( !empty( $blog_image ) && $hcode_show_feature_image != 1 ){
                                    get_template_part('loop/archive/loop','image');  
                                }
                                elseif( !empty( $blog_gallery ) && $hcode_show_feature_image != 1 ){
                                    get_template_part('loop/archive/loop','gallery');
                                }
                                elseif( !empty( $blog_video ) && $hcode_show_feature_image != 1 ){
                                    get_template_part('loop/archive/loop','video');
                                }
                                elseif( !empty( $blog_quote ) && $hcode_show_feature_image != 1 ){
                                    get_template_part('loop/archive/loop','quote'); 
                                }else{
                                    echo '<div class="blog-image"><a href="'.get_permalink().'">';
                                    if ( has_post_thumbnail() ) {
                                        echo get_the_post_thumbnail( get_the_ID(), $hcode_archive_page_thumbnail_size );
                                    } elseif( !empty( $hcode_no_image['url'] ) ) {
                                        echo wp_get_attachment_image( $hcode_no_image['id'], $hcode_archive_page_thumbnail_size );
                                    }
                                    echo '</a></div>';  
                                }
                            }
                            echo '<div class="blog-content xs-text-center">';
                                echo '<div class="slider-text-middle-main">';
                                    echo '<div class="slider-text-middle">';
                                        echo '<span class="post-author">'.$hcode_show_author.$show_date.'</span>';
                                        if($hcode_enable_title == 1){
                                            echo '<a class="post-title entry-title" href="'.get_permalink().'">'.get_the_title().'</a>';
                                        }
                                        if($hcode_enable_excerpt == 1):
                                            $show_excerpt = ( $hcode_excerpt_length ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : wpautop(hcode_get_the_excerpt_theme(15));
                                            echo '<div class="entry-content">'.$show_excerpt.'</div>';
                                        elseif($hcode_enable_content == 1):
                                            $show_content = apply_filters( 'the_content', $post->post_content );
                                            echo '<div class="entry-content">'.$show_content.'</div>';
                                        endif;
                                        if( $hcode_enable_like == 1 || $hcode_enable_comment == 1 ):
                                            echo '<div class="like-share">';
                                                if( $hcode_enable_like == 1 ){
                                                    echo get_simple_likes_button( get_the_ID() );
                                                }
                                                if( $hcode_enable_comment == 1 && (comments_open() || get_comments_number())){
                                                        echo comments_popup_link( __( '<i class="far fa-comment"></i>Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                                }
                                            echo '</div>';
                                        endif;
                                    echo'</div>';
                                echo '</div>';
                            echo '</div>';
                        echo '</div>';
                    echo '</div>';
                echo '</div>';
            echo '</div>';
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