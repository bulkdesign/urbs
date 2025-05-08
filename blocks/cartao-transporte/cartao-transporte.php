<?php
/**
 * Block: Cartão Transporte
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'cartao-transporte' ); ?>>
    <?php if ( have_rows( 'cartoes') ) : ?>

        <div role="tablist" aria-label="<?php esc_attr_e( 'Cartão Transporte URBS', 'bulk' ); ?>" class="cartao-transporte-tabs">
            <?php while ( have_rows( 'cartoes' ) ) : ?>
            <?php the_row(); ?>
                <button class="tablink primary-button" role="tab" aria-label="<?php echo esc_attr( get_sub_field('cartao_titulo') ); ?>" id="<?php echo strtolower( str_replace( ' ', '-', get_sub_field('cartao_titulo') ) ); ?>" aria-selected="false">
                    <?php the_sub_field('cartao_titulo'); ?>

                    <?php $icon = get_sub_field( 'icone_do_cartao' ); ?>
                    <?php if ( ! empty( $icon ) ) : ?>
                        <?php if( 'image/svg+xml' === $icon['mime_type'] ): ?>
                            <?php
                                // phpcs:ignore
                                echo file_get_contents( get_attached_file( $icon['ID'] ) );
                            ?>
                        <?php else: ?>
                            <?php echo wp_get_attachment_image( $icon['ID'], 'full' ); ?>
                        <?php endif; ?>
                    <?php endif; ?>
                </button>
            <?php endwhile; ?>
        </div>

        <div class="cartao-transporte-list-wrapper">
            <?php while ( have_rows( 'cartoes' ) ) : ?>
            <?php the_row(); ?>
                <div class="cartao-transporte-list-item" role="tabpanel" aria-labelledby="<?php echo strtolower( str_replace( ' ', '-', get_sub_field('cartao_titulo') ) ); ?>" hidden>
                    <?php $image = get_sub_field( 'imagem' ); ?>
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
                    <?php if ( ! empty( get_sub_field( 'cartao_titulo' ) || get_sub_field( 'descricao' ) ) ): ?>
                        <div class="cartao-transporte-item-info">
                            <?php if ( ! empty( get_sub_field( 'cartao_titulo' ) ) ): ?>
                                <h3><?php the_sub_field( 'cartao_titulo' ); ?></h3>
                            <?php endif; ?>

                            <?php if ( ! empty( get_sub_field( 'descricao' ) ) ): ?>
                                <div class="cartao-transporte-item-description">
                                    <?php the_sub_field( 'descricao' ); ?>
                                </div>
                            <?php endif; ?>

                            <?php if ( ! empty( get_sub_field( 'link_externo' ) ) ): ?>
                                <?php $link = get_sub_field( 'link_externo' ); ?>
                                <a href="<?php echo esc_attr( $link['url'] ); ?>" class="primary-button" title="<?php echo esc_attr( $link['title'] ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>">
                                    <?php echo esc_attr( $link['title'] ); ?>
                                </a>
                            <?php endif; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( have_rows( 'links' ) ) : ?>
                        <div class="cartao-transporte-links">
                            <?php while ( have_rows( 'links' ) ) : ?>
                                <?php the_row(); ?>
                                <?php $link = get_sub_field( 'link' ); ?>

                                <?php if( ! empty( $link ) ) : ?>
                                    <a href="<?php echo esc_attr( $link['url'] ); ?>" class="primary-button" title="<?php echo esc_attr( $link['title'] ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $link ) ); ?>" target="<?php echo esc_attr( theme_get_link_target( $link ) ); ?>">
                                        <?php echo esc_attr( $link['title'] ); ?>
                                    </a>
                                <?php endif; ?>
                            <?php endwhile; ?>
                        </div>
                    <?php endif; ?>

                    <?php if ( have_rows( 'informacoes' ) ) : ?>
                        <?php
                        // Store all tab data in an array first
                        $tabs = array();
                        while ( have_rows( 'informacoes' ) ) {
                            the_row();
                            $pergunta = get_sub_field( 'pergunta' );
                            $resposta = get_sub_field( 'resposta' );
                            if ( ! empty( $pergunta ) && ! empty( $resposta ) ) {
                                $tabs[] = array(
                                    'pergunta' => $pergunta,
                                    'resposta' => $resposta,
                                    'id' => strtolower( str_replace( ' ', '-', $pergunta ) )
                                );
                            }
                        }
                        ?>

                        <div class="cartao-transporte-informacoes">
                            <div class="cartao-transporte-informacoes-wrapper" role="tablist" aria-label="<?php esc_attr_e( 'Informações do Cartão', 'bulk' ); ?>">
                                <div class="cartao-transporte-informacoes-tabs">
                                    <?php foreach ( $tabs as $index => $tab ) : ?>
                                        <button class="informacoesTab primary-button" role="tab" aria-label="<?php echo esc_attr( $tab['pergunta'] ); ?>" id="<?php echo esc_attr( $tab['id'] ); ?>" aria-selected="<?php echo $index === 0 ? 'true' : 'false'; ?>">
                                            <?php echo esc_html( $tab['pergunta'] ); ?>
                                            <span class="informacoesTab-icon"></span>
                                        </button>
                                    <?php endforeach; ?>
                                </div>

                                <?php foreach ( $tabs as $index => $tab ) : ?>
                                    <div class="cartao-transporte-informacoes-tabs-content" role="tabpanel" aria-labelledby="<?php echo esc_attr( $tab['id'] ); ?>" <?php echo $index === 0 ? '' : 'hidden'; ?>>
                                        <?php echo wp_kses_post( $tab['resposta'] ); ?>
                                    </div>
                                <?php endforeach; ?>
                            </div>
                        </div>
                    <?php endif; ?>
                </div>
            <?php endwhile; ?>
        </div>
    <?php endif; ?>
</section>