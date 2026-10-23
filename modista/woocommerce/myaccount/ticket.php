<?php
/**
 * Tickets
 *
 * Shows tickets on the account page.
 *
 * This template custom adedd.
 *
 * @package modista
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

?>
<div class="d-flex flex-column h-100">
	<div class="mb-6 mb-md-8">
		<div class="head-order d-flex d-md-grid overflow-x-scroll mini-scroll overflow-md-auto gap-4 d-grid-5">
			<?php foreach ($field_status as $status_key => $status_label): ?>
			<div class="head-order__item d-flex flex-column align-items-center justify-content-start justify-content-md-center">
				<svg width="24px" height="24px" style="fill: var(--e-global-color-secondary);">
					<use xlink:href="#ticket"></use>
				</svg>
				<span><?php echo $ticket_status_count[$status_key] ?? 0; ?></span>
				<p class="text-center px-2 px-md-4"><?php echo $status_label; ?></p>
			</div>
			<?php endforeach; ?>
		</div>
	</div>
	<div class="ticket-messages card d-flex flex-column bg-white rounded-4 p-3 pb-5 flex-1">
		<div class="card__header d-flex justify-content-between pb-2 border-bottom mb-4">
			<h4 class="fw-700 lh-200 color-text-500"><?php printf('%s %d', _e( 'تیکت شماره', 'modista' ), $ticket_id ) ?></h4>
			<a href="<?php echo esc_url( wc_get_account_endpoint_url('tickets') ); ?>" class="d-flex gap-2 align-items-center color-text-300 fs-3--1">
				<svg width="16" height="16" style="fill: #989898;">
					<use xlink:href="#edit"></use>
				</svg>
				<?php _e('مشاهده همه تیکت ها', 'modista'); ?>
			</a>
		</div>
		<div class="card__content d-flex flex-column gap-8 flex-1 overflow-y-scroll mini-scroll mini-scroll--down">
			<?php $message_count = 1; ?>
			<?php foreach ( $ticket_messages as $message ) : ?>
				<?php $user_ticket = ( $message->author_id === $ticket->user_id ); ?>
				<div class="d-flex w-100 <?php echo $user_ticket ? 'justify-content-start' : 'justify-content-end'; ?>">
					<div class="bg-text-100 rounded-4 py-2 px-4 w-90 w-md-75 d-flex flex-column gap-4 fs-3--1">
						<h4 class="color-text-400 fs-4 fw-600"><?php echo $user_ticket ? __('تیکت شما', 'modista') : __('پاسخ پشتیبانی', 'modista'); ?></h4>
						<p><?php echo wp_kses_post( $message->message ); ?></p>
						<?php if ( $message_count == 1 && $ticket->product_name ) : ?>
						<p class="color-text-300 bg-white rounded-2 px-3 pb-1">
							<?php _e('محصول', 'modista') ?>: 
							<span class="color-text-400"><?php echo wp_kses_post( $ticket->product_name ); ?></span>
						</p>
						<?php endif; ?>
						<div class="d-flex flex-wrap justify-content-between gap-4 align-items-end">
							<?php if ( $message_count == 1 ): ?>
							<div class="bg-white rounded-4 px-2 text-center badge">
								<?php echo $field_status[$ticket->status]; ?>
							</div>
							<?php endif; ?>
							<div class="d-flex flex-1 gap-4 gap-md-6 justify-content-end">
								<?php if ( $message_count == 1 ): ?>
								<span class="color-text-300">
									<?php _e('اولویت', 'modista') ?>: 
									<span class="color-text-400"><?php echo $field_priority[$ticket->priority]; ?></span>
								</span>
								<?php endif; ?>
								<span class="color-text-300 d-none d-md-flex flex-wrap">
									<?php _e('تاریخ', 'modista') ?>: 
									<span class="color-text-400">
										<?php 
										$created_at = strtok($message->created_at, ' ');
										echo mi_date_to_jalali($created_at, 'Y-m-d');
										 ?>
									</span>
								</span>
								<span class="color-text-300">
									<?php _e('بخش', 'modista') ?>: 
									<span class="color-text-400"><?php echo $field_department[$ticket->department]; ?></span>
								</span>
							</div>
						</div>
					</div>
				</div>
			<?php $message_count++; ?>
			<?php endforeach; ?>
		</div>
		<div class="reply-ticket-form w-100 bg-white pt-8">
			<form class="woocommerce-EditAccountForm d-flex flex-column" id="woocommerce_replyTicketForm" action="" method="post">		
				<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first w-100">
					<label for="ticket_message"><?php _e( 'پاسخ خود را وارد کنید', 'modista' ); ?> :</label>
					<textarea name="message" id="ticket_message" class="woocommerce-Input woocommerce-Input--text input-text bg-text-100 w-100" rows="6"></textarea>
				</p>
				<p class="mt-8 d-flex justify-content-end w-100">
					<input type="hidden" id="save-account-details-nonce" name="save-account-details-nonce" value="d59cc93b14">
					<input type="hidden" name="ticket_id" value="<?php echo esc_attr($ticket_id); ?>">
					<button type="submit" class="woocommerce-Button button" name="ticket_send" value="ارسال پاسخ"> ارسال پاسخ</button>
				</p>
			</form>
		</div>
	</div>
</div>