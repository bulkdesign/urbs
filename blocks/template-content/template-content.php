<?php
/**
 * Block: Template Content
 *
 * @package bulk
 */

?>

<section id="page">
	<div class="blocks-container">
		<?php while ( have_posts() ) : ?>
			<?php the_post(); ?>
			<?php the_content(); ?>
		<?php endwhile; ?>
	</div>
</section>