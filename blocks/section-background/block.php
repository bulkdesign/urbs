<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_section_background() {
	theme_declare_block(
		array(
			'name'        => 'section-background',
			'title'       => __( 'Fundo de Seção', 'bulk' ),
			'description' => __( 'Define a cor de fundo de uma seção.', 'bulk' ),
			'icon'        => 'admin-appearance',
			'mode'        => 'preview',
			'align'       => 'full',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
				'jsx'    => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_section_background', 15 );
