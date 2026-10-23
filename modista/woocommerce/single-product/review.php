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
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 2.6.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

// Comment Reply Script.
if ( comments_open() && get_option( 'thread_comments' ) ) {
    wp_enqueue_script( 'comment-reply' );
}

?>
<li <?php comment_class(); ?> id="li-comment-<?php comment_ID(); ?>">

	<div id="comment-<?php comment_ID(); ?>" class="comment_container">

        <div class="d-flex gap-3">
            <?php
            /**
             * The woocommerce_review_before hook
             *
             * @hooked woocommerce_review_display_gravatar - 10
             */
            do_action( 'woocommerce_review_before', $comment );
            ?>

            <div class="d-flex flex-1 flex-row justify-content-between">
                <?php
                /**
                 * The woocommerce_review_meta hook.
                 *
                 * @hooked woocommerce_review_display_meta - 10
                 */
                do_action( 'woocommerce_review_meta', $comment );
                ?>

                <div class="d-flex align-items-start gap-3">
                    <?php
                        /**
                         * The woocommerce_review_before_comment_meta hook.
                         *
                         * @hooked woocommerce_review_display_rating - 5
                         * @hooked mi_reply_comment - 10
                         */
                        do_action( 'woocommerce_review_before_comment_meta', $comment );
                    ?>
                    <div class="reply position-relative bg-white rounded-2 fs-3--1 px-1 color-text-400">
                        <?php comment_reply_link(array_merge($args, array('depth' => $depth, 'max_depth' => $args['max_depth']))); ?>
                    </div>
                </div>
            </div>
        </div>

		<div class="comment-text mt-6">
			<?php

			do_action( 'woocommerce_review_before_comment_text', $comment );

			/**
			 * The woocommerce_review_comment_text hook
			 *
			 * @hooked woocommerce_review_display_comment_text - 10
			 */
			do_action( 'woocommerce_review_comment_text', $comment );

			do_action( 'woocommerce_review_after_comment_text', $comment );
			?>
		</div>
	</div>
