<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_template_content() {
	theme_declare_block(
		array(
			'name'        => 'template-content',
			'title'       => __( 'Conteúdo', 'bulk' ),
			'description' => __( 'Exibe o conteúdo da página.', 'bulk' ),
			'icon'        => 'editor-alignleft',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
            'category'    => 'templates',
            'post_types'  => array( 'template' ),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_template_content', 60 );
