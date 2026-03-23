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
			'title'       => __( 'Links Rápidos URBS', 'bulk' ),
			'description' => __( 'Bloco para selecionar alguns links para exibir, com a adição de um logotipo.', 'bulk' ),
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
