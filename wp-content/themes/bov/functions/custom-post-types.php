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
            'slug'       => 'tour/%destination%',
            'with_front' => false,
        ),
        'capability_type'    => 'post',
        'has_archive'        => true,
        'hierarchical'       => false,
        'menu_position'      => null,
        'supports'           => array('title', 'editor', 'thumbnail', 'excerpt'),
        'taxonomies'         => array('destination'),
        'show_in_rest'       => true,
    );

    register_post_type('tour', $args);
}

add_action('init', 'create_tour_type');

function create_destination_taxonomy()
{
    $labels = array(
        'name'              => _x('Destinations', 'taxonomy general name', 'textdomain'),
        'singular_name'     => _x('Destination', 'taxonomy singular name', 'textdomain'),
        'search_items'      => __('Search Destinations', 'textdomain'),
        'all_items'         => __('All Destinations', 'textdomain'),
        'parent_item'       => __('Parent Destination', 'textdomain'),
        'parent_item_colon' => __('Parent Destination:', 'textdomain'),
        'edit_item'         => __('Edit Destination', 'textdomain'),
        'update_item'       => __('Update Destination', 'textdomain'),
        'add_new_item'      => __('Add New Destination', 'textdomain'),
        'new_item_name'     => __('New Destination Name', 'textdomain'),
        'menu_name'         => __('Destinations', 'textdomain'),
    );

    $args = array(
        'hierarchical'      => true,
        'labels'            => $labels,
        'show_ui'           => true,
        'show_admin_column' => true,
        'query_var'         => true,
        'rewrite'           => array('slug' => 'destination', 'with_front' => false ),
        'show_in_rest'      => true,
    );

    register_taxonomy('destination', array('tour'), $args);
}

add_action('init', 'create_destination_taxonomy');

function custom_post_type_permalink($post_link, $post)
{

    if ($post->post_type === 'tour') {
        $terms = wp_get_post_terms($post->ID, 'destination');
        if (!empty($terms) && !is_wp_error($terms)) {

            $primary_term = intval(get_post_meta( $post->ID, '_yoast_wpseo_primary_destination', true ));
            if(isset($primary_term) && $primary_term != 0) {
                $term_slug = get_term( $primary_term, 'destination')->slug;
            } else {
                $term_slug = $terms[0]->slug;
            }
            $post_link = str_replace('%destination%', $term_slug, $post_link);
        } else {
            $post_link = str_replace('%destination%', 'uncategorized', $post_link);
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

function custom_redirects() {

   global $wp_query;
   if($wp_query->get( 'destination' ) && isset($wp_query->posts) && isset($wp_query->posts[0])) {
       $post = $wp_query->posts[0];
       if ($post->post_type === 'tour') {
           $terms = wp_get_post_terms($post->ID, 'destination');
           $primary_term = intval(get_post_meta( $post->ID, '_yoast_wpseo_primary_destination', true ));
           if(isset($primary_term) && $primary_term != 0) {
               $term_slug = get_term( $primary_term, 'destination')->slug;
           } else {
               $term_slug = $terms[0]->slug;
           }
           if (empty($terms) || $term_slug != $wp_query->get( 'destination' )) {
               $wp_query->set_404();
               status_header(404);
           }
       }
   }


}
add_action( 'template_redirect', 'custom_redirects' );

function add_post_views_metabox() {
    add_meta_box(
        'post_views_metabox',
        'Post Views',
        'render_post_views_metabox',
        'post',
        'side',
        'high'
    );
}
add_action('add_meta_boxes', 'add_post_views_metabox');

function render_post_views_metabox($post) {
    $total_views = get_post_views($post->ID);
    $daily_views = function_exists('get_daily_post_views') ? get_daily_post_views($post->ID) : 'N/A';
    ?>
    <p><strong>Total Views:</strong> <?= esc_html($total_views); ?></p>
    <p><strong>Today's Views:</strong> <?= esc_html($daily_views); ?></p>
    <?php
}

