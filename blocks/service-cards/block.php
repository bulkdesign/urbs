<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_service_cards() {
	theme_declare_block(
		array(
			'name'        => 'service-cards',
			'title'       => __( 'Service Cards', 'bulk' ),
			'description' => __( 'Cards with option to add icon, title and link.', 'bulk' ),
			'icon'        => 'plus',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_service_cards', 20 );
