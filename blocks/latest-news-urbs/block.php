<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_latest_news_urbs() {
	theme_declare_block(
		array(
			'name'        => 'latest-news-urbs',
			'title'       => __( 'Últimas Notícias', 'bulk' ),
			'description' => __( 'Artigo mais recente e uma lista de outros artigos.', 'bulk' ),
			'icon'        => 'info-outline',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_latest_news_urbs', 20 );
