<?php
/**
 * @var array $args
 */

$query = $args['field'];
?>

<div class="archive-pagination">
    <?php
    $pagination_args = array(
        'current'     => max( 1, get_query_var('paged') ),
        'prev_text'   => __( '<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M7.5 13l-6-6 6-6" stroke-width="1.5"/>
                    </svg>', 'test' ),
        'next_text'   => __( '<svg width="9" height="14" viewBox="0 0 9 14" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M1.5 13l6-6-6-6" stroke-width="1.5"/>
                    </svg>', 'test' ),
    );

    if ( $query ) {
        $pagination_args['total'] = $query->max_num_pages;
    }

    $pagination = paginate_links( $pagination_args );


    if ( $pagination ) {
        echo $pagination;
    }

    ?>
</div>
