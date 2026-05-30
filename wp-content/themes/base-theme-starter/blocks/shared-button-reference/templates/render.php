<?php

/**
 * Shared Button Reference block template.
 *
 * Hidden reference block used only for ACF shared field definitions.
 *
 * @package Base_Theme_Starter
 */

$block_classes = 'bts-block bts-block-shared-button-reference';

$wrapper_attributes = function_exists('get_block_wrapper_attributes')
    ? get_block_wrapper_attributes(array('class' => $block_classes))
    : 'class="' . esc_attr($block_classes) . '"';
?>
<section <?php echo $wrapper_attributes; ?>>
    <div class="surface">
        <p class="text-sm text-slate-500">Shared Button Reference block. This is a hidden ACF reference block for clone fields.</p>
    </div>
</section>