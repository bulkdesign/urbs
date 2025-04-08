<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_featured_columns() {
	theme_declare_block(
		array(
			'name'        => 'featured-columns',
			'title'       => __( 'Colunas em Destaque', 'bulk' ),
			'description' => __( 'Colunas em Destaque', 'bulk' ),
			'icon'        => 'columns',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_featured_columns', 20 );
