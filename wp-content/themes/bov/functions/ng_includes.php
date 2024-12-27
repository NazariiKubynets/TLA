<?php

function ng_disable_gutenberg($use_block_editor, $post_type)
{
    $post_types = ['destinations', 'tour'];
    if (in_array($post_type, $post_types)) {
        $use_block_editor = false;
    }
    return $use_block_editor;
}
add_filter('use_block_editor_for_post_type', 'ng_disable_gutenberg', 999, 2);

function ng__post_search_columns($columns, $search, $query) {
    return ['post_title'];
}

add_filter('post_search_columns', 'ng__post_search_columns', 10, 3);
