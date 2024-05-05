<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_footer_urbs() {
	theme_declare_block(
		array(
			'name'        => 'footer-urbs',
			'title'       => __( 'Footer URBS', 'bulk' ),
			'description' => __( 'A custom footer for the URBS website.', 'bulk' ),
			'icon'        => 'minus',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
            'category'    => 'footers',
            'post_types'  => array( 'footer' ),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_footer_urbs', 50 );
