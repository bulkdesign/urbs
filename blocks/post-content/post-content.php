<?php
/**
 * Block: Posts Content
 *
 * @package bulk
 */

?>

<article <?php theme_block_attributes( $block, 'post-content' ); ?>>
    <header class="post-content-header">
        <div class="blocks-container">
            <?php if ( function_exists('yoast_breadcrumb') ): ?>
                <?php yoast_breadcrumb('<p class="breadcrumbs">','</p>'); ?>
            <?php endif; ?>
        </div>

        <div class="post-content-header-inner">
            <div class="post-content-header-inner-image">
                <?php the_post_thumbnail( 'full' ); ?>
            </div>
            <div class="post-content-header-inner-content">
                <?php $terms = get_the_terms( get_the_ID(), apply_filters( 'single_post_content_eyebrow_taxonomy', 'category' ) ); ?>
                <?php if( ! is_wp_error( $terms ) && ! empty( $terms[0]->name ) ): ?>
                <div class="eyebrow post-content-header-inner-content-eyebrow">
                    <?php
                        echo $terms[0]->name;
                    ?>
                </div>
                <?php endif; ?>

                <h1><?php the_title(); ?></h1>

                <?php if ( has_excerpt() ) : ?>
                    <?php the_excerpt(); ?>
                <?php endif; ?>

                <?php if ( ! get_post_type() === 'licitacao' ) : ?>
                    <div class="post-content-header-inner-content-meta">
                        <p><?php esc_attr_e( 'Publicado em:', 'bulk' ); ?></p>
                        <time><?php echo get_the_date('j F Y'); ?></time>
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </header>
    <div class="post-content-inner">
        <div class="blocks-container">
            <?php if( ! defined( 'REST_REQUEST' ) ) the_content(); ?>
        </div>
    </div>

    <?php if ( ! get_post_type() === 'licitacao' ) : ?>
        <footer class="post-content-footer">
            <div class="post-content-footer-inner">
                <div class="post-content-footer-share">
                    <span>
                        <?php esc_attr_e( 'Compartilhe esta notícia', 'bulk' ); ?>
                    </span>
                    
                    <ul class="post-content-share">
                        <li>
                            <a href="<?php the_permalink(); ?>" class="share-link share-to-clipboard" title="<?php esc_attr_e( 'Copy to clipboard', 'bulk' ); ?>">
                                <?php theme_block_asset( '/img/icon-link.svg' ); ?>
                                <?php theme_block_asset( '/img/icon-check.svg' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="mailto:?subject=<?php the_title(); ?>&body=<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Share via Email', 'bulk' ); ?>" class="share-link">
                                <?php theme_block_asset( '/img/icon-email.svg' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Share on LinkedIn', 'bulk' ); ?>" class="share-link">
                                <?php theme_block_asset( '/img/icon-linkedin.svg' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="http://twitter.com/share?url=<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Share on X', 'bulk' ); ?>" class="share-link">
                                <?php theme_block_asset( '/img/icon-x.svg' ); ?>
                            </a>
                        </li>
                        <li>
                            <a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink(); ?>" title="<?php esc_attr_e( 'Share on Facebook', 'bulk' ); ?>" class="share-link">
                                <?php theme_block_asset( '/img/icon-facebook.svg' ); ?>
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
        </footer>
    <?php endif; ?>
</article>