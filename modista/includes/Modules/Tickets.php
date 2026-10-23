<?php

namespace Modista\Modules;

class Tickets {

    private $wpdb;
    private $charset_collate;

    private $table_tickets_name;
    private $table_messages_name;

    public static $field_status = [
        'open'   => 'باز',
        'in_progress' => 'درحال بررسی',
        'answered'   => 'پاسخ داده شده',
        'closed'   => 'بسته شده',
    ];
    public static $field_priority = [
        'low'   => 'کم',
        'medium' => 'متوسط',
        'high'   => 'زیاد',
        'urgent'   => 'خیلی زیاد',
    ];
    public static $field_department = [
        'support'   => 'پشتیبانی',
        'technical' => 'فنی',
        'finance'   => 'مالی',
    ];

    public function __construct()
    {
        global $wpdb;
        $this->wpdb = $wpdb;
        $this->charset_collate = $wpdb->get_charset_collate();

        $this->table_tickets_name   = $wpdb->prefix . 'mi_tickets';
        $this->table_messages_name  = $wpdb->prefix . 'mi_ticket_messages';

        add_action( 'after_setup_theme', [$this, 'create_tables'] );
        
        // Ajax requests
		add_action('wp_ajax_mi_ticket', [$this, 'ajax_create']);
		add_action('wp_ajax_mi_ticket_reply', [$this, 'ajax_create_message']);
		add_action('wp_ajax_mi_ticket_update', [$this, 'ajax_update_status']);
    }

    // Create required tables of manage the tickets.
    public function create_tables()
    {
        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');        

        $this->check_and_create_tikets_table();
        $this->check_and_create_messages_table();
    }

    // Check and create table of the tickets.
    private function check_and_create_tikets_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_tickets_name} (
                id INT NOT NULL AUTO_INCREMENT,
                user_id INT NOT NULL,
                subject VARCHAR(255),
                department VARCHAR(50),
                status ENUM('open', 'in_progress', 'answered', 'closed') NOT NULL DEFAULT ('open'),
                priority ENUM('low', 'medium', 'high', 'urgent') NOT NULL DEFAULT ('low'),
                product_name VARCHAR(255),
                created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
                updated_at DATETIME DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
                PRIMARY KEY (id)
        ) $this->charset_collate;";

        dbDelta($sql);
    }

    // Check and create table of ticket messages.
    private function check_and_create_messages_table()
    {
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_messages_name} (
            id INT NOT NULL AUTO_INCREMENT,
            ticket_id INT,
            author_id INT,
            message TEXT,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $this->charset_collate;";

        dbDelta($sql);
    }
    
    private function create_ticket( $data = [] )
    {
        $insert_result = $this->wpdb->insert(
            $this->table_tickets_name,
            [
                'user_id'       => $data['user_id'],
                'subject'       => $data['subject'],
                'department'    => $data['department'],
                'status'        => $data['status'] ?? 'open',
                'priority'      => $data['priority'],
                'product_name'  => $data['product_name']
            ]
        );

        if ( $insert_result === false ) {
            error_log(print_r ($this->wpdb->last_error, true) );

            return $insert_result;
        }

        $ticket_id = $this->wpdb->insert_id;
        
        // Create message
        $this->create_ticket_message([
            'ticket_id' => $ticket_id,
            'author_id' => $data['user_id'],
            'message' => $data['message'],
        ]);

        return $ticket_id;
    }

    private function update_ticket($data, $where, $format, $where_format)
    {
        $this->wpdb->update(
            $this->table_tickets_name,
            $data,
            $where,
            $format,
            $where_format
        );

        if ( $this->wpdb->last_error ) {

            error_log(print_r ($this->wpdb->last_error, true) );
            return false;
        }
        
        return true;
    }

    private function create_ticket_message( $data = [] )
    {
        $insert_result = $this->wpdb->insert(
            $this->table_messages_name,
            [
                'ticket_id' => $data['ticket_id'],
                'author_id' => $data['author_id'],
                'message'   => $data['message']
            ]
        );

        if ( $insert_result === false ) {
            error_log(print_r ($this->wpdb->last_error, true) );
        }

        $this->wpdb->insert_id;
    }

    public static function get_ticket( $where = [], $limit = 30, $offset = 0 )
    {
        global $wpdb;
        $table_tickets_name = $wpdb->prefix . 'mi_tickets';

        $conditions = [];
        $values = [];

        if (!empty($where['id'])) {
            $conditions[] = "id = %d";
            $values[] = $where['id'];
        }
        if (!empty($where['user_id'])) {
            $conditions[] = "user_id = %d";
            $values[] = $where['user_id'];
        }
        if (!empty($where['status'])) {
            $conditions[] = "status = %s";
            $values[] = $where['status'];
        }
        if (!empty($where['priority'])) {
            $conditions[] = "priority = %s";
            $values[] = $where['priority'];
        }
        if (!empty($where['department'])) {
            $conditions[] = "department = %s";
            $values[] = $where['department'];
        }

        $where_sql = !empty($conditions) ? "WHERE " . implode(" AND ", $conditions) : "";
        
        // Filter columns
        $discount = "*";
        if (!empty($where['discount'])) {
            $discount = implode(',', $where['discount']);
        }

        // Apply LIMIT and OFFSET for Pagination
        $limit_sql = "LIMIT %d OFFSET %d";
        $values[] = $limit;
        $values[] = $offset;

        return $wpdb->get_results(
            $wpdb->prepare(
                "SELECT {$discount} FROM {$table_tickets_name} {$where_sql} ORDER BY created_at DESC {$limit_sql}",
                ...$values
            )
        );
    }

    // Get status of the user tickets
    public static function get_ticket_statuses( $current_user_id = 0 )
    {
        if ( $current_user_id == 0 )
        {
            $current_user_id = get_current_user_id();
        }

        $tickets = self::get_ticket(['user_id' => $current_user_id, 'discount' => ['status']]);
        $ticket_status_count = [
            'all' => count($tickets)
        ];

        foreach ($tickets as $ticket) {
            $ticket_status_count[$ticket->status] = ($ticket_status_count[$ticket->status] ?? 0) + 1;
        }

        return $ticket_status_count;
    }

    public static function get_ticket_message( $where = [] )
    {
        global $wpdb;
        $table_tickets_name   = $wpdb->prefix . 'mi_ticket_messages';

        $conditions = [];
        $values     = [];

        if ( !empty( $where['ticket_id'] ) ) {
            $conditions[] = "ticket_id = %d";
            $values[] = $where['ticket_id'];
        }

        $where_sql = !empty( $conditions ) ? "WHERE " . implode(" AND ", $conditions) : "";

        return $wpdb->get_results(
            $wpdb->prepare(
                "SELECT * FROM {$table_tickets_name} {$where_sql} ORDER BY created_at ASC",
                ...$values
            )
        );
    }

    public function ajax_create()
    {
        $required_fields = ['subject', 'department', 'priority', 'message', 'product_name'];
        
        foreach ($required_fields as $field) {

            if ( empty($_POST) || !array_key_exists($field, $_POST) ) {
                wp_send_json_error( ['message' => "all fields is required."] );
            } else {
                switch ($field) {
                    case 'department':
                        if ( !array_key_exists($_POST[$field], self::$field_department)) {
                            wp_send_json_error( ['message' => "invalid department value."] );
                        }                        
                        break;
                    case 'priority':
                        if ( !array_key_exists($_POST[$field], self::$field_priority)) {
                            wp_send_json_error( ['message' => "invalid priority value."] );
                        }
                        break;
                    case 'subject':
                    case 'message':
                        if ( empty($_POST[$field]) ) {
                            wp_send_json_error( ['message' => "all fields is required."] );
                        }
                        break;
                }

                $data[$field] = sanitize_text_field( $_POST[$field] );
            }
        }

        $data['user_id'] = get_current_user_id();

        // Create ticket
        $ticekt_id = $this->create_ticket($data);

        wp_send_json_success([
            'message'   => "ticket created.",
            'redirect'  => esc_url( wc_get_account_endpoint_url('tickets') ) . $ticekt_id . '/'
        ]);
    }

    public function ajax_update_status()
    {
        $required_fields = ['ticket_id', 'status'];
        
        foreach ($required_fields as $field) {

            if ( empty($_POST) || !array_key_exists($field, $_POST) ) {
                wp_send_json_error( ['message' => "all fields is required."] );
            }
        }

        if ( !array_key_exists($_POST['status'], self::$field_status) ) wp_send_json_error( ['message' => "Invalid status."] );

        // Update ticket
        $result = $this->update_ticket(['status' => $_POST['status']], ['id' => $_POST['ticket_id']], ['%s'], ['%d']);

        if ($result) {
            wp_send_json_success([
                'message'   => "ticket updated."
            ], 201);
        } else {
            wp_send_json_error([], 201);
        }
        
    }

    public function ajax_create_message()
    {
        $required_fields = ['ticket_id', 'message'];
        
        foreach ($required_fields as $field) {

            if ( empty($_POST) || !array_key_exists($field, $_POST) || empty($_POST[$field]) ) {
                wp_send_json_error( ['message' => "all fields is required."] );
            } else {
                $data[$field] = sanitize_text_field( $_POST[$field] );
            }
        }

        $user = wp_get_current_user();

        $is_owner_ticket = $this->get_ticket(['user_id' => $user->ID, 'id' => $data['ticket_id']]);

        $allowed_roles = array( 'editor', 'administrator', 'author' );
        if ( !$is_owner_ticket && !array_intersect( $allowed_roles, $user->roles ) ) {
            wp_send_json_error( ['message' => "Access Denied."] );
        }

        // Create message
        $this->create_ticket_message([ 
            'ticket_id' => $data['ticket_id'],
            'author_id' => $user->ID,
            'message'   => $data['message'],
        ]);

        wp_send_json_success( ['message' => "message created."] );
    }
}