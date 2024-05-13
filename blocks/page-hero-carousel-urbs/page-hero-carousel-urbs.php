<?php
/**
 * Block: Page Hero
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'page-hero-carousel-urbs' ); ?> data-search="<?php the_field( 'enable_search' ); ?>" data-color-scheme="<?php the_field( 'color_scheme' ); ?>" data-content-width="<?php the_field('content_width'); ?>">
	<?php if( have_rows( 'slides' ) ): ?>
	<div class="page-hero-carousel-urbs-swiper swiper" data-autoplay="<?php the_field( 'enable_carousel_autoplay' ); ?>" data-autoplay-timeout="<?php the_field( 'carousel_slide_duration' ); ?>" data-start-on-next="<?php the_field( 'start_carousel_on_next_slide' ); ?>">
		<?php $slides = get_field( 'slides' ); ?>
		<?php if ( count( $slides ) > 1 ): ?>
            <?php if ( get_field( 'enable_carousel_pagination' ) ) : ?>
			<div class="page-hero-carousel-urbs-pagination" role="presentation"></div>
			<?php endif; ?>
            <?php if ( get_field( 'enable_carousel_navigation' ) ) : ?>
			<div class="page-hero-carousel-urbs-navigation">
				<button class="page-hero-carousel-urbs-navigation-prev" aria-label="<?php esc_attr_e( 'Previous Slide', 'bulk' ); ?>" title="<?php esc_attr_e( 'Previous Slide', 'bulk' ); ?>">
					<?php theme_block_asset( 'img/nav-button-left.svg' ); ?>
				</button>
				<button class="page-hero-carousel-urbs-navigation-next" aria-label="<?php esc_attr_e( 'Next Slide', 'bulk' ); ?>" title="<?php esc_attr_e( 'Next Slide', 'bulk' ); ?>">
					<?php theme_block_asset( 'img/nav-button-right.svg' ); ?>
				</button>
			</div>
			<?php endif; ?>
		<?php endif; ?>
		<div class="swiper-wrapper">
			<?php while( have_rows( 'slides' ) ): ?>
				<?php the_row(); ?>
				<div class="swiper-slide">
					<div class="page-hero-carousel-urbs-slide">
						<?php if ( 'image' === get_sub_field( 'media_type' ) ) : ?>
							<?php $image = get_sub_field( 'image' ); ?>
							<?php if ( ! empty( $image ) ) : ?>
							<div class="page-hero-carousel-urbs-media">
								<div class="page-hero-carousel-urbs-image">
									<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
								</div>
								
								<?php if ( get_field( 'enable_search' ) ): ?>
									<div class="page-hero-carousel-search">
										<div class="page-hero-carousel-search-wrapper">
											<form role="search" method="get" action="<?php echo esc_url( home_url( '/' ) ); ?>">
												<input type="text" value="<?php echo get_search_query(); ?>" name="s" id="s" placeholder="<?php echo esc_attr( get_field( 'search_placeholder' ) ); ?>" />
												<input type="submit" class="primary-button" value="<?php echo esc_attr( get_field( 'search_submit_text' ) ); ?>" />
											</form>
										</div>
									</div>
								<?php endif; ?>

							</div>
							<?php endif; ?>
						<?php elseif ( in_array( get_sub_field( 'media_type' ), array( 'youtube', 'vimeo', 'video' ) ) ) : ?>
							<div class="page-hero-carousel-urbs-media">
								<div class="page-hero-carousel-urbs-video-player">
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
						<?php endif; ?>
						<div class="page-hero-carousel-urbs-wrapper">
							<div class="page-hero-carousel-urbs-inner">
								<?php $breadcrumbs = get_sub_field( 'breadcrumbs' ); ?>
								<?php if ( ! empty( $breadcrumbs ) ) : ?>
								<ul class="page-hero-carousel-urbs-breadcrumbs">
									<?php foreach ( $breadcrumbs as $breadcrumb ) : ?>
										<li>
											<?php if ( 'text' === $breadcrumb['acf_fc_layout'] ) : ?>
											<span>
												<?php echo wp_kses_post( $breadcrumb['text'] ); ?>
											</span>
											<?php elseif ( 'link' === $breadcrumb['acf_fc_layout'] ) : ?>
												<?php $button = $breadcrumb['link']; ?>

												<?php if ( ! empty( $button ) ) : ?>
												<a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
													<?php echo wp_kses_post( $button['title'] ); ?>
												</a>
												<?php endif; ?>
											<?php endif; ?>
										</li>
									<?php endforeach; ?>
								</ul>
								<?php endif; ?>

								<?php if ( get_sub_field( 'eyebrow' ) ) : ?>
								<div class="eyebrow page-hero-carousel-urbs-eyebrow">
									<?php the_sub_field( 'eyebrow' ); ?>
								</div>
								<?php endif; ?>

								<?php if ( get_sub_field( 'title' ) ) : ?>
								<h1 class="page-hero-carousel-urbs-title">
									<?php echo wp_kses_post( strip_tags( get_sub_field( 'title' ), '<span><u><br><strong><em>' ) ); ?>
								</h1>
								<?php endif; ?>

								<?php if ( get_sub_field( 'content' ) ) : ?>
								<div class="page-hero-carousel-urbs-content">
									<?php the_sub_field( 'content' ); ?>
								</div>
								<?php endif; ?>

								<?php if( get_sub_field( 'button_1' ) || get_sub_field( 'button_2' ) || get_sub_field( 'button_3' ) ): ?>
								<div class="page-hero-carousel-urbs-buttons">
									<?php $button = get_sub_field( 'button_1' ); ?>
									<?php if ( ! empty( $button ) ) : ?>
									<a class="primary-button page-hero-carousel-urbs-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
										<?php echo wp_kses_post( $button['title'] ); ?>
									</a>
									<?php endif; ?>

									<?php $button = get_sub_field( 'button_2' ); ?>
									<?php if ( ! empty( $button ) ) : ?>
									<a class="secondary-button page-hero-carousel-urbs-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
										<?php echo wp_kses_post( $button['title'] ); ?>
									</a>
									<?php endif; ?>

									<?php $button = get_sub_field( 'button_3' ); ?>
									<?php if ( ! empty( $button ) ) : ?>
									<a class="tertiary-button page-hero-carousel-urbs-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
										<?php echo wp_kses_post( $button['title'] ); ?>
									</a>
									<?php endif; ?>
								</div>
								<?php endif; ?>
							</div>
						</div>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
