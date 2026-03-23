<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_page_hero_search_urbs() {
	theme_declare_block(
		array(
			'name'        => 'page-hero-search-urbs',
			'title'       => __( 'Banner com Busca URBS', 'bulk' ),
			'description' => __( 'Um banner com uma barra de busca.', 'bulk' ),
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

add_action( 'theme_declare_block', 'child_theme_block_page_hero_search_urbs', 20 );
