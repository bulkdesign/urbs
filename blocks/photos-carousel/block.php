<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_photos_carousel() {
	theme_declare_block(
		array(
			'name'        => 'photos-carousel',
			'title'       => __( 'Carrossel de Fotos', 'bulk' ),
			'description' => __( 'Exibe fotos em um carrossel com texto opcional.', 'bulk' ),
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

add_action( 'theme_declare_block', 'theme_block_photos_carousel', 30 );
