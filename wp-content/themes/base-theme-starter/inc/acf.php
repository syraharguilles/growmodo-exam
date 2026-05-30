<?php

/**
 * ACF integration for Base Theme Starter.
 *
 * @package Tailwind_PHP_Base
 */

if (! defined('ABSPATH')) {
    exit;
}

if (! function_exists('tpb_register_acf_blocks')) {
    function tpb_register_acf_blocks()
    {
        if (! function_exists('register_block_type')) {
            return;
        }

        $block_json_files = glob(get_theme_file_path('blocks/*/block.json'));
        if (! is_array($block_json_files)) {
            return;
        }

        foreach ($block_json_files as $block_json_file) {
            register_block_type(dirname($block_json_file));
        }
    }
}
add_action('init', 'tpb_register_acf_blocks');

if (! function_exists('tpb_register_acf_options')) {
    function tpb_register_acf_options()
    {
        if (! function_exists('acf_add_options_page')) {
            return;
        }

        acf_add_options_page(
            array(
                'page_title' => __('Theme Settings', 'base-theme-starter'),
                'menu_title' => __('Theme Settings', 'base-theme-starter'),
                'menu_slug'  => 'tpb-theme-settings',
                'capability' => 'edit_posts',
                'redirect'   => false,
                'position'   => 61,
            )
        );
    }
}
add_action('acf/init', 'tpb_register_acf_options');

if (! function_exists('tpb_acf_json_save_path')) {
    function tpb_acf_json_save_path($path)
    {
        return get_theme_file_path('acf-json');
    }
}
add_filter('acf/settings/save_json', 'tpb_acf_json_save_path');

if (! function_exists('tpb_acf_json_load_paths')) {
    function tpb_acf_json_load_paths($paths)
    {
        $block_json_paths = glob(get_theme_file_path('blocks/*/acf-json'));
        if (is_array($block_json_paths)) {
            foreach ($block_json_paths as $block_json_path) {
                $paths[] = $block_json_path;
            }
        }

        return array_unique($paths);
    }
}
add_filter('acf/settings/load_json', 'tpb_acf_json_load_paths');

if (! function_exists('tpb_sync_acf_json_to_block')) {
    function tpb_sync_acf_json_to_block($group)
    {
        if (! is_array($group) || empty($group['key']) || empty($group['location']) || ! is_array($group['location'])) {
            return;
        }

        $block_slug = '';

        foreach ($group['location'] as $location_group) {
            if (! is_array($location_group)) {
                continue;
            }

            foreach ($location_group as $rule) {
                if (is_array($rule) && ($rule['param'] ?? '') === 'block' && ! empty($rule['value']) && is_string($rule['value']) && substr($rule['value'], 0, 4) === 'acf/') {
                    $block_slug = substr($rule['value'], 4);
                    break 2;
                }
            }
        }

        if ($block_slug === '') {
            return;
        }

        $block_json_dir = get_theme_file_path('blocks/' . $block_slug . '/acf-json');
        if (! is_dir($block_json_dir)) {
            wp_mkdir_p($block_json_dir);
        }

        $block_json_file = trailingslashit($block_json_dir) . $group['key'] . '.json';
        file_put_contents($block_json_file, wp_json_encode($group, JSON_PRETTY_PRINT | JSON_UNESCAPED_SLASHES) . "\n");

        $theme_json_file = trailingslashit(get_theme_file_path('acf-json')) . $group['key'] . '.json';
        if (file_exists($theme_json_file)) {
            unlink($theme_json_file);
        }
    }
}
add_action('acf/update_field_group', 'tpb_sync_acf_json_to_block', 20, 1);
