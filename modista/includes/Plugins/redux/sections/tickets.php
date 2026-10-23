<?php
/**
 * ReduxFramework Section
 * For full documentation, please visit: https://devs.redux.io/
 *
 * @package Redux Framework
 */

// phpcs:disable
defined( 'ABSPATH' ) || exit;

/**
 * Tickets
 * Get data from `mi_form_submission` table
 */
function get_view() {

    // If has ticket id in url show single ticket.
    if ( !empty($_GET['ticket']) && is_numeric($_GET['ticket']) ) {

        $ticket_id = intval( $_GET['ticket'] );

        $current_ticket = \Modista\Modules\Tickets::get_ticket(['id' => $ticket_id]);
        $current_ticket = !empty($current_ticket) ? array_shift($current_ticket) : null;

        // Ticekt id is valid and for current user
        if ( !empty($current_ticket) ) {

            $args = [
                'ticket_id'             => $ticket_id,
                'ticket'                => $current_ticket,
                'ticket_messages'       => Modista\Modules\Tickets::get_ticket_message(['ticket_id' => $ticket_id]),
            ];
    
            ob_start();
            ?>
            <div class="card__header d-flex justify-content-between pb-2 border-bottom mb-4">
                <h4 class="fw-700 lh-200 color-text-500"><?php printf('%s %d', _e( 'تیکت شماره', 'modista' ), $ticket_id ) ?></h4>
                <div class="d-flex align-items-center">
                    <div class="ticket-filters">
                        <label for="status"><?php _e('وضعیت تیکت', 'modista'); ?></label>
                        <select name="status" id="status" data-ticket-id="<?php echo esc_attr($ticket_id); ?>" onchange="changeTicketStatus(event)">
                            <option value="open" <?php selected($args['ticket']->status, 'open'); ?>><?php _e('باز', 'modista'); ?></option>
                            <option value="in_progress" <?php selected($args['ticket']->status, 'in_progress'); ?>><?php _e('در انتظار', 'modista'); ?></option>
                            <option value="answered" <?php selected($args['ticket']->status, 'answered'); ?>><?php _e('پاسخ داده شد', 'modista'); ?></option>
                            <option value="closed" <?php selected($args['ticket']->status, 'closed'); ?>><?php _e('بسته شده', 'modista'); ?></option>
                        </select>
                    </div>
                    <a href="<?php echo esc_url( remove_query_arg( 'ticket' ) ); ?>" class="d-flex gap-2 align-items-center color-text-300 fs-3--1">
                        <svg width="16" height="16" style="fill: #989898;">
                            <use xlink:href="#edit"></use>
                        </svg>
                        <?php _e('مشاهده همه تیکت ها', 'modista'); ?>
                    </a>
                </div>
            </div>
            <div class="card__content d-flex flex-column gap-4 overflow-y-scroll mini-scroll mini-scroll--down">
			<?php $message_count = 1; ?>
                <?php foreach ( $args['ticket_messages'] as $message ) : ?>
                    <?php $user_ticket = ( $message->author_id === $args['ticket']->user_id ); ?>
                    <div class="d-flex w-100 <?php echo $user_ticket ? 'justify-content-end' : 'justify-content-start'; ?>">
                        <div class="bg-text-100 rounded-4 py-2 px-4 w-80 w-md-75 d-flex flex-column gap-4 fs-3--1">
                            <h4 class="color-text-400 fs-4 m-0 fw-600"><?php echo $user_ticket ? __('تیکت کاربر', 'modista') : __('پاسخ شما', 'modista'); ?></h4>
                            <p><?php echo wp_kses_post( $message->message ); ?></p>
                            <?php if ( $message_count == 1 && $args['ticket']->product_name ) : ?>
                            <p class="color-text-300 bg-white rounded-2 px-3 py-2">
                                <?php _e('محصول', 'modista') ?>: 
                                <span class="color-text-400"><?php echo wp_kses_post( $args['ticket']->product_name ); ?></span>
                            </p>
                            <?php endif; ?>
                            <div class="d-flex justify-content-between">
                                <?php if ( $message_count == 1 ): ?>
                                <div class="bg-white rounded-4 px-4 text-center badge">
                                    <?php echo Modista\Modules\Tickets::$field_status[$args['ticket']->status]; ?>
                                </div>
                                <?php endif; ?>                            
                            </div>
                        </div>
                    </div>
                <?php $message_count++; ?>
                <?php endforeach; ?>
            </div>
            <div class="reply-ticket-form w-100 bg-white pt-8">
                <div class="woocommerce-EditAccountForm d-flex flex-column" id="woocommerce_replyTicketForm">		
                    <p class="woocommerce-form-row woocommerce-form-row--first form-row form-row-first w-100">
                        <label for="ticket_message"><?php _e( 'پاسخ خود را وارد کنید', 'modista' ); ?> :</label>
                        <textarea name="message" id="ticket_message" class="woocommerce-Input woocommerce-Input--text input-text bg-text-100 w-100" rows="6"></textarea>
                    </p>
                    <p class="mt-8 d-flex justify-content-start w-100">
                        <input type="hidden" id="save-account-details-nonce" name="save-account-details-nonce" value="d59cc93b14">
                        <input type="hidden" name="ticket_id" value="<?php echo esc_attr($ticket_id); ?>">
                        <button type="submit" class="woocommerce-Button button" name="ticket_send" value="ارسال پاسخ"> ارسال پاسخ</button>
                    </p>
                </div>
            </div>
            <?php
            return ob_get_clean();
        }
    }

    $status = isset($_GET['status']) ? sanitize_text_field($_GET['status']) : '';
    $current_page = isset($_GET['per_page']) ? (int) $_GET['per_page'] : 1;
    $per_page = 20;
    $offset = ($current_page - 1) * $per_page;

    $tickets = Modista\Modules\Tickets::get_ticket(['status' => $status], $per_page, $offset);

    ob_start();
    ?>
    <div class="ticket-filters mb-4">
        <label for="status"><?php _e('وضعیت تیکت', 'modista'); ?></label>
        <select name="status" id="status" onchange="applyFilter()">
            <option value=""><?php _e('همه وضعیت‌ها', 'modista'); ?></option>
            <option value="open" <?php selected($status, 'open'); ?>><?php _e('باز', 'modista'); ?></option>
            <option value="in_progress" <?php selected($status, 'in_progress'); ?>><?php _e('در انتظار', 'modista'); ?></option>
            <option value="answered" <?php selected($status, 'answered'); ?>><?php _e('پاسخ داده شد', 'modista'); ?></option>
            <option value="closed" <?php selected($status, 'closed'); ?>><?php _e('بسته شده', 'modista'); ?></option>
        </select>
    </div>
    <table class="ticket-table w-100">
        <thead>
            <tr>
                <th><?php _e('شناسه', 'modista'); ?></th>
                <th><?php _e('عنوان', 'modista'); ?></th>
                <th><?php _e('وضعیت', 'modista'); ?></th>
                <th><?php _e('اولویت', 'modista'); ?></th>
                <th><?php _e('دپارتمان', 'modista'); ?></th>
                <th><?php _e('تاریخ ایجاد', 'modista'); ?></th>
                <th><?php _e('اقدام', 'modista'); ?></th>
            </tr>
        </thead>
        <tbody>
            <?php foreach ($tickets as $ticket): ?>
                <tr class="<?php esc_attr_e( $ticket->status ); ?>">
                    <td><?php echo $ticket->id; ?></td>
                    <td><?php echo $ticket->subject; ?></td>
                    <td><?php echo Modista\Modules\Tickets::$field_status[$ticket->status]; ?></td>
                    <td><?php echo Modista\Modules\Tickets::$field_priority[$ticket->priority]; ?></td>
                    <td><?php echo Modista\Modules\Tickets::$field_department[$ticket->department]; ?></td>
                    <td><?php echo mi_date_to_jalali($ticket->created_at, 'Y/m/d-H:i') ?></td>
                    <td class="d-flex gap-4">
                        <?php printf('<a href="%s">%s</a>', esc_url(add_query_arg('ticket', $ticket->id)), 'مشاهده'); ?>
                        <select name="status" id="status" data-ticket-id="<?php echo esc_attr($ticket->id); ?>" onchange="changeTicketStatus(event)">
                            <option value="open" <?php selected($ticket->status, 'open'); ?>><?php _e('باز', 'modista'); ?></option>
                            <option value="in_progress" <?php selected($ticket->status, 'in_progress'); ?>><?php _e('در انتظار', 'modista'); ?></option>
                            <option value="answered" <?php selected($ticket->status, 'answered'); ?>><?php _e('پاسخ داده شد', 'modista'); ?></option>
                            <option value="closed" <?php selected($ticket->status, 'closed'); ?>><?php _e('بسته شده', 'modista'); ?></option>
                        </select>
                    </td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>

    <?php
    // Render pagination
    $total_tickets = count(Modista\Modules\Tickets::get_ticket(['status' => $status]));
    $total_pages = ceil($total_tickets / $per_page);

    if ($total_pages > 1) {
        echo '<div class="modista-tickets__pagination p-2 d-flex gap-2 justify-content-center">';
    
        if ($total_pages <= 6) {
            foreach (range(1, $total_pages) as $i) {
                printf('<a href="%s" class="%s">%d</a>', esc_url(add_query_arg('per_page', $i)), $i == $current_page ? 'active' : '', $i);
            }
        } else {

            printf('<a href="%s" class="%s">1</a>', esc_url(add_query_arg('per_page', 1)), $current_page == 1 ? 'active' : '');
    
            if ($current_page > 3) echo '<span>...</span>';
    
            $start = max(2, $current_page - 1);
            $end = min($total_pages - 1, $current_page + 1);
            foreach (range($start, $end) as $i) {
                printf('<a href="%s" class="%s">%d</a>', esc_url(add_query_arg('per_page', $i)), $i == $current_page ? 'active' : '', $i);
            }
    
            if ($current_page < $total_pages - 2) echo '<span>...</span>';
    
            printf('<a href="%s" class="%s">%d</a>', esc_url(add_query_arg('per_page', $total_pages)), $current_page == $total_pages ? 'active' : '', $total_pages);
        }
    
        echo '</div>';
    }
    ?>
    <script type="text/javascript">
        function applyFilter() {
            var status = document.getElementById('status').value;
            var currentUrl = window.location.href;

            var newUrl = new URL(currentUrl);
            if (status) {
                newUrl.searchParams.set('status', status);
            } else {
                newUrl.searchParams.delete('status');
            }
            
            window.location.href = newUrl.toString();
        }
    </script>
    <?php
    return ob_get_clean();
}

Redux::set_section(
    'modista',
    array(
        'title'  => __('تیکت‌ها', 'modista'),
        'id'     => 'mi_tickets',
        'icon'     => 'el el-comment-alt',
        'fields' => array(
            array(
                'id'       => 'mi_tickets_view',
                'type'     => 'raw',
                'content'  => get_view(),
            ),
        )
    )
);