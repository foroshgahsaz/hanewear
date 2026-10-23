<?php
/**
 * Mini-cart
 *
 * Contains the markup for the mini-cart, used by the cart widget.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/cart/mini-cart.php.
 *
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://woocommerce.com/document/template-structure/
 * @package WooCommerce\Templates
 * @version 10.0.0
 */

defined( 'ABSPATH' ) || exit;

global $woocommerce;

if ( $woocommerce->cart && ! $woocommerce->cart->is_empty() ) : ?>

	<ul class="woocommerce-mini-cart product-list-widget mi-mini-cart-list <?php echo esc_attr( $args['list_class'] ); ?>"> <?php
		foreach ( $woocommerce->cart->get_cart() as $cart_item_key => $cart_item ) {
			$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
			$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

			if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_widget_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
				/**
				 * This filter is documented in woocommerce/templates/cart/cart.php.
				 *
				 * @since 2.1.0
				 */
				$ID                 = $_product->get_ID();
				$product_name       = apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key );
				$thumbnail          = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );
				$product_price      = apply_filters( 'woocommerce_cart_item_price', wc_price($_product->get_price()), $cart_item, $cart_item_key );
                $product_quantity   = $cart_item['quantity'];
				$product_permalink  = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );

                ?>
				<li class="woocommerce-mini-cart-item <?php echo esc_attr( apply_filters( 'woocommerce_mini_cart_item_class', 'mi-mini-cart__item', $cart_item, $cart_item_key ) ); ?>">
					<?php if ( empty( $product_permalink ) ) : ?>
						<?php echo $thumbnail . wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
					<?php else : ?>
						<a class="d-flex gap-2 align-items-center justify-content-between" href="<?php echo esc_url( $product_permalink ); ?>">
                            <div class="d-flex gap-2 align-items-center">
                                <?php echo $thumbnail; // The thumbnail item ?>
                                <div class="mi-mini-cart__item-title">
                                    <?php echo wp_kses_post( $product_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                                </div>
                            </div>
                            <div class="d-flex mi-remove-from-cart" data-cart-key="<?php echo esc_attr( $cart_item_key ); ?>">
                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none">
                                    <path d="M3 6.38597C3 5.90152 3.34538 5.50879 3.77143 5.50879L6.43567 5.50832C6.96502 5.49306 7.43202 5.11033 7.61214 4.54412C7.61688 4.52923 7.62232 4.51087 7.64185 4.44424L7.75665 4.05256C7.8269 3.81241 7.8881 3.60318 7.97375 3.41617C8.31209 2.67736 8.93808 2.16432 9.66147 2.03297C9.84457 1.99972 10.0385 1.99986 10.2611 2.00002H13.7391C13.9617 1.99986 14.1556 1.99972 14.3387 2.03297C15.0621 2.16432 15.6881 2.67736 16.0264 3.41617C16.1121 3.60318 16.1733 3.81241 16.2435 4.05256L16.3583 4.44424C16.3778 4.51087 16.3833 4.52923 16.388 4.54412C16.5682 5.11033 17.1278 5.49353 17.6571 5.50879H20.2286C20.6546 5.50879 21 5.90152 21 6.38597C21 6.87043 20.6546 7.26316 20.2286 7.26316H3.77143C3.34538 7.26316 3 6.87043 3 6.38597Z" fill="#C1C1C1"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M9.42543 11.4815C9.83759 11.4381 10.2051 11.7547 10.2463 12.1885L10.7463 17.4517C10.7875 17.8855 10.4868 18.2724 10.0747 18.3158C9.66253 18.3592 9.29499 18.0426 9.25378 17.6088L8.75378 12.3456C8.71256 11.9118 9.01327 11.5249 9.42543 11.4815Z" fill="#C1C1C1"/>
                                    <path fill-rule="evenodd" clip-rule="evenodd" d="M14.5747 11.4815C14.9868 11.5249 15.2875 11.9118 15.2463 12.3456L14.7463 17.6088C14.7051 18.0426 14.3376 18.3592 13.9254 18.3158C13.5133 18.2724 13.2126 17.8855 13.2538 17.4517L13.7538 12.1885C13.795 11.7547 14.1625 11.4381 14.5747 11.4815Z" fill="#C1C1C1"/>
                                    <path opacity="0.5" d="M11.5956 22.0001H12.4044C15.1871 22.0001 16.5785 22.0001 17.4831 21.1142C18.3878 20.2283 18.4803 18.7751 18.6654 15.8686L18.9321 11.6807C19.0326 10.1037 19.0828 9.31524 18.6289 8.81558C18.1751 8.31592 17.4087 8.31592 15.876 8.31592H8.12405C6.59127 8.31592 5.82488 8.31592 5.37105 8.81558C4.91722 9.31524 4.96744 10.1037 5.06788 11.6807L5.33459 15.8686C5.5197 18.7751 5.61225 20.2283 6.51689 21.1142C7.42153 22.0001 8.81289 22.0001 11.5956 22.0001Z" fill="#C1C1C1"/>
                                </svg>
                            </div>
						</a>
					<?php endif; ?>

					<?php // echo wc_get_formatted_cart_item_data( $cart_item ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
                    <div class="d-flex justify-content-between align-items-end mt-3">
                        <div class="mini-cart__item-price d-flex flex-column align-items-end">
                            <div class="mini-cart__item-price d-flex gap-2 align-items-center">
                                <?php
                                // Add regular price and discount percentage
                                if ( $_product->is_on_sale() ) {

                                    // Regular price
                                    echo '<span class="mini-cart__item-regular-price"><del>' . number_format($_product->get_regular_price(), 0, '', '.') . '</del></span>';
                                    // Discount percentage
                                    if ( $_product->get_price() != 0 || ! empty( $_product->get_price() ) ) {
                                        $product_discount = round( 100 - ($_product->get_price() / $_product->get_regular_price() * 100) );
                                        echo '<span class="mini-cart__item-discount">%' . $product_discount . '</span>';
                                    }
                                }
                                ?>
                            </div>
                            <?php
                            echo sprintf( '%s', $product_price )
                            ?>
                        </div>
                        <div class="mini-cart__item-quantity quantity">
                            <button class="mini-cart__quantity quantity-btn-plus mini-cart__quantity--disable d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M4.5 9H13.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                    <path d="M9 13.5V4.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                            <input type="text" class="mini-cart__quantity-value" data-cart-key="<?php echo $cart_item_key?>" data-cart-quantity="<?php echo $product_quantity?>" value="<?php echo $product_quantity?>" min="1" />
                            <button class="mini-cart__quantity quantity-btn-minus d-flex align-items-center">
                                <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 18 18" fill="none">
                                    <path d="M4.5 9H13.5" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"/>
                                </svg>
                            </button>
                        </div>
                    </div>
				</li>
				<?php
			}
		} ?>
	</ul>
    <div class="mi-mini-cart__buttons d-flex justify-content-evenly">
        <?php
        $wp_button_class = wc_wp_theme_get_element_class_name( 'button' ) ? ' ' . wc_wp_theme_get_element_class_name( 'button' ) : '';

        echo '<a href="' . esc_url( wc_get_checkout_url() ) . '" class="checkout wc-forward d-flex' . esc_attr( $wp_button_class ) . '">';
            // Render button icon
            if ( $args['checkout_button_icon']['library'] ) :
                echo '<div class="mi-mini-cart__button-icon">';
                if ($args['checkout_button_icon']['library'] == 'svg') {
                    echo '<img src="' . esc_url($args['checkout_button_icon']['value']['url']) . '" alt="">';
                } else {
                    \Elementor\Icons_Manager::render_icon($args['checkout_button_icon'], ['aria-hidden' => 'true']);
                }
                echo '</div>';
            endif;

            echo  $args['checkout_button_title'] ? esc_html( $args['checkout_button_title'] ) : 'تسویه حساب';

        echo '</a>';

        echo '<a href="' . esc_url( wc_get_cart_url() ) . '" class="cart wc-forward d-flex ' . esc_attr( $wp_button_class ) . '">';
        // Render button icon
        if ( $args['cart_button_icon']['library'] ) :
            echo '<div class="mi-mini-cart__button-icon">';
            if ($args['cart_button_icon']['library'] == 'svg') {
                echo '<img src="' . esc_url($args['cart_button_icon']['value']['url']) . '" alt="">';
            } else {
                \Elementor\Icons_Manager::render_icon($args['cart_button_icon'], ['aria-hidden' => 'true']);
            }
            echo '</div>';
        endif;

        echo  $args['cart_button_title'] ? esc_html( $args['cart_button_title'] ) : 'سبد خرید';

        echo '</a>';
    echo '</div>';

else :
    ?>
	<div class="mi-mini-cart__empty-message">
        <div class="mi-empty-message__icon">
            <?php
                if ($args['empty_icon']['library']) {
                    if ($args['empty_icon']['library'] == 'svg') {
                        echo '<img src="' . esc_url($args['empty_icon']['value']['url']) . '" alt="">';
                    } else {
                        \Elementor\Icons_Manager::render_icon($args['empty_icon'], ['aria-hidden' => 'true']);
                    }
                } else {
                    echo '<svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none"><g id="Broken / Shopping, Ecommerce / Bag 2"><path id="Vector" d="M15 11L16 17" stroke="#FF9562" stroke-width="1.5" stroke-linecap="round"></path><path id="Vector_2" d="M9 11L8 17" stroke="#FF9562" stroke-width="1.5" stroke-linecap="round"></path><path id="Vector_3" d="M9 6V5C9 3.34315 10.3431 2 12 2C13.6569 2 15 3.34315 15 5V6" stroke="#FF9562" stroke-width="1.5" stroke-linecap="round"></path><path id="Vector_4" d="M20.2232 12.5257C19.638 9.40452 19.3454 7.84393 18.2345 6.92196C17.1236 6 15.5358 6 12.3602 6H11.6391C8.4635 6 6.87571 6 5.76481 6.92196C4.65392 7.84393 4.3613 9.40452 3.77608 12.5257C2.95316 16.9146 2.5417 19.1091 3.74132 20.5545C4.94094 22 7.17365 22 11.6391 22H12.3602C16.8257 22 19.0584 22 20.258 20.5545C20.954 19.7159 21.1077 18.6252 20.9533 17" stroke="#FF9562" stroke-width="1.5" stroke-linecap="round"></path></g></svg>';
                }
            ?>
        </div>
        <p>
            <?php 
            if ( !empty($args['empty_title']) ) {
                echo $args['empty_title'];
            } else {
                echo esc_html( 'سبد خرید شما خالیست!', 'modista' );
            }
            ?>
        </p>
        <a href="<?php echo get_permalink( wc_get_page_id( 'shop' ) ); ?>">
            <?php _e('مشاهده محصولات', 'modista') ?>
        </a>
    </div>
<?php endif; ?>
