<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_cartao_transporte() {
	theme_declare_block(
		array(
			'name'        => 'cartao-transporte',
			'title'       => __( 'Cartão Transporte', 'bulk' ),
			'description' => __( 'Exibe o conteúdo do cartão transporte em abas.', 'bulk' ),
			'icon'        => 'welcome-widgets-menus',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_cartao_transporte', 30 );
