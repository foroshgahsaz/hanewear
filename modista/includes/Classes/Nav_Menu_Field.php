<?php

namespace Modista\Classes;

defined('ABSPATH') || exit; // Exit if accessed directly.

class Nav_Menu_Field
{
    public function __construct()
    {
        add_action('wp_nav_menu_item_custom_fields', [$this, 'render_nav_menu_item'], 10, 3);
        add_action('wp_update_nav_menu_item', [$this, 'update_nav_menu_item'], 10, 3);
    }

    /**
     * Add custom setting fields for mega-menu.
     *
     * @param $item_id
     * @param $item
     * @param $depth
     * @return void|null
     */
    public function render_nav_menu_item($item_id, $item, $depth)
    {
        // Show for parent items
        if ( $depth > 1 ) return null;

        $mega_menu_status = get_post_meta($item_id , '_menu_item_mega_menu_status', true);
        $mega_menu_selected_id = get_post_meta($item_id , '_menu_item_mega_menu_selected', true);
        $mega_menu_type = get_post_meta($item_id , '_menu_item_mega_menu_type', true);
        $menu_icon_url = get_post_meta($item_id, '_menu_item_icon', true);

        // Set banner for default menu and item 0 depth.
        $menu_banner_src = get_post_meta($item_id, '_menu_item_banner', true);
        $menu_banner_url = get_post_meta($item_id, '_menu_item_banner_url', true);

        // gallery reapeter fields
        $menu_gallery_images = get_post_meta($item_id, '_menu_item_gallery', true); // Retrieve existing gallery images
        $menu_gallery_links = get_post_meta($item_id, '_menu_item_gallery_links', true); // Retrieve existing gallery images

        // Gallery carousel
        $menu_gallery_carouel_images = get_post_meta($item_id, '_menu_item_gallery_carouel', true); // Retrieve existing gallery images
        $menu_gallery_carouel_links = get_post_meta($item_id, '_menu_item_gallery_carouel_links', true); // Retrieve existing gallery images

        // Get elementor sections
        $section_list = get_posts( [
            'numberposts'      => -1,
            'post_type'        => 'modista_library',
        ] ); ?>

        <div class="mi-field-group p-2">
            <hr>
            <div class="mi-media-select-image">
                <div class="d-flex gap-2 align-items-end">
                    <p class="description description-wide flex-1">
                        <label for="edit-menu-item-icon-<?php echo $item_id; ?>">
                            <?php _e('آیکون منو', 'modista'); ?>
                            <span class="description"><?php _e('(فقط فرمت svg مجاز است)', 'modista'); ?></span>
                            <br/>
                            <input type="text" id="edit-menu-item-icon-<?php echo $item_id; ?>" class="widefat" name="_menu_item_icon[<?php echo $item_id; ?>]" value="<?php echo esc_attr($menu_icon_url); ?>" />
                        </label>
                    </p>
                    <p class="description description-wide">
                        <button class="button" id="edit-menu-item-icon-button-<?php echo $item_id; ?>" ><?php _e('آپلود از کتابخانه', 'modista'); ?></button>
                        <br>
                    </p>
                </div>
            </div>
            <hr>
            <?php if ( $depth == 0 ) : ?>
            <p class="description description-wide">
                <label for="edit-menu-item-mega-menu-status-<?php echo esc_attr($item_id) ?>">
                    <input type="checkbox" class="widefat" id="edit-menu-item-mega-menu-status-<?php echo esc_attr($item_id) ?>"
                           name="_menu_item_mega_menu_status[<?php echo esc_attr($item_id) ?>]" <?php checked($mega_menu_status, 1) ?>>
                    <?php echo __('قابلیت مگامنو', 'modista') ?>
                </label>
            </p>
            <p class="description description-wide">
                <label for="edit-menu-item-mega-menu-type-<?php echo esc_attr($item_id) ?>">
                    <?php echo __('نوع مگامنو را انتخاب کنید', 'modista') ?>
                    <br>
                    <select name="_menu_item_mega_menu_type[<?php echo esc_attr($item_id) ?>]" class="widefat" id="edit-menu-item-mega-menu-type-<?php echo esc_attr($item_id) ?>">
                        <option value=""><?php esc_html_e('انتخاب کنید', 'modista') ?></option>
                        <option value="default" <?php echo selected($mega_menu_type, 'default') ?>><?php esc_html_e('پیشفرض', 'modista') ?></option>
                        <option value="elementor" <?php echo selected($mega_menu_type, 'elementor') ?>><?php esc_html_e('المنتور', 'modista') ?></option>
                    </select>
                    <span class="description"><?php _e('مگامنو پیشفرض از طرح مگامنو پیشفرض قالب استفاده میکند.', 'modista'); ?></span>
                </label>
            </p>
            <hr>
            <p class="description description-wide">
                <label for="edit-menu-item-mega-menu-list-<?php echo esc_attr($item_id) ?>">
                    <?php echo __('سکشن مگامنو را انتخاب کنید', 'modista') ?>
                    <select name="_menu_item_mega_menu_selected[<?php echo esc_attr($item_id) ?>]" class="widefat" id="edit-menu-item-mega-menu-list-<?php echo esc_attr($item_id) ?>">
                        <option value=""><?php esc_html_e('انتخاب کنید', 'modista') ?></option>
                        <?php
                        foreach ($section_list as $section) :
                        echo '<option value="' . esc_attr($section->ID) . '"  ' . selected($mega_menu_selected_id, $section->ID) .  ' >' . esc_attr($section->post_title) . '</option>';
                        endforeach;
                        ?>
                    </select>
                    <span class="description"><?php _e('از لیست سکشن ها مگامنو را انتخاب کنید.', 'modista'); ?></span>
                </label>
            </p>
            <hr>
            <div class="mi-media-select-image">
                <div class="d-flex gap-2 align-items-end">
                    <p class="description description-wide flex-1">
                        <label for="edit-menu-item-banner-<?php echo $item_id; ?>">
                            <?php _e('بنر منو', 'modista'); ?>
                            <span class="description"><?php _e('(فقط فرمت svg مجاز است)', 'modista'); ?></span>
                            <br/>
                            <input type="text" id="edit-menu-item-banner-<?php echo $item_id; ?>" class="widefat" name="_menu_item_banner[<?php echo $item_id; ?>]" value="<?php echo esc_attr($menu_banner_src); ?>" />
                        </label>
                    </p>
                    <p class="description description-wide">
                        <button class="button" id="edit-menu-item-icon-banner-<?php echo $item_id; ?>"><?php _e('آپلود از کتابخانه', 'modista'); ?></button>
                        <br>
                    </p>
                </div>                    
            </div>                                
            <p class="description description-wide">
                <label for="edit-menu-item-banner-url-<?php echo $item_id; ?>">
                    <?php _e('لینک بنر منو', 'modista'); ?><br />
                    <input type="text" id="edit-menu-item-banner-url-<?php echo $item_id; ?>" class="widefat" name="_menu_item_banner_url[<?php echo $item_id; ?>]" value="<?php echo esc_attr($menu_banner_url); ?>" />
                </label>
            </p>
            <hr>
            <?php 
            // Render Mega menu repeater carousel image
            $this->field_carouel_image_repeater( $item_id, '_menu_item_gallery_carouel', $menu_gallery_carouel_images, $menu_gallery_carouel_links, 'تصاویر گردونه مگامنو:' );
            echo '<hr>';
            // Render Mega menu repeater image
            $this->field_carouel_image_repeater( $item_id, '_menu_item_gallery', $menu_gallery_images, $menu_gallery_links, 'گالری تصاویر مگامنو:' );
            ?>
            <?php endif; ?>        
        </div>
        <?php
    }

    // Update custom fields
    public function update_nav_menu_item($menu_id, $menu_item_db_id)
    {
        // Save mega menu status
        if ( isset( $_POST['_menu_item_mega_menu_status'][$menu_item_db_id] ) ) {
            update_post_meta($menu_item_db_id, '_menu_item_mega_menu_status', 1);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_mega_menu_status');
        }
        // Save mega menu type
        if ( isset( $_POST['_menu_item_mega_menu_type'][$menu_item_db_id] ) ) {
            $sanitized_text = sanitize_text_field($_POST['_menu_item_mega_menu_type'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_mega_menu_type', $sanitized_text);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_mega_menu_type');
        }
        // Save selected mega menu
        if ( isset( $_POST['_menu_item_mega_menu_selected'][$menu_item_db_id] ) ) {
            $sanitized_text = sanitize_text_field($_POST['_menu_item_mega_menu_selected'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_mega_menu_selected', $sanitized_text);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_mega_menu_selected');
        }
        /**
         * Saved menu icon url.
         * Just saved .svg format
         */
        if (isset($_POST['_menu_item_icon'][$menu_item_db_id])) {
            $icon_url = sanitize_text_field($_POST['_menu_item_icon'][$menu_item_db_id]);

            // Check format and save
            if ( strpos($icon_url, '.svg') !== false ) {
                update_post_meta($menu_item_db_id, '_menu_item_icon', $icon_url);
            }
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_icon');
        }
        /**
         * Saved menu banner src.
         * for 0 depth items
         */
        if (isset($_POST['_menu_item_banner'][$menu_item_db_id])) {
            $url = sanitize_text_field($_POST['_menu_item_banner'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_banner', $url);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_banner');
        }
        /**
         * Saved menu banner Uri.
         * for 0 depth items.
         */
        if (isset($_POST['_menu_item_banner_url'][$menu_item_db_id])) {
            $url = sanitize_text_field($_POST['_menu_item_banner_url'][$menu_item_db_id]);
            update_post_meta($menu_item_db_id, '_menu_item_banner_url', $url);
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_banner_url');
        }

        /**
         * Save Aside Banners
         * for 0 depth items.
         */
        if (isset($_POST['_menu_item_gallery'][$menu_item_db_id])) {
            $url = sanitize_text_field($_POST['_menu_item_gallery'][$menu_item_db_id]);

            update_post_meta($menu_item_db_id, '_menu_item_gallery', array_map('esc_url', $_POST['_menu_item_gallery'][$menu_item_db_id]));
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_gallery');
        }
        // Save Aside Banners Links
        if (isset($_POST['_menu_item_gallery_links'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_menu_item_gallery_links', array_map('esc_url', $_POST['_menu_item_gallery_links'][$menu_item_db_id]));
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_gallery_links');
        }

         /**
         * Save Aside Carouel Banners
         * for 0 depth items.
         */
        if (isset($_POST['_menu_item_gallery_carouel'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_menu_item_gallery_carouel', array_map('esc_url', $_POST['_menu_item_gallery_carouel'][$menu_item_db_id]));
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_gallery_carouel');
        }
        // Save Aside Carouel Banners Links
        if (isset($_POST['_menu_item_gallery_carouel_links'][$menu_item_db_id])) {
            update_post_meta($menu_item_db_id, '_menu_item_gallery_carouel_links', array_map('esc_url', $_POST['_menu_item_gallery_carouel_links'][$menu_item_db_id]));
        } else {
            delete_post_meta($menu_item_db_id, '_menu_item_gallery_carouel_links');
        }
    }

    // Add item to gallery image type repeater
    private function field_carouel_image_repeater($item_id, $item_name, $images, $links, $section_title)
    {
        ?>
        <div class="mi-media-select-image-repeater mi-filed-group" data-id="<?php echo esc_attr( $item_id ); ?>" data-name="<?php echo esc_attr( $item_name ); ?>">
            <label><?php echo $section_title ?></label>
            <ul class="menu-gallery-list bg-white">
                <?php if ( is_array($images) && !empty($images) ) : ?>

                    <?php foreach ($images as $index => $image_url) : ?>
                        <li class="d-flex align-items-center gap-2 p-3">
                            <img src="<?php echo esc_url($image_url); ?>" width="50" height="50" style="object-fit:contain;">
                            <input type="hidden" name="<?php echo $item_name; ?>[<?php echo $item_id; ?>][<?php echo $index; ?>]" 
                            value="<?php echo esc_url($image_url); ?>">
                            <input type="text" class="flex-1" name="<?php echo $item_name; ?>_links[<?php echo $item_id; ?>][<?php echo $index; ?>]"
                            value="<?php echo isset($links[$index]) ? esc_url($links[$index]) : ''; ?>" placeholder="لینک تصویر">
                            <button type="button" class="remove-gallery-image">×</button>
                        </li>                        
                    <?php endforeach; ?>

                <?php endif; ?>
            </ul>
            <div>
                <button type="button" class="button upload-gallery-image" data-id="<?php echo $item_id; ?>"><?php _e('افزودن تصویر', 'modista'); ?></button>
            </div>
        </div>
        <?php
    }
}