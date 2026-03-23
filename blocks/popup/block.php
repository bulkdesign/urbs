<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_popup() {
	theme_declare_block(
		array(
			'name'        => 'popup',
			'title'       => __( 'Pop-Up', 'bulk' ),
			'description' => __( 'Um bloco pop-up simples.', 'bulk' ),
			'icon'        => 'minus',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_popup', 10 );
