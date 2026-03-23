<?php
/**
 * Declares a block
 *
 * @package mm
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_links_list() {
	theme_declare_block(
		array(
			'name'        => 'links-list',
			'title'       => __( 'Lista de Links', 'mm' ),
			'description' => __( 'Exibe uma lista de links com um cabeçalho opcional.', 'bulk' ),
			'icon'        => 'list-view',
			'mode'        => 'edit',
			'align'       => 'wide',
			'supports'    => array(
				'align'  => array('full', 'wide'),
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_links_list', 30 );