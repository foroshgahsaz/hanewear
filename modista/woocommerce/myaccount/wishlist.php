<?php

/**
 * Notification
 *
 * Shows wishlist on the account page.
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_wishlist', $has_wishlist ); ?>

<?php if ( $has_wishlist ) : 
    
    foreach ( $wishlists as $post_type => $list ) : ?>

<?php $title = ($post_type === 'product') ? __('محصولات', 'modista') : 'مقالات' ?>

<div
    class="woocommerce-table--wishlist <?php esc_attr_e( $post_type, 'modista' ); ?> gap-3 color-text-500 mb-6 p-4 bg-white rounded-4">
    <div class="card__header d-flex justify-content-between pb-2 border-bottom mb-4">
        <h4 class="fw-700 lh-200 color-text-500"><?php echo $title . ' ' .  __( 'مورد علاقه', 'modista' ); ?></h4>
    </div>
    <div class="d-grid d-grid-1 d-grid-md-3 gap-3">
        <?php foreach ( $list as $post_ID ) : ?>
            <div class="item d-flex p-3 rounded-3 gap-3 bg-text-100 align-items-center">
                <?php
                // Render thumbnail
                $src = get_the_post_thumbnail_url( $post_ID );
                $width = ($post_type === 'product') ? '37px' : '50px';
                $height = ($post_type === 'product') ? '48px' : '34px';

                if ($src) { 
                    echo '<img width="' . $width . '" height="' . $height . '" src="' . $src . '" style="object-fit:contain;" />';
                }
                ?>
                <div class="flex-1 fs-3--1 lh-200 ps-md-12"><?php echo get_the_title( $post_ID ); ?></div>
                <div class="d-flex flex-column justify-content-center gap-3">
                    <a href="<?php echo get_permalink( $post_ID ); ?>" target="_blank" class="d-flex bg-white rounded-2 p-2">                    
                        <svg width="18" height="18" fill="#989898">
                            <use xlink:href="#eye"></use>
                        </svg>
                    </a>
                    <span class="action-button__wishlist d-flex bg-white rounded-2 p-2 cursor-pointer" data-id="<?php esc_attr_e( $post_ID ); ?>" data-action="remove" data-action-hide="true">
                        <svg width="18" height="18" fill="#989898">
                            <use xlink:href="#trash-bin"></use>
                        </svg>
                    </span>
                </div>
            </div>
        <?php endforeach; ?>
    </div>
</div>

<?php endforeach; ?>

<?php else : ?>

<div class="d-flex flex-column align-items-center justify-content-center h-100 color-text-500">
    <svg width="120px" height="120px" style="fill:#989898;">
        <use xlink:href="#heart"></use>
    </svg>
    <?php echo esc_html__( 'لیست علاقه مندی ها خالی میباشد.', 'modista' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>
</div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_wishlist', $has_wishlist ); ?>