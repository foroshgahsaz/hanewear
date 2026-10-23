<?php

namespace Modista\Modules;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Notification {

    private $table_name;
    private $opt_name = "modista";

    public $notifications_types = [
        'info',
        'notice',
        'error',
    ];

    public function __construct()
    {
        global $wpdb;
        $this->table_name = $wpdb->prefix . "mi_notifications";
        
        add_action('after_setup_theme', [$this, 'check_and_create_table']);
        add_action('redux/options/' . $this->opt_name . '/saved', [$this, 'save_notification']);
    }

    // Create table of manage notification
    public function check_and_create_table()
    {
        global $wpdb;
        $charset_collate = $wpdb->get_charset_collate();
        
        $sql = "CREATE TABLE IF NOT EXISTS {$this->table_name} (
            id MEDIUMINT NOT NULL AUTO_INCREMENT,
            title VARCHAR(255) NOT NULL,
            message TEXT NOT NULL,
            type INT NOT NULL,
            created_at DATETIME DEFAULT CURRENT_TIMESTAMP,
            PRIMARY KEY (id)
        ) $charset_collate;";

        require_once(ABSPATH . 'wp-admin/includes/upgrade.php');
        dbDelta($sql);
    }

    // Save notification to custom table
    public function save_notification($options)
    {
        global $wpdb;

        if ( isset($options['notification_text']) && !empty($options['notification_text']) ) {
            $notification_IDs = [];

            $notification_count = 0;
            foreach ($options['notification_text'] as $message) {

                $message = sanitize_text_field($message);
                $title = sanitize_text_field($options['notification_title'][$notification_count]);
    
                $id = isset($options['notification_id'][$notification_count]) ? (int) $options['notification_id'][$notification_count] : 0;
                $type = isset($options['notification_type'][$notification_count]) ? (int) $options['notification_type'][$notification_count] : 0;
    
                if ($id) {
                    $wpdb->update(
                        $this->table_name,
                        ['message' => $message, 'type' => $type, 'title' => $title],
                        ['id' => $id]
                    );
                    $notification_IDs[] = $id;
                } else {
                    $insert_status = $wpdb->insert($this->table_name, ['message' => $message, 'type' => $type, 'title' => $title]);
                    if ($insert_status === 1) {
                        $notification_IDs[] = $wpdb->insert_id;
                    }
                }
    
                $notification_count++;
            }

            if (!empty($notification_IDs)) {
                $placeholders = implode(',', array_fill(0, count($notification_IDs), '%d'));
                $sql = $wpdb->prepare("DELETE FROM $this->table_name WHERE id NOT IN ($placeholders)", ...$notification_IDs);
                $wpdb->query($sql);
            }

            \Redux::set_option($this->opt_name, 'notification_id', $notification_IDs);
        } else {
            $wpdb->query("DELETE FROM $this->table_name WHERE 1");
        }
    }

    public function get_notifications() {
        global $wpdb;
        return $wpdb->get_results("SELECT * FROM {$this->table_name} ORDER BY created_at DESC");
    }
}