<?php
/**
 * Juno: Block Patterns
 *
 * @since Juno 0.0.1
 */
namespace Juno;

defined( 'ABSPATH' ) || exit;

/**
 * Registers block patterns and categories.
 *
 * @since Juno 0.0.1
 *
 * @return void
 */
function juno_register_block_patterns() {
	$block_pattern_categories = array(
		'juno' => array( 'label' => __( 'Juno', 'juno' ) ),
	);

	/**
	 * Filters the theme block pattern categories.
	 *
	 * @since Juno 0.0.1
	 *
	 * @param array[] $block_pattern_categories {
	 *     An associative array of block pattern categories, keyed by category name.
	 *
	 *     @type array[] $properties {
	 *         An array of block category properties.
	 *
	 *         @type string $label A human-readable label for the pattern category.
	 *     }
	 * }
	 */
	$block_pattern_categories = apply_filters( 'juno_block_pattern_categories', $block_pattern_categories );

	foreach ( $block_pattern_categories as $name => $properties ) {
		if ( ! \WP_Block_Pattern_Categories_Registry::get_instance()->is_registered( $name ) ) {
			register_block_pattern_category( $name, $properties );
		}
	}

	$block_patterns = array(
		'circular',
		'semi-circular',
		'linear',
		'square'
	);

	/**
	 * Filters the theme block patterns.
	 *
	 * @since Juno 0.0.1
	 *
	 * @param array $block_patterns List of block patterns by name.
	 */
	$block_patterns = apply_filters( 'juno_block_patterns', $block_patterns );

	foreach ( $block_patterns as $block_pattern ) {
		$pattern_file = JUNO_ABSPATH . 'patterns/' . $block_pattern . '.php';
		register_block_pattern(
			'juno/' . $block_pattern,
			require $pattern_file
		);
	}
}
add_action( 'init', __NAMESPACE__ . '\juno_register_block_patterns' );