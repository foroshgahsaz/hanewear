<?php
/**
 * Show options for ordering
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/loop/orderby.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see         https://woocommerce.com/document/template-structure/
 * @package     WooCommerce\Templates
 * @version     9.7.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

?>
<form class="woocommerce-ordering" method="get">
    <select name="orderby" class="orderby" aria-label="<?php esc_attr_e('Shop order', 'woocommerce'); ?>" style="display: none;">
		<?php foreach ($catalog_orderby_options as $id => $name) : ?>
            <option value="<?php echo esc_attr($id); ?>" <?php selected($orderby, $id); ?>><?php echo esc_html($name); ?></option>
		<?php endforeach; ?>
    </select>

    <div class="mi-orderby cursor-pointer position-relative fw-400 ">
        <div class="selected-option d-flex align-items-center justify-content-center gap-2 rounded-3 px-4 px-md-6 py-2">
            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                <path opacity="0.4" d="M16.19 2H7.81C4.17 2 2 4.17 2 7.81V16.18C2 19.83 4.17 22 7.81 22H16.18C19.82 22 21.99 19.83 21.99 16.19V7.81C22 4.17 19.83 2 16.19 2Z" fill="#737373"/>
                <path d="M18 8.5H6C5.59 8.5 5.25 8.16 5.25 7.75C5.25 7.34 5.59 7 6 7H18C18.41 7 18.75 7.34 18.75 7.75C18.75 8.16 18.41 8.5 18 8.5Z" fill="#737373"/>
                <path d="M16 12.75H8C7.59 12.75 7.25 12.41 7.25 12C7.25 11.59 7.59 11.25 8 11.25H16C16.41 11.25 16.75 11.59 16.75 12C16.75 12.41 16.41 12.75 16 12.75Z" fill="#737373"/>
                <path d="M13.3299 17H10.6599C10.2499 17 9.90991 16.66 9.90991 16.25C9.90991 15.84 10.2499 15.5 10.6599 15.5H13.3299C13.7399 15.5 14.0799 15.84 14.0799 16.25C14.0799 16.66 13.7499 17 13.3299 17Z" fill="#737373"/>
            </svg>
            <span class="d-none d-md-block"><?php echo ($orderby === 'menu_order') ? 'مرتب سازی' : preg_replace('/مرتب‌سازی /', '', $catalog_orderby_options[$orderby]) ?></span>
        </div>
        <div class="options position-absolute rounded-3 overflow-hidden">
			<?php
            // Render each order
            foreach ($catalog_orderby_options as $id => $name) :
                // Remove `order by` of first of the text
                $name = ($id === 'menu_order') ? 'مرتب سازی' : preg_replace('/مرتب‌سازی /', '', $name);
                ?>
                <div class="option" <?php selected($orderby, $id); ?> data-value="<?php echo esc_attr($id); ?>"><?php echo esc_html($name); ?></div>
			<?php endforeach; ?>
        </div>
    </div>

    <input type="hidden" name="paged" value="1" />
	<?php wc_query_string_form_fields(null, array('orderby', 'submit', 'paged', 'product-page')); ?>
</form>