<?php
/**
 * Declares all theme blocks
 *
 * @package bulk
 */

/**
 * Finds all blocks
 */
function theme_acf_init_block_types() {
	if ( ! function_exists( 'acf_register_block_type' ) ) {
		return false;
	}

	$allowed_blocks = apply_filters( 'theme_allowed_blocks', array());

	if( get_template_directory() != get_stylesheet_directory() ){
		$child_blocks_folder = get_stylesheet_directory() . '/blocks';
		if ( is_dir( $child_blocks_folder ) ) {
			$child_blocks = array_diff( scandir( $child_blocks_folder ), array( '..', '.' ) );

			foreach ( $child_blocks as $block ) {
				if( ! empty($allowed_blocks) && ! in_array( $block, $allowed_blocks ) ) continue;

				if ( is_dir( $child_blocks_folder . '/' . $block ) && file_exists( $child_blocks_folder . '/' . $block . '/block.php' ) ) {
					include $child_blocks_folder . '/' . $block . '/block.php';
				}
			}
		}
	}

	$blocks_folder = get_template_directory() . '/blocks';
	if ( is_dir( $blocks_folder ) ) {
		$blocks = array_diff( scandir( $blocks_folder ), array( '..', '.' ) );

		foreach ( $blocks as $block ) {
			if( ! empty($allowed_blocks) && ! in_array( $block, $allowed_blocks ) ) continue;

			if ( is_dir( $blocks_folder . '/' . $block ) && file_exists( $blocks_folder . '/' . $block . '/block.php' ) ) {
				include $blocks_folder . '/' . $block . '/block.php';
			}
		}
	}

	do_action( 'theme_declare_block' );
}
add_action( 'acf/init', 'theme_acf_init_block_types' );


/**
 * Merge theme block settings
 *
 * @param array $settings the block settings.
 */
function theme_declare_block( $settings ) {
	$defaults = array(
		'render_template' => 'blocks/' . $settings['name'] . '/' . $settings['name'] . '.php',
		'category'        => 'theme-modules',
	);

	$img_path = '/blocks/' . $settings['name'] . '/' . $settings['name'] . '.png';
	$full_img_path = '';
	
	if ( file_exists( get_stylesheet_directory() . $img_path )  ){
		$full_img_path = get_stylesheet_directory_uri() . $img_path;
	}else if ( file_exists( get_template_directory() . $img_path ) ) {
		$full_img_path = get_template_directory_uri() . $img_path;
	}

	if( !empty($full_img_path) ){
		$defaults['render_callback'] = 'theme_acf_block_render_callback';
		$defaults['example']         = array(
			'attributes' => array(
				'mode' => 'preview',
				'data' => array(
					'preview_image' => $full_img_path,
				),
			),
		);
	}

	$args = array_merge( $defaults, $settings );
	acf_register_block_type( $args );

	add_action(
		'wp_enqueue_scripts',
		function() use ( $settings ) {
			$css_path = '/blocks/' . $settings['name'] . '/' . $settings['name'] . '.css';
			if ( file_exists( get_template_directory() . $css_path ) ) {
				$dependencies = array();

				if( wp_style_is( 'main-css' ) ){
					array_push( $dependencies, 'main-css' );
				}
				
				wp_enqueue_style('block-' . $settings['name'] . '-style', get_template_directory_uri() . $css_path . '?v=' . filemtime( get_template_directory() . $css_path ), $dependencies);
			}

			if(get_template_directory() != get_stylesheet_directory()){
				if ( file_exists( get_stylesheet_directory() . $css_path ) ) {
					$dependencies = array();

					if( wp_style_is( 'main-css' ) ){
						array_push( $dependencies, 'main-css' );
					}
					if( wp_style_is( 'child-main-css' ) ){
						array_push( $dependencies, 'child-main-css' );
					}

					wp_enqueue_style('block-' . $settings['name'] . '-child-style', get_stylesheet_directory_uri() . $css_path . '?v=' . filemtime( get_stylesheet_directory() . $css_path ), $dependencies);
				}
			}

			$js_path = '/blocks/' . $settings['name'] . '/' . $settings['name'] . '.js';
			if(get_template_directory() != get_stylesheet_directory()){
				if ( file_exists( get_stylesheet_directory() . $js_path ) ) {
					$dependencies = array();

					if( wp_style_is( 'main-js' ) ){
						array_push( $dependencies, 'main-js' );
					}
					if( wp_style_is( 'child-main-js' ) ){
						array_push( $dependencies, 'child-main-js' );
					}

					wp_enqueue_script('block-' . $settings['name'] . '-child-script', get_stylesheet_directory_uri() . $js_path, $dependencies, filemtime( get_stylesheet_directory() . $js_path ), true);
				}
			}
			if ( file_exists( get_template_directory() . $js_path ) ) {
				$dependencies = array();

				if( wp_script_is( 'main-js' ) ){
					array_push( $dependencies, 'main-js' );
				}

				wp_enqueue_script('block-' . $settings['name'] . '-script', get_template_directory_uri() . $js_path, $dependencies, filemtime( get_template_directory() . $js_path ), true);
			}
		}
	);

	$css_gutenberg_path = '/blocks/' . $settings['name'] . '/gutenberg.css';
	if ( file_exists( get_template_directory() . $css_gutenberg_path ) ) {
		add_action(
			'enqueue_block_editor_assets',
			function() use ( $settings, $css_gutenberg_path ) {
				wp_enqueue_style( 'block-gutenberg-' . $settings['name'], get_template_directory_uri() . $css_gutenberg_path, array(), theme_get_app_css_version() );
			}
		);
	}

	if(get_template_directory() != get_stylesheet_directory()){
		if ( file_exists( get_stylesheet_directory() . $css_gutenberg_path ) ) {
			add_action(
				'enqueue_block_editor_assets',
				function() use ( $settings, $css_gutenberg_path ) {
					wp_enqueue_style( 'block-gutenberg-child-' . $settings['name'], get_stylesheet_directory_uri() . $css_gutenberg_path, array(), theme_get_app_css_version() );
				}
			);
		}
	}
}

/**
 * Return the classes for a block
 *
 * @param array  $block the block which classes will be returned.
 * @param string $classes an aditional list of classes.
 *
 * @return string string with all the classes to be displayed.
 */
function theme_block_class( $block, $classes ) {
	if ( ! empty( $block['className'] ) ) {
		$classes .= ' ' . $block['className'];
	}
	if ( ! empty( $block['align'] ) ) {
		$classes .= ' align' . $block['align'];
	}
	return $classes;
}

/**
 * Return the correct id for a block.
 *
 * @param array $block the block which the id will be returned.
 *
 * @return string string with the correct block id.
 */
function theme_block_id( $block ) {
	if ( ! empty( $block['anchor'] ) ) {
		return $block['anchor'];
	} else {
		return $block['id'];
	}
}

/**
 * Return the data attributes for a block
 *
 * @param array $block the block which classes will be returned.
 *
 * @return string string with the correct block id.
 */
function theme_block_data( $block ) {
	$attributes = '';

	foreach( $block['data'] as $key => $value ){
		if( substr( $key, 0, 5) === 'data_' ){
			$data_key = esc_attr( str_replace( '_', '-', $key ) );
			$value = esc_attr( print_r( $value, true ) );
			$attributes .= ' ' . $data_key . '="' . $value . '" ';
		}
	}

	return $attributes;
}

/**
 * Return the correct id for a block.
 *
 * @param array  $block the current block.
 * @param string $classes an aditional list of classes.
 * @param string $append content to be appended to the the end of the string.
 * @param bool   $echo defines if the content will be echoed or returned.
 *
 * @return string list of html element attributes to be included into the code.
 */
function theme_block_attributes( $block, $classes = null, $append = '', $echo = true ) {
	$attributes = '';
	$attributes .= ' class="' . theme_block_class( $block, $classes) . '" ';
	$attributes .= ' id="' . theme_block_id( $block ) . '" ';

	foreach( $block['data'] as $key => $value ){
		if( substr( $key, 0, 5) === 'data_' ){
			$data_key = esc_attr( str_replace( '_', '-', $key ) );
			$value = esc_attr( print_r( $value, true ) );
			$attributes .= ' ' . $data_key . '="' . $value . '" ';
		}
	}

	$attributes .= $append;
	$attributes = apply_filters( 'theme_block_attributes/' . str_replace( 'acf/', '', $block['name'] ) , $attributes, $block );
	
	if( $echo ){
		echo $attributes;
	}else{
		return $attributes;
	}
}

/**
 * Renders a block, showing a preview image if it's in the text editor.
 *
 * @param array  $block the block which classes will be returned.
 * @param string $content .
 * @param bool   $is_preview .
 * @param int    $post_id .
 */
function theme_acf_block_render_callback( $block, $content = '', $is_preview = false, $post_id = 0 ) {
	if ( $is_preview && isset( $block['data']['preview_image'] ) ) {
		echo '<img src="' . esc_url( $block['data']['preview_image'] ) . '" alt="' . esc_html( $block['title'] ) . '" style="max-width: 100%;">';
	} else {
		if ( file_exists( $block['render_template'] ) ) {
			$path = $block['render_template'];
		} else {
			$path = locate_template( $block['render_template'] );
		}

		if ( file_exists( $path ) ) {
			include $path;
		}
	}
}

/**
 * Adds a category for the theme's blocks
 *
 * @param array $categories array with the block categories.
 */
function theme_block_categories( $categories ) {
	return array_merge(
		array(
			array(
				'slug'  => 'theme-modules',
				'title' => __( 'Theme Blocks', 'bulk' ),
			),
			array(
				'slug'  => 'headers',
				'title' => __( 'Headers', 'bulk' ),
			),
			array(
				'slug'  => 'footers',
				'title' => __( 'Footers', 'bulk' ),
			),
			array(
				'slug'  => 'templates',
				'title' => __( 'Templates', 'bulk' ),
			),
		),
		$categories
	);
}
add_action( 'block_categories_all', 'theme_block_categories', 10, 2 );

/**
 * Adds the blocks folders as paths for ACF to look for json files
 *
 * @param array $paths array with the paths.
 */
function theme_acf_json_load_point( $paths ) {
	$paths[] = get_template_directory() . '/acf-json';
	$blocks_folder = get_template_directory() . '/blocks';
	if ( is_dir( $blocks_folder ) ) {
		$blocks = array_diff( scandir( $blocks_folder ), array( '..', '.' ) );

		foreach ( $blocks as $block ) {
			if ( is_dir( $blocks_folder . '/' . $block ) ) {
				$paths[] = $blocks_folder . '/' . $block;
			}
		}
	}

	if( get_template_directory() != get_stylesheet_directory() ){
		$paths[] = get_stylesheet_directory() . '/acf-json';
		$child_blocks_folder = get_stylesheet_directory() . '/blocks';
		if ( is_dir( $child_blocks_folder ) ) {
			$child_blocks = array_diff( scandir( $child_blocks_folder ), array( '..', '.' ) );

			foreach ( $child_blocks as $block ) {
				if ( is_dir( $child_blocks_folder . '/' . $block ) ) {
					$paths[] = $child_blocks_folder . '/' . $block;
				}
			}
		}
	}

	return $paths;
}
add_filter( 'acf/settings/load_json', 'theme_acf_json_load_point' );

/**
 * Moves a block ACF Json file to its folder
 *
 * @param array $field_group The field group.
 */
function theme_acf_json_save( $field_group ) {
	theme_acf_json_delete_by_key( $field_group );

	$key                = $field_group['key'];
	$original_file_path = get_stylesheet_directory() . '/acf-json/' . $key . '.json';

	if ( ! file_exists( $original_file_path ) ) {
		return false;
	}

	$copied        = false;
	$blocks_folder = '/blocks';

	if ( ! empty( $field_group['location'] ) ) {

		foreach ( $field_group['location'] as $locations ) {
			foreach ( $locations as $location ) {
				if ( 'block' === $location['param'] && '==' === $location['operator'] ) {
					$block = str_replace( 'acf/', '', $location['value'] );

					if ( is_dir( get_stylesheet_directory() . $blocks_folder . '/' . $block ) ) {
						$block_folder = $blocks_folder . '/' . $block . '/';
						$file_name    = $block . '.json';

						if ( file_exists( get_stylesheet_directory() . $block_folder . $file_name ) ) {
							$current_json_content = file_get_contents( get_stylesheet_directory() . $block_folder . $file_name );
							$current_acf_json     = json_decode( $current_json_content, true );
							if ( $current_acf_json['key'] !== $key ) {
								$file_name = $key . '.json';
							}
						}

						copy( $original_file_path, get_stylesheet_directory() . $block_folder . $file_name );
						$copied = true;
					}
				}
			}
		}
	}

	if ( $copied ) {
		unlink( $original_file_path );
	}
}
add_action( 'acf/update_field_group', 'theme_acf_json_save', 50 );
add_action( 'acf/untrash_field_group', 'theme_acf_json_save', 50 );

/**
 * Delete a block ACF Json file from a custom folder based on its key
 *
 * @param array $field_group The field group.
 */
function theme_acf_json_delete_by_key( $field_group ) {
	$key        = str_replace( '__trashed', '', $field_group['key'] );
	$json_files = glob( get_template_directory() . '/blocks/*/*.json' );
	
	if( get_template_directory() != get_stylesheet_directory() ){
		$child_json_files = glob( get_stylesheet_directory() . '/blocks/*/*.json' );
		$json_files       = array_merge($json_files, $child_json_files);
	}

	foreach ( $json_files as $json_file ) {
		// The phpcs suggestion isn't a solution.
		// phpcs:ignore
		$current_acf_json = json_decode( file_get_contents( $json_file ), true );
		if ( $current_acf_json['key'] === $key ) {
			unlink( $json_file );
		}
	}
}
add_action( 'acf/delete_field_group', 'theme_acf_json_delete_by_key', 50 );
add_action( 'acf/trash_field_group', 'theme_acf_json_delete_by_key', 50 );

/**
 * Echos an external asset from a block into the source code
 *
 * @param string $path path to the asset.
 */
function theme_block_asset( $file_path ) {
	$trace = debug_backtrace();
	$path = explode('/', $trace[0]['file']);
	$block = $path[count($path) - 2];

	if( file_exists( get_stylesheet_directory() . '/blocks/' . $block . '/' . $file_path ) ){
		// phpcs:ignore
		echo file_get_contents( get_stylesheet_directory() . '/blocks/' . $block . '/' . $file_path, true );
	}elseif( file_exists( get_template_directory() . '/blocks/' . $block . '/' . $file_path ) ){
		// phpcs:ignore
		echo file_get_contents( get_template_directory() . '/blocks/' . $block . '/' . $file_path, true );
	}
}


/**
 * Limit allowed blocks for headers
 *
 * @param array  $allowed_blocks .
 * @param object $editor_context .
 */
function theme_allow_blocks( $allowed_blocks, $editor_context ) {
	$all_blocks = WP_Block_Type_Registry::get_instance()->get_all_registered();
	$allowed_blocks_for_post_type = array();

	if ( ! empty( $editor_context->post ) ) {
		switch( $editor_context->post->post_type ){
			case 'header':
				if ( ! function_exists( 'bulk_is_developing' ) ) {
					return array();
				}

				foreach($all_blocks as $block){
					if( 'headers' === $block->category || 'footers' === $block->category ){
						array_push( $allowed_blocks_for_post_type, $block->name );
					}
				}
				return $allowed_blocks_for_post_type;
				break;
			case 'footer':
				if ( ! function_exists( 'bulk_is_developing' ) ) {
					return array();
				}

				foreach($all_blocks as $block){
					if( 'footers' === $block->category ){
						array_push( $allowed_blocks_for_post_type, $block->name );
					}
				}
				return $allowed_blocks_for_post_type;
				break;
			default:
				foreach($all_blocks as $block){
					if( 'theme' !== $block->category ){
						array_push( $allowed_blocks_for_post_type, $block->name );
					}
				}
				return $allowed_blocks_for_post_type;
				break;
		}
	}else{
		return $allowed_blocks;
	}
}
add_filter( 'allowed_block_types_all', 'theme_allow_blocks', 20, 2 );
