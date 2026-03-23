<?php
/**
 * This is a template for pages and posts.
 *
 * Template Name: Featured Image
 * Template Post Type: page
 *
 * @package bulk
 */

?>

<?php get_header(); ?>

<?php while ( have_posts() ) : ?>
	<?php the_post(); ?>

	<main>
		<?php if( has_post_thumbnail() ) : ?>
			<div class="page-template-featured-image">
				<div class="overlay"></div>
				<?php the_post_thumbnail( 'full' ); ?>
				
				<div class="blocks-container thumbnail-holder">
					<h2><?php the_title(); ?></h2>
				</div>
			</div>
		<?php endif; ?>

		<div class="blocks-container">
			<?php if ( function_exists('yoast_breadcrumb') ): ?>
                <?php yoast_breadcrumb('<p class="breadcrumbs">','</p>'); ?>
            <?php endif; ?>
			<?php the_content(); ?>
		</div>
	</main>

<?php endwhile; ?>

<?php
get_footer();
