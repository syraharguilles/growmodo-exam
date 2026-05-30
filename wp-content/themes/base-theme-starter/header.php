<!doctype html>
<html <?php language_attributes(); ?>>

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <header class="site-header">
        <div class="site-banner relative" data-site-banner>
            <div class="container-shell site-banner__inner">
                <p class="site-banner__text">✨Discover Your Dream Property with Estatein <a href="<?php echo esc_url(home_url('/')); ?>" title="Learn More">Learn More</a></p>
            </div>
            <button type="button" class="site-banner__close" data-site-banner-close aria-label="Close announcement">
                <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="container-shell site-header__inner">
            <a class="site-header__brand" href="<?php echo esc_url(home_url('/')); ?>">
                <img src="<?php echo get_theme_file_uri('assets/images/logo.svg'); ?>" alt="<?php bloginfo('name'); ?> logo" class="site-header__logo">
            </a>
            <div class="site-header__actions">
                <nav class="site-nav" aria-label="Main menu">
                    <?php
                    wp_nav_menu(
                        array(
                            'theme_location' => 'primary',
                            'container' => false,
                            'menu_class' => 'site-nav__menu',
                            'fallback_cb' => false,
                        )
                    );
                    ?>
                </nav>
            </div>
            <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="site-header__cta button button--primary">
                Contact Us
            </a>
        </div>
    </header>
    <main class="site-main py-10">