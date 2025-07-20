<?php
/**
 * Post code to be used in loops
 *
 * @package bulk
 */

?>


<article class="post-loop licitacoes">
	<?php if ( ! empty( get_the_content() ) ) : ?>
		<a href="<?php the_permalink(); ?>">
			<h3>
				<?php the_title(); ?>
			</h3>
		</a>

        <a href="<?php the_permalink(); ?>" class="primary-button"><?php esc_html_e('Saiba Mais', 'bulk'); ?></a>
	<?php endif; ?>
</article>
