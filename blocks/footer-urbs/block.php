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
			'title'       => __( 'Rodapé URBS', 'bulk' ),
			'description' => __( 'Um rodapé personalizado para o site da URBS.', 'bulk' ),
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
