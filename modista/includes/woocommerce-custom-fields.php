<?php
/**
 * Custom fiels
 * 
 * Add custom fileds to woocommerce.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

// Add fields for `color` attributes.
add_action('pa_color_add_form_fields', 'pa_color_add_form_fields_action');
// Edit fields for `color` attributes.
add_action( 'pa_color_edit_form_fields', 'pa_color_edit_form_fields_action' );
// Create or update fields for `color` attributes.
add_action('created_pa_color', 'save_pa_color_action', 10, 2);
add_action('edited_pa_color', 'save_pa_color_action', 10, 2);

// Add fields for `brand` attributes.
add_action('pa_brand_add_form_fields', 'pa_brand_add_form_fields_action');
// Edit fields for `brand` attributes.
add_action( 'pa_brand_edit_form_fields', 'pa_brand_edit_form_fields_action' );
// Create or update  fields for `brand` attributes.
add_action('created_pa_brand', 'save_pa_brand_action', 10, 2);
add_action('edited_pa_brand', 'save_pa_brand_action', 10, 2);

/**
 * Create or update  fields for `size` attributes.
 * size help fields
 */
add_action( 'pa_size_add_form_fields', 'mi_pa_size_add_form_fields_action', 30 );
add_action( 'pa_size_edit_form_fields', 'mi_pa_size_edit_form_fields_action', 30 );
// Create or update  fields for `size` attributes.
add_action('created_pa_size', 'save_pa_size_action', 10, 2);
add_action('edited_pa_size', 'save_pa_size_action', 10, 2);
add_action('woocommerce_after_edit_attribute_fields', 'mi_add_size_help_note');
add_action('woocommerce_attribute_added', 'mi_save_size_help_note');
add_action('woocommerce_attribute_updated', 'mi_save_size_help_note');

function pa_color_add_form_fields_action( $term ) {
	?>
	<div class="form-field term-color-wrap">
		<label for="pa_color"><?php echo __( 'کد رنگ', 'modista' ) ?></label>
		<input type="text" name="pa_color" id="pa_color" value="" placeholder="#FFF"/>
		<p id="description"><?php _e( 'بهتر است از کد رنگ نوع "HEX" استفاده کنید.', 'modista' ) ?></p>
	</div>
	<?php
}
function pa_color_edit_form_fields_action( WP_Term $term ) {

	$color_value = get_term_meta( $term->term_id, 'pa_color', true );
	?>
	<tr class="form-field term-color-wrap">
		<th scope="row"><label for="pa_color"><?php echo __( 'کد رنگ', 'modista' ) ?></label></th>
		<td>
			<input type="text" name="pa_color" id="pa_color" value="<?php echo $color_value ?>" placeholder="#FFF"/>
			<p id="description"><?php _e( 'بهتر است از کد رنگ نوع "HEX" استفاده کنید.', 'modista' ) ?></p>
		</td>
	</tr>
	<?php
}
function save_pa_color_action( $term_id, $taxonomy ) {
	if ( isset($_POST['pa_color']) && ! empty($_POST['pa_color']) ) {
		$value = sanitize_text_field($_POST['pa_color']);
		update_term_meta($term_id, 'pa_color', $value);
	}
}

function pa_brand_add_form_fields_action( $taxonomy ) {
	?>
	<div class="form-field term-brand-wrap">
		<label for="pa_logo_src"><?php _e( 'آدرس لوگو برند', 'modista' ) ?></label>
		<div class="mi-media-select-image" style="display: flex; align-items: center; gap: 10px;">
			<input type="text" name="pa_logo_src" id="pa_logo_src" value="">
			<button class="button"><?php _e( 'انتخاب لوگو', 'modista' ) ?></button>
		</div>
		<p id="description"><?php _e( 'برای نمایش بهتر، میتوانید لوگو هر برند را قرار دهید.', 'modista' ) ?></p>
	</div>
	<?php
}
function pa_brand_edit_form_fields_action( WP_Term $term ) {

    $src = get_term_meta($term->term_id, 'pa_logo_src', true);
	?>
	<tr class="form-field term-brand-wrap">
		<th scope="row">
            <label for="pa_logo_src"><?php _e( 'آدرس لوگو برند', 'modista' ) ?></label>
		</th>
		<td>
            <div class="mi-media-select-image" style="display: flex; align-items: center; gap: 10px;">
                <input type="text" name="pa_logo_src" id="pa_logo_src" value="<?php echo esc_attr($src); ?>">
                <button class="button"><?php _e( 'انتخاب لوگو', 'modista' ) ?></button>
            </div>
			<p id="description"><?php _e( 'برای نمایش بهتر، میتوانید لوگو هر برند را قرار دهید.', 'modista' ) ?></p>
		</td>
	</tr>
	<?php
}
function save_pa_brand_action( $term_id, $taxonomy ) {
	if ( isset($_POST['pa_logo_src']) && ! empty($_POST['pa_logo_src']) ) {
		$value = sanitize_text_field($_POST['pa_logo_src']);
		update_term_meta($term_id, 'pa_logo_src', $value);
	}
}

function mi_pa_size_add_form_fields_action( $taxonomy ) {

	$fields = [
		'pa_height' => [
			'label' => __( 'قد', 'modista' ),
			'description' => '',
		],
		'pa_waist' => [
			'label' => __( 'دور کمر', 'modista' ),
			'description' => '',
		],
		'pa_hips' => [
			'label' => __( 'دور باسن', 'modista' ),
			'description' => '',
		],
		'pa_thigh' => [
			'label' => __( 'دور ران', 'modista' ),
			'description' => '',
		]
	];
	?>

	<hr>
	<div class="form-field term-color-wrap">
		<label><?php echo __( 'راهنمای سایز', 'modista' ) ?></label>
		<p id="description"><?php _e( 'در صفحه محصول جهت راهنمایی سایز ها نمایش داده میشود نمایش داده میشود.', 'modista' ) ?></p>
	</div>
	<?php foreach ($fields as $field => $data): ?>
		<div class="form-field term-<?php echo $field ?>-wrap">
			<label for="<?php echo $field ?>"><?php echo $data['label']; ?></label>
			<input type="text" name="<?php echo $field; ?>" id="<?php echo $field; ?>" />
			<p id="description"><?php echo $data['description']; ?></p>
		</div>
    <?php
	endforeach;
}
function mi_pa_size_edit_form_fields_action( WP_Term $term ) {

	$fields = [
		'pa_height' => [
			'label' => __( 'قد', 'modista' ),
			'description' => '',
		],
		'pa_waist' => [
			'label' => __( 'دور کمر', 'modista' ),
			'description' => '',
		],
		'pa_hips' => [
			'label' => __( 'دور باسن', 'modista' ),
			'description' => '',
		],
		'pa_thigh' => [
			'label' => __( 'دور ران', 'modista' ),
			'description' => '',
		]
	];
	?>
	<tr class="form-field term-size-help-wrap">
		<th scope="row"><label><?php echo __( 'راهنمای سایز', 'modista' ) ?></label></th>
		<td><p id="description"><?php _e( 'در صفحه محصول جهت راهنمایی سایز ها نمایش داده میشود نمایش داده میشود.', 'modista' ) ?></p></td>
	</tr>

	<?php foreach ($fields as $field => $data):

		$value = get_term_meta( $term->term_id, $field, true );
    	?>    
		<tr class="form-field term-<?php echo $field ?>-wrap">
			<th scope="row"><label for="<?php echo $field ?>"><?php echo $data['label'] ?></label></th>
			<td>
				<input type="text" name="<?php echo $field ?>" id="<?php echo $field ?>"
				 value="<?php echo esc_attr( $value ); ?>" />
				<p id="description"><?php echo $data['description'] ?></p>
			</td>
		</tr>
    <?php
	endforeach;
}
function save_pa_size_action( $term_id, $taxonomy ) {

	$fields = [
		'pa_height',
		'pa_waist',
		'pa_hips',
		'pa_thigh',
	];

	foreach ($fields as $field) {
		if ( isset($_POST[$field]) && ! empty($_POST[$field]) ) {
			$value = sanitize_text_field($_POST[$field]);
			update_term_meta($term_id, $field, $value);
		}
	}
}
function mi_add_size_help_note() {

	$attribute_id = isset($_GET['edit']) ? intval($_GET['edit']) : 0;
	
	if (!$attribute_id) {
		return;
	}

	$attribute = wc_get_attribute($attribute_id);

	if (empty($attribute) || $attribute->slug !== 'pa_size') {
		return;
	}

	$value = $attribute_id ? get_option( "wc_attribute_pa_size_note-$attribute_id" ) : '';

	?>
	<tr class="form-field term-size-help-note-wrap">
		<th scope="row">
			<label for="wc_attribute_pa_size_note"><?php echo __( 'توضیحات بخش سایز', 'modista' ); ?></label>
		</th>
		<td>
			<?php
			$editor_id = 'wc_attribute_pa_size_note';
			$settings = array(
				'textarea_name' => 'wc_attribute_pa_size_note',
				'media_buttons' => false,
				'tinymce'       => true,
				'quicktags'     => true,
				'textarea_rows' => 8,
			);

			wp_editor( $value, $editor_id, $settings );
			?>
			<p class="description"><?php echo __( 'نکات و مواردی در بخش سایز ها (در حال حاضر فقط در بخش مودال صفحه تکی محصول اضافه میشود.)', 'modista' ); ?></p>
		</td>

	</tr>
	<?php
}
function mi_save_size_help_note( $attribute_id ) {

	if ( is_admin() ) {
        if ( isset( $_POST['wc_attribute_pa_size_note'] ) && !empty($_POST['wc_attribute_pa_size_note']) ) {
				update_option( "wc_attribute_pa_size_note-$attribute_id", wp_kses_post( $_POST['wc_attribute_pa_size_note'] ) );
        } else {
            delete_option( "wc_attribute_pa_size_note-$attribute_id" ); // حذف مقدار در صورت خالی بودن
        }
    }
}
