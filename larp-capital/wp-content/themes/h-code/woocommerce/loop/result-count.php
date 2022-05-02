<?php
/**
 * Result Count
 *
 * Shows text: Showing x - x of x results
 *
 * @author  Themezaa
 * @package H-Code
 * @version 3.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

?>
<div class="col-md-8 col-sm-12 grid-nav sm-text-center">
	<?php 
		$woocommerce_enable_grid_list = hcode_option( 'hcode_woocommerce_category_view_type' );
		if( $woocommerce_enable_grid_list ){
			echo '<div class="hcode-product-grid-list-wrapper">';
				if ( '1' === $woocommerce_enable_grid_list ) {
					echo '<a class="hcode-grid-view active" href="javascript:void(0);"><i class="fas fa-th"></i></a>';
				} else {
					echo '<a class="hcode-grid-view" href="javascript:void(0);"><i class="fas fa-th"></i></a>';
				}
				if ( '2' === $woocommerce_enable_grid_list ) {
					echo '<a class="hcode-list-view active" href="javascript:void(0);"><i class="fas fa-bars"></i></a>';
				} else {
					echo '<a class="hcode-list-view" href="javascript:void(0);"><i class="fas fa-bars"></i></a>';
				}
			echo '</div>';
		}
	?>

    <p class="woocommerce-result-count">
		<?php
		if ( 1 === $total ) {
			_e( 'Showing the single result', 'woocommerce' );
		} elseif ( $total <= $per_page || -1 === $per_page ) {
			/* translators: %d: total results */
			printf( _n( 'Showing all %d result', 'Showing all %d results', $total, 'woocommerce' ), $total );
		} else {
			$first = ( $per_page * $current ) - $per_page + 1;
			$last  = min( $total, $per_page * $current );
			/* translators: 1: first result 2: last result 3: total results */
			printf( _nx( 'Showing %1$d&ndash;%2$d of %3$d result', 'Showing %1$d&ndash;%2$d of %3$d results', $total, 'with first and last result', 'woocommerce' ), $first, $last, $total );
		}
		?>
	</p>

</div>