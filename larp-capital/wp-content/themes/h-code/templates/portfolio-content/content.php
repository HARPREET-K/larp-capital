<?php
/**
 * displaying content for portfolio category, tag page
 *
 * @package H-Code
 */
?>
<?php
global $hcode_featured_array;
$output = $no_padding = $classes = $container_class = '';  
$hcode_options = get_option( 'hcode_theme_setting' );
$hcode_portfolio_style = (isset($hcode_options['hcode_portfolio_cat_layout_settings'])) ? $hcode_options['hcode_portfolio_cat_layout_settings'] : '';
$hcode_columns_settings = (isset($hcode_options['hcode_portfolio_cat_columns_settings'])) ? $hcode_options['hcode_portfolio_cat_columns_settings'] : '';
$hcode_hover_opacity = (isset($hcode_options['hcode_portfolio_cat_hover_opacity'])) ? $hcode_featured_array[] = '.portfolio-archive-page figure:hover img{ opacity: '.$hcode_options['hcode_portfolio_cat_hover_opacity'].'}' : '';

$hcode_show_infinite_pagination = (isset($hcode_options['hcode_portfolio_cat_enable_infinite_pagination'])) ? $hcode_options['hcode_portfolio_cat_enable_infinite_pagination'] : '';

// no image
$hcode_no_image = (isset($hcode_options['hcode_no_image'])) ? $hcode_options['hcode_no_image'] : '';
switch ($hcode_portfolio_style) {
    case 'grid':
            $classes .= '';
            $container_class .= 'container';
            $no_padding .= '';
            break;
    case 'grid-gutter':
             $classes .= ' gutter';
             $container_class .= 'container';
             $no_padding .= '';
             break;
    case 'grid-with-title':
             $classes .= ' gutter work-with-title';
             $container_class .= 'container';
             $no_padding .= '';
             break;
    case 'wide':
            $classes .= ' wide';
            $container_class .= ' container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
    case 'wide-gutter':
            $classes .= ' gutter wide';
            $container_class .= 'container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
    case 'wide-with-title':
            $classes .= ' gutter work-with-title wide wide-title';
            $container_class .= 'container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
    case 'masonry':
            $classes .= ' masonry wide';
            $container_class .= 'container-fluid position-relative';
            $no_padding .= ' no-padding';
            break;
}
$portfolio_columns = ( $hcode_columns_settings ) ? 'work-'.$hcode_columns_settings.'col' : '';

if( is_tax( 'portfolio-category' ) || is_tax( 'portfolio-tags' ) ) {
    the_archive_description( '<div class="archive-description text-med col-md-12'.$no_padding.'">', '</div>' ); 
}

if( have_posts() ):
    if($hcode_columns_settings || $no_padding || $classes):
        echo '<div class="'.$portfolio_columns.$classes.'">';
    endif;
    echo '<div class="col-md-12 grid-gallery overflow-hidden content-section'.$no_padding.'">';
        echo '<div class="tab-content portfolio-infinite-scroll-pagination">';
            echo '<ul class="grid masonry-items">';
        while ( have_posts() ) : the_post();
            $hcode_post_classes = '';
            ob_start();
                post_class();
                $hcode_post_classes .= ob_get_contents();
            ob_end_clean();
            echo '<li '.$hcode_post_classes.'>';
                echo '<figure>';
                    $portfolio_image = hcode_post_meta('hcode_image');
                    $portfolio_gallery = hcode_post_meta('hcode_gallery');
                    $portfolio_link = hcode_post_meta('hcode_link_type');
                    $portfolio_video = hcode_post_meta('hcode_video');
                    $portfolio_subtitle = hcode_post_meta('hcode_subtitle');
                    if( !empty( $portfolio_image ) ) {
                        if ( has_post_thumbnail( get_the_ID() ) ) {
                            echo '<div class="gallery-img">';
                                echo '<a href="'.get_permalink().'">';
                                    echo get_the_post_thumbnail( get_the_ID(), 'full' );
                                echo '</a>';
                            echo '</div>';
                        } elseif( !empty( $hcode_no_image['url'] ) ) {
                            $no_image_id = $hcode_no_image['id'];

                            echo '<div class="gallery-img">';
                                echo '<a href="'.get_permalink().'">';
                                    echo wp_get_attachment_image( $no_image_id, 'full' );
                                echo '</a>';
                            echo '</div>';
                        }
                       
                        echo '<figcaption>';
                            echo '<h3 class="entry-title portfolio-archive-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                            echo '<p class="portfolio-archive-subtitle">'.$portfolio_subtitle.'</p>';
                        echo '</figcaption>';

                    } elseif( !empty( $portfolio_gallery ) ) {

                        $portfolio_gallery = hcode_post_meta( 'hcode_gallery' );
                        $gallery = explode( ",", $portfolio_gallery );
                        $i = 1;
                        $image = '';
                        if( is_array( $gallery ) ) {
                            foreach ( $gallery as $k => $value ) {
                                $thumb_gallery = wp_get_attachment_image_src( $value, 'full' );
                                if( $i == 1 ) {
                                    $thumb = wp_get_attachment_image_src( get_post_thumbnail_id(get_the_ID()), 'full' );
                                    if ( isset( $thumb['0'] ) ) {
                                        $url = $thumb['0'];
                                    } else {
                                        $url = '';
                                    }
                                    if ( has_post_thumbnail( get_the_ID() ) ) {
                                        $image .='<a href="'.$url.'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                            $image .= get_the_post_thumbnail( get_the_ID(), 'full' );
                                        $image .= '</a>';
                                        $image .= '<a href="'.$thumb_gallery[0].'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general"></a>';
                                    } else {
                                        $image .= '<a href="'.$thumb_gallery[0].'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general">';
                                            $image .= wp_get_attachment_image( $value, 'full' );
                                        $image .= '</a>';
                                    }
                                } else {
                                    $image .= '<a href="'.$thumb_gallery[0].'" title="'.get_the_title().'" class="lightboxgalleryitem" data-group="general"></a>';
                                }
                                $i++;
                            }
                        } elseif( !empty( $hcode_no_image['url'] ) ) {
                            $no_image_id = $hcode_no_image['id'];
                            echo wp_get_attachment_image( $no_image_id, 'full' );
                        }
                        echo '<div class="gallery-img lightbox-gallery">'.$image.'</div>';

                        echo '<figcaption>';
                            echo '<h3 class="entry-title portfolio-archive-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                            echo '<p class="portfolio-archive-subtitle">'.$portfolio_subtitle.'</p>';
                        echo '</figcaption>';

                    } elseif( !empty( $portfolio_video ) ) {

                        $video_url = hcode_post_meta( 'hcode_video' );
                        $show_lightbox_popup = hcode_post_meta( 'hcode_show_lightbox_popup' );
                        echo '<div class="gallery-img">';
                            if( $video_url && $show_lightbox_popup != 'no' ){
                                echo '<a class="popup-vimeo" href="'.$video_url.'">';
                            } else {
                                echo '<a class="no-popup-vimeo" href="'.get_permalink().'">';
                            }
                            
                            if( has_post_thumbnail( get_the_ID() ) ) {
                                echo get_the_post_thumbnail( get_the_ID(), 'full' );
                            } elseif( !empty( $hcode_no_image['url'] ) ) {
                                $no_image_id = $hcode_no_image['id'];
                                echo wp_get_attachment_image( $no_image_id, 'full' );
                            }
                        echo '</a></div>';

                        echo '<figcaption>';
                            echo '<h3 class="entry-title portfolio-archive-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                            echo '<p class="portfolio-archive-subtitle">'.$portfolio_subtitle.'</p>';
                        echo '</figcaption>'; 
                    } elseif( !empty( $portfolio_link ) ) {
                        $link_url = hcode_post_meta( 'hcode_link' );
                        $link_type = hcode_post_meta( 'hcode_link_type' );
                        $ajax_popup_class = $link = $icon = '';

                        switch ($link_type) {

                            case 'external':
                                $link .= $link_url;
                                $icon .= 'class="icon-attachment"';
                                break;

                            case 'ajax-popup':
                                $ajax_popup_class .= 'class="simple-ajax-popup-align-top"';
                                $link .= $link_url;
                                $icon .= 'class="icon-browser"';
                                break;
                        }
                        echo '<div class="gallery-img">';
                                echo '<a href="'.$link.'" '.$ajax_popup_class.'>';
                                if( has_post_thumbnail() ) {
                                    echo get_the_post_thumbnail( get_the_ID(), 'full' );
                                } elseif( !empty( $hcode_no_image['url'] ) ) {
                                    $no_image_id = $hcode_no_image['id'];
                                    echo wp_get_attachment_image( $no_image_id, 'full' );
                                }
                            echo '</a>';
                        echo '</div>';

                        echo '<figcaption>';
                            echo '<h3 class="entry-title portfolio-archive-title"><a href="'.$link_url.'">'.get_the_title().'</a></h3>';
                            echo '<p class="portfolio-archive-subtitle">'.$portfolio_subtitle.'</p>';
                        echo '</figcaption>';
                    }else{
                        if( has_post_thumbnail() ) {
                            echo '<div class="gallery-img">';
                                echo '<a href="'.get_permalink().'">';
                                    echo get_the_post_thumbnail( get_the_ID(), 'full' );
                                echo '</a>';
                            echo '</div>';
                        } elseif( !empty( $hcode_no_image['url'] ) ) {
                            $no_image_id = $hcode_no_image['id'];
                            echo '<div class="gallery-img">';
                                echo '<a href="'.get_permalink().'">';
                                    echo wp_get_attachment_image( $no_image_id, 'full' );
                                echo '</a>';
                            echo '</div>';
                        }
                        echo '<figcaption>';
                            echo '<h3 class="entry-title portfolio-archive-title"><a href="'.get_permalink().'">'.get_the_title().'</a></h3>';
                            echo '<p class="portfolio-archive-subtitle">'.$portfolio_subtitle.'</p>';
                        echo '</figcaption>';
                    }
                echo '</figure>';
            echo '</li>';
        endwhile;
            echo '</ul>';
            if($wp_query->max_num_pages > 1 && $hcode_show_infinite_pagination == 1 ){
                echo '<div class="pagination hcode-portfolio-infinite-scroll display-none" data-pagination="'.$wp_query->max_num_pages.'">';
                        ob_start();
                            if( get_next_posts_link( '', $wp_query->max_num_pages ) ) :
                                next_posts_link( '<span class="old-post">'.esc_html__( 'Older Post', 'H-Code' ).'</span><i class="fas fa-long-arrow-alt-right"></i>', $wp_query->max_num_pages );
                            endif;
                        echo ob_get_contents();  
                        ob_end_clean();  
                    echo '</div>';
            }elseif( $wp_query->max_num_pages > 1 ){
                echo '<div class="pagination">';
                        echo paginate_links( array(
                            'base'         => esc_url_raw( str_replace( 999999999, '%#%', remove_query_arg( 'add-to-cart', get_pagenum_link( 999999999, false ) ) ) ),
                            'format'       => '',
                            'add_args'     => '',
                            'current'      => max( 1, get_query_var( 'paged' ) ),
                            'total'        => $wp_query->max_num_pages,
                            'prev_text'    => '<img alt="Previous" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-small.png" width="20" height="13">',
                            'next_text'    => '<img alt="Next" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-small.png" width="20" height="13">',
                            'type'         => 'plain',
                            'end_size'     => 3,
                            'mid_size'     => 3
                        ) );
                echo '</div>';
            }
        echo '</div>';
    echo '</div>';

    if($hcode_columns_settings):
        echo '</div>';
    endif;
    
else:
    get_template_part('templates/content','none');
endif;