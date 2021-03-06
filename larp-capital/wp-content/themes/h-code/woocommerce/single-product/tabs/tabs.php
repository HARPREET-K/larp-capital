<?php
/**
 * Single Product tabs
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/tabs/tabs.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see 	https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 3.8.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Filter tabs and allow third parties to add their own
 *
 * Each tab is an array containing title, callback and priority.
 * @see woocommerce_default_product_tabs()
 */
$product_tabs = apply_filters( 'woocommerce_product_tabs', array() );

$product_sidebar_position = hcode_option('product_sidebar_position');

$hcode_product_tab_review_main_wrapper = '';
switch ($product_sidebar_position) {
	case '1':
	case '2':
	case '3':
		$hcode_product_tab_review_main_wrapper .= '';
	break;

	case '4':
		$hcode_product_tab_review_main_wrapper .= 'review-tab-with-both-sidebar';
	break;

	default:
	break;
}

if ( ! empty( $product_tabs ) ) : ?>
	<div class="wpb_column hcode-column-container col-md-12 col-sm-12 col-xs-12"><div class="wide-separator-line  margin-eight no-margin-lr"></div></div>
	<div class="product-deails-tab">	
		<div class="col-md-12 col-sm-12 no-padding <?php echo esc_attr( $hcode_product_tab_review_main_wrapper );?>">
			<div class="tab-style1">
				<div class="col-md-12 col-sm-12">
					<ul class="nav nav-tabs nav-tabs-light text-left">
						<?php 
						$i = 1;
						foreach ( $product_tabs as $key => $product_tab ) : ?>
							<li class="<?php echo esc_attr( $key ); ?>_tab <?php echo ($i == 1) ? 'active': ''?>">
								<a data-toggle="tab" href="#tab-<?php echo esc_attr( $key ); ?>"><?php echo apply_filters( 'woocommerce_product_' . $key . '_tab_title', esc_html( $product_tab['title'] ), $key ); ?></a>
							</li>
						<?php 
						$i++;
						endforeach;
						?>
					</ul>
				</div>
				<div class="tab-content">
				<?php 
					$i = 1;
					foreach ( $product_tabs as $key => $product_tab ) : 
					?>
					<div class="tab-pane fade in <?php echo ($i == 1) ? 'active': ''?>" id="tab-<?php echo esc_attr( $key ); ?>">
						<?php
						if ( isset( $product_tab['callback'] ) ) {
							call_user_func( $product_tab['callback'], $key, $product_tab );
						}
						?>
					</div>
					<?php 
					$i++;
					endforeach;
				?>
				</div>
				<?php do_action( 'woocommerce_product_after_tabs' ); ?>
			</div>
		</div>
	</div>
<?php endif; ?>