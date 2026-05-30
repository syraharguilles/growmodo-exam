<?php

/**
 * Single post template.
 *
 * @package Tailwind_PHP_Base
 */

get_header();

if (have_posts()) :
    while (have_posts()) :
        the_post();
?>
        <article <?php post_class('surface'); ?>>
            <header class="mb-6">
                <p class="text-sm text-slate-500"><?php echo esc_html(get_the_date()); ?></p>
                <h1 class="mt-2 text-4xl font-bold leading-tight"><?php the_title(); ?></h1>
            </header>
            <div class="prose max-w-none prose-slate">
                <?php the_content(); ?>
            </div>
        </article>
<?php
    endwhile;
endif;

get_footer();
