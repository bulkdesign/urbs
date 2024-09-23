<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'boletins-urbs' ); ?>>

    <?php if ( ! empty( get_field('title') ) ): ?>
        <h2><?php echo get_field('title'); ?></h2>
    <?php endif; ?>

    <?php if ( ! empty( get_field('subtitle') ) ): ?>
        <p><?php echo get_field('subtitle'); ?></p>
    <?php endif; ?>

    <div class="news">

        <?php
        $args = array( 
            'post_type'      => 'boletim-do-transport',
            'post_status'    => 'publish',
            'posts_per_page' => 9,
            'orderby'        => 'date',
            'order'          => 'DESC'
        );

        $the_query = new WP_Query( $args );
        ?>

        <?php if ( $the_query->have_posts() ) : ?>
            <div class="boletins-urbs-wrapper">
                <div class="swiper boletins-carousel" data-loop="<?php the_field( 'enable_carousel_loop' ); ?>" data-autoplay="<?php the_field( 'enable_carousel_autoplay' ); ?>" data-animation>
                    <div class="swiper-wrapper">
                        <?php while ( $the_query->have_posts() ) : ?>
                            <?php $the_query->the_post(); ?>

                            <?php $featured_image = get_the_post_thumbnail_url( get_the_ID(), 'large' ); ?>
                            <?php $featured_image_alt = get_post_meta($featured_image , '_wp_attachment_image_alt', true); ?>
                            
                            <div class="swiper-slide">
                                <div class="latest-news-item">
                                    <?php if ( ! empty( $featured_image ) ) : ?>
                                        <a class="news-wrapper" href="<?php echo get_permalink(); ?>">
                                            <img src="<?php echo $featured_image; ?>" alt="<?php echo $featured_image_alt; ?>" title="<?php the_title(); ?>">
                                        </a>
                                    <?php endif; ?>
                                    <a href="<?php echo get_permalink(); ?>">
                                        <h3><?php the_title(); ?></h3>
                                    </a>
                                    <p class="excerpt">
                                        <?php echo get_the_excerpt(); ?>
                                    </p>
                                    <a href="<?php the_permalink(); ?>" class="primary-button"><?php esc_html_e('Leia Mais', 'bulk'); ?></a>
                                </div>
                            </div>        
                        <?php endwhile; ?>
                    </div>

                    <?php if ( get_field( 'enable_carousel_navigation' ) ) : ?>
                        <div class="boletins-urbs-navigation" data-animation>
                            <button class="boletins-urbs-navigation-next" aria-label="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>" title="<?php esc_attr_e( 'Next Logo', 'bulk' ); ?>">
                                <?php theme_block_asset( 'img/nav-button-right.svg' ); ?>
                            </button>
                        </div>
                    <?php endif; ?>

                </div>

                <?php if ( get_field( 'enable_carousel_pagination' ) ) : ?>
                    <div class="boletins-urbs-pagination" role="presentation" data-animation></div>
                <?php endif; ?>
            </div>
        <?php endif; ?>

    </div>

    <?php $button = get_field( 'primary_button' ); ?>
    <?php if ( ! empty( $button ) ) : ?>
    <a class="primary-button all-news" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
        <?php echo wp_kses_post( $button['title'] ); ?>
    </a>
    <?php endif; ?>

</section>