<?php
/**
 * Setup Juno
 *
 * @package block-visibility
 * @since   1.0.0
 */

defined( 'ABSPATH' ) || exit;

/**
 * Main Juno Class.
 *
 * @since 1.0.0
 */
final class Juno {

	/**
	 * Return singleton instance of the Juno plugin.
	 *
	 * @since 1.0.0
	 * @return Juno
	 */
	public static function instance() {
		static $instance = false;

		if ( ! $instance ) {
			$instance = new self();
		}
		return $instance;
	}

    /**
	 * Initialise the plugin.
	 */
	private function __construct() {
		$this->define_constants();
		$this->includes();
        $this->actions();
	}

    /**
	 * Define the contants for the Juno plugin.
	 *
	 * @since 1.4.0
	 */
	private function define_constants() {
		$this->define( 'JUNO_ABSPATH', dirname( JUNO_PLUGIN_FILE ) . '/' );
		$this->define( 'JUNO_VERSION', get_file_data( JUNO_PLUGIN_FILE, [ 'Version' ] )[0] ); // phpcs:ignore
		$this->define( 'JUNO_PLUGIN_URL', plugin_dir_url( JUNO_PLUGIN_FILE ) );
		$this->define( 'JUNO_PLUGIN_BASENAME', plugin_basename( JUNO_PLUGIN_FILE ) );
	}

    public function includes() {
		// Needs to be included at all times due to show_in_rest.
		include_once JUNO_ABSPATH . 'inc/register-patterns.php';
    }

    /**
	 * Load required actions.
	 *
	 * @since 1.0.0
	 */
	public function actions() {
		add_action( 'init', array( $this, 'juno_block_init' ) );
    }

    /**
     * Registers the block using the metadata loaded from the `block.json` file.
     * Behind the scenes, it registers also all assets so they can be enqueued
     * through the block editor in the corresponding context.
     *
     * @see https://developer.wordpress.org/reference/functions/register_block_type/
     */
    public function juno_block_init() {
        register_block_type( JUNO_ABSPATH . 'build' );
    }
	
    /**
	 * Define constant if not already set.
	 *
	 * @since 1.4.0
	 *
	 * @param string      $name  Constant name.
	 * @param string|bool $value Constant value.
	 */
	private function define( $name, $value ) {
		if ( ! defined( $name ) ) {
			// phpcs:ignore
			define( $name, $value );
		}
	}
}