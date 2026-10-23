<?php

/**
 * Notification
 *
 * Shows notifications on the account page.
 */

defined( 'ABSPATH' ) || exit;

do_action( 'woocommerce_before_account_notifications', $has_notification ); ?>

<?php if ( $has_notification ) : ?>
    
    <div class="woocommerce-table woocommerce-table--notifications shop_table shop_table_responsive d-flex flex-column gap-4 color-text-500 fs-4">
		<?php foreach ( $notifications as $notification ) : ?>
            <div class="notification <?php echo esc_attr( $notification_types[$notification->type] ) ?> d-flex flex-column p-4 bg-white rounded-3">
                <div class="d-flex align-items-center">
                    <div class="flex-1 d-flex gap-1 align-items-center">
                        <span class="notification__badge d-flex rounded"></span>
                        <?php echo esc_html( $notification->title ); ?>
                    </div>
                    <div class="notification__data d-flex justify-content-center align-items-center gap-3 fs-3--1">
                        <span class="d-flex cursor-pointer notification__toggle">
                            <svg width="38" height="38" style="fill:#ECECEC;">
                                <use xlink:href="#plus-square"></use>
                            </svg>
                        </span> 
                        <span class="px-3 py-1 rounded-3 bg-text-100 color-text-400">
                            <?php  echo mi_date_to_jalali( strtok($notification->created_at, ' '), 'Y-m-d' ); ?>
                        </span>
                    </div>
                </div>
                <div class="notification__content d-flex fs-3--1 overflow-hidden color-text-400">
                    <?php echo wp_kses_post( $notification->message ); ?>
                </div>
			</div>
			
		<?php endforeach; ?>
	</div>

<?php else : ?>
    
    <div class="d-flex flex-column align-items-center justify-content-center h-100 color-text-500">
        <svg width="120px" height="120px" style="fill:#989898;">
            <use xlink:href="#alert"></use>
        </svg>
        <?php echo esc_html__( 'هیچ اعلانی وجود ندارد.', 'modista' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>
    </div>

<?php endif; ?>

<?php do_action( 'woocommerce_after_account_notifications', $has_notification ); ?>