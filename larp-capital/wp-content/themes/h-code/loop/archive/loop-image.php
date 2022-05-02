<?php
/**
 * displaying posts featured image for archive
 *
 * @package H-Code
 */
?>
<?php
global $hcode_archive_page_thumbnail_size;

echo '<div class="blog-image"><a href="'.get_permalink().'">';
    if ( has_post_thumbnail() ) {
        echo get_the_post_thumbnail( get_the_ID(), $hcode_archive_page_thumbnail_size );
    }elseif( !empty( $hcode_no_image['url'] ) ) {
    	echo wp_get_attachment_image( $hcode_no_image['id'], $hcode_archive_page_thumbnail_size );
    }
echo '</a></div>';