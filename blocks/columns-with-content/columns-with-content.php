<?php
/**
 * Block: Content with Media
 *
 * @package bulk
 */

?>

<?php if ( have_rows( 'columns' ) ) : ?>
<section <?php theme_block_attributes( $block, 'columns-with-content alignwide' ); ?> data-layout="<?php the_field( 'column_layout' ); ?>" data-vertical-align="<?php the_field( 'vertical_align' ); ?>">
    <?php while ( have_rows( 'columns' ) ) : ?>
        <?php the_row(); ?>
        <div class="columns-with-content-column" data-animation>
            <?php if ( get_sub_field( 'eyebrow' ) ) : ?>
            <div class="eyebrow columns-with-content-column-eyebrow">
                <?php the_sub_field( 'eyebrow' ); ?>
            </div>
            <?php endif; ?>

            <?php if ( get_sub_field( 'title' ) ) : ?>
            <h2 class="columns-with-content-column-title <?php the_sub_field( 'title_size' ); ?>">
                <?php the_sub_field( 'title' ); ?>
            </h2>
            <?php endif; ?>

            <?php if ( get_sub_field( 'content' ) ) : ?>
            <div class="columns-with-content-column-content" data-text-size="<?php the_sub_field( 'text_size' ); ?>">
                <?php the_sub_field( 'content' ); ?>
            </div>
            <?php endif; ?>

            <?php if( get_sub_field( 'primary_button' ) || get_sub_field( 'secondary_button' ) || get_sub_field( 'tertiary_button' ) ): ?>
            <div class="columns-with-content-column-buttons">
                <?php $button = get_sub_field( 'primary_button' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="primary-button columns-with-content-column-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>

                <?php $button = get_sub_field( 'secondary_button' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="secondary-button columns-with-content-column-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>

                <?php $button = get_sub_field( 'tertiary_button' ); ?>
                <?php if ( ! empty( $button ) ) : ?>
                <a class="tertiary-button columns-with-content-column-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                    <?php echo wp_kses_post( $button['title'] ); ?>
                </a>
                <?php endif; ?>
            </div>
            <?php endif; ?>
        </div>
    <?php endwhile; ?>
</section>
<?php endif; ?>