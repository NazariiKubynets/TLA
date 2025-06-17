<?php
require_once "functions/tgm-plugin-activation/class-tgm-plugin-activation.php";
require_once "functions/tgm-plugin-activation/config.php";

//User functions
require "functions/lib.php";
require "functions/wp-helpers.php";
require "functions/add-support.php";
require "functions/include-styles-scripts.php";
require "functions/menu.php";
require "functions/disable-recaptcha.php";
require "functions/post-views.php";
require "functions/ajax.php";
require "functions/custom-post-types.php";
require "functions/register-short-code.php";
require_once "functions/ng_includes.php";

//function delay_cookieyes_execution($tag, $handle) {
//    if ($handle === 'cookie-law-info') {
//        return "<script defer>
//            setTimeout(function() {
//                var script = document.createElement('script');
//                script.src = 'https://tla.nextgdev.work/wp-content/plugins/cookie-law-info/lite/frontend/js/script.min.js';
//                document.body.appendChild(script);
//            }, 3000);
//        </script>";
//    }
//    return $tag;
//}
//add_filter('script_loader_tag', 'delay_cookieyes_execution', 10, 2);


function delay_cookieyes_execution($tag, $handle) {
    if ($handle === 'cookie-law-info') {
        $script_url = plugins_url('cookie-law-info/lite/frontend/js/script.min.js');
        return "<script defer>
            setTimeout(function() {
                var script = document.createElement('script');
                script.src = '$script_url';
                document.body.appendChild(script);
            }, 3000);
        </script>";
    }
    return $tag;
}
add_filter('script_loader_tag', 'delay_cookieyes_execution', 10, 2);

//add_action('template_redirect', function() {
//    $uri = trim($_SERVER['REQUEST_URI'], '/');
//
//    $category = get_term_by('slug', $uri, 'category');
//
//    if ($category) {
//        global $wp_query;
//        $wp_query->set_404();
//        status_header(404);
//        nocache_headers();
//        include get_template_directory() . '/404.php';
//        exit;
//    }
//});




