<?php

function ajax_filter_posts()
{
    check_ajax_referer('afp_nonce', 'security');
    $paged = isset($_GET['paged']) ? intval($_GET['paged']) : 1;
    $baseurl = isset($_GET['baseurl']) ? $_GET['baseurl'] : "";
    $categories_id = !empty($_GET['categories']) && is_array($_GET['categories']) ? array_map('intval', $_GET['categories']) : [];
    $search_query = isset($_GET['s']) ? sanitize_text_field($_GET['s']) : 0;
    $pagination_buttons = '';

    $category_names = [];
    if (!empty($categories_id)) {
        foreach ($categories_id as $cat_id) {
            $category_names[] = get_cat_name($cat_id);
        }
    }

    $args = array(
        'post_type' => 'post',
        'paged' => $paged,
        'orderby' => 'date',
        'order' => 'DESC'
    );

    if ($search_query) {
        $args['s'] = $search_query;
    }

    if (!empty($categories_id)) {
        $args['tax_query'] = array(
            array(
                'taxonomy' => 'category',
                'field' => 'term_id',
                'terms' => $categories_id,
                'operator' => 'IN',
            ),
        );
    }

    $query = new WP_Query($args);

    $response = array();

    $selected_categories = !empty($category_names)
        ? implode(', ', array_slice($category_names, 0, 2))
        : 'All';

    $remaining_count = count($categories_id) > 2
        ? '+' . (count($categories_id) - 2)
        : '';

    if ($query->have_posts()) {
        ob_start();
        $post_count = 0;
        while ($query->have_posts()) : $query->the_post();
            $post_count++;
            get_template_part('templates/items/_archive-posts', null, ['post-count' => $post_count]);
        endwhile;

        $response['grid'] = ob_get_clean();
        // Add the Previous button
//        $pagination_buttons .= '<button class="posts-archive__prev page-numbers hide" type="button">
//                <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
//                    <path d="M7.5 13l-6-6 6-6" stroke-width="1.5"/>
//                </svg>
//            </button>';
//
//        // Add the page number buttons
//        $pagination_buttons .= '<div class="posts-archive__pages">';
//
//        $total_pages = $query->max_num_pages;
//        $current_page = max(1, $paged);
//        $end_size = 3;
//        $mid_size = 1;
//
//
//        if ($total_pages > 1) {
//
//            for ($i = 1; $i <= min($end_size, $total_pages); $i++) {
//                $pagination_buttons .= '<button type="button" class="posts-archive__page page-numbers" data-page="' . $i . '">' . $i . '</button>';
//            }
//
//            if ($current_page > $end_size + $mid_size + 1) {
//                $pagination_buttons .= '<span>...</span>';
//            }
//
//            if ($total_pages > $end_size * 2) {
//                for ($i = max($end_size + 1, $current_page - $mid_size); $i <= min($current_page + $mid_size, $total_pages - $end_size); $i++) {
//                    if ($i > $end_size && $i < $total_pages - $end_size + 1) {
//                        $pagination_buttons .= '<button type="button" class="posts-archive__page page-numbers" data-page="' . $i . '">' . $i . '</button>';
//                    }
//                }
//
//                if ($current_page < $total_pages - $end_size - $mid_size) {
//                    $pagination_buttons .= '<span>...</span>';
//                }
//
//                for ($i = $total_pages - $end_size + 1; $i <= $total_pages; $i++) {
//                    $pagination_buttons .= '<button type="button" class="posts-archive__page page-numbers" data-page="' . $i . '">' . $i . '</button>';
//                }
//            } else {
//                for ($i = $end_size + 1; $i <= $total_pages; $i++) {
//                    $pagination_buttons .= '<button type="button" class="posts-archive__page page-numbers" data-page="' . $i . '">' . $i . '</button>';
//                }
//            }
//        }
//
//        $pagination_buttons .= '</div>';
//
//        // Add the Next button
//        $pagination_buttons .= '<button class="posts-archive__next page-numbers hide" type="button" data-max-pages="' . $query->max_num_pages . '">
//                <svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
//                    <path d="M1.5 13l6-6-6-6" stroke-width="1.5"/>
//                </svg>
//            </button>';

        // Store the complete pagination structure in the response
       
        $argsPageLink = [
            'base' => $baseurl. '%_%',
            'current' => max( 1, $paged),
            'total'   => $query->max_num_pages,
            'next_text' => '<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                    <path d="M1.5 13l6-6-6-6" stroke-width="1.5"/>
                </svg>',
            'prev_text' => '<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                  <path d="M7.5 13l-6-6 6-6" stroke-width="1.5"/>
             </svg>'
        ];
        if (!empty($categories_id)) {
            $argsPageLink["add_args"]["countries"] = implode(",", $categories_id);
        }
        if (!empty($search_query)) {
            $argsPageLink["add_args"]["s"] = $search_query;
        }
        $_SERVER['REQUEST_URI'] = [];
        $response['pagination'] = paginate_links( $argsPageLink );
        $response['catSelected'] = $selected_categories;
        $response['remainingCount'] = $remaining_count;
    } else {
        $response['grid'] = "Posts not found.";
        $response['pagination'] = $pagination_buttons;
        $response['catSelected'] = $selected_categories;
        $response['remainingCount'] = $remaining_count;
    }

    wp_reset_postdata();

    header('Content-Type: application/json');
    echo json_encode($response);

    wp_die();
}

add_action('wp_ajax_filter_posts', 'ajax_filter_posts');
add_action('wp_ajax_nopriv_filter_posts', 'ajax_filter_posts');
function js_variables()
{

    $variables = array(
        'ajax_url' => admin_url('admin-ajax.php'),
        'afp_nonce' => wp_create_nonce('afp_nonce')
    );

    echo('<script> window.wp_data = ' .
        json_encode($variables) .
        ';</script>');

}

add_action('wp_head', 'js_variables');

/*JS snippet
 *
 function ajaxTest() {
     $.ajax({
       type: "POST",
       url: window.wp_data.ajax_url,

       data: {
         action: 'get_cart_data',
         ajax_nonce: window.wp_data.ajax_nonce,
         username: username,
         phone: phone
       },

       success: function (response) {
         var result = JSON.parse(response);
         console.log(result);
       }
     });
   }
 */
