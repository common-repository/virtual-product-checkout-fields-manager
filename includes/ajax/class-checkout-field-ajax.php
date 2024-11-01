<?php
/**
 * Sample_Ajax class.
 *
 * @package VirtualCheckoutManager
 */

namespace VirtualCheckoutManager\Ajax;

use VirtualCheckoutManager\Traits\Singleton;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Load sample ajax functionality inside this class.
 */
class Checkout_Field_Ajax {

	use Singleton;

	/**
	 * Constructor of Bootstrap class.
	 */
	private function __construct() {
		add_action( 'wp_ajax_checkout_field_manager', array( $this, 'checkout_field_manager' ) );

	}

	/**
	 * Run a sample action.
	 */
	public function checkout_field_manager() {
		// verify nonce
		check_ajax_referer( 'simple-product-shipping-nonce', 'nonce' );

		// handle ajax call
		if ( isset( $_POST['formValues'] ) ) {
			
			// sanitize form data
			$form_values = array_map( 'sanitize_text_field', $_POST['formValues'] );
			update_option( 'wccfm_simple_product_checkout_fields', $form_values );
			wp_send_json_success();
		}
		// send error if action is failed.
		wp_send_json_error();

	}
}
