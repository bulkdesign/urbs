<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_columns_with_content() {
	theme_declare_block(
		array(
			'name'        => 'columns-with-content',
			'title'       => __( 'Colunas com Conteúdo', 'bulk' ),
			'description' => __( 'Exibe até 3 colunas com título, conteúdo e botões.', 'bulk' ),
			'icon'        => 'columns',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_columns_with_content', 30 );
