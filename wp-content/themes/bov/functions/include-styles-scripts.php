<?php
//Include styles
add_action('wp_print_styles', 'add_my_styles');
function add_my_styles()
{

    if (is_page_template('pages/contact-us.php')) {
        wp_enqueue_style('no-ui-slider-styles', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.8.1/nouislider.min.css', null, null);
        wp_enqueue_style('intl-tel-input-styles', 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.0/build/css/intlTelInput.css', null, null);
    }

    wp_enqueue_style(
        'bov-styles',
        get_template_directory_uri() . '/css/styles.min.css',
        null,
        getVer('wp-content/themes/bov/css/styles.min.css')
    );
}

//Include styles 
function add_scripts()
{
    // Disable standard jquery and register cdn version of it
    wp_deregister_script('jquery');
    wp_register_script('jquery', 'https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js');
    wp_enqueue_script('gsap-min', get_template_directory_uri() . '/js/dist/gsap.min.js', [], '20240812', true);
    wp_enqueue_script('scroll-trigger', get_template_directory_uri() . '/js/dist/scrollTrigger.min.js', [], '20240812', true);
//    wp_enqueue_script('animations', get_template_directory_uri() . '/js/dist/animations.js', ['gsap-min', 'scroll-trigger'], "", true);

    if (is_page_template('pages/contact-us.php')) {
        wp_enqueue_script('no-ui-slider', 'https://cdnjs.cloudflare.com/ajax/libs/noUiSlider/15.8.1/nouislider.min.js', ['jquery'], null, true);
        wp_enqueue_script('intl-tel-input', 'https://cdn.jsdelivr.net/npm/intl-tel-input@25.2.0/build/js/intlTelInputWithUtils.min.js', ['jquery'], null, true);
        wp_enqueue_script(
            'contact-form',
            get_template_directory_uri() . '/js/dist/contact-us-form.js',
            ['jquery', 'no-ui-slider', 'intl-tel-input'],
            getVer('wp-content/themes/bov/js/dist/contact-us-form.js'),
            true
        );
    }

    wp_enqueue_script(
        'plugins',
        get_template_directory_uri() . '/js/dist/plugins.min.js',
        ['jquery'],
        getVer('wp-content/themes/bov/js/dist/plugins.min.js'),
        true
    );

    wp_enqueue_script(
        'app',
        get_template_directory_uri() . '/js/dist/app.min.js',
        ['plugins', 'gsap-min', 'scroll-trigger'],
        getVer('wp-content/themes/bov/js/dist/app.min.js'),
        true
    );
}

add_action('wp_enqueue_scripts', 'add_scripts');

//Move styles 
remove_action('wp_head', 'wp_print_scripts');
remove_action('wp_head', 'wp_print_head_scripts', 9);
remove_action('wp_head', 'wp_enqueue_scripts', 1);
remove_action('wp_head', 'wp_enqueue_style', 1);
add_action('wp_footer', 'wp_print_scripts', 5);
add_action('wp_footer', 'wp_print_head_scripts', 5);
add_action('wp_footer', 'wp_enqueue_scripts', 1);
add_action('wp_footer', 'wp_enqueue_style', 5);

//Disable CF7 styles
add_filter('wpcf7_load_css', '__return_false');

//Diasble Gutenberg styles
add_action('wp_enqueue_scripts', function () {
    wp_dequeue_style('wp-block-library');
}, 100);

//Add "defer" to js scripts (except google captcha etc)
add_filter('script_loader_tag', function ($tag, $handle) {
    if (!is_admin() && !strpos($tag, 'recaptcha') && !strpos($tag, 'jquery')) {
        return str_replace(' src', ' defer src', $tag);
    } else {
        return $tag;
    }
}, 10, 2);


//Disable dashicons
function wpdocs_dequeue_dashicon()
{
    if (current_user_can('update_core')) {
        return;
    }
    wp_deregister_style('dashicons');
}

add_action('wp_enqueue_scripts', 'wpdocs_dequeue_dashicon');


//Dequeue CF7 anf recaptcha script on others page except specific 
function contactform_dequeue_scripts()
{
    // if ( ! is_page_template( [ 'tpl-contact.php' ] ) ) {
    //     wp_dequeue_script( 'contact-form-7' );
    //     wp_dequeue_script( 'google-recaptcha' );
    //     wp_dequeue_script( 'wpcf7-recaptcha' );
    //     wp_dequeue_style( 'wpcf7-recaptcha' );
    //     wp_dequeue_style( 'contact-form-7' );
    // }
}

add_action('wp_enqueue_scripts', 'contactform_dequeue_scripts', 99);
