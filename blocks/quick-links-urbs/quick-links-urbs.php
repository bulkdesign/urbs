<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'quick-links-urbs' ); ?>>
    <div class="quick-links-urbs-wrapper">
        <?php if( get_field( 'title' ) ): ?>
        <div class="quick-links-urbs-title">
            <h2><?php the_field( 'title' ); ?></h2>
        </div>
        <?php endif; ?>

        <div class="quick-links-urbs-inner">
            <?php if( have_rows( 'links' ) ): ?>
                <div class="quick-links-urbs-links">
                    <ul>
                        <?php while( have_rows( 'links' ) ): ?>
                        <?php the_row(); ?>
                        <li>
                            <?php $link = get_sub_field( 'link' ); ?>
                            <?php if ( ! empty( $link ) ) : ?>
                            <a href="<?php echo esc_attr( $link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>">
                                <?php if ( ! empty( $link['title'] ) ): ?>
                                    <?php echo wp_kses_post( $link['title'] ); ?>
                                <?php endif; ?>
                                
                                <?php $image = get_sub_field( 'logo' ); ?>
                                <?php if ( ! empty( $image ) ): ?>
                                    <?php if( 'image/svg+xml' === $image['mime_type'] ): ?>
                                        <?php 
                                            // phpcs:ignore
                                            echo file_get_contents( get_attached_file( $image['ID'] ) );
                                        ?>
                                    <?php else: ?>
                                        <?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
                                    <?php endif; ?>
                                <?php endif; ?>

                                <?php if ( '_blank' === theme_get_link_target( $link ) ) : ?>
                                <span class="sr-only">
                                    <?php esc_attr_e( '(Opens in a new tab)', 'bulk'); ?>
                                </span>
                                <?php endif; ?>
                            </a>
                            <?php endif; ?>
                        </li>
                        <?php endwhile; ?>
                    </ul>
                </div>
            <?php endif; ?>
        </div>
    </div>
</div>