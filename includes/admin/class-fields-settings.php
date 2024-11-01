<?php
/**
 * Class admin settings.
 */
namespace VirtualCheckoutManager;

// If this file is called directly, abort.
if ( ! defined( 'ABSPATH' ) ) {
	exit;
}


use VirtualCheckoutManager\Traits\Singleton;

class Admin_settings {

	use Singleton;

	/**
	 * Constructor of Admin_settings class.
	 */
	public function __construct() {
		add_action( 'admin_menu', array( $this, 'wccfm_admin_menu' ) );

	}
	/**
	 * Add submenu page under WooCommerce.
	 */
	public function wccfm_admin_menu() {
		add_submenu_page( 'woocommerce', 'Checkout field manager for digital / virtual products', 'Checkout Field Manager', 'manage_options', 'wccfm_settings_tab', array( $this, 'wccfm_admin_page' ) );
	}
	/**
	 * Admin page callback
	 */
	public function wccfm_admin_page() {
		// Get the active tab from the $_GET param
		$default_tab = null;

		$tab = isset( $_GET['tab'] ) ? sanitize_text_field( $_GET['tab'] ) : $default_tab;

		?>
			<!-- Our admin page content should all be inside .wrap -->
			<div class="wrap">
				<!-- Print the page title -->
				<h1><?php echo esc_html( get_admin_page_title() ); ?></h1>
				<!-- Here are our tabs -->
				<nav class="nav-tab-wrapper">
					<a href="?page=wccfm_settings_tab" 
						class="nav-tab 
						<?php
						if ( $tab === null ) :
							?>
						nav-tab-active<?php endif; ?>"> <?php _e( 'Fields Manager', 'wccfm' ); ?></a>
					<a href="?page=wccfm_settings_tab&tab=support" 
						class="nav-tab 
						<?php
						if ( $tab === 'support' ) :
							?>
						nav-tab-active<?php endif; ?>"><?php _e( 'Support', 'wccfm' ); ?></a>
				</nav>

				<div class="tab-content">
					<?php
					switch ( $tab ) :
						case 'support':
							?>

					<div class="wccfm-wrap">
						<h3><?php _e( 'Support', 'wccfm' ); ?></h3>
						<p> <?php _e( 'For support please contact', 'wccfm' ); ?> <a href="mailto:mahedicsit@gmail.com">mahedicsit@gmail.com</a></p>
					</div>

							<?php
							break;
						default:
							// include simple checkout form field template
							include_once __DIR__ . '/templates/digital-product-checkout-fields.php';

							break;
						endswitch;
					?>
	</div>
</div>
		<?php
	}
}
