<?php
/**
 * WordPress theme functions and definitions
 *
 * @package bulk
 */

/**
 * Include helper scripts
 */
require_once get_stylesheet_directory() . '/inc/post-types.php';
require_once get_stylesheet_directory() . '/inc/taxonomies.php';

/**
 * Enqueue all the stylesheets necessary for the child theme.
 */
function child_theme_enqueue_styles() {
    wp_enqueue_style( 'font-archivo', 'https://fonts.googleapis.com/css2?family=Archivo:ital,wght@0,100..900;1,100..900&display=swap' );
    wp_enqueue_style( 'child-main-css', get_stylesheet_directory_uri() . '/css/main.css', array('main-css'), theme_get_app_css_version() );
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_styles' );

/**
 * Enqueue all the scripts necessary for the child.
 */

function child_theme_enqueue_scripts() {
    //wp_enqueue_script( 'select2-js', get_stylesheet_directory_uri() . '/js/select2.min.js', array( 'jquery' ) );
}
add_action( 'wp_enqueue_scripts', 'child_theme_enqueue_scripts', 30 );

/**
 * Filter allowed blocks
 */
function child_theme_allowed_blocks() {
	return array(
        'announcements-carousel',
        'columns-with-content',
        'content-in-columns',
        'content-with-media',
        'cookies-disclaimer',
        'faq-accordion',
        'footer-urbs',
        'header-divided',
        'horario-de-onibus',
        'information-carousel',
        'latest-news-urbs',
        'logos-carousel',
        'logos-grid',
        'page-hero',
        'page-hero-carousel-urbs',
        'page-hero-search-urbs',
        'posts-archive-with-filter',
        'section-background',
        'search',
        'services',
        'columns-of-services',
        'post-content',
        'template-content',
        'title-and-content',
        'photos-carousel',
        'top-bar',
        'service-cards',
        'quick-links-urbs',
        'pmc-bar',
        'boletins-urbs',
        'links-list',
        'equipamentos-urbs',
        'featured-columns',
        'accordion-list',
        'cartao-transporte',
        'licitacoes-filter'
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

// /**
//  * HTTP Strict Transport Security (HSTS) filter
//  */
// function add_hsts_header() {
//     // Set the HSTS header to include subdomains and a max-age of 1 year (31536000 seconds)
//     header("Strict-Transport-Security: max-age=31536000; includeSubDomains; preload");
// }

// /**
//  * Content Security Policy (CSP) filter
//  */
// function add_csp_header() {
//     // Define your Content Security Policy
//     $csp = "default-src 'self'; script-src 'self' 'unsafe-inline' 'unsafe-eval' https://apis.google.com; style-src 'self' 'unsafe-inline'; img-src 'self' data:; font-src 'self'; connect-src 'self'; frame-src 'self' https://www.youtube.com;";

//     // Send the CSP header
//     header("Content-Security-Policy: $csp");
// }

// // Hook the function to the 'send_headers' action
// add_action('send_headers', 'add_csp_header');

// // Hook the function to the 'send_headers' action
// add_action('send_headers', 'add_hsts_header');

// Development mode - delete before completing the project
function bulk_is_developing(){
    return true;
}