<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_quick_links_urbs() {
	theme_declare_block(
		array(
			'name'        => 'quick-links-urbs',
			'title'       => __( 'Quick Links URBS', 'bulk' ),
			'description' => __( 'Block to select a few links you want to display, with the addition of a logo.', 'bulk' ),
			'icon'        => 'ellipsis',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_quick_links_urbs', 10 );
