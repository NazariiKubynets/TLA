<?php
function disable_recaptcha_on_pages_without_forms() {
    if (
        !is_page(array('contact-us', 'testimonials')) &&
        strpos($_SERVER['REQUEST_URI'], '/tour/') === false
    ) {
        add_filter('wpcf7_load_js', '__return_false');
        add_filter('wpcf7_load_css', '__return_false');

        add_action('wp_enqueue_scripts', function() {
            wp_dequeue_script('google-recaptcha');
            wp_dequeue_script('wpcf7-recaptcha');
        }, 20);
    }
}
add_action('wp', 'disable_recaptcha_on_pages_without_forms');