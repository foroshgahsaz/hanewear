<?php

namespace Hanewear\Core;

use Elementor\Controls_Manager;

defined( 'ABSPATH' ) || exit;

class Product_Query_Helper {

	public static function register_product_query_controls( $widget ) {
		$widget->add_control(
			'product_order_by',
			[
				'label'   => __( 'مرتب‌سازی', 'hanewear-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'date',
				'options' => [
					'date'           => __( 'جدیدترین', 'hanewear-core' ),
					'meta_value_num' => __( 'پرفروش‌ترین', 'hanewear-core' ),
					'price'          => __( 'قیمت', 'hanewear-core' ),
					'title'          => __( 'عنوان', 'hanewear-core' ),
					'rand'           => __( 'تصادفی', 'hanewear-core' ),
				],
			]
		);

		$widget->add_control(
			'product_order',
			[
				'label'   => __( 'ترتیب', 'hanewear-core' ),
				'type'    => Controls_Manager::SELECT,
				'default' => 'DESC',
				'options' => [
					'DESC' => __( 'نزولی', 'hanewear-core' ),
					'ASC'  => __( 'صعودی', 'hanewear-core' ),
				],
			]
		);

		$widget->add_control(
			'product_on_sale',
			[
				'label'        => __( 'فقط محصولات تخفیف‌دار', 'hanewear-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);

		$widget->add_control(
			'product_featured',
			[
				'label'        => __( 'فقط محصولات ویژه', 'hanewear-core' ),
				'type'         => Controls_Manager::SWITCHER,
				'return_value' => 'yes',
				'default'      => '',
			]
		);
	}

	public static function build_product_query_args( array $settings ) {
		$args = [
			'post_type'      => 'product',
			'posts_per_page' => isset( $settings['product_count'] ) ? (int) $settings['product_count'] : 8,
			'post_status'    => 'publish',
		];

		$order_by = $settings['product_order_by'] ?? 'date';
		$order    = $settings['product_order'] ?? 'DESC';

		if ( 'meta_value_num' === $order_by ) {
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = 'total_sales';
		} elseif ( 'price' === $order_by ) {
			$args['orderby']  = 'meta_value_num';
			$args['meta_key'] = '_price';
		} else {
			$args['orderby'] = $order_by;
		}

		$args['order'] = $order;

		$tax_query = [];

		if ( ! empty( $settings['product_categories'] ) ) {
			$tax_query[] = [
				'taxonomy' => 'product_cat',
				'field'    => 'slug',
				'terms'    => $settings['product_categories'],
			];
		}

		if ( ! empty( $settings['product_featured'] ) && 'yes' === $settings['product_featured'] ) {
			$tax_query[] = [
				'taxonomy' => 'product_visibility',
				'field'    => 'name',
				'terms'    => 'featured',
			];
		}

		if ( ! empty( $tax_query ) ) {
			$args['tax_query'] = $tax_query;
		}

		if ( ! empty( $settings['product_on_sale'] ) && 'yes' === $settings['product_on_sale'] ) {
			$on_sale_ids      = wc_get_product_ids_on_sale();
			$args['post__in'] = ! empty( $on_sale_ids ) ? $on_sale_ids : [ 0 ];
		}

		return $args;
	}
}
