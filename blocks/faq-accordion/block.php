<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function theme_block_faq_accordion() {
	theme_declare_block(
		array(
			'name'        => 'faq-accordion',
			'title'       => __( 'Acordeão de FAQ', 'bulk' ),
			'description' => __( 'Acordeão com perguntas frequentes.', 'bulk' ),
			'icon'        => 'editor-kitchensink',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'theme_block_faq_accordion', 30 );
