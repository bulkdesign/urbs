<?php
/**
 * Block: Logos Grid
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'logos-grid alignwide' ); ?> data-layout="<?php the_field( 'layout' ); ?>">
    <header class="logos-grid-header" data-animation>
        <?php if ( get_field( 'title' ) ): ?>
        <h2 class="logos-grid-title">
            <?php the_field( 'title' ); ?>
        </h2>
        <?php endif; ?>

        <?php if ( get_field( 'subtitle' ) ): ?>
        <h3 class="logos-grid-subtitle">
            <?php the_field( 'subtitle' ); ?>
        </h3>
        <?php endif; ?>

        <?php if ( get_field( 'content' ) ): ?>
        <div class="logos-grid-text">
            <?php the_field( 'content' ); ?>
        </div>
        <?php endif; ?>

        <?php if( get_field( 'buttons_position' ) !== 'footer' && ( get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ) ): ?>
        <div class="logos-grid-buttons">
            <?php $button = get_field( 'primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button logos-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button logos-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button logos-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </header>

    <?php if ( have_rows( 'logos') ) : ?>
    <ul class="logos-grid-list" data-columns="<?php the_field( 'logo_columns' ); ?>">
        <?php while ( have_rows( 'logos' ) ) : ?>
        <?php the_row(); ?>
        <li class="logos-grid-list-item" data-animation>
            <?php $link = get_sub_field( 'link' ); ?>
            <?php if( ! empty( $link ) ) : ?>
            <a href="<?php echo esc_attr( $link['url'] ); ?>" title="<?php echo esc_attr( $link['title'] ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>">
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
        </li>
        <?php endwhile; ?>
    </ul>
    <?php endif; ?>

    <?php if ( get_field( 'buttons_position' ) === 'footer' && ( get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ) ) : ?>
    <footer class="logos-grid-footer" data-animation>
        <div class="logos-grid-buttons">
            <?php $button = get_field( 'primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button logos-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button logos-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button logos-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>
        </div>
    </footer>
    <?php endif; ?>
</section>