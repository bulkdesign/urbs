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
			'description' => __( 'Displays the bus lines schedule.', 'bulk' ),
			'icon'        => 'calendar-alt',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
		)
	);
}

add_action( 'theme_declare_block', 'child_theme_block_horario_de_onibus', 20 );
