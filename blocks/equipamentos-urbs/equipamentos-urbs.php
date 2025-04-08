<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'equipamentos-urbs' ); ?>>

    <?php $background = get_field( 'background' ); ?>

    <?php if ( ! empty( $background ) || get_field( 'title' ) || get_field( 'subtitle' ) ) : ?>

        <div class="equipamentos-urbs-wrapper">

            <?php if ( ! empty( $background ) ) : ?>
                <div class="equipamentos-urbs-background">
                    <?php echo wp_get_attachment_image( $background['ID'], 'full' ); ?>
                </div>
            <?php endif; ?>

            <?php if ( get_field( 'title' ) || get_field( 'subtitle' ) ) : ?>
                <div class="equipamentos-urbs-heading">
                    <?php if ( get_field( 'title' ) ) : ?>
                        <div class="equipamentos-urbs-title">
                            <h2><?php the_field('title'); ?></h2>
                        </div>
                    <?php endif; ?>

                    <?php if ( ! empty( get_field( 'subtitle' ) ) ): ?>
                        <div class="equipamentos-urbs-subtitle">
                            <?php the_field( 'subtitle' ); ?>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if ( have_rows( 'equipamentos' ) ) : ?>
                <div class="equipamentos-urbs-carousel">
                    <div class="swiper equipamentos-item" data-loop="<?php the_field( 'enable_carousel_loop' ); ?>" data-autoplay="<?php the_field( 'enable_carousel_autoplay' ); ?>" data-animation>
                        <div class="swiper-wrapper">
                            <?php while ( have_rows( 'equipamentos' ) ) : ?>
                                <?php the_row(); ?>
                        
                                <div class="swiper-slide">
                                
                                    <?php $background = get_sub_field( 'background_image' ); ?>
                                    <?php $link = get_sub_field( 'link' ); ?>

                                    <?php if ( ! empty( $background ) || ! empty( $link ) || get_sub_field( 'title' ) || get_sub_field( 'description' ) ) : ?>
                                        <?php if ( ! empty( $link ) ) : ?>
                                            <a href="<?php echo esc_attr( $link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>">
                                        <?php endif; ?>
                                            <?php if ( ! empty( $background ) ) : ?>
                                                <div class="equipamentos-urbs-image">
                                                    <?php echo wp_get_attachment_image( $background['ID'], 'full', false,
                                                        [
                                                            'class' => '',
                                                            'loading' => false
                                                        ]
                                                    ); ?>
                                                </div>
                                            <?php endif; ?>
                                            <?php if ( get_sub_field( 'title' ) || get_sub_field( 'description' ) ) : ?>
                                                <div class="equipamentos-urbs-content-wrapper">
                                                    <?php if ( get_sub_field( 'title' ) ) : ?>
                                                        <h3 class="equipamentos-urbs-title">
                                                            <?php echo wp_kses_post( strip_tags( get_sub_field( 'title' ), '<span><u><br><strong><em>' ) ); ?>
                                                        </h3>
                                                        <?php endif; ?>

                                                        <?php if ( get_sub_field( 'description' ) ) : ?>
                                                        <div class="equipamentos-urbs-description">
                                                            <?php the_sub_field( 'description' ); ?>
                                                        </div>
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                        <?php if ( ! empty( $link ) ) : ?>
                                            </a>
                                        <?php endif; ?>
                                    <?php endif; ?>
                                </div>
                            <?php endwhile; ?>
                        </div>

                        <?php if ( get_field( 'enable_carousel_navigation' ) ) : ?>
                            <div class="equipamentos-urbs-navigation" data-animation>
                                <button class="equipamentos-urbs-navigation-next" aria-label="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>" title="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>">
                                    <?php theme_block_asset( 'img/nav-button-right.svg' ); ?>
                                </button>
                            </div>
                        <?php endif; ?>

                        <?php if ( get_field( 'enable_carousel_pagination' ) ) : ?>
                            <div class="equipamentos-urbs-pagination" role="presentation" data-animation></div>
                        <?php endif; ?>

                    </div>
                </div>
            <?php endif; ?>

        </div>

    <?php endif; ?>

</section>