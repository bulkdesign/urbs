<?php
/**
 * Declares a block
 *
 * @package bulk
 */

/**
 * Function to be used in the action callback to declare this block.
 */
function child_theme_block_header_divided() {
	theme_declare_block(
		array(
			'name'        => 'header-divided',
			'title'       => __( 'Header Divided', 'bulk' ),
			'description' => __( 'A header with logo and menu on both sides', 'bulk' ),
			'icon'        => 'minus',
			'mode'        => 'edit',
			'supports'    => array(
				'align'  => false,
				'mode'   => false,
				'anchor' => true,
			),
            'category'    => 'headers',
            'post_types'  => array( 'header' ),
		)
	);

    
    function child_theme_block_header_divided_load_field( $field ) {
        $menus = wp_get_nav_menus();

        if ( ! empty( $menus ) ) {
            foreach ( $menus as $menu ) {
                $field['choices'][ $menu->term_id ] = $menu->name;
            }
        }

        return $field;
    }
    add_filter( 'acf/prepare_field/key=field_6212d68d845f1', 'child_theme_block_header_divided_load_field' );
    add_filter( 'acf/prepare_field/key=field_61faecde5edcc', 'child_theme_block_header_divided_load_field' );
    add_filter( 'acf/prepare_field/key=field_6212d9ca360df', 'child_theme_block_header_divided_load_field' );

    function child_theme_block_header_divided_submenu_toggle( $item_output, $item, $depth, $args ) {
        if ( in_array( 'menu-item-has-children', $item->classes, true ) || in_array( 'page_item_has_children', $item->classes, true ) ) {
            $item_output = str_replace( $args->link_after . '</a>', $args->link_after . '</a><button class="sub-menu-toggle"><span class="sr-only">' . __( 'Toggle submenu', 'bulk' ) . '</span></button>', $item_output );
        }

        if( '_blank' === $item->target ){
            $item_output = str_replace( $args->link_after . '</a>', '<span class="sr-only">' . __( '(Opens in a new tab)', 'bulk' ) . '</span>' . $args->link_after . '</a>', $item_output );            
        }

        if( $depth === 0 ){
            $item_output = str_replace( 'href="#"', 'href="#" role="button"', $item_output );
        }else{
            $item_output = str_replace( 'href="#"', 'href="#" role="presentation"', $item_output );
        }

        return $item_output;
    }
}

add_action( 'theme_declare_block', 'child_theme_block_header_divided', 10 );
