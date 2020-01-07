<?php
/**
 * The core plugin class
 *
 * @package    direction
 * @since      1.0.0
 */
namespace Dir_Test;

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

/**
 * The core plugin class
 *
 * @since  1.0.0
 * @access public
 */
class Direction {

	/**
	 * Constructor method
	 *
	 * @since  1.0.0
	 * @access public
	 * @return self
	 */
	public function __construct() {

		// Load plugin text domain.
		load_plugin_textdomain( 'direction', false, ABDIR_PATH . '/languages/' );

		// Save the currently chosen direction.
		add_action( 'init', [ $this, 'direction' ] );

		// Add a button to admin bar.
		add_action( 'admin_bar_menu', [ $this, 'switcher' ], 999 );
	}

	/**
	 * Switcher
	 *
	 * Adds a button to admin bar.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @global object $wp_admin_bar Most likely instance of WP_Admin_Bar
	 *                but this is filterable.
	 *
	 * @return null Returns early if capability check isn't matched or
	 *              if admin bar should not be showing.
	 */
	public function switcher() {

		// Access global variables.
		global $wp_admin_bar;

		$required_cap = apply_filters( 'rtl_tester_capability_check', 'activate_plugins' );

		if ( ! current_user_can( $required_cap ) || ! is_admin_bar_showing() ) {
			return;
		}

		// Get opposite direction for button text.
		if ( is_rtl() ) {
			$direction = 'ltr';
		} else {
			$direction = 'rtl';
		}

		$wp_admin_bar->add_menu(
			[
				'id'    => 'switch-direction',
		 		'title' => sprintf( __( 'Switch to %s', 'direction' ), strtoupper( $direction ) ),
		 		'href'  => add_query_arg( [ 'd' => $direction ] )
			]
		);
	}

	/**
	 * Direction
	 *
	 * Save the currently chosen direction on a per-user basis.
	 *
	 * @since  1.0.0
	 * @access public
	 *
	 * @global WP_Locale $wp_locale Locale object.
	 * @global WP_Styles $wp_styles Styles object.
	 *
	 * @return object Returns a new WP_Styles instance.
	 */
	public function direction() {

		// Access global variables.
		global $wp_locale, $wp_styles;

		$_user_id = get_current_user_id();

		if ( isset( $_GET['d'] ) ) {
			$direction = $_GET['d'] == 'rtl' ? 'rtl' : 'ltr';
			update_user_meta( $_user_id, 'rtladminbar', $direction );
		} else {
			$direction = get_user_meta( $_user_id, 'rtladminbar', true );
			if ( false === $direction ) {
				$direction = isset( $wp_locale->text_direction ) ? $wp_locale->text_direction : 'ltr';
			}
		}

		$wp_locale->text_direction = $direction;
		if ( ! is_a( $wp_styles, '\WP_Styles' ) ) {
			$wp_styles = new \WP_Styles();
		}
		$wp_styles->text_direction = $direction;
	}

}

// Run the class.
new Direction;