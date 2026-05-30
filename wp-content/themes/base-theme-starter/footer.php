</main>
<footer class="site-footer">
    <div class="site-footer__decorative">
        <div class="container-shell site-footer__decorative-shell flex flex-col md:flex-row items-center justify-between gap-[250px] py-[100px]">
            <div class="site-footer__decorative-inner site-footer__decorative-inner--content">
                <h3>Start Your Real Estate Journey Today</h3>
                <p>Your dream property is just a click away. Whether you're looking for a new home, a strategic investment, or expert real estate advice, Estatein is here to assist you every step of the way. Take the first step towards your real estate goals and explore our available properties or get in touch with our team for personalized assistance.</p>
            </div>
            <div class="site-footer__decorative-inner site-footer__decorative-inner--button">
                <a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="site-footer__decorative-cta button button--primary min-w-[150px]">Contact Us</a>
            </div>
        </div>
    </div>
    <div class="site-footer__navigation">
        <div class="container-shell site-footer__navigation-shell">
            <div class="site-footer__newsletter">
                <a class="site-footer__newsletter-brand" href="<?php echo esc_url(home_url('/')); ?>">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/Logo.svg')); ?>" alt="<?php bloginfo('name'); ?> logo" class="site-footer__newsletter-logo">
                </a>
                <form class="site-footer__newsletter-form" action="<?php echo esc_url(home_url('/')); ?>" method="post">
                    <label class="site-footer__newsletter-label" for="footer-newsletter-email">Email Address</label>
                    <div class="site-footer__newsletter-field">
                        <input id="footer-newsletter-email" name="footer_newsletter_email" type="email" class="site-footer__newsletter-input" placeholder="Enter your email" required>
                        <button type="submit" class="site-footer__newsletter-button">
                            <span class="sr-only">Subscribe</span>
                            <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icon-airplane.svg')); ?>" alt="" class="site-footer__newsletter-button-icon" aria-hidden="true">
                        </button>
                    </div>
                </form>
            </div>
            <nav class="site-footer__nav" aria-label="Footer navigation">
                <div class="site-footer__nav-grid">
                    <div class="site-footer__nav-column">
                        <p class="site-footer__nav-heading">Home</p>
                        <ul class="site-footer__nav-list">
                            <li><a href="<?php echo esc_url(home_url('/')); ?>" class="site-footer__nav-link">Hero Section</a></li>
                            <li><a href="<?php echo esc_url(home_url('/features/')); ?>" class="site-footer__nav-link">Features</a></li>
                            <li><a href="<?php echo esc_url(home_url('/properties/')); ?>" class="site-footer__nav-link">Properties</a></li>
                            <li><a href="<?php echo esc_url(home_url('/testimonials/')); ?>" class="site-footer__nav-link">Testimonials</a></li>
                            <li><a href="<?php echo esc_url(home_url('/faqs/')); ?>" class="site-footer__nav-link">FAQ's</a></li>
                        </ul>
                    </div>
                    <div class="site-footer__nav-column">
                        <p class="site-footer__nav-heading">About Us</p>
                        <ul class="site-footer__nav-list">
                            <li><a href="<?php echo esc_url(home_url('/our-story/')); ?>" class="site-footer__nav-link">Our Story</a></li>
                            <li><a href="<?php echo esc_url(home_url('/our-works/')); ?>" class="site-footer__nav-link">Our Works</a></li>
                            <li><a href="<?php echo esc_url(home_url('/how-it-works/')); ?>" class="site-footer__nav-link">How It Works</a></li>
                            <li><a href="<?php echo esc_url(home_url('/our-team/')); ?>" class="site-footer__nav-link">Our Team</a></li>
                            <li><a href="<?php echo esc_url(home_url('/our-clients/')); ?>" class="site-footer__nav-link">Our Clients</a></li>
                        </ul>
                    </div>
                    <div class="site-footer__nav-column">
                        <p class="site-footer__nav-heading">Properties</p>
                        <ul class="site-footer__nav-list">
                            <li><a href="<?php echo esc_url(home_url('/portfolio/')); ?>" class="site-footer__nav-link">Portfolio</a></li>
                            <li><a href="<?php echo esc_url(home_url('/categories/')); ?>" class="site-footer__nav-link">Categories</a></li>
                        </ul>
                    </div>
                    <div class="site-footer__nav-column">
                        <p class="site-footer__nav-heading">Services</p>
                        <ul class="site-footer__nav-list">
                            <li><a href="<?php echo esc_url(home_url('/valuation-mastery/')); ?>" class="site-footer__nav-link">Valuation Mastery</a></li>
                            <li><a href="<?php echo esc_url(home_url('/strategic-marketing/')); ?>" class="site-footer__nav-link">Strategic Marketing</a></li>
                            <li><a href="<?php echo esc_url(home_url('/negotiation-wizardry/')); ?>" class="site-footer__nav-link">Negotiation Wizardry</a></li>
                            <li><a href="<?php echo esc_url(home_url('/closing-success/')); ?>" class="site-footer__nav-link">Closing Success</a></li>
                            <li><a href="<?php echo esc_url(home_url('/property-management/')); ?>" class="site-footer__nav-link">Property Management</a></li>
                        </ul>
                    </div>
                    <div class="site-footer__nav-column">
                        <p class="site-footer__nav-heading">Contact Us</p>
                        <ul class="site-footer__nav-list">
                            <li><a href="<?php echo esc_url(home_url('/contact-us/')); ?>" class="site-footer__nav-link">Contact Form</a></li>
                            <li><a href="<?php echo esc_url(home_url('/our-offices/')); ?>" class="site-footer__nav-link">Our Offices</a></li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </div>
    <div class="container-shell site-footer__inner">
        <div class="site-footer__brand flex flex-row gap-[4] md:gap-[38px]">
            <p>&copy; <?php echo esc_html(gmdate('Y')); ?> <?php bloginfo('name'); ?>. All rights reserved.</p>
            <a href="<?php echo esc_url(home_url('/privacy-policy/')); ?>" class="site-footer__link">Terms and Conditions</a>
        </div>
        <div class="site-footer__meta">
            <nav class="site-footer__social" aria-label="Social media">
                <a href="#" class="site-footer__social-link" aria-label="Facebook">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icon-fb.svg')); ?>" alt="" class="site-footer__social-icon" aria-hidden="true">
                </a>
                <a href="#" class="site-footer__social-link" aria-label="LinkedIn">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icon-linkedln.svg')); ?>" alt="" class="site-footer__social-icon" aria-hidden="true">
                </a>
                <a href="#" class="site-footer__social-link" aria-label="X">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icon-x.svg')); ?>" alt="" class="site-footer__social-icon" aria-hidden="true">
                </a>
                <a href="#" class="site-footer__social-link" aria-label="YouTube">
                    <img src="<?php echo esc_url(get_theme_file_uri('assets/images/icon-youtube.svg')); ?>" alt="" class="site-footer__social-icon" aria-hidden="true">
                </a>
            </nav>
        </div>
    </div>
</footer>
<?php wp_footer(); ?>
</body>

</html>