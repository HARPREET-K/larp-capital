<?php
/**
 * displaying content for archive pages layout
 *
 * @package H-Code
 */
?>
<?php
global $hcode_blog_thumbnail_size;
$output = $class_column = $infinite_scroll_main_class = '';
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_excerpt_length = (isset($hcode_options['hcode_blog_page_excerpt_length'])) ? $hcode_options['hcode_blog_page_excerpt_length'] : '';
$hcode_blog_page_layout = (isset($hcode_options['hcode_blog_page_grid_layout'])) ? $hcode_options['hcode_blog_page_grid_layout'] : '';
$hcode_blog_page_column = (isset($hcode_options['hcode_blog_page_grid_column'])) ? $hcode_options['hcode_blog_page_grid_column'] : '3';
$hcode_blog_page_enable_navigation = (isset($hcode_options['hcode_blog_page_enable_navigation'])) ? $hcode_options['hcode_blog_page_enable_navigation'] : '1';
$hcode_blog_page_navigation_style = (isset($hcode_options['hcode_blog_page_navigation_style'])) ? $hcode_options['hcode_blog_page_navigation_style'] : 'number-pagination';
$hcode_show_post_author = (isset($hcode_options['hcode_blog_page_show_post_author'])) ? $hcode_options['hcode_blog_page_show_post_author'] : '1';
$hcode_show_post_meta = (isset($hcode_options['hcode_blog_page_show_post_meta'])) ? $hcode_options['hcode_blog_page_show_post_meta'] : '';
$hcode_show_excerpt = (isset($hcode_options['hcode_blog_page_show_excerpt'])) ? $hcode_options['hcode_blog_page_show_excerpt'] : '';
$hcode_show_content = (isset($hcode_options['hcode_blog_page_show_content'])) ? $hcode_options['hcode_blog_page_show_content'] : '';
$hcode_show_category = (isset($hcode_options['hcode_blog_page_show_category'])) ? $hcode_options['hcode_blog_page_show_category'] : '';
$hcode_show_posts_like = (isset($hcode_options['hcode_blog_page_show_posts_like'])) ? $hcode_options['hcode_blog_page_show_posts_like'] : '1';
$hcode_show_comments = (isset($hcode_options['hcode_blog_page_show_comments'])) ? $hcode_options['hcode_blog_page_show_comments'] : '';
$hcode_show_social_icon = (isset($hcode_options['hcode_blog_page_show_social_icon'])) ? $hcode_options['hcode_blog_page_show_social_icon'] : '';
$hcode_show_button = (isset($hcode_options['hcode_blog_page_show_button'])) ? $hcode_options['hcode_blog_page_show_button'] : '';
$hcode_button_text = (isset($hcode_options['hcode_blog_page_button_text'])) ? $hcode_options['hcode_blog_page_button_text'] : '';
$hcode_date_format = (isset($hcode_options['hcode_blog_page_date_format'])) ? $hcode_options['hcode_blog_page_date_format'] : '';
$hcode_item_per_page = (isset($hcode_options['hcode_general_item_per_page'])) ? $hcode_options['hcode_general_item_per_page'] : '';
$hcode_show_number = (isset($hcode_options['hcode_blog_page_show_number'])) ? $hcode_options['hcode_blog_page_show_number'] : '';

$layout_settings_class = (isset($hcode_options['hcode_blog_page_settings']) && ( $hcode_options['hcode_blog_page_settings'] == 'hcode_blog_page_both_sidebar' || $hcode_options['hcode_blog_page_settings'] == 'hcode_blog_page_left_sidebar' || $hcode_options['hcode_blog_page_settings'] == 'hcode_blog_page_right_sidebar' ) ) ? ' hcode-list-view-three-col' : '';

$hcode_blog_thumbnail_size = (isset($hcode_options['hcode_blog_page_thumbnail_size'])) ? $hcode_options['hcode_blog_page_thumbnail_size'] : 'full';

$hcode_show_thumbnail = (isset($hcode_options['hcode_blog_page_show_thumbnail'])) ? $hcode_options['hcode_blog_page_show_thumbnail'] : '';
$hcode_show_feature_image = (isset($hcode_options['hcode_blog_page_show_feature_image'])) ? $hcode_options['hcode_blog_page_show_feature_image'] : '0';

// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';

switch ($hcode_blog_page_column) {
    case '2':
        $class_column .= 'col-md-6 col-sm-6 col-xs-12';
    break;
    case '3':
        $class_column .= 'col-md-4 col-sm-6 col-xs-12 margin-four-bottom xs-margin-seven-bottom';
    break;
    case '4':
        $class_column .= 'col-md-3 col-sm-6 col-xs-12';
    break;
}

/* H-Code V1.8 Add pagination style */
if( $hcode_blog_page_enable_navigation == 1 ) {
    switch( $hcode_blog_page_navigation_style ) {
        case 'infinite-scroll-pagination':
            $infinite_scroll_main_class = ' infinite-scroll-pagination';
        break;
        default:
            $infinite_scroll_main_class = '';
        break;
    }
}

if( have_posts() ){
    switch ($hcode_blog_page_layout) {
        case 'grid':

            $blog_columns = ( $hcode_blog_page_column ) ? 'blog-'.$hcode_blog_page_column.'col product-'.$hcode_blog_page_column : '';
            if($hcode_blog_page_column):
               $output .='<div class="'.$blog_columns.$infinite_scroll_main_class.'">';
            endif;
               
            while ( have_posts() ) : the_post();

                // Added in H-Code v1.8
                $hcode_post_class_list = array();
                if( $hcode_blog_page_enable_navigation == 1 ) {
                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination' ) {
                        $hcode_post_class_list[] = 'blog-single-post';
                    }
                }

                $hcode_post_classes = '';
                ob_start();
                    post_class( $hcode_post_class_list );
                    $hcode_post_classes .= ob_get_contents();
                ob_end_clean();
            
                $post_cat = array();
                $categories = get_the_category();
                foreach ($categories as $k => $cat) {
                    $cat_link = get_category_link($cat->cat_ID);
                    $post_cat[]='<a href="'.$cat_link.'" rel="category tag">'.$cat->name.'</a>';
                }
                $post_category=implode(", ",$post_cat);

                $posted_by = array();
                $hcode_show_posted_by = '';
                if( $hcode_show_post_author == 1 ) {
                    $posted_by[] = esc_html__('Posted by ','H-Code'). '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span>';
                }
                if( $hcode_show_post_meta == 1 ) {
                    $posted_by[] = '<span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time>';
                }
                if( $hcode_show_category == 1 ) {
                    $posted_by[] = $post_category;
                }
                if( !empty( $posted_by ) ) {
                    $hcode_show_posted_by = implode(' | ', $posted_by);
                }

                $hcode_categories_list = $post_cat;
                $show_like = ( $hcode_show_posts_like == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                $output .= '<div '.$hcode_post_classes.'>';
                    $output .='<div class="'.$class_column.' blog-listing">';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_video = hcode_post_meta('hcode_video_type');
                        if( $hcode_show_thumbnail == 1 ){
                            if( !empty( $blog_image ) && $hcode_show_feature_image != 1 ){
                                $output .='<div class="blog-post">';
                                ob_start();
                                get_template_part('loop/loop','image');
                                $output .= ob_get_contents();  
                                ob_end_clean();  
                            }
                            elseif( !empty( $blog_gallery ) && $hcode_show_feature_image != 1 ){
                                $output .='<div class="blog-post blog-post-gallery">';
                                ob_start();
                                    get_template_part('loop/loop','gallery');
                                    $output .= ob_get_contents();  
                                ob_end_clean();
                            }
                            elseif( !empty( $blog_video ) && $hcode_show_feature_image != 1 ){
                                $output .='<div class="blog-post blog-post-video">';
                                ob_start();
                                    get_template_part('loop/loop','video');
                                    $output .= ob_get_contents();  
                                ob_end_clean();  
                            }
                            elseif( !empty( $blog_quote ) && $hcode_show_feature_image != 1 ){
                                $output .='<div class="blog-post">';
                                ob_start();
                                    get_template_part('loop/loop','quote');
                                    $output .= ob_get_contents();  
                                ob_end_clean();  
                            }else{
                                $output .='<div class="blog-post">';
                                $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                if ( has_post_thumbnail() ) {
                                    $output .= get_the_post_thumbnail( get_the_ID(), $hcode_blog_thumbnail_size );
                                } elseif( !empty( $hcode_no_image['url'] ) ) {
                                    $output .= wp_get_attachment_image( $hcode_no_image['id'], $hcode_blog_thumbnail_size );
                                }
                                $output .='</a></div>';
                            }
                        }
                        $output .='<div class="blog-details">';
                            if( $hcode_show_posted_by ):
                                $output .='<div class="blog-date">'.$hcode_show_posted_by.'</div>';
                            endif;
                            $output .='<div class="blog-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                            if($hcode_show_excerpt == 1):
                                $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                                $output .='<div class="blog-short-description entry-content">'.$show_excerpt.'</div>';
                            elseif($hcode_show_content == 1):
                               $output .='<div class="blog-short-description entry-content">'.hcode_get_the_post_content().'</div>';
                            endif;
                            $output .='<div class="separator-line bg-black no-margin-lr"></div>';
                            $output .='<div>'.$show_like;
                                if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                    ob_start();
                                        comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                        $output .= ob_get_contents();  
                                    ob_end_clean();
                                }
                            $output .= '</div>';
                            if($hcode_show_button == 1){
                                $output .='<a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                            }
                        $output .='</div>';
                        if( $hcode_show_thumbnail == 1 ){
                            $output .='</div>';
                        }
                    $output .='</div>';
                $output .='</div>';
            endwhile;
            wp_reset_postdata();
            if( $hcode_blog_page_enable_navigation == 1 ) {
                if( $wp_query->max_num_pages > 1 ){

                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination'  ) {

                        $output .='<div class="pagination hcode-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                            ob_start();
                                if( get_next_posts_link() ) :
                                    next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right text-color"></i>' );
                                endif;
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                        $output .='</div>';

                    } else {
                        if( $wp_query->query_vars['paged'] > 1 ) {
                            $current = $wp_query->query_vars['paged'];
                        } else {
                            $current = 1;
                        }
                        $output .='<div class="pagination">';
                            $output .= paginate_links( array(
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
                        $output .='</div>';
                        
                    }
                }
            }
            if( $hcode_blog_page_column ) {
               $output .='</div>';
            }
        break;
        case 'masonry':
            $blog_columns = ( $hcode_blog_page_column ) ? ' blog-'.$hcode_blog_page_column.'col' : '';
            $output .='<div class="blog-masonry'.$blog_columns.$infinite_scroll_main_class.'">';
                while ( have_posts() ) : the_post();
                    // Added in v1.8

                    $hcode_post_class_list = array();
                    if( $hcode_blog_page_enable_navigation == 1 ) {
                        if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination' ) {
                            $hcode_post_class_list[] = 'blog-single-post';
                        }
                    }
                    $hcode_post_classes = '';
                    ob_start();
                        post_class( $hcode_post_class_list );
                        $hcode_post_classes .= ob_get_contents();
                    ob_end_clean();
                    
                    $post_cat = array();
                    $categories = get_the_category();
                    foreach ($categories as $k => $cat) {
                        $cat_link = get_category_link($cat->cat_ID);
                        $post_cat[]='<a href="'.$cat_link.'" rel="category tag">'.$cat->name.'</a>';
                    }
                    $post_category=implode(", ",$post_cat);

                    $posted_by = array();
                    $hcode_show_posted_by = '';
                    if( $hcode_show_post_author == 1 ) {
                        $posted_by[] = esc_html__('Posted by ','H-Code'). '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span>';
                    }
                    if( $hcode_show_post_meta == 1 ) {
                        $posted_by[] = '<span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time>';
                    }
                    if( $hcode_show_category == 1 ) {
                        $posted_by[] = $post_category;
                    }
                    if( !empty( $posted_by ) ) {
                        $hcode_show_posted_by = implode(' | ', $posted_by);
                    }

                    $hcode_categories_list = $post_cat;
                    $show_like = ( $hcode_show_posts_like == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                    $output .= '<div '.$hcode_post_classes.'>';
                        $output .='<div class="'.$class_column.' blog-listing">';
                            $blog_quote = hcode_post_meta('hcode_quote');
                            $blog_image = hcode_post_meta('hcode_image');
                            $blog_gallery = hcode_post_meta('hcode_gallery');
                            $blog_link = hcode_post_meta('hcode_link');
                            $blog_video = hcode_post_meta('hcode_video_type');
                            if( $hcode_show_thumbnail == 1 ){
                                if( !empty( $blog_image ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post">';
                                    ob_start();
                                        get_template_part('loop/loop','image');
                                        $output .= ob_get_contents();  
                                        ob_end_clean();  
                                }
                                elseif( !empty( $blog_gallery ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post blog-post-gallery">';
                                    ob_start();
                                        get_template_part('loop/loop','gallery');
                                        $output .= ob_get_contents();  
                                    ob_end_clean();
                                }
                                elseif( !empty( $blog_video ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post blog-post-video">';
                                    ob_start();
                                        get_template_part('loop/loop','video');
                                        $output .= ob_get_contents();  
                                    ob_end_clean();  
                                }
                                elseif( !empty( $blog_quote ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post">';
                                    ob_start();
                                        get_template_part('loop/loop','quote');
                                        $output .= ob_get_contents();  
                                    ob_end_clean();  
                                }else{
                                    $output .='<div class="blog-post">';
                                    $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                    if ( has_post_thumbnail() ) {
                                        $output .= get_the_post_thumbnail( get_the_ID(), $hcode_blog_thumbnail_size );
                                    } elseif( !empty( $hcode_no_image['url'] ) ) {
                                        $output .= wp_get_attachment_image( $hcode_no_image['id'], $hcode_blog_thumbnail_size );
                                    }
                                    $output .='</a></div>';
                                }
                            }
                            $output .='<div class="blog-details">';
                                if( $hcode_show_posted_by ):
                                    $output .='<div class="blog-date">'.$hcode_show_posted_by.'</div>';
                                endif;
                                $output .='<div class="blog-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                                if($hcode_show_excerpt == 1):
                                    $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                                    $output .='<div class="blog-short-description entry-content">'.$show_excerpt.'</div>';
                                elseif($hcode_show_content == 1):
                                   $output .='<div class="blog-short-description entry-content">'.hcode_get_the_post_content().'</div>';
                                endif;
                                $output .='<div class="separator-line bg-black no-margin-lr"></div>';
                                $output .='<div>'.$show_like;
                                    if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                        ob_start();
                                            comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                            $output .= ob_get_contents();  
                                        ob_end_clean();
                                    }
                                $output .= '</div>';
                                if($hcode_show_button == 1){
                                    $output .='<a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                                }
                            $output .='</div>';
                            if( $hcode_show_thumbnail == 1 ){
                                $output .='</div>';
                            }
                        $output .='</div>';
                    $output .='</div>';
                endwhile;
                wp_reset_postdata();
            $output .='</div>';
            
            if( $hcode_blog_page_enable_navigation == 1 ) {
                if( $wp_query->max_num_pages > 1 ){

                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination'  ) {

                        $output .='<div class="pagination hcode-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                            ob_start();
                                if( get_next_posts_link() ) :
                                    next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right text-color"></i>' );
                                endif;
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                        $output .='</div>';

                    } else {
                        if( $wp_query->query_vars['paged'] > 1 ) {
                            $current = $wp_query->query_vars['paged'];
                        } else {
                            $current = 1;
                        }
                        $output .='<div class="pagination">';
                            $output .= paginate_links( array(
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
                        $output .='</div>';
                        
                    }
                }
            }

        break;
        case 'classic':
            $output .='<div class="blog-classic-layout'.$infinite_scroll_main_class.'">';
                while ( have_posts() ) : the_post();
                    // Added in v1.8
                    $hcode_post_class_list = array();
                    if( $hcode_blog_page_enable_navigation == 1 ) {
                        if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination' ) {
                            $hcode_post_class_list[] = 'blog-single-post';
                        }
                    }
                    $hcode_post_classes = '';
                    ob_start();
                        post_class( $hcode_post_class_list );
                        $hcode_post_classes .= ob_get_contents();
                    ob_end_clean();

                    $post_cat = array();
                    $categories = get_the_category();
                    foreach ($categories as $k => $cat) {
                        $cat_link = get_category_link($cat->cat_ID);
                        $post_cat[]='<a href="'.$cat_link.'">'.$cat->name.'</a>';
                    }
                    $post_category=implode(", ",$post_cat);

                    $posted_by = array();
                    $hcode_show_posted_by = '';
                    if( $hcode_show_post_author == 1 ) {
                        $posted_by[] = esc_html__('Posted by ','H-Code'). '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span>';
                    }
                    if( $hcode_show_post_meta == 1 ) {
                        $posted_by[] = '<span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time>';
                    }
                    if( $hcode_show_category == 1 ) {
                        $posted_by[] = $post_category;
                    }
                    if( !empty( $posted_by ) ) {
                        $hcode_show_posted_by = implode(' | ', $posted_by);
                    }

                    $show_like = ( $hcode_show_posts_like == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                    $output .= '<div '.$hcode_post_classes.'>';
                        $output .='<div class="blog-listing blog-listing-classic">';
                            $blog_quote = hcode_post_meta('hcode_quote');
                            $blog_image = hcode_post_meta('hcode_image');
                            $blog_gallery = hcode_post_meta('hcode_gallery');
                            $blog_link = hcode_post_meta('hcode_link');
                            $blog_video = hcode_post_meta('hcode_video_type');
                            if( $hcode_show_thumbnail == 1 ){
                                if( !empty( $blog_image ) && $hcode_show_feature_image != 1 ){
                                    ob_start();
                                        get_template_part('loop/loop','image');
                                        $output .= ob_get_contents();  
                                    ob_end_clean();  
                                }
                                elseif( !empty( $blog_gallery ) && $hcode_show_feature_image != 1 ){
                                    ob_start();
                                        get_template_part('loop/loop','gallery');
                                        $output .= ob_get_contents();  
                                    ob_end_clean();
                                }
                                elseif( !empty( $blog_video ) && $hcode_show_feature_image != 1 ){
                                    ob_start();
                                        get_template_part('loop/loop','video');
                                        $output .= ob_get_contents();  
                                        ob_end_clean();  
                                }
                                elseif( !empty( $blog_quote ) && $hcode_show_feature_image != 1 ){
                                    ob_start();
                                        get_template_part('loop/loop','quote');
                                        $output .= ob_get_contents();  
                                        ob_end_clean();  
                                }else{
                                    $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                    if ( has_post_thumbnail() ) {
                                        $output .= get_the_post_thumbnail( get_the_ID(), $hcode_blog_thumbnail_size );
                                    } elseif( !empty( $hcode_no_image['url'] ) ) {
                                        $output .= wp_get_attachment_image( $hcode_no_image['id'], $hcode_blog_thumbnail_size );
                                    }
                                    $output .='</a></div>';
                                }
                            }
                            $output .='<div class="blog-details">';
                                if( $hcode_show_posted_by ):
                                    $output .='<div class="blog-date">'.$hcode_show_posted_by.'</div>';
                                endif;
                                $output .='<div class="blog-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                                if($hcode_show_excerpt == 1):
                                    $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                                    $output .='<div class="margin-four-bottom entry-content">'.$show_excerpt.'</div>';
                                elseif($hcode_show_content == 1):
                                   $output .='<div class="margin-four-bottom entry-content">'.hcode_get_the_post_content().'</div>';
                                endif;
                                $output .='<div class="separator-line bg-black no-margin"></div>';
                                if( $hcode_show_comments == 1 ):
                                    $output .='<div class="margin-four-top">'.$show_like;
                                    if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                        ob_start();
                                            comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                            $output .= ob_get_contents();  
                                        ob_end_clean();
                                    }
                                    $output .= '</div>';
                                endif;
                                if($hcode_show_button == 1){
                                    $output .='<a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                                }
                            $output .='</div>';
                        $output .='</div>';
                    $output .='</div>';
                endwhile;
                wp_reset_postdata();
            $output .='</div>';
            if( $hcode_blog_page_enable_navigation == 1 ) {
                if( $wp_query->max_num_pages > 1 ){

                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination'  ) {

                        $output .='<div class="pagination hcode-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                            ob_start();
                                if( get_next_posts_link() ) :
                                    next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right text-color"></i>' );
                                endif;
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                        $output .='</div>';

                    } else {
                        if( $wp_query->query_vars['paged'] > 1 ) {
                            $current = $wp_query->query_vars['paged'];
                        } else {
                            $current = 1;
                        }
                        $output .='<div class="pagination">';
                            $output .= paginate_links( array(
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
                        $output .='</div>';
                        
                    }
                }
            }
        break;
        case 'modern':
            $i = 1;
            $default_posts_per_page = ( !empty($hcode_item_per_page) ) ? $hcode_item_per_page : get_option( 'posts_per_page' );
            if( $paged > 1){
                $i = ($paged - 1 ) * $default_posts_per_page + 1;
            }
            $output .='<div class="blog-modern-layout'.$infinite_scroll_main_class.'">';
                while ( have_posts() ) : the_post();
                    // Added in v1.8
                    $hcode_post_class_list = array();
                    if( $hcode_blog_page_enable_navigation == 1 ) {
                        if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination' ) {
                            $hcode_post_class_list[] = 'blog-single-post';
                        }
                    }
                    $hcode_post_classes = '';
                    ob_start();
                        post_class( $hcode_post_class_list );
                        $hcode_post_classes .= ob_get_contents();
                    ob_end_clean();

                    $post_cat = array();
                    $categories = get_the_category();
                    foreach ($categories as $k => $cat) {
                        $cat_link = get_category_link($cat->cat_ID);
                        $post_cat[]='<a href="'.$cat_link.'">'.$cat->name.'</a>';
                    }
                    $post_category=implode(", ",$post_cat);

                    if($i < 10){
                        $i = '0'.$i;
                    }
                    
                    $hcode_show_author = ( $hcode_show_post_author == 1 ) ? '<div class="blog-date-right light-gray-text2">'.esc_html__('Posted by ','H-Code'). '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span></div><div class="separator-line bg-black no-margin-lr no-margin xs-margin-ten-bottom"></div>' : '';
                    $show_date = ( $hcode_show_post_meta == 1 ) ? '<div class="blog-date-right light-gray-text2 no-padding-bottom"><span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time></div>' : '';
                    $show_like = ( $hcode_show_posts_like == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                    
                    $output .= '<div '.$hcode_post_classes.'>';
                        $output .= '<div class="blog-listing blog-listing-classic blog-listing-full">';
                            $output .='<div class="col-md-2 col-sm-2 col-xs-12 clearfix text-center no-padding-right xs-padding-right">';
                                $output .='<div class="avtar text-left xs-width-100px"><a href="'.esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ).'">';
                                        $output .= get_avatar( get_the_author_meta( 'ID' ), 300 );
                                        $output .='</a>';
                                $output .='</div>';
                               
                                $output .=$show_date;
                                $output .=$hcode_show_author;
                            $output .='</div>';
                            $output .='<div class="col-md-10 col-sm-10 col-xs-12 no-padding-left xs-padding-left">';
                            if( $hcode_show_number == 1 ){
                                $output .='<div class="blog-number bg-white black-text text-center alt-font">'.$i.'</div>';
                            }
                                $blog_quote = hcode_post_meta('hcode_quote');
                                $blog_image = hcode_post_meta('hcode_image');
                                $blog_gallery = hcode_post_meta('hcode_gallery');
                                $blog_link = hcode_post_meta('hcode_link');
                                $blog_video = hcode_post_meta('hcode_video_type');
                                if( $hcode_show_thumbnail == 1 ){
                                    if( !empty( $blog_image ) && $hcode_show_feature_image != 1 ){
                                        ob_start();
                                            get_template_part('loop/loop','image');
                                            $output .= ob_get_contents();  
                                            ob_end_clean();  
                                    }
                                    elseif( !empty( $blog_gallery ) && $hcode_show_feature_image != 1 ){
                                        ob_start();
                                            get_template_part('loop/loop','gallery');
                                            $output .= ob_get_contents();  
                                            ob_end_clean();  
                                    }
                                    elseif( !empty( $blog_video ) && $hcode_show_feature_image != 1 ){
                                        ob_start();
                                            get_template_part('loop/loop','video');
                                            $output .= ob_get_contents();  
                                            ob_end_clean();  
                                    }
                                    elseif( !empty( $blog_quote ) && $hcode_show_feature_image != 1 ){
                                        ob_start();
                                            get_template_part('loop/loop','quote');
                                            $output .= ob_get_contents();  
                                            ob_end_clean();  
                                    }else{
                                        $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                        if ( has_post_thumbnail() ) {
                                            $output .= get_the_post_thumbnail( get_the_ID(), $hcode_blog_thumbnail_size );
                                        } elseif( !empty( $hcode_no_image['url'] ) ) {
                                            $output .= wp_get_attachment_image( $hcode_no_image['id'], $hcode_blog_thumbnail_size );
                                        }
                                        $output .='</a></div>';
                                    }
                                }
                            $output .='<div class="blog-details">';
                                    if($hcode_show_category == 1):
                                        $output .='<div class="blog-date no-padding-top alt-font">'.$post_category.'</div>';
                                    endif;
                                    $output .='<div class="blog-title entry-title"><a class="alt-font" href="'.get_permalink().'">'.get_the_title().'</a></div>';
                                    if( $hcode_show_comments==1 ):
                                        $output .='<div>';
                                            $output .= $show_like;
                                            if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                                ob_start();
                                                    comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                                    $output .= ob_get_contents();  
                                                ob_end_clean();
                                            }
                                        $output .='</div>';
                                    endif;
                                    $output .='<div class="separator-line bg-black no-margin-lr margin-four"></div>';
                                    if($hcode_show_excerpt == 1):
                                        $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                                        $output .='<div class="entry-content">'.$show_excerpt.'</div>';
                                    elseif($hcode_show_content == 1):
                                       $output .='<div class="entry-content">'.hcode_get_the_post_content().'</div>';
                                    endif;
                                    if($hcode_show_button == 1){
                                         $output .='<a class="highlight-button-black-border btn btn-medium margin-five no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a>';
                                    }
                                $output .='</div>';
                            $output .='</div>';
                        $output .='</div>';
                    $output .='</div>';
                    $i++;
                endwhile;
                wp_reset_postdata();
            $output .='</div>';
            if( $hcode_blog_page_enable_navigation == 1 ) {
                if( $wp_query->max_num_pages > 1 ){

                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination'  ) {

                        $output .='<div class="pagination hcode-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                            ob_start();
                                if( get_next_posts_link() ) :
                                    next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right text-color"></i>' );
                                endif;
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                        $output .='</div>';

                    } else {
                        if( $wp_query->query_vars['paged'] > 1 ) {
                            $current = $wp_query->query_vars['paged'];
                        } else {
                            $current = 1;
                        }
                        $output .='<div class="pagination">';
                            $output .= paginate_links( array(
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
                        $output .='</div>';
                        
                    }
                }
            }
        break;
        case 'box':
            $blog_columns = ( $hcode_blog_page_column ) ? 'blog-'.$hcode_blog_page_column.'col' : '';
            $output .='<div class="blog-box-layout'.$infinite_scroll_main_class.'">';
                while ( have_posts() ) : the_post();
                    
                    // Added in v1.8
                    $hcode_post_class_list = array();
                    if( $hcode_blog_page_enable_navigation == 1 ) {
                        if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination' ) {
                            $hcode_post_class_list[] = 'blog-single-post';
                        }
                    }
                    $hcode_post_classes = '';
                    ob_start();
                        post_class( $hcode_post_class_list );
                        $hcode_post_classes .= ob_get_contents();
                    ob_end_clean();

                    $posted_by = array();
                    $hcode_show_posted_by = '';
                    if( $hcode_show_post_author == 1 ) {
                        $posted_by[] = '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span>';
                    }
                    if( $hcode_show_post_meta == 1 ) {
                        $posted_by[] = '<span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time>';
                    }
                    if( !empty( $posted_by ) ) {
                        $hcode_show_posted_by = implode(' | ', $posted_by);
                    }

                    $show_like = ( $hcode_show_posts_like == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                    $output .= '<div '.$hcode_post_classes.'>';
                        $output .= '<div class="'.$class_column.' latest-blogs margin-three-bottom sm-margin-bottom-four">';
                            $output .='<div class="blog-listing no-margin"><div class="blog-image">';
                                    if( $hcode_show_thumbnail == 1 ){                                       
                                        $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                        $url = $thumb['0'];
                                        $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= get_the_post_thumbnail( get_the_ID(), $hcode_blog_thumbnail_size );
                                            } elseif( !empty( $hcode_no_image['url'] ) ) {
                                                $output .= wp_get_attachment_image( $hcode_no_image['id'], $hcode_blog_thumbnail_size );
                                            }
                                        $output .='</a></div>';
                                    }
                                
                                    $output .='<div class="blog-content xs-text-center">
                                        <div class="slider-text-middle-main">
                                            <div class="slider-text-middle">';
                                                if( $hcode_show_posted_by ){
                                                    $output .='<span class="post-author">'.$hcode_show_posted_by.'</span>';
                                                }
                                                $output .='<a class="post-title entry-title" href="'.get_permalink().'">'.get_the_title().'</a>';
                                                if($hcode_show_excerpt == 1):
                                                    $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                                                    $output .='<div class="entry-content">'.$show_excerpt.'</div>';
                                                elseif($hcode_show_content == 1):
                                                    $show_content = apply_filters( 'the_content', $post->post_content );
                                                    $output .='<div class="entry-content">'.$show_content.'</div>';
                                                endif;

                                                if($hcode_show_posts_like == 1 || $hcode_show_comments == 1):
                                                    $output .='<div class="like-share">';
                                                        $output .= $show_like;
                                                        if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                                            ob_start();
                                                                comments_popup_link( __( '<i class="far fa-comment"></i>Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                                                $output .= ob_get_contents();  
                                                            ob_end_clean();
                                                        }
                                                    $output .='</div>';
                                                endif;
                                        $output .='</div>
                                        </div>
                                    </div>
                                </div>
                            </div>';
                        $output .= '</div>';
                    $output .= '</div>';
                endwhile;
                wp_reset_postdata();
            $output .= '</div>';
            if( $hcode_blog_page_enable_navigation == 1 ) {
                if( $wp_query->max_num_pages > 1 ){

                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination'  ) {

                        $output .='<div class="pagination hcode-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                            ob_start();
                                if( get_next_posts_link() ) :
                                    next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right text-color"></i>' );
                                endif;
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                        $output .='</div>';

                    } else {
                        if( $wp_query->query_vars['paged'] > 1 ) {
                            $current = $wp_query->query_vars['paged'];
                        } else {
                            $current = 1;
                        }
                        $output .='<div class="pagination">';
                            $output .= paginate_links( array(
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
                        $output .='</div>';
                        
                    }
                }
            }
        break;

        case 'list':
            if($infinite_scroll_main_class):
               $output .='<div class="'.$infinite_scroll_main_class.'">';
            endif;
        
            while ( have_posts() ) : the_post();

                // Added in H-Code v1.8
                $hcode_post_class_list = array();
                if( $hcode_blog_page_enable_navigation == 1 ) {
                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination' ) {
                        $hcode_post_class_list[] = 'blog-single-post';
                    }
                }

                $hcode_post_classes = '';
                ob_start();
                    post_class( $hcode_post_class_list );
                    $hcode_post_classes .= ob_get_contents();
                ob_end_clean();
                
                $post_cat = array();
                $categories = get_the_category();
                foreach ($categories as $k => $cat) {
                    $cat_link = get_category_link($cat->cat_ID);
                    $post_cat[]='<a href="'.$cat_link.'" rel="category tag">'.$cat->name.'</a>';
                }
                $post_category=implode(", ",$post_cat);

                $posted_by = array();
                $hcode_show_posted_by = '';
                if( $hcode_show_post_author == 1 ) {
                    $posted_by[] = esc_html__('Posted by ','H-Code'). '<span class="author vcard"><a class="url fn n" href='.get_author_posts_url( get_the_author_meta( 'ID' ) ).'>'.get_the_author().'</a></span>';
                }
                if( $hcode_show_post_meta == 1 ) {
                    $posted_by[] = '<span class="published">'.get_the_date( $hcode_date_format, get_the_ID()).'</span><time class="updated display-none" datetime="'.esc_attr( get_the_modified_date( 'c' ) ).'">'.get_the_modified_date( $hcode_date_format ).'</time>';
                }
                if( $hcode_show_category == 1 ) {
                    $posted_by[] = $post_category;
                }
                if( !empty( $posted_by ) ) {
                    $hcode_show_posted_by = implode(' | ', $posted_by);
                }

                $hcode_categories_list = $post_cat;
                $show_like = ( $hcode_show_posts_like == 1 ) ? get_simple_likes_button( get_the_ID() ) : '';
                $output .= '<div '.$hcode_post_classes.'>';
                    $output .='<div class="col-md-12 blog-listing blog-list-layout'.$layout_settings_class.'">';
                        $blog_quote = hcode_post_meta('hcode_quote');
                        $blog_image = hcode_post_meta('hcode_image');
                        $blog_gallery = hcode_post_meta('hcode_gallery');
                        $blog_video = hcode_post_meta('hcode_video_type');
                            if( $hcode_show_thumbnail == 1 ){    
                                if( !empty( $blog_image ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post">';
                                        $output .= '<div class="col-md-5 col-sm-6 col-xs-12 margin-six-bottom xs-margin-bottom-15px no-padding">';
                                            ob_start();
                                            get_template_part('loop/loop','image');
                                            $output .= ob_get_contents();  
                                            ob_end_clean();  
                                        $output .='</div>';
                                }
                                elseif( !empty( $blog_gallery ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post blog-post-gallery">';
                                        $output .= '<div class="col-md-5 col-sm-6 col-xs-12 margin-six-bottom xs-margin-bottom-15px no-padding">';
                                            ob_start();
                                                get_template_part('loop/loop','gallery');
                                                $output .= ob_get_contents();  
                                            ob_end_clean();
                                        $output .='</div>';
                                }
                                elseif( !empty( $blog_video ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post blog-post-video">';
                                        $output .= '<div class="col-md-5 col-sm-6 col-xs-12 margin-six-bottom xs-margin-bottom-15px no-padding">';
                                            ob_start();
                                                get_template_part('loop/loop','video');
                                                $output .= ob_get_contents();  
                                            ob_end_clean();
                                        $output .='</div>';  
                                }
                                elseif( !empty( $blog_quote ) && $hcode_show_feature_image != 1 ){
                                    $output .='<div class="blog-post">';
                                        $output .= '<div class="col-md-5 col-sm-6 col-xs-12 margin-six-bottom xs-margin-bottom-15px no-padding">';
                                            ob_start();
                                                get_template_part('loop/loop','quote');
                                                $output .= ob_get_contents();  
                                            ob_end_clean();
                                        $output .='</div>';
                                }else{
                                    $output .='<div class="blog-post">';
                                        $output .= '<div class="col-md-5 col-sm-6 col-xs-12 margin-six-bottom xs-margin-bottom-15px no-padding">';
                                            $output .='<div class="blog-image"><a href="'.get_permalink().'">';
                                            if ( has_post_thumbnail() ) {
                                                $output .= get_the_post_thumbnail( get_the_ID(), $hcode_blog_thumbnail_size );
                                            } elseif( !empty( $hcode_no_image['url'] ) ) {
                                                $output .= wp_get_attachment_image( $hcode_no_image['id'], $hcode_blog_thumbnail_size );
                                            }
                                            $output .='</a></div>';
                                        $output .='</div>';
                                }
                            }
                            $output .='<div class="blog-details col-md-7 col-sm-6 col-xs-12 margin-six-bottom xs-margin-bottom-35px">';
                                $output .='<div class="blog-title entry-title"><a href="'.get_permalink().'">'.get_the_title().'</a></div>';
                                if( $hcode_show_posted_by ):
                                    $output .='<div class="blog-date margin-five-bottom">'.$hcode_show_posted_by.'</div>';
                                endif;
                                if($hcode_show_excerpt == 1):
                                    $show_excerpt = ( $hcode_show_excerpt == 1 ) ? wpautop(hcode_get_the_excerpt_theme($hcode_excerpt_length)) : '';
                                    $output .='<div class="blog-short-description entry-content">'.$show_excerpt.'</div>';
                                elseif($hcode_show_content == 1):
                                   $output .='<div class="blog-short-description entry-content">'.hcode_get_the_post_content().'</div>';
                                endif;
                                $output .= '<div class="hcode-custom-meta margin-three-top sm-margin-six-top xs-no-margin-top">';
                                    if($hcode_show_button == 1){
                                        $output .='<div class="hcode-continue-button"><a class="highlight-button btn btn-small xs-no-margin-bottom" href="'.get_permalink().'">'.$hcode_button_text.'</a></div>';
                                    }
                                    $output .='<div class="hcode-show-likes">'.$show_like;
                                        if( $hcode_show_comments == 1 && (comments_open() || get_comments_number())){
                                            ob_start();
                                                comments_popup_link( __( '<i class="far fa-comment"></i>Leave a comment', 'H-Code' ), __( '<i class="far fa-comment"></i>1 Comment', 'H-Code' ), __( '<i class="far fa-comment"></i>% Comment(s)', 'H-Code' ), 'comment' );
                                                $output .= ob_get_contents();  
                                            ob_end_clean();
                                        }
                                    $output .= '</div>';
                                $output .='</div>';    
                            $output .='</div>';
                        if( $hcode_show_thumbnail == 1 ){
                            $output .='</div>';
                        }
                    $output .='</div>';
                    $output .= '<div class="col-md-12 col-sm-12 col-xs-12 margin-six-bottom xs-display-none"><div class="separator-line-thin bg-mid-gray"></div></div>';
                $output .='</div>';
            endwhile;
            wp_reset_postdata();
            if( $hcode_blog_page_enable_navigation == 1 ) {
                if( $wp_query->max_num_pages > 1 ){

                    if( $hcode_blog_page_navigation_style == 'infinite-scroll-pagination'  ) {

                        $output .='<div class="pagination hcode-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                            ob_start();
                                if( get_next_posts_link() ) :
                                    next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right text-color"></i>' );
                                endif;
                            $output .= ob_get_contents();  
                            ob_end_clean();  
                        $output .='</div>';

                    } else {
                        if( $wp_query->query_vars['paged'] > 1 ) {
                            $current = $wp_query->query_vars['paged'];
                        } else {
                            $current = 1;
                        }
                        $output .='<div class="pagination">';
                            $output .= paginate_links( array(
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
                        $output .='</div>';
                        
                    }
                }
            }
            if($infinite_scroll_main_class):
               $output .='</div>';
            endif;
        break;
    }
}else{
    get_template_part('templates/content','none');
}
echo sprintf( __('%s','H-Code'),$output);