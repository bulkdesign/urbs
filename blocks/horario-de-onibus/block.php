<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_horario_de_onibus() {
    theme_declare_block(
        array(
            'name'        => 'horario-de-onibus',
            'title'       => __( 'Horário de Ônibus', 'bulk' ),
            'description' => __( 'Exibe a programação das linhas de ônibus.', 'bulk' ),
            'icon'        => 'calendar-alt',
            'mode'        => 'edit',
            'supports'    => array(
                'align'  => false,
                'mode'   => false,
                'anchor' => true,
            ),
            'enqueue_assets' => function() {
                // Enqueue Choices.js CSS
                wp_enqueue_style(
                    'choices-js',
                    'https://cdn.jsdelivr.net/npm/choices.js/public/assets/styles/choices.min.css',
                    array(),
                    '10.2.0'
                );

                // Enqueue Choices.js script
                wp_enqueue_script(
                    'choices-js',
                    'https://cdn.jsdelivr.net/npm/choices.js/public/assets/scripts/choices.min.js',
                    array(),
                    '10.2.0',
                    true
                );
            },
        )
    );
}

add_action( 'theme_declare_block', 'child_theme_block_horario_de_onibus', 20 );