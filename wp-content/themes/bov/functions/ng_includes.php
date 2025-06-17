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
function cc_mime_types( $mimes ){
    $mimes['svg'] = 'image/svg+xml';
    return $mimes;
}
add_filter( 'upload_mimes', 'cc_mime_types' );

function nextg_fix_svg_size_attributes( $out, $id ) {
    $image_url  = wp_get_attachment_url( $id );
    $file_ext   = pathinfo( $image_url, PATHINFO_EXTENSION );

    if ( is_admin() || 'svg' !== $file_ext ) {
        return false;
    }

    return array( $image_url, null, null, false );
}
add_filter( 'image_downsize', 'nextg_fix_svg_size_attributes', 10, 2 );
