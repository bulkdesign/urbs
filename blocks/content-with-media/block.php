<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_content_with_media() {
	theme_declare_block(
		array(
			'name'        => 'content-with-media',
			'title'       => __( 'Conteúdo com Mídia', 'bulk' ),
			'description' => __( 'Conteúdo de um lado e uma mídia do outro.', 'bulk' ),
			'icon'        => 'align-pull-right',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_content_with_media', 30 );
