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

$ticket_columns = [
	'id'   => __('شناسه', 'modista'),
	'title'     => __('عنوان', 'modista'),
	'department'  => __('دپارتمان', 'modista'),
	'status'     => __('وضعیت', 'modista'),
	'prority'   => __('اولویت', 'modista'),
	'updated-at'   => __('آخرین تغییر', 'modista'),
	'action'   => __('عملیات', 'modista'),
];
?>
<div class="overflow-hidden">
	<div class="head-order d-flex d-md-grid overflow-scroll overflow-md-auto gap-4 d-grid-5 mb-6 mb-md-8">
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
<div class="tickets card bg-white rounded-4 p-3 pb-5">
	<div class="card__header d-flex justify-content-between pb-2 border-bottom mb-4">
		<h4 class="fw-700 lh-200 color-text-500"><?php _e( 'فهرست تیکت ها', 'modista' ) ?></h4>
		<a href="#" role="btn" toggle-section data-show=".create-ticket" data-hide=".tickets"
			class="d-flex gap-2 align-items-center color-text-300 fs-3--1">
			<svg width="16" height="16" style="fill: #989898;">
				<use xlink:href="#edit"></use>
			</svg>
			<?php _e('ایجاد تیکت', 'modista'); ?>
		</a>
	</div>
	<div class="card__content">
			<div class="tickets__item d-flex py-2 rounded-3 mb-5 color-text-500 px-6 fs-3--1<?php echo $has_ticket ? ' bg-text-100' : '' ?>">
				<?php foreach ( $ticket_columns as $column_id => $column_name ) : ?>
					<div class="woocommerce-ticket-table__header-<?php echo esc_attr( $column_id ); ?> flex-1 text-center">
						<span><?php echo esc_html( $column_name ); ?></span>
					</div>
				<?php endforeach; ?>
			</div>
			<?php if ($has_ticket) : ?>
				<div class="d-flex flex-column gap-2">
					<?php foreach ( $ticket_list as $ticket ) : ?>
						<a href="<?php echo esc_url( wc_get_account_endpoint_url('tickets') . $ticket->id  . '/' ); ?>" class="tickets__item bg-text-100 d-flex py-2 rounded-3 color-text-500 px-6 fs-3--1 text-center">
							<?php foreach ( $ticket as $column_id => $value ) : ?>
								<?php if (in_array($column_id, ['user_id', 'created_at', 'product_name']) ) continue; // Ignore specific columns  ?>
								<div class="woocommerce-ticket__cell flex-1">
									<?php
									switch ($column_id) {
										case 'priority':
											echo $field_priority[$value];
											break;
										case 'status':
											echo $field_status[$value];
											break;
										case 'department':
											echo $field_department[$value];
											break;
										case 'updated_at':
											$updated_at = strtok($value, ' ');
											echo mi_date_to_jalali($updated_at, 'Y-m-d');
											break;
										case 'action':
											echo ($ticket->status !== 'closed') ? __('باز', 'modista') : __('بسته', 'modista');
											break;
										default:
											echo esc_html( $value );
										break;
									}
									?>
								</div>
							<?php endforeach; ?>
							<div class="woocommerce-ticket__cell flex-1">
								<?php echo ($ticket->status !== 'closed') ? __('باز', 'modista') : __('بسته', 'modista'); ?>
							</div>
						</a>
					<?php endforeach; ?>
				</div>
			<?php else : ?>
				<div class="d-flex py-24 flex-column align-items-center justify-content-center h-100 color-text-400">
					<svg width="120px" height="120px" style="fill:#989898;">
						<use xlink:href="#ticket"></use>
					</svg>
					<?php echo __( 'تیکتی وجود ندارد.', 'modista' ); // phpcs:ignore WooCommerce.Commenting.CommentHooks.MissingHookComment ?>
				</div>
			<?php endif; ?>
	</div>
</div>
<div class="create-ticket card bg-white rounded-4 p-3 pb-5 hidden">
	<div class="card__header d-flex justify-content-between pb-2 border-bottom mb-4">
		<h4 class="fw-700 lh-200 color-text-500"><?php _e( 'ارسال تیکت جدید', 'modista' ) ?></h4>
		<a href="#" role="btn" toggle-section data-show=".create-ticket" data-hide=".tickets"
			class="d-flex gap-2 align-items-center color-text-300 fs-3--1">
			<svg width="16" height="16" style="fill: #989898;">
				<use xlink:href="#edit"></use>
			</svg>
			<?php _e('بازگشت به تیکت ها', 'modista'); ?>
		</a>
	</div>
	<div class="card__content p-6 pt-5">
		<form class="woocommerce-fields new-ticket-form d-flex flex-wrap gap-row-4 gap-column-6" id="woocommerce_NewTicketForm" action="" method="post">
			<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first w-100">
				<label for="ticket_title">عنوان<span class="required">*</span></label>
				<input type="text" class="woocommerce-Input woocommerce-Input--text input-text bg-text-100" name="subject" id="ticket_title" autocomplete="given-name" value="">
			</p>
			<div class="edit-account__password d-flex flex-wrap gap-row-4 gap-column-6">
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="ticket_department"><?php _e( 'دپارتمان', 'modista' ); ?><span class="required">*</span></label>
					<select id="ticket_department" name="department" class="mi-select2-results woocommerce-Input woocommerce-Input--password input-text bg-text-100">
						<?php foreach ($field_department as $option_value => $option_key) {
							echo '<option value="' . esc_attr( $option_value ) . '">' . esc_attr( $option_key ) . '</option>';
						} ?>
					</select>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide fs-3--1">
					<label for="ticket_priority"><?php _e( 'اولویت', 'modista' ); ?><span class="required">*</span></label>
					<select id="ticket_priority" name="priority" class="mi-select2-results woocommerce-Input woocommerce-Input--password input-text bg-text-100">
						<?php foreach ($field_priority as $option_value => $option_key) {
							echo '<option value="' . esc_attr( $option_value ) . '">' . esc_attr( $option_key ) . '</option>';
						} ?>
					</select>
				</p>
				<p class="woocommerce-form-row woocommerce-form-row--wide form-row form-row-wide">
					<label for="ticket_product_name"><?php  _e( 'محصول', 'modista' ) ?></label>
					<input type="text" class="woocommerce-Input woocommerce-Input--password input-text bg-text-100" name="product_name" id="ticket_product_name" autocomplete="off">
				</p>
			</div>
			<p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first w-100">
				<label for="ticket_message"><?php _e( 'محتوای تیکت', 'modista' ) ?><span class="required">*</span></label>
				<textarea name="message" id="ticket_message" class="woocommerce-Input woocommerce-Input--text input-text bg-text-100 w-100" rows="6"></textarea>
			</p>
			<p class="mt-8 d-flex justify-content-end w-100">
				<input type="hidden" id="save-account-details-nonce" name="save-account-details-nonce" value="d59cc93b14">
				<button type="submit" class="woocommerce-Button button" name="ticket_send" value="ارسال تیکت">ارسال تیکت</button>
			</p>
		</form>
	</div>
</div>