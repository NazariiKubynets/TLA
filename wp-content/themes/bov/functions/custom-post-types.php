<?php


function create_destinations_type()
{
    $labels = array(
        'name'                  => _x('Destinations', 'Post type general name'),
        'singular_name'         => _x('Destination', 'Post type singular name'),
        'menu_name'             => _x('Destinations', 'Admin Menu text'),
        'name_admin_bar'        => _x('Destination', 'Add New on Toolbar'),
        'add_new'               => __('Add New'),
        'add_new_item'          => __('Add New Destination'),
        'new_item'              => __('New Destination'),
        'edit_item'             => __('Edit Destination'),
        'view_item'             => __('View Destination'),
        'all_items'             => __('All Destinations'),
        'search_items'          => __('Search Destinations'),
        'not_found'             => __('No destinations found.'),
        'not_found_in_trash'    => __('No destinations found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'destinations'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('destinations', $args);
}

add_action('init', 'create_destinations_type');


function create_tour_type()
{
    $labels = array(
        'name'                  => _x('Tours', 'Post type general name'),
        'singular_name'         => _x('Tour', 'Post type singular name'),
        'menu_name'             => _x('Tours', 'Admin Menu text'),
        'name_admin_bar'        => _x('Tour', 'Add New on Toolbar'),
        'add_new'               => __('Add New'),
        'add_new_item'          => __('Add New Tour'),
        'new_item'              => __('New Tour'),
        'edit_item'             => __('Edit Tour'),
        'view_item'             => __('View Tour'),
        'all_items'             => __('All Tours'),
        'search_items'          => __('Search Tours'),
        'not_found'             => __('No tours found.'),
        'not_found_in_trash'    => __('No tours found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'             => array(
            'slug'       => 'tour/%category%',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'         => array('category'),
        'show_in_rest'       => true,
    );

    register_post_type('tour', $args);
}

add_action('init', 'create_tour_type');

function custom_post_type_permalink($post_link, $post)
{
    if ($post->post_type === 'tour') {
        $terms = wp_get_post_terms($post->ID, 'category');
        if (!empty($terms) && !is_wp_error($terms)) {
            $post_link = str_replace('%category%', $terms[0]->slug, $post_link);
        } else {
            $post_link = str_replace('%category%', 'uncategorized', $post_link);
        }
    }
    return $post_link;
}
add_filter('post_type_link', 'custom_post_type_permalink', 10, 2);

function create_testimonials_type()
{
    $labels = array(
        'name'                  => _x('Testimonials', 'Post type general name'),
        'singular_name'         => _x('Testimonial', 'Post type singular name'),
        'menu_name'             => _x('Testimonials', 'Admin Menu text'),
        'name_admin_bar'        => _x('Testimonial', 'Add New on Toolbar'),
        'add_new'               => __('Add New'),
        'add_new_item'          => __('Add New Testimonial'),
        'new_item'              => __('New Testimonial'),
        'edit_item'             => __('Edit Testimonial'),
        'view_item'             => __('View Testimonial'),
        'all_items'             => __('All Testimonials'),
        'search_items'          => __('Search Testimonials'),
        'not_found'             => __('No testimonials found.'),
        'not_found_in_trash'    => __('No testimonials found in Trash.'),
    );

    $args = array(
        'labels'             => $labels,
        'public'             => true,
        'publicly_queryable' => true,
        'show_ui'            => true,
        'show_in_menu'       => true,
        'query_var'          => true,
        'rewrite'            => array('slug' => 'customer-testimonials'),
        'capability_type'    => 'post',
        'has_archive'        => false,
        'hierarchical'       => false,
        'menu_position'      => null,
        'menu_icon'          => 'dashicons-testimonial',
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'show_in_rest'       => true,
    );

    register_post_type('testimonials', $args);
}

add_action('init', 'create_testimonials_type');
