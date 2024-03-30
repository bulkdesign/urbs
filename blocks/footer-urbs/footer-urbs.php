<?php
/**
 * Block: Footer One
 *
 * @package bulk
 */

?>

<div class="urbs-separator">
    <span class="urbs-separator-yellow"></span>
    <span class="urbs-separator-red"></span>
    <span class="urbs-separator-grey"></span>
</div>
<footer <?php theme_block_attributes( $block, 'footer-urbs alignfull' ); ?>>
    <div class="footer-urbs-main">
        <div class="footer-urbs-left-column">
            <?php if( have_rows( 'left_column' ) ): ?>
                <?php while( have_rows( 'left_column' ) ): the_row(); ?>
                    <?php if( get_sub_field( 'title' ) ): ?>
                        <h2><?php the_sub_field( 'title' ); ?></h2>
                    <?php endif; ?>
                    <?php if( have_rows( 'icon_text' ) ): ?>
                        <ul>
                            <?php while( have_rows( 'icon_text' ) ): the_row(); ?>
                                <li>
                                    <?php 
                                        $logo = get_sub_field( 'icon' ); 
                                        $text = get_sub_field( 'text' );
                                    ?>
                                    
                                    <div class="icon">
                                        <?php if(!empty($logo)): ?>
                                            <?php if( 'image/svg+xml' === $logo['mime_type'] ): ?>
                                                <?php 
                                                    // phpcs:ignore
                                                    echo file_get_contents( get_attached_file( $logo['ID'] ) );
                                                ?>
                                            <?php else: ?>
                                                <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( $button['title'] ); ?>" loading="lazy">
                                            <?php endif; ?>
                                        <?php endif; ?>
                                    </div>
                                    <div class="text">
                                        <?php if( ! empty( $text ) ): ?>
                                            <?php the_sub_field( 'text' ); ?>
                                        <?php endif; ?>
                                    </div>
                                </li>
                            <?php endwhile; ?>
                        </ul>
                    <?php endif; ?>
                    <?php if( have_rows( 'buttons' ) ): ?>
                        <div class="cta-buttons">
                            <ul>
                                <?php while( have_rows( 'buttons' ) ): the_row(); ?>
                                    <li>
                                        <?php 
                                            $icon = get_sub_field( 'icon' ); 
                                            $button_link = get_sub_field( 'link' );
                                        ?>

                                        <?php if ( ! empty( $button_link ) ) : ?>
                                        <a href="<?php echo esc_attr( $button_link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button_link ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button_link ) ); ?>" title="<?php echo esc_attr( $button_link['title'] ); ?>">
                                            
                                            <?php if(!empty($icon)): ?>
                                                <div class="icon">
                                                    <?php if( 'image/svg+xml' === $icon['mime_type'] ): ?>
                                                        <?php 
                                                            // phpcs:ignore
                                                            echo file_get_contents( get_attached_file( $icon['ID'] ) );
                                                        ?>
                                                    <?php else: ?>
                                                        <img src="<?php echo esc_attr( $icon['url'] ); ?>" alt="<?php echo esc_attr( $button_text['title'] ); ?>" loading="lazy">
                                                    <?php endif; ?>
                                                </div>
                                            <?php endif; ?>
                                            
                                            <span>
                                                <?php echo wp_kses_post( $button_link['title'] ); ?>
                                            </span>

                                            <?php if ( '_blank' === theme_get_link_target( $button_link ) ) : ?>
                                            <span class="sr-only">
                                                <?php esc_attr_e( '(Opens in a new tab)', 'bulk'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </a>
                                        <?php endif; ?>
                                
                                    </li>
                                <?php endwhile; ?>
                            </ul>
                        </div>
                    <?php endif; ?>
                <?php endwhile; ?>
            <?php endif; ?>
        </div>
        <div class="footer-urbs-center-column">
            <?php $logo = get_field( 'logo' ); ?>
            <?php if (!empty($logo)): ?>
                <a href="<?php echo esc_url( get_home_url() ); ?>" class="logo" title="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
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
            <?php endif; ?>
        </div>
        <div class="footer-urbs-right-column">
            <?php if( have_rows( 'right_column') ): ?>
                <?php while( have_rows( 'right_column' ) ): ?>
                <?php the_row(); ?>

                    <?php if( get_sub_field( 'title' ) ): ?>
                        <h2><?php the_sub_field( 'title' ); ?></h2>
                    <?php endif; ?>

                    <div class="column-items">
                        <?php if( have_rows( 'social_media' ) ): ?>
                            <ul>
                                <?php while( have_rows( 'social_media' ) ): ?>
                                <?php the_row(); ?>
                                <li>
                                    <?php 
                                        $logo   = get_sub_field( 'icon' ); 
                                        $button = get_sub_field( 'link' ); 
                                    ?>
                                    <?php if ( ! empty( $button ) ) : ?>
                                        <a href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>" title="<?php echo esc_attr( $button['title'] ); ?>">
                                            <?php if(!empty($logo)): ?>
                                                <?php if( 'image/svg+xml' === $logo['mime_type'] ): ?>
                                                    <?php 
                                                        // phpcs:ignore
                                                        echo file_get_contents( get_attached_file( $logo['ID'] ) );
                                                    ?>
                                                <?php else: ?>
                                                    <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( $button['title'] ); ?>" loading="lazy">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <span>
                                                <?php echo wp_kses_post( $button['title'] ); ?>
                                            </span>

                                            <?php if ( '_blank' === theme_get_link_target( $button ) ) : ?>
                                            <span class="sr-only">
                                                <?php esc_attr_e( '(Opens in a new tab)', 'bulk'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </a>

                                        <?php else: ?>

                                            <?php if(!empty($logo)): ?>
                                                <?php if( 'image/svg+xml' === $logo['mime_type'] ): ?>
                                                    <?php 
                                                        // phpcs:ignore
                                                        echo file_get_contents( get_attached_file( $logo['ID'] ) );
                                                    ?>
                                                <?php else: ?>
                                                    <img src="<?php echo esc_attr( $logo['url'] ); ?>" alt="<?php echo esc_attr( $button['title'] ); ?>" loading="lazy">
                                                <?php endif; ?>
                                            <?php endif; ?>

                                    <?php endif; ?>
                                </li>
                                <?php endwhile; ?>
                            </ul>
                        <?php endif; ?>

                        <?php if( get_sub_field('text') ): ?>
                            <?php the_sub_field('text'); ?>
                        <?php endif; ?>

                        <?php if( have_rows('map') ): ?>
                            <div class="map">
                                <?php while( have_rows('map') ): ?>
                                    <?php the_row(); ?>

                                    <?php 
                                        $map = get_sub_field( 'map_image' ); 
                                        $map_button = get_sub_field( 'map_link' ); 
                                    ?>
                                    <?php if ( ! empty( $map_button ) ) : ?>
                                        <a href="<?php echo esc_attr( $map_button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $map_button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $map_button ) ); ?>" title="<?php echo esc_attr( $map_button['title'] ); ?>">
                                            <?php if(!empty($map)): ?>
                                                <?php if( 'image/svg+xml' === $map['mime_type'] ): ?>
                                                    <?php 
                                                        // phpcs:ignore
                                                        echo file_get_contents( get_attached_file( $map['ID'] ) );
                                                    ?>
                                                <?php else: ?>
                                                    <img src="<?php echo esc_attr( $map['url'] ); ?>" alt="<?php echo esc_attr( $map_button['title'] ); ?>" loading="lazy">
                                                <?php endif; ?>
                                            <?php endif; ?>
                                            
                                            <span>
                                                <?php echo wp_kses_post( $map_button['title'] ); ?>
                                            </span>

                                            <?php if ( '_blank' === theme_get_link_target( $map_button ) ) : ?>
                                            <span class="sr-only">
                                                <?php esc_attr_e( '(Opens in a new tab)', 'bulk'); ?>
                                            </span>
                                            <?php endif; ?>
                                        </a>

                                        <?php else: ?>

                                            <?php if(!empty($map)): ?>
                                                <?php if( 'image/svg+xml' === $map['mime_type'] ): ?>
                                                    <?php 
                                                        // phpcs:ignore
                                                        echo file_get_contents( get_attached_file( $map['ID'] ) );
                                                    ?>
                                                <?php else: ?>
                                                    <img src="<?php echo esc_attr( $map['url'] ); ?>" alt="<?php echo esc_attr( $map_button['title'] ); ?>" loading="lazy">
                                                <?php endif; ?>
                                            <?php endif; ?>

                                    <?php endif; ?>
                                <?php endwhile; ?>
                            </div>
                        <?php endif; ?>
                    </div>

                <?php endwhile; ?>
            <?php endif; ?>
        </div>
    </div>

    <div class="footer-urbs-copyright">
        <?php if ( get_field( 'copyright' ) && get_field( 'copyright_text' ) ): ?>
            <p><?php echo get_field( 'copyright' ); ?> - &copy; <?php echo esc_attr( date( 'Y' ) ); ?> - <?php the_field( 'copyright_text' ); ?></p>
        <?php endif; ?>
    </div>
</footer>