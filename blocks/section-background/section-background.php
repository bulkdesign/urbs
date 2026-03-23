<?php
/**
 * Block: Section Background
 *
 * @package bulk
 */

?>

<?php $image = get_field('image'); ?>

<?php if ( get_field('add_background_image') == 'true' || ! empty($image)): ?>
    <?php $overlay_color = get_field('overlay_color'); ?>
    <div <?php theme_block_attributes( $block, 'section-background' ); ?> data-remove-padding-top="<?php the_field( 'remove_padding_top' ); ?>" data-remove-padding-bottom="<?php the_field( 'remove_padding_bottom' ); ?>" data-color-scheme="<?php the_field( 'color_scheme' ); ?>" style="background-image: linear-gradient(to bottom, rgba(<?php echo $overlay_color['red']; ?>, <?php echo $overlay_color['green']; ?>, <?php echo $overlay_color['blue']; ?>, <?php echo get_field('opacity'); ?>), rgba(<?php echo $overlay_color['red']; ?>, <?php echo $overlay_color['green']; ?>, <?php echo $overlay_color['blue']; ?>, <?php echo get_field('opacity'); ?>)), url(<?php echo esc_attr( $image['url'] ); ?>); background-size: <?php echo get_field('background_size'); ?>; background-attachment: <?php echo get_field('background_attachment'); ?>; background-position: <?php echo get_field('background_position'); ?>">
<?php else : ?>
    <div <?php theme_block_attributes( $block, 'section-background' ); ?> data-remove-padding-top="<?php the_field( 'remove_padding_top' ); ?>" data-remove-padding-bottom="<?php the_field( 'remove_padding_bottom' ); ?>" data-color-scheme="<?php the_field( 'color_scheme' ); ?>">
<?php endif; ?>
    <div class="blocks-container">
        <InnerBlocks />
    </div>
</div>