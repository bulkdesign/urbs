<?php
/**
 * Block: Title and Content
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'title-and-content' ); ?> data-columns="<?php the_field( 'columns' ); ?>">
    <?php $image = get_field('image'); ?>
    <?php $image_position = get_field('image_position'); ?>
    <?php if(!empty($image)): ?>
        <div class="image <?php echo $image_position; ?>">
            <?php if( 'image/svg+xml' === $image['mime_type'] ): ?>
                <?php 
                    // phpcs:ignore
                    echo file_get_contents( get_attached_file( $image['ID'] ) );
                ?>
            <?php else: ?>
                <img src="<?php echo esc_attr( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['title'] ); ?>" data-image-orientation="<?php the_field('image_orientation'); ?>" loading="lazy">
            <?php endif; ?>
        </div>
    <?php endif; ?>
    <div class="content <?php echo $image_position; ?>">
        <div class="title-and-content-title" data-animation>
            <?php if ( get_field( 'title' ) ) : ?>
            <h2><?php the_field( 'title' ); ?></h2>
            <?php endif; ?>
        </div>
        <div class="title-and-content-content" data-animation>
            <?php the_field( 'content' ); ?>

            <?php if( get_field( 'button_1' ) || get_field( 'button_2' ) || get_field( 'button_3' ) ): ?>
            <div class="title-and-content-buttons">
                <?php $button = get_field( 'button_1' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="primary-button page-hero-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>

                <?php $button = get_field( 'button_2' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="secondary-button page-hero-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>

                <?php $button = get_field( 'button_3' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="tertiary-button page-hero-carousel-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>

            <?php if( have_rows( 'image_button' ) ): ?>
                <div class="custom-button">
                    <?php while( have_rows( 'image_button' ) ): ?>
                        <?php the_row(); ?>
                        
                        <?php $image_button = get_sub_field( 'image' ); ?>
                        <?php $image_button_link = get_sub_field( 'link' ); ?>

                        <?php if ( $image_button_link ) : ?>

                                <?php if ( $image_button ) : ?>
                                    <a href="<?php echo esc_attr( $image_button_link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $image_button_link ) ); ?>" class="image-button" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $image_button_link ) ); ?>">
                                        <?php if(!empty( $image_button )): ?>
                                            <?php if( 'image/svg+xml' === $image_button['mime_type'] ): ?>
                                                <?php 
                                                    // phpcs:ignore
                                                    echo file_get_contents( get_attached_file( $image_button['ID'] ) );
                                                ?>
                                            <?php else: ?>
                                                <img src="<?php echo esc_attr( $image_button['url'] ); ?>" alt="<?php echo esc_attr( $image_button['title'] ); ?>" loading="lazy">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </a>
                                <?php endif; ?>

                        <?php endif; ?>
                    <?php endwhile; ?>
                </div>
            <?php endif; ?>
        </div>
    </div>
</section>