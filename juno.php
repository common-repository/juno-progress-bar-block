<?php
/**
 * Plugin Name:       Juno - Progress Bar Block
 * Plugin URI:        https://ponopress.com/blocks/juno
 * Description:       Progress bar block plugin with customizable circle, square and semi-circle shaped progress bars.
 * Requires at least: 6.3
 * Requires PHP:      7.0
 * Version:           0.0.3
 * Author:            Pono Press
 * Author URI:		  https://ponopress.com/
 * License:           GPL-2.0-or-later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 * Text Domain:       juno
 * Domain Path:       juno
 *
 * @package           pono-press
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly.
}


if ( ! defined( 'JUNO_PLUGIN_FILE' ) ) {
	define( 'JUNO_PLUGIN_FILE', __FILE__ );
}

if ( ! class_exists( 'Juno' ) ) {
	include_once dirname( JUNO_PLUGIN_FILE ) . '/inc/Juno.php';
}

/**
 * The main function that returns the Juno class
 *
 * @since 1.0.0
 * @return object|Juno
 */
function juno_load_plugin() {
	return Juno::instance();
}

// Get the plugin running.
add_action( 'plugins_loaded', 'juno_load_plugin' );

