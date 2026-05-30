<?php

/**
 * Main template file.
 *
 * @package Tailwind_PHP_Base
 */

get_header();

if (have_posts()) :
    echo '<div class="grid gap-6">';

    while (have_posts()) :
        the_post();
        get_template_part('template-parts/content', get_post_type());
    endwhile;

    echo '</div>';

    the_posts_pagination();
else :
    get_template_part('template-parts/content', 'none');
endif;

get_footer();
