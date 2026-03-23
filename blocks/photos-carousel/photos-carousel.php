<?php
/**
 * Block: Photos Carousel
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'photos-carousel' ); ?> data-layout="<?php the_field( 'layout' ); ?>">
    <header class="photos-carousel-header" data-animation>
        <?php if ( get_field( 'title' ) ): ?>
        <h2 class="photos-carousel-title">
            <?php the_field( 'title' ); ?>
        </h2>
        <?php endif; ?>

        <?php if ( get_field( 'subtitle' ) ): ?>
        <h3 class="photos-carousel-subtitle">
            <?php the_field( 'subtitle' ); ?>
        </h3>
        <?php endif; ?>

        <?php if ( get_field( 'content' ) ): ?>
        <div class="photos-carousel-text">
            <?php the_field( 'content' ); ?>
        </div>
        <?php endif; ?>

        <?php if( get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ): ?>
        <div class="photos-carousel-buttons">
            <?php $button = get_field( 'primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button photos-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button photos-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button photos-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </header>
    <?php if ( have_rows( 'photos') ) : ?>
    <div class="photos-carousel-list-wrapper">
        <div class="swiper photos-carousel-list" data-loop="<?php the_field( 'enable_carousel_loop' ); ?>" data-autoplay="<?php the_field( 'enable_carousel_autoplay' ); ?>" data-caption="<?php the_field( 'enable_image_caption' ); ?>" data-animation>
            <div class="swiper-wrapper">
                <?php while ( have_rows( 'photos' ) ) : ?>
                <?php the_row(); ?>
                <div class="swiper-slide">
                    <div class="photos-carousel-list-item">
                        <?php $link = get_sub_field( 'link' ); ?>
                        <?php if( ! empty( $link ) ) : ?>
                        <a href="<?php echo esc_attr( $link['url'] ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>">
                        <?php endif; ?>
                            <?php $image = get_sub_field( 'image' ); ?>
                            <?php if ( ! empty( $image ) ) : ?>
                                <?php if( 'image/svg+xml' === $image['mime_type'] ): ?>
                                    <?php 
                                        // phpcs:ignore
                                        echo file_get_contents( get_attached_file( $image['ID'] ) );
                                    ?>
                                <?php else: ?>
                                    <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                                    <?php $caption = get_field( 'enable_image_caption' ); ?>
                                    <?php if ( $caption == 'true' && ! empty( wp_get_attachment_caption( $image['ID'] ) ) ): ?>
                                        <div class="photos-carousel-list-item-image-caption">
                                            <span><?php echo wp_get_attachment_caption( $image['ID'] ); ?></span>
                                        </div>
                                    <?php endif; ?>
                                <?php endif; ?>
                            <?php endif; ?>
                        <?php if( ! empty( $link ) ) : ?>
                        </a>
                        <?php endif; ?>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>
        
        <?php $photos = get_field( 'photos' ); ?>
        <?php if ( count( $photos ) > 1 ): ?>
            <?php if ( get_field( 'enable_carousel_pagination' ) ) : ?>
            <div class="photos-carousel-pagination" role="presentation" data-animation></div>
            <?php endif; ?>
            <?php if ( get_field( 'enable_carousel_navigation' ) ) : ?>
            <div class="photos-carousel-navigation" data-animation>
                <button class="photos-carousel-navigation-prev" aria-label="<?php esc_attr_e( 'Previous Logo', 'bulk' ); ?>" title="<?php esc_attr_e( 'Previous Logo', 'bulk' ); ?>">
                    <?php theme_block_asset( 'img/nav-button-left.svg' ); ?>
                </button>
                <button class="photos-carousel-navigation-next" aria-label="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>" title="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>">
                    <?php theme_block_asset( 'img/nav-button-right.svg' ); ?>
                </button>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>