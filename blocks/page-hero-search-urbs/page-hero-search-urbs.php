<?php
/**
 * Block: Page Hero Search
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'page-hero-search-urbs' ); ?>>
	<?php if( have_rows( 'slides' ) ): ?>
	<div class="page-hero-search-urbs-swiper swiper">
		<?php $slides = get_field( 'slides' ); ?>
		<?php if ( count( $slides ) > 1 ): ?>
			<div class="page-hero-search-urbs-navigation">
				<button class="page-hero-search-urbs-navigation-prev" aria-label="<?php esc_attr_e( 'Previous Slide', 'bulk' ); ?>" title="<?php esc_attr_e( 'Previous Slide', 'bulk' ); ?>">
					<?php theme_block_asset( 'img/nav-button-left.svg' ); ?>
				</button>
				<button class="page-hero-search-urbs-navigation-next" aria-label="<?php esc_attr_e( 'Next Slide', 'bulk' ); ?>" title="<?php esc_attr_e( 'Next Slide', 'bulk' ); ?>">
					<?php theme_block_asset( 'img/nav-button-right.svg' ); ?>
				</button>
			</div>
		<?php endif; ?>

		<div class="page-hero-carousel-search">
			<div class="page-hero-carousel-search-wrapper">
				<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
					<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr( get_field( 'search_placeholder' ) ); ?>" />
					<input type="submit" class="primary-button" value="<?php echo esc_attr( get_field( 'search_submit_text' ) ); ?>" />
				</form>
			</div>
		</div>

		<div class="swiper-wrapper">
			<?php while( have_rows( 'slides' ) ): ?>
				<?php the_row(); ?>
				<div class="swiper-slide">
					<div class="page-hero-search-urbs-slide">						
						<?php $link = get_sub_field( 'slide_link' ); ?>

						<?php if ( 'image' === get_sub_field( 'media_type' ) ) : ?>
							<?php $image = get_sub_field( 'image' ); ?>

							<?php if ( ! empty( $link ) ) : ?>
								<a href="<?php echo esc_attr( $link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>">
							<?php endif; ?>
							
							<?php if ( ! empty( $image ) ) : ?>
								<div class="page-hero-search-urbs-media">
									<div class="page-hero-search-urbs-image">
										<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
									</div>
								</div>
							<?php endif; ?>

							<?php if ( ! empty( $link ) ) : ?>
								</a>
							<?php endif; ?>
						<?php elseif ( in_array( get_sub_field( 'media_type' ), array( 'youtube', 'vimeo', 'video' ) ) ) : ?>

							<?php if ( ! empty( $link ) ) : ?>
								<a href="<?php echo esc_attr( $link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>">
							<?php endif; ?>

							<div class="page-hero-search-urbs-media">
								<div class="page-hero-search-urbs-video-player">
									<?php if ( 'video' === get_sub_field( 'media_type' ) ) : ?>
										<?php $file = get_sub_field( 'video_file' ); ?>
										<video autoplay playsinline muted>
											<source src="<?php echo esc_attr( $file['url'] ); ?>" type="<?php echo esc_attr( $file['mime_type'] ); ?>">
										</video>
									<?php elseif ( 'youtube' === get_sub_field( 'media_type' ) ) : ?>
										<iframe src="https://www.youtube.com/embed/<?php the_field( 'video_id' ); ?>?autoplay=1&mute=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
									<?php elseif ( 'vimeo' === get_sub_field( 'media_type' ) ) : ?>
										<iframe src="https://player.vimeo.com/video/<?php the_field( 'video_id' ); ?>?autoplay=1&byline=0&portrait=0&badge=0&background=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
									<?php endif; ?>
								</div>
							</div>

							<?php if ( ! empty( $link ) ) : ?>
								</a>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
