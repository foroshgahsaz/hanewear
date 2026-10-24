<?php

namespace Hanewear\Core\Elementor\Widgets;

use Hanewear\Core\Product_Query_Helper;

defined( 'ABSPATH' ) || exit;

/**
 * Extends Modista product card — only overrides product query in render().
 */
class Woo_Product_Card extends \Modista\Widgets\Woo_Product_Card {

	protected function render() {
		$settings = $this->get_settings_for_display();
		$args     = Product_Query_Helper::build_product_query_args( $settings );

		$this->add_render_attribute( 'card_classes', 'class', 'mi-product-card__item' );
		if ( $settings['card_height_equal'] === 'yes' ) {
			$this->add_render_attribute( 'card_classes', 'class', 'h-auto' );
		}

		$products = new \WP_Query( $args );
		if ( $products->have_posts() ) :
			?>
			<div class="mi-product-card">
				<div class="mi-product-card-wrapper d-flex flex-row">
					<?php
					while ( $products->have_posts() ) :
						$products->the_post();
						?>
						<div <?php echo $this->get_render_attribute_string( 'card_classes' ); ?>>
							<div class="mi-product-card__item-link d-flex flex-column">
								<div class="mi-product-card__image">
									<a href="<?php the_permalink(); ?>">
										<?php woocommerce_template_loop_product_thumbnail(); ?>
									</a>
									<?php
									if ( 'yes' === $settings['content_enable_gallery'] ) {
										$this->echo_product_galley();
									}
									?>
								</div>
								<div class="mi-product-card__content d-flex flex-column flex-1">
									<a href="<?php the_permalink(); ?>" class="mi-product-card__title fs-4 fw-600">
										<?php the_title(); ?>
									</a>
									<?php woocommerce_template_loop_price(); ?>
								</div>
							</div>
						</div>
					<?php endwhile; ?>
				</div>
			</div>
			<?php
			wp_reset_postdata();
		endif;
	}
}
