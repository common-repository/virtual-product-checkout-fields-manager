<?php
/**
 * All necessary custom functions will be here.
 *
 * @package VirtualCheckoutManager
 */

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get saved options from database for checkout field control.
 *
 * @return array
 */
if ( ! function_exists( 'wccfm_get_simple_product_options' ) ) {
	
	function wccfm_get_simple_product_options() {
		$options = get_option( 'wccfm_simple_product_checkout_fields' );
		if ( ! $options ) {
			$options = array();
		}
		return $options;
	}
}


add_filter( 'woocommerce_checkout_fields', 'wccfm_virtual_checkout_field_manager' );

/**
 * Contorl checkout field visibility for digital products.
 */
if ( ! function_exists( 'wccfm_virtual_checkout_field_manager' ) ) {
	function wccfm_virtual_checkout_field_manager( $fields ) {

		if ( ! is_checkout() ) {
			return $fields;
		}

		$options = wccfm_get_simple_product_options();

		$only_virtual      = true;
		$only_downloadable = true;

		foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {

			// Check if there are non-virtual products.
			if ( ( ! $cart_item['data']->is_virtual() ) ) {
				$only_virtual = false;

			}
			// Check if there are downloadable products.
			if ( ! $cart_item['data']->is_downloadable() ) {
				$only_downloadable = false;
			}
		}

		foreach ( $options as $key => $value ) {

			// Unset fields which are not needed for digital products.
			if ( $value === 'on' && $only_virtual ) {
				unset( $fields['billing'][ $key ] );
			}

			// Hide order notes.
			if ( $key === 'disable_order_notes' && $value === 'on' && $only_virtual ) {
				add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
			}

			// Hide billing fields for downloadable products.
			if ( $value === 'on' && $only_downloadable ) {
				unset( $fields['billing'][ $key ] );
			}

			// Hide shipping fields for downloadable products.
			if ( $key === 'disable_shipping' && $value === 'on' && $only_downloadable ) {
				// hide ship to different address title
				add_filter( 'woocommerce_cart_needs_shipping_address', '__return_false' );
			}

			// Hide order notes for downloadable products.
			if ( $key === 'disable_order_notes' && $value === 'on' && $only_downloadable ) {
				add_filter( 'woocommerce_enable_order_notes_field', '__return_false' );
			}
		}
		return $fields;
	}
}

