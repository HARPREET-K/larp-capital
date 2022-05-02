<?php
/**
 * Display single product reviews (comments)
 *
 * @package 	H-Code
 * @version     4.3.0
 */

defined( 'ABSPATH' ) || exit;

global $product;

if ( ! comments_open() ) {
	return;
}

$product_sidebar_position = hcode_option('product_sidebar_position');

$hcode_product_review_top_classes = $hcode_product_review_bottom_classes = '';
switch ($product_sidebar_position) {
	case '1':
	case '2':
	case '3':
		$hcode_product_review_top_classes .= 'col-md-6 col-sm-12';
		$hcode_product_review_bottom_classes .= 'col-md-5 col-sm-12 col-md-offset-1';
	break;

	case '4':
		$hcode_product_review_top_classes .= 'col-md-12 col-sm-12';
		$hcode_product_review_bottom_classes .= 'col-md-12 col-sm-12';

	break;

	default:
	break;
}

?>
<div id="reviews" class="review-wrapper">
	<div class="review-main <?php echo esc_attr( $hcode_product_review_top_classes );?>" id="comments">
		
		<?php if ( have_comments() ) : ?>
			
			<?php wp_list_comments( apply_filters( 'woocommerce_product_review_list_args', array( 'callback' => 'woocommerce_comments', 'style' => 'div' ) ) ); ?>
			
			<?php if ( get_comment_pages_count() > 1 && get_option( 'page_comments' ) ) :
				$paginations = paginate_comments_links( apply_filters( 'woocommerce_comment_pagination_args', array(
					'prev_text' => '<img alt="Previous" src="'.HCODE_THEME_IMAGES_URI.'/arrow-pre-small.png" width="20" height="13">',
					'next_text' => '<img alt="Next" src="'.HCODE_THEME_IMAGES_URI.'/arrow-next-small.png" width="20" height="13">',
					'type'      => 'array',
					'echo'      => false,
					'show_all'  => true
				) ) );
				echo '<ul class="list-inline comment-pagination">';
					foreach ($paginations as $key => $page) {
						echo '<li>'.$page.'</li>';
					}
				echo '</ul>';
			endif; ?>

		<?php else : ?>

			<p class="woocommerce-noreviews"><?php esc_html_e( 'There are no reviews yet.', 'woocommerce' ); ?></p>

		<?php endif; ?>
	</div>

	<?php if ( get_option( 'woocommerce_review_rating_verification_required' ) === 'no' || wc_customer_bought_product( '', get_current_user_id(), $product->get_id() ) ) : ?>

		<div id="review_form_wrapper" class="blog-single-full-width-form sm-margin-top-seven <?php echo esc_attr( $hcode_product_review_bottom_classes );?>">
			<div id="review_form" class="blog-comment-form">
				<?php
					$commenter = wp_get_current_commenter();

					$comment_form = array(
						'title_reply'          => have_comments() ? __( 'Add a review', 'woocommerce' ) : sprintf( __( 'Be the first to review &ldquo;%s&rdquo;', 'woocommerce' ), get_the_title() ),
						'title_reply_to'       => __( 'Leave a Reply to %s', 'woocommerce' ),
						'comment_notes_before' => '',
						'comment_notes_after'  => '',
						'fields'               => array(
							'author' => '<input id="author" name="author" type="text" class="comment-field" placeholder="' . esc_html__( 'Name', 'woocommerce' ) . '*" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30" aria-required="true" />',
							'email'  => '<input id="email" name="email" type="text" class="comment-field" placeholder="' . esc_html__( 'Email', 'woocommerce' ) . '*" value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30" aria-required="true" />',
						),
						'label_submit'  => __( 'Submit', 'woocommerce' ),
						'logged_in_as'  => '',
						'comment_field' => '',
						'class_submit'  => 'highlight-button-black-border btn btn-small xs-no-margin-bottom comment-button'
					);

					$account_page_url = wc_get_page_permalink( 'myaccount' );
					if ( $account_page_url ) {
						/* translators: %s opening and closing link tags respectively */
						$comment_form['must_log_in'] = '<p class="must-log-in">' . sprintf( esc_html__( 'You must be %slogged in%S to post a review.', 'woocommerce' ), '<a href="' . esc_url( $account_page_url ) . '">', '</a>' ) . '</p>';
					}

					if ( wc_review_ratings_enabled() ) {
						$comment_form['comment_field'] = '<div class="comment-form-rating"><label for="rating">' . esc_html__( 'Your rating', 'woocommerce' ) . ( wc_review_ratings_required() ? '*' : '' ) . '</label><select name="rating" id="rating" required>
							<option value="">' . esc_html__( 'Rate&hellip;', 'woocommerce' ) . '</option>
							<option value="5">' . esc_html__( 'Perfect', 'woocommerce' ) . '</option>
							<option value="4">' . esc_html__( 'Good', 'woocommerce' ) . '</option>
							<option value="3">' . esc_html__( 'Average', 'woocommerce' ) . '</option>
							<option value="2">' . esc_html__( 'Not that bad', 'woocommerce' ) . '</option>
							<option value="1">' . esc_html__( 'Very poor', 'woocommerce' ) . '</option>
						</select></p>';
					}

					$comment_form['comment_field'] .= '<textarea id="comment" placeholder="' . esc_html__( 'Your review', 'woocommerce' ) . '*" name="comment" class="comment-field" cols="45" rows="3" aria-required="true"></textarea>';

					comment_form( apply_filters( 'woocommerce_product_review_comment_form_args', $comment_form ) );
				?>
			</div>
		</div>

	<?php else : ?>

		<p class="woocommerce-verification-required"><?php esc_html_e( 'Only logged in customers who have purchased this product may leave a review.', 'woocommerce' ); ?></p>

	<?php endif; ?>

	<div class="clear"></div>
</div>
