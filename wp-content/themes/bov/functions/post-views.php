<?php

function set_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        $count = 0;
        delete_post_meta($postID, $count_key);
        add_post_meta($postID, $count_key, '1');
    } else {
        $count++;
        update_post_meta($postID, $count_key, $count);
    }
}

function track_post_views($postID) {
    if (!is_single()) return;
    if (empty($postID)) $postID = get_the_ID();
    set_post_views($postID);
}
add_action('wp_head', 'track_post_views');

function get_post_views($postID) {
    $count_key = 'post_views_count';
    $count = get_post_meta($postID, $count_key, true);
    if ($count == '') {
        return "0 views";
    }
    return $count . ' views';
}

function set_daily_post_views($postID) {
    $transient_key = 'daily_post_views_' . $postID;
    $count = get_transient($transient_key);

    if ($count === false) {
        $count = 1;
    } else {
        $count++;
    }
    set_transient($transient_key, $count, DAY_IN_SECONDS);
}

function get_daily_post_views($postID) {
    $transient_key = 'daily_post_views_' . $postID;
    $count = get_transient($transient_key);
    return $count ? $count . ' views today' : '0 views today';
}


add_action('wp_head', function() {
    if (is_single()) {
        set_daily_post_views(get_the_ID());
    }
});
