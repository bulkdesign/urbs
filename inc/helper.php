<?php
/**
 * Helper functions to be used across the theme
 *
 * @package bulk
 */

/**
 * Return the version of file
 *
 * @param string $file_path the path of the file we want the version of.
 */
function theme_get_file_version( $file ) {
	$child_file = get_stylesheet_directory() . $file;
	$parent_file = get_template_directory() . $file;

	if ( file_exists( $child_file ) ){
		$time = '.' . filemtime( $child_file );
	} elseif ( file_exists( $parent_file ) ){
		$time = '.' . filemtime( $parent_file );
	} else {
		$time = '';
	}
	
	return get_bloginfo( 'version' ) . $time;
}

/**
 * Return the main stylesheet version.
 */
function theme_get_app_css_version() {
	$file = '/css/main.css';
	return theme_get_file_version( $file );
}

/**
 * Return the main javascript version.
 */
function theme_get_app_js_version() {
	$file = '/js/main.js';
	return theme_get_file_version( $file );
}

/**
 * Echos an external asset into the source code
 *
 * @param string $path path to the asset.
 */
function theme_asset( $path ) {
	// phpcs:ignore
	echo file_get_contents( get_stylesheet_directory() . '/' . $path, true );
}

/**
 * Return the correct target for an ACF link
 *
 * @param array $link array with link parameters.
 */
function theme_get_link_target( $link ) {
	return $link['target'] ? esc_attr( $link['target'] ) : '_self';
}

/**
 * Return the aria label with an "open in new tab" message if necessary
 *
 * @param array $link array with link parameters.
 */
function theme_get_link_aria_label( $link ) {
	$label = strip_tags( $link['title'] );
	if ( $link['target'] == '_blank' ) {
		$label = sprintf( __('%s (open in a new tab)', 'bulk'), $label);
	}
	return $label;
}

/**
 * Adds or removes a parameter from the page url
 *
 * @param string $arg the parameter name.
 * @param string $value the parameter value.
 */
function toggle_query_arg( $arg, $value ) {
	$selected_args = explode( ',', get_query_var( $arg ) );
	$key           = array_search( $value, $selected_args, true );

	if ( false !== $key ) {
		unset( $selected_args[ $key ] );
		if ( empty( $selected_args ) ) {
			return remove_query_arg( $arg );
		}
	} else {
		array_push( $selected_args, $value );
	}

	$arg_string = implode( ',', array_filter( $selected_args ) );
	return add_query_arg(
		array(
			$arg    => $arg_string,
			'paged' => 1,
		)
	);
}

/**
 * Easily displays a block;
 *
 * @param string  $name the block name.
 * @param array   $data the block data.
 * @param array   $additional_settings additional settings to be sent to the block.
 * @param boolean $echo displays the result when true or return its when false.
 */
function theme_block( $name, $data = array(), $additional_settings = array(), $echo = true ) {
	$settings = array(
		'name' => $name,
	);

	if ( ! empty( $data ) && is_array( $data ) ) {
		$settings['data'] = $data;
	}

	if ( ! empty( $additional_settings ) ) {
		$settings = array_merge( $settings, $additional_settings );
	}

	$block          = '<!-- wp:' . $name . ' ' . wp_json_encode( $settings ) . ' /-->';
	$rendered_block = do_blocks( $block );

	if ( $echo ) {
		// The output is already safe.
		// phpcs:ignore
		echo $rendered_block;
	} else {
		return $rendered_block;
	}
}
