<?php
/**
 * direction
 *
 * Switch the layout & text direction of the website management system, for testing.
 *
 * @package direction
 * @version 1.0.0
 * @link    https://github.com/antibrand/direction
 *
 * Plugin Name: direction
 * Plugin URI: https://github.com/antibrand/direction
 * Description: Switch the layout & text direction of the website management system, for testing.
 * Version: 1.0.0
 * Author:
 * Author URI:
 * Text Domain:  direction
 * Domain Path:  /languages
 * Tested up to:
 */

/**
 * Plugin directory path
 *
 * @since  1.0.0
 * @return string Returns the filesystem directory path (with trailing slash)
 *                for the plugin __FILE__ passed in.
 */
if ( ! defined( 'ABDIR_PATH' ) ) {
	define( 'ABDIR_PATH', plugin_dir_path( __FILE__ ) );
}

/**
 * Plugin directory URL
 *
 * @since  1.0.0
 * @return string Returns the URL directory path (with trailing slash)
 *                for the plugin __FILE__ passed in.
 */
if ( ! defined( 'ABDIR_URL' ) ) {
	define( 'ABDIR_URL', plugin_dir_url( __FILE__ ) );
}

// Get the core plugin class.
require_once ABDIR_PATH . 'class-direction.php';