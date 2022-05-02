<?php
/**
 * My Account navigation
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/myaccount/navigation.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woothemes.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

do_action( 'woocommerce_before_account_navigation' );
?>

<nav class="woocommerce-MyAccount-navigation">
	<ul>
		<?php foreach ( wc_get_account_menu_items() as $endpoint => $label ) : ?>
			<li class="<?php echo wc_get_account_menu_item_classes( $endpoint ); ?>">
				<a href="<?php echo esc_url( wc_get_account_endpoint_url( $endpoint ) ); ?>">

					<?php if( $endpoint == 'dashboard' ){ ?>
						<i class="fas fa-tachometer-alt"></i>
					<?php }?>
					<?php if( $endpoint == 'orders' ){ ?>
						<i class="fas fa-sort-numeric-up"></i>
					<?php }?>
					<?php if( $endpoint == 'downloads' ){ ?>
						<i class="fas fa-download"></i>
					<?php }?>
					<?php if( $endpoint == 'edit-address' ){ ?>
						<i class="fas fa-map-marker-alt"></i>
					<?php }?>
					<?php if( $endpoint == 'edit-account' ){ ?>
						<i class="fas fa-user"></i>
					<?php }?>
					<?php if( $endpoint == 'payment-methods' ){ ?>
						<i class="far fa-money-bill-alt"></i>
					<?php }?>
					<?php if( $endpoint == 'customer-logout' ){ ?>
						<i class="fas fa-power-off"></i>
					<?php }?>

					<?php echo esc_html( $label ); ?>
				</a>
			</li>
		<?php endforeach; ?>
	</ul>
</nav>

<?php do_action( 'woocommerce_after_account_navigation' ); ?>
