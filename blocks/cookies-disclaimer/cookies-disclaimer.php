<?php
/**
 * Block: Cookies Disclaimer
 *
 * @package bulk
 */

?>

<?php if ( get_field( 'message' ) ): ?>
<section <?php theme_block_attributes( $block, 'cookies-disclaimer' ); ?> data-content-width="<?php the_field( 'content_width' ); ?>" data-color-scheme="<?php the_field( 'color_scheme' ); ?>" role="dialog" aria-label="<?php esc_attr_e( 'Disclaimer', 'bulk' ); ?>">
    <div class="cookies-disclaimer-inner">
        <div class="cookies-disclaimer-message">
            <?php the_field( 'message' ); ?>
        </div>
        <button class="primary-button cookies-disclaimer-close">
            <?php the_field( 'button_label' ); ?>
        </button>
    </div>
</section>
<?php endif; ?>