<?php
/**
 * Review Comments Template
 *
 * Closing li is left out on purpose!.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/single-product/review.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @author  WooThemes
 * @package WooCommerce/Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

$rating = intval( get_comment_meta( $comment->comment_ID, 'rating', true ) );
?>

<div itemscope itemtype="http://schema.org/Review" <?php comment_class('review'); ?> id="li-comment-<?php comment_ID() ?>">
	<div itemprop="itemReviewed" class="display-none">
		<span itemprop="name"><?php the_title(); ?></span>
	</div>
	<div id="comment-<?php comment_ID(); ?>" class="comment_container">
				
		<?php if ( $comment->comment_approved == '0' ) : ?>

			<p class="letter-spacing-2 text-uppercase review-name"><em><?php esc_html_e( 'Your review is awaiting approval', 'woocommerce' ); ?></em></p>

		<?php else : ?>
			
			<p class="letter-spacing-2 text-uppercase review-name">
				<strong itemprop="author"><?php comment_author(); ?></strong><?php

					if ( get_option( 'woocommerce_review_rating_verification_label' ) === 'yes' )
						if ( wc_customer_bought_product( $comment->comment_author_email, $comment->user_id, $comment->comment_post_ID ) )
							echo '<em class="verified">(' . esc_html__( 'verified owner', 'woocommerce' ) . ')</em> ';

				?>&sbquo; <span itemprop="datePublished"><?php echo get_comment_date( wc_date_format() ); ?></span>
			</p>

		<?php endif; ?>
		<?php if ( $rating && get_option( 'woocommerce_enable_review_rating' ) == 'yes' ) : ?>
				<?php echo wc_get_rating_html( $rating ); ?>
		<?php endif; ?>

		<div class="review-text" itemprop="description"><?php comment_text(); ?></div>

	</div>
