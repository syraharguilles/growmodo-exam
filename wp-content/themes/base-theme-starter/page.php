<?php

/**
 * Page template.
 *
 * @package Tailwind_PHP_Base
 */

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
?>
        <article <?php post_class(); ?>>
            <header class="container-shell mb-6">
                <h1 class="text-3xl font-bold"><?php the_title(); ?></h1>
            </header>
            <div class="entry-content">
                <?php the_content(); ?>
            </div>
        </article>
<?php
    endwhile;
endif;

get_footer();
