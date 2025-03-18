<?php
/**
 * Post code to be used in loops
 *
 * @package bulk
 */

?>

<article class="post-loop">
	<a href="<?php the_permalink(); ?>">
		<?php if ( has_post_thumbnail() ) : ?>
			<div class="post-loop-image">
				<?php the_post_thumbnail( 'post-thumbnail' ); ?>
			</div>
		<?php endif; ?>

		<h3>
			<?php the_title(); ?>
		</h3>

		<?php if(has_excerpt()): ?>
		<?php the_excerpt(); ?>
		<?php endif; ?>

		<span class="read-more primary-button"><?php esc_html_e( 'Saiba Mais', 'bulk' ); ?></span>
	</a>
</article>
