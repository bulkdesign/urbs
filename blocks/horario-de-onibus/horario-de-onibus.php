<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'horario-de-onibus' ); ?>>
    <?php if ( get_field( 'subtitle' ) ) : ?>
        <h3><?php the_field( 'subtitle' ); ?></h3>
    <?php endif; ?>

    <?php if ( get_field( 'description' ) ) : ?>
        <p><?php the_field( 'description' ); ?></p>
    <?php endif; ?>

    <div class="horario-de-onibus-content-wrapper">
        <div class="horario-de-onibus-filtros">
            <select name="horario-de-onibus-linhas">
                <option value="">Selecione uma linha</option>
            </select>
            <select name="horario-de-onibus-tipo-dia">
                <option value="">Selecione o dia</option>
                <option value="1">Dia Útil</option>
                <option value="2">Sábado</option>
                <option value="3">Domingo</option>
                <option value="4">Feriado</option>
            </select>
        </div>

        <div class="horario-de-onibus-linha-info"></div>
        <ul class="horario-de-onibus-lista"></ul>
    </div>
</div>