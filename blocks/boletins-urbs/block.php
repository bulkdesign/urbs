<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_boletins_urbs() {
	theme_declare_block(
		array(
			'name'        => 'boletins-urbs',
			'title'       => __( 'Boletins', 'bulk' ),
			'description' => __( 'Displays all the boletins published by URBS.', 'bulk' ),
			'icon'        => 'info-outline',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_boletins_urbs', 20 );
