<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_logos_grid() {
	theme_declare_block(
		array(
			'name'        => 'logos-grid',
			'title'       => __( 'Grade de Logos', 'bulk' ),
			'description' => __( 'Exibe logos em uma grade com texto.', 'bulk' ),
			'icon'        => 'grid-view',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_logos_grid', 30 );
