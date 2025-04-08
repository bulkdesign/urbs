<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'featured-columns' ); ?>>
    <?php if( have_rows( 'titulo_da_secao' ) ): ?>
        
        <?php while( have_rows( 'titulo_da_secao' ) ): ?>
            <?php the_row(); ?>

            <?php $title = get_field( 'titulo_da_secao_title' ); ?>
            <?php $subtitle = get_field( 'titulo_da_secao_subtitle' ); ?>
            <?php $image = get_field( 'titulo_da_secao_image' ); ?>
            <?php $colorScheme = get_field( 'titulo_da_secao_color_scheme' ); ?>

            <div class="section-title" data-color-scheme="<?php echo esc_attr( $colorScheme ); ?>">
                <?php if ( ! empty( $title ) || ! empty( $image ) ) : ?>
                    <?php if(!empty($image)): ?>
                        <?php if( 'image/svg+xml' === $image['mime_type'] ): ?>
                            <?php 
                                // phpcs:ignore
                                echo file_get_contents( get_attached_file( $image['ID'] ) );
                            ?>
                        <?php else: ?>
                            <img src="<?php echo esc_attr( $image['url'] ); ?>" alt="<?php echo esc_attr( $title ); ?>" loading="lazy">
                        <?php endif; ?>
                    <?php endif; ?>

                    <?php if ( ! empty( $title ) || ! empty( $subtitle ) ) : ?>
                        <div class="section-title-text">
                            <?php if ( ! empty( $title ) ) : ?>
                                <h3><?php echo esc_html( $title ); ?></h3>
                            <?php endif; ?>

                            <?php if ( ! empty( $subtitle ) ) : ?>
                                <p><?php echo esc_html( $subtitle ); ?></p>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>
                <?php endif; ?>
            </div>
        <?php endwhile; ?>
        
    <?php endif; ?>

    <?php if ( ! empty(get_field( 'conteudo' ) ) ) : ?>
        <div class="section-content">
            <?php the_field( 'conteudo' ); ?>
        </div>
    <?php endif; ?>

    <?php if( have_rows( 'botao' ) ): ?>
        <div class="section-buttons">
            <?php while( have_rows( 'botao' ) ): ?>
                <?php the_row(); ?>

                <?php $link = get_sub_field( 'link' ); ?>
                <?php $colorScheme = get_sub_field( 'color_scheme' ); ?>

                <?php if ( ! empty( $link ) ) : ?>
                    <a class="primary-button" href="<?php echo esc_attr( $link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>" data-color-scheme="<?php echo esc_attr( $colorScheme ); ?>">
                        <?php echo wp_kses_post( $link['title'] ); ?>
                    </a>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</div>