<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_post_content() {
	theme_declare_block(
		array(
			'name'        => 'post-content',
			'title'       => __( 'Post Content', 'bulk' ),
			'description' => __( 'Displays the content of a post', 'bulk' ),
			'icon'        => 'admin-post',
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

	function child_theme_block_post_content_reading_time(){
		$words = str_word_count( strip_tags( get_the_content() ) );
		$minutes = ceil ( $words / 200 );
		return $minutes;
	}
}

add_action( 'theme_declare_block', 'child_theme_block_post_content', 60 );