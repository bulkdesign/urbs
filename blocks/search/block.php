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
			'title'       => __( 'Busca', 'bulk' ),
			'description' => __( 'Módulo de barra de busca para uso em páginas.', 'bulk' ),
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
