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
					
						<?php $image = get_sub_field( 'image' ); ?>
						<?php if ( ! empty( $image ) ) : ?>

							<?php $button = get_sub_field( 'link' ); ?>
							<?php if ( ! empty( $button ) ) : ?>
								<a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
									<div class="information-carousel-media">
										<div class="information-carousel-image">
											<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
											<div class="information-carousel-image-overlay"></div>

											<div class="information-carousel-content">
												<?php if ( ! empty( get_sub_field('title') ) ): ?>
													<div class="information-carousel-title">
														<h2><?php echo get_sub_field('title'); ?></h2>
													</div>
												<?php endif; ?>

												<div class="information-carousel-inner-content-wrapper">
													<?php while( have_rows( 'content' ) ): ?>
														<?php the_row(); ?>
															<div class="information-carousel-inner-content">
																<?php if ( ! empty( get_sub_field('title') ) ): ?>
																	<h3 style="color: var(--color-<?php echo get_sub_field('title_color'); ?>);">
																		<?php echo get_sub_field('title'); ?>
																	</h3>
																<?php endif; ?>

																<?php if ( ! empty( get_sub_field('text') ) ): ?>
																	<?php echo get_sub_field('text'); ?>
																<?php endif; ?>
															</div>
													<?php endwhile; ?>
												</div>

												<?php if ( get_sub_field( 'footer_note' ) ): ?>
													<div class="information-carousel-footer-note">
														<p><?php the_sub_field( 'footer_note' ); ?></p>
													</div>
												<?php endif; ?>
											</div>
										</div>
									</div>
								</a>
								
								<?php else: ?>

								<div class="information-carousel-media">
									<div class="information-carousel-image">
										<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
										<div class="information-carousel-image-overlay"></div>

										<div class="information-carousel-content">
											<?php if ( ! empty( get_sub_field('title') ) ): ?>
												<div class="information-carousel-title">
													<h2><?php echo get_sub_field('title'); ?></h2>
												</div>
											<?php endif; ?>

											<div class="information-carousel-inner-content-wrapper">
												<?php while( have_rows( 'content' ) ): ?>
													<?php the_row(); ?>
														<div class="information-carousel-inner-content">
															<?php if ( ! empty( get_sub_field('title') ) ): ?>
																<h3 style="color: var(--color-<?php echo get_sub_field('title_color'); ?>);">
																	<?php echo get_sub_field('title'); ?>
																</h3>
															<?php endif; ?>

															<?php if ( ! empty( get_sub_field('text') ) ): ?>
																<?php echo get_sub_field('text'); ?>
															<?php endif; ?>
														</div>
												<?php endwhile; ?>
											</div>

											<?php if ( get_sub_field( 'footer_note' ) ): ?>
												<div class="information-carousel-footer-note">
													<p><?php the_sub_field( 'footer_note' ); ?></p>
												</div>
											<?php endif; ?>
										</div>
									</div>
								</div>
							<?php endif; ?>
						<?php endif; ?>
					</div>
				</div>
			<?php endwhile; ?>
		</div>
	</div>
	<?php endif; ?>
</div>
