<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'pmc-bar' ); ?>>
    <div class="pmc-bar-inner">
        <?php $logo = get_field( 'logo' ); ?>
        <?php $logo_link = get_field( 'logo_link' ); ?>

        <?php if ( ! empty( $logo ) || ! empty( $logo_link ) ): ?>
            <div class="pmc-bar-logo">
                <?php if ( ! empty( $logo_link ) ) : ?>
                    <a href="<?php echo esc_attr( $logo_link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $logo_link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $logo_link ) ); ?>" title="<?php echo esc_attr( $logo_link['title'] ); ?>">
                <?php endif; ?>
                    <?php if ( ! empty( $logo ) ) : ?>
                        <?php if ( 'image/svg+xml' === $logo['mime_type'] ): ?>
                            <?php 
                                // phpcs:ignore
                                echo file_get_contents( get_attached_file( $logo['ID'] ) );
                            ?>
                        <?php else: ?>
                            <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( $logo_link['title'] ); ?>">
                        <?php endif; ?>
                    <?php endif; ?>
                <?php if ( ! empty( $logo_link ) ) : ?>
                    </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>

        <?php if( have_rows( 'links' ) ): ?>
            <div class="pmc-bar-links">
                <ul>
                    <?php while( have_rows( 'links' ) ): ?>
                    <?php the_row(); ?>
                    <li>
                        <?php $link = get_sub_field( 'link' ); ?>
                        <?php if ( ! empty( $link ) ) : ?>
                        <a href="<?php echo esc_attr( $link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>">                            
                            <span>
                                <?php echo wp_kses_post( $link['title'] ); ?>
                            </span>

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