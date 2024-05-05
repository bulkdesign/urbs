<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_information_carousel() {
	theme_declare_block(
		array(
			'name'        => 'announcements-carousel',
			'title'       => __( 'Announcements Carousel', 'bulk' ),
			'description' => __( 'A simple carousel for images annonucements.', 'bulk' ),
			'icon'        => 'cover-image',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => true,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_information_carousel', 20 );
