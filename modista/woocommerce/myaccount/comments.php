<?php

/**
 * Comments
 *
 * Shows comments on the account page.
 */

defined( 'ABSPATH' ) || exit;

global $comment;

do_action( 'woocommerce_before_account_comments', $has_comment ); ?>

<?php if ( $has_comment ) : ?>
    
    <div class="woocommerce-table woocommerce-table--comments shop_table shop_table_responsive d-flex flex-column gap-4 color-text-500">
		<?php foreach ( $comments as $review ) : ?>
			<div class="comment-item <?php echo esc_attr( $review->post_type ) ?> d-flex flex-column flex-md-row px-4 py-3 bg-white rounded-3 gep-2 gap-md-6 fs-3--1">
                <?php // Render the post link and thumbnail and title ?>
                <a href="<?php echo get_permalink( $review->comment_post_ID ); ?>" class="d-flex flex-column gap-1">
                    <img width="137px" height="86px" src="<?php echo get_the_post_thumbnail_url( $review->comment_post_ID ); ?>" alt="<?php echo wp_kses_post( $review->post_title ); ?>" class="rounded-2">
                    <h4 class="color-text-500 lh-200 line-overflow-ellipsis">
                        <?php echo wp_kses_post( $review->post_title ); ?>
                    </h4>
                </a>
                <div class="divider--vertical my-2" style="border-right: 1px dashed #C3D9ED;"></div>
                <?php // Render the comment content ?>
                <div class="flex-5 fs-4">
                    <?php echo wp_kses_post( $review->comment_content ); ?>
                </div>
                <div class="divider--vertical my-2" style="border-right: 1px dashed #C3D9ED;"></div>
                <div class="comment__data d-flex flex-row flex-md-column justify-content-center align-items-center flex-1 gap-2 gap-md-1">
                    <?php
                    // Get star rate of the product
                    if ( $review->post_type == 'product' ) {
                        $comment = $review;
                        woocommerce_review_display_rating();
                    }
                    ?>
                    <span class="comment__data-status mb-md-3 rounded-3 bg-text-100 px-2">
                        <?php echo $review->comment_approved ? __('تایید شده', 'modista') : __('تایید نشده', 'modista'); ?>
                    </span>
                    <span>
                        <?php echo mi_date_to_jalali( $review->comment_date, 'Y-m-d' ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    </span>
                </div>
			</div>
		<?php endforeach; ?>
	</div>

<?php else : ?>
    
    <div class="d-flex flex-column align-items-center justify-content-center h-100 color-text-500">
        <svg width="120px" height="120px" style="fill:#989898;">
            <use xlink:href="#clipboard-text"></use>
        </svg>
        <?php echo esc_html__( 'هنوز دیدگاهی درج نشده.', 'modista' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>
    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_comments', $has_comment ); ?>