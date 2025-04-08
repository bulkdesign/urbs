<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'services' ); ?>>
    <?php if( have_rows( 'service' ) ): ?>
        <ul>
            <?php while( have_rows( 'service' ) ): ?>
                <?php the_row(); ?>

                <?php $image = get_sub_field( 'image' ); ?>
                <?php $button = get_sub_field( 'link' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                    <a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>" title="<?php echo esc_attr( $button['title'] ); ?>">
                        <li>
                            <?php if(!empty($image)): ?>
                                <?php if( 'image/svg+xml' === $image['mime_type'] ): ?>
                                    <div class="service-icon">
                                        <?php 
                                            // phpcs:ignore
                                            echo file_get_contents( get_attached_file( $image['ID'] ) );
                                        ?>
                                    </div>
                                <?php else: ?>
                                    <div class="icon">
                                        <img src="<?php echo esc_attr( $image['url'] ); ?>" alt="<?php echo esc_attr( $button['title'] ); ?>" loading="lazy">
                                    </div>
                                <?php endif; ?>
                            <?php endif; ?>
                            <?php if ( ! empty( get_sub_field('title') ) ): ?>
                                <div class="service-title">
                                    <h3><?php echo get_sub_field('title'); ?></h3>
                                </div>
                            <?php endif; ?>
                        </li>
                    </a>
                <?php endif; ?>
            <?php endwhile; ?>
        </ul>
    <?php endif; ?>
</div>