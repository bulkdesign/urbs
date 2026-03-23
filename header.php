<?php
/**
 * The header.
 *
 * This is the template that displays all of the <head> section and everything up until main.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package bulk
 */

?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>" />
	<meta name="viewport" content="width=device-width, initial-scale=1" />
	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php wp_body_open(); ?>
	<div role="complementary">
		<a href="#main-content" class="sr-only ignore"><?php esc_html_e( 'Go to content', 'bulk' ); ?></a>
	</div>
	<div id="page" class="page-wrapper">

		<?php get_template_part('template-parts/header'); ?>
		
		<div id="main-content" tabindex="0"></div>
