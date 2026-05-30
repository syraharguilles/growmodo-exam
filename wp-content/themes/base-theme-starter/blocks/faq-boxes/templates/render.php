<?php
/**
 * FAQ Boxes block template.
 *
 * @package Base_Theme_Starter
 */

$default_align_class = empty($block['align']) ? ' alignwide' : '';
$block_classes = 'bts-block bts-block-faq-boxes' . $default_align_class;

$wrapper_attributes = function_exists('get_block_wrapper_attributes')
  ? get_block_wrapper_attributes(array('class' => $block_classes))
  : 'class="' . esc_attr($block_classes) . '"';
?>
<section <?php echo $wrapper_attributes; ?>>
    <div class="surface">
        <p class="mb-2 text-xs font-semibold uppercase tracking-[0.18em] text-slate-500">FAQ Boxes</p>
      <h2 class="text-3xl font-bold leading-tight">Edit FAQ Boxes in blocks/faq-boxes/templates/render.php</h2>
    </div>
</section>
