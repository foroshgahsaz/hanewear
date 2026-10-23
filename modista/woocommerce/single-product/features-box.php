<?php
/**
 * Features box
 *
 * @package Modista
 * @version 1.0.0
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}

global $redux_mi_theme;

if ( !is_array($redux_mi_theme) || !array_key_exists('single_product_features', $redux_mi_theme) || empty($redux_mi_theme['single_product_features']) ) {
	return;
}

?>
<ul class="d-flex flex-md-nowrap justify-content-evenly mi-features-box mt-8 p-4 rounded-6 gap-row-3">
		<?php foreach ($redux_mi_theme['single_product_features']['redux_repeater_data'] as $key => $box) : ?>
		<li class="mi-features-box__item align-items-center d-flex flex-md-column flex-row gap-2 justify-content-between">
			<img src="<?php echo esc_url($redux_mi_theme['single_product_feature_icon'][ $key ]['url']); ?>" alt="<?php echo esc_html($redux_mi_theme['single_product_feature_title'][ $key ]); ?>">
			<span><?php echo esc_html($redux_mi_theme['single_product_feature_title'][ $key ]); ?></span>
		</li>
	<?php endforeach; ?>
</ul>