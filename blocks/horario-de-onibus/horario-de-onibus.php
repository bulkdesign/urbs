<?php
/**
 * The block code
 *
 * @package bulk
 */

?>

<div <?php theme_block_attributes( $block, 'horario-de-onibus' ); ?>>

    <h2>Horário de Ônibus</h2>

    <select name="horario-de-onibus-linhas">
        <option value="">Selecione um ponto</option>
    </select>

    <ul class="horario-de-onibus-lista">
        <li></li>
    </ul>

</div>