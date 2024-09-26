<?php
/**
 * Block: Links List
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'links-list' ); ?>>
    <div class="links-list-content" data-layout="<?php the_field( 'layout' ); ?>" data-color-scheme="light" data-animation>
        <div class="links-list-content-heading">
            <?php if (get_field( 'eyebrow' )): ?>
            <div class="eyebrow links-list-eyebrow">
                <?php the_field( 'eyebrow' ); ?>
            </div>
            <?php endif; ?>

            <?php if ( get_field( 'title' ) ): ?>
            <h2 class="links-list-title">
                <?php echo wp_kses_post( strip_tags( get_field( 'title' ), '<b><strong><i><em><u><br>' ) ); ?>
            </h2>
            <?php endif; ?>

            <?php if ( get_field( 'subtitle' ) ): ?>
            <h3 class="links-list-subtitle">
                <?php the_field( 'subtitle' ); ?>
            </h3>
            <?php endif; ?>
        </div>
        
        <?php if ( get_field( 'content' ) || get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ): ?>
            <div class="links-list-content-body">
                <div class="links-list-text">
                    <?php the_field( 'content' ); ?>
                </div>
            </div>
        <?php endif; ?>
        
        <?php if( have_rows( 'links' ) ): ?>
            <div class="links-list-columns">
                <?php while( have_rows( 'links' ) ): ?>
                    <?php the_row(); ?>
                    <?php $link = get_sub_field( 'link' ); ?>
                    <?php if ( ! empty( $link ) ) : ?>
                        <a class="links-list-item" href="<?php echo esc_attr( $link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>">
                            <div class="links-list-columns-item">
                                <?php echo wp_kses_post( $link['title'] ); ?>
                            </div>
                        </a>
                    <?php endif; ?>
                <?php endwhile; ?>
            </div>
        <?php endif; ?>
        
        <?php if( get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ): ?>
            <div class="links-list-buttons">
                <?php $button = get_field( 'primary_button' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="primary-button links-list-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>

                <?php $button = get_field( 'secondary_button' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="secondary-button links-list-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>

                <?php $button = get_field( 'tertiary_button' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="tertiary-button links-list-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>
            </div>
        <?php endif; ?>
    </div>
</section>