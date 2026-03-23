<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bulk
 */

get_header(); ?>

<main id="page" class="default-template">
	<div class="blocks-container">
		<?php if ( function_exists('yoast_breadcrumb') ): ?>
			<?php yoast_breadcrumb('<p class="breadcrumbs">','</p>'); ?>
		<?php endif; ?>
		
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php the_title('<h1>', '</h1>'); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
</main>

<?php

get_footer();
