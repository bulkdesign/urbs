<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_title_and_content() {
	theme_declare_block(
		array(
			'name'        => 'title-and-content',
			'title'       => __( 'Título e Conteúdo', 'bulk' ),
			'description' => __( 'Exibe um título com conteúdo ao lado.', 'bulk' ),
			'icon'        => 'align-left',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_title_and_content', 30 );
