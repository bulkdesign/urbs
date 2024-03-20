<?php
/**
 * Block: Header Divided
 *
 * @package bulk
 */

?>

<div class="header-divided-placeholder"></div>
<header <?php theme_block_attributes( $block, 'header-divided' ); ?> data-color-scheme="<?php the_field( 'color_scheme' ); ?>" data-fixed="<?php the_field( 'fixed_on_scroll' ); ?>">
    <div class="header-divided-inner">
        <div class="header-divided-inner-mobile-wrapper">
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

            <div class="header-divided-right-items">
                <?php if( get_field( 'display_search' ) ) : ?>
                <button class="header-divided-search-toggle" type="button" aria-label="<?php esc_attr_e( 'Search', 'bulk' ); ?>">
                    <?php theme_block_asset('img/icon-search.svg'); ?>
                </button>
                <?php endif; ?>

                <button class="header-divided-menu-toggle" aria-label="<?php esc_attr_e( 'Menu', 'bulk' ); ?>">
                    <span class="menu-bar"></span>
                    <span class="menu-bar"></span>
                    <span class="menu-bar"></span>
                </button>

                <?php if( get_field( 'display_search' ) ) : ?>
                    <form action="<?php echo get_home_url(); ?>" class="header-divided-search-form" role="search">
                        <button type="submit" class="header-divided-search-form-submit" aria-label="<?php esc_attr_e( 'Search', 'bulk' ); ?>">
                            <?php theme_block_asset('img/icon-search.svg'); ?>
                        </button>
                        <input type="search" name="s" placeholder="<?php esc_attr_e( the_field('search_placeholder_text'), 'bulk' ); ?>" value="<?php echo esc_attr( get_query_var( 's' ) ); ?>" aria-label="<?php esc_attr_e( 'Search', 'bulk' ); ?>">
                        <button type="button" class="header-divided-search-form-close" aria-label="<?php esc_attr_e( 'Close search form', 'bulk' ); ?>">
                            
                        </button>
                    </form>
                <?php endif; ?>
            </div>
        </div>

        <div class="header-divided-right-items desktop">
            <?php if( get_field( 'display_search' ) ) : ?>
            <button class="header-divided-search-toggle" type="button" aria-label="<?php esc_attr_e( 'Search', 'bulk' ); ?>">
                <?php theme_block_asset('img/icon-search.svg'); ?>
            </button>
            <?php endif; ?>

            <button class="header-divided-menu-toggle" aria-label="<?php esc_attr_e( 'Menu', 'bulk' ); ?>">
                <span class="menu-bar"></span>
                <span class="menu-bar"></span>
                <span class="menu-bar"></span>
            </button>

            <?php if( get_field( 'display_search' ) ) : ?>
                <form action="<?php echo get_home_url(); ?>" class="header-divided-search-form" role="search">
                    <button type="submit" class="header-divided-search-form-submit" aria-label="<?php esc_attr_e( 'Search', 'bulk' ); ?>">
                        <?php theme_block_asset('img/icon-search.svg'); ?>
                    </button>
                    <input type="search" name="s" placeholder="<?php esc_attr_e( the_field('search_placeholder_text'), 'bulk' ); ?>" value="<?php echo esc_attr( get_query_var( 's' ) ); ?>" aria-label="<?php esc_attr_e( 'Search', 'bulk' ); ?>">
                    <button type="button" class="header-divided-search-form-close" aria-label="<?php esc_attr_e( 'Close search form', 'bulk' ); ?>">
                        
                    </button>
                </form>
            <?php endif; ?>
        </div>

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
</header>