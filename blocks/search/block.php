<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_search() {
	theme_declare_block(
		array(
			'name'        => 'search',
			'title'       => __( 'Search', 'bulk' ),
			'description' => __( 'Search bar module to be used on pages.', 'bulk' ),
			'icon'        => 'search',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_search', 20 );
