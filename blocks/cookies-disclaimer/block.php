<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_cookies_disclaimer() {
	theme_declare_block(
		array(
			'name'        => 'cookies-disclaimer',
			'title'       => __( 'Aviso de Cookies', 'bulk' ),
			'description' => __( 'Um aviso sobre cookies que pode ser dispensado.', 'bulk' ),
			'icon'        => 'privacy',
			'mode'        => 'edit',
			'align'       => 'full',
			'supports'    => array(
				'align'  => array('full', 'wide'),
				'mode'   => false,
				'anchor' => true,
			),
            'category'    => 'footers',
            'post_types'  => array( 'footer', 'header' ),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_cookies_disclaimer', 60 );
