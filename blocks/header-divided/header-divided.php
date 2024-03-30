<?php
/**
 * Block: Header Divided
 *
 * @package bulk
 */

?>

<header <?php theme_block_attributes( $block, 'header-divided' ); ?> data-color-scheme="<?php the_field( 'color_scheme' ); ?>" data-fixed="<?php the_field( 'fixed_on_scroll' ); ?>">
    <div class="header-divided-inner">
        <button class="header-divided-menu-toggle" aria-label="<?php esc_attr_e( 'Menu', 'bulk' ); ?>">
            <span class="menu-bar"></span>
            <span class="menu-bar"></span>
            <span class="menu-bar"></span>
        </button>
    
        <div class="header-divided-left-menu-wrapper">
            <nav>
                <?php
                    add_filter( 'walker_nav_menu_start_el', 'theme_block_header_divided_submenu_toggle', 10, 4 );

                    if( get_field('left_menu') ){
                        wp_nav_menu(
                            array(
                                'menu' => get_field( 'left_menu' ),
                                'depth' => 3,
                                'menu_class' => 'menu main-menu left-menu',
                            )
                        );
                    }
                ?>
            </nav>
        </div>

        <div class="header-divided-logo-wrapper">
            <a href="<?php echo esc_url( get_home_url() ); ?>" class="logo" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                <?php $logo = get_field( 'logo' ); ?>
                <?php if(!empty($logo)): ?>
                    <?php if( 'image/svg+xml' === $logo['mime_type'] ): ?>
                        <?php 
                            // phpcs:ignore
                            echo file_get_contents( get_attached_file( $logo['ID'] ) );
                        ?>
                    <?php else: ?>
                        <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
                    <?php endif; ?>
                <?php endif; ?>
            </a>
        </div>

        <div class="header-divided-right-menu-wrapper">
            <nav>
                <?php

                if( get_field('right_menu') ){
                    wp_nav_menu(
                        array(
                            'menu' => get_field( 'right_menu' ),
                            'depth' => 3,
                            'menu_class' => 'menu main-menu right-menu',
                        )
                    );
                }

                if( get_field( 'featured_menu' ) ){
                    wp_nav_menu(
                        array(
                            'menu' => get_field( 'featured_menu' ),
                            'depth' => 1,
                            'menu_class' => 'menu featured-menu',
                        )
                    );
                }

                remove_filter( 'walker_nav_menu_start_el', 'theme_block_header_divided_submenu_toggle', 10 );
                ?>
            </nav>
        
        </div>
    </div>
</header>
<div class="urbs-separator">
    <span class="urbs-separator-yellow"></span>
    <span class="urbs-separator-red"></span>
    <span class="urbs-separator-grey"></span>
</div>