<?php
/**
 * Block: FAQ Accordion
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'faq-accordion alignwide' ); ?> data-align="<?php the_field( 'align' ); ?>" data-columns="<?php the_field( 'columns' ); ?>">
    <?php if ( get_field( 'header_title' ) || get_field( 'header_description' ) ) : ?>
    <header data-animation>
        <?php if ( get_field( 'header_title' ) ) : ?>
        <h2><?php echo wp_kses_post( strip_tags( get_field( 'header_title' ), '<b><strong><i><em><u>' ) ); ?></h2>
        <?php endif; ?>

        <?php if ( get_field( 'header_description' ) ) : ?>
        <p><?php the_field( 'header_description' ); ?></p>
        <?php endif; ?>

        <?php if ( get_field( 'header_primary_button' ) || get_field( 'header_secondary_button' ) || get_field( 'header_tertiary_button' ) ) : ?>
        <div class="faq-accordion-buttons">
            <?php $button = get_field( 'header_primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button faq-accordion-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'header_secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button faq-accordion-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'header_tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button faq-accordion-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>            
        </div>
        <?php endif; ?>
    </header>
    <?php endif; ?>

    <?php if ( have_rows( 'questions' ) ): ?>
    <div class="faq-accordion-grid" data-animation>
        <?php while ( have_rows( 'questions' ) ) : ?>
            <?php the_row(); ?>
            <details>
                <summary>
                    <?php the_sub_field('question'); ?>
                </summary>
                <div>
                    <?php the_sub_field('answer'); ?>
                    
                    <?php if( get_sub_field( 'button_1' ) || get_sub_field( 'button_2' ) || get_sub_field( 'button_3' ) ): ?>
                    <div class="faq-accordion-grid-buttons">
                        <?php $button = get_sub_field( 'button_1' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a class="primary-button faq-accordion-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>

                        <?php $button = get_sub_field( 'button_2' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a class="secondary-button faq-accordion-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>

                        <?php $button = get_sub_field( 'button_3' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a class="tertiary-button faq-accordion-grid-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                </div>
            </details>
        <?php endwhile; ?>
    </div>
    <?php endif; ?>

    <?php if ( get_field( 'footer_title' ) || get_field( 'footer_description' ) || get_field( 'footer_primary_button' ) || get_field( 'footer_secondary_button' ) || get_field( 'footer_tertiary_button' ) ) : ?>
    <footer data-animation>
        <?php if ( get_field( 'footer_title' ) ) : ?>
        <h3><?php the_field( 'footer_title' ); ?></h3>
        <?php endif; ?>

        <?php if ( get_field( 'footer_description' ) ) : ?>
        <p><?php the_field( 'footer_description' ); ?>
        <?php endif; ?>

        <?php if ( get_field( 'footer_primary_button' ) || get_field( 'footer_secondary_button' ) || get_field( 'footer_tertiary_button' ) ) : ?>
        <div class="faq-accordion-buttons">
            <?php $button = get_field( 'footer_primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button faq-accordion-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'footer_secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button faq-accordion-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'footer_tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button faq-accordion-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>            
        </div>
        <?php endif; ?>
    </footer>
    <?php endif; ?>
</section>