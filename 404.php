<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bulk
 */

get_header(); ?>

<section id="page" class="page-not-found">
	<div class="blocks-container">
        <h1>
            <?php esc_html_e( 'Page not found', 'bulk' ); ?>
        </h1>
        <p>
            <?php esc_html_e( "That page doesn't exist or has been moved — please check the URL and try again.", 'bulk' ); ?>
        </p>
		<p>
			<a href="<?php echo esc_url( get_home_url() ); ?>" class="primary-button">
				<?php esc_html_e( 'Back to Homepage', 'bulk' ); ?>
			</a>
		</p>        
	</div>
</section>

<?php

get_footer();
