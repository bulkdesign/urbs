<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_announcements_carousel() {
	theme_declare_block(
		array(
			'name'        => 'announcements-carousel',
			'title'       => __( 'Carrossel de Avisos', 'bulk' ),
			'description' => __( 'Um carrossel simples para imagens de avisos.', 'bulk' ),
			'icon'        => 'cover-image',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_announcements_carousel', 20 );
