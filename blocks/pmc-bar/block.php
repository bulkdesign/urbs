<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_pmc_bar() {
	theme_declare_block(
		array(
			'name'        => 'pmc-bar',
			'title'       => __( 'PMC Bar', 'bulk' ),
			'description' => __( 'A bar to be displayed above the header', 'bulk' ),
			'icon'        => 'minus',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
            'category'    => 'headers',
            'post_types'  => array( 'header' ),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_pmc_bar', 10 );
