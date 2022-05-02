<?php
/**
 * The template for displaying Author bios
 *
 * @package H-Code
 */
?>
<?php
    $layout_settings_inner = hcode_option( 'hcode_layout_settings' );
    $hcode_options = get_option( 'hcode_theme_setting' );

    if( 'default' === $layout_settings_inner ) {
        $layout_settings = ( isset( $hcode_options['hcode_layout_settings'] ) ) ? $hcode_options['hcode_layout_settings'] : '';
        $enable_container_fluid = ( isset( $hcode_options['hcode_enable_container_fluid'] ) ) ? $hcode_options['hcode_enable_container_fluid'] : '';
    } else {
        $layout_settings = $layout_settings_inner;
        $enable_container_fluid = hcode_option( 'hcode_enable_container_fluid' );
    }
?>
<div class="text-center about-author text-left bg-gray<?php echo ( 'hcode_layout_full_screen' === $layout_settings ) ? ' margin-five-top' : ' margin-ten-top';?>">
    <div class="blog-comment text-left clearfix no-margin">
        <a class="comment-avtar no-margin-top" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
            <?php echo get_avatar( get_the_author_meta( 'user_email' ), 300 ); ?>
        </a>
        <div class="comment-text overflow-hidden position-relative">
            <h5 class="widget-title"><?php esc_html_e( 'About The Author', 'H-Code' ); ?></h5>
            <p class="blog-date no-padding-top">
                <span class="author vcard">
                    <a class="url fn n" href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
                        <?php echo get_the_author(); ?>
                    </a>
                </span>
            </p>
            <p class="about-author-text no-margin"><?php the_author_meta( 'description' ); ?></p>
        </div>
    </div>
</div>