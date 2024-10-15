<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_equipamentos_urbs() {
	theme_declare_block(
		array(
			'name'        => 'equipamentos-urbs',
			'title'       => __( 'Equipamentos', 'bulk' ),
			'description' => __( 'Manually added equipments from URBS.', 'bulk' ),
			'icon'        => 'slides',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => array('none', 'wide', 'full'),
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_equipamentos_urbs', 20 );
