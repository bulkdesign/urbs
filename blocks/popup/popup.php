<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'popup' ); ?>>

    <div class="popup-content">
        <div class="popup-text">
            <h3><?php the_field('title'); ?></h3>
            <p><?php the_field('text'); ?></p>

            <?php $popup_link = get_field( 'link' ); ?>
            <?php if( ! empty( $popup_link ) ) : ?>
                <a class="primary-button" href="<?php echo esc_attr( $popup_link['url'] ); ?>" title="<?php echo esc_attr( $popup_link['title'] ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $popup_link ) ); ?>" target="<?php echo esc_attr( theme_get_link_target( $popup_link ) ); ?>">
                    <?php echo esc_attr( $popup_link['title'] ); ?>
                </a>
            <?php endif; ?>

        </div>
        <span class="popup-close">&times;</span>
    </div>

</div>