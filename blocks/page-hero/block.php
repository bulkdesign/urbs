<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_page_hero() {
	theme_declare_block(
		array(
			'name'        => 'page-hero',
			'title'       => __( 'Banner da Página', 'bulk' ),
			'description' => __( 'Um banner para páginas.', 'bulk' ),
			'icon'        => 'cover-image',
			'mode'        => 'edit',
			'align'       => 'full',
			'supports'    => array(
				'align'  => array('full', 'wide'),
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_page_hero', 20 );
