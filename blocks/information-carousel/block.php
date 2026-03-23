<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_information_carousel() {
	theme_declare_block(
		array(
			'name'        => 'information-carousel',
			'title'       => __( 'Carrossel de Informações', 'bulk' ),
			'description' => __( 'Um carrossel para informações mais importantes.', 'bulk' ),
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

add_action( 'theme_declare_block', 'child_theme_block_information_carousel', 20 );
