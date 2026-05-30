<?php

/**
 * Base Theme Starter theme functions.
 *
 * @package Tailwind_PHP_Base
 */

if (! function_exists('tpb_setup')) {
    function tpb_setup()
    {
        add_theme_support('title-tag');
        add_theme_support('post-thumbnails');
        add_theme_support('html5', array('search-form', 'comment-form', 'comment-list', 'gallery', 'caption', 'style', 'script'));
        add_theme_support('align-wide');
        add_theme_support('wp-block-styles');
        add_theme_support('responsive-embeds');
        add_theme_support('editor-styles');
        add_theme_support('custom-line-height');
        add_theme_support('custom-spacing');
        add_theme_support('custom-units');
        add_editor_style('assets/css/style.css');

        register_nav_menus(
            array(
                'primary' => __('Primary Menu', 'base-theme-starter'),
            )
        );
    }
}
add_action('after_setup_theme', 'tpb_setup');

if (! function_exists('tpb_get_asset_version')) {
    function tpb_get_asset_version($relative_path)
    {
        $path = get_theme_file_path($relative_path);

        if (file_exists($path)) {
            return (string) filemtime($path);
        }

        return wp_get_theme()->get('Version');
    }
}

if (! function_exists('tpb_enqueue_assets')) {
    function tpb_enqueue_assets()
    {
        wp_enqueue_style(
            'tpb-fonts',
            'https://fonts.googleapis.com/css2?family=Urbanist:ital,wght@0,100..900;1,100..900&display=swap',
            array(),
            null
        );

        wp_enqueue_style(
            'tpb-style',
            get_theme_file_uri('assets/css/style.css'),
            array('tpb-fonts'),
            tpb_get_asset_version('assets/css/style.css')
        );

        $js_path = get_theme_file_path('assets/js/main.js');
        if (file_exists($js_path)) {
            wp_enqueue_script(
                'tpb-main',
                get_theme_file_uri('assets/js/main.js'),
                array(),
                tpb_get_asset_version('assets/js/main.js'),
                true
            );
        }
    }
}
add_action('wp_enqueue_scripts', 'tpb_enqueue_assets');

if (! function_exists('tpb_enqueue_editor_assets')) {
    function tpb_enqueue_editor_assets()
    {
        wp_enqueue_style(
            'tpb-editor-style',
            get_theme_file_uri('assets/css/style.css'),
            array(),
            tpb_get_asset_version('assets/css/style.css')
        );
    }
}
add_action('enqueue_block_editor_assets', 'tpb_enqueue_editor_assets');

$tpb_acf_bootstrap = get_theme_file_path('inc/acf.php');
if (file_exists($tpb_acf_bootstrap)) {
    require_once $tpb_acf_bootstrap;
}
