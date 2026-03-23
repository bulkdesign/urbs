<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_logos_carousel() {
	theme_declare_block(
		array(
			'name'        => 'logos-carousel',
			'title'       => __( 'Carrossel de Logos', 'bulk' ),
			'description' => __( 'Exibe logos em um carrossel com texto.', 'bulk' ),
			'icon'        => 'slides',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_logos_carousel', 30 );
