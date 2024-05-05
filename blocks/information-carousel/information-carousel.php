<?php
/**
 * Block: Information Carousel
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'information-carousel' ); ?> data-color-scheme="<?php the_field( 'color_scheme' ); ?>" data-content-width="<?php the_field('content_width'); ?>">
	<?php if( have_rows( 'slides' ) ): ?>
	<div class="information-carousel-swiper swiper" data-autoplay="<?php the_field( 'enable_carousel_autoplay' ); ?>" data-autoplay-timeout="<?php the_field( 'carousel_slide_duration' ); ?>" data-start-on-next="<?php the_field( 'start_carousel_on_next_slide' ); ?>">
		<?php $slides = get_field( 'slides' ); ?>
		<?php if ( count( $slides ) > 1 ): ?>
            <?php if ( get_field( 'enable_carousel_pagination' ) ) : ?>
			<div class="information-carousel-pagination" role="presentation"></div>
			<?php endif; ?>
            <?php if ( get_field( 'enable_carousel_navigation' ) ) : ?>
			<div class="information-carousel-navigation">
				<button class="information-carousel-navigation-prev" aria-label="<?php esc_attr_e( 'Previous Slide', 'bulk' ); ?>" title="<?php esc_attr_e( 'Previous Slide', 'bulk' ); ?>">
					<?php theme_block_asset( 'img/nav-button-left.svg' ); ?>
				</button>
				<button class="information-carousel-navigation-next" aria-label="<?php esc_attr_e( 'Next Slide', 'bulk' ); ?>" title="<?php esc_attr_e( 'Next Slide', 'bulk' ); ?>">
					<?php theme_block_asset( 'img/nav-button-right.svg' ); ?>
				</button>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="swiper-wrapper">
			<?php while( have_rows( 'slides' ) ): ?>
				<?php the_row(); ?>
				<div class="swiper-slide">
					<div class="information-carousel-slide">
						<?php $button = get_sub_field( 'link' ); ?>
						<?php if ( 'image' === get_sub_field( 'media_type' ) ) : ?>
							<?php $image = get_sub_field( 'image' ); ?>
							<?php if ( ! empty( $image ) ) : ?>
							<div class="information-carousel-media">
								<div class="information-carousel-image">
									<?php if ( ! empty( $button ) ) : ?>
										<a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
											<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
										</a>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
						<?php elseif ( in_array( get_sub_field( 'media_type' ), array( 'youtube', 'vimeo', 'video' ) ) ) : ?>
							<div class="information-carousel-media">
								<div class="information-carousel-video-player">
									<?php if ( 'video' === get_sub_field( 'media_type' ) ) : ?>
										<?php if ( ! empty( $button ) ) : ?>
											<a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
												<?php $file = get_sub_field( 'video_file' ); ?>
												<video autoplay playsinline muted>
													<source src="<?php echo esc_attr( $file['url'] ); ?>" type="<?php echo esc_attr( $file['mime_type'] ); ?>">
												</video>
											</a>
										<?php endif; ?>
									<?php elseif ( 'youtube' === get_sub_field( 'media_type' ) ) : ?>
										<?php if ( ! empty( $button ) ) : ?>
											<a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
												<iframe src="https://www.youtube.com/embed/<?php the_field( 'video_id' ); ?>?autoplay=1&mute=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
											</a>
										<?php endif; ?>
									<?php elseif ( 'vimeo' === get_sub_field( 'media_type' ) ) : ?>
										<?php if ( ! empty( $button ) ) : ?>
											<a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
												<iframe src="https://player.vimeo.com/video/<?php the_field( 'video_id' ); ?>?autoplay=1&byline=0&portrait=0&badge=0&background=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
											</a>
										<?php endif; ?>
									<?php endif; ?>
								</div>
							</div>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
