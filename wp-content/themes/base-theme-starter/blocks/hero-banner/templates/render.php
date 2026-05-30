<?php

/**
 * Hero Banner block template.
 *
 * @package Base_Theme_Starter
 */

$default_align_class = empty($block['align']) ? ' alignwide' : '';
$block_classes = 'bts-block bts-block-hero-banner' . $default_align_class;

$title = get_field('title');
$content = get_field('content');
$metrics = get_field('key_metrics');
$image = get_field('image');
$image_tag = get_field('image_tag');

$normalize_button = static function ($button) {
    if (is_array($button) && isset($button['button']) && is_array($button['button'])) {
        $button = $button['button'];
    }

    if (! is_array($button)) {
        $button = array();
    }

    $button_title = $button['title'] ?? '';
    $button_link = $button['link'] ?? '';
    $button_variant = $button['variant'] ?? '';

    if (is_array($button_link)) {
        $button_title = $button_title ?: ($button_link['title'] ?? '');
        $button_link = $button_link['url'] ?? '';
    }

    if ($button_title === '' && $button_link === '') {
        return null;
    }

    return array(
        'title' => $button_title,
        'link' => $button_link,
        'variant' => $button_variant,
    );
};

$resolve_clone_button = static function ($field_name) use ($normalize_button) {
    return $normalize_button(get_field($field_name));
};

$primary_button = $resolve_clone_button('button_one');
$secondary_button = $resolve_clone_button('button_two');

$wrapper_attributes = function_exists('get_block_wrapper_attributes')
    ? get_block_wrapper_attributes(array('class' => $block_classes))
    : 'class="' . esc_attr($block_classes) . '"';

if (is_array($metrics) && ! empty($metrics)) {
    $metrics = array_map(
        static function ($metric) {
            if (! is_array($metric)) {
                return array(
                    'value' => '',
                    'label' => '',
                );
            }

            return array(
                'value' => $metric['title'] ?? ($metric['value'] ?? ''),
                'label' => $metric['sub_text'] ?? ($metric['label'] ?? ''),
            );
        },
        $metrics
    );
} else {
    $metrics = array();
}

$resolve_image = static function ($image_field) {
    if (is_array($image_field)) {
        return array(
            'url' => $image_field['url'] ?? '',
            'alt' => $image_field['alt'] ?? '',
        );
    }

    if (is_numeric($image_field)) {
        return array(
            'url' => wp_get_attachment_image_url((int) $image_field, 'full') ?: '',
            'alt' => get_post_meta((int) $image_field, '_wp_attachment_image_alt', true) ?: '',
        );
    }

    if (is_string($image_field)) {
        return array(
            'url' => $image_field,
            'alt' => '',
        );
    }

    return array(
        'url' => '',
        'alt' => '',
    );
};

$image_data = $resolve_image($image);
$image_url = $image_data['url'];
$image_alt = $image_data['alt'];

$image_tag_data = $resolve_image($image_tag);
$image_tag_url = $image_tag_data['url'];
$image_tag_alt = $image_tag_data['alt'];

$render_button = static function ($button, $fallback_class) {
    if (! is_array($button)) {
        return;
    }

    $button_title = $button['title'] ?? '';
    $button_link = $button['link'] ?? '';
    $button_variant = $button['variant'] ?? '';

    $button_class = 'secondary' === $button_variant ? 'button--secondary' : ('primary' === $button_variant ? 'button--primary' : $fallback_class);

    if ($button_title === '' || $button_link === '') {
        return;
    }
?>
    <a href="<?php echo esc_url($button_link); ?>" class="button <?php echo esc_attr($button_class); ?> bts-block-hero-banner__button">
        <?php echo esc_html($button_title); ?>
    </a>
<?php
};
?>
<section <?php echo $wrapper_attributes; ?>>
    <div class="bts-block-hero-banner__layout container-shell">
        <div class="bts-block-hero-banner__content">
            <div class="bts-block-hero-banner__content-inner">
                <div class="bts-block-hero-banner__content-main">
                    <?php if ($title) : ?>
                        <h2 class="bts-block-hero-banner__title"><?php echo esc_html($title); ?></h2>
                    <?php endif; ?>

                    <?php if ($content) : ?>
                        <p class="bts-block-hero-banner__text"><?php echo nl2br(esc_html($content)); ?></p>
                    <?php endif; ?>
                </div>

                <?php if ($primary_button || $secondary_button) : ?>
                    <div class="bts-block-hero-banner__actions">
                        <?php $render_button($primary_button, 'button--primary'); ?>
                        <?php $render_button($secondary_button, 'button--secondary'); ?>
                    </div>
                <?php endif; ?>

                <?php if (! empty($metrics)) : ?>
                    <div class="bts-block-hero-banner__metrics">
                        <?php foreach ($metrics as $metric) : ?>
                            <div class="bts-block-hero-banner__metric">
                                <p class="bts-block-hero-banner__metric-value"><?php echo esc_html($metric['value'] ?? ''); ?></p>
                                <p class="bts-block-hero-banner__metric-label"><?php echo esc_html($metric['label'] ?? ''); ?></p>
                            </div>
                        <?php endforeach; ?>
                    </div>
                <?php endif; ?>
                <?php if ($image_tag_url) : ?>
                    <div class="image-tag-center">
                        <img src="<?php echo esc_url($image_tag_url); ?>" alt="<?php echo esc_attr($image_tag_alt ?: $title); ?>" class="bts-block-hero-banner__content-image">
                    </div>
                <?php endif; ?>
            </div>
        </div>
    </div>
    <div class="bts-block-hero-banner__media">
        <?php if ($image_url) : ?>
            <img src="<?php echo esc_url($image_url); ?>" alt="<?php echo esc_attr($image_alt ?: $title); ?>" class="bts-block-hero-banner__image">
        <?php else : ?>
            <div class="bts-block-hero-banner__media-placeholder">
                Add a hero image in the block settings.
            </div>
        <?php endif; ?>
    </div>
</section>