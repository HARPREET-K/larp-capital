<?php
/**
 * displaying left sidebar for portfolio category page
 *
 * @package H-Code
 */
?>
<?php
if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}
$layout_left_sidebar = $layout_right_sidebar = $layout_settings = '';
$hcode_options = get_option( 'hcode_theme_setting' );
$layout_settings = (isset($hcode_options['hcode_portfolio_cat_settings'])) ? $hcode_options['hcode_portfolio_cat_settings'] : '';
$layout_left_sidebar = (isset($hcode_options['hcode_portfolio_cat_left_sidebar'])) ? $hcode_options['hcode_portfolio_cat_left_sidebar'] : '';
$layout_right_sidebar = (isset($hcode_options['hcode_portfolio_cat_right_sidebar'])) ? $hcode_options['hcode_portfolio_cat_right_sidebar'] : '';
	
switch ($layout_settings) {
	case 'hcode_portfolio_cat_left_sidebar':
		echo '<div class="col-md-8 col-sm-8 col-xs-12 col-md-offset-1 xs-margin-bottom-seven pull-right xs-pull-none">';
        
		break;

	case 'hcode_portfolio_cat_right_sidebar':
		echo '<div class="col-md-8 col-sm-8 col-xs-12">';
		break;

	case 'hcode_portfolio_cat_both_sidebar':
		echo '<div class="col-sm-12 col-xs-12 both-content-center sm-margin-bottom-seven">';
		break;

	case 'hcode_portfolio_cat_full_screen':
        break;
}