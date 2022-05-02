<?php
/**
 * displaying content for single portfolio post
 *
 * @package H-Code
 */
?>
<?php
$output = '';
$portfolio_image = hcode_post_meta('hcode_image');
$portfolio_gallery = hcode_post_meta('hcode_gallery');
$portfolio_video = hcode_post_meta('hcode_video');
$portfolio_link = hcode_post_meta('hcode_link_type');

$hcode_options = get_option('hcode_theme_setting');
$layout_settings = (isset($hcode_options['hcode_layout_settings_portfolio'])) ? $hcode_options['hcode_layout_settings_portfolio'] : '';

$enable_featured_image = (isset($hcode_options['hcode_enable_featured_image_portfolio'])) ? $hcode_options['hcode_enable_featured_image_portfolio'] : '';

if( empty($layout_settings)){
    $layout_settings = hcode_option('hcode_layout_settings');
}else{
    $layout_settings = hcode_option_portfolio('hcode_layout_settings');
}

$section_class_start = $section_class_end = $portfolio_title = $portfolio_meta = $portfolio_meta_start = $portfolio_meta_end = $portfolio_meta_category_start = $portfolio_meta_category_end = '';


switch ($layout_settings) {
    case 'hcode_layout_full_screen':
        $section_class_start .= '<section class="no-padding-bottom"><div class="container"><div class="row"><div class="col-md-12">';
        $section_class_end .= '</div></div></div></section>';
        
        $portfolio_meta_category_start = '<section class="padding-top-40px padding-bottom-30px"><div class="container"><div class="row"><div class="col-md-12 col-sm-12 text-center">';
        $portfolio_meta_category_end .= '</div></div></div></section>';

        $portfolio_meta_start .= '<div class="col-md-12 col-sm-12 col-xs-12 margin-five-bottom sm-margin-eight-bottom xs-margin-five-bottom">';
        $portfolio_meta_end .= '</div>';
        break;
    case 'hcode_layout_both_sidebar':
        $section_class_start .= '<section class="no-padding"><div class="container"><div class="row">';
        $section_class_end .= '</div></div></section>';
        
        $portfolio_meta_category_start .= '<section class="padding-top-40px padding-bottom-30px clear-both"><div class="container"><div class="row"><div class="col-md-12 col-sm-12 text-center no-padding">';
        $portfolio_meta_category_end .= '</div></div></div></section>';
        break;

    case 'hcode_layout_left_sidebar':
    case 'hcode_layout_right_sidebar':
        $section_class_start .= '<section class="no-padding"><div class="container"><div class="row">';
        $section_class_end .= '</div></div></section>';
        $portfolio_meta_category_start .= '<section class="padding-top-40px padding-bottom-30px clear-both"><div class="container"><div class="row"><div class="col-md-12 col-sm-12 text-center no-padding">';
        $portfolio_meta_category_end .= '</div></div></div></section>';
        break;
}
if (!empty($portfolio_gallery)) {
    ob_start();
    echo sprintf( __('%s','H-Code'),$section_class_start);
    echo sprintf( __('%s','H-Code'),$portfolio_title);
    get_template_part('loop/single-portfolio/portfolio', 'gallery');
    echo sprintf( __('%s','H-Code'),$section_class_end);
    $output .= ob_get_contents();
    ob_end_clean();
}elseif (!empty($portfolio_video)) {
    ob_start();
    echo sprintf( __('%s','H-Code'),$section_class_start);
    echo sprintf( __('%s','H-Code'),$portfolio_title);
    get_template_part('loop/single-portfolio/portfolio', 'video');
    echo sprintf( __('%s','H-Code'),$section_class_end);
    $output .= ob_get_contents();
    ob_end_clean();
}elseif (!empty($portfolio_image)) {
    ob_start();
    if($portfolio_image == 1){
        echo sprintf( __('%s','H-Code'),$section_class_start);
        echo sprintf( __('%s','H-Code'),$portfolio_title);
        get_template_part('loop/single-portfolio/portfolio', 'image');
        echo sprintf( __('%s','H-Code'),$section_class_end);
    }
    $output .= ob_get_contents();
    ob_end_clean();
} else {

    if( has_post_thumbnail( get_the_ID() ) ) {
        $output .= $section_class_start;
        $output .= $portfolio_title;
        if( $enable_featured_image == 1 ){
            $output .= '<div class="gallery-img margin-bottom-30px">';
                $output .= get_the_post_thumbnail( get_the_ID(), 'full' );
            $output .= '</div>';
        }
        $output .= $section_class_end;
    }
}
echo sprintf( __('%s','H-Code'),$output);
?>
<div class="blog-details-text portfolio-single-content">
<div class="entry-content">
    <?php the_content(); ?>
</div>
   
    <?php
    $hcode_enable_meta_author_portfolio = hcode_option('hcode_enable_meta_author_portfolio');
    $hcode_enable_meta_date_portfolio = hcode_option('hcode_enable_meta_date_portfolio');
    $hcode_enable_meta_category_portfolio = hcode_option('hcode_enable_meta_category_portfolio');

    if( $hcode_enable_meta_author_portfolio == 1 || $hcode_enable_meta_date_portfolio == 1 || $hcode_enable_meta_category_portfolio == 1){
        echo sprintf( __('%s','H-Code'),$portfolio_meta_category_start);
            echo '<div class="blog-date no-padding-top">' . hcode_single_portfolio_meta() . '</div>'; 
        echo sprintf( __('%s','H-Code'),$portfolio_meta_category_end);
    }
    ?>
</div>
<section class="no-padding">
    <div class="container">
        <div class="row">
            <?php
            $hcode_enable_tags = hcode_option('hcode_enable_meta_tags_portfolio');
            $enable_post_author = hcode_option('hcode_enable_post_author_portfolio');
            $enable_social_icons = hcode_option('hcode_social_icons_portfolio');
            $hcode_enable_portfolio_comment = hcode_option('hcode_enable_portfolio_comment');

            if ($hcode_enable_tags == 1 || $enable_post_author == 1 || $enable_social_icons == 1 || $hcode_enable_portfolio_comment == 1):
            ?>

            <?php
                echo sprintf( __('%s','H-Code'),$portfolio_meta_start);

                    if( $hcode_enable_tags == 1 ) {
                            hcode_single_portfolio_meta_tag();
                    }
                    
                    if( $enable_post_author == 1 ) {
                        // Author bio.
                        if( get_the_author_meta( 'description' ) ) {
                            get_template_part( 'author-bio' );
                        }
                    }

                    if( $enable_social_icons == 1 && function_exists( 'hcode_single_post_share_shortcode' ) ) {
                        echo do_shortcode( '[hcode_single_post_share]' );
                    }
                    
                    if( $hcode_enable_portfolio_comment == 1 ) {
                        // If comments are open or we have at least one comment, load up the comment template
                        if( comments_open() || get_comments_number() ) {
                            comments_template();
                        }
                    }
                echo sprintf( __('%s','H-Code'),$portfolio_meta_end);
            endif;
        ?>
        </div>
    </div>
</section>