 <div class="wccfm-wrap">
	 <ul class="js-errors"></ul>
	 <form id="simple-product-shipping" method="post">
		 <h3><?php _e( 'Billing fields', 'wccfm' ); ?></h3>
		 <p> <?php _e( 'Check the field that you want to disable', 'wccfm' ); ?></p>
		 <input type="hidden" name="nonce" value="<?php echo wp_create_nonce( 'simple-product-shipping-nonce' ); ?>">
		 <ul>
			 <?php
				$wc_checkout = \WC_Checkout::instance();
				// get all options values
				$wccfm_simple_checkout_fields = get_option( 'wccfm_simple_product_checkout_fields' );

				foreach ( $wc_checkout->get_checkout_fields( 'billing' ) as $key => $value ) {

					?>
				<li>
					<input type="checkbox" name="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $key ); ?>"
						<?php checked( true, isset( $wccfm_simple_checkout_fields[ $key ] ) ); ?>>
					<label for="<?php echo esc_attr( $key ); ?>"><?php esc_html_e( $value['label'], 'wccfm' ); ?></lable>
				</li>
					<?php
				}
				?>

		 </ul>
		 <h3><?php _e( 'Disable shipping for downloadable products', 'wccfm' ); ?></h3>
		 <p><?php _e( 'Check the checkbox to disable shipping', 'wccfm' ); ?></p>
		 <ul>

			 <li>
				 <input type="checkbox" name="disable_shipping" id="disable_shipping"
					 <?php checked( true, isset( $wccfm_simple_checkout_fields['disable_shipping'] ) ); ?>>
				 <label for="disable_shipping"><?php _e( 'Disable shipping', 'wccfm' ); ?>  </lable>
			 </li>

		 </ul>
		 <h3><?php _e( 'Order notes', 'wccfm' ); ?></h3>
		 <p><?php _e( 'Check the checkbox to disable order notes', 'wccfm' ); ?></p>
		 <ul>

			 <li>
				 <input type="checkbox" name="disable_order_notes" id="disable_order_notes"
					 <?php checked( true, isset( $wccfm_simple_checkout_fields['disable_order_notes'] ) ); ?>>
				 <label for="disable_order_notes"><?php _e( 'Disable order notes', 'wccfm' ); ?>  </lable>
			 </li>

		 </ul>
		 <input type="submit" id="simple-product-fields" name="Submit" value="Submit" />
	 </form>
 </div>
