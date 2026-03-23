<?php
/**
 * Block: Content In Columns
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'content-in-columns' ); ?> data-media-type="<?php the_field( 'media_type' ); ?>" data-color-scheme="<?php the_field( 'color_scheme' ); ?>">
    <?php if ( 'image' === get_field( 'media_type' ) ) : ?>
        <?php $image = get_field( 'image' ); ?>
        <?php if ( ! empty( $image ) ) : ?>
        <div class="content-in-columns-media">
            <div class="content-in-columns-image">
				<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
            </div>
        </div>
        <?php endif; ?>
    <?php elseif ( in_array( get_field( 'media_type' ), array( 'youtube', 'vimeo', 'file' ) ) ) : ?>
        <div class="content-in-columns-media">
            <div class="content-in-columns-video-player">
                <?php if ( 'file' === get_field( 'media_type' ) ) : ?>
                    <?php $file = get_field( 'video_file' ); ?>
                    <video autoplay playsinline muted>
                        <source src="<?php echo esc_attr( $file['url'] ); ?>" type="<?php echo esc_attr( $file['mime_type'] ); ?>">
                    </video>
                <?php elseif ( 'youtube' === get_field( 'media_type' ) ) : ?>
                    <iframe src="https://www.youtube.com/embed/<?php the_field( 'video_id' ); ?>?autoplay=1&mute=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
                <?php elseif ( 'vimeo' === get_field( 'media_type' ) ) : ?>
                    <iframe src="https://player.vimeo.com/video/<?php the_field( 'video_id' ); ?>?autoplay=1&byline=0&portrait=0&badge=0&background=1" aria-label="<?php esc_attr_e( 'Video', 'bulk' ); ?>" allow="autoplay; fullscreen; picture-in-picture" allowfullscreen></iframe>
                <?php endif; ?>
            </div>
        </div>
    <?php endif; ?>
    <div class="content-in-columns-content" data-layout="<?php the_field( 'layout' ); ?>" data-animation>
        <div class="content-in-columns-content-heading">
            <?php $icon = get_field('icon'); ?>
            <?php if(!empty($icon)): ?>
                <div class="content-in-columns-icon" data-size="<?php the_field( 'icon_size' ); ?>">
                    <?php if( 'image/svg+xml' === $icon['mime_type'] ): ?>
                        <?php 
                            // phpcs:ignore
                            echo file_get_contents( get_attached_file( $icon['ID'] ) );
                        ?>
                    <?php else: ?>
                        <img src="<?php echo esc_attr( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['title'] ); ?>" loading="lazy">
                    <?php endif; ?>
                </div>
            <?php endif; ?>

            <?php if (get_field( 'eyebrow' )): ?>
            <div class="eyebrow content-in-columns-eyebrow">
                <?php the_field( 'eyebrow' ); ?>
            </div>
            <?php endif; ?>

            <?php if ( get_field( 'title' ) ): ?>
            <h2 class="content-in-columns-title">
                <?php echo wp_kses_post( strip_tags( get_field( 'title' ), '<b><strong><i><em><u>' ) ); ?>
            </h2>
            <?php endif; ?>

            <?php if ( get_field( 'subtitle' ) ): ?>
            <h3 class="content-in-columns-subtitle">
                <?php the_field( 'subtitle' ); ?>
            </h3>
            <?php endif; ?>
        </div>
        <div class="content-in-columns-content-body">
            <?php if ( get_field( 'content' ) ): ?>
            <div class="content-in-columns-text">
                <?php the_field( 'content' ); ?>
            </div>
            <?php endif; ?>
        </div>

        <?php if( have_rows( 'details' ) ): ?>
        <div class="content-in-columns-details" data-title-size="<?php the_field( 'details_title_size' ); ?>" data-columns="<?php the_field( 'details_columns' ); ?>" data-icon-position="<?php the_field( 'details_icon_position' ); ?>">
            <?php while( have_rows( 'details' ) ): ?>
                <?php the_row(); ?>
                <?php $full_link = get_sub_field( 'full_link' ); ?>
                <?php if ( ! empty( $full_link ) ) : ?>
                <a href="<?php echo esc_attr( $full_link['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $full_link ) ); ?>" class="content-in-columns-details-item" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $full_link ) ); ?>">
                <?php else: ?>
                <div class="content-in-columns-details-item">
                <?php endif; ?>
                    <?php $image = get_sub_field('image'); ?>
                    <?php if(!empty($image)): ?>
                        <div class="content-in-columns-details-image">
				            <?php echo wp_get_attachment_image( $image['ID'], 'medium' ); ?>
                        </div>
                    <?php endif; ?>

                    <?php $icon = get_sub_field('icon'); ?>
                    <?php if(!empty($icon)): ?>
                    <div class="content-in-columns-details-icon">
                        <?php if( 'image/svg+xml' === $icon['mime_type'] ): ?>
                            <?php 
                                // phpcs:ignore
                                echo file_get_contents( get_attached_file( $icon['ID'] ) );
                            ?>
                        <?php else: ?>
                            <img src="<?php echo esc_attr( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['title'] ); ?>" loading="lazy">
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>

                    <?php if(get_sub_field('eyebrow')): ?>
                    <div class="eyebrow content-in-columns-details-eyebrow">
                        <?php the_sub_field('eyebrow'); ?>
                    </div>
                    <?php endif; ?>
                    
                    <?php if(get_sub_field('title')): ?>
                    <h3>
                        <?php the_sub_field( 'title' ); ?>
                    </h3>
                    <?php endif; ?>

                    <?php if(get_sub_field('description')): ?>
                    <p><?php the_sub_field( 'description' ); ?></p>
                    <?php endif; ?>

                    <?php if ( ! empty( $full_link ) && ! empty( $full_link['title'] ) ) : ?>
                    <div class="content-in-columns-details-full-link-button">
                        <span class="primary-button content-in-columns-details-button">
                            <?php echo wp_kses_post( $full_link['title'] ); ?>
                        </span>
                    </div>
                    <?php endif; ?>

                    <?php if( get_sub_field( 'primary_button' ) || get_sub_field( 'secondary_button' ) || get_sub_field( 'tertiary_button' ) ): ?>
                    <div class="content-in-columns-details-buttons">
                        <?php $button = get_sub_field( 'primary_button' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a class="primary-button content-in-columns-details-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>

                        <?php $button = get_sub_field( 'secondary_button' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a class="secondary-button content-in-columns-details-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>

                        <?php $button = get_sub_field( 'tertiary_button' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a class="tertiary-button content-in-columns-details-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>
                    </div>
                    <?php endif; ?>
                <?php if ( ! empty( $full_link ) ) : ?>
                </a>
                <?php else: ?>
                </div>
                <?php endif; ?>
            <?php endwhile; ?>
        </div>
        <?php endif; ?>

        <?php if( get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ): ?>
        <div class="content-in-columns-buttons">
            <?php $button = get_field( 'primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button content-in-columns-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button content-in-columns-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button content-in-columns-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>