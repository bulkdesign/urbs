<?php
/**
 * Block: Content with Media
 *
 * @package bulk
 */

?>

<section <?php theme_block_attributes( $block, 'content-with-media alignwide' ); ?> data-media-type="<?php the_field( 'media_type' ); ?>" data-media-position="<?php the_field( 'media_position' ); ?>">
    <div class="content-with-media-media" data-animation>
        <?php if ( in_array( get_field( 'media_type' ), array( 'image', 'double-image' ) ) ) : ?>
            <?php $image = get_field( 'image' ); ?>
            <?php if ( ! empty( $image ) ) : ?>
            <div class="content-with-media-image">
				<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
            </div>
            <?php endif; ?>
            <?php $image = get_field( 'second_image' ); ?>
            <?php if ( ! empty( $image ) ) : ?>
            <div class="content-with-media-second-image">
				<?php echo wp_get_attachment_image( $image['ID'], 'full' ); ?>
            </div>
            <?php endif; ?>
        <?php elseif ( in_array( get_field( 'media_type' ), array( 'youtube', 'vimeo', 'video' ) ) ) : ?>
            <div class="content-with-media-video-player">
                <button class="content-with-media-video-player-button" 
                    <?php if ( 'video' === get_field( 'media_type' ) ) : ?>
                        <?php $file = get_field( 'video_file' ); ?>
                        data-file="<?php echo esc_attr( $file['url'] ); ?>" data-filemime="<?php echo esc_attr( $file['mime_type'] ); ?>"
                    <?php elseif ( 'youtube' === get_field( 'media_type' ) ) : ?>
                        data-youtube="<?php the_field( 'video_id' ); ?>"
                    <?php elseif ( 'vimeo' === get_field( 'media_type' ) ) : ?>
                        data-vimeo="<?php the_field( 'video_id' ); ?>"
                    <?php endif; ?>
                    data-autoplay="<?php the_field( 'autoplay_video' ); ?>"
                    data-loop="<?php the_field( 'loop_video' ); ?>"
                    data-disable-interaction="<?php the_field( 'disable_video_interaction' ); ?>"
                    aria-label="<?php esc_attr_e( 'Play Video', 'bulk' ); ?>"
                >
                    <?php $image = get_field( 'video_preview' ); ?>
                    <?php if ( ! empty( $image ) ) : ?>
                    <div role="presentation">
                        <img src="<?php echo esc_attr( $image['url'] ); ?>" alt="<?php echo esc_attr( $image['url'] ); ?>" loading="lazy">
                    </div>
                    <?php endif; ?>

                    <?php theme_block_asset( 'img/icon-play.svg' ); ?>
                </button>
            </div>
        <?php elseif ( in_array( get_field( 'media_type' ), array( 'lottie' ) ) ) : ?>
            <div class="content-with-media-lottie" data-autoplay="<?php the_field( 'autoplay_video' ); ?>">
                <lottie-player src="<?php the_field( 'lottie_json_url' ); ?>" speed="1" 
                    <?php if ( get_field( 'loop_video' ) ): ?>loop<?php endif; ?>
                    <?php if ( ! get_field( 'disable_video_interaction' ) ): ?>controls<?php endif; ?>
                    direction="1" mode="normal"
                ></lottie-player>
            </div>
        <?php endif; ?>
    </div>
    <div class="content-with-media-content" data-animation>
        <?php $icon = get_field('icon'); ?>
        <?php if(!empty($icon)): ?>
            <div class="content-with-media-icon" data-size="<?php the_field( 'icon_size' ); ?>">
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
        <div class="eyebrow content-with-media-eyebrow">
            <?php the_field( 'eyebrow' ); ?>
        </div>
        <?php endif; ?>

        <?php if ( get_field( 'title' ) ): ?>
            <?php if ( get_field( 'title_type') === 'h1' ): ?>
                <h1 class="h2 content-with-media-title">
                    <?php the_field( 'title' ); ?>
                </h1>
            <?php else: ?>
                <h2 class="content-with-media-title">
                    <?php the_field( 'title' ); ?>
                </h2>
            <?php endif; ?>
        <?php endif; ?>

        <?php if ( get_field( 'subtitle' ) ): ?>
        <h3 class="content-with-media-subtitle">
            <?php the_field( 'subtitle' ); ?>
        </h3>
        <?php endif; ?>

        <?php if ( get_field( 'content' ) ): ?>
        <div class="content-with-media-text">
            <?php the_field( 'content' ); ?>
        </div>
        <?php endif; ?>

        <?php if( have_rows( 'details' ) ): ?>
        <dl class="content-with-media-details" data-title-size="<?php the_field( 'details_title_size' ); ?>" data-columns="<?php the_field( 'details_columns' ); ?>" data-icon-position="<?php the_field( 'details_icon_position' ); ?>">
            <?php while( have_rows( 'details' ) ): ?>
                <?php the_row(); ?>
                <div>
                    <dt>
                        <?php $icon = get_sub_field('icon'); ?>
                        <?php if(!empty($icon)): ?>
                            <?php if( 'image/svg+xml' === $icon['mime_type'] ): ?>
                                <?php 
                                    // phpcs:ignore
                                    echo file_get_contents( get_attached_file( $icon['ID'] ) );
                                ?>
                            <?php else: ?>
                                <img src="<?php echo esc_attr( $icon['url'] ); ?>" alt="<?php echo esc_attr( $icon['title'] ); ?>" loading="lazy">
                            <?php endif; ?>
                        <?php endif; ?>
                        <?php the_sub_field( 'title' ); ?>
                    </dt>
                    <dd>
                        <?php the_sub_field( 'description' ); ?>

                        <?php $button = get_sub_field( 'button' ); ?>
                        <?php if ( ! empty( $button ) ) : ?>
                        <a class="content-with-media-details-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                            <?php echo wp_kses_post( $button['title'] ); ?>
                        </a>
                        <?php endif; ?>
                    </dd>
                </div>
            <?php endwhile; ?>
        </dl>
        <?php endif; ?>

        <?php if( get_field( 'primary_button' ) || get_field( 'secondary_button' ) || get_field( 'tertiary_button' ) ): ?>
        <div class="content-with-media-buttons">
            <?php $button = get_field( 'primary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="primary-button content-with-media-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'secondary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="secondary-button content-with-media-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>

            <?php $button = get_field( 'tertiary_button' ); ?>
            <?php if ( ! empty( $button ) ) : ?>
            <a class="tertiary-button content-with-media-button" href="<?php echo esc_attr( $button['url'] ); ?>" target="<?php echo esc_attr( theme_get_link_target( $button ) ); ?>" aria-label="<?php echo esc_attr( theme_get_link_aria_label( $button ) ); ?>">
                <?php echo wp_kses_post( $button['title'] ); ?>
            </a>
            <?php endif; ?>
        </div>
        <?php endif; ?>
    </div>
</section>