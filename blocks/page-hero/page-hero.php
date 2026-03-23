<?php
/**
 * Block: Page Hero
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'page-hero' ); ?> data-color-scheme="<?php the_field( 'color_scheme' ); ?>" data-content-width="<?php the_field('content_width'); ?>">
	<?php if ( 'image' === get_field( 'media_type' ) ) : ?>
        <?php $image = get_field( 'image' ); ?>
        <?php if ( ! empty( $image ) ) : ?>
        <div class="page-hero-media">
            <div class="page-hero-image">
				<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
            </div>
        </div>
        <?php endif; ?>
    <?php elseif ( in_array( get_field( 'media_type' ), array( 'youtube', 'vimeo', 'video' ) ) ) : ?>
        <div class="page-hero-media">
            <div class="page-hero-video-player">
                <?php if ( 'video' === get_field( 'media_type' ) ) : ?>
                    <?php $file = get_field( 'video_file' ); ?>
                    <video autoplay playsinline muted loop>
                        <source src="<?php echo esc_attr( $file['url'] ); ?>" type="<?php echo esc_attr( $file['mime_type'] ); ?>">
                    </video>
                <?php elseif ( 'youtube' === get_field( 'media_type' ) ) : ?>
                    <iframe src="https://www.youtube.com/embed/<?php the_field( 'video_id' ); ?>?autoplay=1&mute=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php elseif ( 'vimeo' === get_field( 'media_type' ) ) : ?>
                    <iframe src="https://player.vimeo.com/video/<?php the_field( 'video_id' ); ?>?autoplay=1&byline=0&portrait=0&badge=0&background=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
	<div class="page-hero-wrapper">
		<div class="page-hero-inner">
			<?php if ( have_rows( 'breadcrumbs' ) ) : ?>
			<ul class="page-hero-breadcrumbs">
				<?php while ( have_rows( 'breadcrumbs' ) ) : ?>
					<?php the_row(); ?>
					<li>
						<?php if ( 'text' === get_row_layout() ) : ?>
						<span>
							<?php the_sub_field( 'text' ); ?>
						</span>
						<?php elseif ( 'link' === get_row_layout() ) : ?>
							<?php $button = get_sub_field( 'link' ); ?>

							<?php if ( ! empty( $button ) ) : ?>
							<a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
								<?php echo wp_kses_post( $button['title'] ); ?>
							</a>
							<?php endif; ?>
						<?php endif; ?>
					</li>
				<?php endwhile; ?>
			</ul>
			<?php endif; ?>

			<?php if ( get_field( 'eyebrow' ) ) : ?>
			<div class="eyebrow page-hero-eyebrow">
				<?php the_field( 'eyebrow' ); ?>
			</div>
			<?php endif; ?>

			<?php if ( get_field( 'title' ) ) : ?>
			<h1 class="page-hero-title">
				<?php echo wp_kses_post( strip_tags( get_field( 'title' ), '<span><u><br><strong><em>' ) ); ?>
			</h1>
			<?php endif; ?>

			<?php if ( get_field( 'content' ) ) : ?>
			<div class="page-hero-content">
				<?php the_field( 'content' ); ?>
			</div>
			<?php endif; ?>

			<?php if( get_field( 'button_1' ) || get_field( 'button_2' ) || get_field( 'button_3' ) ): ?>
			<div class="page-hero-buttons">
				<?php $button = get_field( 'button_1' ); ?>
				<?php if ( ! empty( $button ) ) : ?>
				<a class="primary-button page-hero-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
					<?php echo wp_kses_post( $button['title'] ); ?>
				</a>
				<?php endif; ?>

				<?php $button = get_field( 'button_2' ); ?>
				<?php if ( ! empty( $button ) ) : ?>
				<a class="secondary-button page-hero-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
					<?php echo wp_kses_post( $button['title'] ); ?>
				</a>
				<?php endif; ?>

				<?php $button = get_field( 'button_3' ); ?>
				<?php if ( ! empty( $button ) ) : ?>
				<a class="tertiary-button page-hero-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
					<?php echo wp_kses_post( $button['title'] ); ?>
				</a>
				<?php endif; ?>
			</div>
			<?php endif; ?>
		</div>
	</div>
</div>
