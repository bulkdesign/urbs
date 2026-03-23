<?php
/**
 * WordPress theme functions and definitions
 *
 * @package URBS
 */

/**
 * Include helper scripts
 */
require_once get_stylesheet_directory() . '/inc/blocks.php';
require_once get_stylesheet_directory() . '/inc/helper.php';
require_once get_stylesheet_directory() . '/inc/template-sections.php';

/**
 * Declare some theme settings
 */
function theme_init() {
    // Add title support.
    add_theme_support( 'title-tag' );

    // Add support for wide images in blog posts.
    add_theme_support( 'align-wide' );

    // Add support for page excerpt.
    add_post_type_support( 'page', 'excerpt' );

    // Set up Full Site Editor Support
    add_theme_support( 'disable-custom-font-sizes' );
    add_theme_support( 'disable-custom-colors' );
    add_theme_support( 'disable-custom-gradients' );
    add_theme_support( 'responsive-embeds' );
    remove_theme_support( 'core-block-patterns' );

    // Register menus.
    register_nav_menus(array());

    // Add support for thumbnails.
    add_theme_support( 'post-thumbnails' );

}
add_action( 'init', 'theme_init' );

/**
 * Enqueue all the stylesheets necessary for the child theme.
 */
function theme_enqueue_styles() {
    wp_enqueue_style( 'font-archivo', 'https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap' );
    wp_enqueue_style( 'reboot-css', get_stylesheet_directory_uri() . '/css/reboot.css', array(), theme_get_app_css_version() );
    wp_enqueue_style( 'lightbox-css', get_stylesheet_directory_uri() . '/css/vendor/lightbox.css', array(), theme_get_app_css_version() );
    wp_enqueue_style( 'swiper-css', get_stylesheet_directory_uri() . '/css/vendor/swiper-bundle.min.css', array(), theme_get_app_css_version() );
    wp_enqueue_style( 'animate-css', get_stylesheet_directory_uri() . '/css/vendor/animate.min.css', array(), theme_get_app_css_version() );
    wp_enqueue_style( 'main-css', get_stylesheet_directory_uri() . '/css/main.css', array('reboot-css'), theme_get_app_css_version() );
    wp_enqueue_style( 'child-main-css', get_stylesheet_directory_uri() . '/css/child-main.css', array('main-css'), theme_get_app_css_version() );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_styles' );

/**
 * Enqueue all the scripts necessary for the theme.
 */
function theme_enqueue_scripts() {
    wp_enqueue_script( 'lightbox-js', get_stylesheet_directory_uri() . '/js/vendor/lightbox.js', array('jquery'), theme_get_app_js_version(), true );
    wp_enqueue_script( 'swiper-js', get_stylesheet_directory_uri() . '/js/vendor/swiper-bundle.min.js', null, theme_get_app_js_version(), true );
    wp_enqueue_script( 'main-js', get_stylesheet_directory_uri() . '/js/main.js', null, theme_get_app_js_version(), true );
    $vars = array(
        'site_url'  => esc_url( get_home_url() ),
        'ajax_url'  => admin_url( 'admin-ajax.php' ),
        'theme_url' => get_stylesheet_directory_uri(),
        'nonce'     => wp_create_nonce( 'ajax-nonce' ),
    );
    wp_localize_script( 'main-js', 'theme', $vars );
    wp_localize_script( 'main-js', 'theme_style', array() );
}
add_action( 'wp_enqueue_scripts', 'theme_enqueue_scripts' );

/**
 * Enqueue all the scripts necessary for the gutenberg editor.
 */
function theme_enqueue_gutenberg_styles() {
    wp_enqueue_style( 'gutenberg-css', get_stylesheet_directory_uri() . '/css/gutenberg.css', array(), theme_get_app_css_version() );
    wp_enqueue_script( 'gutenberg-js', get_stylesheet_directory_uri() . '/js/gutenberg.js', array(), theme_get_app_js_version(), true );

    if ( function_exists( 'bulk_is_developing' ) ) {
        $vars = array(
            'bulk_is_developing' => true,
        );
        wp_localize_script( 'gutenberg-js', 'theme', $vars );
    }
}
add_action( 'enqueue_block_editor_assets', 'theme_enqueue_gutenberg_styles' );

/**
 * Creates a settings page in ACF.
 */
function theme_acf_settings_page() {
    if ( function_exists( 'acf_add_options_page' ) ) {
        acf_add_options_page(
            array(
                'page_title' => __( 'API Keys', 'bulk' ),
                'menu_title' => __( 'API Keys', 'bulk' ),
                'menu_slug'  => 'theme-api-keys',
                'capability' => 'edit_posts',
                'redirect'   => false,
                'parent_slug'   => 'options-general.php',
            )
        );
    }
}
add_action( 'acf/init', 'theme_acf_settings_page' );

/**
 * Sets ACF Google Maps API key
 */
function theme_acf_google_maps() {
    acf_update_setting( 'google_api_key', get_field( 'google_maps_api_key', 'option' ) );
}
add_action( 'acf/init', 'theme_acf_google_maps' );

/**
 * Adds a very simple toolbar options in ACF
 *
 * @param array $toolbars An array with toolbars.
 */
function theme_acf_toolbar_simple( $toolbars ) {
    $toolbars['Simple - Bold']      = array(
        1 => array(
            'bold',
        ),
    );
    $toolbars['Simple - Italic']    = array(
        1 => array(
            'italic',
        ),
    );
    $toolbars['Simple - Underline'] = array(
        1 => array(
            'underline',
        ),
    );
    $toolbars['Basic'] = array(
        1 => array(
            'bold',
            'italic',
            'underline',
        ),
    );

    return $toolbars;
}
add_filter( 'acf/fields/wysiwyg/toolbars', 'theme_acf_toolbar_simple' );

/**
 * Custom sub-menu classes
 */
add_filter( 'nav_menu_submenu_css_class', 'rename_sub_menus', 10, 3 );
function rename_sub_menus( $classes, $args, $depth ){
    foreach ( $classes as $key => $class ) {
    if ( $class == 'sub-menu'  && $depth == 0) {
        $classes[ $key ] = 'sub-menu';
    } else if ( $class == 'sub-menu'  && $depth == 1) {
      $classes[ $key ] = 'second-level-sub-menu';
    } else if ( $class == 'sub-menu'  && $depth == 2) {
      $classes[ $key ] = 'third-level-sub-menu';
    }
}

return $classes;
}

/**
 * Adds a function to an action to display the header that can easily be ovewritten
 */
function theme_display_header(){
    $args = array(
        'post_type' => 'header',
        'posts_per_page' => 1,
        'order' => 'ASC',
    );

    $header_query = new WP_Query( $args );
    while ( $header_query->have_posts() ) {
        $header_query->the_post();
        the_content();
    }

    wp_reset_postdata();
}
add_filter('theme_display_header', 'theme_display_header');

/**
 * Adds a function to an action to display the footer that can easily be overwritten
 */
function theme_display_footer(){
    $args = array(
        'post_type' => 'footer',
        'posts_per_page' => 1,
        'order' => 'ASC',
    );

    $footer_query = new WP_Query( $args );
    while ( $footer_query->have_posts() ) {
        $footer_query->the_post();
        the_content();
    }

    wp_reset_postdata();
}
add_filter('theme_display_footer', 'theme_display_footer');

/**
 * Function to display the translation
 */
function theme_setup_translation(){
    load_theme_textdomain('bulk');
}
add_action('after_setup_theme', 'theme_setup_translation');

/**
 * Function to change the default posts per page on $WP_Query
 */
function theme_change_default_posts_per_page( $query ) {
    if ( $query->is_main_query() && ! is_admin() ) {
        $query->set( 'posts_per_page', 9 );
    }
}
add_action( 'pre_get_posts', 'theme_change_default_posts_per_page' );

/**
 * Filter allowed blocks
 */
function child_theme_allowed_blocks() {
	return array(
        'accordion-list',
        'announcements-carousel',
        'boletins-urbs',
        'cartao-transporte',
        'columns-of-services',
        'columns-with-content',
        'content-in-columns',
        'content-with-media',
        'cookies-disclaimer',
        'equipamentos-urbs',
        'faq-accordion',
        'featured-columns',
        'footer-urbs',
        'header-divided',
        'horario-de-onibus',
        'information-carousel',
        'latest-news-urbs',
        'licitacoes-filter',
        'links-list',
        'logos-carousel',
        'logos-grid',
        'page-hero',
        'page-hero-carousel-urbs',
        'page-hero-search-urbs',
        'photos-carousel',
        'pmc-bar',
        'post-content',
        'posts-archive-with-filter',
        'quick-links-urbs',
        'search',
        'section-background',
        'service-cards',
        'services',
        'template-content',
        'title-and-content',
        'top-bar',
    );
}
add_filter( 'theme_allowed_blocks', 'child_theme_allowed_blocks', 10, 0);

/**
 * Filter the except length to 20 words.
 *
 * @param int $length Excerpt length.
 * @return int (Maybe) modified excerpt length.
 */
function child_theme_custom_excerpt_size( $length ) {
	return 20;
}
add_filter( 'excerpt_length', 'child_theme_custom_excerpt_size', 999 );