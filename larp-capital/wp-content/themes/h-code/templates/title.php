<?php
/**
 * displaying title for pages or posts
 *
 * @package H-Code
 */
?>
<?php

if( class_exists( 'WooCommerce' ) && is_product() ) {
    
        // Product page title section start

        $show_product_breadcrumb = hcode_option('enable_product_breadcrumb');
        $show_product_next_prev_button = hcode_option('enable_product_next_prev_button');
    ?>
    <?php if( $show_product_breadcrumb || $show_product_next_prev_button ): 

        $top_header_class = '';

        $hcode_enable_mini_header = hcode_option( 'hcode_enable_mini_header' );
        $hcode_enable_mini_header_mobile = hcode_option( 'hcode_enable_mini_header_mobile' );
        
        $hcode_options = get_option( 'hcode_theme_setting' );
        $hcode_enable_header = (isset($hcode_options['hcode_enable_header_woocommerce'])) ? $hcode_options['hcode_enable_header_woocommerce'] : '';
        $hcode_header_layout = (isset($hcode_options['hcode_header_layout_woocommerce'])) ? $hcode_options['hcode_header_layout_woocommerce'] : '';
           
        if($hcode_enable_header == 1 && $hcode_header_layout != 'headertype9') {
            
            $header_logo_position = hcode_option( 'hcode_header_logo_position_woocommerce' );
            if( hcode_check_enable_mini_header() ) {
                if( $header_logo_position == 'top' && $hcode_header_layout != 'headertype9' && $hcode_header_layout != 'headertype10' && $hcode_header_layout != 'headertype11' ) {
                    $top_header_class .= 'content-top-margin-extra-big';
                } else {
                    $top_header_class .= 'content-top-margin-big';
                }
            } else if( $hcode_header_layout != 'headertype8' ) {
                if( $header_logo_position == 'top' && $hcode_header_layout != 'headertype9' && $hcode_header_layout != 'headertype10' && $hcode_header_layout != 'headertype11' ) {
                    $top_header_class .= 'content-top-margin-midium-big';
                } else {
                    $top_header_class .= 'content-top-margin';
                }
            }
        }
        else if($hcode_enable_header == 1 && hcode_check_enable_mini_header() && $hcode_header_layout == 'headertype9')
        {
            $top_header_class .= 'content-mini-header-margin';
        }

        if( $hcode_enable_mini_header == 1 && $hcode_enable_mini_header_mobile == 1 )
        {
            $top_header_class .= ' mobile-mini-header-visible';
        }
    
    ?>
        <section class="<?php echo esc_attr($top_header_class); ?> page-title-section page-title page-title-small border-bottom-light border-top-light">
            <div class="container">
                <div class="row">
                    <?php if( $show_product_breadcrumb ): ?>
                        <div data-wow-duration="600ms" class="col-md-8 col-sm-7 breadcrumb text-uppercase wow fadeInUp xs-display-none">
                            <!-- breadcrumb -->
                            <ul>
                            <?php  do_action('hcode_woocommerce_breadcrumb');?>
                            </ul>
                            <!-- end breadcrumb -->
                        </div>
                    <?php endif; ?>
                    <?php if( $show_product_next_prev_button ): ?>
                        <div data-wow-duration="300ms" class="col-md-4 col-sm-5 wow fadeInUp header-nav text-right sm-margin-top-two pull-right">
                            <!-- next/previous -->
                            <?php hcode_woocommerce_next_prev();?>
                            <!-- end next/previous -->
                        </div>
                    <?php endif;?>
                </div>
            </div>
        </section>

    <?php endif;?>

<?php

} else {

    hcode_get_title_part_for_archive();
}

?>