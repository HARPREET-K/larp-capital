<?php
/**
 * Checkout login form
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
 * @version 3.8.0
 */

defined( 'ABSPATH' ) || exit;

if ( is_user_logged_in() || 'no' === get_option( 'woocommerce_enable_checkout_login_reminder' ) ) {
	return;
}

$info_message = apply_filters( 'woocommerce_checkout_login_message', esc_html__( 'Returning customer?', 'woocommerce' ) ) . ' ' . esc_html__( 'Click here to login', 'woocommerce' );

?>
<div class="col-md-5 col-xs-12 alert-style4 pull-left">
	<div class="panel panel-default border margin-bottom-20px">
	    <div role="tablist" id="headingOne" class="panel-heading no-padding">
	        <a class="collapsed" data-toggle="collapse" data-parent="#collapse-two" href="#collapse-two-link1">
	            <h4 class="panel-title no-border black-text font-weight-600 letter-spacing-2"><?php echo esc_attr($info_message);?><span class="panel-title-icon pull-right"><i class="fas fa-plus"></i></span></h4>
	        </a>
	    </div>
	    <div style="height: 0px;" id="collapse-two-link1" class="panel-collapse collapse">
	        <div class="panel-body">
                <div class="form-wrap">
                    <div class="form-group">
                        <?php
							woocommerce_login_form(
								array(
									'message'  => esc_html__( 'If you have shopped with us before, please enter your details below. If you are a new customer, please proceed to the Billing section.', 'woocommerce' ),
									'redirect' => wc_get_checkout_url(),
									'hidden'   => true,
								)
							);
						?>
                    </div>
                </div>
	        </div>
	    </div>
	</div>
</div>
