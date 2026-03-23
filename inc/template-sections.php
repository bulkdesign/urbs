<?php
/**
 * Declares theme's custom post types for template parts
 *
 * @package bulk
 */

/**
 * Theme's post types
 */

function cptui_register_my_cpts_header() {

	/**
	 * Post Type: Headers.
	 */

	$labels = [
		"name" => esc_html__( "Headers", "bulk" ),
		"singular_name" => esc_html__( "Header", "bulk" ),
		"all_items" => esc_html__( "Header", "bulk" ),
	];

	$args = [
		"label" => esc_html__( "Headers", "bulk" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => "themes.php",
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => false,
		"query_var" => false,
		"supports" => [ "title", "editor" ],
		"show_in_graphql" => false,
	];

    if ( ! function_exists( 'bulk_is_developing' ) ) {
        $args['capabilities'] = array(
            'create_posts' => false,
        );
    }

	register_post_type( "header", $args );
}
add_action( 'init', 'cptui_register_my_cpts_header' );

function cptui_register_my_cpts_footer() {

	/**
	 * Post Type: Footers.
	 */

	$labels = [
		"name" => esc_html__( "Footers", "bulk" ),
		"singular_name" => esc_html__( "Footer", "bulk" ),
		"all_items" => esc_html__( "Footer", "bulk" ),
	];

	$args = [
		"label" => esc_html__( "Footers", "bulk" ),
		"labels" => $labels,
		"description" => "",
		"public" => false,
		"publicly_queryable" => false,
		"show_ui" => true,
		"show_in_rest" => true,
		"rest_base" => "",
		"rest_controller_class" => "WP_REST_Posts_Controller",
		"rest_namespace" => "wp/v2",
		"has_archive" => false,
		"show_in_menu" => "themes.php",
		"show_in_nav_menus" => false,
		"delete_with_user" => false,
		"exclude_from_search" => true,
		"capability_type" => "post",
		"map_meta_cap" => true,
		"hierarchical" => false,
		"can_export" => true,
		"rewrite" => false,
		"query_var" => false,
		"supports" => [ "title", "editor" ],
		"show_in_graphql" => false,
	];

    if ( ! function_exists( 'bulk_is_developing' ) ) {
        $args['capabilities'] = array(
            'create_posts' => false,
        );
    }

	register_post_type( "footer", $args );
}
add_action( 'init', 'cptui_register_my_cpts_footer' );

function theme_prevent_editing_template_parts( $caps, $cap, $user_id, $args ){
    if( ( 'delete_post' !== $cap && 'create_posts' !== $cap ) || empty( $args[0] ) ){
        return $caps;
    }

    if ( ! function_exists( 'bulk_is_developing' ) ) {
        if( in_array( get_post_type( $args[0] ), [ 'header', 'footer' ], true ) ){
            $caps[] = 'do_not_allow';
        }
    }

    return $caps;  
}
add_filter( 'map_meta_cap', 'theme_prevent_editing_template_parts', 10, 4 );