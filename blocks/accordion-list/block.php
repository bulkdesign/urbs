<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_accordion_list() {
	theme_declare_block(
		array(
			'name'        => 'accordion-list',
			'title'       => __( 'Lista Expansível', 'bulk' ),
			'description' => __( 'Lista que expande ao clicar e exibe mais conteúdo', 'bulk' ),
			'icon'        => 'editor-kitchensink',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_accordion_list', 30 );
