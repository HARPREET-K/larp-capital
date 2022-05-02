<?php
/**
 * displaying footer wrapper section
 *
 * @package H-Code
 */
?>
<?php
$hcode_options = get_option( 'hcode_theme_setting' );
$enable_footer_wrapper = hcode_option('hcode_enable_footer_wrapper');

$enable_phone_number 	= hcode_option('hcode_footer_wrapper_enable_phone_number');
$custom_phone_icon 		= ( isset($hcode_options['hcode_footer_wrapper_custom_phone_icon'])) ? $hcode_options['hcode_footer_wrapper_custom_phone_icon'] : '';
$phone_icon 			= ( isset($hcode_options['hcode_footer_wrapper_phone_icon'])) ? $hcode_options['hcode_footer_wrapper_phone_icon'] : '';
$custom_phone_icon_image= ( isset($hcode_options['hcode_footer_wrapper_custom_phone_icon_image']['url'])) ? $hcode_options['hcode_footer_wrapper_custom_phone_icon_image']['url'] : '';
$phone_text 			= ( isset($hcode_options['hcode_footer_wrapper_phone_text'])) ? $hcode_options['hcode_footer_wrapper_phone_text'] : '';

$enable_map 			= hcode_option('hcode_footer_wrapper_enable_map');
$custom_map_icon 		= ( isset($hcode_options['hcode_footer_wrapper_custom_map_icon'])) ? $hcode_options['hcode_footer_wrapper_custom_map_icon'] : '';
$map_icon 				= ( isset($hcode_options['hcode_footer_map_icon'])) ? $hcode_options['hcode_footer_map_icon'] : '';
$custom_map_icon_image 	= ( isset($hcode_options['hcode_footer_wrapper_custom_map_icon_image']['url'])) ? $hcode_options['hcode_footer_wrapper_custom_map_icon_image']['url'] : '';
$map_text 				= ( isset($hcode_options['hcode_footer_wrapper_map_text'])) ? $hcode_options['hcode_footer_wrapper_map_text'] : '';

$enable_email 			= hcode_option('hcode_footer_wrapper_enable_email');
$custom_email_icon 		= ( isset($hcode_options['hcode_footer_wrapper_custom_email_icon'])) ? $hcode_options['hcode_footer_wrapper_custom_email_icon'] : '';
$email_icon 			= ( isset($hcode_options['hcode_footer_wrapper_email_icon'])) ? $hcode_options['hcode_footer_wrapper_email_icon'] : '';
$custom_email_icon_image= ( isset($hcode_options['hcode_footer_wrapper_custom_email_icon_image']['url'])) ? $hcode_options['hcode_footer_wrapper_custom_email_icon_image']['url'] : '';
$email_text				= ( isset($hcode_options['hcode_footer_wrapper_email_id'])) ? $hcode_options['hcode_footer_wrapper_email_id'] : '';

$output='';
if( $enable_footer_wrapper == 1 && ( $enable_phone_number == 1 || $enable_map == 1 || $enable_email == 1 ) ){
	
	$col_counter = 0;
	$col_counter = $enable_phone_number == 1 ? ++$col_counter : $col_counter;
	$col_counter = $enable_map == 1 ? ++$col_counter : $col_counter;
	$col_counter = $enable_email == 1 ? ++$col_counter : $col_counter;

	$col_size	 = 12 / $col_counter;

	echo '<div class="bg-white footer-top hcode-footer-wrapper">';
		echo '<div class="container">';
		    echo '<div class="row margin-four">';
		    	if( $enable_phone_number == 1 ) {
			        echo '<div class="col-md-' . $col_size . ' col-sm-' . $col_size . ' text-center">';
			        	if( $custom_phone_icon == 1 && !empty( $custom_phone_icon_image ) ) {
			        		$image_id = $hcode_options['hcode_footer_wrapper_custom_phone_icon_image']['id'];
			        		echo wp_get_attachment_image( $image_id, 'full' );

			        	} elseif( empty( $custom_phone_icon ) && !empty( $phone_icon ) ) {
					        echo '<i class="'.$phone_icon.' footer-wrapper-small-icon black-text"></i>';
					    }
					    if( !empty( $phone_text ) ) {
					        echo '<h6 class="black-text margin-two no-margin-bottom">';
					       		echo do_shortcode( nl2br( $phone_text ) );
					        echo '</h6>';
					    }
			        echo '</div>';
		    	}
		    	if( $enable_map == 1 ) {
			        echo '<div class="col-md-' . $col_size . ' col-sm-' . $col_size . ' text-center">';
			        	if( $custom_map_icon == 1 && !empty( $custom_map_icon_image ) ) {
			        		$image_id = $hcode_options['hcode_footer_wrapper_custom_map_icon_image']['id'];
			        		echo wp_get_attachment_image( $image_id, 'full' );
			        	} elseif( empty( $custom_map_icon ) && !empty( $map_icon ) ) {
					        echo '<i class="'.$map_icon.' footer-wrapper-small-icon black-text"></i>';
					    }
					    if( !empty( $map_text ) ) {
					        echo '<h6 class="black-text margin-two no-margin-bottom">';
					       		echo do_shortcode( nl2br( $map_text ) );
					        echo '</h6>';
					    }
			        echo '</div>';
		    	}
		    	if( $enable_email == 1 ) {
			        echo '<div class="col-md-' . $col_size . ' col-sm-' . $col_size . ' text-center">';
			        	if( $custom_email_icon == 1 && !empty( $custom_email_icon_image ) ) {
			        		$image_id = $hcode_options['hcode_footer_wrapper_custom_email_icon_image']['id'];
			        		echo wp_get_attachment_image( $image_id, 'full' );

			        	} elseif( empty( $custom_email_icon ) ) {
					        echo '<i class="'.$email_icon.' footer-wrapper-small-icon black-text"></i>';
					    }
					    if( !empty( $email_text ) ) {
					        echo '<h6 class="margin-two no-margin-bottom">';
					        	$pos = strpos($email_text, 'href');
					        	if ($pos === false) {
								    echo '<a href="mailto:' . $email_text . '">' . $email_text . '</a>';
								} else {
									echo do_shortcode( nl2br( $email_text ) );
								}
					        echo '</h6>';
					    }
			        echo '</div>';
		    	}
		    echo '</div>';
		echo '</div>';
	echo '</div>';
}