<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package bulk
 */

get_header(); ?>

<main>
	<div class="blocks-container">
        <?php 
            theme_block( 'acf/posts-archive-with-filter' ); 
        ?>
    </div>
</main>

<?php

get_footer();
