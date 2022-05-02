<?php
/**
 * Checkout coupon form
 *
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.4.4
 */

defined( 'ABSPATH' ) || exit;

if ( ! wc_coupons_enabled() ) { // @codingStandardsIgnoreLine.
	return;
}

?>
<div class="col-md-5 col-xs-12 alert-style4 pull-right">
	<?php  $info_message = apply_filters( 'woocommerce_checkout_coupon_message', __( 'Have a coupon?', 'woocommerce' ) . ' ' . __( 'Click here to enter your code', 'woocommerce' ) ); ?>
	<div class="panel panel-default border margin-bottom-20px">
	    <div role="tablist" id="headingOne" class="panel-heading no-padding">
	        <a class="collapsed" data-toggle="collapse" data-parent="#collapse-two" href="#collapse-two-link2">
	            <h4 class="panel-title no-border black-text font-weight-600 letter-spacing-2"><?php echo esc_attr($info_message); ?> <span class="panel-title-icon pull-right"><i class="fas fa-plus"></i></span></h4>
	        </a>
	    </div>
	    <div style="height: 0px;" id="collapse-two-link2" class="panel-collapse collapse">
	        <div class="panel-body">
                <div class="form-wrap">
                    <div class="form-group">
                        <form class="checkout_coupon display-block" method="post">
                        	<ul>
							<li class="form-row form-row-first">
								<label><?php esc_html_e( 'Coupon code', 'woocommerce' ); ?></label>
								<input type="text" name="coupon_code" class="input-text" id="coupon_code" value="" />
							</li>
							<li class="form-row form-row-last">
								<button type="submit" class="button btn btn-black no-margin-bottom btn-small" name="apply_coupon" value="<?php esc_attr_e( 'Apply coupon', 'woocommerce' ); ?>"><?php esc_html_e( 'Apply coupon', 'woocommerce' ); ?></button>
							</li>
							</ul>
						</form>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
</div>