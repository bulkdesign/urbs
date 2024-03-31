<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_columns_of_services() {
	theme_declare_block(
		array(
			'name'        => 'columns-of-services',
			'title'       => __( 'Columns of Services', 'bulk' ),
			'description' => __( 'Services split into two columns.', 'bulk' ),
			'icon'        => 'plus',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_columns_of_services', 20 );
