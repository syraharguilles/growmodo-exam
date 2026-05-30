<?php

/**
 * Default content template.
 *
 * @package Tailwind_PHP_Base
 */
?>
<article <?php post_class('surface'); ?>>
    <header class="mb-4">
        <h2 class="text-2xl font-semibold leading-tight">
            <a class="hover:text-slate-600" href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        </h2>
    </header>
    <div class="text-slate-700">
        <?php the_excerpt(); ?>
    </div>
</article>