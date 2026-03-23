<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_content_in_columns() {
	theme_declare_block(
		array(
			'name'        => 'content-in-columns',
			'title'       => __( 'Conteúdo em Colunas', 'bulk' ),
			'description' => __( 'Exibe conteúdo em colunas com um cabeçalho opcional.', 'bulk' ),
			'icon'        => 'columns',
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

add_action( 'theme_declare_block', 'theme_block_content_in_columns', 30 );
