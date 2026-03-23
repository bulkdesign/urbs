<?php
/**
 * Block: Logos Carousel
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'logos-carousel' ); ?> data-layout="<?php the_field( 'layout' ); ?>">
    <header class="logos-carousel-header" data-animation>
        <?php if ( get_field( 'title' ) ): ?>
        <h2 class="logos-carousel-title">
            <?php the_field( 'title' ); ?>
        </h2>
        <?php endif; ?>

        <?php if ( get_field( 'subtitle' ) ): ?>
        <h3 class="logos-carousel-subtitle">
            <?php the_field( 'subtitle' ); ?>
        </h3>
        <?php endif; ?>

        <?php if ( get_field( 'content' ) ): ?>
        <div class="logos-carousel-text">
            <?php the_field( 'content' ); ?>
        </div>
        <?php endif; ?>

        <?php if( get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ): ?>
        <div class="logos-carousel-buttons">
            <?php $button = get_field( 'primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button logos-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button logos-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button logos-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </header>
    <?php if ( have_rows( 'logos') ) : ?>
    <div class="logos-carousel-list-wrapper">
        <div class="swiper logos-carousel-list" data-loop="<?php the_field( 'enable_carousel_loop' ); ?>" data-autoplay="<?php the_field( 'enable_carousel_autoplay' ); ?>" data-animation>
            <div class="swiper-wrapper">
                <?php while ( have_rows( 'logos' ) ) : ?>
                <?php the_row(); ?>
                <div class="swiper-slide">
                    <div class="logos-carousel-list-item">
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
        
        <?php $logos = get_field( 'logos' ); ?>
        <?php if ( count( $logos ) > 1 ): ?>
            <?php if ( get_field( 'enable_carousel_pagination' ) ) : ?>
            <div class="logos-carousel-pagination" role="presentation" data-animation></div>
            <?php endif; ?>
            <?php if ( get_field( 'enable_carousel_navigation' ) ) : ?>
            <div class="logos-carousel-navigation" data-animation>
                <button class="logos-carousel-navigation-prev" aria-label="<?php esc_attr_e( 'Previous Logo', 'bulk' ); ?>" title="<?php esc_attr_e( 'Previous Logo', 'bulk' ); ?>">
                    <?php theme_block_asset( 'img/nav-button-left.svg' ); ?>
                </button>
                <button class="logos-carousel-navigation-next" aria-label="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>" title="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>">
                    <?php theme_block_asset( 'img/nav-button-right.svg' ); ?>
                </button>
            </div>
            <?php endif; ?>
        <?php endif; ?>
    </div>
    <?php endif; ?>
</section>